# Phase 5 handoff – Off-page + growth, part 1 (2026-11-06)

Phase 5 is ongoing (plan doc section 12). This note covers the first thread.

## Done

| Item | Where |
|---|---|
| Phase 4 verified live: new pages 200, `/embed/ring/` sends `X-Robots-Tag: noindex, follow`, `sizer.js?ver=0.4.1` served | – |
| Share image per page: 1200×630 PNG for all 49 indexable pages (size pages show their own size + mm), `default.png` fallback; `og:image` + width/height/alt, `twitter:card=summary_large_image` | PR #8, `assets/img/og/`, `rbs_og_image()` in `inc/growth.php`, `inc/site.php` |
| Image generator (Node + Playwright + PHP CLI, reads `inc/sizes.php`) | `tools/og/render.js`, page list `tools/og/pages.json` |
| IndexNow: key file at `/9706dcc20f3be1daffc8c0fbafd2e9cd.txt` (served by PHP, `parse_request`), every indexable page submitted once per `RBS_PAGES_VERSION` (and once on the 0.5.0 deploy) after the response is flushed; last result in option `rbs_indexnow_last`. Manual test POST returned 202 | PR #8, `inc/growth.php` |
| 10 Pinterest pins (1000×1500) for Ali to upload | `/mnt/project-files/growth/pinterest-pins/` (regenerate: `node tools/og/render.js --pins DIR`) |
| Growth kit for Ali: Pinterest titles/descriptions, Reddit/Quora rules + 5 answer drafts, widget outreach method + 2 email templates + tracker, YouTube Short script, 4-week schedule, what not to do | Claude Doc https://claude.ai/artifact/LwYGoBUEtXGteTpa5xZ3km |

## State / gotchas

- **New page = new share image.** Add `{path, title}` to `tools/og/pages.json`, run `node tools/og/render.js`, commit the PNG. Without it the page uses `default.png` (fine, just generic). Key rule: path without slashes, `/` → `home`.
- **Content changes:** bumping `RBS_PAGES_VERSION` now also pings IndexNow. Bump `RBS_VERSION` on asset changes so the `?v=` on images/scripts changes and LiteSpeed is purged.
- **LiteSpeed:** right after the 0.5.0 deploy the home page was still served from cache with `ver=0.4.1` (age ~270 s) while inner pages were fresh. Likely a request hit the old code during the file deploy and was cached after the purge. If a page shows an old `?ver=`, Ali needs **Purge All**. A more robust fix (purge again on the first request a few minutes after a version change) can be added if it keeps happening.
- Local WP test install was not possible this time (running wp-cli from the internet was blocked in the sandbox); PHP was lint-checked and `rbs_og_image()` was tested with stubs, then everything was verified on the live site.
- No CMP needed yet: the site sets no cookies and loads no third-party scripts (checked headers + HTML). Add a CMP only together with analytics/AdSense.
- Reddit/Quora search did not surface specific current threads from the sandbox, so the kit gives search strings + answer drafts instead of thread links. Outreach list is built by Ali with the method in the kit (no scraped emails).

## Next (rest of phase 5)

1. When Ali sends social profile URLs → fill `rbs_same_as()` in `inc/site.php`; Pinterest domain-claim meta tag → add next to the GSC tag in `inc/site.php`.
2. When the YouTube Short is live → embed it on `/` below the tool (lazy, `youtube-nocookie`, facade so no third-party script loads until click) + `VideoObject` schema.
3. From ~4 Dec 2026 (4 weeks of GSC data): query-first expansion. Ask Ali for a GSC Performance export (Queries + Pages, last 28 days); expand pages ranking 8–20, add pages for queries with impressions but no page. Chart pages are 765–1,120 words vs 1,200 target: grow them from real queries.
4. Rich Results Test results from Ali (3 URLs in the kit).
5. Ezoic only after ~10k visits/month; AdSense not before May 2027.
6. **December 2026 (wedding season): bridal chura planner** (Ali's idea 5, planned, not built). A page + small widget on `/bangle-size-chart/` family: pick bangle size (or use a saved size from the sizer, `rbs_people_v1`), chura style (Punjabi chura of 21 or 2×21 pieces, half or full set, kangan + chudi mix), wear for 40 days vs. 1 year. Output: how many pieces per hand, which ones one size bigger (thick kada/ kangan ends), shopping checklist, shareable size card (reuse `sizeCard()` from sizer.js). Build it after the GSC query check in step 3 so wording matches real queries ("bridal chura size", "chura size chart"). Ship by mid-Dec for the wedding season.

Tool features added after this handoff (UI/UX thread, 0.8.x): coin calibration, family saved sizes (`rbs_people_v1`, migrates `rbs_my_size_v1`), "Will it fit?" shop-size checker, size card PNG, ring fit quiz (`[rbs_fit_quiz]` on `/blog/ring-too-tight-or-loose/`), kids bangle growth estimate (`[rbs_kids_growth]` on `/kids-bangle-size-chart/`), both from `assets/js/widgets.js`.

## Open items (Ali)

- Purge All after this deploy (home page).
- Bing Webmaster: import from GSC.
- Social profiles + Pinterest claim tag; upload pins; Reddit/Quora/outreach per the kit.
- Still from phase 4: accuracy test photos for `/how-we-measure/`, print the PDF once and check the 50 mm line.

## UI/UX batch D (0.10.0, pages v7)

- FAQ is a `<details>` accordion (`rbs_render_faq_html()` in `inc/pages.php`); FAQ schema unchanged (from `rbs_faq` meta).
- `inc/engage.php`: ids on every H2 + "On this page" list on pages with 4+ H2s (`rbs_toc`, runs after `rbs_tool_cards`); chart tables wrapped in `.rbs-tw` with sticky first column, swipe hint, tap-to-highlight and a "Find your size" box on tables with 8+ rows (`rbs_table_tools`, script `assets/js/content.js` printed inline only where needed); "Your saved sizes" strip under the header on non-tool pages (reads `rbs_people_v1`, inline script before content so no layout shift, hide = sessionStorage); `[rbs_diagram name="ring-inner|paper-strip|bangle-hand"]` inline SVGs.
- Tool: tab icons, desktop (≥1100 px) "How to measure" side panel (`rbs_side_guide()`, off in the embed via `side="0"`), "How accurate is it?" link in the trust line, "Sizing someone else?" link under results. Tool links now use `RBS_DATA.home` so they work inside the embed.
- New guide `/blog/find-ring-size-secretly/` (key `blog-gift-size`, menu Guides, share image added).
- Point 26 (accuracy proof) waits on Ali's test photos: fill section 6 of `/how-we-measure/` and add "Tested with N rings" under the tool then.
