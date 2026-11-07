<?php
/**
 * Ring tool cluster (plan doc content map #20–#29, Phase 3):
 * ring size calculator, converter, printable sizer, how to measure at home,
 * ring size by diameter / circumference, and the wrist size chart.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_ring_tool_pages() {
	return array(

		/* ------------------------------------------------------ RING SIZE CALCULATOR */
		'ring-calc' => array(
			'slug'       => 'ring-size-calculator',
			'title'      => 'Ring Size Calculator – Ring Size from mm or Inches',
			'seo_title'  => 'Ring Size Calculator: Find Your Size from mm or Inches',
			'seo_desc'   => 'Enter a finger circumference or ring diameter in mm or inches and get your ring size in US, UK, EU and India sizes, with the formula and worked examples.',
			'mode'       => 'ring',
			'menu_order' => 0,
			'content'    => <<<'HTML'
<p><strong>Type a measurement, get your ring size.</strong> Enter the inside diameter of a ring that fits, or the circumference of your finger from a string or paper strip, in millimetres or inches. The calculator rounds to the nearest standard size and shows it in US, UK, EU/ISO and Indian sizes. Example: a finger that measures 54.3 mm around is a US 7 (UK N½, EU 54).</p>

[rbs_sizer mode="ring" method="mm" name="Ring Size Calculator"]

<h2>How to use the ring size calculator</h2>
<ol>
<li><strong>Pick what you measured.</strong> "Inner circumference" is the length of a string or paper strip wrapped around your finger. "Inner diameter" is the distance straight across the inside of a ring you already own.</li>
<li><strong>Type the number</strong> in mm, or choose the inch option if your ruler is in inches. Decimals are fine: 17.6 mm or 0.69 in.</li>
<li><strong>Read the result.</strong> The calculator picks the closest standard size. If your number is right between two sizes, the larger one is usually safer, because a ring must still pass over the knuckle.</li>
</ol>
<p>No measurement yet? Switch to <strong>"Match a ring I own"</strong>, calibrate with a bank card and place a ring on your screen, or follow the steps in <a href="/how-to-measure-ring-size-at-home/">how to measure ring size at home</a>.</p>

<h2>The formula behind the calculator</h2>
<p>US and Canadian ring sizes grow by a fixed step of about 0.81 mm of inner diameter per whole size. Jewellers' charts follow this line closely:</p>
<ul>
<li><strong>Inner diameter (mm) = 11.63 + 0.8128 × US size</strong></li>
<li><strong>US size = (inner diameter − 11.63) ÷ 0.8128</strong></li>
<li><strong>Diameter = circumference ÷ π</strong> (π = 3.1416), and circumference = diameter × π</li>
<li><strong>EU / ISO size</strong> = the inner circumference in mm, rounded</li>
</ul>
<p>The calculator does these steps for you and then matches the result to the standard chart (rather than printing a long decimal), because rings are only made in half and quarter sizes.</p>

<h2>Worked examples</h2>
<table class="rbs-table">
<thead><tr><th>You measured</th><th>Diameter</th><th>Calculation</th><th>Ring size</th></tr></thead>
<tbody>
<tr><td>Finger circumference 57 mm</td><td>57 ÷ 3.1416 = 18.14 mm</td><td>(18.14 − 11.63) ÷ 0.8128 = 8.0</td><td><a href="/ring-size-in-mm/size-8/">US 8</a> / UK P½ / EU 57</td></tr>
<tr><td>String around finger 2.2 in</td><td>55.9 mm ÷ 3.1416 = 17.79 mm</td><td>(17.79 − 11.63) ÷ 0.8128 = 7.58</td><td><a href="/ring-size-in-mm/size-7-5/">US 7.5</a> / UK O½ / EU 56</td></tr>
<tr><td>Ring inner diameter 16.5 mm</td><td>16.5 mm</td><td>(16.5 − 11.63) ÷ 0.8128 = 5.99</td><td><a href="/ring-size-in-mm/size-6/">US 6</a> / UK L½ / EU 52</td></tr>
<tr><td>Ring inner diameter 0.75 in</td><td>0.75 × 25.4 = 19.05 mm</td><td>(19.05 − 11.63) ÷ 0.8128 = 9.13</td><td><a href="/ring-size-in-mm/size-9/">US 9</a> / UK R½ / EU 60</td></tr>
<tr><td>Finger circumference 62 mm</td><td>62 ÷ 3.1416 = 19.74 mm</td><td>(19.74 − 11.63) ÷ 0.8128 = 9.98</td><td><a href="/ring-size-in-mm/size-10/">US 10</a> / UK T½ / EU 62</td></tr>
</tbody>
</table>
<p>For the full list of measurements and sizes, see <a href="/ring-size-by-circumference/">ring size by circumference</a> and <a href="/ring-size-by-diameter/">ring size by diameter</a>.</p>

<h2>Which measurement is more accurate?</h2>
<p>Measuring the inside of a ring that already fits is the most reliable home method, because a metal ring does not stretch and already reflects how tight you like it. A string or paper strip around the finger can be off by half a size: string stretches, paper slips, and it is easy to pull too tight. If you only have a finger measurement, measure two or three times and use the average. When the calculator says you are between two sizes, choose the larger one for a wide band and the smaller one for a thin band you will wear daily.</p>

<h2>Calculator, on-screen sizer or chart?</h2>
<ul>
<li><strong>This calculator</strong> is quickest when you already have a number from a ruler, caliper or tape.</li>
<li><strong>The <a href="/">on-screen ring sizer</a></strong> is quickest when you have a ring but no ruler: lay it on your phone and match the circle.</li>
<li><strong>The <a href="/ring-size-converter/">ring size converter</a></strong> is for when you already know your size in one system (say UK N) and need it in another (US or EU).</li>
<li><strong>The <a href="/printable-ring-sizer/">printable ring sizer</a></strong> gives you paper circles and a finger strip if you prefer to measure away from a screen.</li>
</ul>

<h2>Things the calculator cannot know</h2>
<ul>
<li><strong>Band width.</strong> Bands wider than about 6 mm fit tighter. Add ¼ to ½ size.</li>
<li><strong>Your knuckle.</strong> If the knuckle is much larger than the base of the finger, measure both and choose a size between them.</li>
<li><strong>Temperature and time of day.</strong> Fingers are smaller in the morning and in the cold. Measure in the evening at room temperature.</li>
<li><strong>Which hand.</strong> The dominant hand is often ¼ to ½ size larger, so measure the finger the ring is for.</li>
</ul>

[rbs_cta mode="ring"]
HTML
			,
			'faq'        => array(
				array( 'How do I calculate my ring size from mm?', 'If you measured a ring\'s inner diameter, find the nearest value in the chart or use US size = (diameter − 11.63) ÷ 0.8128. If you measured around your finger, divide by 3.1416 first to get the diameter. A 17.3 mm diameter or 54.3 mm circumference is US 7.' ),
				array( 'What ring size is 55 mm circumference?', '55 mm around is a diameter of 17.5 mm, between US 7 (17.3 mm) and US 7.5 (17.7 mm). Most people choose US 7.5, UK O½, EU 55–56.' ),
				array( 'What ring size is 2 inches around?', '2 inches is 50.8 mm of circumference and 16.2 mm of diameter, which is closest to US 5.5 (UK K½, EU 51).' ),
				array( 'Is it better to round a ring size up or down?', 'Round up when you are exactly between two sizes, when the band is wide, or when your knuckle is large. Round down only for a thin band on a slim knuckle that spins easily.' ),
				array( 'How accurate is a ring size calculator?', 'The maths is exact; the result is only as good as the measurement. A ring measured with a caliper gives about ±¼ size. A string around the finger is usually within ±½ size.' ),
			),
		),

		/* -------------------------------------------------------- RING SIZE CONVERTER */
		'ring-converter' => array(
			'slug'       => 'ring-size-converter',
			'title'      => 'Ring Size Converter – US, UK, EU, India and mm',
			'seo_title'  => 'Ring Size Converter: US to UK, EU, India and mm',
			'seo_desc'   => 'Convert ring sizes between US, UK, EU/ISO, India and Swiss sizes, or from mm and inches. Instant converter plus a full conversion chart.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => <<<'HTML'
<p><strong>Convert a ring size from one country's system to another in one step.</strong> Choose the system you know, pick your size, and the converter shows the same ring in US, UK, EU/ISO, Indian and Italian/Swiss sizes, with the inner diameter and circumference. For example, US 7 = UK N½ = EU 54 = India 14 = 17.3 mm.</p>

[rbs_ring_converter]

<h2>Ring size conversion chart</h2>
<p>The same data as the converter, for every size from US 3 to 15. Diameters follow ISO 8653.</p>
[rbs_ring_table]

<h2>Most searched conversions</h2>
<table class="rbs-table">
<thead><tr><th>Conversion</th><th>Answer</th></tr></thead>
<tbody>
<tr><td>US 5 to UK</td><td>UK J½ (15.7 mm, EU 49)</td></tr>
<tr><td>US 6 to UK</td><td>UK L½ (16.5 mm, EU 52)</td></tr>
<tr><td>US 7 to UK</td><td>UK N½ (17.3 mm, EU 54)</td></tr>
<tr><td>US 8 to UK</td><td>UK P½ (18.1 mm, EU 57)</td></tr>
<tr><td>US 9 to UK</td><td>UK R½ (19.0 mm, EU 60)</td></tr>
<tr><td>US 10 to UK</td><td>UK T½ (19.8 mm, EU 62)</td></tr>
<tr><td>UK L to US</td><td>about US 5¾; UK L½ is US 6</td></tr>
<tr><td>UK N to US</td><td>about US 6¾; UK N½ is US 7</td></tr>
<tr><td>UK P to US</td><td>about US 7¾; UK P½ is US 8</td></tr>
<tr><td>EU 52 to US</td><td>US 6 (51.8 mm around)</td></tr>
<tr><td>EU 54 to US</td><td>US 7 (54.3 mm around)</td></tr>
<tr><td>EU 57 to US</td><td>US 8 (56.9 mm around)</td></tr>
<tr><td>India 12 to US</td><td>US 6 (52 mm around, 16.5 mm)</td></tr>
<tr><td>India 14 to US</td><td>US 7 (54 mm around, 17.2 mm)</td></tr>
<tr><td>India 17 to US</td><td>US 8 (57 mm around, 18.1 mm)</td></tr>
<tr><td>India 22 to US</td><td>US 10 (62 mm around, 19.7 mm)</td></tr>
</tbody>
</table>

<h2>How each ring size system works</h2>
<h3>US and Canada</h3>
<p>Numbers from about 3 to 15, in half and quarter sizes. Each whole size adds about 0.81 mm of inner diameter (2.55 mm of circumference). Mexico and much of South America use the same scale.</p>
<h3>UK, Ireland, Australia and New Zealand</h3>
<p>Letters from A to Z, with half sizes such as N½. Each letter adds about 1.25 mm of circumference (0.4 mm of diameter), roughly half a US size. Sizes above Z are written Z+1, Z+2 and so on.</p>
<h3>EU and ISO (Germany, France, Netherlands, Belgium)</h3>
<p>The inner circumference in millimetres. EU 54 is a ring 54 mm around the inside. Because it is a measurement rather than a code, it is the easiest system to convert from: divide by 3.1416 for the diameter.</p>
<h3>India and Pakistan</h3>
<p>Whole numbers, each one the inner circumference in mm minus 40. Indian size 14 is 54 mm around (17.2 mm across), the same as US 7; size 22 is 62 mm around, US 10. Local jewellers in Pakistan use the same scale; see the <a href="/ring-size-chart/pakistan/">ring size chart for Pakistan</a>.</p>
<h3>Italy, Spain and Switzerland</h3>
<p>The EU circumference minus 40. EU 54 is Italian, Spanish or Swiss 14; EU 57 is 17. Many Italian and Swiss jewellery brands use this scale, so an Italian 14 is not EU 14. Germany usually gives the EU number or the inner diameter in mm (German 17 = 17 mm across).</p>

<h2>Why conversions are sometimes off by a quarter size</h2>
<p>Each system rounds differently. A UK half letter and a US quarter size are both about 0.2 mm of diameter and an Indian number is about 0.32 mm, but they do not line up exactly, so one UK size can fall between two US sizes. Brands also differ slightly in how they cut their mandrels. When the converter shows a size between two of yours, or a shop's chart disagrees with this one by a quarter size, trust the diameter in mm: ask the seller for the inner diameter of their size and compare it with a ring you already own, measured with the <a href="/ring-size-calculator/">ring size calculator</a> or the <a href="/">on-screen sizer</a>.</p>

<h2>Buying a ring from another country</h2>
<ul>
<li><strong>From the US (Amazon, Etsy, US brands):</strong> use the US column. Quarter sizes are common.</li>
<li><strong>From the UK or Australia:</strong> use the letter column; half letters are standard in UK jewellers.</li>
<li><strong>From Europe:</strong> use the EU number, which is the circumference in mm.</li>
<li><strong>From India, Pakistan or the Gulf:</strong> local shops use the India number; international brands there use US or EU sizes.</li>
<li><strong>Resizing:</strong> most plain gold and silver bands can be resized one or two sizes. Eternity rings, tungsten and titanium usually cannot, so convert carefully before ordering.</li>
</ul>

[rbs_cta mode="ring"]
HTML
			,
			'faq'        => array(
				array( 'How do I convert a US ring size to UK?', 'Use the converter or chart: US 6 is UK L½, US 7 is UK N½, US 8 is UK P½, US 9 is UK R½ and US 10 is UK T½. One US size is about two UK letters.' ),
				array( 'What is a size 7 ring in Europe?', 'US 7 has a 54.3 mm inner circumference, so it is EU 54 (Swiss 14).' ),
				array( 'Is UK size N the same as US 7?', 'Almost. UK N is about US 6¾ and UK N½ is US 7. If a UK shop only offers whole letters, choose N for a snug fit or O for a looser fit.' ),
				array( 'What is Indian ring size 12 in US size?', 'Indian size 12 is 52 mm around (16.5 mm across), which is US 6 and UK L½.' ),
				array( 'Are ring sizes the same for men and women?', 'Yes. Ring sizes measure the inside of the ring, so the same chart applies to everyone. Men simply tend to wear larger sizes (US 9–11) than women (US 5–7).' ),
			),
		),

		/* --------------------------------------------------------- PRINTABLE SIZER */
		'printable' => array(
			'slug'       => 'printable-ring-sizer',
			'title'      => 'Printable Ring Sizer – Free PDF with True-Size Circles',
			'seo_title'  => 'Printable Ring Sizer: Free PDF (A4 and US Letter)',
			'seo_desc'   => 'Free printable ring sizer PDF with true-size circles for US 4–12.5 and a finger sizing strip. Includes a 50 mm check line so you know it printed at 100%.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => <<<'HTML'
<p><strong>Print one page, check the scale, and find your ring size on paper.</strong> The free PDF has true-size circles for US sizes 4 to 12.5 (with UK sizes and mm), a cut-out finger strip, and a 50 mm check line plus a bank-card box so you can confirm it printed at the right size. Choose US Letter or A4 to match your paper.</p>

[rbs_printable_sizer]

<h2>Step 1: Print it at the right size</h2>
<p>A printable sizer only works if the printer does not shrink the page. Most printers default to "Fit to page", which scales everything down by 3–6% – enough to make a ring look one full size smaller.</p>
<ul>
<li><strong>Chrome or Edge:</strong> open the PDF, press Print, open "More settings" and set Scale to <em>Default</em> or <em>100</em>, not "Fit to printable area".</li>
<li><strong>Adobe Acrobat Reader:</strong> under Page Size &amp; Handling choose <em>Actual size</em>.</li>
<li><strong>Mac Preview:</strong> set Scale to 100% and untick "Scale to fit".</li>
<li><strong>Phone:</strong> sending the PDF to a printer from a phone often scales it. If the check line is not 50 mm, print from a computer instead.</li>
</ul>

<h2>Step 2: Check the scale</h2>
<p>Before you measure anything, put a ruler on the line at the top of the sheet. It must be exactly 50 mm (5 cm) long. Then lay a bank card, debit card or ID card in the dashed box: all of these cards are 85.6 × 54 mm worldwide, so the card should fit the outline exactly. If the line is 48 mm or the card overhangs the box, the page was scaled; reprint at 100%. Do not try to correct it by eye.</p>

<h2>Step 3: Measure</h2>
<h3>With a ring that fits</h3>
<ol>
<li>Lay the ring flat on the circles.</li>
<li>Find the circle whose line sits exactly on the <em>inside</em> edge of the ring, with no paper showing inside the circle line and no line hidden under the metal.</li>
<li>If the ring falls between two circles, choose the larger size.</li>
</ol>
<h3>With the finger strip</h3>
<ol>
<li>Cut out the strip along the dashed line.</li>
<li>Wrap it around the base of the finger with the numbers facing out, so the 0 end overlaps the scale.</li>
<li>Pull it snug but not tight, then slide it over the knuckle to check it still passes.</li>
<li>Read the US size at the point where the end of the strip meets the blue scale. The mm scale underneath gives the circumference if you prefer to look it up in the <a href="/ring-size-by-circumference/">ring size by circumference</a> table.</li>
</ol>

<h2>How accurate is a printable ring sizer?</h2>
<p>The circles in the PDF are drawn as vectors to 0.01 mm, so the limit is your printer and your eye. A correctly scaled print is typically within 0.2–0.3 mm, or about half a size at worst. The ring-on-circle method is more reliable than the paper strip, because paper can stretch or be wrapped at an angle. For a second opinion without paper, use the <a href="/">on-screen ring sizer</a>, which is calibrated with the same bank card.</p>

<h2>Common mistakes</h2>
<ul>
<li><strong>Measuring the outside of the ring.</strong> Only the inside edge matters.</li>
<li><strong>Skipping the scale check.</strong> A 5% shrink is invisible to the eye but changes the result by a whole size.</li>
<li><strong>Using thin printer paper for the strip.</strong> Thicker paper or card stock stretches less.</li>
<li><strong>Measuring cold fingers.</strong> Measure in the evening at room temperature.</li>
</ul>

<h2>Prefer not to print?</h2>
<p>You can do the same thing on your phone: the <a href="/">online ring sizer</a> draws true-size circles after a one-time card calibration. If you already have a measurement, the <a href="/ring-size-calculator/">ring size calculator</a> converts it directly, and the step-by-step guide on <a href="/how-to-measure-ring-size-at-home/">how to measure ring size at home</a> compares every method.</p>
HTML
			,
			'faq'        => array(
				array( 'How do I make sure my printable ring sizer is the right size?', 'Print at 100% or "Actual size" and measure the check line with a ruler: it must be exactly 50 mm. A bank or ID card should also fit the dashed card outline exactly.' ),
				array( 'Can I print a ring sizer on A4 paper?', 'Yes. Download the A4 version. The circles are the same size on both versions; only the page layout changes.' ),
				array( 'Why does my printed ring sizer seem too small?', 'The printer most likely used "Fit to page", which shrinks the sheet by a few percent. Reprint with scaling set to 100%.' ),
				array( 'Is a printable ring sizer accurate?', 'When printed at 100% it is usually accurate to about half a size. Matching an existing ring to the circles is more accurate than wrapping the paper strip around your finger.' ),
			),
		),

		/* ------------------------------------------------- HOW TO MEASURE AT HOME */
		'ring-measure' => array(
			'slug'       => 'how-to-measure-ring-size-at-home',
			'title'      => 'How to Measure Ring Size at Home – 5 Easy Methods',
			'seo_title'  => 'How to Measure Ring Size at Home: 5 Easy Methods',
			'seo_desc'   => 'Measure your ring size at home with your phone, a ring and ruler, string, paper or a printable sizer. Step by step, with accuracy compared and examples.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => <<<'HTML'
<p><strong>The most accurate way to measure your ring size at home is to measure a ring that already fits.</strong> Lay it on your phone with the <a href="/">on-screen ring sizer</a>, or measure its inside diameter with a ruler. If you have no ring, wrap a strip of paper around your finger and look up the length. Both take less than five minutes; the details below show how to avoid the half-size errors most people make.</p>

<h2>Which method should you use?</h2>
<table class="rbs-table">
<thead><tr><th>Method</th><th>You need</th><th>Typical accuracy</th><th>Best for</th></tr></thead>
<tbody>
<tr><td>1. On-screen sizer</td><td>Phone + bank card + a ring</td><td>±¼ size</td><td>Fastest, no tools</td></tr>
<tr><td>2. Ring + ruler or caliper</td><td>A ring + mm ruler</td><td>±½ size (ruler), ±¼ (caliper)</td><td>When you have a ruler</td></tr>
<tr><td>3. Paper strip or string</td><td>Paper / thread + ruler</td><td>±½ size</td><td>No ring that fits</td></tr>
<tr><td>4. Printable sizer</td><td>Printer + ruler</td><td>±½ size</td><td>Measuring away from a screen</td></tr>
<tr><td>5. Plastic ring sizer</td><td>Reusable sizer belt</td><td>±¼ size</td><td>Measuring several people</td></tr>
</tbody>
</table>

<h2>Method 1: On your phone screen</h2>
<ol>
<li>Open the <a href="/">ring sizer</a> on your phone.</li>
<li>Hold any bank, debit or ID card against the screen and drag the slider until the outline matches the card. All these cards are 85.6 mm wide, so this tells the tool the true size of your screen.</li>
<li>Lay a ring that fits the right finger flat on the screen and adjust the circle until it lines up with the <em>inside</em> edge.</li>
<li>Read your US, UK, EU, Indian size and the diameter in mm.</li>
</ol>
<p><em>Example:</em> the circle matches the ring at 17.7 mm, so the size is US 7.5 / UK O½.</p>

<h2>Method 2: Measure a ring with a ruler</h2>
<ol>
<li>Put the ring on a ruler with millimetre marks.</li>
<li>Measure straight across the centre, from inside edge to inside edge.</li>
<li>Measure again at right angles and take the average, since rings are rarely perfectly round.</li>
<li>Enter the number in the <a href="/ring-size-calculator/">ring size calculator</a> or find it in <a href="/ring-size-by-diameter/">ring size by diameter</a>.</li>
</ol>
[rbs_diagram name="ring-inner"]
<p><em>Example:</em> 18 mm one way and 18.2 mm the other gives 18.1 mm, which is US 8 / UK P½. A digital caliper (inside jaws) gives 0.1 mm readings and is the most accurate home tool.</p>

<h2>Method 3: String or paper strip around your finger</h2>
<ol>
<li>Cut a strip of paper about 5 mm wide and 10 cm long. Paper stretches less than string; if you use thread, choose non-stretch sewing thread or dental floss.</li>
<li>Wrap it around the base of the finger, snug but not tight. It must still slide over the knuckle.</li>
<li>Mark the point where the end overlaps with a fine pen.</li>
<li>Lay it flat on a ruler and measure to the mark in millimetres. This is your finger circumference.</li>
<li>Look it up in <a href="/ring-size-by-circumference/">ring size by circumference</a>, or divide by 3.1416 for the diameter.</li>
</ol>
[rbs_diagram name="paper-strip"]
<p><em>Example:</em> the strip measures 59.5 mm. 59.5 ÷ 3.1416 = 18.9 mm diameter, closest to US 9 / UK R½ / EU 60.</p>
<p>Repeat three times. If the readings differ by more than 1.5 mm, you pulled harder on one of them; use the middle value.</p>

<h2>Method 4: Printable ring sizer</h2>
<p>Download the free <a href="/printable-ring-sizer/">printable ring sizer</a>, print at 100% and check the 50 mm line with a ruler. Then match a ring to the true-size circles or use the cut-out finger strip. This is a good option if you need to measure someone else's ring without a phone nearby.</p>

<h2>Method 5: A plastic ring sizer</h2>
<p>Reusable plastic sizer belts cost very little and work like a small belt: thread the end through, tighten and read the size. They are as accurate as a jeweller's ring stick, but make sure the one you buy uses the same system as the shop (US numbers or UK letters).</p>

<h2>Tips for an accurate result</h2>
<ul>
<li><strong>Time of day:</strong> measure in the late afternoon or evening. Fingers are smallest in the morning.</li>
<li><strong>Temperature:</strong> cold makes fingers shrink, heat and exercise make them swell. Measure at normal room temperature.</li>
<li><strong>Right finger, right hand:</strong> the dominant hand is often ¼ to ½ size larger.</li>
<li><strong>Knuckles:</strong> if your knuckle is much bigger than the base of the finger, measure both and choose a size between them.</li>
<li><strong>Wide bands:</strong> for bands 6 mm or wider, go up ¼ to ½ size.</li>
<li><strong>Between two sizes:</strong> choose the larger one. A ring that is slightly loose can be fitted with a sizing bead; one that will not pass the knuckle cannot be worn.</li>
</ul>

<h2>Measuring someone else's ring size secretly</h2>
<p>For a surprise engagement ring, borrow a ring they wear on the <em>same</em> finger and measure it on your phone with the <a href="/">ring sizer</a> or with a ruler, then put it back. If you can only borrow a ring from another finger, remember that the ring finger is usually about half a size smaller than the middle finger. Most women wear US 5 to 7 and most men US 8 to 11, but buy from a jeweller that offers free resizing in case you are off.</p>
<p>More ideas, from tracing a ring to asking a friend: <a href="/blog/find-ring-size-secretly/">how to find out someone's ring size secretly</a>.</p>

[rbs_cta mode="ring"]
HTML
			,
			'faq'        => array(
				array( 'How can I measure my ring size without a measuring tape?', 'Wrap a strip of paper around your finger, mark the overlap and measure the strip against any ruler, or skip the ruler entirely: put a ring that fits on your phone and use the on-screen ring sizer, calibrated with a bank card.' ),
				array( 'Is measuring ring size with string accurate?', 'String can stretch and is easy to pull too tight, so it is usually accurate to about half a size. Non-stretch thread, dental floss or a paper strip give better results. Measure three times and use the middle value.' ),
				array( 'What finger size is average for a woman?', 'Most women wear US 6 to 7 on the ring finger, which is 16.5 to 17.3 mm in diameter, UK L½ to N½.' ),
				array( 'Should a ring be tight or loose?', 'It should slide over the knuckle with a little resistance and not spin freely at the base of the finger. If it leaves a deep mark or is hard to remove, it is too tight.' ),
				array( 'Does ring size change over time?', 'Yes. Weight change, pregnancy, age and arthritis can all change finger size, so measure again before buying a new ring rather than relying on a size from years ago.' ),
			),
		),

		/* ---------------------------------------------------- RING SIZE BY DIAMETER */
		'ring-diameter' => array(
			'slug'       => 'ring-size-by-diameter',
			'title'      => 'Ring Size by Diameter – mm and Inches to Ring Size',
			'seo_title'  => 'Ring Size by Diameter: mm and Inches to US, UK, EU',
			'seo_desc'   => 'Look up your ring size from the inner diameter of a ring in mm or inches. Exact diameter ranges for every US size, with UK and EU equivalents.',
			'mode'       => null,
			'menu_order' => 4,
			'content'    => <<<'HTML'
<p><strong>Ring size by diameter means measuring straight across the inside of a ring.</strong> A 16.5 mm inner diameter is US 6, 17.3 mm is US 7 and 18.1 mm is US 8; each whole size adds about 0.8 mm. Find the band your measurement falls into below, in millimetres or inches, or type it into the <a href="/ring-size-calculator/">ring size calculator</a>.</p>

<h2>Diameter ranges for every ring size</h2>
<p>Each row shows the band of measurements that is closest to that size. If you measured 17.4 mm, it falls in the 17.10–17.50 mm band, so you are a US 7.</p>
[rbs_diameter_ranges]

<h2>Ring size from diameter in inches</h2>
<p>If your ruler or caliper reads in inches, use this table. Values are every 0.02 inch.</p>
[rbs_inch_lookup]

<h2>How to measure a ring's inner diameter</h2>
<ol>
<li>Choose a ring that fits the finger you are sizing. A plain band is easiest; a ring with a stone can be measured if you keep the ruler clear of the setting.</li>
<li>Place it on a ruler with mm marks, or open the inside jaws of a caliper inside it.</li>
<li>Measure the widest distance across the inside, through the centre, not the outside edge.</li>
<li>Turn the ring 90° and measure again. Use the average of the two readings.</li>
</ol>
<p>With a ruler you can read to about 0.5 mm, which is a little more than one half size, so use the ruler result as a guide and check it with the <a href="/">on-screen sizer</a> if the reading lands near the edge of a band. A caliper reads to 0.1 mm and can tell quarter sizes apart.</p>

<h2>Converting diameter to size by hand</h2>
<p>US sizes follow a straight line: <strong>US size = (diameter in mm − 11.63) ÷ 0.8128</strong>. For example, 18.5 mm gives (18.5 − 11.63) ÷ 0.8128 = 8.45, so US 8.5. To get the EU/ISO size, multiply the diameter by 3.1416: 18.5 × 3.1416 = 58.1, so EU 58. For inches, multiply by 25.4 first: 0.70 in × 25.4 = 17.8 mm, which is US 7.5.</p>

<h2>Diameter versus circumference</h2>
<p>Diameter is what you get from a ring; circumference is what you get from your finger. They describe the same size: circumference = diameter × π. If you measured around your finger with string or paper, use <a href="/ring-size-by-circumference/">ring size by circumference</a> instead. Mixing the two is the most common reason people order a ring three sizes too large.</p>

<h2>Common diameters</h2>
<ul>
<li><strong>15 mm</strong> – US 4 to 4.5, a small size for women or a pinky ring.</li>
<li><strong>16 mm</strong> – US 5 to 5.5, petite women's sizes.</li>
<li><strong>17 mm</strong> – US 6.5 to 7, the most common women's size.</li>
<li><strong>18 mm</strong> – US 8, a large women's or small men's size.</li>
<li><strong>19 mm</strong> – US 9, a common men's size.</li>
<li><strong>20 mm</strong> – US 10 to 10.5, a large men's size.</li>
<li><strong>21–22 mm</strong> – US 11.5 to 13, for large hands or thumb rings.</li>
</ul>
<p>Every size has its own page with all conversions; start at <a href="/ring-size-in-mm/">ring size in mm</a>.</p>

[rbs_cta mode="ring"]
HTML
			,
			'faq'        => array(
				array( 'What ring size is 18 mm diameter?', '18 mm falls in the US 8 band (17.90–18.30 mm). It is UK P½ and EU 57.' ),
				array( 'What ring size is 20 mm diameter?', '20 mm sits exactly between US 10 (19.8 mm, UK T½) and US 10.5 (20.2 mm, UK U½). Choose 10.5 for a wide band or a large knuckle, and 10 for a thin band.' ),
				array( 'What ring size is 0.7 inch diameter?', '0.70 inch is 17.8 mm, which is US 7.5, UK O½, EU 56.' ),
				array( 'Is ring size measured by inner or outer diameter?', 'Always the inner diameter, the part that touches your finger. The outer diameter depends on how thick the band is.' ),
			),
		),

		/* ----------------------------------------------- RING SIZE BY CIRCUMFERENCE */
		'ring-circ' => array(
			'slug'       => 'ring-size-by-circumference',
			'title'      => 'Ring Size by Circumference – Finger mm to Ring Size',
			'seo_title'  => 'Ring Size by Circumference: Finger mm to US, UK, EU',
			'seo_desc'   => 'Measured around your finger? Find your ring size from the circumference in mm or inches, from 44 to 75 mm, with US, UK and EU sizes and measuring tips.',
			'mode'       => null,
			'menu_order' => 5,
			'content'    => <<<'HTML'
<p><strong>If you wrapped a string or paper strip around your finger, the length you measured is your finger circumference, and it maps directly to a ring size.</strong> 52 mm around is US 6, 54 mm is US 7, 57 mm is US 8 and 60 mm is US 9. The EU/ISO size is simply the circumference in mm. Find your measurement in the table below.</p>

<h2>Ring size by finger circumference</h2>
<p>Rows are every millimetre from 44 to 75 mm. The diameter column shows the matching ring diameter (circumference ÷ 3.1416).</p>
[rbs_circ_lookup]

<h2>How to measure your finger circumference</h2>
<ol>
<li>Cut a paper strip about 5 mm wide, or take a length of non-stretch thread or dental floss.</li>
<li>Wrap it once around the base of the finger the ring is for. It should be snug but able to slide over the knuckle.</li>
<li>Mark where the end overlaps with a fine pen. Do not let the strip twist.</li>
<li>Unroll it and measure from the end to the mark in millimetres.</li>
<li>Repeat twice more and use the middle value.</li>
</ol>
<p>The <a href="/printable-ring-sizer/">printable ring sizer</a> includes a pre-marked finger strip if you would rather not use a ruler.</p>

<h2>Circumference in inches</h2>
<p>Many tape measures in the US read in inches. Multiply by 25.4 to get millimetres: 2.1 in × 25.4 = 53.3 mm, which is between US 6.5 and 7. Common values:</p>
<ul>
<li>1.9 in (48.3 mm) – US 4.5</li>
<li>2.0 in (50.8 mm) – US 5.5</li>
<li>2.1 in (53.3 mm) – US 6.5</li>
<li>2.2 in (55.9 mm) – US 7.5</li>
<li>2.3 in (58.4 mm) – US 8.5</li>
<li>2.4 in (61.0 mm) – US 9.5</li>
<li>2.5 in (63.5 mm) – US 10.5</li>
</ul>

<h2>Why finger measurements often come out too large or small</h2>
<p>A string measurement is only as good as the tension you used. Pull 1 mm too tight and you lose almost half a size; leave it loose and you gain one. Thick string adds its own width: a 1 mm thread wrapped around a finger reads about 3 mm longer than the true circumference. That is why paper strips and thin floss give better results, and why measuring a ring you already own is more reliable still. If you have such a ring, use <a href="/ring-size-by-diameter/">ring size by diameter</a> or the <a href="/">on-screen ring sizer</a> instead.</p>

<h2>Knuckles and between sizes</h2>
<p>A ring has to pass over the knuckle, so the knuckle sets the minimum size. If your knuckle measures 58 mm but the base of the finger is only 55 mm, a US 8.5 (58.1 mm) will pass the knuckle but may spin; a size in between, around US 8, is usually the best compromise. For wide bands of 6 mm or more, add about 1 mm of circumference (roughly half a size) to the reading.</p>

<h2>From circumference to the other systems</h2>
<ul>
<li><strong>EU / ISO:</strong> the circumference itself, rounded. 54 mm = EU 54.</li>
<li><strong>India / Pakistan, Italy, Spain, Switzerland:</strong> circumference minus 40. 54 mm = size 14.</li>
<li><strong>US:</strong> divide by 3.1416 for the diameter, then (diameter − 11.63) ÷ 0.8128.</li>
<li><strong>UK and others:</strong> use the <a href="/ring-size-converter/">ring size converter</a>.</li>
</ul>

[rbs_cta mode="ring"]
HTML
			,
			'faq'        => array(
				array( 'What ring size is 50 mm circumference?', '50 mm around is a diameter of 15.9 mm, closest to US 5 (49.3 mm) or 5.5 (50.6 mm). Most people take US 5.5 / UK K½ / EU 50–51.' ),
				array( 'What ring size is 60 mm circumference?', '60 mm is a diameter of 19.1 mm, which is US 9 (UK R½, EU 60).' ),
				array( 'What ring size is 2.5 inches around?', '2.5 inches is 63.5 mm, which is US 10.5, UK U½ and EU 63.' ),
				array( 'Is EU ring size the same as circumference?', 'Yes. EU and ISO ring sizes are the inner circumference in millimetres, so a 54 mm finger is EU 54.' ),
			),
		),

		/* --------------------------------------------------------- WRIST SIZE CHART */
		'wrist-chart' => array(
			'slug'       => 'wrist-size-chart',
			'title'      => 'Wrist Size Chart – Wrist to Bracelet Size in Inches and cm',
			'seo_title'  => 'Wrist Size Chart: Bracelet Size by Wrist (in and cm)',
			'seo_desc'   => 'Wrist size chart from 5 to 9 inches with the matching bracelet length for snug, comfortable and loose fit, average wrist sizes, and how to measure.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => <<<'HTML'
<p><strong>Your wrist size is the distance around your wrist just below the wrist bone.</strong> A bracelet should be ½ to 1¼ inch longer than that, depending on how loose you like it. For example, a 6.5 inch (16.5 cm) wrist needs a 7.25 inch (18.4 cm) chain bracelet for a comfortable fit. Find your wrist in the chart, or enter it in the <a href="/bracelet-size-calculator/">bracelet size calculator</a>.</p>

<h2>Wrist size to bracelet size chart</h2>
[rbs_wrist_table]
<p>Snug = wrist + ½ in (1.3 cm), comfortable = wrist + ¾ in (1.9 cm), loose = wrist + 1¼ in (3.2 cm). These are for chain, link and beaded bracelets. Rigid bangles and cuffs are sized differently (see below).</p>

<h2>How to measure your wrist</h2>
<ol>
<li>Wrap a soft tape measure around the wrist just below the wrist bone, where a bracelet or watch sits.</li>
<li>Keep it flat against the skin, snug but not tight.</li>
<li>Read the measurement where the tape overlaps. No tape? Use a strip of paper or string, mark the overlap and measure it against a ruler.</li>
<li>Measure the wrist you will wear the bracelet on; the dominant wrist can be slightly larger.</li>
</ol>
<p>Measure on bare skin. If you will wear the bracelet over a sleeve or next to a watch, add another ¼ inch.</p>

<h2>Average wrist sizes</h2>
<table class="rbs-table">
<thead><tr><th>Group</th><th>Typical wrist</th><th>Usual bracelet length</th></tr></thead>
<tbody>
<tr><td>Women</td><td>5.5–6.5 in (14–16.5 cm)</td><td>6.5–7.5 in; 7 in is standard</td></tr>
<tr><td>Men</td><td>6.5–7.5 in (16.5–19 cm)</td><td>7.5–8.5 in; 8 in is standard</td></tr>
<tr><td>Teens</td><td>5–6 in (12.7–15 cm)</td><td>6–6.5 in</td></tr>
<tr><td>Children 4–9 years</td><td>4.5–5.25 in (11.5–13.5 cm)</td><td>5–6 in</td></tr>
<tr><td>Babies and toddlers</td><td>3.5–4.5 in (9–11.5 cm)</td><td>4–5 in, safety clasp</td></tr>
</tbody>
</table>
<p>These are averages only; build and height vary a lot, so measure rather than guess.</p>

<h2>Wrist size for bangles and cuffs</h2>
<p>A <strong>rigid bangle</strong> has no clasp, so it must slide over the widest part of your hand, not just your wrist. Its size depends on your hand, folded with the thumb tucked in. Use the <a href="/bangle-size-calculator/">bangle size calculator</a> or the <a href="/how-to-measure-bangle-size/">bangle measuring guide</a> instead of this chart. An <strong>open cuff</strong> sits on the wrist, so it needs only ¼ to ¾ inch more than your wrist size.</p>

<h2>Wrist size for watches</h2>
<p>Watch straps are sized by wrist circumference too. A standard strap fits about 6–8 in (15–20 cm) wrists; small straps fit about 5.5–7 in and long straps 7–9 in. Watch case size is a matter of taste, but as a rough guide wrists under 6.5 in suit cases up to about 38 mm, and wrists over 7 in suit 40–44 mm.</p>

<h2>Small, medium or large wrist?</h2>
<p>Bracelet makers often sell S/M/L instead of lengths. As a general guide: <strong>small</strong> fits a wrist up to about 6 in (15 cm), <strong>medium</strong> 6–7 in (15–18 cm), <strong>large</strong> 7–8 in (18–20 cm) and <strong>extra large</strong> above 8 in. Always check the actual length in the product description, since brands differ.</p>

[rbs_cta mode="bracelet"]
HTML
			,
			'faq'        => array(
				array( 'What is the average wrist size for a woman?', 'Most women have a wrist of 5.5 to 6.5 inches (14 to 16.5 cm), which is why 7 inch bracelets are standard.' ),
				array( 'What is the average wrist size for a man?', 'Most men have a wrist of 6.5 to 7.5 inches (16.5 to 19 cm) and wear 8 inch bracelets.' ),
				array( 'What size bracelet for a 6 inch wrist?', 'A 6.75 inch (17.1 cm) chain bracelet gives a comfortable fit. Choose 6.5 inches for snug or 7.25 inches for loose.' ),
				array( 'What size bracelet for an 8 inch wrist?', 'An 8.75 inch (22.2 cm) bracelet is comfortable; 8.5 inches is snug and 9.25 inches loose.' ),
				array( 'Is wrist size the same as bracelet size?', 'No. Bracelet size is the length of the bracelet, which must be longer than your wrist so it can move. Add ½ to 1¼ inch to your wrist size.' ),
			),
		),
	);
}
