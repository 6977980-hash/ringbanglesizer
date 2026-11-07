/* Ring Bangle Sizer – vanilla JS, no dependencies.
 * Data (RBS_DATA.rings / RBS_DATA.bangles) is injected by functions.php.
 */
(function () {
	'use strict';

	var CARD_MM = 85.6;                 // ISO/IEC 7810 ID-1 width
	var CARD_SHORT_MM = 53.98;          // ISO/IEC 7810 ID-1 height
	// CSS px per mm if never calibrated. Desktop monitors are close to 96 CSS px/inch (~3.78);
	// phones are much denser (most are 5.8–6.4 CSS px/mm), so a narrow screen starts at 6.
	var NARROW = Math.min(window.innerWidth || 1024, (window.screen && window.screen.width) || 1024) < 600;
	var DEFAULT_PPM = NARROW ? 6 : 96 / 25.4;
	var STORE_KEY = 'rbs_ppm_v1';
	var MM_IN = 25.4;

	var data = window.RBS_DATA || { rings: [], bangles: [] };
	data.uk = data.uk || [];

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

	/* Zoom. Calibration is in CSS px per mm, and browser zoom (Ctrl +/−, or a
	 * phone's page-zoom setting) changes how big a CSS px is: devicePixelRatio
	 * moves with it while the screen's real pixels stay the same. So the
	 * devicePixelRatio at calibration is stored and the scale corrected for
	 * any change since. Pinch-zoom does not change CSS px; it only magnifies
	 * the view (visualViewport.scale), so it is blocked on the drawing areas
	 * and, if it happens anyway, the drawings are hidden behind a warning. */
	var DPR_KEY = 'rbs_dpr_v1';
	var dpr = window.devicePixelRatio || 1;
	var savedDpr = parseFloat(load(DPR_KEY)) || 0;
	if (calibrated && savedDpr && Math.abs(savedDpr - dpr) > 0.01) {
		ppm = ppm * savedDpr / dpr;
	}
	var scaleListeners = [];
	function onScale(fn) { scaleListeners.push(fn); }
	function checkZoom() {
		var now = window.devicePixelRatio || 1;
		if (Math.abs(now - dpr) > 0.01) {
			if (calibrated) { ppm = ppm * dpr / now; }
			dpr = now;
			scaleListeners.forEach(function (fn) { fn(); });
		}
		var pinched = !!(window.visualViewport && window.visualViewport.scale > 1.02);
		document.querySelectorAll('.rbs').forEach(function (r) { r.classList.toggle('rbs-zoomed', pinched); });
	}
	window.addEventListener('resize', checkZoom);
	if (window.visualViewport) { window.visualViewport.addEventListener('resize', checkZoom); }

	/* ----------------------------------------------------------- helpers */

	// Which ring system to show first, guessed from the browser language/region.
	var SYSTEM_KEY = 'rbs_system_v1';
	var SAVED_KEY = 'rbs_my_size_v1';
	function guessSystem() {
		var langs = (navigator.languages && navigator.languages.length ? navigator.languages : [navigator.language || 'en-US']).join(',').toLowerCase();
		if (/-(gb|au|nz|ie|za)\b/.test(langs)) { return 'uk'; }
		if (/-(in|pk|bd|lk|np)\b|\b(hi|ur|bn|ta|te|mr|gu|pa|kn|ml)\b/.test(langs)) { return 'in'; }
		if (/^(de|fr|es|it|nl|pt|pl|sv|da|fi|nb|no|cs|el|hu|ro|tr)\b/.test(langs)) { return 'eu'; }
		return 'us';
	}
	var ringSystem = load(SYSTEM_KEY) || guessSystem();
	var SYSTEMS = { us: 'US', uk: 'UK', eu: 'EU', in: 'India' };
	function ringIn(r, sys) {
		return sys === 'uk' ? 'UK ' + r.uk : (sys === 'eu' ? 'EU ' + r.eu : (sys === 'in' ? 'India ' + r.india : 'US ' + r.us));
	}

	function setStep(root, n) {
		var steps = root && root.parentNode ? $('.rbs-steps', root.parentNode) : null;
		if (!steps) { return; }
		steps.querySelectorAll('li').forEach(function (li, i) {
			li.className = i + 1 < n ? 'done' : (i + 1 === n ? 'current' : '');
			if (i + 1 === n) { li.setAttribute('aria-current', 'step'); } else { li.removeAttribute('aria-current'); }
		});
	}

	// Saved sizes for several people ("Me", "Ammi" …), kept on this device only.
	var PEOPLE_KEY = 'rbs_people_v1';
	function people() {
		var list;
		try { list = JSON.parse(load(PEOPLE_KEY) || 'null'); } catch (e) { list = null; }
		if (!list) {
			list = [];
			var old;
			try { old = JSON.parse(load(SAVED_KEY) || 'null'); } catch (e) { old = null; }
			if (old && old.kind && old.label) { list.push({ name: 'Me', kind: old.kind, label: old.label, date: old.date }); }
		}
		return list;
	}
	function savePerson(name, kind, label) {
		name = String(name || '').trim().slice(0, 24) || 'Me';
		var list = people().filter(function (x) { return !(x.kind === kind && x.name.toLowerCase() === name.toLowerCase()); });
		list.push({ name: name, kind: kind, label: label, date: new Date().toISOString().slice(0, 10) });
		store(PEOPLE_KEY, JSON.stringify(list));
		return name;
	}
	function removePerson(name, kind) {
		store(PEOPLE_KEY, JSON.stringify(people().filter(function (x) { return !(x.kind === kind && x.name === name); })));
	}
	function escHtml(t) {
		return String(t).replace(/[&<>"']/g, function (c) { return { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]; });
	}
	function ringByLabel(label) {
		for (var i = 0; i < data.rings.length; i++) { if ('US ' + data.rings[i].us === label) { return data.rings[i]; } }
		return null;
	}
	function bangleByLabel(label) {
		for (var i = 0; i < data.bangles.length; i++) { if ('Size ' + data.bangles[i].label === label) { return data.bangles[i]; } }
		return null;
	}

	// Save / share / chart buttons under a result.
	var lastName = 'Me';
	function resultActions(kind, label, shareText) {
		// Absolute links: inside the embeddable widget a relative link would point at the host site.
		var home = data.home || '';
		var chart = home + (kind === 'bangle' ? '/bangle-size-chart/' : '/ring-size-chart/');
		return '<div class="rbs-save-row">' +
			'<label class="rbs-name-label">Whose size? <input type="text" class="rbs-name" maxlength="24" value="' + escHtml(lastName) + '" autocomplete="off"></label>' +
			'<button type="button" class="rbs-btn rbs-save" data-kind="' + kind + '" data-label="' + label + '">Save</button>' +
			'</div>' +
			'<div class="rbs-actions">' +
			'<button type="button" class="rbs-btn secondary rbs-card-btn">Size card</button>' +
			'<button type="button" class="rbs-btn secondary rbs-share" data-text="' + shareText.replace(/"/g, '&quot;') + '">Share</button>' +
			'<a class="rbs-chart-link" href="' + chart + '">Full size chart →</a>' +
			'</div>' +
			'<p class="rbs-gift"><a href="' + home + '/blog/find-ring-size-secretly/">Sizing someone else for a surprise? Find their size secretly →</a></p>';
	}
	// onSaved(): called after a save so the panel can refresh its saved-size chips.
	// card: { kind, title, big, rows: [[k, v]…] } for the downloadable size card.
	function wireActions(box, onSaved, card) {
		var save = $('.rbs-save', box);
		var nameIn = $('.rbs-name', box);
		if (nameIn) { nameIn.addEventListener('input', function () { lastName = nameIn.value; }); }
		if (save) {
			save.addEventListener('click', function () {
				var who = savePerson(nameIn ? nameIn.value : 'Me', save.getAttribute('data-kind'), save.getAttribute('data-label'));
				save.textContent = 'Saved ✓';
				if (onSaved) { onSaved(who); }
			});
		}
		var cardBtn = $('.rbs-card-btn', box);
		if (cardBtn && card) {
			cardBtn.addEventListener('click', function () { sizeCard(card, nameIn ? nameIn.value : ''); });
		}
		var share = $('.rbs-share', box);
		if (share) {
			share.addEventListener('click', function () {
				var text = share.getAttribute('data-text');
				var url = location.origin + location.pathname;
				if (navigator.share) {
					navigator.share({ title: document.title, text: text, url: url }).catch(function () {});
				} else {
					window.open('https://wa.me/?text=' + encodeURIComponent(text + ' ' + url), '_blank', 'noopener');
				}
			});
		}
	}

	// Small drawing: a card held against a phone (upright) or a laptop screen.
	function cardArt(upright) {
		return upright
			? '<svg class="rbs-art" width="56" height="72" viewBox="0 0 56 72" aria-hidden="true"><rect x="8" y="2" width="40" height="68" rx="7" fill="#fff" stroke="#9ca3af" stroke-width="2"/><rect x="15" y="14" width="26" height="42" rx="3" fill="#fde68a" stroke="#b45309" stroke-width="1.5"/><rect x="18" y="18" width="6" height="5" rx="1" fill="#b45309"/><path d="M15 14v42" stroke="#1d4ed8" stroke-width="2" stroke-dasharray="3 2"/><path d="M41 14v42" stroke="#1d4ed8" stroke-width="2" stroke-dasharray="3 2"/></svg>'
			: '<svg class="rbs-art" width="72" height="56" viewBox="0 0 72 56" aria-hidden="true"><rect x="2" y="4" width="68" height="44" rx="4" fill="#fff" stroke="#9ca3af" stroke-width="2"/><rect x="16" y="13" width="40" height="26" rx="3" fill="#fde68a" stroke="#b45309" stroke-width="1.5"/><rect x="20" y="17" width="7" height="5" rx="1" fill="#b45309"/><path d="M16 13v26M56 13v26" stroke="#1d4ed8" stroke-width="2" stroke-dasharray="3 2"/><path d="M26 52h20" stroke="#9ca3af" stroke-width="2"/></svg>';
	}

	function savedLine() {
		return '<div class="rbs-saved" aria-live="polite"></div>';
	}
	// Saved sizes as chips: tap a name to show that size, × to forget it.
	// find(label) returns the slider index or -1; go(i) moves the slider there.
	function wireSaved(panel, kind, find, go) {
		var box = $('.rbs-saved', panel);
		function paint() {
			var list = people().filter(function (x) { return x.kind === kind; });
			if (!list.length) { box.innerHTML = ''; return; }
			box.innerHTML = '<span class="rbs-saved-t">Saved sizes:</span> ' + list.map(function (x) {
				return '<span class="rbs-chip"><button type="button" class="rbs-chip-show" data-label="' + escHtml(x.label) + '">' + escHtml(x.name) + ' · ' + escHtml(x.label.replace('Size ', '')) + '</button>' +
					'<button type="button" class="rbs-chip-x" data-name="' + escHtml(x.name) + '" aria-label="Forget ' + escHtml(x.name) + '">×</button></span>';
			}).join(' ');
			box.querySelectorAll('.rbs-chip-show').forEach(function (b) {
				b.addEventListener('click', function () {
					var i = find(b.getAttribute('data-label'));
					if (i >= 0) { go(i); }
				});
			});
			box.querySelectorAll('.rbs-chip-x').forEach(function (b) {
				b.addEventListener('click', function () { removePerson(b.getAttribute('data-name'), kind); paint(); });
			});
		}
		paint();
		return paint;
	}

	/* Size card: a 1080×1350 PNG drawn on a canvas, shared as a file where the
	 * phone allows it (WhatsApp etc.), otherwise downloaded. */
	function sizeCard(card, name) {
		var W = 1080, H = 1350;
		var c = document.createElement('canvas');
		c.width = W; c.height = H;
		var g = c.getContext('2d');
		if (!g) { return; }
		var F = '-apple-system, "Segoe UI", Roboto, Arial, sans-serif';
		var grd = g.createLinearGradient(0, 0, 0, H);
		grd.addColorStop(0, '#eff6ff'); grd.addColorStop(0.5, '#ffffff');
		g.fillStyle = grd; g.fillRect(0, 0, W, H);
		// logo mark
		g.lineWidth = 11;
		g.strokeStyle = '#1d4ed8'; g.beginPath(); g.arc(130, 140, 44, 0, Math.PI * 2); g.stroke();
		g.strokeStyle = '#d4a017'; g.beginPath(); g.arc(176, 148, 28, 0, Math.PI * 2); g.stroke();
		g.fillStyle = '#111827'; g.font = '800 46px ' + F; g.textBaseline = 'middle';
		g.fillText('Ring Bangle', 236, 142);
		g.fillStyle = '#1d4ed8'; g.fillText('Sizer', 236 + g.measureText('Ring Bangle ').width, 142);
		// title + big size
		name = String(name || '').trim();
		var who = !name || name.toLowerCase() === 'me' ? 'My' : name + '\u2019s';
		g.textBaseline = 'alphabetic';
		var head = who + ' ' + card.title, hs = 52;
		g.font = '600 ' + hs + 'px ' + F;
		while (hs > 30 && g.measureText(head).width > W - 180) { hs -= 2; g.font = '600 ' + hs + 'px ' + F; }
		g.fillStyle = card.title.indexOf('approximate') === 0 ? '#92400e' : '#4b5563';
		g.fillText(head, 90, 330);
		g.fillStyle = '#111827'; g.font = '800 ' + (card.big.length > 9 ? 150 : 190) + 'px ' + F;
		g.fillText(card.big, 84, 520);
		// rows
		var y = 640;
		card.rows.forEach(function (r, i) {
			g.fillStyle = i % 2 ? '#ffffff' : '#f3f6fb';
			g.fillRect(84, y - 58, W - 168, 88);
			g.fillStyle = '#4b5563'; g.font = '500 40px ' + F; g.fillText(r[0], 116, y);
			g.fillStyle = '#111827'; g.font = '700 42px ' + F;
			g.fillText(r[1], W - 116 - g.measureText(r[1]).width, y);
			y += 88;
		});
		// footer
		g.fillStyle = '#111827'; g.fillRect(0, H - 170, W, 170);
		g.fillStyle = '#ffffff'; g.font = '600 38px ' + F;
		g.fillText('Measured free on screen at', 90, H - 98);
		g.fillStyle = '#fde68a'; g.font = '800 46px ' + F;
		g.fillText('ringbanglesizer.com', 90, H - 44);
		g.fillStyle = '#9ca3af'; g.font = '500 30px ' + F;
		var d = new Date().toISOString().slice(0, 10);
		g.fillText(d, W - 90 - g.measureText(d).width, H - 44);

		var file = (card.kind === 'bangle' ? 'bangle' : 'ring') + '-size-card.png';
		c.toBlob(function (blob) {
			if (!blob) { return; }
			var f = null;
			try { f = new File([blob], file, { type: 'image/png' }); } catch (e) { f = null; }
			if (f && navigator.canShare && navigator.canShare({ files: [f] }) && navigator.share) {
				navigator.share({ files: [f], title: card.title }).catch(function () {});
				return;
			}
			var a = document.createElement('a');
			a.href = URL.createObjectURL(blob);
			a.download = file;
			document.body.appendChild(a);
			a.click();
			setTimeout(function () { URL.revokeObjectURL(a.href); a.remove(); }, 1000);
		}, 'image/png');
	}

	/* "Will it fit?": read a size the way shops write it and compare it with
	 * a size measured here. Returns { mm, text } (inner diameter) or null. */
	var UK_LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	function ringMmFromUs(us) {
		var R = data.rings;
		if (us <= R[0].us) { return R[0].mm + (us - R[0].us) * 0.81; }
		for (var i = 1; i < R.length; i++) {
			if (us <= R[i].us) {
				var t = (us - R[i - 1].us) / (R[i].us - R[i - 1].us);
				return R[i - 1].mm + t * (R[i].mm - R[i - 1].mm);
			}
		}
		return R[R.length - 1].mm + (us - R[R.length - 1].us) * 0.81;
	}
	// "6¾" → "6 3/4" so one fraction rule reads both.
	function plainFractions(s) {
		return s.replace(/\s*¼/g, ' 1/4').replace(/\s*½/g, ' 1/2').replace(/\s*¾/g, ' 3/4').replace(/\s+/g, ' ').trim();
	}
	// "6", "6.5", "6 3/4", "3/4" → number, or NaN.
	function readNumber(s) {
		var m = s.match(/(\d+(?:\.\d+)?)?\s*(?:(\d)\s*\/\s*(\d))?/);
		if (!m || (!m[1] && !m[2])) { return NaN; }
		var n = m[1] ? parseFloat(m[1]) : 0;
		if (m[2] && parseInt(m[3], 10) > 0) { n += parseInt(m[2], 10) / parseInt(m[3], 10); }
		return n;
	}
	function usText(n) {
		var w = Math.floor(n), q = Math.round((n - w) * 4);
		return 'US ' + w + (['', '¼', '½', '¾'][q] || '');
	}
	function ukByLetter(label) {
		for (var i = 0; i < data.uk.length; i++) { if (data.uk[i].uk === label) { return data.uk[i].mm; } }
		return 0;
	}
	function ringAround(name, n) {
		var circ = n + 40;
		return { mm: circ / Math.PI, text: name + ' ' + n + ' (' + fmt(circ) + ' mm around, ' + fmt(circ / Math.PI) + ' mm across)' };
	}
	function parseRing(raw) {
		var s = plainFractions(String(raw || '').toLowerCase().replace(/size|ring/g, ' '));
		if (!s) { return null; }
		var m = s.match(/(\d+(?:\.\d+)?)\s*(mm|cm)\b/);
		if (m) {
			var v = parseFloat(m[1]) * (m[2] === 'cm' ? 10 : 1);
			if (v >= 12 && v <= 26) { return { mm: v, text: fmt(v) + ' mm inner diameter' }; }
			if (v >= 38 && v <= 82) { return { mm: v / Math.PI, text: fmt(v) + ' mm around (' + fmt(v / Math.PI) + ' mm across)' }; }
			return null;
		}
		m = s.match(/^(?:uk\s*)?z\s*\+\s*(\d)$/);
		if (m) { var zd = 21.8 + 0.4 * parseInt(m[1], 10); return { mm: zd, text: 'UK Z+' + m[1] + ' (' + fmt(zd) + ' mm)' }; }
		m = s.match(/^(?:uk|au|aus|nz|ie)?\s*([a-z])\s*(1\/2)?$/);
		if (m) {
			var letter = m[1].toUpperCase() + (m[2] ? '½' : '');
			var ud = ukByLetter(letter);
			if (!ud) { // letters outside the chart (A–E): about 0.4 mm a letter from J½ = 15.7 mm
				ud = 15.7 + (UK_LETTERS.indexOf(m[1].toUpperCase()) + (m[2] ? 0.5 : 0) - 9.5) * 0.407;
			}
			return { mm: ud, text: 'UK ' + letter + ' (' + fmt(ud) + ' mm)' };
		}
		// Scale words. Italy, Spain and Switzerland number rings as circumference − 40 mm;
		// Germany often gives the inner diameter in mm; France and the EU the full circumference.
		var sys = '';
		if (/\b(it|ita|italy|italian|es|spain|spanish|ch|swiss|switzerland)\b/.test(s)) { sys = 'it'; }
		else if (/\b(de|ger|german|germany)\b/.test(s)) { sys = 'de'; }
		else if (/\b(eu|iso|fr|france|french|europe|european)\b/.test(s)) { sys = 'eu'; }
		else if (/\b(jp|japan|japanese)\b/.test(s)) { sys = 'jp'; }
		else if (/\b(india|indian|in|ind|pk|pak|pakistan|pakistani)\b/.test(s)) { sys = 'in'; }
		else if (/\b(us|usa|ca|canada)\b/.test(s)) { sys = 'us'; }
		var n = readNumber(s.replace(/[a-z]+/g, ' ').trim());
		if (isNaN(n) || n <= 0) { return null; }
		var guess = '';
		if (!sys) {
			var frac = n - Math.floor(n);
			var quarter = Math.abs(frac * 4 - Math.round(frac * 4)) < 1e-6;
			if (n >= 12 && n <= 26 && frac > 0 && (!quarter || n > 15.75)) {
				// "17.3": a decimal that is not a quarter size is a diameter in mm.
				return { mm: n, text: fmt(n) + ' mm inner diameter' };
			}
			// A bare number is read in the system the visitor picked in the result, then by its range.
			if (ringSystem === 'in' && frac === 0 && n <= 40) { sys = 'in'; }
			else if (ringSystem === 'eu' && frac === 0 && n <= 35) { sys = 'it'; }
			else { sys = n <= 16 ? 'us' : (n < 38 ? 'in' : 'eu'); }
			guess = ' (type a country, e.g. "US 7" or "EU 54", if that is wrong)';
		}
		var res;
		if (sys === 'it' || sys === 'eu') {
			// Italian / Spanish / Swiss numbers run 1–35; a number from 38 up is the full circumference.
			res = n < 38 ? ringAround('Italy / Spain / Switzerland', n) : { mm: n / Math.PI, text: 'EU ' + n + ' (' + fmt(n) + ' mm around, ' + fmt(n / Math.PI) + ' mm across)' };
		}
		else if (sys === 'de') {
			if (n >= 14 && n <= 25) { res = { mm: n, text: 'German ' + n + ' (' + fmt(n) + ' mm inner diameter)' }; }
			else if (n >= 38 && n <= 82) { res = { mm: n / Math.PI, text: 'German ' + n + ' (' + fmt(n) + ' mm around, ' + fmt(n / Math.PI) + ' mm across)' }; }
			else { return null; }
		}
		else if (sys === 'jp') { var jd = 13 + (n - 1) / 3; res = { mm: jd, text: 'Japan ' + n + ' (' + fmt(jd) + ' mm)' }; }
		else if (sys === 'in') { res = ringAround('India', n); }
		else { var usd = ringMmFromUs(n); res = { mm: usd, text: usText(n) + ' (' + fmt(usd) + ' mm)' }; }
		res.text += guess;
		return res;
	}
	function parseBangle(raw) {
		var s = plainFractions(String(raw || '').toLowerCase().replace(/size|bangle|kada|chudi|chura|choori/g, ' ').replace(/⅛/g, ' 1/8').replace(/⅜/g, ' 3/8').replace(/⅝/g, ' 5/8').replace(/⅞/g, ' 7/8'));
		if (!s) { return null; }
		var m = s.match(/(\d+(?:\.\d+)?)\s*(mm|cm)\b/);
		if (m) {
			var v = parseFloat(m[1]) * (m[2] === 'cm' ? 10 : 1);
			if (v >= 35 && v <= 95) { return { mm: v, text: fmt(v) + ' mm inner diameter' }; }
			if (v > 110 && v < 300) { return { mm: v / Math.PI, text: fmt(v) + ' mm around (' + fmt(v / Math.PI) + ' mm across)' }; }
			return null;
		}
		// Inches with a fraction: "2 1/4", "2 1/4 in", "2 6/16".
		m = s.match(/^([1-3])\s+(\d{1,2})\s*\/\s*(\d{1,2})\s*(?:in|inch|inches|")?$/);
		if (m && parseInt(m[3], 10) > 0) {
			var fin = parseInt(m[1], 10) + parseInt(m[2], 10) / parseInt(m[3], 10);
			return { mm: fin * MM_IN, text: m[1] + ' ' + m[2] + '/' + m[3] + ' in (' + fmt(fin * MM_IN) + ' mm)' };
		}
		// Indian notation is inches + sixteenths ("2.6" = 2 6/16 in), so it only starts with 1–3
		// and the part after the dot is 0–15. "6.2" is cm and "2.75" is decimal inches (below).
		m = s.match(/^([1-3])\s*([.\/\-:])\s*(\d{1,2})$/);
		if (m && parseInt(m[3], 10) <= 15) {
			var six = parseInt(m[3], 10);
			var note = '';
			// "2.1" is how many shops shorten 2.10 (there is no 2 1/16 size).
			if (m[3] === '1' && m[2] === '.') { six = 10; note = ' (read as ' + m[1] + '.10 = ' + m[1] + ' 10/16 in)'; }
			var lab = m[1] + '.' + six;
			for (var i = 0; i < data.bangles.length; i++) {
				if (data.bangles[i].label === lab) { return { mm: data.bangles[i].mm, text: 'Indian size ' + lab + ' (' + fmt(data.bangles[i].mm) + ' mm)' + note }; }
			}
			var inch = parseInt(m[1], 10) + six / 16;
			if (six % 2) { note += '. ' + lab + ' is not a standard size (sizes go up in 2/16 in), so check the label with the shop'; }
			return { mm: inch * MM_IN, text: 'Indian size ' + lab + ' (' + m[1] + ' ' + six + '/16 in = ' + fmt(inch * MM_IN) + ' mm)' + note };
		}
		m = s.match(/([\d.]+)\s*(in|inch|")?/);
		if (m) {
			var x = parseFloat(m[1]);
			if (x >= 1.4 && x <= 3.6) { return { mm: x * MM_IN, text: x + ' in (' + fmt(x * MM_IN) + ' mm)' }; }
			if (x >= 4.5 && x <= 9) { return { mm: x * 10, text: x + ' cm (' + fmt(x * 10) + ' mm)' }; }
		}
		return null;
	}
	function fitVerdict(kind, shopMm, myMm) {
		var d = shopMm - myMm;
		if (kind === 'ring') {
			// one US size is about 0.8 mm of diameter
			var sizes = Math.max(1, Math.round(Math.abs(d) / 0.4) / 2);
			var n = String(sizes).replace('.5', '½') + ' size' + (sizes === 1 ? '' : 's');
			if (Math.abs(d) <= 0.2) { return ['ok', 'Fits: same size.']; }
			if (d > 0 && d <= 0.6) { return ['warn', 'A little loose (about ½ size bigger). Fine for wide bands or a big knuckle.']; }
			if (d < 0 && d >= -0.6) { return ['warn', 'A little tight (about ½ size smaller). Pick the next size up if you can.']; }
			return ['bad', d > 0 ? 'Too big: about ' + n + ' larger.' : 'Too small: about ' + n + ' smaller.'];
		}
		if (d >= -0.5 && d <= 1.8) { return ['ok', 'Fits: it should slide over the hand and sit well.']; }
		if (d > 1.8 && d <= 4) { return ['warn', 'Loose: it will slide over easily but move around on the wrist.']; }
		if (d < -0.5 && d >= -2) { return ['warn', 'Tight: it may not pass over the knuckles. Choose the next size up.']; }
		return ['bad', d > 0 ? 'Too big: it may slip off the hand.' : 'Too small: it will not go over the hand.'];
	}
	// The "Will it fit?" panel. getCurrent() returns { label, mm } of the size shown in the tool.
	function renderFit(root, kind, getCurrent) {
		var panel = el('div', { 'class': 'rbs-panel rbs-fit' });
		var eg = kind === 'ring' ? 'e.g. UK O, EU 54, 7.5 or 17.3 mm' : 'e.g. 2.6, 2/8 or 6.2 cm';
		panel.innerHTML =
			'<h2 class="rbs-h">Will it fit? Check a shop\'s size</h2>' +
			'<p class="rbs-muted">Type the size from the product page and see how it compares.</p>' +
			'<div class="rbs-fit-row"><input type="text" class="rbs-fit-val" placeholder="' + eg + '" aria-label="Size on the shop page" autocomplete="off">' +
			'<label class="rbs-fit-who-l">for <select class="rbs-fit-who"></select></label></div>' +
			'<div class="rbs-fit-out" aria-live="polite"></div>';
		var input = $('.rbs-fit-val', panel), who = $('.rbs-fit-who', panel), out = $('.rbs-fit-out', panel);
		function fillWho() {
			var keep = who.value;
			var list = people().filter(function (x) { return x.kind === kind; });
			who.innerHTML = '<option value="">the size above</option>' + list.map(function (x) {
				return '<option value="' + escHtml(x.label) + '">' + escHtml(x.name) + ' (' + escHtml(x.label.replace('Size ', '')) + ')</option>';
			}).join('');
			if (keep) { who.value = keep; }
		}
		function check() {
			var shop = (kind === 'ring' ? parseRing : parseBangle)(input.value);
			if (!input.value.trim()) { out.innerHTML = ''; return; }
			if (!shop) { out.innerHTML = '<p class="rbs-fit-res bad">Could not read that size. Try ' + eg + '.</p>'; return; }
			var mine = who.value
				? (kind === 'ring' ? ringByLabel(who.value) : bangleByLabel(who.value))
				: getCurrent();
			var myLabel = who.value ? who.value : (mine && mine.label);
			if (!mine) { out.innerHTML = ''; return; }
			var v = fitVerdict(kind, shop.mm, mine.mm);
			out.innerHTML = '<p class="rbs-fit-res ' + v[0] + '"><strong>' + v[1] + '</strong></p>' +
				'<p class="rbs-note">Shop size read as ' + escHtml(shop.text) + '. Compared with ' + escHtml(myLabel) + ' (' + fmt(mine.mm) + ' mm). Different brands can vary by about ¼ size.</p>';
		}
		input.addEventListener('input', check);
		who.addEventListener('change', check);
		fillWho();
		root.appendChild(panel);
		return { refresh: function () { fillWho(); check(); } };
	}

	function scrollToNext(panel) {
		var next = panel.nextElementSibling;
		if (next && next.scrollIntoView) {
			next.scrollIntoView({ behavior: 'smooth', block: 'start' });
		}
	}

	/* --------------------------------------------------------- calibration */

	// Coins for calibrating without a card (official diameters).
	var COINS = [
		{ id: 'in10', name: 'India ₹10 coin', short: '₹10', mm: 27 },
		{ id: 'pk10', name: 'Pakistan Rs 10 coin', short: 'Rs 10', mm: 25.5 },
		{ id: 'us25', name: 'US quarter (25¢)', short: '25¢', mm: 24.26 },
		{ id: 'uk10p', name: 'UK 10p coin', short: '10p', mm: 24.5 },
		{ id: 'eu2', name: '€2 coin', short: '€2', mm: 25.75 }
	];
	function defaultCoin() {
		var langs = (navigator.languages || [navigator.language || '']).join(',').toLowerCase();
		if (/-pk\b|\bur\b/.test(langs)) { return 'pk10'; }
		return { in: 'in10', uk: 'uk10p', eu: 'eu2' }[guessSystem()] || 'us25';
	}

	function renderCalibration(root, onDone) {
		var panel = el('div', { 'class': 'rbs-panel rbs-cal' });
		var badge = calibrated
			? '<span class="rbs-badge ok">Screen calibrated</span>'
			: '<span class="rbs-badge">Not calibrated – sizes approximate</span>';
		panel.innerHTML =
			'<div class="rbs-cal-status"><h2 class="rbs-h">Step 1: Calibrate your screen</h2>' + badge + '</div>' +
			'<div class="rbs-cal-intro"><span class="rbs-art-wrap"></span><p class="rbs-muted rbs-cal-help"></p></div>' +
			'<div class="rbs-cal-mode"><button type="button" class="rbs-link rbs-coin-toggle">No card? Use a coin</button>' +
			'<select class="rbs-coin-sel rbs-hidden" aria-label="Coin">' + COINS.map(function (c) {
				return '<option value="' + c.id + '"' + (c.id === defaultCoin() ? ' selected' : '') + '>' + c.name + ' – ' + c.mm + ' mm</option>';
			}).join('') + '</select></div>' +
			// Slider sits above the card: the card grows downwards, so the −/+ buttons stay under the finger.
			'<div class="rbs-slider-row"><button type="button" class="rbs-step" data-d="-1" aria-label="Smaller">−</button>' +
			'<input type="range" min="2" max="12" step="0.01" value="' + ppm + '" aria-label="Card outline size">' +
			'<button type="button" class="rbs-step" data-d="1" aria-label="Larger">+</button></div>' +
			'<div class="rbs-card-stage"><div class="rbs-card"></div></div>' +
			'<div class="rbs-btn-row"><button type="button" class="rbs-btn rbs-cal-save">Save calibration</button>' +
			'<button type="button" class="rbs-link rbs-cal-toggle">' + (calibrated ? 'Hide' : 'Skip for now (sizes will be approximate)') + '</button></div>';

		var card = $('.rbs-card', panel);
		var range = $('input[type=range]', panel);
		var stage = $('.rbs-card-stage', panel);
		var help = $('.rbs-cal-help', panel);
		var upright = null;
		var coin = null; // null = card mode
		var coinSel = $('.rbs-coin-sel', panel);
		var coinToggle = $('.rbs-coin-toggle', panel);
		function coinById(id) { for (var i = 0; i < COINS.length; i++) { if (COINS[i].id === id) { return COINS[i]; } } return COINS[0]; }
		coinToggle.addEventListener('click', function () {
			coin = coin ? null : coinById(coinSel.value);
			coinSel.classList.toggle('rbs-hidden', !coin);
			coinToggle.textContent = coin ? 'Use a card instead (more accurate)' : 'No card? Use a coin';
			upright = null;
			draw();
		});
		coinSel.addEventListener('change', function () { coin = coinById(coinSel.value); upright = null; draw(); });

		function draw() {
			if (coin) {
				if (upright !== 'coin') {
					upright = 'coin';
					help.innerHTML = 'Lay a <strong>' + coin.name + '</strong> flat on the screen inside the circle. Drag the slider until the dashed circle is exactly the size of the coin.';
					card.textContent = coin.short;
					card.classList.add('coin');
					card.classList.remove('upright');
					$('.rbs-art-wrap', panel).innerHTML = '';
				}
				card.style.width = card.style.height = (ppm * coin.mm) + 'px';
				range.setAttribute('aria-valuetext', fmt(ppm * 25.4, 0) + ' pixels per inch');
				return;
			}
			card.classList.remove('coin');
			if (upright === 'coin') { upright = null; }
			// A bank card (85.6 mm) is wider than a phone screen (~65–70 mm), so on narrow
			// screens the card is held upright and its short side (53.98 mm) is matched.
			// The outline is always drawn at true size; it never shrinks to fit.
			var isUpright = stage.clientWidth < 480;
			if (isUpright !== upright) {
				upright = isUpright;
				help.innerHTML = upright
					? 'Hold any credit, debit or ID card <strong>upright</strong> against the screen. Drag the slider until the dashed outline is exactly as wide as the card\'s <strong>short side</strong>.'
					: 'Hold any credit, debit or ID card against the screen. Drag the slider until the dashed outline is exactly the width of the card.';
				card.textContent = upright ? 'Match the card\'s short side' : 'Match the card width';
				card.classList.toggle('upright', upright);
				$('.rbs-art-wrap', panel).innerHTML = cardArt(upright);
			}
			var w = ppm * (upright ? CARD_SHORT_MM : CARD_MM);
			var h = ppm * (upright ? CARD_MM : CARD_SHORT_MM);
			card.style.width = w + 'px';
			card.style.height = h + 'px';
			range.setAttribute('aria-valuetext', fmt(ppm * 25.4, 0) + ' pixels per inch');
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
			store(DPR_KEY, String(window.devicePixelRatio || 1));
			$('.rbs-badge', panel).outerHTML = '<span class="rbs-badge ok">Screen calibrated</span>';
			$('.rbs-cal-toggle', panel).textContent = 'Hide';
			collapse(true);
			onDone();
			setStep(root, 2);
			scrollToNext(panel);
		});
		var body = Array.prototype.slice.call(panel.children, 1);
		function collapse(yes) {
			body.forEach(function (c) { c.classList.toggle('rbs-hidden', yes); });
			var t = el('button', { type: 'button', 'class': 'rbs-btn secondary rbs-cal-reopen' }, 'Re-calibrate');
			var old = $('.rbs-cal-reopen', panel);
			if (old) { old.remove(); }
			if (yes) {
				t.addEventListener('click', function () { collapse(false); setStep(root, 1); });
				panel.appendChild(t);
			}
		}
		$('.rbs-cal-toggle', panel).addEventListener('click', function () {
			collapse(true);
			setStep(root, 2);
			scrollToNext(panel);
		});
		root.appendChild(panel);
		draw();
		if (calibrated) { collapse(true); }
		window.addEventListener('resize', draw);
		onScale(function () { range.value = ppm; draw(); });
	}

	/* --------------------------------------------------------- circle stage */

	// Keep a circle stage as tall as its largest size needs, so the slider under it never moves.
	function reserveStage(stage, maxMm) {
		var px = maxMm * ppm;
		var tip = px > stage.clientWidth - 4 ? 90 : 0; // room for the 2–3 line "wider than your screen" hint
		stage.style.minHeight = Math.max(260, Math.max(px + 40, 220) + 26 + tip) + 'px';
	}

	function circleStage(mm, label, stageWidth) {
		var px = mm * ppm;
		var size = Math.max(px + 40, 220);
		var wide = stageWidth && px > stageWidth - 4;
		var svg =
			'<svg width="' + size + '" height="' + size + '" viewBox="0 0 ' + size + ' ' + size + '" aria-hidden="true">' +
			'<circle class="rbs-circle-inner" cx="' + size / 2 + '" cy="' + size / 2 + '" r="' + px / 2 + '"/>' +
			'<circle class="rbs-circle" cx="' + size / 2 + '" cy="' + size / 2 + '" r="' + px / 2 + '"/>' +
			'<line class="rbs-center" x1="' + (size / 2 - 6) + '" y1="' + size / 2 + '" x2="' + (size / 2 + 6) + '" y2="' + size / 2 + '"/>' +
			'<line class="rbs-center" x1="' + size / 2 + '" y1="' + (size / 2 - 6) + '" x2="' + size / 2 + '" y2="' + (size / 2 + 6) + '"/>' +
			'</svg><div class="rbs-stage-label">' + label + '</div>';
		if (wide) {
			svg += '<div class="rbs-stage-tip">Wider than your screen: let the bangle hang over the sides and line up the <strong>top and bottom</strong> of the circle with its inside edge.</div>';
		}
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
			// "<=": exactly between two sizes gives the larger one (the site's own advice).
			var d = Math.abs(r.mm - mm);
			if (d <= bd + 1e-9) { bd = d; best = r; }
		});
		return best;
	}
	function nearestBangleUp(mm) {
		for (var i = 0; i < data.bangles.length; i++) {
			// The first size at least as wide as the hand (0.05 mm only absorbs rounding).
			if (data.bangles[i].mm >= mm - 0.05) { return data.bangles[i]; }
		}
		return data.bangles[data.bangles.length - 1];
	}

	/* Range checks for typed measurements (all in mm). Outside the range the
	 * tool shows a warning instead of a confident size. */
	var RANGES = {
		ring: [11, 26],      // ring inner diameter
		hand: [100, 300],    // hand circumference for bangles (10–30 cm)
		wrist: [100, 280]    // wrist circumference (10–28 cm)
	};
	function inRange(kind, mm) { return mm >= RANGES[kind][0] && mm <= RANGES[kind][1]; }
	function rangeWarning(what) {
		return '<p class="rbs-fit-res bad">That looks outside the normal range for ' + what + '. Check the unit (mm / cm / inch).</p>';
	}
	// When the unit select changes, convert the number already typed instead of re-reading it in the new unit.
	function convertOnUnitChange(input, select, toMm) {
		var prev = select.value;
		select.addEventListener('change', function () {
			var v = parseFloat(input.value);
			if (v) {
				var mm = toMm(v, prev);
				var back = toMm(1, select.value);
				var nv = mm / back;
				var dp = nv < 5 ? 2 : 1; // inches need two decimals (0.68 in), mm and cm one
				input.value = String(Math.round(nv * Math.pow(10, dp)) / Math.pow(10, dp));
			}
			prev = select.value;
		}, true);
	}

	// Unique ids so each <label for> points at its own input, even with two tools on a page.
	var uidN = 0;
	function uid(p) { uidN += 1; return 'rbs-' + p + '-' + uidN; }
	// Uncalibrated + read off the screen = approximate. Typed measurements are never approximate.
	function approxPre(ax) { return ax ? '<span class="rbs-big-pre">Approximate:</span> ' : ''; }

	function approxNote() {
		return calibrated ? '' : '<p class="rbs-note rbs-approx">⚠ Screen not calibrated: the circle is approximate. Calibrate above for an exact result.</p>';
	}

	/* ------------------------------------------------------------- ring */

	function renderRing(root, method) {
		var idx = 8; // US 7
		var mmId = uid('ring-mm');
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Step 2: Find your ring size</h2>' + savedLine() +
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
			'<div class="rbs-field"><label for="' + mmId + '">Measurement</label><input type="number" step="0.1" min="10" max="80" class="rbs-mm-val" id="' + mmId + '" value="17.3" inputmode="decimal">' +
			'<select class="rbs-mm-type" aria-label="Measurement type"><option value="d">inner diameter (mm)</option><option value="c">inner circumference (mm)</option><option value="di">inner diameter (inch)</option></select></div>' +
			'</div>' +
			'<div class="rbs-result"></div>' + approxNote();

		var stage = $('.rbs-stage', panel);
		var range = $('input[type=range]', panel);
		var result = $('.rbs-result', panel);

		var lastRing = null, lastFromMm = false;
		function show(r, fromMm) {
			lastRing = r; lastFromMm = fromMm;
			var others = ['us', 'uk', 'eu', 'in'].filter(function (k) { return k !== ringSystem; })
				.map(function (k) { return ringIn(r, k); }).join(' · ');
			var picker = '<label class="rbs-sys">Show sizes for <select class="rbs-sys-sel">' +
				Object.keys(SYSTEMS).map(function (k) { return '<option value="' + k + '"' + (k === ringSystem ? ' selected' : '') + '>' + SYSTEMS[k] + '</option>'; }).join('') +
				'</select></label>';
			var ax = !fromMm && !calibrated;
			result.innerHTML =
				'<div class="rbs-result-top"><span class="rbs-kicker">' + (fromMm ? 'Closest ring size' : (ax ? 'Your ring size · screen not calibrated' : 'Your ring size')) + '</span>' + picker + '</div>' +
				'<div class="rbs-big">' + approxPre(ax) + ringIn(r, ringSystem) + '</div>' +
				'<div class="rbs-sub">= ' + others + ' · ' + fmt(r.mm) + ' mm inside</div>' +
				resultActions('ring', 'US ' + r.us, (ax ? 'My approximate ring size (screen not calibrated) is US ' : 'My ring size is US ') + r.us + ' / UK ' + r.uk + ' / EU ' + r.eu + ' / India ' + r.india + ' (' + fmt(r.mm) + ' mm inside diameter). Find yours free:') +
				'<details class="rbs-more"><summary>All sizes and measurements</summary>' +
				resultTable([
					['US / Canada', r.us],
					['UK / Australia / NZ', r.uk],
					['EU / ISO (circumference)', r.eu],
					['India / Pakistan', r.india],
					['Inner diameter', fmt(r.mm) + ' mm (' + fmt(r.mm / MM_IN, 2) + ' in)'],
					['Inner circumference', fmt(r.circ) + ' mm']
				]) + '</details>' +
				'<p class="rbs-note">After calibration the sizer is designed to be within about ±¼ size. Fingers swell in heat and in the evening; measure at room temperature.</p>';
			$('.rbs-sys-sel', result).addEventListener('change', function (e) {
				ringSystem = e.target.value;
				store(SYSTEM_KEY, ringSystem);
				show(lastRing, lastFromMm);
			});
			wireActions(result, function () { paintSaved(); if (fit) { fit.refresh(); } }, {
				kind: 'ring', title: ax ? 'approximate ring size' : 'ring size', big: ringIn(r, ringSystem),
				rows: [['US / Canada', String(r.us)], ['UK / Australia', r.uk], ['EU / ISO', String(r.eu)], ['India / Pakistan', String(r.india)], ['Inside diameter', fmt(r.mm) + ' mm'], ['Inside circumference', fmt(r.circ) + ' mm']]
			});
			if (fit) { fit.refresh(); }
		}
		function drawMatch() {
			var r = data.rings[idx];
			reserveStage(stage, data.rings[data.rings.length - 1].mm);
			stage.innerHTML = circleStage(r.mm, 'Inner diameter ' + fmt(r.mm) + ' mm · US ' + r.us, stage.clientWidth);
			range.setAttribute('aria-valuetext', 'US ' + r.us + ', UK ' + r.uk + ', ' + fmt(r.mm) + ' mm');
			show(r, false);
		}
		range.addEventListener('input', function () { idx = parseInt(range.value, 10); drawMatch(); setStep(root, 3); });
		panel.querySelectorAll('.rbs-m-match .rbs-step').forEach(function (b) {
			b.addEventListener('click', function () {
				idx = Math.min(data.rings.length - 1, Math.max(0, idx + parseInt(b.getAttribute('data-d'), 10)));
				range.value = idx; drawMatch(); setStep(root, 3);
			});
		});
		function ringToMm(v, t) { return t === 'c' ? v / Math.PI : (t === 'di' ? v * MM_IN : v); }
		function clearRing(html) {
			lastRing = null;
			result.innerHTML = html || '';
			if (fit) { fit.refresh(); }
		}
		function fromMm() {
			var v = parseFloat($('.rbs-mm-val', panel).value);
			var t = $('.rbs-mm-type', panel).value;
			if (isNaN(v)) { clearRing(); return; }
			var d = ringToMm(v, t);
			if (!inRange('ring', d)) { clearRing(rangeWarning('a ring (11–26 mm across, 35–82 mm around)')); return; }
			show(nearestRing(d), true);
		}
		convertOnUnitChange($('.rbs-mm-val', panel), $('.rbs-mm-type', panel), ringToMm);
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

		var fit = null;
		var paintSaved = wireSaved(panel, 'ring', function (label) {
			for (var i = 0; i < data.rings.length; i++) { if ('US ' + data.rings[i].us === label) { return i; } }
			return -1;
		}, function (i) {
			idx = i; range.value = i;
			$('.rbs-method[data-m="match"]', panel).click();
		});
		root.appendChild(panel);
		fit = renderFit(root, 'ring', function () { return lastRing ? { label: 'US ' + lastRing.us, mm: lastRing.mm } : null; });
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
		var handId = uid('hand');
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Step 2: Find your bangle size</h2>' + savedLine() +
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
			'<div class="rbs-field"><label for="' + handId + '">Hand circumference</label><input type="number" step="0.1" min="4" max="30" class="rbs-hand-val" id="' + handId + '" value="8" inputmode="decimal">' +
			'<select class="rbs-hand-unit" aria-label="Unit"><option value="in">inches</option><option value="cm">cm</option></select></div>' +
			'</div>' +
			'<div class="rbs-result"></div>' + approxNote();

		var stage = $('.rbs-stage', panel);
		var range = $('input[type=range]', panel);
		var result = $('.rbs-result', panel);

		var lastBangle = null;
		// extra is only passed by the hand measurement, which does not depend on the screen.
		function show(b, extra) {
			lastBangle = b;
			var ax = extra === undefined && !calibrated;
			result.innerHTML =
				'<div class="rbs-result-top"><span class="rbs-kicker">' + (ax ? 'Your bangle size · screen not calibrated' : 'Your bangle size') + '</span></div>' +
				'<div class="rbs-big">' + approxPre(ax) + 'Size ' + b.label + '</div>' +
				'<div class="rbs-sub">= ' + fmt(b.mm) + ' mm (' + fmt(b.inch, 3) + ' in) inside · ' + b.fit + '</div>' +
				resultActions('bangle', 'Size ' + b.label, (ax ? 'My approximate bangle size (screen not calibrated) is ' : 'My bangle size is ') + b.label + ' (' + fmt(b.mm) + ' mm inside diameter). Find yours free:') +
				'<details class="rbs-more"><summary>All measurements</summary>' +
				resultTable([
					['Indian bangle size', b.label],
					['Inner diameter', fmt(b.mm) + ' mm · ' + fmt(b.mm / 10, 2) + ' cm · ' + fmt(b.inch, 3) + ' in'],
					['Inner circumference', fmt(b.mm * Math.PI) + ' mm'],
					['Typical fit', b.fit]
				]) + '</details>' + (extra || '') +
				'<p class="rbs-note">Adult bangle sizes step by 2/16 inch (about 3.2 mm). If you are between sizes, choose the larger one for a bangle that slides over the hand.</p>';
			wireActions(result, function () { paintSaved(); if (fit) { fit.refresh(); } }, {
				kind: 'bangle', title: ax ? 'approximate bangle size' : 'bangle size', big: 'Size ' + b.label,
				rows: [['Indian size', b.label], ['Inside diameter', fmt(b.mm) + ' mm'], ['In centimetres', fmt(b.mm / 10, 2) + ' cm'], ['In inches', fmt(b.inch, 3) + ' in'], ['Inside circumference', fmt(b.mm * Math.PI) + ' mm'], ['Typical fit', b.fit]]
			});
			if (fit) { fit.refresh(); }
		}
		function drawMatch() {
			var b = data.bangles[idx];
			reserveStage(stage, data.bangles[data.bangles.length - 1].mm);
			stage.innerHTML = circleStage(b.mm, 'Inner diameter ' + fmt(b.mm) + ' mm · size ' + b.label, stage.clientWidth);
			range.setAttribute('aria-valuetext', 'Size ' + b.label + ', ' + fmt(b.mm) + ' mm');
			show(b);
		}
		range.addEventListener('input', function () { idx = parseInt(range.value, 10); drawMatch(); setStep(root, 3); });
		panel.querySelectorAll('.rbs-m-match .rbs-step').forEach(function (b) {
			b.addEventListener('click', function () {
				idx = Math.min(data.bangles.length - 1, Math.max(0, idx + parseInt(b.getAttribute('data-d'), 10)));
				range.value = idx; drawMatch(); setStep(root, 3);
			});
		});
		function handToMm(v, u) { return u === 'in' ? v * MM_IN : v * 10; }
		function fromHand() {
			var v = parseFloat($('.rbs-hand-val', panel).value);
			var u = $('.rbs-hand-unit', panel).value;
			if (isNaN(v)) { lastBangle = null; result.innerHTML = ''; if (fit) { fit.refresh(); } return; }
			var circMm = handToMm(v, u);
			if (!inRange('hand', circMm)) {
				lastBangle = null;
				result.innerHTML = rangeWarning('a hand (10–30 cm / 4–12 in around)');
				if (fit) { fit.refresh(); }
				return;
			}
			var d = circMm / Math.PI;
			var b = nearestBangleUp(d);
			var bi = data.bangles.indexOf(b);
			var lower = bi > 0 ? data.bangles[bi - 1] : null;
			// Hand only just over the size below: a soft glass chudi can be rolled on, rigid gold cannot.
			var roll = lower && d - lower.mm <= 1 && d <= b.mm
				? ' Very close to size ' + lower.label + ': a thin glass chudi can often be rolled on in ' + lower.label + ', but for a rigid gold bangle or kada buy ' + b.label + '.'
				: '';
			var top = data.bangles[data.bangles.length - 1];
			var over = d > top.mm + 0.3
				? ' That is larger than size ' + top.label + ' (' + fmt(top.mm) + ' mm), the biggest standard size: ask the jeweller for a made-to-order kada or an openable bangle.'
				: '';
			show(b, '<p class="rbs-note">Your hand circumference ' + fmt(circMm) + ' mm ≈ ' + fmt(d) + ' mm across. The bangle must be at least this wide inside.' + roll + over + ' Hands are not round, so this is an estimate: if you have a bangle that fits, use "Match a bangle I own" for a better result.</p>');
		}
		convertOnUnitChange($('.rbs-hand-val', panel), $('.rbs-hand-unit', panel), handToMm);
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
		var fit = null;
		var paintSaved = wireSaved(panel, 'bangle', function (label) {
			for (var i = 0; i < data.bangles.length; i++) { if ('Size ' + data.bangles[i].label === label) { return i; } }
			return -1;
		}, function (i) {
			idx = i; range.value = i;
			$('.rbs-method[data-m="match"]', panel).click();
		});

		root.appendChild(panel);
		fit = renderFit(root, 'bangle', function () { return lastBangle ? { label: 'Size ' + lastBangle.label, mm: lastBangle.mm } : null; });
		drawMatch();
		// After calibration only the "match" view depends on the screen scale.
		return function () {
			if (!$('.rbs-m-match', panel).classList.contains('rbs-hidden')) { drawMatch(); }
		};
	}

	/* --------------------------------------------------------- bracelet */

	function renderBracelet(root) {
		var wristId = uid('wrist'), typeId = uid('wrist-type');
		var panel = el('div', { 'class': 'rbs-panel' });
		panel.innerHTML =
			'<h2 class="rbs-h">Find your bracelet size</h2>' +
			'<p class="rbs-muted">Wrap a string or tape snugly around your wrist just below the wrist bone, then measure it.</p>' +
			'<div class="rbs-field"><label for="' + wristId + '">Wrist circumference</label><input type="number" step="0.1" min="3" max="30" class="rbs-wrist-val" id="' + wristId + '" value="6.5" inputmode="decimal">' +
			'<select class="rbs-wrist-unit" aria-label="Unit"><option value="in">inches</option><option value="cm">cm</option></select></div>' +
			'<div class="rbs-field"><label for="' + typeId + '">Bracelet type</label><select class="rbs-wrist-type" id="' + typeId + '">' +
			'<option value="chain">Chain / link bracelet</option><option value="bangle">Rigid bangle bracelet</option><option value="cuff">Open cuff</option></select></div>' +
			'<div class="rbs-result"></div>';
		var result = $('.rbs-result', panel);

		function calc() {
			var v = parseFloat($('.rbs-wrist-val', panel).value);
			var u = $('.rbs-wrist-unit', panel).value;
			var t = $('.rbs-wrist-type', panel).value;
			if (t === 'bangle') {
				// A rigid bangle has to pass over the folded hand, so the wrist cannot size it.
				result.innerHTML = '<p class="rbs-note"><strong>Rigid bangles are sized by the hand, not the wrist.</strong> A closed bangle has to slide over your folded hand, which is wider than your wrist.</p>' +
					'<p><a class="rbs-btn" href="' + (data.home || '') + '/bangle-size-calculator/">Use the bangle calculator →</a></p>';
				return;
			}
			if (isNaN(v)) { result.innerHTML = ''; return; }
			var inch = u === 'in' ? v : v / 2.54;
			if (!inRange('wrist', inch * MM_IN)) { result.innerHTML = rangeWarning('a wrist (10–28 cm / 4–11 in around)'); return; }
			var add = t === 'chain' ? [0.5, 0.75, 1.25] : [0.25, 0.5, 0.75];
			function both(x) { return fmt(x, 2) + ' in / ' + fmt(x * 2.54, 1) + ' cm'; }
			var rows = [
				['Your wrist', both(inch)],
				['Snug fit', both(inch + add[0])],
				['Comfortable fit (recommended)', both(inch + add[1])],
				['Loose fit', both(inch + add[2])]
			];
			result.innerHTML = '<div class="rbs-big">' + both(inch + add[1]) + '</div>' + resultTable(rows) +
				'<p class="rbs-note">Standard women\'s bracelets are 7 in (17.8 cm); men\'s are 8–8.5 in (20–21.5 cm).</p>';
		}
		convertOnUnitChange($('.rbs-wrist-val', panel), $('.rbs-wrist-unit', panel), function (x, unit) { return unit === 'in' ? x * MM_IN : x * 10; });
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
		// The steps list is server-rendered (inc/shortcodes.php) so nothing shifts on load; build it only if missing.
		var steps = $('.rbs-steps', container);
		if (!steps) {
			steps = el('ol', { 'class': 'rbs-steps' }, '<li>Calibrate</li><li>Match</li><li>Your size</li>');
			container.insertBefore(steps, body);
		}

		function mount(m) {
			body.innerHTML = '';
			tabs.forEach(function (t) { t.setAttribute('aria-selected', t.getAttribute('data-tab') === m ? 'true' : 'false'); });
			steps.classList.toggle('rbs-hidden', m === 'bracelet');
			if (m === 'bracelet') {
				redraw = renderBracelet(body);
				return;
			}
			renderCalibration(body, function () {
				body.querySelectorAll('.rbs-approx').forEach(function (n) { n.remove(); });
				redraw();
			});
			redraw = m === 'bangle' ? renderBangle(body) : renderRing(body, m === mode ? method : '');
			setStep(body, calibrated ? 2 : 1);
		}
		tabs.forEach(function (t) {
			t.addEventListener('click', function () { mount(t.getAttribute('data-tab')); });
		});
		mount(mode);
		body.classList.remove('rbs-pending'); // reserved height no longer needed once the tool is drawn
		onScale(function () { redraw(); });
	}

	function boot() {
		document.querySelectorAll('.rbs').forEach(init);
		checkZoom();
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', boot);
	} else {
		boot();
	}
})();
