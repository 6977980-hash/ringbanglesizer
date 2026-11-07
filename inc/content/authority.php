<?php
/**
 * Authority pages (plan doc content map #30–#40, Phase 4):
 * ring size chart variants (UK, US, India, men's, women's), average ring size,
 * the guides hub with three guides, and the embeddable widget page.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_authority_pages() {
	return array(

		/* ------------------------------------------------------ RING SIZE CHART UK */
		'ring-chart-uk' => array(
			'slug'       => 'uk',
			'parent'     => 'ring-chart',
			'title'      => 'UK Ring Size Chart – Letters A to Z in mm',
			'seo_title'  => 'UK Ring Size Chart: Letters to US, EU and mm (2026)',
			'seo_desc'   => 'UK ring size chart with every letter from F to Z, half sizes, inner diameter and circumference in mm, and the matching US and EU size.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => <<<'HTML'
<p><strong>UK ring sizes are letters: each letter is about 0.4 mm of inner diameter, and half letters sit in between.</strong> The most common sizes are L to N for women (16.3–17.1 mm) and R to T for men (18.8–19.6 mm). UK N½ equals US 7, EU 54 and 17.3 mm. Find your letter below, or <a href="/">measure a ring on your phone screen</a> and read the UK size directly.</p>

<h2>UK ring size chart</h2>
<p>Half letters (J½, K½ …) line up exactly with US half and whole sizes. Whole letters fall between two US sizes, so their US column shows a quarter size such as 6¼.</p>
[rbs_uk_ring_table]
<p>The same letter scale is used in Australia, New Zealand, Ireland and South Africa, so this chart works for shops in those countries too. Sizes below F are children's sizes; sizes above Z are written Z+1, Z+2 and so on, and are listed in the full <a href="/ring-size-chart/">ring size chart</a>.</p>

<h2>How UK ring sizes work</h2>
<p>The UK scale was standardised in British Standard BS 6820:1987. That standard has since been withdrawn, but jewellers still use its letter scale and now measure rings per BS EN ISO 8653. Each letter is defined by the inside circumference of the ring. One full letter adds about 1.25 mm of circumference (0.4 mm of diameter), and a half letter adds about 0.6 mm. That makes UK sizes slightly finer than US half sizes, which is why British jewellers often quote a half letter (for example "M and a half") where an American shop would only offer 6.5.</p>
<p>A few practical points:</p>
<ul>
<li><strong>Letters skip nothing.</strong> Unlike some old continental scales, every letter from A to Z is used, including I and Q.</li>
<li><strong>Z is not the end.</strong> Larger rings are written Z+1, Z+2 … each about one US half size larger.</li>
<li><strong>Half sizes are normal.</strong> High-street jewellers stock half letters for wedding bands and engagement rings; fashion rings are usually whole letters only.</li>
</ul>

<h2>UK to US ring size conversion</h2>
<table class="rbs-table">
<thead><tr><th>UK</th><th>US</th><th>Who usually wears it</th></tr></thead>
<tbody>
<tr><td>J – K</td><td>4¾ – 5¼</td><td>Petite fingers, pinky rings, midi rings</td></tr>
<tr><td>L – M</td><td>5¾ – 6¼</td><td>Slim ring fingers; very common for women</td></tr>
<tr><td>N – O</td><td>6¾ – 7¼</td><td>The middle of the women's range</td></tr>
<tr><td>P – Q</td><td>7¾ – 8¼</td><td>Larger women's fingers, smaller men's</td></tr>
<tr><td>R – T</td><td>8¾ – 9¾</td><td>The most common men's wedding band sizes</td></tr>
<tr><td>U – W</td><td>10¼ – 11¼</td><td>Larger men's fingers, thumb rings</td></tr>
<tr><td>X – Z</td><td>11¾ – 12½</td><td>Large hands, signet rings for the little finger of big hands</td></tr>
</tbody>
</table>
<p>Need another system as well? The <a href="/ring-size-converter/">ring size converter</a> turns any UK letter into US, EU, Indian and Swiss sizes in one step.</p>

<h2>How to find your UK ring size at home</h2>
<ol>
<li><strong>On screen (quickest):</strong> open the <a href="/">online ring sizer</a>, hold a bank card against the screen to calibrate, then place a ring that fits on the circle. The result shows the UK letter as well as US and EU.</li>
<li><strong>With a ring and a ruler:</strong> measure straight across the inside of the ring in millimetres and find the nearest diameter in the chart above.</li>
<li><strong>With paper or string:</strong> wrap a thin strip around the base of the finger, mark where it overlaps, and measure the length. That is the circumference column. See <a href="/how-to-measure-ring-size-at-home/">how to measure ring size at home</a> for tips that stop the strip slipping.</li>
<li><strong>On paper:</strong> print the <a href="/printable-ring-sizer/">printable ring sizer</a> on A4 at 100% and compare a ring to the true-size circles.</li>
</ol>

<h2>Buying from US or EU shops</h2>
<p>When a UK buyer orders from an American website, convert the letter to the nearest US half size. If you are a whole letter (for example M), you sit exactly between two US sizes (6 and 6.5): choose the larger one for wide or chunky rings and the smaller one for a slim band you want to stay put. European shops use the inner circumference in millimetres, so UK N½ is simply EU 54. Swiss shops subtract 40 from that number, so N½ is Swiss 14.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/us/">US ring size chart</a> with quarter sizes</li>
<li><a href="/ring-size-chart/">Full ring size chart</a> – every system on one page</li>
<li><a href="/ring-size-in-mm/">Ring size in mm</a></li>
<li><a href="/average-ring-size/">Average ring size</a> for women and men</li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What is UK ring size N in US size?', 'UK N is about US 6¾ (17.1 mm inner diameter). UK N½ is exactly US 7 (17.3 mm, EU 54).' ),
				array( 'What is the most common ring size for women in the UK?', 'Most women in the UK wear between L and N, which is about US 5¾ to 6¾ and 16.3 to 17.1 mm inner diameter.' ),
				array( 'What is the average men\'s ring size in the UK?', 'Most men wear between R and T, about US 8¾ to 9¾ and 18.8 to 19.6 mm inner diameter.' ),
				array( 'How big is one UK ring size?', 'One full UK letter adds about 1.25 mm of inner circumference, or about 0.4 mm of diameter. A half letter is about 0.6 mm of circumference.' ),
				array( 'What comes after Z in UK ring sizes?', 'Sizes above Z are written Z+1, Z+2, Z+3 and so on. Z+1 is about US 13 (22.2 mm) and Z+3 is about US 14 (23.0 mm).' ),
			),
		),

		/* ------------------------------------------------------ RING SIZE CHART US */
		'ring-chart-us' => array(
			'slug'       => 'us',
			'parent'     => 'ring-chart',
			'title'      => 'US Ring Size Chart – Sizes 3 to 13 with Quarter Sizes',
			'seo_title'  => 'US Ring Size Chart: Quarter Sizes in mm and Inches (2026)',
			'seo_desc'   => 'US ring size chart from size 3 to 13 in quarter steps, with inner diameter and circumference in mm and inches. Includes how US sizes are defined.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => <<<'HTML'
<p><strong>US ring sizes run from about 3 to 13 for adults, and every whole size adds about 0.81 mm of inner diameter (2.55 mm of circumference).</strong> A US 7 is 17.3 mm across the inside (0.681 in) and 54.3 mm around. The chart below lists every quarter size, which is how jewellers order wedding and engagement rings in the United States and Canada.</p>

<h2>US ring size chart with quarter sizes</h2>
[rbs_us_quarter_table]
<p>Quarter sizes are the midpoint between two half sizes. A 6¾ is 17.1 mm, between 6.5 (16.9 mm) and 7 (17.3 mm). Linked sizes have their own page with a true-size circle and more detail.</p>

<h2>How US ring sizes are defined</h2>
<p>US and Canadian sizes follow a straight line: the inside diameter grows by a fixed step for every size. Jewellers' charts, ring mandrels and the standard sizing gauges sold in the US all follow the same rule closely:</p>
<ul>
<li><strong>Inner diameter (mm) ≈ 11.63 + 0.8128 × US size</strong></li>
<li><strong>Inner circumference (mm) ≈ 36.5 + 2.55 × US size</strong></li>
<li><strong>Size 0</strong> would be a ring of about 11.6 mm, and every size after that is roughly 1/32 inch larger in diameter.</li>
</ul>
<p>Because the scale is linear, a quarter size is always about 0.2 mm of diameter and 0.64 mm of circumference. That is less than the thickness of a credit card, which is why measuring at home needs a little care. The <a href="/ring-size-calculator/">ring size calculator</a> does the maths for you from a diameter or circumference.</p>

<h2>US sizes in inches</h2>
<p>American ring mandrels and some older charts give the inner diameter in inches. A few anchor points to remember:</p>
<table class="rbs-table">
<thead><tr><th>US size</th><th>Inner diameter</th><th>Inner circumference</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-5/">5</a></td><td>0.618 in (about 5/8 in)</td><td>1.94 in</td></tr>
<tr><td><a href="/ring-size-in-mm/size-7/">7</a></td><td>0.681 in (about 11/16 in)</td><td>2.14 in</td></tr>
<tr><td><a href="/ring-size-in-mm/size-9/">9</a></td><td>0.748 in (about 3/4 in)</td><td>2.35 in</td></tr>
<tr><td>11</td><td>0.811 in (about 13/16 in)</td><td>2.55 in</td></tr>
<tr><td>13</td><td>0.874 in (about 7/8 in)</td><td>2.74 in</td></tr>
</tbody>
</table>
<p>If your tape is in inches, the <a href="/ring-size-by-diameter/">ring size by diameter</a> page has a lookup that accepts inches.</p>

<h2>Which US sizes are most common?</h2>
<p>US jewellers report that most women buy between size 5 and 8, with 6 to 7 the busiest range, and most men buy between 8 and 12, with 9 to 10 the busiest. Thumb rings are typically 2 to 3 sizes above a person's ring-finger size, and pinky rings 1½ to 2 sizes below. See <a href="/average-ring-size/">average ring size</a> for the details and how to guess someone's size for a surprise.</p>

<h2>When to choose a quarter size</h2>
<ul>
<li><strong>You measure between two half sizes</strong> and the ring is a wide band (6 mm and over) – order the upper quarter.</li>
<li><strong>Your knuckle is much larger than the base of your finger.</strong> The ring must pass the knuckle, so a quarter up is often the comfortable compromise.</li>
<li><strong>The ring cannot be resized later.</strong> Tungsten, titanium, ceramic and full eternity bands are hard or impossible to resize, so it pays to get the quarter right first time. Read <a href="/blog/resize-a-ring/">can you resize a ring?</a> before you buy.</li>
</ul>

<h2>Measure your US size</h2>
<p>The fastest way is the <a href="/">online ring sizer</a>: calibrate with a bank card, place a ring that fits on the screen and read the US size (plus UK, EU, India and mm). Prefer paper? The US Letter version of the <a href="/printable-ring-sizer/">printable ring sizer</a> has circles from US 4 to 12.5.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/uk/">UK ring size chart</a> (letters)</li>
<li><a href="/ring-size-chart/mens/">Men's ring size chart</a> and <a href="/ring-size-chart/womens/">women's ring size chart</a></li>
<li><a href="/ring-size-converter/">Ring size converter</a></li>
<li><a href="/ring-size-by-circumference/">Ring size by circumference</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'How many mm is one US ring size?', 'One whole US size adds about 0.81 mm of inner diameter and about 2.55 mm of inner circumference. A half size is 0.4 mm of diameter.' ),
				array( 'What is a size 7 ring in inches?', 'US 7 has an inner diameter of 0.681 inches (17.3 mm) and an inner circumference of 2.14 inches (54.3 mm).' ),
				array( 'Do quarter ring sizes exist?', 'Yes. Most US jewellers can order wedding bands and engagement rings in quarter sizes such as 6¼ or 6¾. Fashion rings are usually made only in whole and half sizes.' ),
				array( 'What is the difference between US size 6.5 and 7?', 'US 6.5 is 16.9 mm inner diameter and US 7 is 17.3 mm, a difference of 0.4 mm across or about 1.3 mm around the finger.' ),
				array( 'Are US and Canadian ring sizes the same?', 'Yes. Canada and Mexico use the same numeric scale as the United States.' ),
			),
		),

		/* --------------------------------------------------- RING SIZE CHART INDIA */
		'ring-chart-india' => array(
			'slug'       => 'india',
			'parent'     => 'ring-chart',
			'title'      => 'Indian Ring Size Chart – Sizes in mm and US/UK',
			'seo_title'  => 'Ring Size Chart India: Indian Sizes in mm, US and UK (2026)',
			'seo_desc'   => 'Indian ring size chart from size 4 to 35 with inner diameter and circumference in mm and the nearest US and UK size. How Indian jewellers measure.',
			'mode'       => null,
			'menu_order' => 4,
			'content'    => <<<'HTML'
<p><strong>Indian ring sizes are numbers from about 4 to 35, and each number is the ring's inner circumference minus 40 mm.</strong> Indian size 14 is 54 mm around (17.2 mm across), the same as US 7 and UK N½; size 22 is 62 mm around, the same as US 10. Most women in India wear sizes 12 to 14 and most men 20 to 22. Use the chart below or <a href="/">measure a ring on your phone</a> to get your Indian size in seconds.</p>

<h2>Indian ring size chart</h2>
[rbs_india_ring_table]
<p>Indian numbers are finer than US half sizes (one number is 1 mm of circumference, a US half size about 1.3 mm), so two neighbouring Indian numbers can map to the same US size (for example 20 and 21 are both close to US 9–9.5). When you convert, pick the US or UK size whose diameter is closest to your own ring.</p>

<h2>How the Indian ring size scale works</h2>
<p>The Indian scale, used by jewellers such as Tanishq and BlueStone and by local shops in Pakistan, is set by the inner circumference:</p>
<ul>
<li><strong>Indian size = inner circumference (mm) − 40</strong>, rounded to the nearest whole number</li>
<li><strong>Circumference (mm) = Indian size + 40</strong>, and diameter = circumference ÷ 3.1416</li>
</ul>
<p>So size 8 is 48 mm around (15.3 mm across), size 14 is 54 mm (17.2 mm), size 18 is 58 mm (18.5 mm) and size 22 is 62 mm (19.7–19.8 mm). Italy, Spain and Switzerland number rings the same way. The Japanese scale is different (it adds a size every third of a millimetre of diameter), so do not use a Japanese chart for Indian sizes. Jewellers in India measure fingers with a metal ring-sizer set (a bunch of numbered rings) or a tapered stick called a ring mandrel, both marked with these numbers. A few traditional shops use their own sticks that can differ by one number, so when in doubt ask for the diameter in millimetres.</p>

<h2>Common sizes in India</h2>
<table class="rbs-table">
<thead><tr><th>Who</th><th>Typical Indian size</th><th>US</th><th>Diameter</th></tr></thead>
<tbody>
<tr><td>Women – ring finger</td><td>11 – 17</td><td>5.5 – 8</td><td>16.1 – 18.1 mm</td></tr>
<tr><td>Women – most common</td><td>12 – 14</td><td>6 – 7</td><td>16.5 – 17.3 mm</td></tr>
<tr><td>Men – ring finger</td><td>18 – 25</td><td>8.5 – 11</td><td>18.5 – 20.6 mm</td></tr>
<tr><td>Men – most common</td><td>20 – 22</td><td>9 – 10</td><td>19.0 – 19.8 mm</td></tr>
<tr><td>Toe rings (bichiya)</td><td>usually adjustable</td><td>–</td><td>–</td></tr>
</tbody>
</table>
<p>These ranges are what jewellers commonly see, not a rule. Finger size depends on hand size, build and even the weather, so always measure the actual finger.</p>

<h2>Buying rings in India and online</h2>
<ul>
<li><strong>Local jewellers</strong> use the Indian numbers above. Gold rings can usually be enlarged or reduced by one or two sizes after purchase, often free for the first adjustment.</li>
<li><strong>Online stores</strong> such as Tanishq, CaratLane, BlueStone and marketplaces list Indian sizes, sometimes with the diameter or circumference in mm. Check which one they mean before you order.</li>
<li><strong>International brands</strong> list US sizes (in the US) or EU circumference sizes (in Europe). Convert with this chart or the <a href="/ring-size-converter/">ring size converter</a>.</li>
<li><strong>Engagement and wedding rings</strong> are often bought months before the ceremony. Fingers can be half a size larger in the hot months and in the evening, so measure at a normal room temperature and late in the day.</li>
</ul>

<h2>Measure your Indian ring size at home</h2>
<ol>
<li><strong>With the online sizer:</strong> open the <a href="/">ring sizer</a>, calibrate with any bank card, PAN card or Aadhaar PVC card (all are the standard ID-1 card size; on a phone hold the card upright and match its short side, on a computer match its long side), then match a ring that fits. The result shows the Indian number with US, UK and mm.</li>
<li><strong>With a thread:</strong> wrap a cotton thread around the base of the finger, mark it, and measure the length in mm. Divide by 3.14 to get the diameter and find it in the chart.</li>
<li><strong>With a ring and scale:</strong> measure the inside of a ring that fits, edge to edge, in mm.</li>
</ol>
<p>Shopping for bangles as well? The <a href="/bangle-size-chart/india/">Indian bangle size chart</a> explains 2.4, 2.6 and 2.8 sizes, and the <a href="/bangle-size-calculator/">bangle size calculator</a> finds yours on screen.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/pakistan/">Ring size chart Pakistan</a> (same number scale)</li>
<li><a href="/ring-size-chart/">Full ring size chart</a></li>
<li><a href="/ring-size-in-mm/">Ring size in mm</a></li>
<li><a href="/blog/bangle-size-for-wedding/">Bridal bangle size guide</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What is ring size 14 in India in mm?', 'Indian size 14 has an inner circumference of about 54 mm and an inner diameter of about 17.2 mm. It is the same as US 7 and UK N½.' ),
				array( 'What is the common ring size for ladies in India?', 'Most women in India wear sizes 12 to 14 on the ring finger (US 6 to 7, 16.5 to 17.3 mm), within an overall range of about 11 to 17.' ),
				array( 'What is the average ring size for men in India?', 'Most Indian men wear sizes 20 to 22 (US 9 to 10, about 19.0 to 19.8 mm), within a range of about 18 to 25.' ),
				array( 'Is Indian ring size the same as US size?', 'No. An Indian size is the inner circumference in mm minus 40. Indian 14 is US 7, Indian 17 is about US 8, Indian 20 is about US 9 and Indian 22 is US 10.' ),
				array( 'How do I convert Indian ring size to mm?', 'Add 40 to get the inner circumference in mm, then divide by 3.1416 for the diameter. For example size 22 is 62 mm around and 19.7 mm across (US 10).' ),
			),
		),

		/* --------------------------------------------------- MEN'S RING SIZE CHART */
		'ring-chart-mens' => array(
			'slug'       => 'mens',
			'parent'     => 'ring-chart',
			'title'      => 'Men\'s Ring Size Chart – US, UK, EU and mm',
			'seo_title'  => 'Men\'s Ring Size Chart: US 8 to 15 in mm (2026)',
			'seo_desc'   => 'Men\'s ring size chart from US 8 to 15 with UK, EU and Indian sizes and mm. Average men\'s ring size, wide band sizing and how to measure a man\'s finger.',
			'mode'       => null,
			'menu_order' => 5,
			'content'    => <<<'HTML'
<p><strong>Most men wear US ring sizes 8 to 12, and the most common wedding band sizes are 9 to 10 (19.0 to 19.8 mm inside, UK R½ to T½).</strong> Men's rings are usually wider than women's, so the same finger often needs a quarter or half size more. The chart below covers every men's size from 8 to 15 with the matching UK, EU and Indian size.</p>

<h2>Men's ring size chart</h2>
<table class="rbs-table">
<thead><tr><th>US</th><th>UK</th><th>EU</th><th>India</th><th>Inner diameter</th><th>Circumference</th></tr></thead>
<tbody>
<tr><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>P½</td><td>57</td><td>17</td><td>18.1 mm</td><td>56.9 mm</td></tr>
<tr><td>8.5</td><td>Q½</td><td>58</td><td>18</td><td>18.5 mm</td><td>58.1 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-9/">9</a></td><td>R½</td><td>60</td><td>20</td><td>19.0 mm</td><td>59.7 mm</td></tr>
<tr><td>9.5</td><td>S½</td><td>61</td><td>21</td><td>19.4 mm</td><td>60.9 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-10/">10</a></td><td>T½</td><td>62</td><td>22</td><td>19.8 mm</td><td>62.2 mm</td></tr>
<tr><td>10.5</td><td>U½</td><td>63</td><td>23</td><td>20.2 mm</td><td>63.5 mm</td></tr>
<tr><td>11</td><td>V½</td><td>65</td><td>25</td><td>20.6 mm</td><td>64.7 mm</td></tr>
<tr><td>11.5</td><td>W½</td><td>66</td><td>26</td><td>21.0 mm</td><td>66.0 mm</td></tr>
<tr><td>12</td><td>X½</td><td>67</td><td>27</td><td>21.4 mm</td><td>67.2 mm</td></tr>
<tr><td>12.5</td><td>Z</td><td>68</td><td>28</td><td>21.8 mm</td><td>68.5 mm</td></tr>
<tr><td>13</td><td>Z+1</td><td>70</td><td>30</td><td>22.2 mm</td><td>69.7 mm</td></tr>
<tr><td>13.5</td><td>Z+2</td><td>71</td><td>31</td><td>22.6 mm</td><td>71.0 mm</td></tr>
<tr><td>14</td><td>Z+3</td><td>72</td><td>32</td><td>23.0 mm</td><td>72.3 mm</td></tr>
<tr><td>14.5</td><td>Z+4</td><td>74</td><td>34</td><td>23.4 mm</td><td>73.5 mm</td></tr>
<tr><td>15</td><td>Z+5</td><td>75</td><td>35</td><td>23.8 mm</td><td>74.8 mm</td></tr>
</tbody>
</table>
<p>Smaller sizes (US 3 to 7.5) are in the full <a href="/ring-size-chart/">ring size chart</a>; some men wear them on the little finger.</p>

<h2>Band width changes the size</h2>
<p>A wide band covers more of the finger, so it presses on more skin and feels tighter than a thin band of the same size. Many jewellers give men's bands a "comfort fit" (rounded inside) to help with this. A practical guide:</p>
<table class="rbs-table">
<thead><tr><th>Band width</th><th>Typical use</th><th>Adjust your measured size</th></tr></thead>
<tbody>
<tr><td>2 – 4 mm</td><td>Slim bands, stacking rings</td><td>No change</td></tr>
<tr><td>5 – 6 mm</td><td>The classic men's wedding band</td><td>+ ¼ size</td></tr>
<tr><td>7 – 8 mm</td><td>Wide bands, many tungsten rings</td><td>+ ¼ to ½ size</td></tr>
<tr><td>9 mm and more</td><td>Statement rings, signet rings</td><td>+ ½ size</td></tr>
</tbody>
</table>
<p>For a comfort-fit band, some brands advise going down a quarter instead. Always check the brand's own sizing note, and try a sizer of the same width if you can.</p>

<h2>Signet rings and pinky rings</h2>
<p>Signet rings are traditionally worn on the little finger of the non-dominant hand. A man's little finger is usually about 1½ to 2 sizes smaller than his ring finger, so a man who wears a US 10 wedding band typically needs a US 8 to 8.5 signet ring. Because signet rings are heavy on top, they should fit snugly enough not to spin.</p>

<h2>Materials that cannot be resized</h2>
<p>Many popular men's rings are made from tungsten carbide, titanium, ceramic, carbon fibre or stainless steel. These cannot be resized like gold or silver, so if the size is wrong the only fix is an exchange. Measure twice, and measure late in the day when fingers are at their largest. Our guide <a href="/blog/resize-a-ring/">can you resize a ring?</a> lists which metals can be changed and by how much.</p>

<h2>How to measure a man's ring size</h2>
<ol>
<li><strong>Use a ring he already wears on the same finger.</strong> Put it on the screen of the <a href="/">online ring sizer</a> after calibrating with a bank card, or measure its inner diameter with a ruler.</li>
<li><strong>Measure the finger directly</strong> with a paper strip, wrapped at the base of the finger, then slid over the knuckle to make sure it passes. Use the circumference column above.</li>
<li><strong>Allow for the knuckle.</strong> Men often have large knuckles. If the strip is tight over the knuckle, size up a quarter or half.</li>
</ol>
<p>Buying a surprise wedding band? Our <a href="/average-ring-size/">average ring size</a> page explains how to estimate a size from a ring he wears on another finger.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/womens/">Women's ring size chart</a></li>
<li><a href="/ring-size-chart/us/">US ring size chart</a> with quarter sizes</li>
<li><a href="/blog/ring-too-tight-or-loose/">How should a ring fit?</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a> (men's bracelets)</li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What is the average ring size for men?', 'Most men wear US 9 to 10 (UK R½ to T½, 19.0 to 19.8 mm inner diameter). The overall range for men is about US 8 to 12.' ),
				array( 'Is size 10 a big ring size for a man?', 'No. US 10 (19.8 mm, UK T½, EU 62) is right in the middle of the usual men\'s range and is one of the most common wedding band sizes.' ),
				array( 'Should a men\'s wedding band be a size bigger?', 'Not a full size. For bands 6 mm and wider, go up about a quarter to a half size from your measured size; for comfort-fit bands follow the brand\'s advice.' ),
				array( 'What size is a men\'s pinky ring?', 'The little finger is usually about 1½ to 2 sizes smaller than the ring finger, so a man with a US 10 ring finger typically wears about US 8 to 8.5 on the pinky.' ),
				array( 'Can tungsten rings be resized?', 'No. Tungsten carbide is too hard to cut and solder, so a tungsten ring in the wrong size has to be exchanged.' ),
			),
		),

		/* ------------------------------------------------- WOMEN'S RING SIZE CHART */
		'ring-chart-womens' => array(
			'slug'       => 'womens',
			'parent'     => 'ring-chart',
			'title'      => 'Women\'s Ring Size Chart – US, UK, EU and mm',
			'seo_title'  => 'Women\'s Ring Size Chart: US 3 to 10 in mm (2026)',
			'seo_desc'   => 'Women\'s ring size chart from US 3 to 10 with UK, EU and Indian sizes and mm. Average size for women, engagement ring sizing and fit tips.',
			'mode'       => null,
			'menu_order' => 6,
			'content'    => <<<'HTML'
<p><strong>Most women wear US ring sizes 5 to 8, and the most common ring-finger sizes are 6 to 7 (16.5 to 17.3 mm inside, UK L½ to N½).</strong> The chart below covers every women's size from US 3 to 10 in half steps with UK, EU and Indian sizes. To check your own size, <a href="/">match a ring you own on your phone screen</a>.</p>

<h2>Women's ring size chart</h2>
<table class="rbs-table">
<thead><tr><th>US</th><th>UK</th><th>EU</th><th>India</th><th>Inner diameter</th><th>Circumference</th></tr></thead>
<tbody>
<tr><td>3</td><td>F</td><td>44</td><td>4</td><td>14.1 mm</td><td>44.3 mm</td></tr>
<tr><td>3.5</td><td>G</td><td>46</td><td>6</td><td>14.5 mm</td><td>45.6 mm</td></tr>
<tr><td>4</td><td>H</td><td>47</td><td>7</td><td>14.9 mm</td><td>46.8 mm</td></tr>
<tr><td>4.5</td><td>I</td><td>48</td><td>8</td><td>15.3 mm</td><td>48.1 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-5/">5</a></td><td>J½</td><td>49</td><td>9</td><td>15.7 mm</td><td>49.3 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-5-5/">5.5</a></td><td>K½</td><td>51</td><td>11</td><td>16.1 mm</td><td>50.6 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-6/">6</a></td><td>L½</td><td>52</td><td>12</td><td>16.5 mm</td><td>51.8 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-6-5/">6.5</a></td><td>M½</td><td>53</td><td>13</td><td>16.9 mm</td><td>53.1 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-7/">7</a></td><td>N½</td><td>54</td><td>14</td><td>17.3 mm</td><td>54.3 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-7-5/">7.5</a></td><td>O½</td><td>56</td><td>16</td><td>17.7 mm</td><td>55.6 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-8/">8</a></td><td>P½</td><td>57</td><td>17</td><td>18.1 mm</td><td>56.9 mm</td></tr>
<tr><td>8.5</td><td>Q½</td><td>58</td><td>18</td><td>18.5 mm</td><td>58.1 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-9/">9</a></td><td>R½</td><td>60</td><td>20</td><td>19.0 mm</td><td>59.7 mm</td></tr>
<tr><td>9.5</td><td>S½</td><td>61</td><td>21</td><td>19.4 mm</td><td>60.9 mm</td></tr>
<tr><td><a href="/ring-size-in-mm/size-10/">10</a></td><td>T½</td><td>62</td><td>22</td><td>19.8 mm</td><td>62.2 mm</td></tr>
</tbody>
</table>
<p>Sizes 3 to 4.5 are mostly used for pinky rings, midi rings (worn above the knuckle) and teenagers. Larger sizes are in the <a href="/ring-size-chart/mens/">men's chart</a> and the full <a href="/ring-size-chart/">ring size chart</a>.</p>

<h2>Women's sizes by finger</h2>
<table class="rbs-table">
<thead><tr><th>Finger</th><th>Typical women's range (US)</th><th>Compared with the ring finger</th></tr></thead>
<tbody>
<tr><td>Thumb</td><td>8 – 10</td><td>About 2 to 3 sizes larger</td></tr>
<tr><td>Index finger</td><td>6.5 – 8.5</td><td>About ½ to 1½ sizes larger</td></tr>
<tr><td>Middle finger</td><td>7 – 8.5</td><td>About 1 size larger</td></tr>
<tr><td>Ring finger</td><td>5.5 – 7.5</td><td>–</td></tr>
<tr><td>Little finger</td><td>3.5 – 5.5</td><td>About 1½ to 2 sizes smaller</td></tr>
<tr><td>Midi (above the knuckle)</td><td>2 – 4</td><td>About 3 sizes smaller than the same finger</td></tr>
</tbody>
</table>
<p>The dominant hand is usually up to half a size larger, so a ring that fits your left ring finger may be tight on the right.</p>

<h2>Engagement ring sizing</h2>
<ul>
<li><strong>Thin bands (1.5–2.5 mm),</strong> the usual engagement ring width, should be bought in your exact size.</li>
<li><strong>Solitaires with a tall setting</strong> tip sideways if loose, so they should fit closely. If your knuckle is large, ask about sizing beads or a hinged shank instead of going up a size.</li>
<li><strong>Eternity and half-eternity bands</strong> are hard to resize because stones run around the band. Measure carefully, ideally twice on different days.</li>
<li><strong>Wedding sets</strong> (engagement ring + wedding band worn together) act like one wider ring; some people go up a quarter size for the pair.</li>
</ul>

<h2>When your size changes</h2>
<p>Fingers swell in hot weather, after exercise, after salty food and late in the day, and shrink in the cold. Pregnancy often adds a half to a full size for a few months. If a ring you love only fits sometimes, measure in the evening at room temperature and choose that size. Our guide <a href="/blog/ring-too-tight-or-loose/">how should a ring fit?</a> explains the signs of a ring that is too tight or too loose and the easy fixes.</p>

<h2>Find your size in 30 seconds</h2>
<p>Place a ring that fits on the <a href="/">online ring sizer</a> after calibrating your screen with a bank card, or type a measurement into the <a href="/ring-size-calculator/">ring size calculator</a>. Both show US, UK, EU and Indian sizes at once.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/average-ring-size/">Average ring size for women and men</a></li>
<li><a href="/ring-size-chart/uk/">UK ring size chart</a> and <a href="/ring-size-chart/india/">Indian ring size chart</a></li>
<li><a href="/printable-ring-sizer/">Printable ring sizer</a></li>
<li><a href="/bangle-size-chart/">Bangle size chart</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What is the average ring size for a woman?', 'Most women wear US 6 to 7 (UK L½ to N½, 16.5 to 17.3 mm inner diameter) on the ring finger. The usual range is US 5 to 8.' ),
				array( 'Is ring size 7 big for a woman?', 'No. US 7 (17.3 mm, UK N½, EU 54) is one of the most common women\'s sizes and sits in the middle of the usual range.' ),
				array( 'Is ring size 5 small for a woman?', 'US 5 (15.7 mm, UK J½) is on the smaller side but common for petite hands and for rings worn on the little finger.' ),
				array( 'What size is a women\'s thumb ring?', 'A woman\'s thumb is usually 2 to 3 sizes larger than her ring finger, so most women wear thumb rings between US 8 and 10.' ),
				array( 'Should an engagement ring be tight or loose?', 'It should slide over the knuckle with a little resistance and not spin on the finger. If it slides off easily when your hand is cold, it is too loose.' ),
			),
		),

		/* ------------------------------------------------------- AVERAGE RING SIZE */
		'average-ring' => array(
			'slug'       => 'average-ring-size',
			'title'      => 'Average Ring Size for Women and Men',
			'seo_title'  => 'Average Ring Size for Women and Men (US, UK, EU, India)',
			'seo_desc'   => 'The average ring size is US 6 to 7 for women and US 9 to 10 for men. Averages in UK, EU and Indian sizes, by finger, and how to guess a size secretly.',
			'mode'       => null,
			'menu_order' => 8,
			'content'    => <<<'HTML'
<p><strong>The average ring size for women is US 6 to 7 (UK L½ to N½, 16.5 to 17.3 mm) and for men US 9 to 10 (UK R½ to T½, 19.0 to 19.8 mm).</strong> These are the sizes jewellers sell most often for the ring finger. They are a good starting point for a surprise gift, but every hand is different, so measure if you can: the <a href="/">online ring sizer</a> reads the size of a ring you own in about 30 seconds.</p>

<h2>Average ring size in every system</h2>
<table class="rbs-table">
<thead><tr><th></th><th>US / Canada</th><th>UK / Australia</th><th>EU / ISO</th><th>India / Pakistan</th><th>Inner diameter</th></tr></thead>
<tbody>
<tr><td><strong>Women – average</strong></td><td><a href="/ring-size-in-mm/size-6/">6</a> – <a href="/ring-size-in-mm/size-7/">7</a></td><td>L½ – N½</td><td>52 – 54</td><td>12 – 14</td><td>16.5 – 17.3 mm</td></tr>
<tr><td>Women – usual range</td><td>5 – 8</td><td>J½ – P½</td><td>49 – 57</td><td>9 – 17</td><td>15.7 – 18.1 mm</td></tr>
<tr><td><strong>Men – average</strong></td><td><a href="/ring-size-in-mm/size-9/">9</a> – <a href="/ring-size-in-mm/size-10/">10</a></td><td>R½ – T½</td><td>60 – 62</td><td>20 – 22</td><td>19.0 – 19.8 mm</td></tr>
<tr><td>Men – usual range</td><td>8 – 12</td><td>P½ – X½</td><td>57 – 67</td><td>17 – 27</td><td>18.1 – 21.4 mm</td></tr>
</tbody>
</table>
<p>No official body publishes a national average, so these figures reflect what jewellers and sizing-kit makers commonly report, and they match the sizes stocked in the largest quantities. The full conversion for every size is in the <a href="/ring-size-chart/">ring size chart</a>.</p>

<h2>Average ring size by finger</h2>
<table class="rbs-table">
<thead><tr><th>Finger</th><th>Women (US)</th><th>Men (US)</th></tr></thead>
<tbody>
<tr><td>Thumb</td><td>8 – 10</td><td>11 – 13</td></tr>
<tr><td>Index finger</td><td>6.5 – 8.5</td><td>9.5 – 11.5</td></tr>
<tr><td>Middle finger</td><td>7 – 8.5</td><td>10 – 11.5</td></tr>
<tr><td>Ring finger</td><td>6 – 7</td><td>9 – 10</td></tr>
<tr><td>Little finger</td><td>4 – 5.5</td><td>7 – 8.5</td></tr>
</tbody>
</table>
<p>These are rules of thumb built from the usual gaps between fingers (thumb about 2–3 sizes above the ring finger, little finger about 1½–2 below). Your own fingers may differ by more.</p>

<h2>Average by region</h2>
<ul>
<li><strong>United States and Canada:</strong> women 6–7, men 9–10. This is why shop sample rings are commonly made in these sizes.</li>
<li><strong>United Kingdom and Australia:</strong> women L to N, men R to T – the same physical size range.</li>
<li><strong>India and Pakistan:</strong> women 12–14, men 20–22 on the local number scale (see the <a href="/ring-size-chart/india/">Indian</a> and <a href="/ring-size-chart/pakistan/">Pakistan</a> charts).</li>
<li><strong>Europe:</strong> women 52–54, men 60–62 (inner circumference in mm).</li>
</ul>
<p>Average body size varies between countries, but the published charts of large jewellers in these regions overlap almost completely, so the same physical range applies.</p>

<h2>Why averages are only a starting point</h2>
<p>Two people of the same height can be three sizes apart. Ring size depends on bone structure, knuckle size, body weight, hand use (manual work tends to enlarge fingers) and even the time of day: fingers are smaller in the morning and in the cold, and larger in the evening, in hot weather and during pregnancy. A ring bought in the "average" size fits roughly half the people who receive it. If a ring is a gift, choose a jeweller that offers free resizing, and avoid materials that cannot be resized, such as tungsten or ceramic.</p>

<h2>How to find someone's ring size secretly</h2>
<ol>
<li><strong>Borrow a ring they wear on the right finger.</strong> Place it on the <a href="/">online ring sizer</a> for half a minute and put it back. This is by far the most reliable method.</li>
<li><strong>Use a ring from another finger and adjust.</strong> A ring from the right-hand ring finger is usually about the same or up to half a size larger than the left. A ring from the middle finger is usually about one size too big for the ring finger; go down one size.</li>
<li><strong>Trace the inside of a ring</strong> on paper with a sharp pencil, then measure the inner edge of the circle in mm and use <a href="/ring-size-by-diameter/">ring size by diameter</a>.</li>
<li><strong>Ask a friend or family member</strong> who knows their size or can try on rings with them.</li>
<li><strong>When nothing else works,</strong> buy the upper end of the average (US 7 for women, US 10 for men) from a jeweller with free resizing. Making a ring smaller is easier and cheaper than making it larger.</li>
</ol>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/womens/">Women's ring size chart</a> and <a href="/ring-size-chart/mens/">men's ring size chart</a></li>
<li><a href="/how-to-measure-ring-size-at-home/">How to measure ring size at home</a></li>
<li><a href="/blog/ring-too-tight-or-loose/">How should a ring fit?</a></li>
<li><a href="/blog/resize-a-ring/">Can you resize a ring?</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What is the average ring size for a woman?', 'US 6 to 7, which is UK L½ to N½, EU 52 to 54 and 16.5 to 17.3 mm inner diameter.' ),
				array( 'What is the average ring size for a man?', 'US 9 to 10, which is UK R½ to T½, EU 60 to 62 and 19.0 to 19.8 mm inner diameter.' ),
				array( 'What ring size should I buy if I do not know her size?', 'US 7 (UK N½, 17.3 mm) covers the upper end of the women\'s average and is easier to make smaller than larger. Choose a jeweller with free resizing.' ),
				array( 'Is your ring size the same on both hands?', 'Often not. The dominant hand is commonly up to half a size larger, so measure the hand the ring will be worn on.' ),
				array( 'Does ring size change with age?', 'Yes. Fingers often get larger with age, weight gain and arthritis, and the knuckles in particular can grow. Recheck your size every few years.' ),
			),
		),

		/* -------------------------------------------------------------- GUIDES HUB */
		'blog' => array(
			'slug'       => 'blog',
			'title'      => 'Ring and Bangle Sizing Guides',
			'seo_title'  => 'Ring and Bangle Sizing Guides – Fit, Resizing, Bridal Sizes',
			'seo_desc'   => 'Practical guides on ring fit, ring resizing and bridal bangle sizes, from the team behind the free on-screen ring and bangle sizer.',
			'mode'       => null,
			'menu_order' => 40,
			'content'    => <<<'HTML'
<p><strong>Our guides answer the questions that come after you know your size:</strong> how a ring should feel, what to do when it does not fit, and how to choose bangles for a wedding. Each guide is written by the <a href="/about/">Ring Bangle Sizer</a> team and uses the same size data as our tools.</p>

<h2>Ring guides</h2>
<ul>
<li><strong><a href="/blog/ring-too-tight-or-loose/">How should a ring fit? Too tight vs too loose</a></strong> – the knuckle test, signs of a bad fit, and quick fixes such as sizing beads and ring guards.</li>
<li><strong><a href="/blog/resize-a-ring/">Can you resize a ring?</a></strong> – how far a ring can go up or down, which metals cannot be resized, and what affects the cost.</li>
<li><strong><a href="/blog/find-ring-size-secretly/">How to find out someone's ring size secretly</a></strong> – eight ways to get a size for a surprise proposal or gift, plus bangles.</li>
</ul>

<h2>Bangle guides</h2>
<ul>
<li><strong><a href="/blog/bangle-size-for-wedding/">Bridal bangle size guide</a></strong> – choosing the size for a chooda, glass bangles and gold kangan, and how to measure a bride's hand.</li>
</ul>

<h2>Size charts and tools</h2>
<p>Looking for a number rather than advice? Start here:</p>
<ul>
<li><a href="/">Online ring sizer</a> – measure a ring on your phone screen</li>
<li><a href="/bangle-size-calculator/">Bangle size calculator</a> and <a href="/bangle-size-chart/">bangle size chart</a></li>
<li><a href="/ring-size-chart/">Ring size chart</a>, with <a href="/ring-size-chart/us/">US</a>, <a href="/ring-size-chart/uk/">UK</a>, <a href="/ring-size-chart/india/">India</a>, <a href="/ring-size-chart/mens/">men's</a> and <a href="/ring-size-chart/womens/">women's</a> versions</li>
<li><a href="/average-ring-size/">Average ring size</a></li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a></li>
</ul>

<h2>How we write these guides</h2>
<p>Every size and measurement on this site comes from the published standards described on our <a href="/how-we-measure/">how we measure</a> page (ISO 8653 for rings, the Indian inch-and-sixteenths system for bangles). Practical advice is checked against jewellers' published sizing guidance, and we update a guide when we find a better source or a reader reports a mistake. Spotted something? <a href="/contact/">Tell us</a>.</p>
HTML
			,
			'faq' => array(),
		),

		/* ------------------------------------------------------- GUIDE: RING FIT */
		'blog-ring-fit' => array(
			'slug'       => 'ring-too-tight-or-loose',
			'parent'     => 'blog',
			'title'      => 'How Should a Ring Fit? Signs It Is Too Tight or Too Loose',
			'seo_title'  => 'How Should a Ring Fit? Too Tight vs Too Loose (and Fixes)',
			'seo_desc'   => 'A ring should slide over the knuckle with slight resistance and not spin. Learn the signs of a ring that is too tight or too loose and the easy fixes.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => <<<'HTML'
<p><strong>A ring that fits well slides over your knuckle with a little resistance, sits at the base of the finger without spinning, and comes off with a gentle twist.</strong> If it leaves a deep mark or will not pass the knuckle, it is too tight; if it spins, slides off when your hands are cold or moves up the finger, it is too loose. The fix is usually a half size either way. Check your size on the <a href="/">online ring sizer</a> before you resize anything.</p>

<h2>30-second fit quiz</h2>
<p>Answer five quick questions about the ring you are wearing and see whether it is too tight, too loose or just right.</p>
[rbs_fit_quiz]

<h2>The three-point fit test</h2>
<ol>
<li><strong>On:</strong> the ring should need a small push to get over the knuckle. If it drops on with no resistance, it will probably fall off.</li>
<li><strong>Worn:</strong> at the base of the finger it should not spin freely when you shake your hand, but you should be able to turn it with your other hand.</li>
<li><strong>Off:</strong> it should come off with a twist and a light pull. If you need soap, it is too tight.</li>
</ol>
<p>Do the test at normal room temperature, late in the day. In the morning and in cold weather fingers are smaller; after exercise, in the heat and after a salty meal they are larger.</p>

<h2>Signs a ring is too tight</h2>
<ul>
<li>It leaves a deep red ring or a dent that stays for more than a few minutes.</li>
<li>The skin bulges on either side of the band.</li>
<li>Your finger feels numb, tingly or throbs, or looks darker than the others.</li>
<li>You cannot get it over the knuckle without soap or oil.</li>
<li>It itches underneath (trapped moisture under a tight band can irritate the skin).</li>
</ul>
<p>If a ring is stuck and the finger is swelling, painful or changing colour, do not wait: a doctor, an emergency department or a jeweller can cut the ring off safely, and the ring can usually be repaired afterwards.</p>

<h3>How to remove a tight ring</h3>
<ol>
<li>Hold your hand above your head for a minute or two to let the swelling go down. Cold water helps too.</li>
<li>Apply soap, hand cream or a little oil to the finger.</li>
<li>Twist the ring slowly as you pull, rather than pulling straight.</li>
<li>For a stubborn ring, the floss method works: slide dental floss under the ring, wrap the rest tightly around the finger above it towards the tip, then unwind from the end under the ring so the ring moves along the wrapped floss.</li>
</ol>

<h2>Signs a ring is too loose</h2>
<ul>
<li>It spins so the stone ends up on the palm side.</li>
<li>It slides up to the knuckle when your hand hangs down.</li>
<li>It slips off with cold hands, in water or when you take off gloves.</li>
<li>There is a visible gap between band and finger.</li>
</ul>
<p>A loose ring with a stone is more than an annoyance: it knocks against things and is easy to lose in the sink or at the beach.</p>

<h2>Fixes, from cheapest to permanent</h2>
<table class="rbs-table">
<thead><tr><th>Problem</th><th>Fix</th><th>Notes</th></tr></thead>
<tbody>
<tr><td>Slightly loose</td><td>Clear silicone ring guard or adjuster</td><td>Cheap, removable, good for seasonal changes</td></tr>
<tr><td>Loose, spins (big knuckle, thin finger base)</td><td>Sizing beads or a sizing bar soldered inside</td><td>Keeps the ring upright and still passes the knuckle</td></tr>
<tr><td>Size changes a lot (pregnancy, arthritis)</td><td>Hinged or expandable shank</td><td>Opens to pass the knuckle, closes snugly</td></tr>
<tr><td>Too tight by up to ½ size</td><td>Stretching on a mandrel</td><td>Only for plain bands of soft metal</td></tr>
<tr><td>Too tight or loose by ½–2 sizes</td><td>Resizing by a jeweller</td><td>Metal added or removed and soldered; see <a href="/blog/resize-a-ring/">can you resize a ring?</a></td></tr>
<tr><td>Wrong by more than 2 sizes, or cannot be resized</td><td>Exchange or remake</td><td>Tungsten, titanium, ceramic, full eternity bands</td></tr>
</tbody>
</table>

<h2>Fit depends on the ring</h2>
<ul>
<li><strong>Wide bands</strong> (6 mm and more) feel tighter than thin bands in the same size; most people need a quarter to half size more.</li>
<li><strong>Comfort-fit bands</strong> have a rounded inside and feel looser, so they can sometimes be a quarter size smaller.</li>
<li><strong>Top-heavy rings</strong> (large stones, signets) need a closer fit, or they roll to one side.</li>
<li><strong>Stacked rings</strong> behave like one wide band.</li>
<li><strong>Midi and knuckle rings</strong> are worn above a joint and should be snug, because nothing stops them sliding.</li>
</ul>

<h2>Big knuckle, thin finger?</h2>
<p>This is the most common fitting problem. A ring big enough to pass the knuckle spins at the base. The answer is not to buy a size in between, but to choose the size that passes the knuckle and then add sizing beads, a sizing bar or a guard, or to choose a hinged shank. Measure both places with a paper strip and compare them in the <a href="/ring-size-by-circumference/">ring size by circumference</a> table: if they are more than a size apart, plan for one of these fixes.</p>

<h2>Check your size before you resize</h2>
<p>Before paying for a resize, confirm the size you need. Put the ring that fits well (or a ring from the same finger) on the <a href="/">online ring sizer</a>, or measure the finger with a strip and use the <a href="/ring-size-calculator/">ring size calculator</a>. If you are between sizes, take the larger one for a wide band and the smaller one for a thin band.</p>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/blog/resize-a-ring/">Can you resize a ring?</a></li>
<li><a href="/average-ring-size/">Average ring size</a></li>
<li><a href="/ring-size-chart/">Ring size chart</a></li>
<li><a href="/how-to-measure-ring-size-at-home/">How to measure ring size at home</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'How tight should a ring be?', 'Tight enough that it needs a small push over the knuckle and does not spin on its own, but loose enough to turn with your other hand and come off with a twist.' ),
				array( 'Should a ring be loose or tight on the knuckle?', 'Slightly snug on the knuckle. The knuckle is what keeps the ring on, so it should resist a little as it passes.' ),
				array( 'Is it better to size up or down for a ring?', 'If you are truly between sizes, size up for wide bands and rings you wear all day, and size down for thin bands that tend to spin. A slightly loose ring can be fixed with sizing beads or a guard.' ),
				array( 'Why is my ring tight in summer and loose in winter?', 'Heat and humidity make the fingers swell; cold makes the blood vessels contract and the fingers shrink. A half-size change between seasons is normal.' ),
				array( 'Can a ring that is too tight be dangerous?', 'Yes, if the finger swells and the ring cuts off circulation. If a stuck ring causes pain, numbness or colour change, get it cut off by a doctor or jeweller.' ),
			),
		),

		/* ---------------------------------------------------- GUIDE: BRIDAL BANGLES */
		'blog-bridal-bangle' => array(
			'slug'       => 'bangle-size-for-wedding',
			'parent'     => 'blog',
			'title'      => 'Bridal Bangle Size Guide: Chooda, Glass and Gold Bangles',
			'seo_title'  => 'Bridal Bangle Size Guide: Chooda, Glass and Gold Bangles',
			'seo_desc'   => 'How to choose bridal bangle sizes for a chooda, glass and gold bangles: measure the bride\'s hand, pick 2.4, 2.6 or 2.8 and avoid common mistakes.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => <<<'HTML'
<p><strong>A bride needs the bangle size that just clears her hand with the thumb folded in, which for most adult women is 2.4 or 2.6 (57.2 or 60.3 mm inside).</strong> Measure the hand at its widest point, not the wrist: a hand that is 18 cm around needs at least a 2.6. For a chooda or glass set, choose that exact size; for gold bangles with a screw or hinge you can choose one size smaller for a closer fit. The <a href="/bangle-size-calculator/">bangle size calculator</a> does the maths, or matches a bangle she already owns on your phone screen.</p>

<h2>Step 1: measure the bride's hand</h2>
<ol>
<li>Ask her to fold the thumb into the palm, as if putting on a bangle, and bring the little finger towards it.</li>
<li>Wrap a soft tape or a strip of paper around the widest part of the hand, across the knuckles.</li>
<li>Read the length in cm or inches and find it in the table below, or type it into the <a href="/bangle-size-calculator/">bangle size calculator</a>.</li>
</ol>
<table class="rbs-table">
<thead><tr><th>Hand circumference (thumb folded)</th><th>Bangle size</th><th>Inner diameter</th></tr></thead>
<tbody>
<tr><td>16.0 – 17.0 cm (6.3 – 6.7 in)</td><td><a href="/bangle-size/2-2/">2.2</a></td><td>54.0 mm</td></tr>
<tr><td>17.0 – 18.0 cm (6.7 – 7.1 in)</td><td><a href="/bangle-size/2-4/">2.4</a></td><td>57.2 mm</td></tr>
<tr><td>18.0 – 18.9 cm (7.1 – 7.5 in)</td><td><a href="/bangle-size/2-6/">2.6</a></td><td>60.3 mm</td></tr>
<tr><td>18.9 – 19.9 cm (7.5 – 7.9 in)</td><td><a href="/bangle-size/2-8/">2.8</a></td><td>63.5 mm</td></tr>
<tr><td>19.9 – 21.0 cm (7.9 – 8.2 in)</td><td><a href="/bangle-size/2-10/">2.10</a></td><td>66.7 mm</td></tr>
</tbody>
</table>
<p>The fastest check is a bangle she already wears comfortably: place it on the calibrated screen of the <a href="/bangle-size-calculator/">bangle sizer</a> and read the size. Bridal bangles of 2.6 and up are often wider than a phone screen; then use <strong>From a photo</strong> in the same sizer (photograph the bangle flat next to a ₹10, Rs 10 or other listed coin). Bride in another city? Send her an ask link from the sizer on WhatsApp: she measures on her own phone and sends the size back. Ask her family discreetly if it is a surprise.</p>

<h2>Step 2: choose the size for each type of bangle</h2>
<table class="rbs-table">
<thead><tr><th>Bangle type</th><th>Opens?</th><th>Which size</th></tr></thead>
<tbody>
<tr><td>Chooda (Punjabi bridal set, red and ivory)</td><td>No</td><td>Her measured size; it must pass the hand</td></tr>
<tr><td>Glass bangles (green, red, kaanch)</td><td>No</td><td>Her measured size; never smaller, glass cannot stretch</td></tr>
<tr><td>Shakha pola (Bengali, conch and coral)</td><td>No</td><td>Her measured size</td></tr>
<tr><td>Lac / lakh bangles (Rajasthan)</td><td>No</td><td>Her measured size; lac can soften in heat, so avoid a tight fit</td></tr>
<tr><td>Gold or silver bangles with screw or hinge (kada, kangan)</td><td>Yes</td><td>Same size or one smaller for a closer fit at the wrist</td></tr>
<tr><td>Solid gold bangles</td><td>No</td><td>Her measured size</td></tr>
<tr><td>Kaleere / kalire (hang from the bangles)</td><td>–</td><td>No size; tied to the chooda or a bangle</td></tr>
</tbody>
</table>

<h2>Chooda size: what to know</h2>
<p>A traditional chooda is a set of matching bangles worn on both forearms from the wedding day, often for weeks or months. Because the whole stack has to pass over the hand at once, family members usually help the bride put it on during the chooda ceremony, using a little oil or a thin plastic bag over the hand. That is why a chooda is bought in the bride's normal bangle size, not one size up "to be safe": a loose chooda slides down and knocks against the hand. If she is between two sizes, choose the larger one only if the smaller one does not pass her hand at all.</p>
<p>Do not buy a rigid glass or lac chooda one size smaller to make it sit higher on the forearm. It still has to pass over the hand, and a set that is too small can crack while being rolled on or hurt her hand. Only an openable gold kangan with a screw or hinge can be one size smaller.</p>

<h2>Common mistakes</h2>
<ul>
<li><strong>Measuring the wrist.</strong> Bracelets are sized by the wrist; bangles by the hand. A 6 in wrist can still need a 2.6 bangle.</li>
<li><strong>Buying by age or dress size.</strong> Hand size does not follow either. Always measure.</li>
<li><strong>Ordering every set in one size.</strong> Glass and chooda bangles need the hand size; screw-open gold kangan can be smaller.</li>
<li><strong>Measuring on a cold day for a summer wedding.</strong> Hands swell in the heat, after mehndi and during long ceremonies. Measure in the evening at a normal temperature.</li>
<li><strong>Confusing 2.10 with 2.1.</strong> Indian bangle sizes count sixteenths of an inch, so 2.10 (2 10/16 in) is larger than 2.8, not smaller. See the <a href="/bangle-size-chart/">bangle size chart</a>.</li>
</ul>

<h2>Bangles for the bridal party</h2>
<p>Mothers, sisters and friends often wear matching sets. Collect everyone's size before ordering: send each of them an ask link from the <a href="/bangle-size-calculator/">bangle size calculator</a> on WhatsApp and their sizes come back to you, or save them in the sizer under each name; most adult women fall between 2.2 and 2.8. Girls under 12 need children's sizes from the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>. Men wearing a kada at the wedding usually need 2.10 to 2.14; the <a href="/chudi-size-chart/">chudi and kada size chart</a> has the details.</p>

<h2>Buying online from abroad</h2>
<p>Shops outside India and Pakistan may list bangles by inner diameter in mm or inches, or as S / M / L. Convert using the inner diameter: 2.4 is 57.2 mm (2¼ in), 2.6 is 60.3 mm (2⅜ in) and 2.8 is 63.5 mm (2½ in). Our <a href="/bangle-size-chart/in-cm/">bangle size in cm</a> page lists every size.</p>

[rbs_cta mode="bangle"]

<h2>Related</h2>
<ul>
<li><a href="/bangle-size-chart/india/">Bangle size chart India</a></li>
<li><a href="/how-to-measure-bangle-size/">How to measure bangle size</a></li>
<li><a href="/ring-size-chart/india/">Indian ring size chart</a> (for the engagement ring)</li>
<li><a href="/blog/">All sizing guides</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'What bangle size do most brides wear?', 'Most adult women wear 2.4 or 2.6 (57.2 or 60.3 mm inner diameter). Measure the hand with the thumb folded in to be sure.' ),
				array( 'Should a chooda be loose or tight?', 'It should pass over the hand with help and sit on the forearm without sliding down to the wrist. Buy the bride\'s normal bangle size, not a size up.' ),
				array( 'What is chooda size 2.6 in cm?', 'Size 2.6 has an inner diameter of 2⅜ inches, which is 6.03 cm (60.3 mm). It fits a hand circumference of about 18.0 to 18.9 cm.' ),
				array( 'How do I measure bangle size for a wedding at home?', 'Fold the thumb into the palm, wrap a tape around the widest part of the hand, and use the bangle size calculator, or match a bangle she already wears on a calibrated phone screen.' ),
				array( 'Can bridal bangles be one size smaller?', 'Only bangles that open, such as gold kangan with a screw or hinge. Glass bangles and chooda must pass over the hand, so they need the full size.' ),
			),
		),

		/* -------------------------------------------------------- GUIDE: RESIZING */
		'blog-resize' => array(
			'slug'       => 'resize-a-ring',
			'parent'     => 'blog',
			'title'      => 'Can You Resize a Ring? Limits, Metals and Cost',
			'seo_title'  => 'Can You Resize a Ring? How Much, Which Metals, What It Costs',
			'seo_desc'   => 'Most gold, silver and platinum rings can be resized up or down about two sizes. Which rings cannot be resized, how it is done and what affects the cost.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => <<<'HTML'
<p><strong>Yes, most rings made of gold, silver or platinum can be resized, usually by up to two sizes up or down.</strong> Rings made of tungsten, titanium, ceramic, stainless steel or carbon fibre generally cannot, and eternity bands, tension settings and some patterned bands are difficult. Before you book a resize, confirm the size you need with the <a href="/">online ring sizer</a>: a resize in the wrong direction is an expensive mistake.</p>

<h2>How rings are resized</h2>
<ul>
<li><strong>Sizing down:</strong> the jeweller cuts a small piece out of the bottom of the band (the shank), closes the gap, solders it and polishes it. This is the simplest job.</li>
<li><strong>Sizing up by a little (up to about half a size):</strong> a plain band can be stretched on a steel mandrel. This thins the band slightly, so it is not suitable for thin or patterned rings.</li>
<li><strong>Sizing up by more:</strong> the shank is cut and a piece of matching metal is soldered in. A good jeweller makes the join almost invisible.</li>
<li><strong>Replacing the shank:</strong> for big changes (more than about two sizes) or worn-thin bands, the whole lower part of the band is replaced.</li>
</ul>

<h2>How much can a ring be resized?</h2>
<p>As a rule, a ring can go up or down about two US sizes (one UK letter equals about half a US size). Beyond that the shape of the ring changes: the head with the stone looks out of proportion, the setting can be strained, and the band may need to be replaced. Each size is about 0.8 mm of diameter or 2.5 mm of circumference; see the <a href="/ring-size-chart/us/">US ring size chart</a> for exact numbers.</p>

<h2>Which rings can and cannot be resized</h2>
<table class="rbs-table">
<thead><tr><th>Ring</th><th>Resizable?</th><th>Notes</th></tr></thead>
<tbody>
<tr><td>Yellow or rose gold</td><td>Yes</td><td>The easiest metal to resize</td></tr>
<tr><td>White gold</td><td>Yes</td><td>Needs re-plating with rhodium afterwards</td></tr>
<tr><td>Sterling silver</td><td>Yes</td><td>Cheap ring may cost less to replace than to resize</td></tr>
<tr><td>Platinum</td><td>Yes</td><td>Needs a jeweller who works platinum (higher melting point)</td></tr>
<tr><td>Gold-plated or vermeil</td><td>Sometimes</td><td>The plating at the join has to be redone</td></tr>
<tr><td>Half-eternity band</td><td>A little</td><td>Only through the plain lower half</td></tr>
<tr><td>Full eternity band</td><td>Rarely</td><td>Stones all around; usually remade in the new size</td></tr>
<tr><td>Tension-set ring</td><td>No (usually)</td><td>The band's spring holds the stone</td></tr>
<tr><td>Tungsten carbide, ceramic</td><td>No</td><td>Too hard to cut and solder; exchange only</td></tr>
<tr><td>Titanium, stainless steel, cobalt</td><td>Rarely</td><td>Specialists only; most makers exchange instead</td></tr>
<tr><td>Wood, carbon fibre, silicone</td><td>No</td><td>Replace</td></tr>
<tr><td>Engraved or patterned band</td><td>With care</td><td>The pattern or engraving can be distorted; ask first</td></tr>
</tbody>
</table>

<h2>What affects the cost</h2>
<p>Prices vary by country and jeweller, so ask for a quote, but these are the factors that move it:</p>
<ul>
<li><strong>Direction:</strong> sizing down is cheaper than sizing up, because up means adding metal.</li>
<li><strong>Metal:</strong> silver costs least, gold more, platinum the most (harder to work and more expensive metal).</li>
<li><strong>Number of sizes:</strong> each extra size adds metal and work.</li>
<li><strong>Stones:</strong> rings with stones near the shank may need stones removed and reset, or protected from heat.</li>
<li><strong>Finish:</strong> white gold needs rhodium plating; textured or two-tone bands need extra finishing.</li>
</ul>
<p>Many jewellers include one free resize with a new engagement or wedding ring, often within the first 30 to 60 days. In India and Pakistan, local jewellers usually adjust gold rings by a size or two at little or no cost when you bought the ring from them.</p>

<h2>How long does it take?</h2>
<p>A simple size-down in gold or silver can be done the same day in some shops; most jewellers ask for a few days to a week. Platinum, rings with many stones, and shank replacements take longer. Plan ahead before an engagement or wedding.</p>

<h2>Alternatives to resizing</h2>
<ul>
<li><strong>Ring guards and silicone adjusters</strong> for a slightly loose ring, especially if your size changes with the seasons.</li>
<li><strong>Sizing beads or a sizing bar</strong> inside the band, for a big knuckle and a thin finger base.</li>
<li><strong>A hinged shank</strong> for fingers whose size changes a lot, for example with arthritis.</li>
<li><strong>Wearing it on another finger.</strong> If the ring is a half size too small for the ring finger, it may fit the little finger of the other hand.</li>
</ul>
<p>Our guide <a href="/blog/ring-too-tight-or-loose/">how should a ring fit?</a> explains how to tell whether you need a resize at all.</p>

<h2>Measure before you resize</h2>
<ol>
<li>Wear the ring for a day at normal temperature and decide if it is truly too small or large.</li>
<li>Measure the finger, or a ring that fits that finger well, with the <a href="/">online ring sizer</a> or the <a href="/ring-size-calculator/">ring size calculator</a>.</li>
<li>Tell the jeweller the target size, not "a bit bigger". They can check it on their own sizer.</li>
</ol>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/ring-size-chart/mens/">Men's ring size chart</a> (many men's bands cannot be resized)</li>
<li><a href="/ring-size-chart/womens/">Women's ring size chart</a></li>
<li><a href="/ring-size-converter/">Ring size converter</a></li>
<li><a href="/blog/">All sizing guides</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'Can every ring be resized?', 'No. Most gold, silver and platinum rings can, but tungsten, ceramic, wood and carbon fibre rings cannot, and eternity bands and tension settings are difficult or impossible.' ),
				array( 'How many sizes can a ring be resized?', 'Usually up to about two US sizes up or down. Larger changes often need a new shank or a new ring.' ),
				array( 'Does resizing a ring damage it?', 'A good jeweller leaves an almost invisible join. Stretching thins the band slightly, and engraving or patterns near the join can be distorted.' ),
				array( 'Is it cheaper to size a ring up or down?', 'Down. Sizing down removes metal; sizing up usually adds metal, which costs more, especially in gold or platinum.' ),
				array( 'Can a tungsten ring be resized?', 'No. Tungsten carbide is too hard to cut and solder. Most brands offer an exchange for a different size instead.' ),
			),
		),

		/* --------------------------------------------- GUIDE: SURPRISE / GIFT SIZE */
		'blog-gift-size' => array(
			'slug'       => 'find-ring-size-secretly',
			'parent'     => 'blog',
			'title'      => 'How to Find Out Someone\'s Ring Size Secretly (and Their Bangle Size)',
			'seo_title'  => 'Find Someone\'s Ring Size Secretly: 8 Ways That Work',
			'seo_desc'   => 'Planning a surprise proposal or gift? 8 ways to find someone\'s ring or bangle size without asking: borrow a ring, trace it, ask a friend.',
			'mode'       => null,
			'menu_order' => 4,
			'content'    => <<<'HTML'
<p><strong>The most reliable way to find someone's ring size without asking is to borrow a ring they already wear on the same finger and measure its inside diameter</strong>, either on your phone with the <a href="/">online ring sizer</a> or with a ruler. It takes two minutes and the ring is back before it is missed. If you cannot borrow one, trace it, ask a friend, or use the averages below and buy from a shop that resizes for free.</p>

<h2>1. Borrow a ring they wear (best)</h2>
<ol>
<li>Pick a ring they wear on the <strong>same finger of the same hand</strong> the new ring is for. A ring from another finger still helps; see the conversion table below.</li>
<li>Lay it flat on your phone and open the <a href="/">ring sizer</a>. Calibrate once with your own bank card or a coin.</li>
<li>Move the circle until it lines up with the <em>inside</em> edge of the ring. Note the size and the diameter in mm.</li>
<li>Put the ring back exactly where it was.</li>
</ol>
[rbs_diagram name="ring-inner"]
<p>No phone time alone? Measure across the inside of the ring with a mm ruler, twice at right angles, and look the number up in <a href="/ring-size-by-diameter/">ring size by diameter</a>. Even a quick photo of the ring lying next to a coin helps: a jeweller can estimate the size from it.</p>

<h2>2. Trace or press the ring</h2>
<p>If you only have the ring for a few seconds:</p>
<ul>
<li><strong>Trace the inside:</strong> put the ring on paper and run a sharp pencil around the <em>inside</em> edge. Measure the circle across its widest point.</li>
<li><strong>Press it into soap or a bar of chocolate:</strong> the impression keeps the exact inner size. Wipe the ring clean and measure the hollow later.</li>
<li><strong>Slide it on your own finger:</strong> mark with a pen how far it goes. Later, find a ring of yours (or a sizer) that stops at the same point.</li>
</ul>

<h2>3. Ring from another finger? Convert it</h2>
<table class="rbs-table">
<thead><tr><th>The ring you borrowed is from their…</th><th>Their ring-finger size is usually…</th></tr></thead>
<tbody>
<tr><td>Middle finger, same hand</td><td>about ½ size smaller</td></tr>
<tr><td>Index finger, same hand</td><td>about the same, or ½ size smaller</td></tr>
<tr><td>Little finger (pinky)</td><td>1½ to 2 sizes larger</td></tr>
<tr><td>Thumb</td><td>2 to 3 sizes smaller</td></tr>
<tr><td>Ring finger, other hand</td><td>¼ to ½ size larger if the new ring goes on the dominant hand</td></tr>
</tbody>
</table>
<p>These are typical differences, not rules. Treat the result as a starting point and buy where resizing is easy.</p>

<h2>4. Ask a friend or family member</h2>
<p>Their best friend, sister or mother may know the size, or can find out naturally: trying on rings together in a shop, or "I'm ordering a ring online, what size are you?". Ask them to keep it quiet, and ask for the system too (US 6 and UK 6 are not the same size; see the <a href="/ring-size-converter/">ring size converter</a>).</p>
<p>If it does not have to be a surprise (a birthday gift, a ring for a parent, or bangles for a sister abroad), just ask: open the <a href="/">ring sizer</a> or <a href="/bangle-size-calculator/">bangle sizer</a>, tap <strong>Buying for someone else?</strong> and send the link on WhatsApp. They measure on their own phone and send their size straight back to you.</p>

<h2>5. Look for clues</h2>
<ul>
<li>Old jewellery boxes, receipts or order e-mails often show the size.</li>
<li>Rings bought online usually list the size in the order history.</li>
<li>A ring that was resized may have the size stamped inside, next to the metal mark.</li>
</ul>

<h2>6. Make it part of a game</h2>
<p>Ring-pop sweets, a "guess your ring size" quiz, trying on costume rings at a market, or a printable sizer left in a magazine can all get a size without suspicion. Write it down straight away.</p>

<h2>7. Measure while they sleep (risky)</h2>
<p>Some people wrap a thin strip of paper around the finger while their partner sleeps. It works only if they are deep sleepers, and a sleeping finger is relaxed and slightly swollen, so the result is often a quarter size too large. Use it as a rough check, not the final number.</p>

<h2>8. If you have to guess</h2>
<p>Use the averages and choose a shop with free resizing. Most women wear US 5 to 8 (6 to 7 is most common, 16.5 to 17.3 mm) and most men US 8 to 12 (9 to 10 is most common, 19 to 19.8 mm). Look at their hands: slim fingers are usually at the low end, larger hands and prominent knuckles at the high end. See <a href="/average-ring-size/">average ring size</a> for the full breakdown by country.</p>
<p><strong>When in doubt, size up.</strong> A ring that is slightly big can be worn on the middle finger until it is resized, and making a ring smaller is easier and cheaper than making it larger. Avoid guessing for rings that are hard to resize: full eternity bands, tungsten, titanium and ceramic.</p>

<h2>Buying bangles as a surprise</h2>
<p>Bangles have no clasp, so the size has to pass over the hand. Guessing is riskier than with rings.</p>
<ol>
<li><strong>Borrow a bangle she wears</strong> and measure across the inside edge in mm, or lay it on the <a href="/bangle-size-calculator/">bangle size calculator</a>. 57 mm is size 2.4, 60 mm is 2.6, 63.5 mm is 2.8. Only a minute with it? Take a quick photo of it flat next to a coin and measure it later with <strong>From a photo</strong>.</li>
<li><strong>Glass and metal differ:</strong> if the borrowed bangle is glass, a metal or gold one in the same number may feel slightly larger. Match the material if you can.</li>
<li><strong>Ask her mother or sister.</strong> Bangle sizes are often shared in the family, especially for weddings.</li>
<li><strong>If you must guess:</strong> 2.4 and 2.6 are the most common adult women's sizes. Between two sizes, choose the larger one: a slightly loose bangle can be worn, a small one cannot be put on.</li>
</ol>
<p>For a bride, see the <a href="/blog/bangle-size-for-wedding/">bridal bangle size guide</a>.</p>

<h2>Once you have a number</h2>
<ul>
<li>Check it in the <a href="/ring-size-chart/">ring size chart</a> or <a href="/bangle-size-chart/">bangle size chart</a> and convert it to the system the shop uses.</li>
<li>Save it on your phone in the sizer as "Partner" or "Ammi", with the finger it is for. It stays on your device only, and you can download it as a size card.</li>
<li>Check the shop's size before you pay: type it into <strong>Will it fit?</strong> under the result (for example UK N or EU 54) to see if it matches.</li>
<li>Ask the shop about free resizing or exchange before you pay.</li>
</ul>

[rbs_cta mode="ring"]

<h2>Related</h2>
<ul>
<li><a href="/average-ring-size/">Average ring size</a></li>
<li><a href="/blog/ring-too-tight-or-loose/">How should a ring fit?</a></li>
<li><a href="/blog/resize-a-ring/">Can you resize a ring?</a></li>
<li><a href="/how-to-measure-ring-size-at-home/">How to measure ring size at home</a></li>
</ul>
HTML
			,
			'faq' => array(
				array( 'How can I find out my girlfriend\'s ring size without her knowing?', 'Borrow a ring she wears on the same finger and measure its inside diameter on your phone with an on-screen ring sizer or with a ruler. If you cannot borrow one, ask a close friend or family member, or trace the inside of a ring on paper.' ),
				array( 'What if the ring I borrowed is from a different finger?', 'Adjust it: the ring finger is usually about half a size smaller than the middle finger on the same hand, and 1½ to 2 sizes larger than the little finger. The dominant hand is often a quarter to half size larger.' ),
				array( 'Should I size up or down if I am not sure?', 'Size up. A slightly loose ring can be worn on another finger until it is resized, and making a ring smaller is easier and cheaper than making it larger.' ),
				array( 'What is the most common ring size for a woman?', 'US 6 to 7 (UK L½ to N½, about 16.5 to 17.3 mm inner diameter). Most women wear between US 5 and 8.' ),
				array( 'Can a jeweller tell the ring size from a photo?', 'Roughly, if the ring is photographed flat next to a coin or ruler so the jeweller can scale it. A direct measurement of the inside diameter is more accurate.' ),
			),
		),

		/* -------------------------------------------------------------- WIDGET */
		'widget' => array(
			'slug'       => 'ring-sizer-widget',
			'title'      => 'Free Ring Sizer Widget for Your Website',
			'seo_title'  => 'Free Ring Sizer Widget – Embed a Ring & Bangle Sizer',
			'seo_desc'   => 'Add a free on-screen ring, bangle or bracelet sizer to your jewellery shop or blog with one line of code. No sign-up, no cookies, works on mobile.',
			'mode'       => null,
			'menu_order' => 45,
			'content'    => <<<'HTML'
<p><strong>Put our on-screen ring sizer on your own website for free.</strong> Copy one line of code, paste it into your product page, blog post or size guide, and your visitors can measure a ring, bangle or bracelet without leaving your site. No account, no API key and no cookies. Jewellery shops use it to cut down on wrong-size orders and returns.</p>

<h2>What your visitors get</h2>
<ul>
<li>Screen calibration with a bank card, or a coin when no card is at hand, so circles show at true size on any phone, tablet or laptop.</li>
<li>Ring sizes in US, UK, EU, Indian and mm, with "match a ring" and "type a measurement" methods.</li>
<li>Indian bangle sizes (baby 1.10 to men's kada 3.4) from a bangle on screen, a photo of the bangle next to a coin, or a hand measurement.</li>
<li>A <strong>Will it fit?</strong> check that compares the size your shop lists with the visitor's measured size.</li>
<li>Saved sizes per person and finger, a downloadable size card, and a WhatsApp link to ask someone else for their size.</li>
<li>Bracelet lengths from a wrist measurement.</li>
<li>A light page (one small script, no frameworks) that works on mobile.</li>
</ul>

<h2>Embed code</h2>
<p>Pick the tool you need and paste the code where it should appear. In WordPress use a "Custom HTML" block; in Shopify use a "Custom Liquid" section or the HTML view of a page; in Wix and Squarespace use an embed/code block.</p>
[rbs_embed_code]

<h2>Rules for using the widget</h2>
<ul>
<li>The widget is free for personal and commercial sites, including shops.</li>
<li>Please keep the small credit line inside the widget. You are welcome, but not required, to link to us as well.</li>
<li>Do not change the code that runs inside the frame or present the tool as your own.</li>
<li>Sizes are estimates; the widget says so. If you sell rings, tell buyers how your own sizes run.</li>
<li>We may update the tool at any time (for example to add sizes); your embed updates automatically.</li>
</ul>

<h2>Privacy</h2>
<p>The widget runs entirely in your visitor's browser. It sets no cookies, loads no analytics or ads, and sends nothing to our server beyond the normal requests that load the widget page and its script. The screen calibration, and any sizes the visitor chooses to save, are stored in the browser's local storage for that visitor only. A photo used for the bangle photo method is only drawn in the browser and is never uploaded. Details are in our <a href="/privacy-policy/">privacy policy</a>.</p>

<h2>Can't embed?</h2>
<p>Some platforms (for example Etsy listings and most marketplaces) do not allow iframes. In that case, link to the tool instead: <a href="/">ringbanglesizer.com</a> for rings, <a href="/bangle-size-calculator/">the bangle size calculator</a> or the <a href="/printable-ring-sizer/">printable ring sizer</a>. Questions or a custom size range for your shop? <a href="/contact/">Contact us</a>.</p>
HTML
			,
			'faq' => array(
				array( 'Is the ring sizer widget free?', 'Yes. It is free for personal and commercial websites. We only ask you to keep the small credit line inside the widget.' ),
				array( 'Does the widget work on mobile?', 'Yes. It is designed for phones first: visitors calibrate with a bank card and then place their ring on the screen.' ),
				array( 'Does the widget use cookies or track visitors?', 'No. It sets no cookies and loads no analytics. Only the screen calibration is saved in the visitor\'s own browser.' ),
				array( 'Can I embed the bangle size calculator?', 'Yes. Use the bangle embed code on this page; it shows Indian bangle sizes from 1.10 to 3.4 with mm and inches.' ),
			),
		),
	);
}
