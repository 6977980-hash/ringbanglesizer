# Audit 2026-11-07 · Phase 5 handoff: speed and security (0.16.0) · final audit phase

Source: audit report sections "Page speed", "Security and CMS", "Deployment". Phase 4 is in `audit-2026-11-07-phase-4.md`.

## Done (one PR, theme 0.16.0, pages version unchanged)
- **F-P01 CLS** the `<ol class="rbs-steps">` is now server-rendered in `rbs_sizer_shortcode()` (hidden for bracelet), and `.rbs-body` starts with class `rbs-pending`, which reserves a min-height per mode (sizer.css, `@media (scripting: enabled)`, <600 px and ≥600 px). `sizer.js` reuses the server steps and drops `rbs-pending` after the first mount. Reserved values sit a little under the live drawn height (measured 320–1920 px, uncalibrated): ring 1750/1600, ring mm 1400/1300, bangle 2000/1700, bracelet 500/460. Re-measure if the tool grows or shrinks a lot. Before: live CLS 0.19–0.49 on `/`, 0.17–0.43 bangle.
- **F-X01** theme `.htaccess` denies `*.md, *.py, *.json, *.yml, *.html …` and `docs/`, `tools/`, `.github/` (plus `docs/.htaccess`, `tools/.htaccess` deny-all as a second layer).
- **F-P02** theme `.htaccess`: css/js `max-age=31536000, immutable` (always loaded with `?ver=`), images/pdf 30 days. Parent GeneratePress files are outside the child theme folder, so they keep the host's 7 days unless LiteSpeed Cache → Browser → Browser Cache TTL is raised.
- **F-X02** `inc/security.php` sends HSTS (1 year, no includeSubDomains), nosniff, Referrer-Policy strict-origin-when-cross-origin, Permissions-Policy (camera/mic/geo/payment off), and `X-Frame-Options: SAMEORIGIN` + `CSP frame-ancestors 'self'` on every page except `/embed/*` (widget stays frameable).
- **F-X03** `inc/security.php` deletes `ABSPATH/readme.html` once per theme release (WP core updates put it back).
- **F-D01** `.github/workflows/checks.yml`: `php -l` on every PHP file + `build-harness.php` + `tool-tests.js` (now exits 1 on any FAIL) on each PR and push to main.

## Regression check
`php tools/tests/build-harness.php && node tools/tests/tool-tests.js` 73/73. Local CLS harness (tool + filler, sizer.css only): ≤ 0.003 ring/bangle, ≤ 0.027 bracelet.

## After deploy
LiteSpeed Purge All, then check `?ver=0.16.0`, the 403s, headers on `/` and `/embed/ring/`, and live CLS.
All audit phases (1–5) are now done. Open items are Ali's: device test photos for the accuracy claim, Bing (G14), December GSC review.
