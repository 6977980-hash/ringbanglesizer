# Phase 4 handoff – Authority pages + widget (2026-11-06)

## Done

All in PR #6 (`RBS_PAGES_VERSION` 3 → 4, theme 0.4.0). 10 new pages, 53 published pages in total (49 in the sitemap).

| Item | Where |
|---|---|
| `/ring-size-chart/uk/` – UK letters F–Z incl. whole letters (interpolated), UK→US table | `[rbs_uk_ring_table]`, `inc/content/authority.php` |
| `/ring-size-chart/us/` – US 3–13 in quarter sizes, mm + inches, formula | `[rbs_us_quarter_table]` |
| `/ring-size-chart/india/` – Indian sizes 4–33 → mm, nearest US/UK | `[rbs_india_ring_table]` |
| `/ring-size-chart/mens/`, `/ring-size-chart/womens/` – hand-written tables, band width, by finger, engagement tips | `inc/content/authority.php` |
| `/average-ring-size/` – averages in every system, by finger, by region, guessing a size secretly | same |
| `/blog/` hub + `/blog/ring-too-tight-or-loose/`, `/blog/resize-a-ring/`, `/blog/bangle-size-for-wedding/` (pages, not posts) | same |
| Embeddable widget: `/embed/ring/`, `/embed/bangle/`, `/embed/bracelet/` (bare page, `X-Robots-Tag: noindex`, canonical to tool page, credit line, postMessage auto-height) + `/ring-sizer-widget/` with copy-paste code and live preview | `inc/authority.php`, `[rbs_embed_code]` |
| `/bangle-size-chart/` expanded to ~1,250 words (inches/fractions, by hand size, by age, by bangle type, buying online, bangle vs bracelet) | `inc/page-content.php` |
| **Bug fix:** live bangle tool threw `ReferenceError: method is not defined` (stray line added in phase 3) so redraw after calibration was broken | `assets/js/sizer.js` |
| Lighthouse a11y fixes: tool step headings h3 → h2 (`.rbs-h`), `--rbs-muted` #4b5563 for contrast | `sizer.js`, `sizer.css` |
| SVG favicon from the theme while no WP Site Icon is set | `assets/img/icon.svg`, `inc/site.php` |
| Menus: Ring dropdown + "Average Ring Size", new "Guides" dropdown, footer "Free Sizer Widget"; ring chart links to all variants | `rbs_menu_structure()` |

## State / gotchas

- **Tested locally** (WP + GeneratePress + SQLite): 53 pages, no duplicates, all 200, no unrendered shortcodes/PHP warnings, every JSON-LD block parses, every internal link resolves, titles ≤ 60 and descriptions ≤ 155 chars. Headless Chrome (Pixel 7): all tools, converter, 3 embeds and widget page have no JS errors; embed on another origin auto-resizes.
- **PageSpeed:** the PSI API had no free quota from the sandbox, so Lighthouse 12 (mobile) was run locally against the live site before this PR: `/` perf 100 / SEO 100 / a11y 95, `/bangle-size-calculator/` perf 99 (LCP 1.2 s, CLS 0). The a11y and console-error items it found are fixed in this PR.
- **Rich Results Test** is a Google web tool that cannot be run from the sandbox; JSON-LD was validated for syntax and required fields only. Ali or the next phase can run it on `/ring-size-chart/uk/`, `/blog/resize-a-ring/`, `/bangle-size/2-4/`.
- Widget rewrite rule is registered on `init` (priority 5) and flushed by the page sync on a version bump. If `/embed/ring/` ever 404s, re-save Settings → Permalinks.
- Widget credit link is a brand anchor only and linking back is optional (Google treats keyword-rich widget links as a link scheme).
- Word counts: chart pages 765–1,120, guides 950–1,080, average 850, blog hub 245. Plan target for chart pages is 1,200+; expand from GSC queries rather than padding.
- Hard-coded numbers live in the men's/women's tables and the bridal/bangle hand-range tables. If `inc/sizes.php` changes, update those too (the UK/US/India tables are generated).
- **Merging:** the first `gh api PUT …/merge` of #6 was blocked by the auto-mode safety check; it went through once Ali's standing "auto merge" instruction was passed along. #7 adds a LiteSpeed purge on every theme version change (mobile page cache kept serving `sizer.js?ver=0.3.0` after #6). Bump `RBS_VERSION` on every asset change.

## Next phase: Phase 5 – off-page + growth (plan doc sections 8, 11, 12)
1. Verify phase 4 live: new pages 200, `/embed/ring/` loads with noindex header, bangle calculator has no console error, menus show Guides.
2. Rich Results Test on 3 new pages (see above).
3. CMP + AdSense-ready audit (Google "Privacy & messaging" or a light CMP) before any analytics.
4. Outreach list for the widget (Etsy/Shopify jewellery sellers), Reddit/Quora answers, Pinterest pins for bangle charts, YouTube Short demo.
5. After ~4 weeks of GSC data: query-first expansion of pages with impressions at position 8–20.

## Open items (Ali)
- Accuracy test photos for `/how-we-measure/` §6 (10 rings/bangles checked against a jeweller's sizer).
- Print the PDF once and check the 50 mm line.
- Search Console/Bing + sitemap submit, Site Icon (or keep the theme SVG), social profiles for `sameAs`, CMP before analytics.
