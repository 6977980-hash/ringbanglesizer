# Phase handoffs

Work on ringbanglesizer.com is done in phases, one project thread per phase. Each phase ends by writing `docs/handoff/phase-N.md` with:

1. **Done** – what shipped, with PR numbers.
2. **State** – how things work now (files, conventions, gotchas).
3. **Next phase** – exact scope, page list, acceptance criteria.
4. **Open items** – anything blocked or waiting on Ali.

The next thread reads the latest handoff first, then the plan doc.

## Standing conventions (all phases)

- **Repo = GeneratePress child theme.** Root is the theme folder. No build step. Hostinger GIT deploys `main` into `public_html/wp-content/themes/ringbanglesizer`.
- **Branch → PR → merge.** Never commit to `main` directly. PR body must start with the project attribution block (see any merged PR). Merge via `gh api -X PUT repos/6977980-hash/ringbanglesizer/pulls/N/merge -f merge_method=squash` (gh GraphQL is blocked; create PRs with `gh api -X POST repos/.../pulls`).
- **Pages live in code.** `inc/page-content.php` holds page content; `inc/pages.php` creates/updates them on `init` when `RBS_PAGES_VERSION` changes. To add or edit pages: edit the array, bump the version, merge. Do not create pages in WP admin.
- **Size data** only in `inc/sizes.php`. Tables and JS read from it.
- **Shortcodes:** `[rbs_sizer mode=ring|bangle|bracelet]`, `[rbs_ring_table]`, `[rbs_bangle_table]`, `[rbs_cta mode=…]`.
- **SEO per page:** `seo_title` (≤60 chars), `seo_desc` (≤155 chars), H1 = page title with the primary keyword, direct answer in the first two lines, 4–5 FAQ entries (rendered as H3/P and as FAQPage JSON-LD). Rank Math rich snippet is turned off per page so schema is not duplicated.
- **Quality bar:** no template-copy pages. Every page needs its own table, example numbers and FAQ. 600+ words for size pages, 1,200+ for hub pages. English, US spelling, sizes always shown in US/UK/EU/India/mm.
- **Rules Ali set:** strict Google guidelines, no PBN/bought links, no AI mass pages, AdSense not before May 2027 (domain age) but site must stay AdSense-ready (legal pages, CMP, ad-placement rules).
- **Plan doc:** https://claude.ai/artifact/VJ8nREVm9fbepMK9VWSgpj (sections 5 = content map, 11 = checklists).
- **Growth kit (phase 5):** https://claude.ai/artifact/LwYGoBUEtXGteTpa5xZ3km (Pinterest, Reddit/Quora, outreach, video).
- **Share images:** every new page needs an entry in `tools/og/pages.json` + `node tools/og/render.js` (see phase-5.md).
- **Keyword data:** `/mnt/project-files/niche-research/ring-bangle-keyword-analysis.md` (Planner exports, Nov 2026).
