# Ring Bangle Sizer – WordPress child theme

GeneratePress child theme for [ringbanglesizer.com](https://ringbanglesizer.com). Contains the on-screen ring / bangle / bracelet sizer, server-rendered size tables and tool-page schema.

## Deploy

Hostinger GIT pulls `main` into `public_html/wp-content/themes/ringbanglesizer`. Every change goes through a PR to `main`; merging deploys it.

## One-time WordPress setup

1. Install and activate the **GeneratePress** parent theme (Appearance → Themes → Add New).
2. Activate **Ring Bangle Sizer** (this repo) as the child theme.
3. Install Rank Math, LiteSpeed Cache, Complianz (consent). No other plugins needed for the tool.

## Shortcodes

| Shortcode | Use |
|---|---|
| `[rbs_sizer mode="ring"]` | Interactive tool. `mode` = `ring` (default), `bangle`, `bracelet`. Only enqueues JS/CSS on pages where it is used. |
| `[rbs_ring_table]` | Full ring conversion chart (US, UK, EU, India/Japan, mm, inch, circumference). Server-rendered HTML. |
| `[rbs_bangle_table]` | Indian bangle size chart (size, inch, mm, cm, circumference, fit). |
| `[rbs_cta mode="bangle"]` | Blue call-to-action box linking to the tool page. |

Tool page URLs assumed by `[rbs_cta]`: `/` (ring), `/bangle-size-calculator/`, `/bracelet-size-calculator/`. Change in `inc/shortcodes.php → rbs_tool_url()` if the slugs differ.

## Files

```
style.css              child theme header + table/CTA styles
functions.php          enqueue, asset registration, data → JS
inc/sizes.php          single source of truth for ring + bangle sizes
inc/shortcodes.php     [rbs_sizer] [rbs_ring_table] [rbs_bangle_table] [rbs_cta]
inc/schema.php         WebApplication + HowTo JSON-LD on tool pages
assets/css/sizer.css   tool styles (mobile first)
assets/js/sizer.js     tool logic: calibration, ring, bangle, bracelet
```

## How the tool works

1. **Calibration** – user matches a dashed outline to a real credit card (85.6 mm). Pixels-per-mm is saved in `localStorage` (`rbs_ppm_v1`). Uncalibrated users see an "approximate" warning and a 96 dpi fallback.
2. **Ring** – a true-size circle driven by a slider over 25 US sizes (3–15), or enter diameter/circumference. Output: US, UK, EU, India/Japan, mm, inch.
3. **Bangle** – same circle over 12 Indian sizes (1.10–3.0), or enter hand circumference (thumb tucked). Output: Indian size, mm, cm, inch, fit.
4. **Bracelet** – wrist circumference → snug / comfortable / loose lengths by bracelet type.

No build step. Edit the files and merge.
