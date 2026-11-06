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
			'seo_title' => 'Online Ring Sizer – Find Your Ring Size on Your Phone Screen',
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
<li><a href="/ring-size-calculator/">Ring size calculator</a> – from a measurement in mm or inches</li>
<li><a href="/ring-size-converter/">Ring size converter</a> – US, UK, EU and India sizes</li>
<li><a href="/printable-ring-sizer/">Printable ring sizer</a> – free PDF</li>
<li><a href="/how-to-measure-ring-size-at-home/">How to measure ring size at home</a></li>
</ul>
',
			'faq' => array(
				array( 'How do I find my ring size at home?', 'Use an on-screen sizer like the one above: calibrate with a bank card, then match a ring you already own to the circle. Alternatively wrap a thin strip of paper around the base of your finger, mark where it overlaps, measure the length in mm and look it up in the circumference column of the chart.' ),
				array( 'What is the average ring size for women and men?', 'In the US and UK the most common women\'s ring size is 6–7 (UK L–N, 16.5–17.3 mm). The most common men\'s size is 9–10 (UK R–T, 19–19.8 mm).' ),
				array( 'Can I measure my ring size on my phone?', 'Yes. After calibrating with a credit card the circle on screen is drawn at true size, so a ring placed on the phone can be matched to within about a quarter size.' ),
				array( 'What is ring size 7 in mm?', 'US size 7 has an inner diameter of 17.3 mm and a circumference of 54.3 mm. It is UK size N½ and EU size 54.' ),
				array( 'Is UK ring size the same as US?', 'No. UK and Australian sizes use letters, US and Canadian sizes use numbers. US 7 is about UK N½–O; use the converter above for any size.' ),
			),
		),

		/* ---------------------------------------------------------- BANGLE */
		'bangle' => array(
			'slug'      => 'bangle-size-calculator',
			'title'     => 'Bangle Size Calculator – Find Your Bangle Size Online',
			'seo_title' => 'Bangle Size Calculator – Find Your Bangle Size Online',
			'seo_desc'  => 'Free bangle size calculator. Match a bangle on your screen or enter your hand size to get your Indian bangle size with diameter in mm, cm and inches.',
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
<li><a href="/bangle-size-chart/">Bangle size chart</a> and <a href="/how-to-measure-bangle-size/">how to measure bangle size</a></li>
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
			'seo_title' => 'Bracelet Size Calculator – Bracelet Length from Wrist Size',
			'seo_desc'  => 'Enter your wrist size and get the right bracelet length for a snug, comfortable or loose fit, for chain, bangle and cuff bracelets. In inches and cm.',
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
<table class="rbs-table">
<thead><tr><th>Label</th><th>Bracelet length</th><th>Fits a wrist of</th><th>Usually for</th></tr></thead>
<tbody>
<tr><td>Child</td><td>5–6 in (12.7–15.2 cm)</td><td>4.25–5.25 in</td><td>Ages 3–10</td></tr>
<tr><td>Extra small</td><td>6–6.5 in (15.2–16.5 cm)</td><td>5.25–5.75 in</td><td>Teens, very slim wrists</td></tr>
<tr><td>Small</td><td>6.5–7 in (16.5–17.8 cm)</td><td>5.75–6.25 in</td><td>Petite women</td></tr>
<tr><td>Medium</td><td>7–7.5 in (17.8–19 cm)</td><td>6.25–6.75 in</td><td>Most women (7 in is standard)</td></tr>
<tr><td>Large</td><td>7.5–8 in (19–20.3 cm)</td><td>6.75–7.25 in</td><td>Larger women\'s wrists, slim men\'s wrists</td></tr>
<tr><td>Extra large</td><td>8–8.5 in (20.3–21.6 cm)</td><td>7.25–7.75 in</td><td>Most men (8 in is standard)</td></tr>
<tr><td>XXL</td><td>8.5–9 in (21.6–22.9 cm)</td><td>7.75–8.25 in</td><td>Larger men\'s wrists</td></tr>
</tbody>
</table>
<p>Lengths assume a comfortable fit (wrist + ¾ in). For every wrist size from 5 to 9 inches, see the <a href="/wrist-size-chart/">wrist size chart</a>.</p>

<h2>Bracelet size by style</h2>
<h3>Chain and link bracelets</h3>
<p>Measured end to end including the clasp. Add ¾ in (about 2 cm) to your wrist for a comfortable drape. Thick links take up room on the inside of the wrist, so for chunky chains wider than 8 mm add another ¼ in.</p>
<h3>Tennis bracelets</h3>
<p>Rows of stones look best sitting close to the wrist without sliding over the hand. Most people choose wrist + ½ in. A 6.5 in wrist usually wears a 7 in tennis bracelet.</p>
<h3>Charm bracelets</h3>
<p>Charms hang inward and take up space, so add about 1 in to your wrist (more if you plan to add many charms). A bracelet that is too tight pushes the charms against the skin.</p>
<h3>Beaded and stretch bracelets</h3>
<p>Elastic bracelets are made to sit snug: wrist + ¼ to ½ in. Large beads (10 mm and over) reduce the inside space, so add another ¼ in. Stretch bracelets that are too small wear out quickly from being forced over the hand.</p>
<h3>Bangle bracelets</h3>
<p>A rigid bangle bracelet must pass over your hand, so it is sized by inner diameter, not length. Use the <a href="/bangle-size-calculator/">bangle size calculator</a> or switch the calculator above to "Rigid bangle bracelet" to get the Indian bangle size (2.4, 2.6, 2.8 …).</p>
<h3>Cuffs</h3>
<p>Open cuffs slip on sideways at the narrow part of the wrist, so they need only ¼ to ¾ in more than your wrist size. Metal cuffs can be squeezed slightly to adjust, but not repeatedly.</p>
<h3>Watch bracelets</h3>
<p>Metal watch bracelets are adjusted by removing links; a jeweller or watch shop can do it in minutes. Leather and fabric straps use holes, so check the strap\'s listed wrist range against your wrist measurement.</p>

<h2>Bracelet sizes for men</h2>
<p>Men\'s bracelets are usually sold at 8 in (20.3 cm), with 8.5 and 9 in for larger wrists. Because men\'s chains and beads are often thicker, they need more room: for a Cuban or curb chain wider than 8 mm, add about 1 in to your wrist rather than ¾ in. Leather and cord bracelets with a sliding knot or magnetic clasp are more forgiving, but check that the stated length is the inside length, not including the clasp. Beaded men\'s bracelets with 10 mm beads typically fit a wrist ¾ in smaller than the bracelet\'s listed length.</p>

<h2>Common bracelet sizing mistakes</h2>
<ul>
<li><strong>Using your wrist size as the bracelet size.</strong> A 6.5 in bracelet on a 6.5 in wrist will not close comfortably. Always add for fit.</li>
<li><strong>Measuring over the wrist bone.</strong> Measure just below it, where the bracelet actually sits.</li>
<li><strong>Ignoring bead and link thickness.</strong> Thick links and large beads take up space inside the bracelet, so add ¼ in for each step up in chunkiness.</li>
<li><strong>Buying a rigid bangle by length.</strong> Rigid bangles have to pass over the hand and are sized by diameter; use the <a href="/bangle-size-calculator/">bangle size calculator</a>.</li>
</ul>

<h2>Measuring a bracelet you already own</h2>
<p>If you have a bracelet that fits well, you do not need to measure your wrist at all. Lay it flat and straight on a table, open the clasp, and measure from one end to the other including the clasp. That length is the bracelet size to buy again. For a bangle, measure the inside diameter instead.</p>

<h2>Too tight or too loose?</h2>
<ul>
<li><strong>Too tight:</strong> it leaves a mark on the skin, or you cannot slide one finger under it. Add an extension chain (usually 1–2 in) or have a jeweller add a link.</li>
<li><strong>Too loose:</strong> it slides over the wrist bone onto your hand. A jeweller can remove links from most chains, or you can use a smaller jump ring at the clasp.</li>
<li><strong>Just right:</strong> one finger fits between the bracelet and your wrist, and it stays above the wrist bone when you lower your arm.</li>
</ul>

<h2>Bracelet sizes for children</h2>
<p>Children\'s wrists grow quickly, so choose an adjustable bracelet or one with an extension chain. Typical lengths: 4–5 in for babies and toddlers, 5–5.5 in for ages 3–6 and 5.5–6 in for ages 7–10. For babies, choose a safety clasp and avoid small beads that could come loose. For children\'s bangles, see the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>.</p>

<h2>More sizing tools</h2>
<ul>
<li><a href="/wrist-size-chart/">Wrist size chart</a> – bracelet length for every wrist size</li>
<li><a href="/">Ring sizer</a> and <a href="/ring-size-chart/">ring size chart</a></li>
<li><a href="/bangle-size-calculator/">Bangle size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What size bracelet for a 6.5 inch wrist?', 'Add ¾ inch for a comfortable chain bracelet: 7.25 inches (18.4 cm). For a snug fit choose 7 inches; for a loose fit 7.75 inches.' ),
				array( 'What size bracelet for a 7 inch wrist?', 'A 7.75 inch (19.7 cm) chain bracelet is comfortable; 7.5 inches is snug and 8.25 inches loose.' ),
				array( 'How do I measure my wrist without a tape measure?', 'Wrap a strip of paper or a piece of string around your wrist, mark the overlap, then lay it flat against a ruler.' ),
				array( 'What is the average bracelet size for women?', '7 inches (17.8 cm) is the standard women\'s bracelet length and fits a 6–6.5 inch wrist.' ),
				array( 'What is the standard bracelet size for men?', '8 inches (20.3 cm) is the standard men\'s length and fits a wrist of about 7–7.5 inches.' ),
				array( 'How do I measure an existing bracelet?', 'Lay it flat and straight, open the clasp and measure from end to end, including the clasp. That length is your bracelet size.' ),
			),
		),

		/* ------------------------------------------------------ RING CHART */
		'ring-chart' => array(
			'slug'      => 'ring-size-chart',
			'title'     => 'Ring Size Chart – US, UK, EU, India and mm',
			'seo_title' => 'Ring Size Chart: US, UK, EU and India Sizes in mm and Inches',
			'seo_desc'  => 'Complete ring size chart with US, UK, EU/ISO and Indian sizes, inner diameter in mm and inches, and circumference. Convert any ring size instantly.',
			'mode'      => null,
			'content'   => '
<p><strong>Every ring size system in one chart.</strong> Find your size in one column and read across for the others: US 7 is UK N½, EU 54, India 14 and 17.3 mm inside diameter. Diameters follow the ISO 8653 standard used by jewellers worldwide. Don\'t know your size yet? <a href="/">Measure a ring on your screen</a> or use the <a href="/ring-size-calculator/">ring size calculator</a>.</p>

[rbs_ring_table]

<h2>How to use this chart</h2>
<ul>
<li><strong>You know your US size:</strong> read across for UK, EU and India.</li>
<li><strong>You have a ring:</strong> measure its inner diameter in mm with a ruler or vernier and find the nearest value in the diameter column, or <a href="/">match it on screen</a> for a faster result.</li>
<li><strong>You measured your finger with string:</strong> use the circumference column, or the full <a href="/ring-size-by-circumference/">ring size by circumference</a> table.</li>
<li><strong>You need a quick answer in another system:</strong> the <a href="/ring-size-converter/">ring size converter</a> does it in one click.</li>
</ul>

<h2>How the size systems differ</h2>
<ul>
<li><strong>US / Canada / Mexico:</strong> numbers 3–15 in half steps; each full size is 0.8 mm of diameter.</li>
<li><strong>UK / Australia / NZ / Ireland / South Africa:</strong> letters A–Z with half sizes; each letter is about 0.4 mm.</li>
<li><strong>EU / ISO / Germany / France:</strong> the inner circumference in mm, so size 54 is 54 mm around.</li>
<li><strong>India / Japan / China:</strong> numbers starting at 1 for 13 mm, rising one number per 1/3 mm.</li>
<li><strong>Switzerland:</strong> circumference minus 40, so EU 54 is Swiss 14.</li>
</ul>

<h2>Women\'s ring size chart</h2>
<p>Most women wear between US 5 and 8. These are the sizes jewellers stock most, with every conversion (sizes by finger and engagement ring tips are in the full <a href="/ring-size-chart/womens/">women\'s ring size chart</a>):</p>
<table class="rbs-table">
<thead><tr><th>US</th><th>UK</th><th>EU</th><th>India</th><th>Diameter</th><th>Common for</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-5/">5</a></td><td>J½</td><td>49</td><td>9</td><td>15.7 mm</td><td>Petite fingers, pinky rings</td></tr>
<tr><td><a href="/ring-size-in-mm/size-5-5/">5.5</a></td><td>K½</td><td>51</td><td>10</td><td>16.1 mm</td><td>Slim ring fingers</td></tr>
<tr><td><a href="/ring-size-in-mm/size-6/">6</a></td><td>L½</td><td>52</td><td>12</td><td>16.5 mm</td><td>Very common ring-finger size</td></tr>
<tr><td><a href="/ring-size-in-mm/size-6-5/">6.5</a></td><td>M½</td><td>53</td><td>13</td><td>16.9 mm</td><td>Very common ring-finger size</td></tr>
<tr><td><a href="/ring-size-in-mm/size-7/">7</a></td><td>N½</td><td>54</td><td>14</td><td>17.3 mm</td><td>Common; middle and index fingers</td></tr>
<tr><td><a href="/ring-size-in-mm/size-7-5/">7.5</a></td><td>O½</td><td>56</td><td>15</td><td>17.7 mm</td><td>Larger ring fingers, middle fingers</td></tr>
<tr><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>P½</td><td>57</td><td>16</td><td>18.1 mm</td><td>Larger hands, thumb rings for petite hands</td></tr>
</tbody>
</table>

<h2>Men\'s ring size chart</h2>
<p>Most men wear between US 8 and 12, with 9 to 10 the most common for wedding bands:</p>
<table class="rbs-table">
<thead><tr><th>US</th><th>UK</th><th>EU</th><th>India</th><th>Diameter</th><th>Circumference</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>P½</td><td>57</td><td>16</td><td>18.1 mm</td><td>56.9 mm</td></tr>
<tr><td>8.5</td><td>Q½</td><td>58</td><td>18</td><td>18.5 mm</td><td>58.1 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-9/">9</a></td><td>R½</td><td>60</td><td>19</td><td>19.0 mm</td><td>59.7 mm</td></tr>
<tr><td>9.5</td><td>S½</td><td>61</td><td>20</td><td>19.4 mm</td><td>60.9 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-10/">10</a></td><td>T½</td><td>62</td><td>21</td><td>19.8 mm</td><td>62.2 mm</td></tr>
<tr><td>10.5</td><td>U½</td><td>63</td><td>23</td><td>20.2 mm</td><td>63.5 mm</td></tr>
<tr><td>11</td><td>V½</td><td>65</td><td>24</td><td>20.6 mm</td><td>64.7 mm</td></tr>
<tr><td>12</td><td>X½</td><td>67</td><td>26</td><td>21.4 mm</td><td>67.2 mm</td></tr>
</tbody>
</table>
<p>Men\'s bands are often 6–8 mm wide. A wide band covers more of the finger and feels tighter, so many men go up half a size from their measured size. Sizes up to 15 and band-width advice are in the <a href="/ring-size-chart/mens/">men\'s ring size chart</a>.</p>

<h2>Ring size chart in inches</h2>
<p>Some US jewellers and ring mandrels give sizes in inches. The inner diameter of US 5 is 0.618 in, US 6 is 0.650 in, US 7 is 0.681 in, US 8 is 0.713 in, US 9 is 0.748 in and US 10 is 0.780 in, so each whole size adds about 0.032 in (a little under 1/32 inch). Inner circumference grows by about 0.1 in per size: US 7 is 2.14 in around and US 8 is 2.24 in. Multiply inches by 25.4 to get millimetres, or use the <a href="/ring-size-by-diameter/">ring size by diameter</a> table, which has an inch column.</p>

<h2>Half and quarter sizes</h2>
<p>Each US half size is only 0.4 mm of diameter, and a quarter size is 0.2 mm. Most jewellers can order quarter sizes for wedding bands and engagement rings; fashion rings are usually sold in whole or half sizes. If you measure between two sizes on this chart, choose the larger one for a rigid or wide ring and the smaller one for a thin band that you want to stay put. Rings with a heavy stone on top tend to roll sideways if they are loose, so they should fit closer.</p>

<h2>Ring size by finger</h2>
<p>Fingers on the same hand can differ by two or three sizes. As a rule of thumb, for the same person:</p>
<ul>
<li><strong>Thumb:</strong> about 2 to 3 sizes larger than the ring finger.</li>
<li><strong>Index and middle finger:</strong> about ½ to 1½ sizes larger than the ring finger.</li>
<li><strong>Ring finger:</strong> the size most charts and averages refer to.</li>
<li><strong>Little finger (pinky):</strong> about 1½ to 2 sizes smaller than the ring finger.</li>
</ul>
<p>These are only rough guides; always measure the finger the ring is for. The <a href="/how-to-measure-ring-size-at-home/">how to measure ring size at home</a> guide covers five ways to do it.</p>

<h2>Does ring style change the size?</h2>
<ul>
<li><strong>Thin bands (under 4 mm):</strong> buy your measured size.</li>
<li><strong>Wide bands (6 mm and over):</strong> add ¼ to ½ size.</li>
<li><strong>Comfort-fit bands:</strong> the rounded inside feels looser, so some people take ¼ size smaller; check the brand\'s advice.</li>
<li><strong>Stacking rings:</strong> several thin rings worn together act like one wide band, so go up ¼ size.</li>
<li><strong>Tungsten, titanium and ceramic:</strong> these cannot be resized, so measure with extra care.</li>
</ul>

<h2>Prefer paper?</h2>
<p>Download the free <a href="/printable-ring-sizer/">printable ring sizer</a>: true-size circles for US 4 to 12.5 and a finger strip, with a check line to make sure it printed at 100%.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-in-mm/">Ring size in mm</a> – diameter and circumference for every size</li>
<li><a href="/ring-size-by-diameter/">Ring size by diameter</a> and <a href="/ring-size-by-circumference/">by circumference</a></li>
<li><a href="/ring-size-converter/">Ring size converter</a></li>
<li>By country: <a href="/ring-size-chart/us/">US</a>, <a href="/ring-size-chart/uk/">UK</a>, <a href="/ring-size-chart/india/">India</a>, <a href="/ring-size-chart/pakistan/">Pakistan</a></li>
<li><a href="/ring-size-chart/womens/">Women\'s ring size chart</a> and <a href="/ring-size-chart/mens/">men\'s ring size chart</a></li>
<li><a href="/average-ring-size/">Average ring size</a></li>
<li><a href="/bangle-size-chart/">Bangle size chart</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What is ring size 6 in mm?', 'US size 6 is 16.5 mm inner diameter (51.8 mm circumference), UK L½, EU 52.' ),
				array( 'What is ring size 8 in mm?', 'US size 8 is 18.1 mm inner diameter (56.9 mm circumference), UK P½, EU 57.' ),
				array( 'What is a 17 mm ring size?', 'A 17 mm inner diameter is between US 6.5 (16.9 mm) and 7 (17.3 mm); most people choose US 7 / UK N½.' ),
				array( 'How do I convert UK ring size to US?', 'Use the chart: UK L½ is US 6, UK N½ is US 7, UK P½ is US 8, UK R½ is US 9, UK T½ is US 10.' ),
				array( 'What is the most common ring size for women?', 'US 6 to 7 (UK L½ to N½, 16.5 to 17.3 mm) is the most common range for a woman\'s ring finger.' ),
				array( 'What is the most common ring size for men?', 'US 9 to 10 (UK R½ to T½, 19.0 to 19.8 mm) is the most common range for men.' ),
			),
		),

		/* ---------------------------------------------------- BANGLE CHART */
		'bangle-chart' => array(
			'slug'      => 'bangle-size-chart',
			'title'     => 'Bangle Size Chart – Indian Sizes in mm, cm and Inches',
			'seo_title' => 'Bangle Size Chart: 2.2 to 2.12 in mm, cm and Inches',
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
<li><strong><a href="/bangle-size/2-2/">2.2</a>:</strong> petite adults, teenagers; hand circumference 16.0–17.0 cm.</li>
<li><strong><a href="/bangle-size/2-4/">2.4</a>:</strong> small adult hands, 17.0–18.0 cm; the most sold size.</li>
<li><strong><a href="/bangle-size/2-6/">2.6</a>:</strong> medium adult hands, 18.0–18.9 cm; the second most sold size.</li>
<li><strong><a href="/bangle-size/2-8/">2.8</a>:</strong> large hands, 18.9–19.9 cm.</li>
<li><strong><a href="/bangle-size/2-10/">2.10</a> and <a href="/bangle-size/2-12/">2.12</a>:</strong> extra-large hands (19.9–22.0 cm), men\'s kada or a loose fit.</li>
<li><strong>Below 2.0:</strong> babies and children; see the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>.</li>
</ul>

<h2>Bangle size chart in inches</h2>
<p>The number after the dot counts sixteenths of an inch, not tenths. That is why 2.10 and 2.12 come after 2.8, and why there is no 2.9. Written as a fraction:</p>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Meaning</th><th>Inner diameter (fraction)</th><th>Inner diameter (decimal)</th><th>Inner circumference</th></tr></thead>
<tbody>
<tr><td>2.0</td><td>2 0/16 in</td><td>2 in</td><td>2.000 in</td><td>6.28 in</td></tr>
<tr><td><a href="/bangle-size/2-2/">2.2</a></td><td>2 2/16 in</td><td>2⅛ in</td><td>2.125 in</td><td>6.68 in</td></tr>
<tr><td><a href="/bangle-size/2-4/">2.4</a></td><td>2 4/16 in</td><td>2¼ in</td><td>2.250 in</td><td>7.07 in</td></tr>
<tr><td><a href="/bangle-size/2-6/">2.6</a></td><td>2 6/16 in</td><td>2⅜ in</td><td>2.375 in</td><td>7.46 in</td></tr>
<tr><td><a href="/bangle-size/2-8/">2.8</a></td><td>2 8/16 in</td><td>2½ in</td><td>2.500 in</td><td>7.85 in</td></tr>
<tr><td><a href="/bangle-size/2-10/">2.10</a></td><td>2 10/16 in</td><td>2⅝ in</td><td>2.625 in</td><td>8.25 in</td></tr>
<tr><td><a href="/bangle-size/2-12/">2.12</a></td><td>2 12/16 in</td><td>2¾ in</td><td>2.750 in</td><td>8.65 in</td></tr>
<tr><td>2.14</td><td>2 14/16 in</td><td>2⅞ in</td><td>2.875 in</td><td>9.03 in</td></tr>
<tr><td>3.0</td><td>3 0/16 in</td><td>3 in</td><td>3.000 in</td><td>9.42 in</td></tr>
</tbody>
</table>
<p>Each adult step is 2/16 inch (3.2 mm) of diameter, or about 1 cm of circumference. Shops sometimes write the same size as 2/4, 2-4 or 2.25 inch; they all mean 2.4. The <a href="/bangle-size-chart/in-cm/">bangle size in cm</a> page lists every size in centimetres.</p>

<h2>Bangle size by hand measurement</h2>
<p>A rigid bangle has to slide over the hand, so the size depends on the widest part of the hand with the thumb folded in, not on the wrist. Each size fits hands up to its own inner circumference:</p>
<table class="rbs-table">
<thead><tr><th>Hand circumference (thumb folded in)</th><th>In inches</th><th>Bangle size</th></tr></thead>
<tbody>
<tr><td>15.0 – 16.0 cm</td><td>5.9 – 6.3 in</td><td>2.0</td></tr>
<tr><td>16.0 – 17.0 cm</td><td>6.3 – 6.7 in</td><td>2.2</td></tr>
<tr><td>17.0 – 18.0 cm</td><td>6.7 – 7.1 in</td><td>2.4</td></tr>
<tr><td>18.0 – 18.9 cm</td><td>7.1 – 7.4 in</td><td>2.6</td></tr>
<tr><td>18.9 – 19.9 cm</td><td>7.4 – 7.8 in</td><td>2.8</td></tr>
<tr><td>19.9 – 20.9 cm</td><td>7.8 – 8.2 in</td><td>2.10</td></tr>
<tr><td>20.9 – 22.0 cm</td><td>8.2 – 8.6 in</td><td>2.12</td></tr>
</tbody>
</table>
<p>If the tape reads exactly on a boundary, take the larger size; a bangle that is 1 mm too small will not go on at all. The step-by-step method is in <a href="/how-to-measure-bangle-size/">how to measure bangle size</a>.</p>

<h2>Bangle size by age</h2>
<table class="rbs-table">
<thead><tr><th>Age</th><th>Usual size</th><th>Inner diameter</th></tr></thead>
<tbody>
<tr><td>0 – 1 year</td><td>1.10</td><td>41.3 mm</td></tr>
<tr><td>1 – 2 years</td><td>1.12</td><td>44.5 mm</td></tr>
<tr><td>2 – 4 years</td><td>1.14</td><td>47.6 mm</td></tr>
<tr><td>4 – 7 years</td><td>2.0</td><td>50.8 mm</td></tr>
<tr><td>Teenagers, petite adults</td><td>2.2</td><td>54.0 mm</td></tr>
<tr><td>Adult women</td><td>2.4 – 2.8</td><td>57.2 – 63.5 mm</td></tr>
<tr><td>Adult men (kada)</td><td>2.10 – 3.0</td><td>66.7 – 76.2 mm</td></tr>
</tbody>
</table>
<p>Age is only a rough guide; children of the same age can be a full size apart. Measure the hand where you can, and see the <a href="/kids-bangle-size-chart/">kids bangle size chart</a> for babies and children.</p>

<h2>Does the type of bangle change the size?</h2>
<ul>
<li><strong>Glass, lac and plastic bangles</strong> cannot open or stretch, so they need the full size that passes the hand.</li>
<li><strong>Solid gold or silver bangles</strong> also need the full size. Very thick bangles (over 8 mm wide) can feel tighter going on; some people go up one size.</li>
<li><strong>Bangles with a screw, hinge or clasp</strong> open to go on, so they can be one size smaller and sit closer to the wrist.</li>
<li><strong>Kada for men</strong> are usually worn loose, in 2.10 to 2.14; see the <a href="/chudi-size-chart/">chudi and kada size chart</a>.</li>
<li><strong>Bridal sets and chooda</strong> follow the same rule as glass bangles. Our <a href="/blog/bangle-size-for-wedding/">bridal bangle size guide</a> covers the details.</li>
</ul>

<h2>Buying bangles online</h2>
<ul>
<li><strong>Check which number the shop means.</strong> Indian and Pakistani sellers use 2.4, 2.6 and so on. Shops elsewhere may give the inner diameter in mm or inches, or sell S / M / L; compare the diameter with the chart above.</li>
<li><strong>Look for the inner diameter, not the outer.</strong> A thick bangle can be 5–10 mm wider outside than inside.</li>
<li><strong>Order a set in one size.</strong> Mixing sizes in a stack makes the smaller ones hard to put on and the larger ones slide over them.</li>
<li><strong>Keep one bangle that fits.</strong> It is the best reference you have: match it on the <a href="/bangle-size-calculator/">bangle size calculator</a> before every order.</li>
</ul>

<h2>Bangle size vs bracelet size</h2>
<p>A bangle is a rigid ring measured by its inner diameter. A bracelet is a chain or band measured by its length, and it is chosen from the wrist size (usually wrist plus 1.5 to 2 cm). The two numbers are not interchangeable: a person with a 15 cm wrist might wear a 2.4 bangle and a 17 cm bracelet. For bracelets use the <a href="/bracelet-size-calculator/">bracelet size calculator</a> and the <a href="/wrist-size-chart/">wrist size chart</a>.</p>

[rbs_cta mode="bangle"]

<h2>Related</h2>
<ul>
<li><a href="/bangle-size-chart/india/">Bangle size chart India</a> – shop notation and regional names</li>
<li><a href="/bangle-size-chart/in-cm/">Bangle size in cm</a> – with the hand size each bangle clears</li>
<li><a href="/how-to-measure-bangle-size/">How to measure bangle size</a></li>
<li><a href="/chudi-size-chart/">Chudi and kada size chart</a></li>
<li><a href="/ring-size-chart/">Ring size chart</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
</ul>
',
			'faq' => array(
				array( 'What is bangle size 2.8 in cm?', 'Size 2.8 has an inner diameter of 2.5 inches, which is 6.35 cm (63.5 mm).' ),
				array( 'What is bangle size 2.2 in mm?', 'Size 2.2 is 2 2/16 inch, an inner diameter of 54.0 mm (5.4 cm).' ),
				array( 'What bangle size is a 7.5 inch hand?', 'A hand circumference of 7.5 inches (19 cm) gives a diameter of about 60.6 mm, so choose size 2.8 (63.5 mm); 2.6 (60.3 mm) is just too small to pass over the hand.' ),
				array( 'Why is there no bangle size 2.9?', 'Because the number after the dot counts sixteenths of an inch, not tenths. Adult sizes go up in steps of 2/16 inch: 2.8, 2.10, 2.12, 2.14, then 3.0.' ),
				array( 'Is bangle size the same as bracelet size?', 'No. Bangle size is the inner diameter and must clear your hand; bracelet size is the length around your wrist. A bracelet for a 6.5 inch wrist is about 7.25 inches long, while a rigid bangle for the same person is usually size 2.4 or 2.6.' ),
			),
		),
	);
}
