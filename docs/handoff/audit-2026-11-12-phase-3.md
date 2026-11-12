# Audit 2026-11-12, Phase 3: content consistency (theme 0.21.1, pages v21)

Full audit report: `/mnt/project-files/ringbanglesizer/audit/2026-11-12/site-audit-2026-11-12.md` (sections C and I). Previous phase: `docs/handoff/audit-2026-11-12-phase-1.md`.

## Done (one PR)

| ID | Fix | Where |
|---|---|---|
| F-C10 | One wording: "2.4 and 2.6 are the two most common adult sizes". 2.6 fit label is now just "Medium" (shown in the tool and the bangle chart). "most sold" and "2.4 is the most common adult size" removed. OG chart renderer stars 2.4 and 2.6 by label. | `inc/sizes.php`, `inc/content/bangle.php`, `inc/page-content.php`, `tools/og/render.js` |
| F-C11 | Average ring sizes come from `rbs_avg_ring_range()` via content tokens `{{avg_w}}`, `{{avg_m}}`, `{{avg_w_uk}}`, `{{avg_m_uk}}` (replaced in `rbs_all_pages()` before sync/hash, so content and FAQ schema match). UK page + FAQ + home FAQ now say L½–N½ (16.5–17.3 mm) and R½–T½ (19.0–19.8 mm); home FAQ "US 7 is UK N½"; India 14 = "17.2 mm across; US 7 is 17.3 mm". | `inc/sizes.php`, `inc/pages.php`, `inc/content/authority.php`, `inc/page-content.php`, `inc/content/ring-tools.php` |
| F-C12 | Hand ranges use `rbs_bangle_hand_range()` (same rule as `sizer.js nearestBangleUp`, upper bound floored): 2.2 16.0–16.9, 2.4 17.0–17.9, 2.6 18.0–18.9, 2.8 19.0–19.9, 2.10 20.0–20.9, 2.12 21.0–21.9 cm (inches 6.3–6.6, 6.7–7.0, 7.1–7.4, 7.5–7.8, 7.9–8.2, 8.3–8.6). `[rbs_bangle_size]` uses it; every hard-coded table/FAQ was rewritten to match. | `inc/sizes.php`, `inc/shortcodes.php`, content files |
| F-T13 | Kept the usual retailer mapping (US 3 = F … 4.5 = I, which also matches the old BS scale at the bottom) and made the UK page honest: "From J½ up half letters line up with US sizes … below J½ the steps from I to J and J to J½ are only about 0.2 mm." | `inc/content/authority.php` |
| F-C04 | Not done: needs Ali's accuracy test (G5). Wording already says "designed for … results not yet published". | — |

Tests: new `tools/tests/content-tests.php` (in CI): no leftover `{{` tokens; every hand range starting on a bangle edge ends on one; no "most sold"; no whole-letter UK averages; token sentence present. `tool-tests.js` 115 cases (+9 hand edges: 16.9/17.9/18.0/21.9/22.0 cm, 6.6/6.7/8.2/8.3 in).

## Gotchas
- Add new average-size sentences with the tokens, not typed numbers. Tokens work in `content` and FAQ answers only (they are replaced in `rbs_all_pages()`).
- Any page whose resolved text changed gets a new "Updated" date (hash check in `rbs_sync_pages`). That is intended.

## Next
Phase 4 (F-A03 footer link underline + copyright link tap target, `inc/site.php` `rbs_footer_columns`, `style.css`). Then Phase 6 suggestions G15 (Pakistan "17MM ka matlab" section), G16 (local defaults on country pages), G21 if Ali approves. Ali: LiteSpeed Purge All after deploy.
