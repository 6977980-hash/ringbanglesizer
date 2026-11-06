# Phase 2 handoff – Site basics + bangle silo + ring mm pages (done 2026-11-06)

## Done

All in PR #3 (`RBS_PAGES_VERSION` 1 → 2, theme 0.2.0). 31 new pages, 36 published pages in total.

| Item | Where |
|---|---|
| Page sync: `parent`, `noindex`, `author_box`, `menu_order` keys; matching by full path; sync lock | `inc/pages.php` |
| Primary menu (Ring / Bangle dropdowns, Bracelet, About) + footer menu, rebuilt from code on every version bump | `rbs_menu_structure()` in `inc/pages.php` |
| WP "Sample Page" / "Hello world" moved to draft (only if still default content) | `rbs_unpublish_wp_samples()` |
| Breadcrumbs (Rank Math's if active, else own + BreadcrumbList JSON-LD) | `inc/site.php` |
| Editorial box on content pages: "Ring Bangle Sizer Editorial Team", founder Ali Ahmad (LinkedIn), updated date | `inc/site.php` |
| Organization (+ founder Person, LinkedIn sameAs) + WebSite schema; Rank Math filter adds founder/sameAs and credits pages to the team | `inc/site.php` |
| SEO fallback while Rank Math is missing: `<title>`, meta description, noindex via `wp_robots` | `inc/site.php` |
| No-sidebar layout, custom copyright line, footer nav | `inc/site.php`, `style.css` |
| `[rbs_contact]` (CF7/WPForms auto-detect, else e-mail), `[rbs_email]` | `inc/site.php` |
| New shortcodes `[rbs_bangle_size]`, `[rbs_ring_size]`, `[rbs_bangle_cm_table]`, `[rbs_mm_lookup]` | `inc/shortcodes.php` |
| Legal/trust: about, how-we-measure, contact (indexed); privacy-policy, terms, disclaimer, affiliate-disclosure (noindex,follow) | `inc/content/legal.php` |
| Bangle silo: `/bangle-size-chart/india/`, `/bangle-size-chart/in-cm/`, `/bangle-size/` hub + `2-2 2-4 2-6 2-8 2-10 2-12`, `/how-to-measure-bangle-size/`, `/kids-bangle-size-chart/`, `/chudi-size-chart/` | `inc/content/bangle.php` |
| Ring: `/ring-size-in-mm/` hub + `size-5 5-5 6 6-5 7 7-5 8 9 10`, `/ring-size-chart/pakistan/` | `inc/content/ring-mm.php` |
| Fixes to phase-1 content: bangle hand ranges now match the tool's maths (2.4 = 17.0–18.0 cm, etc.), ring circumference rounding (US 7 = 54.3 mm), sizer note "steps by 2/16 inch", SEO titles ≤ 60 chars, internal links from core pages to the new silo | `inc/page-content.php`, `assets/js/sizer.js` |

## State / gotchas

- **Tested** on a local WordPress 6.x + GeneratePress + SQLite: sync creates all 36 pages with correct parents, re-running the sync makes no duplicates, menus built (15 primary items, 7 footer), every page returns 200 with no unrendered shortcodes and no PHP warnings, every internal link resolves, privacy page outputs `noindex, follow`, FAQPage + Organization + BreadcrumbList JSON-LD render.
- **Not yet seen live** by Claude after merge. Live site before merge: the 5 phase-1 pages returned 200; **Rank Math was not installed**, so the SEO fallback in `inc/site.php` is what outputs titles/descriptions now. When Ali installs Rank Math the fallback switches itself off (`rbs_rank_math_active()`), the stored `rank_math_title/description/robots` meta is picked up, and breadcrumbs are switched on in Rank Math's options automatically.
- WP's existing draft `privacy-policy` page was reused (matched by slug) and published; `wp_page_for_privacy_policy` points to it.
- Content word counts (rendered, incl. FAQ + tables, excl. editorial box): size pages 595–720, hubs: ring-size-in-mm ~1,240, bangle-size ~610. Phase-1 pages `bracelet-size-calculator` (~330), `ring-size-chart` (~530) and `bangle-size-chart` (~470) are still under the 1,200 hub target → expand in Phase 3/4.
- Hand-fit ranges on all bangle pages come from `rbs_bangle_sizes()` (`prev_mm·π` to `mm·π`). If sizes in `inc/sizes.php` change, also update the hard-coded ranges in the bangle content tables (`bangle-sizes`, `bangle-measure`, `chudi`, `bangle-2-6`, `bangle-2-12`).
- Pakistan local ring number = the India/Japan column (`rbs_ring_derived()['jp']`).
- Contact e-mail `contact@ringbanglesizer.com` (constant `RBS_CONTACT_EMAIL`), founder constants `RBS_FOUNDER_NAME`, `RBS_FOUNDER_URL` in `inc/site.php`. Social profile URLs go in `rbs_same_as()`.
- Privacy policy mentions Google Analytics as "may use" and AdSense as "may display" with the required Google cookie/opt-out wording; update the page if a different analytics tool is used.
- How-we-measure §6 says real-device accuracy test results "will be published" – fill in when Ali sends photos/results.

## Next phase: Phase 3 – Ring tool cluster (content map #20–#29, plan doc section 5/12)

1. **Verify Phase 2 live first**: load any page once after deploy (triggers sync), then check `/bangle-size/2-4/`, `/ring-size-in-mm/size-7/`, `/privacy-policy/` (noindex), menus and footer on mobile.
2. Pages (same content-file pattern, add `inc/content/ring-tools.php`):
   - `/ring-size-calculator/` (tool page, `[rbs_sizer mode="ring"]`, distinct intent from home: "calculator" + converter UI)
   - printable ring sizer (PDF + page `/printable-ring-sizer/`, print-at-100% check line)
   - `/how-to-measure-ring-size-at-home/` (string, paper, ruler, on-screen; worked examples)
   - `/ring-size-by-diameter/` and `/ring-size-by-circumference/` (lookup tables, reuse `[rbs_mm_lookup]` logic with a circumference variant)
   - `/ring-size-converter/` (US↔UK↔EU↔India, JS converter + table)
   - `/wrist-size-chart/` (links to bracelet calculator)
   - Expand `/ring-size-chart/` and `/bracelet-size-calculator/` to hub length (1,200+).
3. Add each new page to `rbs_menu_structure()` and bump `RBS_PAGES_VERSION` to `3`.

### Acceptance
- All Phase 3 pages live, created from code, no duplicate pages, menus updated.
- Rich Results Test passes (FAQPage, BreadcrumbList) on 3 sample pages; PageSpeed mobile ≥ 90 on `/` and `/bangle-size-calculator/`.
- `docs/handoff/phase-3.md` written.

## Open items (Ali)
- Install **Rank Math** (then run its setup wizard; keep "Rich snippet" defaults – our pages turn it off per page) and **Contact Form 7** (create one form; `/contact/` picks it up automatically). Install **Complianz** (or another Google-certified CMP) before any ads/analytics.
- Create the `contact@ringbanglesizer.com` mailbox in Hostinger (the address is now published on legal pages).
- Verify **Google Search Console + Bing Webmaster**, submit `sitemap_index.xml` (Rank Math) or `wp-sitemap.xml` (core), request indexing for the bangle size pages first (2.4, 2.6, 2.8, 2.10, in-cm, India).
- Optional: Settings → General → Site Title "Ring Bangle Sizer" (currently "ringbanglesizer.com"; shows in the header).
- Enable "Allow auto-merge" in repo settings (still off).
- Create social profiles and send URLs for `sameAs`; send accuracy-test photos for `/how-we-measure/`.
- Test calibration on a phone with a real ring and bangle.
