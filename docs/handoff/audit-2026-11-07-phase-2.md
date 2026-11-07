# Audit 2026-11-07 · Phase 2 handoff: technical SEO (0.13.0, pages v10)

Source: audit report section D "Crawl, index and internal linking" and "On-page SEO". Phase 1 (tools + India sizes, F-T03) is in `audit-2026-11-07-phase-1.md`.

## Done (one PR, theme 0.13.0, RBS_PAGES_VERSION 10)
- **F-S01** footer "Bangle size in cm" → `/bangle-size-chart/in-cm/` (`rbs_footer_columns()` in `inc/site.php`). The wrong path `/bangle-size-chart-in-cm/` now 301s there (small `$map` in a `template_redirect` on 404; add more old paths to that map if ever needed).
- **F-S02** fourth footer column "Ring size by country": US, UK, India, Pakistan, men's, women's charts. Footer grid is 4 columns on desktop, 2 on tablet (768–1024 px), accordion on phones. Converter result rows (US, UK, India, Pakistan labels) link to those charts (`assets/js/converter.js`).
- **F-S03** `feed_links` / `feed_links_extra` removed from `<head>`; any feed URL (`/feed/`, `/comments/feed/`) 301s to home.
- **F-O01** `/blog/find-ring-size-secretly/` title 51 chars, description 137 (`inc/content/authority.php`, entry `blog-gift-size`).
- **F-O02** HowTo JSON-LD removed from tool pages (`inc/schema.php`); WebApplication stays. FAQPage kept (helps AI answers).

## Regression check
`php tools/tests/build-harness.php && node tools/tests/tool-tests.js` (73 cases) passed on this version.

## Next: Phase 3 · content, trust, helpful content
Fixes F-C01, F-C02, F-C03, F-C04, F-C06, F-C07, F-C09, F-C08 (details in report section D "Content, trust and helpful content"). Line numbers in the report were taken on 0.11.1; Phase 1 and 2 moved code, so grep for the quoted text instead of trusting line numbers.
- F-C01: grep `85.6 mm` / `as wide as the card` in `inc/page-content.php`, `inc/content/*.php`; the phone tool matches the card's short side (53.98 mm) when the stage is narrower than 480 px (`sizer.js`).
- F-C02: grep `size smaller` (chooda); one rule: rigid glass/lac chooda = exact size, only openable kangan can be smaller.
- F-C04: `inc/content/legal.php` how-we-measure: fallback px/mm and card side must match `sizer.js`; accuracy worded as "designed for" until test photos exist.
- F-C06: sources box in `inc/aeo.php` (BS 6820 withdrawn).
- Any page text change needs a `RBS_PAGES_VERSION` bump in `inc/pages.php`; any css/js change needs `RBS_VERSION` in `functions.php` + `style.css`.
- Phase 4 (F-C05, F-A01, F-A02) and Phase 5 (F-P01 CLS, F-X01 hide theme docs, F-P02, F-X02, F-X03, F-D01) follow, each in its own thread. Phase 5 edits `sizer.js`, build on the latest version.
