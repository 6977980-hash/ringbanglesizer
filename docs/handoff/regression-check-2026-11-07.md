# Regression check after audit merges (2026-11-07, theme 0.16.1, pages v12)

Checked live after LiteSpeed Purge All: 50 sitemap pages + legal + /embed/* on mobile (Pixel 5 / iPhone 13) and desktop (1366 px), Playwright.

Clean (no change needed):
- No console errors or JS exceptions, no 4xx/5xx assets, no horizontal overflow, one H1, one canonical, one meta description per page.
- GTM GTM-55J58VQK: gtm.js requested once per page, noscript iframe once in HTML. GA4 G-Q0TSBYY00V fires via GTM.
- All theme assets on ?ver=0.16.0 (no stale versions), no asset loaded twice.
- Schema: no duplicate types (WebSite, Organization, WebPage, BreadcrumbList, + FAQPage / WebApplication / Article where expected).
- No overlapping UI (only hits were hidden dropdown menus, closed <details> and wrapped inline links).
- Tools: 73/73 harness tests; live ring 17.3 mm -> US 7 / UK N½ / EU 54 / India 14.
- Headers, 301s, 403 on theme files, noindex on legal + embed: OK.

Fixed in 0.16.1:
- Parent GeneratePress style.css (comment-only, 1.9 KB) no longer enqueued: one render-blocking request less.
- Guide diagrams printed the SVG arrow <defs> in every diagram -> duplicate ids rbs-ag/ar/ab on /how-to-measure-ring-size-at-home/. Now only the first diagram prints them.
- About + Contact still said the "Editorial Team" writes/checks pages, while every byline says "Written and checked by Ali Ahmad". Wording aligned (pages v12). Unused RBS_EDITOR_NAME / rbs_editor_entity() removed.
- Head cleanup: shortlink, oEmbed discovery and REST API link tags/headers removed.
