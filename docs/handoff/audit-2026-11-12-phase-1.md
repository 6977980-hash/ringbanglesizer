# Audit 2026-11-12, Phase 1: tools + privacy (theme 0.21.0, pages v20)

Full audit report: `/mnt/project-files/ringbanglesizer/audit/2026-11-12/site-audit-2026-11-12.md`. Phase brief: `/mnt/project-files/ringbanglesizer/audit/2026-11-12/handoff/phase-1-tools-privacy.md`.

## Done (one PR, all 9 items)

| ID | Fix | Where |
|---|---|---|
| F-L01 High | Ask links are now `/#ask=Name` (bangle: `/bangle-size-calculator/#ask=`). New inline script in `wp_head` at priority 1 (before GTM at 2) moves `?ask=` or `#ask=` into `sessionStorage.rbs_ask_landing_name` and strips it with `history.replaceState`, keeping other params and hash. `askName` reads hash → sessionStorage → `?ask=`. `rbs_ask_landing` event still has no name. | `inc/site.php`, `assets/js/sizer.js` |
| F-T11 High | Photo method gives no size until both circles were moved; shows "Fit the gold circle to the coin first (step 1), then the blue circle to the bangle." | `sizer.js` `wirePhoto().result()` |
| F-T12 | Typed ring more than 0.4 mm outside the chart (US 3–15) shows a warning with an estimate (US 3 + (d − 14.1)/0.81, ½ steps), no result, no `trackResult`. | `sizer.js` `fromMm()` |
| F-T14 | Will it fit: bare whole 8–16 (system not `in`/`eu`) asks "Is that US 14 (23.0 mm) or India/Pakistan 14 (17.2 mm)?" with two buttons. `[rbs_sizer system="in"]` → `data-system` seeds `ringSystem` when nothing stored. No page uses it yet (India/Pakistan chart pages do not embed the sizer). | `sizer.js`, `inc/shortcodes.php` |
| F-T15 | Inch circumference: ring option `ci`, converter option `cin` (default 2.14 → US 7). | `sizer.js`, `converter.js`, `inc/tools.php` |
| F-T16 | `.rbs-approx` hidden outside match mode (ring and bangle); ring "±¼ after calibration" line only for matched results. | `sizer.js` |
| F-T17 | `|d| ≤ 0.05` "Fits: same size.", `≤ 0.2` "Fits: within about ¼ size." | `fitVerdict` |
| F-T18 | Bangle hand input starts in cm / 20 for India/Pakistan browsers. | `renderBangle` |
| F-T19 | `rangeWarning(what, units, comma, eg)`: ring "mm / inch", hand/wrist "cm / inch"; "Use a dot for decimals" when the field is badInput ("17,3") or the value ÷ 10 is in range. | `sizer.js` |
| Privacy | Policy dated November 12, 2026: §1 explains `#ask=` + session storage; §5 table lists `rbs_ask_landing_name`. | `inc/content/legal.php` |

Tests: `tools/tests/tool-tests.js` now 106 cases (was 77), incl. photo without coin, 12/25 mm and 40 mm circ, 14.1/23.8 chart ends, 2.14 in circ (ring + converter), bare 14 buttons, en-IN hand default, typed mode without approx note, ask link hash + landing from hash/sessionStorage.

## Gotchas
- The harness has no CSS: check `.rbs-hidden` by class, not `isVisible`.
- Same-URL `goto` with only a new hash does not reload: add a query string.
- The head script is the only thing keeping old `?ask=` names out of GA. If LiteSpeed "Delay JS"/"JS combine" is ever enabled, exclude it (it must run before GTM).

## Next
Phase 3 content (sizes.php UK half letters F-T13, F-C10/F-C11/F-C12 wording) then Phase 4 footer underline (F-A03, shares `inc/site.php`). Ali: LiteSpeed Purge All after each deploy; H3 consent tool still waits on Ali.
