/* Ring size converter – [rbs_ring_converter]. Vanilla JS, data in data-rings. */
(function () {
	'use strict';

	var NAMES = { us: 'US', uk: 'UK', eu: 'EU', jp: 'India / Japan' };

	function fmt(n, d) { return Number(n).toFixed(d === undefined ? 1 : d); }
	function esc(s) {
		return String(s).replace(/[&<>"']/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
		});
	}

	function init(box) {
		var rings;
		try { rings = JSON.parse(box.getAttribute('data-rings')); } catch (e) { return; }
		if (!rings || !rings.length) { return; }

		var from = box.querySelector('.rbs-conv-from');
		var size = box.querySelector('.rbs-conv-size');
		var num = box.querySelector('.rbs-conv-num');
		var out = box.querySelector('.rbs-conv-out');

		function nearest(mm) {
			var best = rings[0];
			rings.forEach(function (r) {
				if (Math.abs(r.mm - mm) < Math.abs(best.mm - mm)) { best = r; }
			});
			return best;
		}

		function fillSizes() {
			var sys = from.value;
			var numeric = sys === 'mm' || sys === 'circ' || sys === 'in';
			size.hidden = numeric;
			num.hidden = !numeric;
			if (numeric) {
				num.step = sys === 'in' ? '0.01' : '0.1';
				num.value = sys === 'mm' ? '17.3' : (sys === 'circ' ? '54.3' : '0.68');
				return;
			}
			var seen = {};
			var html = '';
			rings.forEach(function (r, i) {
				var v = String(r[sys]);
				if (seen[v]) { return; }
				seen[v] = true;
				html += '<option value="' + i + '"' + (r.us === 7 ? ' selected' : '') + '>' + esc(NAMES[sys] + ' ' + v) + '</option>';
			});
			size.innerHTML = html;
		}

		function show() {
			var sys = from.value;
			var r, note = '';
			if (sys === 'mm' || sys === 'circ' || sys === 'in') {
				var v = parseFloat(num.value);
				if (!v || v <= 0) { out.innerHTML = ''; return; }
				var mm = sys === 'mm' ? v : (sys === 'circ' ? v / Math.PI : v * 25.4);
				r = nearest(mm);
				note = '<p class="rbs-conv-note">Your measurement is ' + fmt(mm) + ' mm across. Closest standard size shown';
				if (Math.abs(r.mm - mm) > 0.2) {
					note += mm > r.mm ? '; you are between sizes, so the next half size up may be more comfortable' : '; you are between sizes, so check the next half size down too';
				}
				note += '.</p>';
				if (mm < rings[0].mm - 0.4 || mm > rings[rings.length - 1].mm + 0.4) {
					note = '<p class="rbs-conv-note">That is outside the normal ring size range (' + fmt(rings[0].mm) + '–' + fmt(rings[rings.length - 1].mm) + ' mm diameter). Check the unit.</p>';
				}
			} else {
				r = rings[parseInt(size.value, 10)] || rings[0];
			}
			var us = r.url ? '<a href="' + esc(r.url) + '">' + esc(r.us) + '</a>' : esc(r.us);
			out.innerHTML =
				'<div class="rbs-conv-big">US ' + esc(r.us) + ' = UK ' + esc(r.uk) + ' = EU ' + esc(r.eu) + '</div>' +
				'<table class="rbs-table rbs-kv"><tbody>' +
				'<tr><th scope="row">US / Canada</th><td>' + us + '</td></tr>' +
				'<tr><th scope="row">UK / Australia / NZ</th><td>' + esc(r.uk) + '</td></tr>' +
				'<tr><th scope="row">EU / ISO / Germany / France</th><td>' + esc(r.eu) + '</td></tr>' +
				'<tr><th scope="row">India / Japan / China / Pakistan</th><td>' + esc(r.jp) + '</td></tr>' +
				'<tr><th scope="row">Switzerland</th><td>' + esc(r.eu - 40) + '</td></tr>' +
				'<tr><th scope="row">Inner diameter</th><td>' + fmt(r.mm) + ' mm (' + fmt(r.mm / 25.4, 3) + ' in)</td></tr>' +
				'<tr><th scope="row">Inner circumference</th><td>' + fmt(r.circ) + ' mm (' + fmt(r.circ / 25.4, 2) + ' in)</td></tr>' +
				'</tbody></table>' + note;
		}

		from.addEventListener('change', function () { fillSizes(); show(); });
		size.addEventListener('change', show);
		num.addEventListener('input', show);
		fillSizes();
		show();
	}

	function boot() { document.querySelectorAll('.rbs-conv').forEach(init); }
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
