# Audit 2026-11-12, Phase 4 (UX + accessibility) — done

Theme 0.21.2 (pages version unchanged at 21). Last code phase of audit #2.

## What changed
- **F-A03** `style.css`: links inside footer text (`.rbs-fabout p a`: privacy policy, About, email) and the copyright-line link (`.copyright-bar a`: disclaimer) are now underlined (`text-underline-offset: 2px`), so they no longer rely on colour alone (Lighthouse `link-in-text-block`).
- The disclaimer link is `display:inline-block; padding:4px 2px` so its tap target is at least 24 px high (`target-size`).
- Footer column link lists are unchanged (no underline until hover/focus; they are lists, not links in text).

## Checks
- php -l all files, 115/115 tool tests, content tests ok.
- Live after Purge All: `?ver=0.21.2`, Lighthouse mobile `/` and a blog page without `link-in-text-block` / `target-size`, 375 px no horizontal scroll.

## Still waiting on Ali (not code)
- F-C04 accuracy phone test (real card on 2–3 phones vs. ring sizer).
- H3 UK/EEA consent decision (Consent Mode v2 + certified CMP).
- GSC (sitemap, indexing), GA4 DebugView (double page_view F-D02), LiteSpeed browser-cache TTL for parent assets (F-P02), login protection / license.txt (F-X04).
