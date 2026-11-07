<?php
/**
 * Ring long-tail pages (plan doc content map #14–#19): ring size in mm hub,
 * one page per common US size, and the Pakistan ring size chart.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_ring_mm_pages() {
	return array(

		/* ---------------------------------------------------- RING SIZE PAKISTAN */
		'ring-chart-pk' => array(
			'slug'       => 'pakistan',
			'parent'     => 'ring-chart',
			'title'      => 'Ring Size Chart Pakistan – Local Sizes, US, UK and mm',
			'seo_title'  => 'Ring Size Chart Pakistan: Local Number Sizes to US, UK, mm',
			'seo_desc'   => 'Ring size chart for Pakistan: convert local jewellers\' number sizes to US, UK and EU sizes and mm, with tips for buying rings on Daraz and abroad.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => '
<p><strong>Most jewellers in Pakistan size rings with numbers from about 8 to 30, the same scale used in India (the inner circumference in mm minus 40), while online shops such as Daraz and international brands usually list US sizes.</strong> A Pakistani size 14 is about US 7 (17.3 mm), size 20 is about US 9 and size 22 is US 10. Use the chart below to convert, or measure a ring on your phone with the <a href="/">online ring sizer</a>.</p>

<h2>Pakistan ring size chart</h2>
<table class="rbs-table">
<thead><tr><th>Local number size</th><th>US / Canada</th><th>UK</th><th>EU</th><th>Inner diameter</th><th>Circumference</th></tr></thead>
<tbody>
<tr><td>9</td><td><a href="/ring-size-in-mm/size-5/">5</a></td><td>J½</td><td>49</td><td>15.7 mm</td><td>49.3 mm</td></tr>
<tr><td>11</td><td><a href="/ring-size-in-mm/size-5-5/">5.5</a></td><td>K½</td><td>51</td><td>16.1 mm</td><td>50.6 mm</td></tr>
<tr><td>12</td><td><a href="/ring-size-in-mm/size-6/">6</a></td><td>L½</td><td>52</td><td>16.5 mm</td><td>51.8 mm</td></tr>
<tr><td>13</td><td><a href="/ring-size-in-mm/size-6-5/">6.5</a></td><td>M½</td><td>53</td><td>16.9 mm</td><td>53.1 mm</td></tr>
<tr><td>14</td><td><a href="/ring-size-in-mm/size-7/">7</a></td><td>N½</td><td>54</td><td>17.3 mm</td><td>54.3 mm</td></tr>
<tr><td>16</td><td><a href="/ring-size-in-mm/size-7-5/">7.5</a></td><td>O½</td><td>56</td><td>17.7 mm</td><td>55.6 mm</td></tr>
<tr><td>17</td><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>P½</td><td>57</td><td>18.1 mm</td><td>56.9 mm</td></tr>
<tr><td>18</td><td>8.5</td><td>Q½</td><td>58</td><td>18.5 mm</td><td>58.1 mm</td></tr>
<tr><td>20</td><td><a href="/ring-size-in-mm/size-9/">9</a></td><td>R½</td><td>60</td><td>19.0 mm</td><td>59.7 mm</td></tr>
<tr><td>21</td><td>9.5</td><td>S½</td><td>61</td><td>19.4 mm</td><td>60.9 mm</td></tr>
<tr><td>22</td><td><a href="/ring-size-in-mm/size-10/">10</a></td><td>T½</td><td>62</td><td>19.8 mm</td><td>62.2 mm</td></tr>
<tr><td>23</td><td>10.5</td><td>U½</td><td>63</td><td>20.2 mm</td><td>63.5 mm</td></tr>
<tr><td>25</td><td>11</td><td>V½</td><td>65</td><td>20.6 mm</td><td>64.7 mm</td></tr>
<tr><td>26</td><td>11.5</td><td>W½</td><td>66</td><td>21.0 mm</td><td>66.0 mm</td></tr>
<tr><td>27</td><td>12</td><td>X½</td><td>67</td><td>21.4 mm</td><td>67.2 mm</td></tr>
</tbody>
</table>
<p>The local number is the inner circumference in mm minus 40: size 14 is 54 mm around, size 22 is 62 mm. One number is 1 mm of circumference, a little finer than a US half size, so some numbers (10, 15, 19, 24) fall between two US half sizes; in that case pick the US size whose diameter is closest to your ring.</p>

<h2>How ring sizes are used in Pakistan</h2>
<ul>
<li><strong>Local jewellers (sunar) in Lahore, Karachi, Rawalpindi and other cities</strong> mostly use a metal ring sizer stick (ungli ka naap) marked with numbers on the Indian scale. Some older shops use their own sticks, which can differ by one number, so always confirm with a diameter in mm.</li>
<li><strong>Daraz and most online stores</strong> list US sizes (6, 7, 8…) and sometimes "free size" adjustable rings.</li>
<li><strong>Imported brands and UK-based sellers</strong> use UK letters (L, N, P…).</li>
<li><strong>Gold rings bought in the Gulf</strong> (Dubai, Saudi Arabia) are usually sized in EU numbers or US sizes.</li>
</ul>

<h2>Typical ring sizes in Pakistan</h2>
<p>Most women wear local sizes 12 to 14 (US 6 to 7) on the ring finger, and most men 20 to 22 (US 9 to 10). Hands swell on a hot wedding day and shrink again afterwards, so measure on a normal day at room temperature, not on the wedding day itself. Jewellers generally advise buying the exact size and resizing later if needed. These are averages only: measure the actual finger.</p>

<h2>How to find your ring size at home</h2>
<ol>
<li><strong>On your phone:</strong> open the <a href="/">ring sizer</a>, calibrate with any bank card or CNIC (both are the standard ID-1 card size; on a phone hold the card upright and match its short side), place a ring that fits on the screen and read the local number, US, UK and mm.</li>
<li><strong>With a thread:</strong> wrap a thread around the base of the finger, mark it, measure the length in mm and find it in the circumference column.</li>
<li><strong>With a ruler:</strong> measure the inside diameter of a ring that fits and match it in the diameter column.</li>
</ol>
<p>For every size in mm, see <a href="/ring-size-in-mm/">ring size in mm</a>. For all international systems, see the full <a href="/ring-size-chart/">ring size chart</a>.</p>

[rbs_cta mode="ring"]
',
			'faq' => array(
				array( 'What ring size system is used in Pakistan?', 'Most local jewellers use a number scale (about 8 to 30) that matches the Indian system: the inner circumference in mm minus 40. Online shops such as Daraz usually list US sizes.' ),
				array( 'What is size 14 ring in Pakistan in US size?', 'Local size 14 is about US 7, an inner diameter of 17.3 mm and UK N½.' ),
				array( 'What is the common ring size for women in Pakistan?', 'Most women wear local sizes 12 to 14 (US 6 to 7, 16.5 to 17.3 mm) on the ring finger.' ),
				array( 'Can I use my CNIC to calibrate the ring sizer?', 'Yes. The CNIC is the same ID-1 card size as a bank card (85.6 × 54 mm), so it works for calibration. On a phone, hold it upright and match its short side.' ),
				array( 'What ring size do men wear in Pakistan?', 'Most men wear local sizes 20 to 23, which is about US 9 to 10.5 (19.0 to 20.2 mm).' ),
			),
		),

		/* ------------------------------------------------------ RING SIZE IN MM HUB */
		'ring-mm' => array(
			'slug'       => 'ring-size-in-mm',
			'title'      => 'Ring Size in mm – Diameter and Circumference for Every Size',
			'seo_title'  => 'Ring Size in mm: Diameter and Circumference Chart',
			'seo_desc'   => 'Ring sizes in mm: inner diameter and circumference for US 3–15 with UK and EU equivalents, a mm-to-size lookup, and how to measure a ring in millimetres.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => '
<p><strong>Ring size in mm is the inside diameter of the ring, or its inside circumference.</strong> US size 6 is 16.5 mm across (51.8 mm around), size 7 is 17.3 mm (54.3 mm) and size 8 is 18.1 mm (56.9 mm). Each whole US size adds about 0.8 mm of diameter and 2.5 mm of circumference. Measure your ring in mm on screen with the <a href="/">online ring sizer</a>, or use the charts below.</p>

<h2>Ring size chart in mm</h2>
[rbs_ring_table]

<h2>Diameter or circumference?</h2>
<p>Jewellers use both, so it helps to know which one you have:</p>
<ul>
<li><strong>Inner diameter</strong> is the distance straight across the inside of the ring. You get it by measuring a ring you own with a ruler or caliper. US sizes are defined by diameter, for example US 7 = 17.3 mm.</li>
<li><strong>Inner circumference</strong> is the distance around the inside, which is what you measure when you wrap a thread or paper strip around your finger. European (ISO) sizes are simply the circumference rounded to the nearest mm: EU 54 is 54 mm around.</li>
</ul>
<p>Convert one to the other with π: circumference = diameter × 3.1416, and diameter = circumference ÷ 3.1416. A 17.3 mm ring is 17.3 × 3.1416 = 54.3 mm around.</p>

<h2>I measured my ring in mm – what size is it?</h2>
<p>Find your measurement in the first column. Values are rounded to the nearest half millimetre; if yours falls between two rows, use the nearest one or check the full chart above.</p>
[rbs_mm_lookup]

<h2>Popular sizes in mm</h2>
<ul>
<li><a href="/ring-size-in-mm/size-5/">Size 5 ring in mm</a>: 15.7 mm diameter, 49.3 mm circumference.</li>
<li><a href="/ring-size-in-mm/size-5-5/">Size 5.5 in mm</a>: 16.1 mm, 50.6 mm.</li>
<li><a href="/ring-size-in-mm/size-6/">Size 6 ring in mm</a>: 16.5 mm, 51.8 mm.</li>
<li><a href="/ring-size-in-mm/size-6-5/">Size 6.5 in mm</a>: 16.9 mm, 53.1 mm.</li>
<li><a href="/ring-size-in-mm/size-7/">Size 7 ring in mm</a>: 17.3 mm, 54.3 mm.</li>
<li><a href="/ring-size-in-mm/size-7-5/">Size 7.5 in mm</a>: 17.7 mm, 55.6 mm.</li>
<li><a href="/ring-size-in-mm/size-8/">Size 8 ring in mm</a>: 18.1 mm, 56.9 mm.</li>
<li><a href="/ring-size-in-mm/size-9/">Size 9 ring in mm</a>: 19.0 mm, 59.7 mm.</li>
<li><a href="/ring-size-in-mm/size-10/">Size 10 ring in mm</a>: 19.8 mm, 62.2 mm.</li>
</ul>

<h2>How to measure a ring in mm</h2>
<h3>With a ruler</h3>
<ol>
<li>Choose a ring that fits the finger you are sizing.</li>
<li>Lay it on a ruler with mm marks and measure the inside edge straight across the centre.</li>
<li>Read to the nearest half millimetre. A ruler is accurate to about one half size, so if the result is between two sizes, measure again or use the on-screen sizer.</li>
</ol>
<h3>With a vernier or digital caliper</h3>
<p>Use the inside jaws of the caliper to measure the inner diameter at two points at right angles and average them. This gives 0.1 mm accuracy, which is enough to tell quarter sizes apart.</p>
<h3>On your phone screen</h3>
<p>The <a href="/">online ring sizer</a> draws a true-size circle once you calibrate it with a bank card. Place the ring on the screen, match the circle to the inside edge, and read the diameter and circumference in mm along with US, UK, EU and Indian sizes.</p>

<h2>How to measure your finger in mm</h2>
<ol>
<li>Cut a thin strip of paper about 1 cm wide and 10 cm long, or use non-stretch thread.</li>
<li>Wrap it around the base of the finger, snug but not tight, and mark where it overlaps.</li>
<li>Measure from the end to the mark in mm. That is your finger circumference.</li>
<li>Find the circumference in the chart. If the knuckle is larger than the base of the finger, measure both and choose a size in between, so the ring passes the knuckle but does not spin.</li>
</ol>
<p>String and paper stretch and slip, so this method can be off by half a size. Measure two or three times, at the end of the day, when fingers are at their largest.</p>

<h2>Why each size is 0.8 mm</h2>
<p>The US system increases the inner circumference by about 2.55 mm (0.1 inch) for every whole size, which is 0.81 mm of diameter. Half sizes are therefore 0.4 mm apart and quarter sizes 0.2 mm. UK letters step in half-size increments of about 1.25 mm circumference. That is why a measurement error of just half a millimetre can move you up or down a half size, and why measuring the inside of a ring that already fits gives a better result than measuring your finger.</p>

<h2>Band width changes the fit</h2>
<p>Two rings with the same inner diameter can feel different. Wide bands (6 mm or more) cover more of the finger and feel tighter, so many jewellers recommend going up ¼ to ½ size. Comfort-fit bands, which are rounded on the inside, feel slightly looser than flat bands of the same size. Thin stacking rings under 2 mm can be bought at your exact size or even ¼ size down.</p>

<h2>Ring sizes in mm for men and women</h2>
<p>Women\'s ring sizes most often fall between 15.7 mm and 17.7 mm (US 5–7.5), with US 6–7 (16.5–17.3 mm) the most common. Men\'s sizes usually fall between 18.5 mm and 20.6 mm (US 8.5–11), with US 9–10 (19.0–19.8 mm) the most common. Children\'s rings start around 13–14 mm.</p>

[rbs_cta mode="ring"]

<p>Need other systems? See the full <a href="/ring-size-chart/">ring size chart</a>, the <a href="/ring-size-converter/">ring size converter</a> or the <a href="/ring-size-chart/pakistan/">ring size chart for Pakistan</a>. Have a measurement? Look it up by <a href="/ring-size-by-diameter/">diameter</a> or <a href="/ring-size-by-circumference/">circumference</a>.</p>
',
			'faq' => array(
				array( 'What is ring size in mm?', 'Ring size in mm is either the inner diameter of the ring (US 7 = 17.3 mm) or its inner circumference (US 7 = 54.3 mm). European sizes use the circumference.' ),
				array( 'How many mm is each ring size?', 'Each whole US size adds about 0.8 mm of inner diameter and 2.5 mm of inner circumference. Half sizes are about 0.4 mm apart.' ),
				array( 'What ring size is 18 mm?', 'An 18 mm inner diameter is very close to US 8 (18.1 mm), UK P½ and EU 57.' ),
				array( 'What ring size is 20 mm?', 'A 20 mm inner diameter is between US 10 (19.8 mm) and 10.5 (20.2 mm); most people choose US 10.5, UK U½.' ),
				array( 'How do I measure my ring size in mm at home?', 'Measure the inside diameter of a ring that fits with a ruler, or wrap a paper strip around your finger and measure its length for the circumference. For better accuracy, match a ring on screen with our ring sizer.' ),
			),
		),

		/* ---------------------------------------------------------- SIZE 5 */
		'ring-5' => array(
			'slug'       => 'size-5',
			'parent'     => 'ring-mm',
			'title'      => 'Size 5 Ring in mm – Diameter 15.7 mm',
			'seo_title'  => 'Size 5 Ring in mm: 15.7 mm Diameter, 49.3 mm Circumference',
			'seo_desc'   => 'A US size 5 ring is 15.7 mm in inner diameter and 49.3 mm in circumference. UK J½, EU 49. Who wears size 5 and how to check it at home.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => '
<p><strong>A US size 5 ring has an inner diameter of 15.7 mm (0.62 inches) and an inner circumference of 49.3 mm.</strong> It is UK size J½, EU 49 and India 9. Size 5 is a petite women\'s size. Check whether it fits by matching a ring on screen with the <a href="/">online ring sizer</a>.</p>

[rbs_ring_size us="5"]

<h2>Is size 5 small?</h2>
<p>Yes, size 5 is on the small side for adult women. The most common women\'s sizes in the US and UK are 6 to 7, so a 5 is about one to two sizes below average. It is a typical size for:</p>
<ul>
<li>women with slender fingers or a petite build;</li>
<li>the little finger or a midi ring position for women who wear size 6–7 on the ring finger;</li>
<li>teenagers aged roughly 13–16;</li>
<li>the pinky ring of many men.</li>
</ul>

<h2>How to check a size 5 at home</h2>
<ol>
<li><strong>Ring you own:</strong> measure the inside straight across. 15.5–15.9 mm is a size 5.</li>
<li><strong>Paper strip:</strong> wrap it around the base of the finger and measure the length. 48.7–49.9 mm means size 5.</li>
<li><strong>On screen:</strong> calibrate the <a href="/">ring sizer</a> with a bank card, place the ring on the screen and read the size.</li>
</ol>
<p>If your measurement is between 5 and 5.5, a thin band can be bought in size 5 and a wide band in <a href="/ring-size-in-mm/size-5-5/">5.5</a>.</p>

<h2>Size 5 in other countries</h2>
<p>In the UK, Australia and Ireland a US 5 is J½. In Germany, France and most of Europe it is size 49 (the circumference in mm) and in Switzerland 9. In India and Pakistan it is number 9. When ordering from a shop in another country, compare the inner diameter rather than the size label: 15.7 mm is the same everywhere.</p>

<h2>Size 5 compared with neighbouring sizes</h2>
<p>US 4.5 (15.3 mm) is the half size below, and <a href="/ring-size-in-mm/size-5-5/">US 5.5</a> (16.1 mm) the half size above. Each half size changes the diameter by 0.4 mm and the circumference by about 1.3 mm. That is a small difference on paper, but enough to make a ring either spin or stick at the knuckle, so it is worth measuring carefully rather than guessing.</p>

<h2>Tips if you wear size 5</h2>
<ul>
<li>Many ready-made fashion rings start at size 6. Look for brands that offer 4.5 and 5, or choose adjustable designs.</li>
<li>Resizing a ring down by one size is usually simple for plain gold and silver bands, but not for eternity rings set with stones all the way round.</li>
<li>Fingers swell in heat and during pregnancy. If your size 5 rings feel tight in summer, a comfort-fit band can help.</li>
</ul>

[rbs_cta mode="ring"]

<p>See every size on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 5 ring in mm?', 'A US size 5 ring is 15.7 mm in inner diameter and 49.3 mm in inner circumference.' ),
				array( 'What is a size 5 ring in UK size?', 'US 5 is UK J½.' ),
				array( 'Is ring size 5 small for a woman?', 'Yes, it is a petite size. Most women wear US 6 to 7.' ),
				array( 'What is size 5 ring in inches?', 'About 0.62 inches in inner diameter and 1.94 inches around the inside.' ),
				array( 'What finger is size 5 for?', 'Size 5 is common for the ring finger of women with slim fingers and for the little finger of women who wear 6–7 on the ring finger.' ),
			),
		),

		/* -------------------------------------------------------- SIZE 5.5 */
		'ring-5-5' => array(
			'slug'       => 'size-5-5',
			'parent'     => 'ring-mm',
			'title'      => 'Size 5.5 Ring in mm – Diameter 16.1 mm',
			'seo_title'  => 'Size 5.5 Ring in mm: 16.1 mm Diameter, UK K½, EU 51',
			'seo_desc'   => 'A US size 5.5 ring is 16.1 mm in inner diameter and 50.6 mm around. UK K½, EU 51. How 5.5 compares with 5 and 6, and how to measure at home.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => '
<p><strong>A US size 5.5 ring measures 16.1 mm across the inside (0.63 inches) and 50.6 mm around.</strong> It equals UK K½, EU 51 and India 11. It is a small women\'s size, half a size above 5. You can confirm your size in 30 seconds with the <a href="/">ring sizer</a>.</p>

[rbs_ring_size us="5.5"]

<h2>Who wears 5.5?</h2>
<p>Size 5.5 sits between the petite 5 and the very common 6. It suits women with slim fingers whose size 6 rings slide around, and it is a frequent size for the middle finger of children and teenagers. Some women wear 5.5 on the right hand and 6 on the left, because the dominant hand is often slightly larger.</p>

<h2>Half sizes matter</h2>
<p>Half a size is only 0.4 mm of diameter, but on a finger that is noticeable. If a size 6 ring turns on your finger and drops toward the knuckle when your hands are cold, but 5 feels tight in the evening, 5.5 is likely your fit. Quarter sizes (5.25 and 5.75) are also available from many jewellers when made to order.</p>

<h2>How to measure for 5.5</h2>
<ol>
<li>Measure a ring that fits: an inside diameter of 15.9–16.3 mm is about 5.5.</li>
<li>Or wrap paper around your finger: a circumference of 49.9–51.2 mm points to 5.5.</li>
<li>For the most reliable answer, match your ring on screen with the <a href="/">online ring sizer</a> after a one-time card calibration.</li>
</ol>

<h2>5.5 vs 5 vs 6</h2>
<table class="rbs-table">
<thead><tr><th>US size</th><th>Diameter</th><th>Circumference</th><th>UK</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-5/">5</a></td><td>15.7 mm</td><td>49.3 mm</td><td>J½</td></tr>
<tr><td><strong>5.5</strong></td><td><strong>16.1 mm</strong></td><td><strong>50.6 mm</strong></td><td><strong>K½</strong></td></tr>
<tr><td><a href="/ring-size-in-mm/size-6/">6</a></td><td>16.5 mm</td><td>51.8 mm</td><td>L½</td></tr>
</tbody>
</table>

<h2>Buying a 5.5 ring</h2>
<ul>
<li>Not every fashion brand stocks half sizes. If 5.5 is not offered, choose 5 for a thin band and 6 for a wide band.</li>
<li>For engagement rings, order the exact half size; most fine jewellers make every half size.</li>
<li>When buying from Europe, look for size 51 (or 50.5 if quarter sizes are listed).</li>
</ul>

<h2>Measuring a small finger accurately</h2>
<p>Small sizes are the hardest to measure with string, because a 1 mm error in circumference is almost a full quarter size. For a size around 5.5, use a ring that already fits rather than your finger, and measure it on a calibrated screen or with a caliper. If you only have string, use non-stretch dental floss or a thin paper strip, pull it snug, and repeat three times. Take the middle value. Remember that the knuckle matters too: the ring has to pass over it, so if your knuckle is large, a 5.5 may be right even when the base of the finger measures 5.</p>

<h2>Size 5.5 and the little finger</h2>
<p>Women who wear 7 on the ring finger often wear about 5.5 on the little finger, which makes 5.5 a popular size for pinky and midi rings as well.</p>

[rbs_cta mode="ring"]

<p>All sizes are on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 5.5 ring in mm?', 'A US 5.5 ring is 16.1 mm in inner diameter and 50.6 mm in inner circumference.' ),
				array( 'What is US ring size 5.5 in UK?', 'US 5.5 is UK K½.' ),
				array( 'What is 5.5 ring size in EU?', 'EU size 51, which means about 51 mm inner circumference.' ),
				array( 'Is 5.5 a common ring size?', 'It is a common small women\'s size, though less common than 6 and 7.' ),
				array( 'Should I choose 5.5 or 6?', 'If size 6 spins on your finger and 5 is tight in the evening, choose 5.5. For a wide band over 6 mm, choose 6.' ),
			),
		),

		/* ---------------------------------------------------------- SIZE 6 */
		'ring-6' => array(
			'slug'       => 'size-6',
			'parent'     => 'ring-mm',
			'title'      => 'Size 6 Ring in mm – Diameter 16.5 mm',
			'seo_title'  => 'Size 6 Ring in mm: 16.5 mm Diameter, 51.8 mm Circumference',
			'seo_desc'   => 'A US size 6 ring is 16.5 mm in inner diameter and 51.8 mm around: UK L½, EU 52, India 12. Why size 6 is so common and how to check yours.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => '
<p><strong>A US size 6 ring has an inner diameter of 16.5 mm (0.65 inches) and an inner circumference of 51.8 mm.</strong> It is UK L½, EU 52 and India 12. Size 6 is one of the most common women\'s ring sizes and the size many jewellers use for sample rings. Find out if you are a 6 with the <a href="/">online ring sizer</a>.</p>

[rbs_ring_size us="6"]

<h2>Why size 6 is so common</h2>
<p>Average women\'s ring sizes in the US, UK and Australia fall between 6 and 7. Because of that, display rings in jewellery shops and online product photos are usually size 6 or 6.5, and many engagement rings are sold in size 6 by default and resized after purchase. If you are buying a surprise ring and have no other information, size 6 or 6.5 is the most likely to fit, but it is still a guess.</p>

<h2>Is 6 the right size for you?</h2>
<p>A size 6 should slide over your knuckle with a little resistance and sit at the base of the finger without spinning. Signs you need a different size:</p>
<ul>
<li>It leaves a deep mark or is hard to remove in the evening: try <a href="/ring-size-in-mm/size-6-5/">6.5</a>.</li>
<li>It turns freely and slips toward the nail when your hands are cold: try <a href="/ring-size-in-mm/size-5-5/">5.5</a>.</li>
<li>It passes the base of the finger easily but sticks at the knuckle: you may need 6.25–6.5, or a ring with sizing beads.</li>
</ul>

<h2>Checking a size 6 at home</h2>
<ol>
<li>Measure the inside of a ring that fits. 16.3–16.7 mm is a 6.</li>
<li>Measure around your finger with a paper strip. 51.2–52.4 mm is a 6.</li>
<li>Or use the <a href="/">ring sizer</a>: calibrate with a bank card, put the ring on the screen and match the circle.</li>
</ol>

<h2>Size 6 around the world</h2>
<ul>
<li>UK / Australia / New Zealand: L½</li>
<li>Germany / France / EU: 52</li>
<li>Italy / Spain / Switzerland: 12</li>
<li>India / Pakistan: 12</li>
</ul>
<p>Some charts list US 6 as UK L and others as L½. The exact value depends on rounding; by diameter, 16.5 mm sits slightly closer to L½.</p>

<h2>Wide bands and stacking</h2>
<p>A 6 mm or wider band in size 6 will feel snug. Most people who wear a thin size 6 choose 6.5 for a wide wedding band. If you stack two or three thin rings on one finger, they act like one wide band, so consider a quarter size up for the stack.</p>

<h2>Quick test: does a size 6 fit?</h2>
<p>Put the ring on and make a fist. A good fit should not pinch when the fist is closed. Then open your hand and turn the ring: it should turn with slight resistance, not spin freely. Finally pull it off: it should need a little twist over the knuckle, not a struggle. If all three checks pass in the evening at room temperature, size 6 is your size.</p>

[rbs_cta mode="ring"]

<p>See all sizes on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 6 ring in mm?', 'A US size 6 ring is 16.5 mm in inner diameter and 51.8 mm in inner circumference.' ),
				array( 'What is US size 6 ring in UK?', 'US 6 is UK L½ (some charts round it to L).' ),
				array( 'Is size 6 ring small or average?', 'Size 6 is an average women\'s ring size; most women wear between 6 and 7.' ),
				array( 'What is size 6 ring in inches?', '0.65 inches in inner diameter and about 2.04 inches around the inside.' ),
				array( 'What is a size 6 ring in India?', 'A US 6 ring is size 12 on the Indian scale (about 52 mm around).' ),
			),
		),

		/* -------------------------------------------------------- SIZE 6.5 */
		'ring-6-5' => array(
			'slug'       => 'size-6-5',
			'parent'     => 'ring-mm',
			'title'      => 'Size 6.5 Ring in mm – Diameter 16.9 mm',
			'seo_title'  => 'Size 6.5 Ring in mm: 16.9 mm Diameter, UK M½, EU 53',
			'seo_desc'   => 'A US size 6.5 ring is 16.9 mm in inner diameter and 53.1 mm in circumference. UK M½, EU 53, India 13. Who wears 6.5 and how to confirm it.',
			'mode'       => null,
			'menu_order' => 4,
			'content'    => '
<p><strong>A US size 6.5 ring is 16.9 mm in inner diameter (0.67 inches) and 53.1 mm in inner circumference.</strong> It is UK M½, EU 53 and India 13. Size 6.5 sits right in the middle of the most common women\'s range. Check your fit with the free <a href="/">online ring sizer</a>.</p>

[rbs_ring_size us="6.5"]

<h2>The "average" women\'s ring size</h2>
<p>If you ask jewellers for the average women\'s ring size, most say 6 to 7, and 6.5 is the midpoint. That makes it a sensible default for gift rings, but around half of women still need a different size, so treat it as a starting point, not an answer. Engagement ring sellers that resize for free often ship in 6.5 when the size is unknown.</p>

<h2>Signs 6.5 is your size</h2>
<ul>
<li>Size 6 rings leave a mark or are difficult to remove at the end of the day.</li>
<li>Size 7 rings slide toward the knuckle and turn so the stone faces sideways.</li>
<li>Your finger circumference measures between about 52.4 and 53.7 mm.</li>
</ul>

<h2>How to check 6.5 at home</h2>
<ol>
<li>Measure a ring that fits across the inside. 16.7–17.1 mm is 6.5.</li>
<li>Or wrap a paper strip around the finger base and measure it in mm.</li>
<li>Or match the ring on your phone in the <a href="/">ring sizer</a> after calibrating with a bank card.</li>
</ol>
<p>Measure at the end of the day, when fingers are largest, and avoid measuring right after exercise or a hot shower.</p>

<h2>6.5 compared with 6 and 7</h2>
<p>Half sizes are 0.4 mm of diameter apart. <a href="/ring-size-in-mm/size-6/">Size 6</a> is 16.5 mm and <a href="/ring-size-in-mm/size-7/">size 7</a> is 17.3 mm, so 6.5 at 16.9 mm is exactly halfway. If you are torn between 6.5 and 7 for a wide band (6 mm+), choose 7; for a thin band or a ring with a large stone that might tip, choose 6.5.</p>

<h2>Size 6.5 in other systems</h2>
<ul>
<li>UK and Australia: M½</li>
<li>EU / ISO: 53</li>
<li>Italy / Spain / Switzerland: 13</li>
<li>India, Pakistan: 13</li>
</ul>

<h2>Resizing to or from 6.5</h2>
<p>Moving a plain gold or silver band by half a size is a quick, inexpensive job for a jeweller. Rings with stones set all the way around (full eternity), tension settings, or titanium and tungsten bands often cannot be resized, so measure carefully before ordering those.</p>

<h2>Quick fit check</h2>
<p>With a 6.5 on your finger, shake your hand downwards: the ring should stay at the base of the finger. Then try to remove it: a light twist over the knuckle is normal, but if you need soap, go up to 7. If you are measuring from a ring that belongs to someone else for a surprise, make sure it is from the same finger and hand, because the ring finger, middle finger and index finger can differ by a full size.</p>

[rbs_cta mode="ring"]

<p>Full list: <a href="/ring-size-in-mm/">ring size in mm</a>.</p>
',
			'faq' => array(
				array( 'What is a size 6.5 ring in mm?', 'A US size 6.5 ring is 16.9 mm in inner diameter and 53.1 mm in inner circumference.' ),
				array( 'What is 6.5 ring size in UK?', 'US 6.5 is UK M½.' ),
				array( 'Is 6.5 an average ring size?', 'Yes. 6.5 is the midpoint of the most common women\'s range, 6 to 7.' ),
				array( 'What is 6.5 ring size in EU?', 'EU size 53, which is about 53 mm inner circumference.' ),
				array( 'Should I get 6.5 or 7?', 'For a thin band choose 6.5 if 7 turns on your finger. For a wide band over 6 mm, choose 7.' ),
			),
		),

		/* ---------------------------------------------------------- SIZE 7 */
		'ring-7' => array(
			'slug'       => 'size-7',
			'parent'     => 'ring-mm',
			'title'      => 'Size 7 Ring in mm – Diameter 17.3 mm',
			'seo_title'  => 'Size 7 Ring in mm: 17.3 mm Diameter, 54.3 mm Circumference',
			'seo_desc'   => 'A US size 7 ring is 17.3 mm in inner diameter and 54.3 mm around: UK N½, EU 54, India 14. Who wears size 7, and how to measure it at home.',
			'mode'       => null,
			'menu_order' => 5,
			'content'    => '
<p><strong>A US size 7 ring has an inner diameter of 17.3 mm (0.68 inches) and an inner circumference of 54.3 mm.</strong> It is UK N½, EU 54 and India 14. Size 7 is one of the most common women\'s ring sizes and a common pinky size for men. Measure your ring on screen with the <a href="/">online ring sizer</a> to confirm.</p>

[rbs_ring_size us="7"]

<h2>Who wears size 7?</h2>
<ul>
<li><strong>Women:</strong> size 7 is at the top of the most common range (6–7) and is very common for the ring finger of women with average to slightly larger hands, and for the middle finger of women who wear 6 on the ring finger.</li>
<li><strong>Men:</strong> a typical little-finger size for a signet or pinky ring, and the ring-finger size for men with slim hands.</li>
<li><strong>Teens:</strong> older teenage boys often start at 7–8.</li>
</ul>

<h2>Checking size 7 at home</h2>
<ol>
<li><strong>Ruler:</strong> a ring that fits with an inside diameter of 17.1–17.5 mm is size 7.</li>
<li><strong>Paper strip:</strong> a finger circumference of 53.7–55.0 mm is size 7.</li>
<li><strong>Phone:</strong> calibrate the <a href="/">ring sizer</a> once with a bank card, place the ring on the screen and read your size in every system.</li>
</ol>

<h2>Worked example</h2>
<p>Maria wraps a paper strip around her ring finger and measures 54.5 mm. Dividing by π gives 54.5 ÷ 3.1416 = 17.35 mm, almost exactly the 17.3 mm of a US 7. Her knuckle is not much larger than the base of her finger, so a standard 7 will fit; if her knuckle were noticeably larger, 7.25 would help the ring pass over it.</p>

<h2>Size 7 in other countries</h2>
<table class="rbs-table">
<thead><tr><th>System</th><th>Size 7 equivalent</th></tr></thead>
<tbody>
<tr><td>UK, Ireland, Australia, NZ</td><td>N½ (some charts say O)</td></tr>
<tr><td>EU, Germany, France, ISO</td><td>54</td></tr>
<tr><td>Italy / Spain / Switzerland</td><td>14</td></tr>
<tr><td>India, Pakistan</td><td>14</td></tr>
</tbody>
</table>

<h2>7 vs 6.5 vs 7.5</h2>
<p><a href="/ring-size-in-mm/size-6-5/">Size 6.5</a> is 16.9 mm and <a href="/ring-size-in-mm/size-7-5/">size 7.5</a> is 17.7 mm. If a size 7 ring feels snug only in summer or after a salty meal, keep the 7: fingers change by up to half a size during the day. If it is tight all the time, go to 7.5. For wide bands, many size-7 wearers choose 7.5.</p>

<h2>Buying tips</h2>
<ul>
<li>Size 7 is stocked by almost every brand, so you will rarely need a special order.</li>
<li>For engagement rings with a large centre stone, a snug 7 (or 6.75) keeps the stone upright.</li>
<li>Silicone rings are often sold in ranges like "6.5–7"; pick the range that includes your exact size.</li>
</ul>

<h2>Why some charts say UK O</h2>
<p>UK sizes step in half letters that do not line up exactly with US half sizes. By diameter, US 7 (17.3 mm) sits between UK N½ (about 17.2 mm) and O (about 17.4 mm), so charts that round up list O. Both will fit. If you are buying from a UK shop, check its chart for the inner diameter and choose the letter closest to 17.3 mm.</p>

[rbs_cta mode="ring"]

<p>See all sizes on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 7 ring in mm?', 'A US size 7 ring is 17.3 mm in inner diameter and 54.3 mm in inner circumference.' ),
				array( 'What is size 7 ring in UK?', 'US 7 is UK N½. Some charts round it to O.' ),
				array( 'Is ring size 7 big for a woman?', 'No. Size 7 is within the most common women\'s range of 6 to 7.' ),
				array( 'What is size 7 ring in inches?', 'About 0.68 inches in inner diameter and 2.14 inches around the inside.' ),
				array( 'What is US size 7 ring in India?', 'Size 14 on the Indian scale (about 54 mm around).' ),
			),
		),

		/* -------------------------------------------------------- SIZE 7.5 */
		'ring-7-5' => array(
			'slug'       => 'size-7-5',
			'parent'     => 'ring-mm',
			'title'      => 'Size 7.5 Ring in mm – Diameter 17.7 mm',
			'seo_title'  => 'Size 7.5 Ring in mm: 17.7 mm Diameter, UK O½, EU 56',
			'seo_desc'   => 'A US size 7.5 ring is 17.7 mm in inner diameter and 55.6 mm around. UK O½, EU 56, India 16. Who wears 7.5 and how to measure for it.',
			'mode'       => null,
			'menu_order' => 6,
			'content'    => '
<p><strong>A US size 7.5 ring measures 17.7 mm across the inside (0.70 inches) and 55.6 mm around.</strong> It equals UK O½, EU 56 and India 16. Size 7.5 is a larger women\'s size and a smaller men\'s size. Use the <a href="/">online ring sizer</a> to see if it is yours.</p>

[rbs_ring_size us="7.5"]

<h2>Who wears 7.5?</h2>
<p>Size 7.5 is where women\'s and men\'s ranges overlap. It is typical for:</p>
<ul>
<li>women with long or larger fingers, especially on the middle finger or the dominant hand;</li>
<li>women choosing a wide band in a size up from their usual 7;</li>
<li>men with slim fingers, and the little finger of men who wear 9–10;</li>
<li>teenage boys.</li>
</ul>

<h2>Measuring for 7.5</h2>
<ol>
<li>Measure a ring that fits: 17.5–17.9 mm across the inside is 7.5.</li>
<li>Or measure around the finger: 55.0–56.2 mm is 7.5.</li>
<li>Or calibrate the <a href="/">ring sizer</a> with any bank card and match your ring on the screen.</li>
</ol>
<p>Measure the finger the ring is for. Ring fingers on the left and right hand can differ by half a size, and the middle finger is usually half to one size larger than the ring finger.</p>

<h2>7.5 vs 7 vs 8</h2>
<table class="rbs-table">
<thead><tr><th>US size</th><th>Diameter</th><th>Circumference</th><th>UK</th><th>EU</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-7/">7</a></td><td>17.3 mm</td><td>54.3 mm</td><td>N½</td><td>54</td></tr>
<tr><td><strong>7.5</strong></td><td><strong>17.7 mm</strong></td><td><strong>55.6 mm</strong></td><td><strong>O½</strong></td><td><strong>56</strong></td></tr>
<tr><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>18.1 mm</td><td>56.9 mm</td><td>P½</td><td>57</td></tr>
</tbody>
</table>

<h2>Knuckles and 7.5</h2>
<p>If your size 7 ring fits the base of the finger but you have to twist it hard over the knuckle, 7.5 may feel loose once it is on. Options: a 7.25 quarter size, a ring with a slightly squared inner profile that resists spinning, or small sizing beads added inside a 7.5 band by a jeweller.</p>

<h2>Size 7.5 internationally</h2>
<ul>
<li>UK / Australia: O½</li>
<li>EU / ISO: 56 (55.6 mm rounds up)</li>
<li>Italy / Spain / Switzerland: 16</li>
<li>India / Pakistan: 16</li>
</ul>

<h2>Buying 7.5</h2>
<p>Half sizes like 7.5 are standard for fine jewellery but sometimes missing from fashion ranges. If a shop sells only whole sizes, choose 7 for thin bands and 8 for wide bands. When buying from Europe, look for size 55.5 or 56.</p>

<h2>Measuring tips for 7.5</h2>
<p>Size 7.5 is often chosen by people whose finger measures 7 at the base but whose knuckle measures 8. Measure both with a paper strip, then pick a size between the two measurements. Measure in the evening at room temperature: fingers are smaller in the morning and in cold weather, and a 7.5 measured on a winter morning may feel tight on a summer evening. If you are buying a ring as a gift, borrowing one of the wearer\'s rings and matching it on screen with the <a href="/">ring sizer</a> is far more reliable than guessing.</p>

[rbs_cta mode="ring"]

<p>All sizes: <a href="/ring-size-in-mm/">ring size in mm</a>.</p>
',
			'faq' => array(
				array( 'What is a size 7.5 ring in mm?', 'A US size 7.5 ring is 17.7 mm in inner diameter and 55.6 mm in inner circumference.' ),
				array( 'What is 7.5 ring size in UK?', 'US 7.5 is UK O½.' ),
				array( 'Is 7.5 a big ring size for a woman?', 'It is slightly above average for women, who mostly wear 6 to 7, but it is a common size.' ),
				array( 'What is 7.5 ring size in EU?', 'EU 56, about 55.6 mm inner circumference.' ),
				array( 'Is 7.5 a men\'s ring size?', 'It is a small men\'s size, often worn by men with slim fingers or on the little finger.' ),
			),
		),

		/* ---------------------------------------------------------- SIZE 8 */
		'ring-8' => array(
			'slug'       => 'size-8',
			'parent'     => 'ring-mm',
			'title'      => 'Size 8 Ring in mm – Diameter 18.1 mm',
			'seo_title'  => 'Size 8 Ring in mm: 18.1 mm Diameter, 56.9 mm Circumference',
			'seo_desc'   => 'A US size 8 ring is 18.1 mm in inner diameter and 56.9 mm around: UK P½, EU 57, India 17. Who wears size 8 and how to measure at home.',
			'mode'       => null,
			'menu_order' => 7,
			'content'    => '
<p><strong>A US size 8 ring has an inner diameter of 18.1 mm (0.71 inches) and an inner circumference of 56.9 mm.</strong> It is UK P½, EU 57 and India 17. Size 8 is a large women\'s size and a common smaller men\'s size. Check it on screen with the <a href="/">online ring sizer</a>.</p>

[rbs_ring_size us="8"]

<h2>Who wears size 8?</h2>
<ul>
<li><strong>Women</strong> with larger hands or long fingers, and many women on the middle or index finger.</li>
<li><strong>Men</strong> with slim to average fingers; size 8 is a common size for men\'s wedding bands at the smaller end.</li>
<li><strong>Thumb rings</strong> for women often fall around 8–9.</li>
</ul>

<h2>Measuring for size 8</h2>
<ol>
<li>Inside diameter of a ring that fits: 17.9–18.3 mm is size 8.</li>
<li>Finger circumference with a paper strip: 56.2–57.5 mm is size 8.</li>
<li>On screen: calibrate the <a href="/">ring sizer</a> with a card and match the ring.</li>
</ol>

<h2>Worked example</h2>
<p>A ring measures 18.0 mm across the inside on a ruler. That is between <a href="/ring-size-in-mm/size-7-5/">7.5</a> (17.7 mm) and 8 (18.1 mm), but much closer to 8. With a ruler\'s accuracy of about ±0.3 mm, the honest answer is "7.75 to 8". Matching the same ring on a calibrated screen, or with a caliper, will settle it.</p>

<h2>Size 8 conversions</h2>
<table class="rbs-table">
<thead><tr><th>System</th><th>Size</th></tr></thead>
<tbody>
<tr><td>UK / Australia</td><td>P½</td></tr>
<tr><td>EU / ISO</td><td>57</td></tr>
<tr><td>Italy / Spain / Switzerland</td><td>17</td></tr>
<tr><td>India / Pakistan</td><td>17</td></tr>
<tr><td>Inner diameter</td><td>18.1 mm / 0.71 in</td></tr>
</tbody>
</table>

<h2>8 for men\'s bands</h2>
<p>Men\'s wedding bands are often 5–8 mm wide. A wide band covers more of the finger, so a man who measures exactly 8 with string often wears 8.5 in a 7 mm band. If you are ordering a tungsten, titanium or ceramic ring, which cannot be resized, measure twice and consider the band width carefully. The next sizes up are 8.5 (18.5 mm) and <a href="/ring-size-in-mm/size-9/">9</a> (19.0 mm).</p>

<h2>Tips</h2>
<ul>
<li>Measure at the end of the day and at room temperature.</li>
<li>Your dominant hand is often ¼–½ size larger; measure the hand you will wear the ring on.</li>
<li>If the ring is for a surprise, borrow a ring from the right finger and match it on screen.</li>
</ul>

<h2>Women\'s size 8</h2>
<p>For women, size 8 is about one to two sizes above the average ring-finger size, which is why some fashion brands sell it as "large". It is a very normal size, especially for taller women and for the index and middle fingers. If your size-8 rings feel tight only in hot weather, a comfort-fit band or a quarter size up (8.25) can help without making the ring loose in winter.</p>

[rbs_cta mode="ring"]

<p>See every size on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 8 ring in mm?', 'A US size 8 ring is 18.1 mm in inner diameter and 56.9 mm in inner circumference.' ),
				array( 'What is size 8 ring in UK?', 'US 8 is UK P½.' ),
				array( 'Is size 8 ring big for a woman?', 'Size 8 is larger than average for a woman\'s ring finger, but common for the middle finger and for women with larger hands.' ),
				array( 'What is size 8 ring in inches?', 'About 0.71 inches in inner diameter and 2.24 inches around the inside.' ),
				array( 'Is 8 a common men\'s ring size?', 'Yes, at the smaller end. Most men wear 9 to 10, but 8 is common for men with slim fingers.' ),
			),
		),

		/* ---------------------------------------------------------- SIZE 9 */
		'ring-9' => array(
			'slug'       => 'size-9',
			'parent'     => 'ring-mm',
			'title'      => 'Size 9 Ring in mm – Diameter 19 mm',
			'seo_title'  => 'Size 9 Ring in mm: 19.0 mm Diameter, 59.7 mm Circumference',
			'seo_desc'   => 'A US size 9 ring is 19.0 mm in inner diameter and 59.7 mm around: UK R½, EU 60, India 20. A common men\'s size; how to measure and choose band width.',
			'mode'       => null,
			'menu_order' => 8,
			'content'    => '
<p><strong>A US size 9 ring has an inner diameter of 19.0 mm (0.75 inches) and an inner circumference of 59.7 mm.</strong> It is UK R½, EU 60 and India 20. Size 9 is one of the most common men\'s ring sizes. Measure a ring you own on screen with the <a href="/">online ring sizer</a> to confirm.</p>

[rbs_ring_size us="9"]

<h2>Size 9: the typical men\'s size</h2>
<p>Most men\'s ring sizes in the US and UK fall between 8 and 12, with 9 to 10 the most common for the ring finger. For women, size 9 is a large size, more often worn on the thumb or the index finger. Size 9 at 19.0 mm is exactly ¾ inch across, which makes it easy to remember.</p>

<h2>How to measure for size 9</h2>
<ol>
<li>Inside diameter of a ring that fits: 18.8–19.2 mm is a 9.</li>
<li>Finger circumference: 59.1–60.3 mm is a 9.</li>
<li>Or use the <a href="/">ring sizer</a>: calibrate with a bank card, place the ring, read the size.</li>
</ol>
<p>Men\'s fingers often have larger knuckles relative to the base of the finger. Measure both. If the knuckle is a full size larger, choose a size in between, or a comfort-fit band, which slides over the knuckle more easily.</p>

<h2>Band width and size 9</h2>
<table class="rbs-table">
<thead><tr><th>Band width</th><th>If you measured size 9</th></tr></thead>
<tbody>
<tr><td>2–4 mm</td><td>Size 9</td></tr>
<tr><td>5–6 mm</td><td>Size 9 or 9.25</td></tr>
<tr><td>7–8 mm</td><td>Size 9.5</td></tr>
<tr><td>10 mm+</td><td>Size 9.5–10</td></tr>
</tbody>
</table>
<p>These adjustments are general guidance. Comfort-fit bands (rounded inside) need less adjustment than flat ones.</p>

<h2>Size 9 conversions</h2>
<ul>
<li>UK / Australia: R½</li>
<li>EU / ISO: 60 (59.7 mm rounded)</li>
<li>Italy / Spain / Switzerland: 20</li>
<li>India / Pakistan: 20</li>
</ul>

<h2>9 vs 8 vs 10</h2>
<p>US <a href="/ring-size-in-mm/size-8/">8</a> is 18.1 mm and <a href="/ring-size-in-mm/size-10/">10</a> is 19.8 mm, with half sizes 8.5 (18.5 mm) and 9.5 (19.4 mm) in between. If a 9 is tight only after exercise or in hot weather, keep the 9. If it is tight at room temperature in the evening, move to 9.5.</p>

<h2>Rings that cannot be resized</h2>
<p>Tungsten carbide, ceramic and many titanium bands cannot be resized, and men\'s bands are often made in these materials. For those, measure on two different days, and if you are between 9 and 9.5, the larger size with a comfort-fit profile is usually the safer choice.</p>

<h2>Fit check for men</h2>
<p>A good fit at size 9 needs a gentle twist to pass the knuckle and then sits at the base of the finger without spinning. If you work with your hands, lift weights or live in a hot climate, test the ring after exercise and at the end of a warm day. If it becomes hard to remove, 9.5 in a comfort-fit band is usually the answer. If you are buying a surprise ring, borrow a ring from the right finger and match it on screen with the <a href="/">ring sizer</a>.</p>

[rbs_cta mode="ring"]

<p>See all sizes on the <a href="/ring-size-in-mm/">ring size in mm</a> chart.</p>
',
			'faq' => array(
				array( 'What is a size 9 ring in mm?', 'A US size 9 ring is 19.0 mm in inner diameter and 59.7 mm in inner circumference.' ),
				array( 'What is size 9 ring in UK?', 'US 9 is UK R½.' ),
				array( 'Is size 9 a common men\'s ring size?', 'Yes. Most men wear between 9 and 10 on the ring finger.' ),
				array( 'What is size 9 ring in inches?', 'Exactly ¾ inch (0.75 in) in inner diameter and about 2.35 inches around.' ),
				array( 'What is a size 9 ring in India?', 'Size 20 on the Indian scale (about 60 mm around).' ),
			),
		),

		/* --------------------------------------------------------- SIZE 10 */
		'ring-10' => array(
			'slug'       => 'size-10',
			'parent'     => 'ring-mm',
			'title'      => 'Size 10 Ring in mm – Diameter 19.8 mm',
			'seo_title'  => 'Size 10 Ring in mm: 19.8 mm Diameter, 62.2 mm Circumference',
			'seo_desc'   => 'A US size 10 ring is 19.8 mm in inner diameter and 62.2 mm around: UK T½, EU 62, India 22. Who wears size 10 and how to check it at home.',
			'mode'       => null,
			'menu_order' => 9,
			'content'    => '
<p><strong>A US size 10 ring has an inner diameter of 19.8 mm (0.78 inches) and an inner circumference of 62.2 mm.</strong> It is UK T½, EU 62 and India 22. Size 10 is a common men\'s ring size and the upper end of the average men\'s range. Confirm your size on screen with the <a href="/">online ring sizer</a>.</p>

[rbs_ring_size us="10"]

<h2>Who wears size 10?</h2>
<ul>
<li>Men with average to large hands on the ring finger; together with 9, size 10 is the most common men\'s size.</li>
<li>Men\'s middle finger when the ring finger is 9–9.5.</li>
<li>Women\'s thumb rings for larger hands.</li>
</ul>

<h2>Checking size 10 at home</h2>
<ol>
<li>Measure the inside of a ring that fits: 19.6–20.0 mm is size 10.</li>
<li>Measure around the finger base with paper: 61.6–62.8 mm is size 10.</li>
<li>Or calibrate the <a href="/">ring sizer</a> with a bank card and match the ring to the circle.</li>
</ol>

<h2>Worked example</h2>
<p>David measures his finger with a paper strip and gets 63 mm. 63 ÷ 3.1416 = 20.05 mm diameter, between US 10 (19.8 mm) and 10.5 (20.2 mm). His knuckle is large, so he chooses 10.5 in a 6 mm comfort-fit band. If his knuckle were small, a size 10 would sit more securely.</p>

<h2>Size 10 conversions</h2>
<table class="rbs-table">
<thead><tr><th>System</th><th>Size 10 equals</th></tr></thead>
<tbody>
<tr><td>UK / Australia</td><td>T½</td></tr>
<tr><td>EU / ISO</td><td>62</td></tr>
<tr><td>Italy / Spain / Switzerland</td><td>22</td></tr>
<tr><td>India / Pakistan</td><td>22</td></tr>
<tr><td>Inner diameter</td><td>19.8 mm / 0.78 in</td></tr>
</tbody>
</table>

<h2>10 vs 9.5 vs 10.5</h2>
<p>US 9.5 is 19.4 mm, 10 is 19.8 mm and 10.5 is 20.2 mm. Fingers change by up to half a size between morning and evening, and between winter and summer. A ring that is fine in the evening in summer but loose on a cold morning is the right size; a ring that is tight in the evening is too small. One size down is <a href="/ring-size-in-mm/size-9/">size 9</a>.</p>

<h2>Wide bands at size 10</h2>
<p>Many men\'s bands are 6–8 mm wide. For a flat 8 mm band, a man who measures exactly 10 often needs 10.5. Signet rings with a heavy top can rotate if they are loose, so for those a snug fit at the exact size is better.</p>

<h2>Buying a size 10</h2>
<ul>
<li>Size 10 is widely stocked in men\'s rings.</li>
<li>In Europe, look for size 62; in the UK, T or T½.</li>
<li>For non-resizable materials (tungsten, ceramic), measure twice and consider band width before ordering.</li>
</ul>

<h2>Measuring a man\'s finger for size 10</h2>
<p>Men\'s knuckles are often much larger than the base of the finger, which makes string measurements tricky. Measure both the base and the knuckle, and choose a size between them. A ring that fits only the base will not go on; a ring sized to the knuckle may spin. A paper strip around the knuckle of 63–64 mm with a base of 61–62 mm points to size 10 or 10.5.</p>

[rbs_cta mode="ring"]

<p>All sizes: <a href="/ring-size-in-mm/">ring size in mm</a> and the full <a href="/ring-size-chart/">ring size chart</a>.</p>
',
			'faq' => array(
				array( 'What is a size 10 ring in mm?', 'A US size 10 ring is 19.8 mm in inner diameter and 62.2 mm in inner circumference.' ),
				array( 'What is size 10 ring in UK?', 'US 10 is UK T½.' ),
				array( 'Is size 10 big for a man?', 'No. Size 10 is within the most common men\'s range of 9 to 10.' ),
				array( 'What is size 10 ring in inches?', 'About 0.78 inches in inner diameter and 2.45 inches around the inside.' ),
				array( 'What is size 10 ring in EU?', 'EU 62, about 62 mm inner circumference.' ),
			),
		),
	);
}
