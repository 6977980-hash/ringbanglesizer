/* Ring size converter – [rbs_ring_converter]. Vanilla JS, data in data-rings. */
(function () {
	'use strict';

	var NAMES = { us: 'US', uk: 'UK', eu: 'EU', india: 'India' };

	function fmt(n, d) { return Number(n).toFixed(d === undefined ? 1 : d); }
	function esc(s) {
		return String(s).replace(/[&<>"']/g, function (c) {
			return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c];
		});
	}

	function init(box) {
		var rings, uk;
		try { rings = JSON.parse(box.getAttribute('data-rings')); } catch (e) { return; }
		try { uk = JSON.parse(box.getAttribute('data-uk') || '[]'); } catch (e) { uk = []; }
		if (!rings || !rings.length) { return; }

		var from = box.querySelector('.rbs-conv-from');
		var size = box.querySelector('.rbs-conv-size');
		var num = box.querySelector('.rbs-conv-num');
		var out = box.querySelector('.rbs-conv-out');

		// "<=": exactly between two sizes gives the larger one.
		function nearest(mm) {
			var best = rings[0];
			rings.forEach(function (r) {
				if (Math.abs(r.mm - mm) <= Math.abs(best.mm - mm) + 1e-9) { best = r; }
			});
			return best;
		}
		// US size → inner diameter, interpolated between the chart rows (quarter sizes).
		function usMm(us) {
			for (var i = 1; i < rings.length; i++) {
				if (us <= rings[i].us) {
					var t = (us - rings[i - 1].us) / (rings[i].us - rings[i - 1].us);
					return rings[i - 1].mm + t * (rings[i].mm - rings[i - 1].mm);
				}
			}
			return rings[rings.length - 1].mm;
		}
		function usLabel(us) {
			var w = Math.floor(us), q = Math.round((us - w) * 4);
			return w + (['', '¼', '½', '¾'][q] || '');
		}
		// Every size a shop might use in each system, as [label, inner diameter mm].
		function sizeList(sys) {
			var list = [], n;
			if (sys === 'us') {
				for (n = 3; n <= 15.001; n += 0.25) { list.push([usLabel(n), usMm(n), n === 7]); }
			} else if (sys === 'uk') {
				uk.forEach(function (r) { list.push([r.uk, r.mm, r.uk === 'N½']); });
				rings.forEach(function (r) { if (/^Z\+/.test(r.uk)) { list.push([r.uk, r.mm, false]); } });
				if (!uk.length) { rings.forEach(function (r) { list.push([r.uk, r.mm, r.us === 7]); }); }
			} else if (sys === 'eu') {
				for (n = 44; n <= 76; n++) { list.push([String(n), n / Math.PI, n === 54]); }
			} else if (sys === 'india') {
				for (n = 4; n <= 35; n++) { list.push([String(n), (n + 40) / Math.PI, n === 14]); }
			}
			return list;
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
			size.innerHTML = sizeList(sys).map(function (x) {
				return '<option value="' + x[1].toFixed(3) + '"' + (x[2] ? ' selected' : '') + '>' + esc(NAMES[sys] + ' ' + x[0]) + '</option>';
			}).join('');
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
				var picked = parseFloat(size.value) || rings[0].mm;
				r = nearest(picked);
				var label = size.options[size.selectedIndex] ? size.options[size.selectedIndex].text : '';
				if (Math.abs(r.mm - picked) > 0.05) {
					note = '<p class="rbs-conv-note">' + esc(label) + ' is ' + fmt(picked) + ' mm across (' + fmt(picked * Math.PI) + ' mm around). It sits between the chart rows, so the closest standard size is shown; if you are between sizes, choose the larger one.</p>';
				}
			}
			var us = r.url ? '<a href="' + esc(r.url) + '">' + esc(r.us) + '</a>' : esc(r.us);
			out.innerHTML =
				'<div class="rbs-conv-big">US ' + esc(r.us) + ' = UK ' + esc(r.uk) + ' = EU ' + esc(r.eu) + '</div>' +
				'<table class="rbs-table rbs-kv"><tbody>' +
				'<tr><th scope="row"><a href="/ring-size-chart/us/">US / Canada</a></th><td>' + us + '</td></tr>' +
				'<tr><th scope="row"><a href="/ring-size-chart/uk/">UK / Australia / NZ</a></th><td>' + esc(r.uk) + '</td></tr>' +
				'<tr><th scope="row">EU / ISO / Germany / France</th><td>' + esc(r.eu) + '</td></tr>' +
				'<tr><th scope="row"><a href="/ring-size-chart/india/">India</a> / <a href="/ring-size-chart/pakistan/">Pakistan</a></th><td>' + esc(r.india) + '</td></tr>' +
				'<tr><th scope="row">Italy / Spain / Switzerland</th><td>' + esc(r.eu - 40) + '</td></tr>' +
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
