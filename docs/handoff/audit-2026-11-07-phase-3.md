# Audit 2026-11-07 · Phase 3 handoff: content, trust, helpful content (0.14.0, pages v11)

Source: audit report section D "Content, trust and helpful content". Phase 2 is in `audit-2026-11-07-phase-2.md`.

## Done (one PR, theme 0.14.0, RBS_PAGES_VERSION 11)
- **F-C01** every calibration instruction now says: on a phone hold the card upright and match its short side (53.98 mm), on a computer match the long side (85.6 mm). Home, ring calculator, bangle measuring guide, Pakistan + India charts (CNIC / PAN / Aadhaar), how-we-measure (method, FAQ), terms, llms.txt.
- **F-C02** one chooda rule site-wide: rigid glass/lac chooda = exact size, never smaller (cracks / hurts); only openable kangan (screw/hinge) can be one size smaller. Fixed in bangle chart, chudi chart, measuring guide, bangle-size-chart (home content) and the wedding blog post.
- **F-C03** Pakistan page: removed "size smaller because hands swell"; now "measure on a normal day, buy exact size".
- **F-C04** how-we-measure: fallback is 6 px/mm on narrow screens, 96 dpi on wide; divisor 53.98 on phones, 85.60 on computers; coin calibration mentioned. Accuracy now worded "designed for about ±¼ US size" (how-we-measure, home, method table, tool note in `sizer.js`, llms.txt) until the device test is published.
- **F-C06** sources box: "UK / Australian ring letter scale (customary)", note "based on the withdrawn BS 6820:1987; measured per BS EN ISO 8653". UK chart text says the same.
- **F-C07** hand ranges use one rule: lower = previous size's inner circumference, upper = this size's, 1 dp (2.6 = 18.0–18.9 cm / 7.1–7.5 in, 2.8 = 18.9–19.9 / 7.5–7.9, 2.10 = 19.9–21.0 / 7.9–8.2, 2.12 = 21.0–22.0 / 8.2–8.6). "Exactly on 18.9 / right at 19.9" advice now matches the tool. Indian ring averages: women 12–14, men 20–22 everywhere. Pinky: 1½–2 sizes everywhere. Bangle tool described as 1.10–3.4. Only 2.6 is "most common". (Men's 11.5 and Pakistan 11/17/22 rows were already in place.)
- **F-C08 / H2(a)** author box: "Written and checked by Ali Ahmad, founder" + "Page last updated <per-page modified date>". The generic "Checked by the Editorial Team" line is gone. Dates now differ per page because page sync only re-saves changed pages. About editorial rules say pages are written by Ali Ahmad. Schema unchanged (author was already the founder).
- **F-C09** plastic sizer belts: "less reliable than a jeweller's metal ring sizers, within about half a size" (method table ±½).

## Regression check
`php tools/tests/build-harness.php && node tools/tests/tool-tests.js` (73 cases) passed on this version.

## Still open from Phase 3
- Publish the real accuracy test (section 6 of how-we-measure) when Ali's device photos exist; then change "designed for" back to measured numbers.
- Page `seo_title`s "Bangle Size Chart: 2.2 to 2.12" left as is (they describe the adult chart rows, not the tool).

## Next: Phase 4 · UX, mobile, accessibility
Fixes F-C05, F-A01, F-A02 (report section D "Mobile UX and accessibility", F-C05 in "Content, trust").
- F-C05: uncalibrated result header/card/share text should read "Approximate: US 7" (grep `rbs-approx`, `Not calibrated` in `assets/js/sizer.js`; the share/card text is built in `sizer.js` and `inc/engage.php`).
- Any css/js change needs `RBS_VERSION` in `functions.php` + `style.css`; page text changes need `RBS_PAGES_VERSION` in `inc/pages.php`.
- Phase 5 (F-P01 CLS, F-X01, F-P02, F-X02, F-X03, F-D01) also edits `sizer.js`; build on the latest main.
- After deploy: LiteSpeed Purge All, then check `?ver=0.14.0`.
