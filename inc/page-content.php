<?php
/**
 * Content for the core pages created by inc/pages.php.
 * Each entry: slug, title, seo_title, seo_desc, mode (tool page or null), content (HTML), faq (Q/A pairs).
 * Edit here, bump RBS_PAGES_VERSION in inc/pages.php, merge: pages are updated on next load.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_core_pages() {
	return array(

		/* ------------------------------------------------------------ HOME */
		'home' => array(
			'slug'      => 'ring-sizer',
			'title'     => 'Online Ring Sizer – Measure Your Ring Size on Screen',
			'seo_title' => 'Online Ring Sizer – Find Your Ring Size on Your Phone Screen (Free)',
			'seo_desc'  => 'Measure your ring size on screen in 30 seconds. Calibrate with a credit card, match your ring to the circle, get your size in US, UK, EU, India and mm.',
			'mode'      => 'ring',
			'content'   => '
<p><strong>Find your ring size without a jeweller.</strong> Calibrate your screen with any bank card, place a ring that fits you on the circle, and read your size in US, UK, EU, Indian and millimetre sizes. Works on phones, tablets and laptops.</p>

[rbs_sizer mode="ring"]

<h2>How to measure your ring size on screen</h2>
<ol>
<li><strong>Calibrate.</strong> Hold a credit, debit or ID card on the screen and drag the slider until the dashed outline is exactly as wide as the card. Every bank card is 85.6 mm wide, so this tells the tool the real size of your screen. You only do this once.</li>
<li><strong>Match a ring.</strong> Put a ring that fits the right finger flat on the screen. Move the size slider until the blue circle lines up with the <em>inside</em> edge of the ring. Not the outside: the inside edge is what sits on your finger.</li>
<li><strong>Read your size.</strong> The result shows US, UK/Australian, EU/ISO, Indian/Japanese sizes plus the inner diameter and circumference in mm.</li>
</ol>
<p>No ring to hand? Switch to <strong>"I know the diameter / circumference"</strong> and type a measurement from a tape, string or vernier, in mm or inches.</p>

<h2>How accurate is an on-screen ring sizer?</h2>
<p>After calibration the circle is drawn to within about 0.1 mm, which is finer than the 0.4 mm gap between half sizes. The real limit is how well you line the ring up, so hold the phone flat, use good light and check with a second ring if you have one. Treat the result as accurate to ±¼ size, the same tolerance jewellers quote for plastic sizer sets.</p>

<h2>Tips for a ring that fits</h2>
<ul>
<li>Measure in the evening at room temperature. Fingers are smallest in the morning and in cold weather.</li>
<li>Measure the exact finger and hand the ring is for. The dominant hand is usually ¼–½ size larger.</li>
<li>Wide bands (6 mm+) fit tighter; go up ¼–½ size.</li>
<li>If your knuckle is much bigger than the base of the finger, pick a size between the two so the ring passes the knuckle but does not spin.</li>
</ul>

<h2>Ring size conversion chart</h2>
<p>All sizes below are standard ISO 8653 inner diameters. Use this chart when a shop lists sizes in a different system.</p>
[rbs_ring_table]

<h2>Other free sizing tools</h2>
<ul>
<li><a href="/bangle-size-calculator/">Bangle size calculator</a> – Indian sizes 2.2, 2.4, 2.6, 2.8 and more</li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a> – from your wrist measurement</li>
<li><a href="/ring-size-chart/">Full ring size chart</a> with US, UK, EU and India columns</li>
</ul>
',
			'faq' => array(
				array( 'How do I find my ring size at home?', 'Use an on-screen sizer like the one above: calibrate with a bank card, then match a ring you already own to the circle. Alternatively wrap a thin strip of paper around the base of your finger, mark where it overlaps, measure the length in mm and look it up in the circumference column of the chart.' ),
				array( 'What is the average ring size for women and men?', 'In the US and UK the most common women\'s ring size is 6–7 (UK L–N, 16.5–17.3 mm). The most common men\'s size is 9–10 (UK R–T, 19–19.8 mm).' ),
				array( 'Can I measure my ring size on my phone?', 'Yes. After calibrating with a credit card the circle on screen is drawn at true size, so a ring placed on the phone can be matched to within about a quarter size.' ),
				array( 'What is ring size 7 in mm?', 'US size 7 has an inner diameter of 17.3 mm and a circumference of 54.4 mm. It is UK size N½ and EU size 54.' ),
				array( 'Is UK ring size the same as US?', 'No. UK and Australian sizes use letters, US and Canadian sizes use numbers. US 7 is about UK N½–O; use the converter above for any size.' ),
			),
		),

		/* ---------------------------------------------------------- BANGLE */
		'bangle' => array(
			'slug'      => 'bangle-size-calculator',
			'title'     => 'Bangle Size Calculator – Find Your Bangle Size Online',
			'seo_title' => 'Bangle Size Calculator – Find Your Indian Bangle Size (2.4, 2.6, 2.8) Online',
			'seo_desc'  => 'Free bangle size calculator. Match a bangle on your screen or enter your hand measurement to get your Indian bangle size with diameter in mm, cm and inches.',
			'mode'      => 'bangle',
			'content'   => '
<p><strong>Find your bangle size in under a minute.</strong> Either place a bangle that fits you on the screen and match the circle, or measure around your hand and let the calculator pick the size. Results are given in Indian sizes (2.2, 2.4, 2.6, 2.8, 2.10 …) with the inner diameter in mm, cm and inches.</p>

[rbs_sizer mode="bangle"]

<h2>How to measure your bangle size</h2>
<h3>Method 1: Match a bangle you own</h3>
<ol>
<li>Calibrate the screen with any bank card (one-time step).</li>
<li>Place a bangle that slides on comfortably flat on the screen.</li>
<li>Move the slider until the circle lines up with the inside edge of the bangle. That is your size.</li>
</ol>
<h3>Method 2: Measure your hand</h3>
<ol>
<li>Tuck your thumb into your palm, the way you do when putting on a bangle.</li>
<li>Wrap a string or soft tape around the widest part of your hand, over the knuckles, and note the length.</li>
<li>Enter it in inches or cm. The calculator converts it to a diameter and rounds <em>up</em> to the next bangle size so it will pass over your hand.</li>
</ol>

<h2>What do bangle sizes like 2.4 and 2.6 mean?</h2>
<p>Indian bangle sizes are the inner diameter in inches and sixteenths. "2.4" means 2 and 4/16 inch (2.25 in, 57.2 mm). "2.6" is 2 and 6/16 inch (2.375 in, 60.3 mm). Sizes step by 2/16 inch, so each size is about 3.2 mm wider than the last. The most common adult sizes are 2.4 and 2.6; 2.8 and 2.10 are for larger hands, and 2.2 and below for petite wrists, teens and children.</p>

<h2>Bangle size chart</h2>
[rbs_bangle_table]

<h2>Choosing between two sizes</h2>
<ul>
<li>For a <strong>rigid bangle</strong> you must be able to push it over your knuckles, so if your hand measurement falls between sizes, take the larger one.</li>
<li>For an <strong>openable bangle or kada</strong> with a clasp, you can size down for a closer fit on the wrist.</li>
<li>Bridal sets and chooda are usually bought in your exact size or one size smaller, because they are worn stacked and should not slide around.</li>
</ul>

<h2>More sizing tools</h2>
<ul>
<li><a href="/">Ring sizer</a> – measure a ring on your phone screen</li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
<li><a href="/bangle-size-chart/">Printable bangle size chart</a></li>
</ul>
',
			'faq' => array(
				array( 'What is bangle size 2.4 in cm?', 'Size 2.4 has an inner diameter of 2.25 inches, which is 5.72 cm or 57.2 mm.' ),
				array( 'What is bangle size 2.6 in cm?', 'Size 2.6 has an inner diameter of 2.375 inches, which is 6.03 cm or 60.3 mm.' ),
				array( 'What is 2.10 bangle size?', 'Size 2.10 means 2 and 10/16 inch, an inner diameter of 2.625 inches (66.7 mm, 6.67 cm). It is an extra-large adult size.' ),
				array( 'How do I know my bangle size without a bangle?', 'Fold your thumb into your palm and measure around the widest part of your hand with a string. Divide the length by 3.14 to get the diameter, then pick the next bangle size up from the chart, or enter the measurement in the calculator above.' ),
				array( 'What is the most common bangle size?', 'In India and Pakistan sizes 2.4 and 2.6 are the most common for adult women. Ready-made bangle sets are usually stocked in 2.2 to 2.8.' ),
			),
		),

		/* -------------------------------------------------------- BRACELET */
		'bracelet' => array(
			'slug'      => 'bracelet-size-calculator',
			'title'     => 'Bracelet Size Calculator – Wrist to Bracelet Length',
			'seo_title' => 'Bracelet Size Calculator – Find Your Bracelet Length from Wrist Size',
			'seo_desc'  => 'Enter your wrist measurement and get the right bracelet length for a snug, comfortable or loose fit, for chain, bangle and cuff bracelets. In inches and cm.',
			'mode'      => 'bracelet',
			'content'   => '
<p><strong>Turn your wrist measurement into a bracelet size.</strong> Measure around your wrist, choose the bracelet style and the calculator gives snug, comfortable and loose lengths in inches and centimetres.</p>

[rbs_sizer mode="bracelet"]

<h2>How to measure your wrist for a bracelet</h2>
<ol>
<li>Wrap a soft tape measure or a strip of paper around your wrist just below the wrist bone, where a bracelet naturally sits.</li>
<li>Pull it snug but not tight, and mark where it overlaps.</li>
<li>Measure the length with a ruler. That is your wrist circumference.</li>
</ol>

<h2>How much to add for fit</h2>
<table class="rbs-table">
<thead><tr><th>Bracelet type</th><th>Snug</th><th>Comfortable</th><th>Loose</th></tr></thead>
<tbody>
<tr><td>Chain / link / beaded</td><td>+ ½ in (1.3 cm)</td><td>+ ¾ in (2 cm)</td><td>+ 1¼ in (3 cm)</td></tr>
<tr><td>Rigid bangle bracelet</td><td>+ 1 in (2.5 cm)</td><td>+ 1¼ in (3 cm)</td><td>+ 1½ in (4 cm)</td></tr>
<tr><td>Open cuff</td><td>+ ¼ in (0.6 cm)</td><td>+ ½ in (1.3 cm)</td><td>+ ¾ in (2 cm)</td></tr>
</tbody>
</table>
<p>A rigid bangle bracelet has to pass over your hand, so its size is really a <a href="/bangle-size-calculator/">bangle size</a>; the calculator shows the matching Indian bangle size when you select that style.</p>

<h2>Standard bracelet sizes</h2>
<ul>
<li>Women: 7 in (17.8 cm) is standard; 6.5 in small, 7.5–8 in large.</li>
<li>Men: 8 in (20.3 cm) is standard; 8.5–9 in for larger wrists.</li>
<li>Children: 5–6 in (12.7–15 cm) depending on age.</li>
</ul>

<h2>More sizing tools</h2>
<ul>
<li><a href="/">Ring sizer</a></li>
<li><a href="/bangle-size-calculator/">Bangle size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What size bracelet for a 6.5 inch wrist?', 'Add ¾ inch for a comfortable chain bracelet: 7.25 inches (18.4 cm). For a snug fit choose 7 inches; for a loose fit 7.75 inches.' ),
				array( 'What size bracelet for a 7 inch wrist?', 'A 7.75 inch (19.7 cm) chain bracelet is comfortable; 7.5 inches is snug and 8.25 inches loose.' ),
				array( 'How do I measure my wrist without a tape measure?', 'Wrap a strip of paper or a piece of string around your wrist, mark the overlap, then lay it flat against a ruler.' ),
				array( 'What is the average bracelet size for women?', '7 inches (17.8 cm) is the standard women\'s bracelet length and fits a 6–6.5 inch wrist.' ),
			),
		),

		/* ------------------------------------------------------ RING CHART */
		'ring-chart' => array(
			'slug'      => 'ring-size-chart',
			'title'     => 'Ring Size Chart – US, UK, EU, India and mm',
			'seo_title' => 'Ring Size Chart 2026: US, UK, EU, India Sizes in mm and Inches',
			'seo_desc'  => 'Complete ring size chart with US, UK, EU/ISO and Indian sizes, inner diameter in mm and inches, and circumference. Convert any ring size instantly.',
			'mode'      => null,
			'content'   => '
<p><strong>Every ring size system in one chart.</strong> Find your size in one column and read across for the others. Diameters follow the ISO 8653 standard used by jewellers worldwide.</p>

[rbs_ring_table]

<h2>How to use this chart</h2>
<ul>
<li><strong>You know your US size:</strong> read across for UK, EU and India.</li>
<li><strong>You have a ring:</strong> measure its inner diameter in mm with a ruler or vernier and find the nearest value in the diameter column, or <a href="/">match it on screen</a> for a faster result.</li>
<li><strong>You measured your finger with string:</strong> use the circumference column.</li>
</ul>

<h2>How the size systems differ</h2>
<ul>
<li><strong>US / Canada / Mexico:</strong> numbers 3–15 in half steps; each full size is 0.8 mm of diameter.</li>
<li><strong>UK / Australia / NZ / Ireland / South Africa:</strong> letters A–Z with half sizes; each letter is about 0.4 mm.</li>
<li><strong>EU / ISO / Germany / France:</strong> the inner circumference in mm, so size 54 is 54 mm around.</li>
<li><strong>India / Japan / China:</strong> numbers starting at 1 for 13 mm, rising one number per 1/3 mm.</li>
<li><strong>Switzerland:</strong> circumference minus 40, so EU 54 is Swiss 14.</li>
</ul>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/bangle-size-chart/">Bangle size chart</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What is ring size 6 in mm?', 'US size 6 is 16.5 mm inner diameter (51.9 mm circumference), UK L½, EU 52.' ),
				array( 'What is ring size 8 in mm?', 'US size 8 is 18.1 mm inner diameter (57.0 mm circumference), UK P½, EU 57.' ),
				array( 'What is a 17 mm ring size?', 'A 17 mm inner diameter is between US 6.5 (16.9 mm) and 7 (17.3 mm); most people choose US 7 / UK N½.' ),
				array( 'How do I convert UK ring size to US?', 'Use the chart: UK L½ is US 6, UK N½ is US 7, UK P½ is US 8, UK R½ is US 9, UK T½ is US 10.' ),
			),
		),

		/* ---------------------------------------------------- BANGLE CHART */
		'bangle-chart' => array(
			'slug'      => 'bangle-size-chart',
			'title'     => 'Bangle Size Chart – Indian Sizes in mm, cm and Inches',
			'seo_title' => 'Bangle Size Chart 2026: 2.2, 2.4, 2.6, 2.8, 2.10 in mm, cm and Inches',
			'seo_desc'  => 'Indian bangle size chart with inner diameter in inches, mm and cm for sizes 1.10 to 3.0, plus who each size fits and how to measure at home.',
			'mode'      => null,
			'content'   => '
<p><strong>Indian bangle sizes explained in one chart.</strong> Each size is the inner diameter in inches and sixteenths: 2.4 means 2 4/16 inch. Read across for mm and cm, and the typical hand each size fits.</p>

[rbs_bangle_table]

<h2>How to measure your bangle size</h2>
<ol>
<li>Tuck your thumb into your palm.</li>
<li>Wrap a string around the widest part of your hand over the knuckles.</li>
<li>Measure the string in cm, divide by 3.14 for the diameter, then choose the next size up in the chart.</li>
</ol>
<p>Or skip the maths and use the <a href="/bangle-size-calculator/">bangle size calculator</a>, which also lets you match a bangle you own on your phone screen.</p>

<h2>Which bangle size should I buy?</h2>
<ul>
<li><strong>2.2:</strong> petite adults, teenagers; hand circumference up to about 17.5 cm.</li>
<li><strong>2.4:</strong> small adult hands, 17.5–18.5 cm; the most sold size.</li>
<li><strong>2.6:</strong> medium adult hands, 18.5–19.5 cm; the second most sold size.</li>
<li><strong>2.8:</strong> large hands, 19.5–20.5 cm.</li>
<li><strong>2.10 and 2.12:</strong> extra-large hands or a loose fit.</li>
<li><strong>Below 2.0:</strong> babies and children; see the kids rows in the chart.</li>
</ul>

[rbs_cta mode="bangle"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/">Ring size chart</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What is bangle size 2.8 in cm?', 'Size 2.8 has an inner diameter of 2.5 inches, which is 6.35 cm (63.5 mm).' ),
				array( 'What is bangle size 2.2 in mm?', 'Size 2.2 is 2 2/16 inch, an inner diameter of 54.0 mm (5.4 cm).' ),
				array( 'What bangle size is a 7.5 inch hand?', 'A hand circumference of 7.5 inches (19 cm) gives a diameter of about 60.6 mm, so choose size 2.6 (60.3 mm) if it slides on, otherwise 2.8.' ),
				array( 'Is bangle size the same as bracelet size?', 'No. Bangle size is the inner diameter and must clear your hand; bracelet size is the length around your wrist. A bracelet for a 6.5 inch wrist is about 7.25 inches long, while a rigid bangle for the same person is usually size 2.4 or 2.6.' ),
			),
		),
	);
}
