# Audit 2026-11-07 · Phase 4 handoff: UX, mobile, accessibility (0.15.0)

Source: audit report section D "Mobile UX and accessibility" + F-C05. Phase 3 is in `audit-2026-11-07-phase-3.md`.

## Done (one PR, theme 0.15.0, pages version unchanged at 11)
- **F-C05** uncalibrated results read off the screen (ring "match", bangle "match") now show a small "Approximate:" line above the big size (`.rbs-big-pre`, so it reads "Approximate: US 7"), the kicker says "· screen not calibrated", share text says "My approximate ring/bangle size (screen not calibrated) is …", and the size card title says "My approximate ring size" (amber, font shrinks to fit long names). Typed measurements (ring mm, bangle hand, bracelet) are never marked approximate, because they do not depend on the screen. After calibration the result redraws without the label. Saved-size labels stay "US 7" / "Size 2.6" (used for lookups).
- **F-A01** `.rbs-author-meta` (and its `<time>`) #6b7280 → #4b5563 (about 7:1 on the gold author box). Breadcrumb links underlined (the Lighthouse `link-in-text-block` failure). Low-specificity rule underlines unclassed links inside content p/li/td/dd/figcaption; classed links (buttons, tool cards, TOC) keep their style.
- **F-A02** ring mm, bangle hand, bracelet wrist inputs and bracelet type select have `<label for>` + unique ids (`uid()` in `sizer.js`, safe with several tools on one page); unit selects got `aria-label`; number inputs got `inputmode="decimal"`.

## Regression check
`php tools/tests/build-harness.php && node tools/tests/tool-tests.js` (73 cases) passed. Extra check: uncalibrated ring = "Approximate: US 7", calibrated = "US 7"; mm/hand modes unchanged; all `label[for]` resolve.

## Next: Phase 5 · speed and security
F-P01 (CLS ~0.3 on `/`, `sizer.js` fills `.rbs-body`), F-X01 (theme `.htaccess` deny docs/, tools/, *.md, *.py, *.json), F-P02, F-X02 (security headers via `send_headers`, keep `/embed/*` frameable), F-X03 (`/readme.html`, Ali deletes or block), F-D01 (small GitHub Action: `php -l` + tool tests). Report section D + I.
- Any css/js change needs `RBS_VERSION` in `functions.php` + `style.css`.
- F-P01: the new `.rbs-big-pre` line adds ~20 px to the uncalibrated result; reserve the result height with that in mind.
- After deploy: LiteSpeed Purge All, then check `?ver=0.15.0`.
