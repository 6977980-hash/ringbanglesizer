# Phase 1 handoff – Foundation (done 2026-11-06)

## Done

| Item | Where |
|---|---|
| Niche research, keyword data (11 countries), full plan | Plan doc + `/mnt/project-files/niche-research/` |
| Domain `ringbanglesizer.com`, repo, Hostinger GIT deploy to theme dir | Ali |
| GeneratePress child theme, parent installed + child activated | PR #1 |
| Sizer tool: card calibration, ring match / mm input, bangle match / hand method, bracelet | `assets/js/sizer.js`, `assets/css/sizer.css` (PR #1) |
| Size data + server-rendered tables | `inc/sizes.php`, `inc/shortcodes.php` (PR #1) |
| WebApplication + HowTo schema on tool pages | `inc/schema.php` (PR #1) |
| 5 core pages auto-created from code, front page set to ring sizer, FAQPage schema | `inc/page-content.php`, `inc/pages.php` (PR #2) |

Core pages (all `publish`): `/` (ring-sizer, front page), `/bangle-size-calculator/`, `/bracelet-size-calculator/`, `/ring-size-chart/`, `/bangle-size-chart/`.

## State / gotchas

- Pages sync runs on `init` when `get_option('rbs_pages_version') !== RBS_PAGES_VERSION`. First run happens on the first page load after deploy. If pages don't appear, load any URL once and check `wp_options.rbs_pages_version`.
- `inc/pages.php` overwrites page content by slug on every version bump: content edits belong in the repo, not WP admin.
- `[rbs_cta mode=ring]` links to `home_url('/')` because the ring page is the front page.
- Tool JS only loads on pages containing `[rbs_sizer]`. `.rbs` has `min-height: 520px` to avoid CLS.
- Calibration is stored in `localStorage` key `rbs_ppm_v1`.
- Repo "Allow auto-merge" setting is OFF and cannot be changed through Claude's GitHub proxy (403). Ali was asked to enable it; until then merge PRs with the REST merge call.
- Not yet verified on the live site: Ali installed the theme after PR #1; PR #2 pages have not been seen live by Claude. First task of Phase 2 is to ask Ali for the live URL check (or screenshots) of all 5 pages.

## Next phase: Phase 2 – Bangle silo + site basics (fast-ranking cluster)

Goal: India/low-competition pages live within the first 2 weeks, plus everything AdSense/legal that every page needs.

### 2a. Site basics (do first)
1. Legal + trust pages via `inc/page-content.php` (set `'mode' => null`, add `'noindex' => true` support in `inc/pages.php` → `rank_math_robots` meta): `/privacy-policy/`, `/terms/`, `/disclaimer/` (sizes are estimates), `/affiliate-disclosure/`, `/about/`, `/contact/` (form: Contact Form 7 or WPForms Lite, Ali installs), `/how-we-measure/` (methodology; placeholder for the accuracy test photos Ali will take).
2. Primary menu + footer menu registered in `functions.php` and populated in code (`wp_nav_menu` items created in `inc/pages.php` style sync). Breadcrumbs: Rank Math breadcrumbs enabled in theme via `generate_after_header` hook.
3. `inc/pages.php`: add support for `parent` (slug) so `/bangle-size/2-4/` style children work, and for `noindex`.
4. Author box: single author "Ring Bangle Sizer Editorial Team" with bio; set `Organization` schema with `sameAs` (social profiles Ali will create).

### 2b. Bangle silo pages (content map #3–#13, plan doc section 5)
Create as children where shown. Each: unique table, 600–900 words, 5 FAQ, link to `/bangle-size-calculator/` 3× and to 2 neighbour sizes.

| Slug | Primary keyword |
|---|---|
| `/bangle-size-chart/india/` | bangle size chart india |
| `/bangle-size-chart/in-cm/` | bangle size 2.4 in cm (+2.6, 2.8 in cm) |
| `/bangle-size/2-2/` … `/2-4/`, `/2-6/`, `/2-8/`, `/2-10/`, `/2-12/` | "2.4 bangle size" etc. (6 pages; 2.10 trending +900% YoY) |
| `/how-to-measure-bangle-size/` | how to measure bangle size (50K), at home, by hand width |
| `/kids-bangle-size-chart/` | kids / baby bangle size chart by age |
| `/chudi-size-chart/` | chudi size chart, kada size chart, kangan size chart |

### 2c. Ring long-tail (content map #14–#19)
`/ring-size-in-mm/` hub + children `size-5`, `size-5-5`, `size-6`, `size-6-5`, `size-7`, `size-7-5`, `size-8`, `size-9`, `size-10` ("size N ring diameter"), and `/ring-size-chart/pakistan/`.

### Acceptance
- All pages created from code, visible live, Rich Results Test passes for FAQPage on 3 sample pages.
- PageSpeed mobile ≥ 90 on `/bangle-size-calculator/`.
- GSC + Bing Webmaster verified (Ali), sitemap submitted, 20+ URLs requested for indexing.
- `docs/handoff/phase-2.md` written.

## Open items (Ali)
- Enable "Allow auto-merge" in repo settings.
- Confirm the 5 pages render correctly on the live site and test ring calibration on a phone with a real ring.
- Create social profiles (Pinterest, YouTube, Instagram, X, Facebook) with the same name/logo; share URLs for `sameAs`.
- Verify GSC + Bing Webmaster when Phase 2 asks.

## Later phases (summary; details in plan doc section 12)
- **Phase 3** – Ring tool cluster (content map #20–#29): calculator page, printable sizer PDF, how-to-measure-at-home, by-diameter, by-circumference, converter, wrist chart.
- **Phase 4** – Authority pages (#30–#40): chart variants (UK/US/India/mens/womens), average ring size, blog posts, embeddable widget, accuracy test with photos.
- **Phase 5** – Off-page + growth: outreach, Reddit/Quora, Pinterest, YouTube Shorts, GSC query-first expansion, CMP + AdSense-ready audit, Ezoic application at 10k visits.
