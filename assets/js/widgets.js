/* Ring Bangle Sizer – small guide widgets (no dependencies).
 *  [rbs_fit_quiz]    30-second "is my ring too tight or too loose?" quiz
 *  [rbs_kids_growth] estimate a child's bangle size in the next few years
 *  .rbs-true         real-size circle on each ring / bangle size page
 */
(function () {
	'use strict';

	function esc(t) {
		return String(t).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; });
	}

	/* ------------------------------------------------------- fit quiz */

	// Each answer scores -1 (tight), 0 (right) or +1 (loose).
	var QUESTIONS = [
		['Putting it on over the knuckle…', ['Needs soap or a hard push', 'Needs a small push', 'Slides on with no effort']],
		['After an hour of wearing it…', ['Deep red mark, skin bulges', 'A faint mark that fades fast', 'No mark, I can see a gap']],
		['When you shake your hand…', ['I can\'t turn it, even with my other hand', 'It stays put but turns if I twist it', 'It spins; the stone ends up on the palm side']],
		['With cold hands or in water…', ['Still feels tight', 'It stays on', 'It slips off, or nearly does']],
		['Taking it off…', ['I need soap or oil', 'A twist and a gentle pull', 'It falls off when my hand hangs down']]
	];

	function quizResult(ans) {
		var score = ans.reduce(function (a, b) { return a + b; }, 0);
		// Tight over the knuckle but loose once on: a big knuckle, not a wrong size.
		if (ans[0] === -1 && (ans[2] === 1 || ans[4] === 1)) {
			return ['warn', 'Your knuckle is bigger than the base of your finger',
				'The ring is the right size to pass the knuckle but loose below it. Don\'t size down. Ask a jeweller for sizing beads or a spring insert, or choose a hinged shank.'];
		}
		if (score <= -3) { return ['bad', 'Too tight: go up ½ to 1 size', 'A ring this tight can cut circulation on a hot day. Have it stretched or sized up; most plain bands can go up 1 size. If the finger is swollen or changing colour, get the ring cut off.']; }
		if (score <= -1) { return ['warn', 'A little tight: go up about ½ size', 'Check again late in the day at room temperature. If it still feels tight, a jeweller can stretch a plain band by ½ size in a few minutes.']; }
		if (score >= 3) { return ['bad', 'Too loose: go down ½ to 1 size', 'A ring this loose is easy to lose. A silicone ring guard is a quick fix; for good, have it sized down (usually the cheapest resize).']; }
		if (score >= 1) { return ['warn', 'A little loose: about ½ size', 'A clear ring guard or sizing beads will hold it in place. Wide bands feel tighter, so a loose wide band may be fine as it is.']; }
		return ['ok', 'It fits well', 'Slides on with a little push, stays put, comes off with a twist: that is the fit to aim for. Note this size for your next ring.'];
	}

	function initQuiz(box) {
		var ans = [];
		function render() {
			var i = ans.length;
			if (i >= QUESTIONS.length) {
				var r = quizResult(ans);
				box.innerHTML = '<p class="rbs-q-res ' + r[0] + '"><strong>' + esc(r[1]) + '</strong></p>' +
					'<p>' + esc(r[2]) + '</p>' +
					'<p class="rbs-q-links"><a href="/">Check your ring size on screen →</a> <button type="button" class="rbs-q-again">Take the quiz again</button></p>';
				box.querySelector('.rbs-q-again').addEventListener('click', function () { ans = []; render(); });
				return;
			}
			var q = QUESTIONS[i];
			box.innerHTML = '<p class="rbs-q-n">Question ' + (i + 1) + ' of ' + QUESTIONS.length + '</p>' +
				'<p class="rbs-q-t">' + esc(q[0]) + '</p>' +
				'<div class="rbs-q-opts">' + q[1].map(function (o, k) {
					return '<button type="button" class="rbs-q-opt" data-v="' + (k - 1) + '">' + esc(o) + '</button>';
				}).join('') + '</div>' +
				(i ? '<button type="button" class="rbs-q-back">← Back</button>' : '');
			box.querySelectorAll('.rbs-q-opt').forEach(function (b) {
				b.addEventListener('click', function () { ans.push(parseInt(b.getAttribute('data-v'), 10)); render(); });
			});
			var back = box.querySelector('.rbs-q-back');
			if (back) { back.addEventListener('click', function () { ans.pop(); render(); }); }
		}
		render();
	}

	/* ------------------------------------------------- kids growth */

	// Typical bangle inner diameter (mm) by age, from the kids chart midpoints.
	var CURVE = [[0, 35.7], [0.5, 38.9], [1, 41.3], [2, 44.5], [3, 46.0], [4, 47.6], [5.5, 49.2], [7, 50.8], [8.5, 52.4], [10, 54.0], [12, 54.8], [14, 56.0], [16, 57.2], [18, 57.6]];
	var MM_IN = 25.4;

	function typical(age) {
		if (age <= CURVE[0][0]) { return CURVE[0][1]; }
		for (var i = 1; i < CURVE.length; i++) {
			if (age <= CURVE[i][0]) {
				var t = (age - CURVE[i - 1][0]) / (CURVE[i][0] - CURVE[i - 1][0]);
				return CURVE[i - 1][1] + t * (CURVE[i][1] - CURVE[i - 1][1]);
			}
		}
		return CURVE[CURVE.length - 1][1];
	}
	// Bangle sizes step by 2/16 in: 1.4, 1.6 … 1.14, 2.0, 2.2 …
	function sizeFor(mm, up) {
		var sixteenths = mm / MM_IN * 16;
		// a bangle up to about 0.8 mm under the estimate still slides on, so round up only past that
		var steps = up ? Math.ceil(sixteenths / 2 - 0.25) : Math.round(sixteenths / 2);
		var s = steps * 2;
		return { label: Math.floor(s / 16) + '.' + (s % 16), mm: s / 16 * MM_IN };
	}
	function sizeOptions() {
		var out = [];
		for (var s = 20; s <= 40; s += 2) { out.push(Math.floor(s / 16) + '.' + (s % 16)); }
		return out;
	}

	function initGrowth(box) {
		var ages = [];
		for (var a = 0; a <= 14; a++) { ages.push(a); }
		box.innerHTML =
			'<div class="rbs-g-row">' +
			'<label>Child\'s age <select class="rbs-g-age">' +
			'<option value="0.25">Under 6 months</option><option value="0.75">6–12 months</option>' +
			ages.slice(1).map(function (a) { return '<option value="' + a + '"' + (a === 3 ? ' selected' : '') + '>' + a + (a === 1 ? ' year' : ' years') + '</option>'; }).join('') +
			'</select></label>' +
			'<label>Size that fits now <select class="rbs-g-size"><option value="">Not sure</option>' +
			sizeOptions().map(function (l) { return '<option>' + l + '</option>'; }).join('') +
			'</select></label></div>' +
			'<div class="rbs-g-out" aria-live="polite"></div>' +
			'<p class="rbs-g-note">Estimate only. Children grow at different rates; measure again before you buy gold.</p>';
		var ageSel = box.querySelector('.rbs-g-age'), sizeSel = box.querySelector('.rbs-g-size'), out = box.querySelector('.rbs-g-out');
		function calc() {
			var age = parseFloat(ageSel.value);
			var nowMm;
			if (sizeSel.value) {
				var p = sizeSel.value.split('.');
				nowMm = (parseInt(p[0], 10) + parseInt(p[1], 10) / 16) * MM_IN;
			} else {
				nowMm = sizeFor(typical(age), false).mm;
			}
			var rows = [[0, 'Now']].concat([[1, 'In 1 year'], [2, 'In 2 years'], [3, 'In 3 years']]).map(function (r) {
				var mm = nowMm + typical(age + r[0]) - typical(age);
				var s = r[0] ? sizeFor(mm, true) : sizeFor(mm, false);
				return '<tr><td>' + r[1] + ' (age ' + esc(fmtAge(age + r[0])) + ')</td><td><strong>' + s.label + '</strong></td><td>' + (Math.round(s.mm * 10 + 1e-6) / 10).toFixed(1) + ' mm</td></tr>';
			});
			out.innerHTML = '<div class="rbs-table-wrap"><table class="rbs-table"><thead><tr><th>When</th><th>Size</th><th>Inner diameter</th></tr></thead><tbody>' + rows.join('') + '</tbody></table></div>' +
				(sizeSel.value ? '' : '<p class="rbs-g-note">Based on a typical child of this age. Pick the size that fits now for a better estimate.</p>');
		}
		function fmtAge(a) {
			if (a < 1) { return a < 0.5 ? 'under 6 months' : '6–12 months'; }
			var y = Math.floor(a);
			return y + (y === 1 ? ' year' : ' years');
		}
		ageSel.addEventListener('change', calc);
		sizeSel.addEventListener('change', calc);
		calc();
	}


	/* ------------------------------------------------ real-size circle */

	// Same calibration the sizer saves (sizer.js): CSS px per mm + the
	// devicePixelRatio it was taken at, so browser zoom is corrected for.
	function load(k) { try { return localStorage.getItem(k); } catch (e) { return null; } }
	function scale() {
		var dpr = window.devicePixelRatio || 1;
		var ppm = parseFloat(load('rbs_ppm_v1')) || 0;
		if (ppm > 0) {
			var saved = parseFloat(load('rbs_dpr_v1')) || 0;
			if (saved && Math.abs(saved - dpr) > 0.01) { ppm = ppm * saved / dpr; }
			return { ppm: ppm, cal: true };
		}
		var narrow = Math.min(window.innerWidth || 1024, (window.screen && window.screen.width) || 1024) < 600;
		return { ppm: narrow ? 6 : 96 / 25.4, cal: false };
	}

	function initTrue(box) {
		var mm = parseFloat(box.getAttribute('data-mm'));
		var label = box.getAttribute('data-label');
		var ring = box.getAttribute('data-kind') === 'ring';
		var tool = box.getAttribute('data-tool');
		var name = ring ? 'ring' : 'bangle';
		box.innerHTML =
			'<p class="rbs-true-k">Real size</p>' +
			'<p class="rbs-true-t">' + (ring ? 'Ring size ' : 'Bangle size ') + esc(label) + ' drawn at ' + esc(mm.toFixed(1)) + ' mm across the inside</p>' +
			'<div class="rbs-true-stage"></div>' +
			'<p class="rbs-true-note"></p>';
		var stage = box.querySelector('.rbs-true-stage'), note = box.querySelector('.rbs-true-note');
		function draw() {
			var s = scale();
			var d = mm * s.ppm, w = d + 4, r = d / 2;
			var fits = w <= stage.clientWidth;
			stage.innerHTML = '<svg width="' + w + '" height="' + w + '" viewBox="0 0 ' + w + ' ' + w + '" aria-hidden="true" focusable="false" style="margin:' + (fits ? '0 auto' : '0 0 0 ' + ((stage.clientWidth - w) / 2) + 'px') + '">' +
				'<circle cx="' + (w / 2) + '" cy="' + (w / 2) + '" r="' + r + '" fill="#fdf6e3" stroke="#1d4ed8" stroke-width="2"/>' +
				'<text x="' + (w / 2) + '" y="' + (w / 2 - 2) + '" text-anchor="middle" font-size="' + Math.max(12, Math.min(22, d / 6)) + '" font-weight="700" fill="#111827">' + esc(label) + '</text>' +
				'<text x="' + (w / 2) + '" y="' + (w / 2 + 16) + '" text-anchor="middle" font-size="12" fill="#4b5563">' + esc(mm.toFixed(1)) + ' mm</text></svg>';
			stage.style.height = Math.min(w, stage.clientWidth * 1.4) + 'px';
			var msg = s.cal
				? 'Calibrated on this device. Lay your ' + name + ' flat on the screen: if its inside edge sits on the blue line, it is ' + esc(label) + '.'
				: 'Approximate until you calibrate. <a href="' + esc(tool) + '">Calibrate once with a bank card or coin</a> (20 seconds) and this circle shows the true size.';
			if (!fits) { msg += ' The circle is wider than your screen: line up the top and bottom edges.'; }
			note.innerHTML = msg;
		}
		draw();
		var t;
		window.addEventListener('resize', function () { clearTimeout(t); t = setTimeout(draw, 150); });
	}

	function boot() {
		document.querySelectorAll('.rbs-quiz').forEach(initQuiz);
		document.querySelectorAll('.rbs-growth').forEach(initGrowth);
		document.querySelectorAll('.rbs-true').forEach(initTrue);
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
