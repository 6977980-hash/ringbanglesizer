/* Ring Bangle Sizer – vanilla JS, no dependencies.
 * Data (RBS_DATA.rings / RBS_DATA.bangles) is injected by functions.php.
 */
(function () {
	'use strict';

	var CARD_MM = 85.6;                 // ISO/IEC 7810 ID-1 width
	var DEFAULT_PPM = 96 / 25.4;        // CSS px per mm if never calibrated (~3.78)
	var STORE_KEY = 'rbs_ppm_v1';
	var MM_IN = 25.4;

	var data = window.RBS_DATA || { rings: [], bangles: [] };

	function $(sel, root) { return (root || document).querySelector(sel); }
	function el(tag, attrs, html) {
		var e = document.createElement(tag);
		if (attrs) { Object.keys(attrs).forEach(function (k) { e.setAttribute(k, attrs[k]); }); }
		if (html !== undefined) { e.innerHTML = html; }
		return e;
	}
	function fmt(n, d) { return Number(n).toFixed(d === undefined ? 1 : d); }
	function store(key, val) { try { localStorage.setItem(key, val); } catch (e) {} }
	function load(key) { try { return localStorage.getItem(key); } catch (e) { return null; } }

	/* ------------------------------------------------------------ state */

	var ppm = parseFloat(load(STORE_KEY)) || 0;   // 0 = not calibrated
	var calibrated = ppm > 0;
	if (!calibrated) { ppm = DEFAULT_PPM; }

	/* --------------------------------------------------------- calibration */

	function renderCalibration(root, onDone) {
		var panel = el('div', { 'class': 'rbs-panel rbs-cal' });
		var badge = calibrated
			? '<span class="rbs-badge ok">Screen calibrated</span>'
			: '<span class="rbs-badge">Not calibrated – sizes approximate</span>';
		panel.innerHTML =
			'<div class="rbs-cal-status"><h2 class="rbs-h">Step 1: Calibrate your screen</h2>' + badge + '</div>' +
			'<p class="rbs-muted">Hold any credit, debit or ID card against the screen. Drag the slider until the dashed outline is exactly the width of the card.</p>' +
			'<div class="rbs-card-stage"><div class="rbs-card">Match the card width</div></div>' +
			'<div class="rbs-slider-row"><button type="button" class="rbs-step" data-d="-1" aria-label="Smaller">−</button>' +
			'<input type="range" min="2" max="12" step="0.01" value="' + ppm + '" aria-label="Card width">' +
			'<button type="button" class="rbs-step" data-d="1" aria-label="Larger">+</button></div>' +
			'<div class="rbs-btn-row"><button type="button" class="rbs-btn rbs-cal-save">Save calibration</button>' +
			'<button type="button" class="rbs-btn secondary rbs-cal-toggle">' + (calibrated ? 'Hide' : 'Skip for now') + '</button></div>';

		var card = $('.rbs-card', panel);
		var range = $('input[type=range]', panel);
		var stage = $('.rbs-card-stage', panel);

		function draw() {
			var w = ppm * CARD_MM;
			var h = ppm * 53.98;
			var maxW = stage.clientWidth - 8;
			if (w > maxW) { // card wider than viewport: still draw true size, let it overflow visually
				stage.style.justifyContent = 'flex-start';
			}
			card.style.width = w + 'px';
			card.style.height = h + 'px';
		}
		range.addEventListener('input', function () { ppm = parseFloat(range.value); draw(); });
		panel.querySelectorAll('.rbs-step').forEach(function (b) {
			b.addEventListener('click', function () {
				ppm = Math.min(12, Math.max(2, ppm + 0.02 * parseInt(b.getAttribute('data-d'), 10)));
				range.value = ppm;
				draw();
			});
		});
		$('.rbs-cal-save', panel).addEventListener('click', function () {
			calibrated = true;
			store(STORE_KEY, String(ppm));
			$('.rbs-badge', panel).outerHTML = '<span class="rbs-badge ok">Screen calibrated</span>';
			$('.rbs-cal-toggle', panel).textContent = 'Hide';
			collapse(true);
			onDone();
		});
		var body = Array.prototype.slice.call(panel.children, 1);
		function collapse(yes) {
			body.forEach(function (c) { c.classList.toggle('rbs-hidden', yes); });
			var t = el('button', { type: 'button', 'class': 'rbs-btn secondary rbs-cal-reopen' }, 'Re-calibrate');
			var old = $('.rbs-cal-reopen', panel);
			if (old) { old.remove(); }
			if (yes) {
				t.addEventListener('click', function () { collapse(false); });
				panel.appendChild(t);
			}
		}
		$('.rbs-cal-toggle', panel).addEventListener('click', function () { collapse(true); });
		root.appendChild(panel);
		draw();
		if (calibrated) { collapse(true); }
		window.addEventListener('resize', draw);
	}

	/* --------------------------------------------------------- circle stage */

	function circleStage(mm, label) {
		var px = mm * ppm;
		var size = Math.max(px + 40, 220);
		var svg =
			'<svg width="' + size + '" height="' + size + '" viewBox="0 0 ' + size + ' ' + size + '" aria-hidden="true">' +
			'<circle class="rbs-circle-inner" cx="' + size / 2 + '" cy="' + size / 2 + '" r="' + px / 2 + '"/>' +
			'<circle class="rbs-circle" cx="' + size / 2 + '" cy="' + size / 2 + '" r="' + px / 2 + '"/>' +
			'<line class="rbs-center" x1="' + (size / 2 - 6) + '" y1="' + size / 2 + '" x2="' + (size / 2 + 6) + '" y2="' + size / 2 + '"/>' +
			'<line class="rbs-center" x1="' + size / 2 + '" y1="' + (size / 2 - 6) + '" x2="' + size / 2 + '" y2="' + (size / 2 + 6) + '"/>' +
			'</svg><div class="rbs-stage-label">' + label + '</div>';
		return svg;
	}

	function resultTable(rows) {
		return '<table>' + rows.map(function (r) {
			return '<tr><td>' + r[0] + '</td><td>' + r[1] + '</td></tr>';
		}).join('') + '</table>';
	}

	function nearestRing(mm) {
		var best = data.rings[0], bd = 99;
		data.rings.forEach(function (r) {
			var d = Math.abs(r.mm - mm);
			if (d < bd) { bd = d; best = r; }
		});
		return best;
	}
	function nearestBangleUp(mm) {
		for (var i = 0; i < data.bangles.length; i++) {
			if (data.bangles[i].mm >= mm - 0.3) { return data.bangles[i]; }
		}
		return data.bangles[data.bangles.length - 1];
	}

	function approxNote() {
		return calibrated ? '' : '<p class="rbs-note rbs-approx">⚠ Screen not calibrated: the circle is approximate. Calibrate above for an exact result.</p>';
	}

	/* ------------------------------------------------------------- ring */

	function renderRing(root, method) {
		var idx = 8; // US 7
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Step 2: Find your ring size</h2>' +
			'<div class="rbs-methods">' +
			'<button type="button" class="rbs-method" data-m="match" aria-pressed="true">Match a ring I own</button>' +
			'<button type="button" class="rbs-method" data-m="mm" aria-pressed="false">I know the diameter / circumference</button>' +
			'</div>' +
			'<div class="rbs-m-match">' +
			'<p class="rbs-muted">Place your ring flat on the screen. Move the slider until the blue circle lines up with the <strong>inside</strong> edge of the ring.</p>' +
			'<div class="rbs-stage"></div>' +
			'<div class="rbs-slider-row"><button type="button" class="rbs-step" data-d="-1" aria-label="Smaller">−</button>' +
			'<input type="range" min="0" max="' + (data.rings.length - 1) + '" step="1" value="' + idx + '" aria-label="Ring size">' +
			'<button type="button" class="rbs-step" data-d="1" aria-label="Larger">+</button></div>' +
			'</div>' +
			'<div class="rbs-m-mm rbs-hidden">' +
			'<div class="rbs-field"><label>Measurement</label><input type="number" step="0.1" min="10" max="80" class="rbs-mm-val" value="17.3">' +
			'<select class="rbs-mm-type"><option value="d">inner diameter (mm)</option><option value="c">inner circumference (mm)</option><option value="di">inner diameter (inch)</option></select></div>' +
			'</div>' +
			'<div class="rbs-result"></div>' + approxNote();

		var stage = $('.rbs-stage', panel);
		var range = $('input[type=range]', panel);
		var result = $('.rbs-result', panel);

		function show(r, fromMm) {
			var head = fromMm ? 'Closest size: US ' + r.us : 'US ' + r.us;
			result.innerHTML =
				'<div class="rbs-big">' + head + ' &nbsp;·&nbsp; UK ' + r.uk + '</div>' +
				resultTable([
					['US / Canada', r.us],
					['UK / Australia / NZ', r.uk],
					['EU / ISO (circumference)', r.eu],
					['India / Japan', r.jp],
					['Inner diameter', fmt(r.mm) + ' mm (' + fmt(r.mm / MM_IN, 2) + ' in)'],
					['Inner circumference', fmt(r.circ) + ' mm']
				]) +
				'<p class="rbs-note">Ring sizes are accurate to about ±¼ size. Fingers swell in heat and in the evening; measure at room temperature.</p>';
		}
		function drawMatch() {
			var r = data.rings[idx];
			stage.innerHTML = circleStage(r.mm, 'Inner diameter ' + fmt(r.mm) + ' mm · US ' + r.us);
			show(r, false);
		}
		range.addEventListener('input', function () { idx = parseInt(range.value, 10); drawMatch(); });
		panel.querySelectorAll('.rbs-m-match .rbs-step').forEach(function (b) {
			b.addEventListener('click', function () {
				idx = Math.min(data.rings.length - 1, Math.max(0, idx + parseInt(b.getAttribute('data-d'), 10)));
				range.value = idx; drawMatch();
			});
		});
		function fromMm() {
			var v = parseFloat($('.rbs-mm-val', panel).value);
			var t = $('.rbs-mm-type', panel).value;
			if (!v) { return; }
			var d = t === 'c' ? v / Math.PI : (t === 'di' ? v * MM_IN : v);
			show(nearestRing(d), true);
		}
		$('.rbs-mm-val', panel).addEventListener('input', fromMm);
		$('.rbs-mm-type', panel).addEventListener('change', fromMm);

		panel.querySelectorAll('.rbs-method').forEach(function (b) {
			b.addEventListener('click', function () {
				panel.querySelectorAll('.rbs-method').forEach(function (x) { x.setAttribute('aria-pressed', 'false'); });
				b.setAttribute('aria-pressed', 'true');
				var m = b.getAttribute('data-m');
				$('.rbs-m-match', panel).classList.toggle('rbs-hidden', m !== 'match');
				$('.rbs-m-mm', panel).classList.toggle('rbs-hidden', m !== 'mm');
				if (m === 'match') { drawMatch(); } else { fromMm(); }
			});
		});

		root.appendChild(panel);
		drawMatch();
		if (method === 'mm') { $('.rbs-method[data-m="mm"]', panel).click(); }
		// After calibration only the "match" view depends on the screen scale.
		return function () {
			if (!$('.rbs-m-match', panel).classList.contains('rbs-hidden')) { drawMatch(); }
		};
	}

	/* ----------------------------------------------------------- bangle */

	function renderBangle(root) {
		var idx = 6; // 2.6
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Step 2: Find your bangle size</h2>' +
			'<div class="rbs-methods">' +
			'<button type="button" class="rbs-method" data-m="match" aria-pressed="true">Match a bangle I own</button>' +
			'<button type="button" class="rbs-method" data-m="hand" aria-pressed="false">Measure my hand</button>' +
			'</div>' +
			'<div class="rbs-m-match">' +
			'<p class="rbs-muted">Place a bangle that fits you on the screen. Move the slider until the circle lines up with its <strong>inside</strong> edge.</p>' +
			'<div class="rbs-stage"></div>' +
			'<div class="rbs-slider-row"><button type="button" class="rbs-step" data-d="-1" aria-label="Smaller">−</button>' +
			'<input type="range" min="0" max="' + (data.bangles.length - 1) + '" step="1" value="' + idx + '" aria-label="Bangle size">' +
			'<button type="button" class="rbs-step" data-d="1" aria-label="Larger">+</button></div>' +
			'</div>' +
			'<div class="rbs-m-hand rbs-hidden">' +
			'<p class="rbs-muted">Tuck your thumb into your palm (as if sliding on a bangle). Wrap a string or tape around the widest part of your hand, over the knuckles. Enter that length.</p>' +
			'<div class="rbs-field"><label>Hand circumference</label><input type="number" step="0.1" min="4" max="30" class="rbs-hand-val" value="8">' +
			'<select class="rbs-hand-unit"><option value="in">inches</option><option value="cm">cm</option></select></div>' +
			'</div>' +
			'<div class="rbs-result"></div>' + approxNote();

		var stage = $('.rbs-stage', panel);
		var range = $('input[type=range]', panel);
		var result = $('.rbs-result', panel);

		function show(b, extra) {
			result.innerHTML =
				'<div class="rbs-big">Size ' + b.label + '</div>' +
				resultTable([
					['Indian bangle size', b.label],
					['Inner diameter', fmt(b.mm) + ' mm · ' + fmt(b.mm / 10, 2) + ' cm · ' + fmt(b.inch, 3) + ' in'],
					['Inner circumference', fmt(b.mm * Math.PI) + ' mm'],
					['Typical fit', b.fit]
				]) + (extra || '') +
				'<p class="rbs-note">Adult bangle sizes step by 2/16 inch (about 3.2 mm). If you are between sizes, choose the larger one for a bangle that slides over the hand.</p>';
		}
		function drawMatch() {
			var b = data.bangles[idx];
			stage.innerHTML = circleStage(b.mm, 'Inner diameter ' + fmt(b.mm) + ' mm · size ' + b.label);
			show(b);
		}
		range.addEventListener('input', function () { idx = parseInt(range.value, 10); drawMatch(); });
		panel.querySelectorAll('.rbs-m-match .rbs-step').forEach(function (b) {
			b.addEventListener('click', function () {
				idx = Math.min(data.bangles.length - 1, Math.max(0, idx + parseInt(b.getAttribute('data-d'), 10)));
				range.value = idx; drawMatch();
			});
		});
		function fromHand() {
			var v = parseFloat($('.rbs-hand-val', panel).value);
			var u = $('.rbs-hand-unit', panel).value;
			if (!v) { return; }
			var circMm = u === 'in' ? v * MM_IN : v * 10;
			var d = circMm / Math.PI;
			var b = nearestBangleUp(d);
			show(b, '<p class="rbs-note">Your hand circumference ' + fmt(circMm) + ' mm ≈ ' + fmt(d) + ' mm across. The bangle must be at least this wide inside.</p>');
		}
		$('.rbs-hand-val', panel).addEventListener('input', fromHand);
		$('.rbs-hand-unit', panel).addEventListener('change', fromHand);

		panel.querySelectorAll('.rbs-method').forEach(function (b) {
			b.addEventListener('click', function () {
				panel.querySelectorAll('.rbs-method').forEach(function (x) { x.setAttribute('aria-pressed', 'false'); });
				b.setAttribute('aria-pressed', 'true');
				var m = b.getAttribute('data-m');
				$('.rbs-m-match', panel).classList.toggle('rbs-hidden', m !== 'match');
				$('.rbs-m-hand', panel).classList.toggle('rbs-hidden', m !== 'hand');
				if (m === 'match') { drawMatch(); } else { fromHand(); }
			});
		});

		root.appendChild(panel);
		drawMatch();
		// After calibration only the "match" view depends on the screen scale.
		return function () {
			if (!$('.rbs-m-match', panel).classList.contains('rbs-hidden')) { drawMatch(); }
		};
	}

	/* --------------------------------------------------------- bracelet */

	function renderBracelet(root) {
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Find your bracelet size</h2>' +
			'<p class="rbs-muted">Wrap a string or tape snugly around your wrist just below the wrist bone, then measure it.</p>' +
			'<div class="rbs-field"><label>Wrist circumference</label><input type="number" step="0.1" min="3" max="30" class="rbs-wrist-val" value="6.5">' +
			'<select class="rbs-wrist-unit"><option value="in">inches</option><option value="cm">cm</option></select></div>' +
			'<div class="rbs-field"><label>Bracelet type</label><select class="rbs-wrist-type">' +
			'<option value="chain">Chain / link bracelet</option><option value="bangle">Rigid bangle bracelet</option><option value="cuff">Open cuff</option></select></div>' +
			'<div class="rbs-result"></div>';
		var result = $('.rbs-result', panel);

		function calc() {
			var v = parseFloat($('.rbs-wrist-val', panel).value);
			var u = $('.rbs-wrist-unit', panel).value;
			var t = $('.rbs-wrist-type', panel).value;
			if (!v) { return; }
			var inch = u === 'in' ? v : v / 2.54;
			var add = t === 'chain' ? [0.5, 0.75, 1.25] : (t === 'bangle' ? [1.0, 1.25, 1.5] : [0.25, 0.5, 0.75]);
			function both(x) { return fmt(x, 2) + ' in / ' + fmt(x * 2.54, 1) + ' cm'; }
			var rows = [
				['Your wrist', both(inch)],
				['Snug fit', both(inch + add[0])],
				['Comfortable fit (recommended)', both(inch + add[1])],
				['Loose fit', both(inch + add[2])]
			];
			if (t === 'bangle') {
				var d = ((inch + add[1]) * MM_IN) / Math.PI;
				rows.push(['Bangle inner diameter', fmt(d) + ' mm → Indian size ' + nearestBangleUp(d).label]);
			}
			result.innerHTML = '<div class="rbs-big">' + both(inch + add[1]) + '</div>' + resultTable(rows) +
				'<p class="rbs-note">Standard women\'s bracelets are 7 in (17.8 cm); men\'s are 8–8.5 in (20–21.5 cm).</p>';
		}
		['.rbs-wrist-val', '.rbs-wrist-unit', '.rbs-wrist-type'].forEach(function (s) {
			$(s, panel).addEventListener('input', calc);
			$(s, panel).addEventListener('change', calc);
		});
		root.appendChild(panel);
		calc();
		return function () {};
	}

	/* ------------------------------------------------------------- init */

	function init(container) {
		var mode = container.getAttribute('data-mode') || 'ring';
		var method = container.getAttribute('data-method') || '';
		var body = $('.rbs-body', container);
		var tabs = container.querySelectorAll('.rbs-tab');
		var redraw = function () {};

		function mount(m) {
			body.innerHTML = '';
			tabs.forEach(function (t) { t.setAttribute('aria-selected', t.getAttribute('data-tab') === m ? 'true' : 'false'); });
			if (m === 'bracelet') {
				redraw = renderBracelet(body);
				return;
			}
			renderCalibration(body, function () {
				body.querySelectorAll('.rbs-approx').forEach(function (n) { n.remove(); });
				redraw();
			});
			redraw = m === 'bangle' ? renderBangle(body) : renderRing(body, m === mode ? method : '');
		}
		tabs.forEach(function (t) {
			t.addEventListener('click', function () { mount(t.getAttribute('data-tab')); });
		});
		mount(mode);
	}

	function boot() {
		document.querySelectorAll('.rbs').forEach(init);
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
