# Audit 2026-11-07 · Phase 1 handoff: tools + India ring sizes (0.12.0, pages v8)

Source: audit report `/mnt/project-files/ringbanglesizer/audit/2026-11-07/site-audit-2026-11-07.md` (section D "Tools", E). Phases 2–5 of that audit are not approved yet.

## Done (one PR, theme 0.12.0, RBS_PAGES_VERSION 8)
- **F-T03 India sizes.** India/Pakistan number = round(inner circumference − 40) (`rbs_india_size()`, reverse `rbs_india_mm()` in `inc/sizes.php`). The derived key is now `india` (PHP `rbs_ring_derived()` and the JS rows); `jp` is gone. No Japan column anywhere: labels are "India / Pakistan", Swiss rows are "Italy / Spain / Switzerland". Hard-coded India numbers in page text and tables (`inc/page-content.php`, `inc/content/authority.php`, `inc/content/ring-mm.php`, `inc/content/ring-tools.php`, `inc/content/legal.php`) updated. US 10 = India 22, US 9 = 20, US 8 = 17, US 7.5 = 16, US 5.5 = 11. The India page table runs 4–35 and gives exact circumference/diameter per number (India 22 = 62 mm around = 19.7 mm; nearest US 10 = 19.8 mm).
- **F-T01 / F-T07 Will it fit** (`parseRing` / `parseBangle` in `assets/js/sizer.js`): IT/ES/CH/Swiss → n + 40 mm around; DE 14–25 → diameter mm; bare decimal 12–26 → mm; quarter sizes (6¾, 6 3/4, 6.75); bare number uses the visitor's chosen system (India visitor 14 → India 14); UK letters come from `RBS_DATA.uk` (`rbs_uk_rows_for_js()`), so UK I = 15.3 mm like the chart; bangle 2.1 → 2.10 with a note, odd sixteenths flagged "not a standard size", "2 1/4" → 2.25 in.
- **F-T05** range checks (ring 11–26 mm across, hand 10–30 cm, wrist 10–28 cm) with a warning and no size; empty input clears; changing unit converts the typed number.
- **F-T02** bangle by hand = first size ≥ hand ÷ π (−0.05 mm rounding only) + "thin chudi in X, rigid gold Y" note when within 1 mm. PHP hand ranges already used this rule.
- **F-T06** bracelet "Rigid bangle" now sends to the bangle calculator (hand), no wrist-based size.
- **F-T09** ties go to the larger size (JS `nearestRing`, converter, PHP `rbs_nearest_ring`, `[rbs_mm_lookup]`); `[rbs_diameter_ranges]` bands are half-open; 17 mm FAQ fixed.
- **F-T08** kids growth "Not sure" starts from the unrounded typical size (age 3 → 2.0 at age 6).
- **F-T04** converter lists every US quarter size, UK whole + half letters (F–Z, Z+1…), EU 44–76, India 4–35; converts by mm and shows the nearest chart row with a note.
- **F-T10** UK £1 coin replaced by UK 10p (24.5 mm, round).
- Indian ring pin re-rendered: `/mnt/project-files/growth/pinterest-pins/pin-indian-ring-size-chart-v2.png` (old file kept). OG images did not change.

## Regression check
`php tools/tests/build-harness.php && node tools/tests/tool-tests.js` builds a WordPress-free page from the real shortcodes + JS and runs 73 tool cases (every audit section E row plus the new ones). Run it before any change to `sizer.js`, `converter.js`, `widgets.js` or `inc/sizes.php`. The harness refuses to run outside the CLI because the theme folder is web-served.

## Next (not approved yet)
Phase 2 links/footer (F-S01), Phase 3 content contradictions, Phase 5 CLS (edits `sizer.js`/`inc/shortcodes.php`; build on this version), Phase 4. See the audit report section I.
