#!/usr/bin/env node
/**
 * Renders share images (Open Graph, 1200x630) for every page in pages.json
 * into assets/img/og/<key>.png, and optionally Pinterest pins (1000x1500).
 *
 *   node tools/og/render.js              # og images
 *   node tools/og/render.js --pins DIR   # og images + pins into DIR
 *
 * Needs Node + Playwright (Chromium) + PHP CLI (size data comes from inc/sizes.php).
 * Key = page path without slashes ("/ring-size-chart/uk/" -> "ring-size-chart-uk", "/" -> "home"),
 * the same rule inc/site.php uses to find the image. Add new pages to pages.json and re-run.
 */
const fs = require('fs');
const path = require('path');
const { execFileSync } = require('child_process');
const { chromium } = require('playwright');

const ROOT = path.resolve(__dirname, '../..');
const OUT = path.join(ROOT, 'assets/img/og');
const pages = JSON.parse(fs.readFileSync(path.join(__dirname, 'pages.json'), 'utf8'));
const sizes = JSON.parse(execFileSync('php', ['-r',
	'define("ABSPATH",1); require "inc/sizes.php"; echo json_encode(["ring"=>rbs_ring_rows_for_js(),"bangle"=>rbs_bangle_sizes()], JSON_UNESCAPED_UNICODE);',
], { cwd: ROOT }).toString());

