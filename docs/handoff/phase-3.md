# Phase 3 handoff – Ring tool cluster (done 2026-11-06)

## Done

All in PR #4 (merged 2026-11-06 after PR #3; `RBS_PAGES_VERSION` 2 → 3, theme 0.3.0). 7 new pages, 43 published pages in total.

| Item | Where |
|---|---|
| `/ring-size-calculator/` – sizer opens on "I know the diameter / circumference" (`method="mm"`), own WebApplication name, formula + worked examples | `inc/content/ring-tools.php` |
| `/ring-size-converter/` – JS converter (US, UK, EU, India, mm, circumference, inches) + full chart + top conversions | `[rbs_ring_converter]`, `assets/js/converter.js` |
| `/printable-ring-sizer/` – PDFs (A4 + US Letter): 50 mm check line, bank-card box, circles US 4–12.5, finger strip | `assets/printable/*.pdf`, built by `tools/printable_pdf.py` |
| `/how-to-measure-ring-size-at-home/` – 5 methods, accuracy table, worked examples | `inc/content/ring-tools.php` |
| `/ring-size-by-diameter/` – diameter bands per size + inch lookup | `[rbs_diameter_ranges]`, `[rbs_inch_lookup]` |
| `/ring-size-by-circumference/` – 44–75 mm lookup | `[rbs_circ_lookup]` |
| `/wrist-size-chart/` – wrist 5–9 in → bracelet lengths | `[rbs_wrist_table]` |
| `/ring-size-chart/` expanded to ~1,290 words (women/men charts, inches, by finger, by style) | `inc/page-content.php` |
| `/bracelet-size-calculator/` expanded to ~1,200 words (size table, by style, men, mistakes, kids) | `inc/page-content.php` |
| Menus: Ring dropdown now 9 items, Bracelet got a dropdown (calculator + wrist chart). Home and ring-mm hub link to the new pages | `rbs_menu_structure()` |
| Ring rows for JS factored into `rbs_ring_rows_for_js()` | `inc/sizes.php` |

## State / gotchas

- **Tested** on local WordPress + GeneratePress + SQLite: sync creates 43 pages, no duplicates; all pages 200, no unrendered shortcodes, no PHP warnings; every internal link (incl. PDFs) resolves; new pages are in the core sitemap (38 URLs + front page); FAQPage JSON-LD on all new pages; converter and calculator tested in headless Chrome (Pixel 7) with no JS errors.
- **Verified live** after merge (2026-11-06): new pages 200, converter + calculator work in headless Chrome on ringbanglesizer.com with no JS errors, PDFs download, menu has the new items, sitemap 38 page URLs + front page, privacy page noindex.
- **Merging:** Ali wants Claude to merge every phase PR itself (squash via `gh api -X PUT .../pulls/N/merge`). This worked for #3 and #4.
- If ring sizes in `inc/sizes.php` change, re-run `python3 tools/printable_pdf.py` (needs php + reportlab) and commit the PDFs. Hard-coded numbers also live in content tables/FAQ of `ring-tools.php` and the women/men tables in `page-content.php`.
- US-size formula used in copy: diameter = 11.63 + 0.8128 × US (matches the chart to ±0.05 mm).
- Lookup tables pick the nearest size; ties (e.g. 20.0 mm between 10 and 10.5) resolve to the smaller size. The diameter page FAQ says so explicitly.
- `bangle-size-chart` is still ~480 words (hub target 1,200) → do in Phase 4.
- Rich Results Test and PageSpeed are Google web tools Claude could not run from the sandbox; do them in Phase 4.

## Next phase: Phase 4 (see plan doc sections 5 and 12)
1. Phase 2 + 3 are live and checked. Ali still to print the PDF once and confirm the 50 mm line.
2. Rich Results Test on `/ring-size-calculator/`, `/ring-size-converter/`, `/bangle-size/2-4/`; PageSpeed mobile on `/` and `/bangle-size-calculator/` (target ≥ 90).
3. Expand `/bangle-size-chart/` to hub length; continue the content map from the plan doc (remaining bangle/bracelet/kids long-tail pages).

## Open items (Ali)
- Print the PDF once and check the 50 mm line + card box on paper (real-printer check).
- Everything still open from phase-2.md: Search Console/Bing + sitemap submit, Site Title/Tagline, auto-merge setting, social profiles, accuracy-test photos, CMP before analytics.
