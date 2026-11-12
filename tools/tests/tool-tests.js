const { chromium } = require('playwright');
const path = require('path');
const results = [];
function rec(tool, cse, expect, shown, pass) { results.push({ tool, cse, expect, shown, pass }); }
(async () => {
  const browser = await chromium.launch();
  const page = await browser.newPage({ viewport: { width: 1200, height: 900 } });
  const errors = [];
  page.on('pageerror', e => errors.push(String(e)));
  page.on('console', m => { if (m.type() === 'error') errors.push(m.text()); });
  await page.addInitScript(() => { try { localStorage.setItem('rbs_system_v1', 'us'); } catch (e) {} });
  await page.goto('file://' + path.join(__dirname, 'tool.html'));
  const R = '#r', B = '#b', BR = '#br';
  // ring mm
  await page.click(`${R} .rbs-method[data-m="mm"]`);
  async function ringMm(v, t) {
    await page.selectOption(`${R} .rbs-mm-type`, t);
    await page.fill(`${R} .rbs-mm-val`, String(v));
    return (await page.textContent(`${R} .rbs-result`)).replace(/\s+/g, ' ');
  }
  const big = async (sel) => (await page.$(`${sel} .rbs-big`)) ? (await page.textContent(`${sel} .rbs-big`)).trim() : '';
  for (const [v, t, exp] of [[17.3,'d','US 7'],[16.5,'d','US 6'],[18.9,'d','US 9'],[17.5,'d','US 7.5'],[17.0,'d','US 6.5'],[49.3,'c','US 5'],[62.1,'c','US 10'],[0.75,'di','US 9']]) {
    const out = await ringMm(v, t); const b = await big(R);
    rec('Ring mm', `${t} ${v}`, exp, b, b === exp);
  }
  const india10 = await ringMm(19.8, 'd');
  rec('Ring mm', 'd 19.8 India size', 'India 22', (india10.match(/India \d+/)||[''])[0], /India 22/.test(india10));
  for (const [v, t] of [[0,'d'],[-5,'d'],[5,'d'],[100,'d'],[17.3,'c']]) {
    const out = await ringMm(v, t); const b = await big(R);
    rec('Ring mm', `${t} ${v}`, 'range warning, no size', b ? b : out.slice(0, 60), !b && /outside the normal range/.test(out));
  }
  await page.selectOption(`${R} .rbs-mm-type`, 'd'); await page.fill(`${R} .rbs-mm-val`, '');
  rec('Ring mm', 'empty', 'result cleared', await big(R), (await big(R)) === '');
  await page.fill(`${R} .rbs-mm-val`, '17.3');
  await page.selectOption(`${R} .rbs-mm-type`, 'c');
  const cv = await page.inputValue(`${R} .rbs-mm-val`);
  rec('Ring mm', 'unit d→c keeps the size', '54.3 / US 7', cv + ' / ' + await big(R), cv === '54.3' && (await big(R)) === 'US 7');
  await page.selectOption(`${R} .rbs-mm-type`, 'd'); await page.fill(`${R} .rbs-mm-val`, '17.3');

  // will it fit (compared with US 7 current)
  async function fit(root, val) {
    await page.fill(`${root} .rbs-fit-val`, val);
    return (await page.textContent(`${root} .rbs-fit-out`)).replace(/\s+/g, ' ').trim();
  }
  for (const [v, exp, re] of [
    ['EU 54','Fits',/^Fits/], ['7 1/2','US 7.5 (17.7)',/US 7½ \(17\.7/], ['N½','17.3 Fits',/UK N½ \(17\.3 mm\).*|^Fits/],
    ['IT 14','Fits ~17.2',/^Fits.*Italy \/ Spain \/ Switzerland 14 \(54\.0 mm around, 17\.2/], ['ES 14','Fits',/^Fits.*17\.2/], ['CH 14','Fits',/^Fits.*17\.2/], ['Swiss 14','Fits',/^Fits/],
    ['DE 17','17.0 mm',/German 17 \(17\.0 mm/], ['17.3','17.3 mm Fits',/^Fits.*17\.3 mm inner diameter/], ['6 3/4','US 6.75',/US 6¾/], ['6¾','US 6.75',/US 6¾/], ['6.75','US 6.75',/US 6¾/],
    ['India 22','vs US 7: India 22 = 19.7 mm',/India 22 \(62\.0 mm around, 19\.7/], ['UK I','15.3 mm',/UK I \(15\.3 mm\)/], ['14','asks US 14 or India 14 (US visitor)',/^Is that US 14 \(23\.0 mm\) or India\/Pakistan 14 \(17\.2 mm\)\?/],
    ['US 14','Too big',/^Too big/], ['India 14','Fits vs US 7',/^Fits: within about ¼ size.*India 14/], ['17.3','same size',/^Fits: same size/], ['17.5 mm','within ¼',/^Fits: within about ¼ size/],
  ]) { const o = await fit(R, v); rec('Will it fit (ring)', v, exp, o.slice(0, 140), re.test(o)); }
  // India 22 vs a US 10 ring: pick US 10 in mm mode
  await page.fill(`${R} .rbs-mm-val`, '19.8');
  { const o = await fit(R, 'India 22'); rec('Will it fit (ring)', 'India 22 vs US 10', 'Fits', o.slice(0, 80), /^Fits/.test(o)); }
  await page.fill(`${R} .rbs-mm-val`, '17.3');
  // India visitor: bare 14 → India 14
  await page.selectOption(`${R} .rbs-sys-sel`, 'in');
  { const o = await fit(R, '14'); rec('Will it fit (ring)', '14 (India visitor)', 'India 14', o.slice(0, 120), /India 14 /.test(o)); }
  { const b = await big(R); rec('Ring result', 'US 7 shown in India', 'India 14', b, b === 'India 14'); }
  await page.selectOption(`${R} .rbs-sys-sel`, 'us');

  // bangle
  await page.click(`${B} .rbs-method[data-m="hand"]`);
  async function hand(v, u) {
    await page.selectOption(`${B} .rbs-hand-unit`, u);
    await page.fill(`${B} .rbs-hand-val`, String(v));
    return (await page.textContent(`${B} .rbs-result`)).replace(/\s+/g, ' ');
  }
  for (const [v, u, exp] of [[18.4,'cm','Size 2.6'],[19.0,'cm','Size 2.8'],[7,'in','Size 2.4'],[7.1,'in','Size 2.6']]) {
    await hand(v, u); const b = await big(B); rec('Bangle hand', `${v} ${u}`, exp, b, b === exp);
  }
  { const o = await hand(19.0, 'cm'); rec('Bangle hand', '19.0 cm chudi note', 'note: thin chudi 2.6, rigid 2.8', /chudi.*2\.6.*2\.8/.test(o) ? 'note shown' : 'missing', /chudi.*2\.6.*2\.8/.test(o)); }
  { const o = await hand(27, 'cm'); rec('Bangle hand', '27 cm', 'over 3.4 message', /larger than size 3\.4/.test(o) ? 'message' : o.slice(0,60), /larger than size 3\.4/.test(o)); }
  for (const [v, u] of [[-2,'in'],[4,'cm'],[0,'cm']]) {
    const o = await hand(v, u); const b = await big(B); rec('Bangle hand', `${v} ${u}`, 'range warning', b || o.slice(0, 60), !b && /outside the normal range/.test(o));
  }
  await hand(27, 'cm'); await page.selectOption(`${B} .rbs-hand-unit`, 'in');
  { const v = await page.inputValue(`${B} .rbs-hand-val`); rec('Bangle hand', 'unit cm→in converts 27', '10.6', v, v === '10.6'); }
  await page.selectOption(`${B} .rbs-hand-unit`, 'cm'); await page.fill(`${B} .rbs-hand-val`, '18.4');
  for (const [v, re, exp] of [['2/8',/2\.8 \(63\.5/,'2.8'],['2.10',/2\.10 \(66\.7/,'2.10'],['6.2 cm',/62\.0 mm/,'62 mm'],['190 mm',/190\.0 mm around/,'190 around'],
    ['2.1',/read as 2\.10/,'read as 2.10'],['2.9',/not a standard size/,'not standard note'],['2 1/4',/2 1\/4 in \(57\.[12]/,'2.25 in'],['2¼',/2 1\/4 in \(57\.[12]/,'2.25 in']]) {
    const o = await fit(B, v); rec('Will it fit (bangle)', v, exp, o.slice(0, 140), re.test(o));
  }
  // bracelet
  async function wrist(v, u, t) {
    await page.selectOption(`${BR} .rbs-wrist-type`, t); await page.selectOption(`${BR} .rbs-wrist-unit`, u);
    await page.fill(`${BR} .rbs-wrist-val`, String(v));
    return (await page.textContent(`${BR} .rbs-result`)).replace(/\s+/g, ' ');
  }
  { await wrist(6.5, 'in', 'chain'); const b = await big(BR); rec('Bracelet', '6.5 in chain', '7.25 in comfortable', b, /^7\.25 in/.test(b)); }
  { await wrist(16, 'cm', 'chain'); const b = await big(BR); rec('Bracelet', '16 cm chain', '7.05 in', b, /^7\.05 in/.test(b)); }
  { const o = await wrist(6.5, 'in', 'bangle'); rec('Bracelet', '6.5 in rigid bangle', 'sized by hand + link', /sized by the hand.*bangle calculator/.test(o) ? 'hand message + link' : o.slice(0,60), /sized by the hand.*bangle calculator/.test(o)); }
  for (const [v, u] of [[-5,'in'],[30,'in'],[2,'cm']]) { const o = await wrist(v, u, 'chain'); const b = await big(BR); rec('Bracelet', `${v} ${u}`, 'range warning', b || o.slice(0,60), !b && /outside the normal range/.test(o)); }
  // converter
  const opts = await page.$$eval('#c .rbs-conv-from option', o => o.map(x => x.value));
  async function conv(sys, label) {
    await page.selectOption('#c .rbs-conv-from', sys);
    const ok = await page.$$eval('#c .rbs-conv-size option', (o, l) => { const x = o.find(y => y.textContent === l); if (x) { x.selected = true; x.parentNode.dispatchEvent(new Event('change')); return true; } return false; }, label);
    return ok ? (await page.textContent('#c .rbs-conv-out')).replace(/\s+/g, ' ') : null;
  }
  for (const [sys, label, re, exp] of [['us','US 7',/US 7 = UK N½ = EU 54.*India \/ Pakistan\s*14.*Switzerland\s*14/,'N½, 54, India 14, CH 14'],['eu','EU 57',/US 8 =/,'US 8'],
    ['uk','UK N',/UK N is 17\.1 mm/,'selectable'],['uk','UK L',/UK L is/,'selectable'],['uk','UK P',/UK P is/,'selectable'],['eu','EU 55',/EU 55 is 17\.5/,'selectable'],
    ['india','India 22',/US 10 = UK T½.*India \/ Pakistan\s*22/,'US 10'],['india','India 11',/US 5\.5/,'US 5.5'],['us','US 6¾',/US 6¾ is/,'quarter selectable']]) {
    const o = await conv(sys, label); rec('Converter', label, exp, o ? o.slice(0, 120) : 'not in list', !!o && re.test(o));
  }
  await page.selectOption('#c .rbs-conv-from', 'mm'); await page.fill('#c .rbs-conv-num', '30');
  { const o = (await page.textContent('#c .rbs-conv-out')); rec('Converter', 'mm 30', 'warning', /outside the normal/.test(o) ? 'warning' : 'none', /outside the normal/.test(o)); }
  await page.fill('#c .rbs-conv-num', '17.5');
  { const o = (await page.textContent('#c .rbs-conv-out')); rec('Converter', 'mm 17.5 tie', 'US 7.5', o.slice(0, 30), /^US 7\.5 /.test(o.trim())); }
  // kids growth
  await page.selectOption('.rbs-g-age', '3'); await page.selectOption('.rbs-g-size', '');
  { const rows = await page.$$eval('.rbs-g-out tbody tr', t => t.map(r => r.textContent)); const last = rows[3]; rec('Kids growth', 'age 3 not sure, +3 yr', '2.0', last, /2\.0/.test(last)); }
  await page.selectOption('.rbs-g-age', '10'); await page.selectOption('.rbs-g-size', '2.4');
  { const rows = await page.$$eval('.rbs-g-out tbody tr td:nth-child(2)', t => t.map(r => r.textContent)); rec('Kids growth', 'age 10, now 2.4', '2.4,2.4,2.6,2.6', rows.join(','), rows.join(',') === '2.4,2.4,2.6,2.6'); }
  // coin list
  { const c = await page.$$eval(`${R} .rbs-coin-sel option`, o => o.map(x => x.textContent).join('|')); rec('Calibration', 'UK coin', '10p 24.5 mm, no £1', c.match(/UK[^|]*/)[0], /UK 10p coin – 24.5 mm/.test(c) && !/£1/.test(c)); }
  // saved sizes per finger
  await page.click(`${R} .rbs-method[data-m="mm"]`);
  await page.selectOption(`${R} .rbs-mm-type`, 'd'); await page.fill(`${R} .rbs-mm-val`, '17.3');
  await page.fill(`${R} .rbs-name`, 'Me');
  await page.selectOption(`${R} .rbs-finger`, 'L-ring'); await page.click(`${R} .rbs-save`);
  await page.fill(`${R} .rbs-mm-val`, '18.1');
  { const f = await page.inputValue(`${R} .rbs-finger`); rec('Saved sizes', 'finger kept on new result', 'R-index → L-ring kept', f, f === 'L-ring'); }
  await page.selectOption(`${R} .rbs-finger`, 'R-index'); await page.click(`${R} .rbs-save`);
  await page.selectOption(`${R} .rbs-finger`, ''); await page.click(`${R} .rbs-save`);
  { const chips = await page.$$eval(`${R} .rbs-chip-show`, c => c.map(x => x.textContent).join(' | '));
    rec('Saved sizes', '3 fingers for Me', 'Me · US 8 | Me · L ring · US 7 | Me · R index · US 8', chips, chips === 'Me · US 8 | Me · L ring · US 7 | Me · R index · US 8'); }
  await page.click(`${R} .rbs-chip-x[data-finger="L-ring"]`);
  { const chips = await page.$$eval(`${R} .rbs-chip-show`, c => c.map(x => x.textContent).join(' | '));
    rec('Saved sizes', 'forget one finger only', 'Me · US 8 | Me · R index · US 8', chips, chips === 'Me · US 8 | Me · R index · US 8'); }
  { const b = await page.$(`${B} .rbs-finger`); rec('Saved sizes', 'no finger picker on bangles', 'none', b ? 'shown' : 'none', !b); }
  // --- audit 2026-11-12 phase 1 ---
  // F-T14: bare 14 → two buttons that re-run the check
  await page.click(`${R} .rbs-method[data-m="mm"]`);
  await page.selectOption(`${R} .rbs-mm-type`, 'd'); await page.fill(`${R} .rbs-mm-val`, '17.3');
  await fit(R, '14');
  { const n = (await page.$$(`${R} .rbs-fit-pick`)).length; rec('Will it fit (ring)', 'bare 14 buttons', '2 buttons', String(n), n === 2); }
  await page.click(`${R} .rbs-fit-pick[data-v="India 14"]`);
  { const o = (await page.textContent(`${R} .rbs-fit-out`)).replace(/\s+/g, ' ').trim(); rec('Will it fit (ring)', 'bare 14 → India button', 'Fits US 7', o.slice(0, 80), /^Fits/.test(o) && /India 14/.test(o)); }
  await fit(R, '14'); await page.click(`${R} .rbs-fit-pick[data-v="US 14"]`);
  { const o = (await page.textContent(`${R} .rbs-fit-out`)).replace(/\s+/g, ' ').trim(); rec('Will it fit (ring)', 'bare 14 → US button', 'Too big', o.slice(0, 60), /^Too big/.test(o)); }
  { const o = await fit(R, '18'); rec('Will it fit (ring)', 'bare 18 (outside 8–16)', 'India 18, no question', o.slice(0, 80), /India 18/.test(o) && !/Is that/.test(o)); }
  await fit(R, '');
  // F-T12: outside the chart → warning, no size
  for (const [v, t, re] of [[12,'d',/smaller than the sizes on our chart \(US 3 to US 15\).*about US ½.*Kids/],[25,'d',/larger than the sizes on our chart.*about US 16½/],[40,'c',/smaller than.*about US 1½/]]) {
    const out = await ringMm(v, t); const b = await big(R);
    rec('Ring mm', `${t} ${v} outside chart`, 'chart warning, no size', b || out.slice(0, 90), !b && re.test(out));
  }
  for (const [v, exp] of [[14.1,'US 3'],[23.8,'US 15']]) { await ringMm(v, 'd'); const b = await big(R); rec('Ring mm', `d ${v} chart end`, exp, b, b === exp); }
  // F-T15: inch circumference
  { await ringMm(2.14, 'ci'); const b = await big(R); rec('Ring mm', 'ci 2.14 in around', 'US 7', b, b === 'US 7'); }
  await page.selectOption(`${R} .rbs-mm-type`, 'd'); await page.fill(`${R} .rbs-mm-val`, '17.3'); await page.selectOption(`${R} .rbs-mm-type`, 'ci');
  { const v = await page.inputValue(`${R} .rbs-mm-val`); rec('Ring mm', 'unit d→ci converts 17.3', '2.14', v, v === '2.14'); }
  await page.selectOption('#c .rbs-conv-from', 'cin');
  { const v = await page.inputValue('#c .rbs-conv-num'); const o = (await page.textContent('#c .rbs-conv-out')).trim(); rec('Converter', 'inch circumference default 2.14', 'US 7', v + ' / ' + o.slice(0, 12), v === '2.14' && /^US 7 =/.test(o)); }
  // F-T16: typed ring result has no calibration warning
  await ringMm(17.3, 'd');
  { const vis = !(await page.$eval(`${R} .rbs-approx`, e => e.classList.contains('rbs-hidden'))); const o = await page.textContent(`${R} .rbs-result`); rec('Ring mm', 'typed: no calibration notes', 'approx hidden, no ±¼ line', `approx ${vis ? 'shown' : 'hidden'}, ±¼ ${/After calibration/.test(o) ? 'shown' : 'hidden'}`, !vis && !/After calibration/.test(o)); }
  await page.click(`${R} .rbs-method[data-m="match"]`);
  { const vis = !(await page.$eval(`${R} .rbs-approx`, e => e.classList.contains('rbs-hidden'))); const o = await page.textContent(`${R} .rbs-result`); rec('Ring match', 'match: calibration notes', 'approx + ±¼ shown', `approx ${vis ? 'shown' : 'hidden'}`, vis && /After calibration/.test(o)); }
  await page.click(`${B} .rbs-method[data-m="hand"]`);
  { const vis = !(await page.$eval(`${B} .rbs-approx`, e => e.classList.contains('rbs-hidden'))); rec('Bangle hand', 'typed: no calibration warning', 'hidden', vis ? 'shown' : 'hidden', !vis); }
  // F-T19: unit hint per tool + decimal comma
  { const o = await hand(4, 'cm'); rec('Bangle hand', '4 cm unit hint', 'cm / inch', o.slice(0, 100), /Check the unit \(cm \/ inch\)/.test(o)); }
  { const o = await hand(184, 'cm'); rec('Bangle hand', '184 cm (comma lost)', 'dot hint', o.slice(0, 120), /Use a dot for decimals/.test(o)); }
  await page.click(`${R} .rbs-method[data-m="mm"]`);
  { const o = await ringMm(173, 'd'); rec('Ring mm', '173 mm (comma lost)', 'mm / inch + dot hint', o.slice(0, 160), /Check the unit \(mm \/ inch\)/.test(o) && /Use a dot for decimals \(17\.3\)/.test(o)); }
  await page.fill(`${R} .rbs-mm-val`, ''); await page.focus(`${R} .rbs-mm-val`); await page.keyboard.type('17,3');
  { const o = (await page.textContent(`${R} .rbs-result`)).replace(/\s+/g, ' '); const b = await big(R); rec('Ring mm', 'typed 17,3', 'dot hint, no size', b || o.slice(0, 80), !b && /Use a dot for decimals/.test(o)); }
  // F-L01: ask link uses #ask=
  await page.click(`${R} details.rbs-ask summary`);
  await page.fill(`${R} .rbs-ask-name`, 'Test Name');
  await page.click(`${R} .rbs-ask-copy`);
  { const v = await page.inputValue(`${R} .rbs-ask-link`); rec('Ask link', 'link format', 'https://ringbanglesizer.com/#ask=Test%20Name', v, v === 'https://ringbanglesizer.com/#ask=Test%20Name'); }
  // F-T11: photo result needs the coin fitted first
  await page.click(`${B} .rbs-method[data-m="photo"]`);
  const png = Buffer.from(await page.evaluate(() => { const c = document.createElement('canvas'); c.width = 800; c.height = 600; const g = c.getContext('2d'); g.fillStyle = '#ddd'; g.fillRect(0, 0, 800, 600); return c.toDataURL('image/png').split(',')[1]; }), 'base64');
  await page.setInputFiles(`${B} .rbs-photo-file`, { name: 'p.png', mimeType: 'image/png', buffer: png });
  await page.waitForSelector(`${B} .rbs-photo-work:not(.rbs-hidden)`);
  await page.click(`${B} .rbs-photo-tabs [data-t="bangle"]`);
  await page.click(`${B} .rbs-m-photo .rbs-step[data-d="1"]`);
  { const o = (await page.textContent(`${B} .rbs-result`)).replace(/\s+/g, ' '); const b = await big(B); rec('Bangle photo', 'only bangle circle moved', 'no size, fit coin first', b || o.slice(0, 80), !b && /Fit the gold circle to the coin first/.test(o)); }
  await page.click(`${B} .rbs-photo-tabs [data-t="coin"]`);
  await page.click(`${B} .rbs-m-photo .rbs-step[data-d="1"]`);
  { const b = await big(B); rec('Bangle photo', 'coin + bangle fitted', 'a size', b, /^Size /.test(b)); }
  rec('Console', 'all tools', 'no errors', errors.join(' | ') || 'none', errors.length === 0);
  // F-T18: India visitor → hand in cm, 20
  {
    const ctx = await browser.newContext({ locale: 'en-IN' });
    const p2 = await ctx.newPage();
    p2.on('pageerror', e => errors.push(String(e)));
    await p2.goto('file://' + path.join(__dirname, 'tool.html'));
    const u = await p2.inputValue(`${B} .rbs-hand-unit`), v = await p2.inputValue(`${B} .rbs-hand-val`);
    rec('Bangle hand', 'en-IN default unit', 'cm / 20', u + ' / ' + v, u === 'cm' && v === '20');
    // F-L01: ask landing from #ask= and from sessionStorage (where the head script moves ?ask=)
    await p2.goto('file://' + path.join(__dirname, 'tool.html') + '?x=1#ask=Test');
    { const t = await p2.textContent(`${R} .rbs-asked`).catch(() => ''); rec('Ask link', 'landing #ask=Test', 'greeting', t.slice(0, 40), /Test asked for your ring size/.test(t)); }
    await p2.evaluate(() => { sessionStorage.setItem('rbs_ask_landing_name', 'Ayesha'); });
    await p2.goto('file://' + path.join(__dirname, 'tool.html'));
    { const t = await p2.textContent(`${R} .rbs-asked`).catch(() => ''); rec('Ask link', 'landing from sessionStorage', 'greeting', t.slice(0, 40), /Ayesha asked for your ring size/.test(t)); }
    await ctx.close();
  }
  await browser.close();
  let pass = 0;
  for (const r of results) { if (r.pass) pass++; console.log(`${r.pass ? 'PASS' : 'FAIL'} | ${r.tool} | ${r.cse} | expected: ${r.expect} | shown: ${r.shown}`); }
  console.log(`\n${pass}/${results.length} pass`);
  process.exitCode = pass === results.length ? 0 : 1; // non-zero for CI (.github/workflows/checks.yml)
})();