const BLUE = '#1d4ed8', DARK = '#111827', MUTED = '#4b5563', GOLD = '#f59e0b', BG = '#f8fafc';
const esc = (s) => String(s).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
const keyOf = (p) => p.replace(/^\/|\/$/g, '').replace(/\//g, '-') || 'home';

function kindOf(p) {
	if (/bangle|chudi/.test(p)) return 'bangle';
	if (/bracelet|wrist/.test(p)) return 'bracelet';
	if (/about|contact|how-we-measure|^\/blog\/$/.test(p)) return 'brand';
	return 'ring';
}

/* ------------------------------------------------------------ visuals */

function ringSvg(label, sub) {
	return `<svg viewBox="0 0 400 400" width="400" height="400">
<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#fde68a"/><stop offset=".5" stop-color="${GOLD}"/><stop offset="1" stop-color="#b45309"/></linearGradient></defs>
<circle cx="200" cy="215" r="140" fill="none" stroke="url(#g)" stroke-width="34"/>
<path d="M165 58h70l-35 42z" fill="#93c5fd" stroke="${BLUE}" stroke-width="4"/>
<line x1="78" y1="215" x2="322" y2="215" stroke="${BLUE}" stroke-width="4" stroke-dasharray="10 8"/>
${label ? `<text x="200" y="200" text-anchor="middle" font-size="${label.length > 3 ? 64 : 84}" font-weight="800" fill="${DARK}">${esc(label)}</text>` : ''}
${sub ? `<text x="200" y="262" text-anchor="middle" font-size="34" font-weight="600" fill="${BLUE}">${esc(sub)}</text>` : ''}
</svg>`;
}

function bangleSvg(label, sub) {
	let beads = '';
	for (let i = 0; i < 24; i++) {
		const a = (i / 24) * Math.PI * 2;
		beads += `<circle cx="${200 + Math.cos(a) * 150}" cy="${200 + Math.sin(a) * 150}" r="7" fill="#fff7ed"/>`;
	}
	return `<svg viewBox="0 0 400 400" width="400" height="400">
<defs><linearGradient id="g" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#fde68a"/><stop offset=".5" stop-color="${GOLD}"/><stop offset="1" stop-color="#b45309"/></linearGradient></defs>
<circle cx="200" cy="200" r="150" fill="none" stroke="url(#g)" stroke-width="44"/>${beads}
<line x1="72" y1="200" x2="328" y2="200" stroke="${BLUE}" stroke-width="4" stroke-dasharray="10 8"/>
${label ? `<text x="200" y="188" text-anchor="middle" font-size="84" font-weight="800" fill="${DARK}">${esc(label)}</text>` : ''}
${sub ? `<text x="200" y="250" text-anchor="middle" font-size="34" font-weight="600" fill="${BLUE}">${esc(sub)}</text>` : ''}
</svg>`;
}

function braceletSvg() {
	let links = '';
	for (let i = 0; i < 16; i++) {
		const a = (i / 16) * Math.PI * 2;
		const x = 200 + Math.cos(a) * 140, y = 200 + Math.sin(a) * 110;
		links += `<ellipse cx="${x}" cy="${y}" rx="22" ry="14" transform="rotate(${(a * 180) / Math.PI + 90} ${x} ${y})" fill="none" stroke="${GOLD}" stroke-width="9"/>`;
	}
	return `<svg viewBox="0 0 400 400" width="400" height="400">${links}
<text x="200" y="192" text-anchor="middle" font-size="40" font-weight="800" fill="${DARK}">WRIST</text>
<text x="200" y="240" text-anchor="middle" font-size="34" font-weight="600" fill="${BLUE}">+ 1.5–2 cm</text></svg>`;
}

function brandSvg() {
	return `<svg viewBox="0 0 40 40" width="400" height="400">${MARK}</svg>`;
}

function visualFor(p) {
	let m = p.match(/size-(\d+)(?:-(5))?\/$/);
	if (m && p.includes('ring-size-in-mm')) {
		const us = m[2] ? `${m[1]}.5` : m[1];
		const row = sizes.ring.find((r) => String(r.us) === us);
		return ringSvg(us, row ? `${row.mm.toFixed(1)} mm` : '');
	}
	m = p.match(/\/bangle-size\/(\d)-(\d+)\/$/);
	if (m) {
		const label = `${m[1]}.${m[2]}`;
		const row = sizes.bangle.find((b) => b.label === label);
		return bangleSvg(label, row ? `${row.mm.toFixed(1)} mm` : '');
	}
	switch (kindOf(p)) {
		case 'bangle': return bangleSvg('', '');
		case 'bracelet': return braceletSvg();
		case 'brand': return brandSvg();
		default: return ringSvg('', '');
	}
}

/* ---------------------------------------------------------- templates */

const BASE_CSS = `*{margin:0;box-sizing:border-box}body{font-family:Inter,sans-serif;color:${DARK};background:${BG}}`;
const MARK = '<circle cx="16" cy="20" r="12" fill="none" stroke="#1d4ed8" stroke-width="4"/><circle cx="28" cy="22" r="7.5" fill="none" stroke="#d4a017" stroke-width="4"/>';
const LOGO = `<svg viewBox="0 0 40 40" width="48" height="48">${MARK}</svg>`;

function ogHtml(pg) {
	const [head, ...rest] = pg.title.split(' – ');
	const sub = rest.join(' – ');
	const hSize = head.length > 34 ? 58 : head.length > 22 ? 66 : 76;
	return `<!doctype html><html><head><meta charset="utf-8"><style>${BASE_CSS}
.w{width:1200px;height:630px;display:flex;align-items:center;padding:0 64px;gap:40px;position:relative;overflow:hidden}
.w:before{content:"";position:absolute;right:-140px;top:-140px;width:620px;height:620px;border-radius:50%;background:#dbeafe}
.t{flex:1;position:relative}.v{position:relative;flex:0 0 400px}
.b{display:flex;align-items:center;gap:14px;font-size:28px;font-weight:700;color:${BLUE};margin-bottom:34px}
h1{font-size:${hSize}px;line-height:1.08;font-weight:800;letter-spacing:-1.5px}
p{font-size:32px;line-height:1.3;color:${MUTED};margin-top:22px;font-weight:500}
.f{position:absolute;left:64px;bottom:40px;font-size:24px;font-weight:600;color:${DARK};background:#fde68a;padding:8px 18px;border-radius:999px}
</style></head><body><div class="w"><div class="t"><div class="b">${LOGO}ringbanglesizer.com</div>
<h1>${esc(head)}</h1>${sub ? `<p>${esc(sub)}</p>` : ''}</div><div class="v">${visualFor(pg.path)}</div>
<div class="f">Free on-screen sizer · US · UK · EU · India · mm</div></div></body></html>`;
}

function pinHtml(pin) {
	const rows = pin.rows.map((r, i) => `<tr${pin.hl && pin.hl.includes(i) ? ' class="h"' : ''}>${r.map((c) => `<td>${esc(c)}</td>`).join('')}</tr>`).join('');
	return `<!doctype html><html><head><meta charset="utf-8"><style>${BASE_CSS}
.w{width:1000px;height:1500px;padding:70px 64px;display:flex;flex-direction:column;background:linear-gradient(180deg,#eff6ff 0,#fff 40%)}
.b{display:flex;align-items:center;gap:14px;font-size:30px;font-weight:700;color:${BLUE}}
h1{font-size:${pin.title.length > 22 ? 76 : 92}px;line-height:1.02;font-weight:800;letter-spacing:-2px;margin:38px 0 14px}
.s{font-size:34px;color:${MUTED};font-weight:500;margin-bottom:36px}
table{width:100%;border-collapse:collapse;font-size:${pin.rows.length > 12 ? 31 : 36}px;background:#fff;border-radius:18px;overflow:hidden;box-shadow:0 2px 0 #e5e7eb}
th{background:${BLUE};color:#fff;text-align:left;padding:18px 22px;font-weight:700}
td{padding:${pin.rows.length > 12 ? 11 : 15}px 22px;border-bottom:2px solid #eef2f7;font-weight:500}
tr.h td{background:#fef3c7;font-weight:700}
.n{margin-top:auto;font-size:28px;color:${MUTED};line-height:1.35}
.c{margin-top:26px;background:${DARK};color:#fff;border-radius:24px;padding:30px 34px;font-size:38px;font-weight:700;line-height:1.25}
.c span{color:#fde68a}
</style></head><body><div class="w"><div class="b">${LOGO}ringbanglesizer.com</div>
<h1>${esc(pin.title)}</h1><div class="s">${esc(pin.sub)}</div>
<table><tr>${pin.head.map((h) => `<th>${esc(h)}</th>`).join('')}</tr>${rows}</table>
${pin.note ? `<div class="n">${esc(pin.note)}</div>` : '<div class="n"></div>'}
<div class="c">Check your size on your phone screen, free:<br><span>ringbanglesizer.com</span></div></div></body></html>`;
}

function pins() {
	const B = sizes.bangle, R = sizes.ring;
	const frac = { 1.625: '1⅝"', 1.75: '1¾"', 1.875: '1⅞"', 2: '2"', 2.125: '2⅛"', 2.25: '2¼"', 2.375: '2⅜"', 2.5: '2½"', 2.625: '2⅝"', 2.75: '2¾"', 2.875: '2⅞"', 3: '3"', 3.125: '3⅛"', 3.25: '3¼"' };
	const adult = B.filter((b) => b.inch >= 2.125);
	const kids = B.filter((b) => b.inch <= 2.125);
	const pick = (list) => R.filter((r) => list.includes(r.us));
	return [
		{ file: 'bangle-size-chart', url: '/bangle-size-chart/', title: 'Bangle Size Chart', sub: 'Indian bangle sizes with inner diameter',
			head: ['Size', 'Inches', 'mm', 'Fits'], rows: adult.map((b) => [b.label, frac[b.inch], b.mm.toFixed(1), b.fit.replace(' (most common)', ' ★')]),
			hl: [1, 2], note: '★ 2.4 and 2.6 are the most common adult sizes. Measure the inside of a bangle that fits you, wall to wall.' },
		{ file: 'kids-bangle-size-chart', url: '/kids-bangle-size-chart/', title: 'Kids Bangle Size Chart', sub: 'Baby to teen, by age',
			head: ['Size', 'mm', 'Age'], rows: kids.map((b) => [b.label, `${b.mm.toFixed(1)} mm`, b.fit]),
			note: 'Children grow fast: buy openable or adjustable bangles and re-check the size every 6 months.' },
		{ file: 'bangle-size-in-cm', url: '/bangle-size-chart/in-cm/', title: 'Bangle Size in cm', sub: 'Inner diameter and circumference',
			head: ['Size', 'Diameter', 'Around'], rows: adult.map((b) => [b.label, `${(b.mm / 10).toFixed(2)} cm`, `${(b.mm * Math.PI / 10).toFixed(1)} cm`]), hl: [1, 2] },
		{ file: 'ring-size-chart', url: '/ring-size-chart/', title: 'Ring Size Chart', sub: 'US · UK · EU · inner diameter',
			head: ['US', 'UK', 'EU', 'mm'], rows: pick([4, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 10, 11, 12]).map((r) => [r.us, r.uk, r.eu, r.mm.toFixed(1)]), hl: [3, 5] },
		{ file: 'ring-size-in-mm', url: '/ring-size-in-mm/', title: 'Ring Size in mm', sub: 'Diameter and circumference',
			head: ['US', 'Diameter', 'Circumference'], rows: pick([4, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 9.5, 10, 11]).map((r) => [r.us, `${r.mm.toFixed(1)} mm`, `${r.circ} mm`]),
			note: 'Diameter = the inside width of a ring that fits. Circumference = string around your finger.' },
		{ file: 'uk-ring-size-chart', url: '/ring-size-chart/uk/', title: 'UK Ring Size Chart', sub: 'Letters to US sizes and mm',
			head: ['UK', 'US', 'mm'], rows: pick([4, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 10, 11, 12]).map((r) => [r.uk, r.us, r.mm.toFixed(1)]) },
		{ file: 'indian-ring-size-chart', url: '/ring-size-chart/india/', title: 'Indian Ring Size Chart', sub: 'Indian sizes to US and mm',
			head: ['India', 'US', 'mm'], rows: pick([4, 5, 5.5, 6, 6.5, 7, 7.5, 8, 8.5, 9, 10, 11, 12]).map((r) => [r.jp, r.us, r.mm.toFixed(1)]) },
		{ file: 'average-ring-size', url: '/average-ring-size/', title: 'Average Ring Size', sub: 'Ring finger, women and men',
			head: ['', 'US', 'UK', 'mm'], rows: [['Women avg', '6–7', 'L½–N½', '16.5–17.3'], ['Women range', '5–8', 'J½–P½', '15.7–18.1'], ['Men avg', '9–10', 'R½–T½', '19.0–19.8'], ['Men range', '8–12', 'P½–X½', '18.1–21.4']], hl: [0, 2],
			note: 'Averages are a starting point only. Fingers are bigger in the evening and in warm weather, so measure twice.' },
		{ file: 'measure-ring-size-at-home', url: '/how-to-measure-ring-size-at-home/', title: 'Measure Ring Size at Home', sub: '3 ways, no ring sizer needed',
			head: ['Method', 'How'], rows: [['Phone screen', 'Hold a card to the screen once, then match a ring you own'], ['String', 'Wrap, mark, measure mm, divide by 3.14'], ['Printable', 'Print the free sizer at 100%, check the 50 mm line']],
			note: 'Measure at the end of the day, at room temperature. Between two sizes, take the bigger one.' },
		{ file: 'measure-bangle-size', url: '/how-to-measure-bangle-size/', title: 'How to Measure Bangle Size', sub: 'At home in 2 minutes',
			head: ['Step', 'What to do'], rows: [['1', 'Bring thumb and little finger together'], ['2', 'Wrap a tape around the widest part of the hand'], ['3', 'Match the cm to the chart, or use the online calculator']],
			note: 'Already own a bangle that fits? Measure its inside diameter instead: that is the most accurate method.' },
	];
}

(async () => {
	fs.mkdirSync(OUT, { recursive: true });
	const browser = await chromium.launch();
	const page = await browser.newPage({ viewport: { width: 1200, height: 630 } });
	for (const pg of pages) {
		await page.setContent(ogHtml(pg));
		await page.screenshot({ path: path.join(OUT, `${keyOf(pg.path)}.png`) });
	}
	fs.copyFileSync(path.join(OUT, 'home.png'), path.join(OUT, 'default.png'));
	console.log(`og: ${pages.length} images`);
	const i = process.argv.indexOf('--pins');
	if (i > 0) {
		const dir = path.resolve(process.argv[i + 1]);
		fs.mkdirSync(dir, { recursive: true });
		await page.setViewportSize({ width: 1000, height: 1500 });
		for (const pin of pins()) {
			await page.setContent(pinHtml(pin));
			await page.screenshot({ path: path.join(dir, `pin-${pin.file}.png`) });
		}
		console.log(`pins: ${pins().length} into ${dir}`);
	}
	await browser.close();
})();
