<?php
/**
 * Bangle silo pages (plan doc content map #3–#13). Same format as inc/page-content.php.
 * Order matters: parents ('bangle-chart' lives in page-content.php, 'bangle-sizes' here) come first.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_bangle_pages() {
	return array(

		/* ---------------------------------------------- BANGLE SIZE CHART INDIA */
		'bangle-chart-india' => array(
			'slug'       => 'india',
			'parent'     => 'bangle-chart',
			'title'      => 'Bangle Size Chart India – Indian Bangle Sizes Explained',
			'seo_title'  => 'Bangle Size Chart India: 2.2 to 2.12 with mm, cm and Age',
			'seo_desc'   => 'Indian bangle size chart with how sizes are written in shops (2.4, 2-4, 2/4), inner diameter in mm and cm, who each size fits and regional names.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => '
<p><strong>In India, bangle size is the inner diameter in inches and sixteenths.</strong> A "2.6" bangle is 2 6/16 inches (60.3 mm) across the inside. The most sold sizes for women are 2.4 and 2.6; 2.8 and 2.10 suit larger hands. Check yours in a minute with our <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

<h2>Indian bangle size chart with shop notation</h2>
<p>Jewellers, glass bangle sellers and online shops write the same size in different ways. This chart shows every common way of writing each size so you can match a listing on Amazon, Flipkart, Meesho, Myntra or a local shop.</p>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Also written as</th><th>Inner diameter</th><th>In cm</th><th>Usually fits</th></tr></thead>
<tbody>
<tr><td><a href="/bangle-size/2-2/">2.2</a></td><td>2-2, 2/2, 2⅛"</td><td>54.0 mm</td><td>5.40 cm</td><td>Teenagers, very slim adult hands</td></tr>
<tr><td><a href="/bangle-size/2-4/">2.4</a></td><td>2-4, 2/4, 2¼"</td><td>57.2 mm</td><td>5.72 cm</td><td>Small adult hands (most popular)</td></tr>
<tr><td><a href="/bangle-size/2-6/">2.6</a></td><td>2-6, 2/6, 2⅜"</td><td>60.3 mm</td><td>6.03 cm</td><td>Medium adult hands (most popular)</td></tr>
<tr><td><a href="/bangle-size/2-8/">2.8</a></td><td>2-8, 2/8, 2½"</td><td>63.5 mm</td><td>6.35 cm</td><td>Large hands, loose fit</td></tr>
<tr><td><a href="/bangle-size/2-10/">2.10</a></td><td>2-10, 2/10, 2⅝"</td><td>66.7 mm</td><td>6.67 cm</td><td>Extra-large hands, men\'s kada</td></tr>
<tr><td><a href="/bangle-size/2-12/">2.12</a></td><td>2-12, 2/12, 2¾"</td><td>69.9 mm</td><td>6.99 cm</td><td>Men\'s kada, very large hands</td></tr>
</tbody>
</table>
<p>Children\'s sizes (1.10 to 2.0) are on the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>, and the complete list with circumference is on the main <a href="/bangle-size-chart/">bangle size chart</a>.</p>

<h2>Why "2.10" is bigger than "2.8"</h2>
<p>This confuses a lot of buyers. The number after the dot is <em>not</em> a decimal: it counts sixteenths of an inch. So 2.8 is 2 + 8/16 = 2.5 inches and 2.10 is 2 + 10/16 = 2.625 inches. That is why sizes go 2.8 → 2.10 → 2.12 → 2.14 → 3.0 instead of 2.9. Some sellers write 2.10 as "2.1", which is easy to misread as a size smaller than 2.2. If a listing shows 2.1, check the diameter in mm before ordering.</p>

<h2>Regional names for bangle sizes</h2>
<ul>
<li><strong>Hindi / Urdu:</strong> chudi, choodi or kangan size – the same 2.2–2.12 scale.</li>
<li><strong>Punjabi:</strong> chooda (bridal sets) and kada (single thick bangle).</li>
<li><strong>Tamil:</strong> valayal; <strong>Telugu:</strong> gajulu; <strong>Kannada:</strong> bale; <strong>Marathi:</strong> bangdi; <strong>Bengali:</strong> churi, with shakha and pola for married women.</li>
</ul>
<p>Whatever the name, the size number means the same inside diameter. Thicker designs such as kada and pola fit tighter, so see our <a href="/chudi-size-chart/">chudi and kada size chart</a> for the adjustment.</p>

<h2>Gold and glass bangles: do sizes differ?</h2>
<p>The size number is the same, but glass and lac bangles are often made slightly smaller than the nominal size, by about 0.5–1 mm, because they cannot be stretched or opened. Gold and silver bangles from a jeweller are usually exact. If you wear a mixed stack, buy glass bangles in the same number as your metal ones, or one size up if your knuckles are prominent.</p>

<h2>How to find your size in India without a sizer</h2>
<ol>
<li>Take a bangle that slides on comfortably and measure across the inside edge with a ruler, in mm. Match it to the table above.</li>
<li>No bangle? Tuck your thumb into your palm and wrap a thread around your knuckles. Measure the thread in cm and use the hand column on the <a href="/bangle-size-chart/in-cm/">bangle size in cm</a> chart.</li>
<li>Or place your bangle on your phone screen in the <a href="/bangle-size-calculator/">online bangle sizer</a>, which reads the size for you.</li>
</ol>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is the standard bangle size in India?', 'There is no single standard, but 2.4 (57.2 mm) and 2.6 (60.3 mm) are the most common adult women\'s sizes and the sizes most ready-made sets are stocked in.' ),
				array( 'Is 2.10 bigger than 2.8?', 'Yes. Indian sizes count sixteenths of an inch, so 2.10 means 2 10/16 inches (66.7 mm), which is larger than 2.8 (2 8/16 inches, 63.5 mm).' ),
				array( 'What does 2/6 bangle size mean?', '2/6 and 2-6 are other ways of writing size 2.6: an inner diameter of 2 6/16 inches, or 60.3 mm.' ),
				array( 'Are Indian and Pakistani bangle sizes the same?', 'Yes. Both use the same inch-and-sixteenths system, so a 2.6 bangle from Pakistan fits the same as a 2.6 from India.' ),
				array( 'Which bangle size for a bride?', 'Rigid chooda and glass or lac bangle sets must pass over the hand, so buy the bride\'s exact size, never smaller. Only openable kangan with a screw or hinge can be one size smaller. Measure a few weeks before the wedding.' ),
			),
		),

		/* ------------------------------------------------ BANGLE SIZE IN CM */
		'bangle-cm' => array(
			'slug'       => 'in-cm',
			'parent'     => 'bangle-chart',
			'title'      => 'Bangle Size in cm – 2.4, 2.6, 2.8 and Every Size in Centimetres',
			'seo_title'  => 'Bangle Size in cm: 2.4, 2.6, 2.8, 2.10 Diameter Chart',
			'seo_desc'   => 'Bangle size in cm: 2.4 is 5.72 cm, 2.6 is 6.03 cm, 2.8 is 6.35 cm across. Full chart with circumference in cm and the hand size each bangle clears.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => '
<p><strong>Bangle size 2.4 is 5.72 cm, 2.6 is 6.03 cm and 2.8 is 6.35 cm in inner diameter.</strong> Around the inside, those sizes measure 17.97 cm, 18.94 cm and 19.95 cm. The chart below gives every size in centimetres, plus the hand circumference each bangle will pass over. Not sure where you fit? Use the <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

<h2>Bangle size chart in cm</h2>
[rbs_bangle_cm_table]
<p>"Hand circumference it clears" is the measurement around your hand with the thumb tucked in. A bangle passes over your hand when its inside circumference is at least that long, so read down the column to the first range that contains your number.</p>

<h2>Converting a bangle size to cm yourself</h2>
<p>Indian bangle sizes are inches and sixteenths. To get centimetres:</p>
<ol>
<li>Split the size at the dot: 2.6 → 2 inches and 6 sixteenths.</li>
<li>Turn the sixteenths into a decimal: 6 ÷ 16 = 0.375, so the diameter is 2.375 inches.</li>
<li>Multiply by 2.54: 2.375 × 2.54 = <strong>6.03 cm</strong>.</li>
</ol>
<p>For circumference, multiply the diameter by 3.14: 6.03 × 3.14 = 18.9 cm. The same steps give 2.4 = 2.25 in = 5.72 cm and 2.10 = 2.625 in = 6.67 cm.</p>

<h2>Most searched sizes in cm</h2>
<ul>
<li><a href="/bangle-size/2-4/">2.4 bangle size in cm</a>: 5.72 cm across, 17.97 cm around.</li>
<li><a href="/bangle-size/2-6/">2.6 bangle size in cm</a>: 6.03 cm across, 18.94 cm around.</li>
<li><a href="/bangle-size/2-8/">2.8 bangle size in cm</a>: 6.35 cm across, 19.95 cm around.</li>
<li><a href="/bangle-size/2-10/">2.10 bangle size in cm</a>: 6.67 cm across, 20.95 cm around.</li>
<li><a href="/bangle-size/2-2/">2.2 bangle size in cm</a>: 5.40 cm across, 16.96 cm around.</li>
</ul>

<h2>Measuring in cm at home</h2>
<p>A school ruler is enough. Put a bangle that fits you flat on the ruler and read the distance across the <em>inside</em> edge through the centre. Measure twice at right angles, because handmade bangles are rarely perfectly round, and use the larger figure. If you get 6.0 cm, your size is 2.6; 5.7 cm is 2.4; 6.3–6.4 cm is 2.8.</p>
<p>To measure your hand instead, fold your thumb across your palm as if slipping on a bangle and wrap a soft tape or thread around the widest part, over the knuckles. A reading of 18.5 cm sits in the 2.6 range (18.0–18.9 cm). If you are right on a boundary, choose the larger size: a bangle that is one millimetre too small simply will not go on.</p>

<h2>Diameter or circumference: which do shops use?</h2>
<p>Most Indian and Pakistani shops list the size number (2.4, 2.6) and some add the diameter in cm or inches. Western shops selling bangle bracelets usually give the inside circumference in inches or cm instead, often 7.5 to 8.5 inches. To compare, multiply the diameter in cm by 3.14, or check the circumference column above. An 8 inch (20.3 cm) bangle bracelet sits between 2.8 and 2.10.</p>

[rbs_cta mode="bangle"]

<p>Prefer inches? See the main <a href="/bangle-size-chart/">bangle size chart</a>. For the Indian notation used in shops, see the <a href="/bangle-size-chart/india/">bangle size chart India</a>.</p>
',
			'faq' => array(
				array( 'What is 2.4 bangle size in cm?', 'Size 2.4 is 5.72 cm in inner diameter and 17.97 cm in inner circumference.' ),
				array( 'What is 2.6 bangle size in cm?', 'Size 2.6 is 6.03 cm in inner diameter and 18.94 cm around the inside.' ),
				array( 'What is 2.8 bangle size in cm?', 'Size 2.8 is 6.35 cm across the inside and 19.95 cm around.' ),
				array( 'My bangle measures 6 cm across. What size is it?', 'A 6.0 cm inner diameter is size 2.6 (6.03 cm). Small differences of 1 mm are normal between makers.' ),
				array( 'How many cm is a 2.10 bangle?', 'Size 2.10 is 6.67 cm in inner diameter, about 20.95 cm around the inside.' ),
			),
		),

		/* ------------------------------------------------ BANGLE SIZES HUB */
		'bangle-sizes' => array(
			'slug'       => 'bangle-size',
			'title'      => 'Bangle Sizes – Guide to Every Indian Bangle Size',
			'seo_title'  => 'Bangle Sizes Guide: 2.2, 2.4, 2.6, 2.8, 2.10, 2.12 Explained',
			'seo_desc'   => 'Pick your bangle size: what 2.2, 2.4, 2.6, 2.8, 2.10 and 2.12 mean, their diameter in mm and cm, who each one fits and how to choose between two sizes.',
			'mode'       => null,
			'menu_order' => 5,
			'content'    => '
<p><strong>Each Indian bangle size is a measurement of the inside diameter: the first number is whole inches and the second is sixteenths of an inch.</strong> Most women wear 2.4 or 2.6, larger hands need 2.8 or 2.10, and men\'s kadas usually start at 2.10. Choose a size below for its full measurements, or let the <a href="/bangle-size-calculator/">bangle size calculator</a> pick one for you.</p>

<h2>Choose your bangle size</h2>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Diameter</th><th>Fits hand around knuckles</th><th>Typical wearer</th></tr></thead>
<tbody>
<tr><td><a href="/bangle-size/2-2/">Bangle size 2.2</a></td><td>54.0 mm</td><td>16.0–17.0 cm</td><td>Teens, petite adults</td></tr>
<tr><td><a href="/bangle-size/2-4/">Bangle size 2.4</a></td><td>57.2 mm</td><td>17.0–18.0 cm</td><td>Small adult hands</td></tr>
<tr><td><a href="/bangle-size/2-6/">Bangle size 2.6</a></td><td>60.3 mm</td><td>18.0–18.9 cm</td><td>Medium adult hands</td></tr>
<tr><td><a href="/bangle-size/2-8/">Bangle size 2.8</a></td><td>63.5 mm</td><td>18.9–19.9 cm</td><td>Large hands</td></tr>
<tr><td><a href="/bangle-size/2-10/">Bangle size 2.10</a></td><td>66.7 mm</td><td>19.9–21.0 cm</td><td>Extra large, men</td></tr>
<tr><td><a href="/bangle-size/2-12/">Bangle size 2.12</a></td><td>69.9 mm</td><td>21.0–22.0 cm</td><td>Men\'s kada</td></tr>
</tbody>
</table>
<p>Smaller sizes for babies and children are on the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>.</p>

<h2>How the size numbers work</h2>
<p>Read "2.6" as "two and six-sixteenths of an inch". The step between adult sizes is two sixteenths, which is about 3.2 mm of diameter or 1 cm of circumference. That sounds small, but it is the difference between a bangle that slides on and one that will not pass your knuckles. Because the second number counts sixteenths, the scale runs 2.8, 2.10, 2.12, 2.14 and then 3.0 – there is no 2.9 and no 2.16.</p>

<h2>Between two sizes?</h2>
<p>Your hand, not your wrist, decides the size of a rigid bangle, because it has to slide over the widest part of the folded hand. If your measurement is close to the top of a range:</p>
<ul>
<li><strong>Rigid gold, silver or glass bangles:</strong> take the larger size.</li>
<li><strong>Openable bangles, kadas with a screw, or bangles with a hinge:</strong> take the smaller size for a neater fit on the wrist.</li>
<li><strong>Stacked bridal sets and chooda:</strong> your exact size. A rigid glass or lac chooda one size smaller can crack while being rolled on or hurt the hand.</li>
<li><strong>Thick or wide designs (over 8 mm):</strong> go one size up, as explained on the <a href="/chudi-size-chart/">chudi and kada size chart</a>.</li>
</ul>

<h2>Three ways to find your size</h2>
<ol>
<li><strong>On screen:</strong> place a bangle you own on your phone in the <a href="/bangle-size-calculator/">online bangle sizer</a> and match the circle.</li>
<li><strong>With a ruler:</strong> measure the inside diameter of a bangle that fits, in mm, and pick the nearest size above.</li>
<li><strong>With a thread:</strong> measure around your folded hand and find your range in the table. Step-by-step photos-free instructions are in <a href="/how-to-measure-bangle-size/">how to measure bangle size</a>.</li>
</ol>

<h2>Average bangle size by group</h2>
<ul>
<li>Women in India and Pakistan: 2.4–2.6 (most common), 2.8 for larger frames.</li>
<li>Men (kada): 2.10–2.12; very large hands 2.14 or 3.0; heavy kadas for the largest hands 3.2 or 3.4.</li>
<li>Teenagers: 2.2–2.4.</li>
<li>Children 4–7 years: 2.0; under 4: 1.10–1.14.</li>
</ul>
<p>These are averages only. Two people of the same height can be a full size apart, so always measure.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'Which bangle size is most common?', 'Sizes 2.4 and 2.6 are the most common for adult women in India and Pakistan and are the sizes most shops stock.' ),
				array( 'What is the difference between 2.4 and 2.6 bangle size?', '2.6 is 3.1 mm wider in diameter (60.3 mm vs 57.2 mm) and about 1 cm longer around the inside. That is one full size.' ),
				array( 'What bangle size do men wear?', 'Most men wear a kada in size 2.10 or 2.12 (66.7–69.9 mm). Very large hands may need 2.14 or 3.0, and a few men need 3.2 or 3.4 (79.4–82.6 mm).' ),
				array( 'Is there a 2.9 bangle size?', 'No. The number after the dot counts sixteenths of an inch in steps of two, so after 2.8 comes 2.10.' ),
				array( 'Should I size up or down for bangles?', 'For rigid bangles size up if you are between sizes, because the bangle has to pass your knuckles. For openable bangles and kadas with a clasp you can size down.' ),
			),
		),

		/* ---------------------------------------------------------- 2.2 */
		'bangle-2-2' => array(
			'slug'       => '2-2',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.2 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.2 Bangle Size: 54 mm (5.4 cm) Diameter, Who It Fits',
			'seo_desc'   => '2.2 bangle size is 2 2/16 inches, 54.0 mm or 5.40 cm inner diameter. See the hand size it fits, how it compares with 2.0 and 2.4, and how to check yours.',
			'mode'       => null,
			'menu_order' => 1,
			'content'    => '
<p><strong>Bangle size 2.2 has an inner diameter of 2 2/16 inches (2⅛ in), which is 54.0 mm or 5.40 cm.</strong> It is the smallest adult bangle size and usually fits teenagers and women with slim, small hands. You can confirm whether 2.2 is right for you with the <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

[rbs_bangle_size size="2.2"]

<h2>Who wears a 2.2 bangle?</h2>
<p>A 2.2 bangle passes over a folded hand that measures up to about 17 cm (6.7 inches) around the knuckles. In practice that means:</p>
<ul>
<li>girls from roughly 10 to 15 years old;</li>
<li>adult women with petite hands and narrow knuckles, often under about 5 feet tall;</li>
<li>anyone who wants a close, non-sliding fit and has a hand right at the bottom of the 2.4 range.</li>
</ul>
<p>Most adult women find 2.2 too tight to put on comfortably. If you have to squeeze and use soap or oil to get a 2.2 bangle over your hand, your real size is <a href="/bangle-size/2-4/">2.4</a>.</p>

<h2>2.2 compared with nearby sizes</h2>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Diameter</th><th>Difference from 2.2</th></tr></thead>
<tbody>
<tr><td>2.0</td><td>50.8 mm</td><td>3.2 mm smaller – child size (4–7 years)</td></tr>
<tr><td><strong>2.2</strong></td><td><strong>54.0 mm</strong></td><td>—</td></tr>
<tr><td><a href="/bangle-size/2-4/">2.4</a></td><td>57.2 mm</td><td>3.2 mm larger – the most common adult size</td></tr>
</tbody>
</table>

<h2>How to check if 2.2 fits you</h2>
<ol>
<li>Fold your thumb into your palm and press your fingers together, the way you do when sliding on a bangle.</li>
<li>Wrap a thread around the widest point, across the knuckles, and mark it.</li>
<li>Measure the thread. 16.0–17.0 cm means 2.2. Under 16.0 cm means 2.0; over 17.0 cm means 2.4 or larger.</li>
</ol>
<p>If you already own a bangle that fits, put it on your phone screen in the <a href="/bangle-size-calculator/">online bangle sizer</a> instead; it shows the size directly, with no maths.</p>

<h2>Buying 2.2 bangles</h2>
<p>Because 2.2 sits between children\'s and adult ranges, shops stock it less than 2.4 and 2.6. Glass bangle sets in 2.2 are common for school functions, Eid and Diwali gifts for girls. Gold bangles in 2.2 are often bought for a daughter to grow into: at around 10–12 years a girl moves from 2.0 to 2.2, and most reach 2.4 by their late teens. For a gift, a 2.2 openable bangle with a screw or hinge is the safest choice, because it fits a range of hands.</p>

<h2>Is 2.2 the same as "2.1" or 2.20?</h2>
<p>No. "2.1" is not a standard size and is often a seller\'s way of writing 2.10 (66.7 mm), which is much larger. "2.20" is sometimes used for 2.2. When in doubt, ask the seller for the inner diameter in mm: 2.2 should be 54 mm.</p>

<h2>Growing from 2.2 to 2.4</h2>
<p>Hands keep growing until the late teens, and many girls move from 2.2 to 2.4 between 14 and 18. If you are buying gold for a teenager, an openable 2.2 or a rigid 2.4 will last longer than a rigid 2.2. Check the fit every year: a rigid bangle that has become tight is hard to remove and may need to be cut off. For younger girls, see the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is 2.2 bangle size in mm?', 'Size 2.2 is 54.0 mm in inner diameter and 169.6 mm (16.96 cm) in inner circumference.' ),
				array( 'What is 2.2 bangle size in inches?', '2 2/16 inches, which is 2⅛ or 2.125 inches across the inside.' ),
				array( 'What age is 2.2 bangle size for?', 'Size 2.2 usually fits girls from about 10 to 15 years old and adult women with very small hands.' ),
				array( 'Is 2.2 bangle size small?', 'Yes. It is the smallest adult bangle size. Most adult women wear 2.4 or 2.6.' ),
				array( 'What hand size fits a 2.2 bangle?', 'A folded hand measuring about 16.0 to 17.0 cm (6.3 to 6.7 inches) around the knuckles.' ),
			),
		),

		/* ---------------------------------------------------------- 2.4 */
		'bangle-2-4' => array(
			'slug'       => '2-4',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.4 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.4 Bangle Size: 57.2 mm (5.72 cm) Diameter, Fit and Chart',
			'seo_desc'   => '2.4 bangle size is 2 4/16 (2¼) inches, 57.2 mm or 5.72 cm inner diameter. See who it fits, the hand size for 2.4, and how it compares with 2.2 and 2.6.',
			'mode'       => null,
			'menu_order' => 2,
			'content'    => '
<p><strong>Bangle size 2.4 means an inner diameter of 2 4/16 inches (2¼ in), which is 57.2 mm or 5.72 cm.</strong> It is one of the two most popular adult sizes in India and Pakistan and fits small-to-average women\'s hands. To see if 2.4 is your size, match a bangle on your screen with the <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

[rbs_bangle_size size="2.4"]

<h2>Who usually wears 2.4?</h2>
<p>A 2.4 bangle slides over a folded hand of about 17.0 to 18.0 cm (6.7 to 7.1 inches) around the knuckles. That covers a large share of adult women, which is why 2.4 and 2.6 are the sizes stocked most in bangle shops. You are likely a 2.4 if:</p>
<ul>
<li>your ring size is around US 5–6.5 (UK J–M);</li>
<li>standard "small" or "medium" bracelets fit you comfortably;</li>
<li>a 2.6 bangle slides off easily over your hand when your arm hangs down.</li>
</ul>

<h2>2.4 vs 2.6: which should I buy?</h2>
<p>This is the most common sizing question we get. The two sizes are only 3.1 mm apart in diameter, about 1 cm around the inside. Use these rules:</p>
<ul>
<li>If your hand measurement is under 17.8 cm, buy 2.4.</li>
<li>If it is 17.8–18.0 cm, you are at the top of 2.4. Choose 2.4 for openable bangles and glass sets, <a href="/bangle-size/2-6/">2.6</a> for rigid gold or silver bangles you will put on and take off daily.</li>
<li>Over 18.0 cm, 2.4 will not pass your knuckles: buy 2.6.</li>
</ul>
<p>For a size down, see <a href="/bangle-size/2-2/">bangle size 2.2</a>.</p>

<h2>2.4 bangle size worked example</h2>
<p>Sana measures around her folded hand with a thread and gets 17.4 cm. Dividing by π gives 17.4 ÷ 3.1416 = 5.54 cm, the smallest opening her hand can pass through. The first size at least that wide is 2.4 (5.72 cm), leaving about 1.8 mm of clearance – enough to slide on without soap, snug enough not to fall off. Size 2.2 (5.40 cm) would be too small.</p>

<h2>How to check a bangle you already own</h2>
<p>Lay the bangle on a ruler and measure the inside edge straight across the centre. 5.6–5.8 cm is a 2.4. Anything from 5.9 cm upwards is a 2.6. Or put it on your phone screen in the <a href="/bangle-size-calculator/">online bangle sizer</a>, calibrate once with a bank card, and read the size directly.</p>

<h2>2.4 for gifts and bridal sets</h2>
<p>If you are buying for someone else and do not know their size, 2.4 is the safest single guess for an adult woman, followed by 2.6. For bridal chooda many brides who normally wear 2.6 choose 2.4 so the stack stays in place, but only if they can get the bangles over the knuckles; the shop usually helps with this using soap or a plastic bag.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is 2.4 bangle size in cm?', 'Size 2.4 is 5.72 cm in inner diameter and about 17.97 cm around the inside.' ),
				array( 'What is 2.4 bangle size in mm?', '57.2 mm inner diameter, and 179.7 mm inner circumference.' ),
				array( 'What is 2.4 bangle size in inches?', '2 4/16 inches, which is 2¼ or 2.25 inches across the inside.' ),
				array( 'Is 2.4 bangle size small or medium?', 'Size 2.4 is a small adult size. It is one of the two most common women\'s sizes, along with 2.6 (medium).' ),
				array( 'What hand size fits a 2.4 bangle?', 'A folded hand measuring about 17.0 to 18.0 cm (6.7 to 7.1 inches) around the knuckles.' ),
			),
		),

		/* ---------------------------------------------------------- 2.6 */
		'bangle-2-6' => array(
			'slug'       => '2-6',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.6 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.6 Bangle Size: 60.3 mm (6.03 cm) Diameter, Who It Fits',
			'seo_desc'   => '2.6 bangle size is 2 6/16 (2⅜) inches, 60.3 mm or 6.03 cm inner diameter. Hand size for 2.6, comparison with 2.4 and 2.8, and how to measure.',
			'mode'       => null,
			'menu_order' => 3,
			'content'    => '
<p><strong>Bangle size 2.6 is 2 6/16 inches (2⅜ in) across the inside, which is 60.3 mm or 6.03 cm.</strong> It is the medium adult size and, together with 2.4, the most sold bangle size in India and Pakistan. Check if 2.6 fits you with the free <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

[rbs_bangle_size size="2.6"]

<h2>Who is a 2.6?</h2>
<p>A 2.6 bangle clears a folded hand of about 18.0 to 18.9 cm (7.1 to 7.5 inches) around the knuckles. That is the average adult woman\'s hand in South Asia, and many women with medium frames wear 2.6 for gold and 2.4 for glass. Signs you are a 2.6:</p>
<ul>
<li>2.4 bangles need soap or a lot of squeezing to go on;</li>
<li>your ring size is around US 6.5–7.5 (UK M½–O½);</li>
<li>your wrist is 15–16.5 cm around.</li>
</ul>

<h2>2.6 compared with 2.4 and 2.8</h2>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Diameter (cm)</th><th>Around inside (cm)</th><th>Hand range (cm)</th></tr></thead>
<tbody>
<tr><td><a href="/bangle-size/2-4/">2.4</a></td><td>5.72</td><td>17.97</td><td>17.0–18.0</td></tr>
<tr><td><strong>2.6</strong></td><td><strong>6.03</strong></td><td><strong>18.94</strong></td><td><strong>18.0–18.9</strong></td></tr>
<tr><td><a href="/bangle-size/2-8/">2.8</a></td><td>6.35</td><td>19.95</td><td>18.9–19.9</td></tr>
</tbody>
</table>
<p>One size up or down changes the opening by about 1 cm around the inside. If 2.6 is loose enough to slip off when you shake your arm, try 2.4 for openable designs; if it is a struggle to get over your knuckles, move to 2.8.</p>

<h2>Measuring for 2.6 at home</h2>
<ol>
<li>Bring your thumb across your palm and hold your fingers together.</li>
<li>Wrap a strip of paper around the widest part, over the thumb knuckle and the base of the little finger.</li>
<li>Mark the overlap, lay the strip on a ruler and read the length in cm.</li>
<li>18.0–18.9 cm is size 2.6. Over 18.9 cm? Choose 2.8 for a rigid bangle.</li>
</ol>
<p>Already have a bangle that fits? It is quicker to place it on the screen in our <a href="/bangle-size-calculator/">bangle sizer</a> and read the result.</p>

<h2>2.6 worked example</h2>
<p>A hand measurement of 18.6 cm gives 18.6 ÷ 3.1416 = 5.92 cm. The first size at least 5.92 cm wide is 2.6 (6.03 cm), with just over 1 mm to spare – a good, close fit. Size 2.4 (5.72 cm) would be 2 mm too small to pass the knuckles.</p>

<h2>Tips for buying 2.6</h2>
<ul>
<li>Ask for the diameter in mm when buying gold. Some makers\' 2.6 measures 60 mm, others 60.5 mm; both are fine.</li>
<li>Wide kadas and heavy bridal bangles over 8 mm wide fit tighter. Consider 2.8 for those.</li>
<li>Glass bangle sets marked 2.6 can run slightly small. If your hand is at the top of the range, buy 2.8 glass.</li>
</ul>

<h2>2.6 in other measurements</h2>
<p>Western shops that sell bangle bracelets by inside circumference would call a 2.6 about 7.46 inches (18.9 cm). Shops that list diameter in inches show it as 2⅜" or 2.375". If a listing only says "medium", ask for the diameter: medium in one brand can be 2.4 and in another 2.6.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is 2.6 bangle size in cm?', 'Size 2.6 is 6.03 cm in inner diameter and 18.94 cm around the inside.' ),
				array( 'What is 2.6 bangle size in mm?', '60.3 mm across the inside, and about 189.4 mm around.' ),
				array( 'What is 2.6 bangle size in inches?', '2 6/16 inches, which is 2⅜ or 2.375 inches in inner diameter.' ),
				array( 'Is 2.6 a medium bangle size?', 'Yes. 2.6 is the medium adult size and one of the two most common women\'s sizes, with 2.4.' ),
				array( 'What hand size fits a 2.6 bangle?', 'A folded hand of about 18.0 to 18.9 cm (7.1 to 7.5 inches) around the knuckles.' ),
			),
		),

		/* ---------------------------------------------------------- 2.8 */
		'bangle-2-8' => array(
			'slug'       => '2-8',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.8 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.8 Bangle Size: 63.5 mm (6.35 cm) Diameter, Fit Guide',
			'seo_desc'   => '2.8 bangle size is 2½ inches (2 8/16), 63.5 mm or 6.35 cm inner diameter. Who wears 2.8, the hand size it fits, and 2.8 vs 2.6 and 2.10.',
			'mode'       => null,
			'menu_order' => 4,
			'content'    => '
<p><strong>Bangle size 2.8 is exactly 2½ inches (2 8/16 in) in inner diameter: 63.5 mm or 6.35 cm.</strong> It is the large adult women\'s size, worn by women with broader hands, and also chosen by many for a looser, sliding look. Not sure if you are a 2.8? The <a href="/bangle-size-calculator/">bangle size calculator</a> tells you in under a minute.</p>

[rbs_bangle_size size="2.8"]

<h2>Who wears size 2.8?</h2>
<p>A 2.8 bangle passes over a folded hand of about 18.9 to 19.9 cm (7.5 to 7.9 inches) around the knuckles. Typical 2.8 wearers are:</p>
<ul>
<li>women with larger hands or prominent knuckles, often with a ring size of US 7.5–9;</li>
<li>women who wear 2.6 for openable bangles but need 2.8 for rigid gold or silver;</li>
<li>teenage boys and slim men who want a light kada.</li>
</ul>
<p>Size 2.8 is also popular for pregnancy and for hot climates, when hands swell slightly and a 2.6 becomes hard to remove.</p>

<h2>2.8 vs 2.6 vs 2.10</h2>
<p>Size 2.8 is 3.2 mm wider than <a href="/bangle-size/2-6/">2.6</a> and 3.2 mm narrower than <a href="/bangle-size/2-10/">2.10</a>. In circumference that is about 1 cm each way. A useful check: if your hand measures 19.0 cm, 2.6 (18.94 cm around) is just too small and 2.8 (19.95 cm) gives about 1 cm of room – the right amount for a bangle you wear every day.</p>

<h2>Is 2.8 the same as 2½ inch?</h2>
<p>Yes. Because 8/16 is one half, a 2.8 bangle is exactly 2.5 inches across the inside. This makes 2.8 easy to check with any inch ruler. It is also the size most Western "bangle bracelet" listings call <em>medium-large</em> or quote as about 7.85 inches inside circumference.</p>

<h2>How to measure for 2.8</h2>
<ol>
<li>Measure a bangle you own across the inside: 6.3–6.4 cm (2½ in) is a 2.8.</li>
<li>Or measure around your folded hand: 18.9–19.9 cm means 2.8.</li>
<li>Or place your bangle on your phone with the <a href="/bangle-size-calculator/">online bangle sizer</a> and read the size.</li>
</ol>
<p>If your hand is over 19.9 cm, buy 2.10 for rigid bangles. Right at 19.9 cm a 2.8 will only just pass, so try one on if you can. For openable kadas and bangles with a screw or hinge, 2.8 will still close comfortably around the wrist.</p>

<h2>Buying tips for 2.8</h2>
<ul>
<li>Glass bangle shops stock 2.8 widely; gold ready-made stock is smaller, so ask the jeweller to order or make it.</li>
<li>Heavy bridal bangles in 2.8 can rotate on a slim wrist. Add a matching 2.6 openable bangle at each end of the stack to hold it in place.</li>
<li>Men choosing their first kada often start at 2.8 or 2.10. Try both on if possible; most men prefer 2.10.</li>
</ul>

<h2>2.8 in other measurements</h2>
<p>If a shop lists inside circumference instead of a size number, a 2.8 is about 19.95 cm or 7.85 inches around. In mm it is 63.5 mm across the inside. Some Western brands call this size "large" and others "medium-large", so ask for the measurement rather than relying on the label.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is 2.8 bangle size in cm?', 'Size 2.8 is 6.35 cm in inner diameter and about 19.95 cm around the inside.' ),
				array( 'What is 2.8 bangle size in mm?', '63.5 mm across the inside and 199.5 mm around.' ),
				array( 'What is 2.8 bangle size in inches?', 'Exactly 2½ inches (2 8/16 in) in inner diameter.' ),
				array( 'Is 2.8 a large bangle size?', 'Yes. 2.8 is the large adult women\'s size. Most women wear 2.4 or 2.6.' ),
				array( 'What hand size fits a 2.8 bangle?', 'A folded hand of about 18.9 to 19.9 cm (7.5 to 7.9 inches) around the knuckles.' ),
			),
		),

		/* --------------------------------------------------------- 2.10 */
		'bangle-2-10' => array(
			'slug'       => '2-10',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.10 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.10 Bangle Size: 66.7 mm (6.67 cm) Diameter Explained',
			'seo_desc'   => '2.10 bangle size is 2 10/16 (2⅝) inches, 66.7 mm or 6.67 cm inner diameter. Why 2.10 is bigger than 2.8, who it fits, and men\'s kada sizing.',
			'mode'       => null,
			'menu_order' => 5,
			'content'    => '
<p><strong>Bangle size 2.10 is 2 10/16 inches (2⅝ in) across the inside: 66.7 mm or 6.67 cm.</strong> It is an extra-large women\'s size and the most common starting size for men\'s kadas. Despite how it looks, 2.10 is bigger than 2.8, not smaller. Check your size with the <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

[rbs_bangle_size size="2.10"]

<h2>Why 2.10 comes after 2.8</h2>
<p>Bangle sizes are not decimals. The number after the dot counts sixteenths of an inch, so the scale goes 2.6 (6/16), 2.8 (8/16), 2.10 (10/16), 2.12 (12/16). Reading 2.10 as "2.1" would make it look smaller than 2.2, which is a common and expensive mistake when ordering online. A true 2.1 size does not exist; if a listing shows it, ask whether they mean 2.10 and confirm the diameter is about 66–67 mm.</p>

<h2>Who wears 2.10?</h2>
<p>A 2.10 bangle passes over a folded hand of about 19.9 to 21.0 cm (7.9 to 8.2 inches). That suits:</p>
<ul>
<li>men with average hands wearing a kada or a gold bangle;</li>
<li>women with large hands, long fingers or prominent knuckles;</li>
<li>anyone who prefers a loose bangle that slides down towards the hand.</li>
</ul>
<p>Searches for "2.10 bangle size" have grown sharply this year, mostly from people checking whether it is bigger or smaller than 2.8. Short answer: one full size bigger, 3.2 mm wider than <a href="/bangle-size/2-8/">2.8</a>.</p>

<h2>2.10 for men\'s kada</h2>
<p>Most men\'s kadas are sold in 2.10, 2.12 and 2.14. Kadas are thick (often 6–12 mm wide and 4–8 mm deep), and a thick ring of metal is harder to push over the knuckles than a thin bangle of the same diameter. If your hand measures near the top of the 2.10 range, choose <a href="/bangle-size/2-12/">2.12</a>. The <a href="/chudi-size-chart/">kada size chart</a> has the full men\'s range.</p>

<h2>Worked example</h2>
<p>Imran measures 20.4 cm around his folded hand. 20.4 ÷ 3.1416 = 6.49 cm. Size 2.8 (6.35 cm) is too small; 2.10 (6.67 cm) clears with about 1.8 mm to spare, so 2.10 is his size. For a heavy 10 mm kada he might still prefer 2.12 for easier removal.</p>

<h2>Check 2.10 at home</h2>
<ul>
<li>A bangle measuring 6.6–6.8 cm across the inside is a 2.10.</li>
<li>Its inside circumference is about 20.95 cm (8¼ inches).</li>
<li>Or place your current bangle or kada on the screen in the <a href="/bangle-size-calculator/">online bangle sizer</a>.</li>
</ul>

<h2>2.10 for women</h2>
<p>Women who wear 2.10 often have long fingers or broad knuckles rather than wide wrists, so a 2.10 rigid bangle can feel loose once it is on. A good solution is to wear the 2.10 bangles in the middle of a stack, with an openable 2.8 bangle on either side to hold them in place. For a single bangle, an openable 2.8 or 2.10 with a screw clasp gives a neater fit.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'Is 2.10 bangle size bigger than 2.8?', 'Yes. 2.10 means 2 10/16 inches (66.7 mm) and 2.8 means 2 8/16 inches (63.5 mm), so 2.10 is one size bigger.' ),
				array( 'What is 2.10 bangle size in cm?', 'Size 2.10 is 6.67 cm in inner diameter and about 20.95 cm around the inside.' ),
				array( 'What is 2.10 bangle size in inches?', '2 10/16 inches, which is 2⅝ or 2.625 inches.' ),
				array( 'Is 2.10 bangle size for men?', '2.10 is the most common starting size for men\'s kadas, and it is also worn by women with large hands.' ),
				array( 'Is 2.1 the same as 2.10 bangle size?', 'Sellers sometimes write 2.10 as 2.1, but there is no real 2.1 size. Always confirm the inner diameter, which should be about 66.7 mm for 2.10.' ),
			),
		),

		/* --------------------------------------------------------- 2.12 */
		'bangle-2-12' => array(
			'slug'       => '2-12',
			'parent'     => 'bangle-sizes',
			'title'      => 'Bangle Size 2.12 – Diameter in mm, cm and Inches',
			'seo_title'  => '2.12 Bangle Size: 69.9 mm (6.99 cm) Diameter, Kada Fit',
			'seo_desc'   => '2.12 bangle size is 2 12/16 (2¾) inches, 69.9 mm or 6.99 cm inner diameter. Who wears 2.12, men\'s kada fit, and how it compares with 2.10 and 2.14.',
			'mode'       => null,
			'menu_order' => 6,
			'content'    => '
<p><strong>Bangle size 2.12 has an inner diameter of 2 12/16 inches (2¾ in), which is 69.9 mm or 6.99 cm – almost exactly 7 cm.</strong> It is mainly a men\'s kada size and the largest size most bangle shops keep in stock. Use the <a href="/bangle-size-calculator/">bangle size calculator</a> to check if 2.12 is right for your hand.</p>

[rbs_bangle_size size="2.12"]

<h2>Who needs a 2.12?</h2>
<p>A 2.12 bangle passes over a folded hand of about 21.0 to 22.0 cm (8.2 to 8.6 inches) around the knuckles. Common 2.12 wearers:</p>
<ul>
<li>men with average-to-large hands, especially for thick or heavy kadas;</li>
<li>men who wear 2.10 for thin bangles but need extra room for a wide kada;</li>
<li>women with very large hands, and anyone who wants a deliberately loose, sliding fit.</li>
</ul>

<h2>2.12 in the men\'s kada range</h2>
<table class="rbs-table">
<thead><tr><th>Size</th><th>Diameter</th><th>Hand range</th><th>Typical choice</th></tr></thead>
<tbody>
<tr><td><a href="/bangle-size/2-10/">2.10</a></td><td>66.7 mm</td><td>19.9–21.0 cm</td><td>Slim to average men</td></tr>
<tr><td><strong>2.12</strong></td><td><strong>69.9 mm</strong></td><td><strong>21.0–22.0 cm</strong></td><td><strong>Average to large men</strong></td></tr>
<tr><td>2.14</td><td>73.0 mm</td><td>22.0–22.9 cm</td><td>Large hands, heavy kada</td></tr>
<tr><td>3.0</td><td>76.2 mm</td><td>22.9–23.9 cm</td><td>Very large hands</td></tr>
<tr><td>3.2</td><td>79.4 mm</td><td>23.9–24.9 cm</td><td>Very large hands, heavy kada</td></tr>
<tr><td>3.4</td><td>82.6 mm</td><td>24.9–25.9 cm</td><td>Largest stock size, often made to order</td></tr>
</tbody>
</table>

<h2>Thick kadas need more room</h2>
<p>The size number is the inner diameter, but a kada\'s thickness changes how it feels going on. A thin 3 mm bangle can be rolled over the knuckles at an angle; a 10 mm-wide, 6 mm-thick kada cannot. As a rule, if a kada is wider than 8 mm, go one size up from your thin-bangle size – a man who wears 2.10 in a plain bangle usually wears 2.12 in a heavy Sikh kada. See the <a href="/chudi-size-chart/">chudi and kada size chart</a> for more detail.</p>

<h2>Measuring for 2.12</h2>
<ol>
<li>Measure your current kada across the inside with a ruler. 6.9–7.0 cm is a 2.12.</li>
<li>Or measure around your folded hand with a thread: 21.0–22.0 cm is 2.12.</li>
<li>Or calibrate your phone and match the kada on screen with the <a href="/bangle-size-calculator/">bangle sizer</a>.</li>
</ol>

<h2>Worked example</h2>
<p>A hand measurement of 21.5 cm gives 21.5 ÷ 3.1416 = 6.84 cm. Size 2.10 (6.67 cm) is too small; 2.12 (6.99 cm) clears it with about 1.5 mm to spare. For a heavy kada, that is a good fit; for a very thick design, 2.14 would be easier to remove.</p>

<h2>Buying 2.12 online</h2>
<p>Ask for the inner diameter in mm and the kada\'s width and thickness. Silver and steel kadas are sometimes sized by inner circumference instead: 2.12 is about 21.96 cm (8.65 in) around. If a listing gives "2.75 inch", that is the same as 2.12.</p>

<h2>2.12 for women</h2>
<p>Women rarely need 2.12, but it is the right size if 2.10 bangles have to be forced over the knuckles. Glass and lac sets in 2.12 are harder to find, so many women with large hands buy openable metal bangles instead, which can be sized to the wrist rather than the hand. If you are between 2.10 and 2.12, measure in the evening, when hands are at their largest.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What is 2.12 bangle size in cm?', 'Size 2.12 is 6.99 cm (about 7 cm) in inner diameter and about 21.96 cm around the inside.' ),
				array( 'What is 2.12 bangle size in inches?', '2 12/16 inches, which is 2¾ or 2.75 inches across the inside.' ),
				array( 'Is 2.12 bangle size for men?', 'Mostly yes. 2.12 is a common men\'s kada size, especially for thick or heavy kadas.' ),
				array( 'What hand size fits a 2.12 bangle?', 'A folded hand measuring about 21.0 to 22.0 cm (8.2 to 8.6 inches) around the knuckles.' ),
				array( 'What comes after 2.12 bangle size?', 'Size 2.14 (73.0 mm), then 3.0 (76.2 mm). Large men\'s kadas also come in 3.2 (79.4 mm) and 3.4 (82.6 mm).' ),
			),
		),

		/* ------------------------------------------------- HOW TO MEASURE */
		'bangle-measure' => array(
			'slug'       => 'how-to-measure-bangle-size',
			'title'      => 'How to Measure Bangle Size at Home – 4 Easy Methods',
			'seo_title'  => 'How to Measure Bangle Size at Home (4 Easy Methods)',
			'seo_desc'   => 'How to measure bangle size at home with a bangle, a thread, your hand width or your phone screen. Step-by-step with worked examples and a size chart.',
			'mode'       => null,
			'menu_order' => 10,
			'content'    => '
<p><strong>The easiest way to measure your bangle size at home is to measure the inside diameter of a bangle that already fits you.</strong> No bangle? Measure around your folded hand with a thread, divide by 3.14 and pick the next size up. Or let the <a href="/bangle-size-calculator/">bangle size calculator</a> do the maths, either from a bangle on your screen or from your hand measurement.</p>

<h2>What you are actually measuring</h2>
<p>A rigid bangle has no clasp, so it has to slide over your hand. The size that matters is therefore not your wrist but the widest part of your <em>folded</em> hand: thumb tucked into the palm, fingers pressed together, the way you naturally squeeze your hand when putting on a bangle. Indian bangle sizes describe the inside diameter in inches and sixteenths (2.4 = 2 4/16 in = 57.2 mm), so every method below ends with a diameter.</p>

<h2>Method 1: Measure a bangle you own (most accurate)</h2>
<ol>
<li>Pick a rigid bangle that goes on without soap but does not fall off.</li>
<li>Lay it flat on a ruler with mm markings.</li>
<li>Measure across the <strong>inside</strong> edge, through the centre. Turn it 90° and measure again; use the larger number.</li>
<li>Find the nearest size: 54 mm = 2.2, 57 mm = 2.4, 60 mm = 2.6, 63.5 mm = 2.8, 66.7 mm = 2.10.</li>
</ol>

<h2>Method 2: Thread or tape around your hand</h2>
<ol>
<li>Tuck your thumb into your palm and bring your fingers together.</li>
<li>Wrap a thread, ribbon, strip of paper or soft tape around the widest point – over the thumb knuckle and the base of the little finger.</li>
<li>Mark where it meets, lay it on a ruler, and note the length in cm.</li>
<li>Divide by 3.14 to get the diameter, then choose the <em>first size that is at least that wide</em>.</li>
</ol>
[rbs_diagram name="bangle-hand"]
<p><strong>Example:</strong> a hand of 18.4 cm ÷ 3.14 = 5.86 cm. Size 2.4 is 5.72 cm (too small) and 2.6 is 6.03 cm, so your size is 2.6. You can skip the maths by using the hand-circumference column on the <a href="/bangle-size-chart/in-cm/">bangle size in cm chart</a>.</p>

<h2>Method 3: By hand width</h2>
<p>Some guides say to measure the width of your hand across the knuckles. This is the least reliable method, because a hand is not round: it squeezes into an oval when you put on a bangle, so its flat width is larger than the bangle you need. If a ruler is all you have, measure across the knuckles with your thumb tucked in and fingers squeezed, then use the result only as a rough check. A folded hand width of about 7 cm usually corresponds to 2.4–2.6, and 8 cm to 2.8–2.10, but individual hands vary by a full size. Confirm with Method 2.</p>

<h2>Method 4: On your phone screen</h2>
<ol>
<li>Open the <a href="/bangle-size-calculator/">online bangle sizer</a>.</li>
<li>Calibrate once by matching a bank card to the outline (on a phone, hold the card upright and match its short side; on a computer, match its long side).</li>
<li>Place your bangle flat on the screen and move the slider until the circle meets the inside edge.</li>
<li>Read the size in Indian sizes, mm, cm and inches.</li>
</ol>
<p>This is as accurate as a ruler and avoids misreading the scale. It works on most phones; for bangles larger than 2.8 a tablet or laptop screen is easier.</p>

<h2>Prefer paper? Print a bangle sizer</h2>
<p>Print the free <a href="/printable-bangle-sizer/">printable bangle sizer</a> at 100%, check the 50 mm line with a ruler, then lay your bangle on the true-size circles for sizes 1.10 to 3.4. The sheet also has a string scale for your hand, so you can skip the division by 3.14.</p>

<h2>Common mistakes</h2>
<ul>
<li><strong>Measuring the wrist.</strong> Wrist size is for bracelets. A bangle must pass the hand, which is 3–5 cm larger.</li>
<li><strong>Measuring the outside of the bangle.</strong> Always the inside edge.</li>
<li><strong>Measuring with an open hand.</strong> Spread fingers add 1–2 cm; fold your hand as when wearing.</li>
<li><strong>Rounding down.</strong> Between two sizes, a rigid bangle must be the larger one.</li>
<li><strong>Measuring when cold.</strong> Hands are smaller in the morning and in winter; measure in the evening at room temperature.</li>
</ul>

<h2>Which size? Quick chart</h2>
<table class="rbs-table">
<thead><tr><th>Hand around knuckles</th><th>Bangle size</th></tr></thead>
<tbody>
<tr><td>16.0–17.0 cm (6.3–6.7 in)</td><td><a href="/bangle-size/2-2/">2.2</a></td></tr>
<tr><td>17.0–18.0 cm (6.7–7.1 in)</td><td><a href="/bangle-size/2-4/">2.4</a></td></tr>
<tr><td>18.0–18.9 cm (7.1–7.5 in)</td><td><a href="/bangle-size/2-6/">2.6</a></td></tr>
<tr><td>18.9–19.9 cm (7.5–7.9 in)</td><td><a href="/bangle-size/2-8/">2.8</a></td></tr>
<tr><td>19.9–21.0 cm (7.9–8.2 in)</td><td><a href="/bangle-size/2-10/">2.10</a></td></tr>
<tr><td>21.0–22.0 cm (8.2–8.6 in)</td><td><a href="/bangle-size/2-12/">2.12</a></td></tr>
</tbody>
</table>
<p>Measuring a child? See the <a href="/kids-bangle-size-chart/">kids bangle size chart</a>.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'How do I measure my bangle size at home?', 'Measure the inside diameter of a bangle that fits you, in mm, and match it to the chart. Without a bangle, measure around your folded hand with a thread, divide by 3.14 and choose the next size up.' ),
				array( 'How do I measure bangle size with a thread?', 'Tuck your thumb into your palm, wrap the thread around the widest part of the hand over the knuckles, mark it and measure the length in cm. 17–18 cm is size 2.4, 18–18.9 cm is 2.6, 18.9–19.9 cm is 2.8.' ),
				array( 'Can I measure bangle size by hand width?', 'Only roughly. The hand squeezes into an oval, so its flat width is larger than the bangle you need. Use a thread around the folded hand for a reliable result.' ),
				array( 'Is bangle size measured inside or outside?', 'Inside. Bangle sizes are the inner diameter, because that is the opening your hand passes through.' ),
				array( 'Should I measure my wrist for a bangle?', 'No. Wrist size is for bracelets with a clasp. A rigid bangle must pass over the hand, so measure the folded hand.' ),
			),
		),

		/* ------------------------------------------------------ KIDS CHART */
		'bangle-kids' => array(
			'slug'       => 'kids-bangle-size-chart',
			'title'      => 'Kids Bangle Size Chart by Age – Baby to Teen',
			'seo_title'  => 'Kids Bangle Size Chart by Age: Baby, Toddler and Child Sizes',
			'seo_desc'   => 'Baby and kids bangle size chart by age, from newborn (1.6) to teens (2.2–2.4), with diameter in mm and inches and safe sizing tips for children.',
			'mode'       => null,
			'menu_order' => 11,
			'content'    => '
<p><strong>Babies usually wear bangle sizes 1.6 to 1.10, toddlers 1.12 to 1.14, children aged 4–7 size 2.0, and older children 2.0 to 2.2.</strong> Teenagers move up to adult sizes 2.2–2.4. Because children grow quickly and hands vary, measure if you can – the <a href="/bangle-size-calculator/">bangle size calculator</a> works for children\'s hands too.</p>

<h2>Kids bangle size chart by age</h2>
<table class="rbs-table">
<thead><tr><th>Age</th><th>Usual size</th><th>Inner diameter</th><th>Inches</th></tr></thead>
<tbody>
<tr><td>0–6 months</td><td>1.6 – 1.8</td><td>34.9 – 38.1 mm</td><td>1⅜ – 1½ in</td></tr>
<tr><td>6–12 months</td><td>1.8 – 1.10</td><td>38.1 – 41.3 mm</td><td>1½ – 1⅝ in</td></tr>
<tr><td>1–2 years</td><td>1.10 – 1.12</td><td>41.3 – 44.5 mm</td><td>1⅝ – 1¾ in</td></tr>
<tr><td>2–4 years</td><td>1.12 – 1.14</td><td>44.5 – 47.6 mm</td><td>1¾ – 1⅞ in</td></tr>
<tr><td>4–7 years</td><td>1.14 – 2.0</td><td>47.6 – 50.8 mm</td><td>1⅞ – 2 in</td></tr>
<tr><td>7–10 years</td><td>2.0 – 2.2</td><td>50.8 – 54.0 mm</td><td>2 – 2⅛ in</td></tr>
<tr><td>10–14 years</td><td><a href="/bangle-size/2-2/">2.2</a></td><td>54.0 mm</td><td>2⅛ in</td></tr>
<tr><td>14+ years</td><td><a href="/bangle-size/2-2/">2.2</a> – <a href="/bangle-size/2-4/">2.4</a></td><td>54.0 – 57.2 mm</td><td>2⅛ – 2¼ in</td></tr>
</tbody>
</table>
<p>Ages are a guide only. A chubby 9-month-old may need a size bigger than a slim 1-year-old. When in doubt, choose the larger size for a growing child.</p>

<h2>What size will my child need next year?</h2>
<p>Buying gold that should last a few years? Pick your child\'s age and the size that fits now to see an estimate for the next three years. It follows the typical growth in the chart above, so treat it as a rough guide.</p>
[rbs_kids_growth]

<h2>How kids\' sizes are written</h2>
<p>Children\'s bangles use the same Indian system as adults: the first number is whole inches and the second is sixteenths. So 1.12 means 1 12/16 inches (1¾ in, 44.5 mm) and 2.0 means exactly 2 inches (50.8 mm). Sizes below 1.10 – often written 1.4, 1.6 and 1.8 – are made mainly for newborn ceremonies such as naming, aqiqah or annaprashan.</p>

<h2>How to measure a child for bangles</h2>
<ol>
<li>Gently fold the child\'s thumb into the palm and hold the fingers together.</li>
<li>Wrap a soft thread around the widest part of the hand, over the knuckles. Do not pull tight.</li>
<li>Measure the thread in cm and divide by 3.14. Choose the first size at least that wide.</li>
<li>For a squirming baby, measure a bangle or bracelet that already fits instead.</li>
</ol>
<p><strong>Example:</strong> a 3-year-old\'s hand measures 14.5 cm. 14.5 ÷ 3.14 = 4.62 cm, so 1.14 (4.76 cm) fits; 1.12 (4.45 cm) is too small.</p>
<p>Already have a bangle that fits? Lay it on your phone in the <a href="/bangle-size-calculator/">bangle sizer</a> for an instant size.</p>

<h2>Safety tips for baby and kids\' bangles</h2>
<ul>
<li>Choose smooth, rounded edges. Avoid glass bangles for babies and toddlers; they break and can cut.</li>
<li>Openable bangles with a screw or a hinge, or adjustable bangles, are safest for babies because they can be removed quickly if the hand swells.</li>
<li>A baby bangle should move freely but not slip off over the hand. You should be able to fit a little finger between bangle and wrist.</li>
<li>Remove bangles at bedtime and check regularly for tightness as the child grows.</li>
<li>Small beads, charms and bells are choking hazards for young children.</li>
</ul>

<h2>Buying as a gift</h2>
<p>For a newborn gift, 1.8 openable is the safest choice; for a first birthday, 1.10–1.12. Many families buy a slightly larger gold bangle so it can be worn for several years. For older children the adult <a href="/bangle-size-chart/">bangle size chart</a> starts at 2.2.</p>

[rbs_cta mode="bangle"]
',
			'faq' => array(
				array( 'What size bangle for a 1-year-old?', 'Most 1-year-olds wear size 1.10 to 1.12 (41.3 to 44.5 mm inner diameter). Openable bangles are safest at this age.' ),
				array( 'What is the bangle size for a newborn baby?', 'Newborn bangles are usually 1.6 to 1.8 (about 35 to 38 mm inner diameter).' ),
				array( 'What bangle size fits a 5-year-old?', 'Children aged 4 to 7 usually wear 1.14 to 2.0 (47.6 to 50.8 mm).' ),
				array( 'What bangle size for a 10-year-old girl?', 'Around size 2.0 to 2.2. Most girls reach 2.2 between 10 and 14 years old.' ),
				array( 'Are glass bangles safe for babies?', 'No. Glass can break and cut. Use smooth metal, silicone or openable bangles for babies and toddlers.' ),
			),
		),

		/* ------------------------------------------------------ CHUDI / KADA */
		'chudi' => array(
			'slug'       => 'chudi-size-chart',
			'title'      => 'Chudi Size Chart – Chudi, Kada and Kangan Sizes',
			'seo_title'  => 'Chudi Size Chart: Chudi, Kada and Kangan Sizes in mm',
			'seo_desc'   => 'Chudi, kada and kangan size chart with inner diameter in mm and inches, men\'s kada sizes, how width and thickness change fit, and how to measure.',
			'mode'       => null,
			'menu_order' => 12,
			'content'    => '
<p><strong>Chudi, kada and kangan all use the same Indian bangle sizes (2.2, 2.4, 2.6, 2.8, 2.10…), which give the inner diameter in inches and sixteenths.</strong> What changes is the fit: thin glass chudiyan slide on easily, while a thick kada or a wide kangan needs one size more. Find your base size with the <a href="/bangle-size-calculator/">bangle size calculator</a>, then adjust using the charts below.</p>

<h2>Chudi size chart</h2>
<p>Chudi (choodi, churi) are thin bangles, usually glass, lac or thin metal, worn in sets. Buy them in your exact size.</p>
<table class="rbs-table">
<thead><tr><th>Chudi size</th><th>Inner diameter</th><th>Inches</th><th>Usually for</th></tr></thead>
<tbody>
<tr><td><a href="/bangle-size/2-2/">2.2</a></td><td>54.0 mm</td><td>2⅛ in</td><td>Girls, petite women</td></tr>
<tr><td><a href="/bangle-size/2-4/">2.4</a></td><td>57.2 mm</td><td>2¼ in</td><td>Small adult hands</td></tr>
<tr><td><a href="/bangle-size/2-6/">2.6</a></td><td>60.3 mm</td><td>2⅜ in</td><td>Medium adult hands</td></tr>
<tr><td><a href="/bangle-size/2-8/">2.8</a></td><td>63.5 mm</td><td>2½ in</td><td>Large hands</td></tr>
<tr><td><a href="/bangle-size/2-10/">2.10</a></td><td>66.7 mm</td><td>2⅝ in</td><td>Extra-large hands</td></tr>
</tbody>
</table>

<h2>Kada size chart (men and women)</h2>
<p>A kada is a single thick bangle, often steel, silver or gold, worn by men and women; the Sikh kara is the best-known example. Because it is thick and cannot be rolled over the knuckles, choose by your hand measurement and the kada\'s width.</p>
<table class="rbs-table">
<thead><tr><th>Hand around knuckles</th><th>Thin kada (under 6 mm)</th><th>Wide or heavy kada (8 mm+)</th></tr></thead>
<tbody>
<tr><td>18.0–18.9 cm</td><td>2.6</td><td>2.8</td></tr>
<tr><td>18.9–19.9 cm</td><td>2.8</td><td>2.10</td></tr>
<tr><td>19.9–21.0 cm</td><td>2.10</td><td>2.12</td></tr>
<tr><td>21.0–22.0 cm</td><td><a href="/bangle-size/2-12/">2.12</a></td><td>2.14</td></tr>
<tr><td>22.0–22.9 cm</td><td>2.14</td><td>3.0</td></tr>
</tbody>
</table>
<p>Most men wear 2.10 or 2.12; most women\'s kadas are 2.6 or 2.8.</p>

<h2>Kangan size</h2>
<p>Kangan is a broad term for a decorative bangle, often wider and heavier than a chudi, sometimes openable with a screw (pech). For a rigid kangan up to 8 mm wide, buy your normal size. For wider, heavily carved or stone-set kangan, go one size up. For an openable kangan with a screw or hinge, your normal size or one size smaller gives a neat fit, because it does not have to pass over the hand.</p>

<h2>Why width and thickness matter</h2>
<p>The size number is only the inside diameter. A thin 3 mm chudi can be tilted and rolled over the knuckles, so it goes on even when the fit is close. A wide band stays flat against the hand and a thick one cannot flex, so the same diameter feels about one size smaller. That is why a person who wears 2.6 chudiyan often needs a 2.8 kada.</p>

<h2>Bridal chooda and sets</h2>
<p>Bridal chooda (red and white or red and gold sets) is bought in the bride\'s exact chudi size. The rigid glass or lac bangles still have to pass over the hand, and the shop helps roll them on with soap or a thin plastic bag. A smaller size risks cracked bangles or a hurt hand, so never size down a rigid chooda. Only an openable kangan with a screw or hinge can be one size smaller.</p>

<h2>How to find your chudi or kada size</h2>
<ol>
<li>Measure the inside of a chudi or kada that fits you, in mm, and use the charts above.</li>
<li>Or wrap a thread around your folded hand and match the length. Full steps are in <a href="/how-to-measure-bangle-size/">how to measure bangle size</a>.</li>
<li>Or place your bangle on your screen in the <a href="/bangle-size-calculator/">online bangle sizer</a>.</li>
</ol>

[rbs_cta mode="bangle"]

<p>See also: <a href="/bangle-size-chart/india/">bangle size chart India</a> and <a href="/kids-bangle-size-chart/">kids bangle sizes</a>.</p>
',
			'faq' => array(
				array( 'Are chudi and bangle sizes the same?', 'Yes. Chudi, kada and kangan use the same Indian sizes, which describe the inner diameter in inches and sixteenths.' ),
				array( 'What size kada should a man wear?', 'Most men wear a kada in size 2.10 or 2.12 (66.7 to 69.9 mm). For a wide or heavy kada, go one size larger than your thin-bangle size.' ),
				array( 'What is 2.6 kada size in mm?', 'A 2.6 kada has an inner diameter of 60.3 mm (2⅜ inches).' ),
				array( 'Should a kada be bigger than a bangle?', 'For a thick or wide kada, yes, usually one size bigger, because it cannot be rolled over the knuckles like a thin bangle.' ),
				array( 'What size chooda should a bride buy?', 'The bride\'s exact bangle size. A rigid chooda must pass over the hand, so a smaller size can crack or hurt. Measure a few weeks before the wedding.' ),
			),
		),

		/* -------------------------------------------------- PRINTABLE BANGLE SIZER */
		'bangle-printable' => array(
			'slug'       => 'printable-bangle-sizer',
			'title'      => 'Printable Bangle Sizer – Free PDF with True-Size Circles',
			'seo_title'  => 'Printable Bangle Sizer: Free PDF (A4 and US Letter)',
			'seo_desc'   => 'Free printable bangle sizer PDF: true-size circles for Indian bangle sizes 1.10 to 3.4, a hand string scale and a 50 mm check line. A4 and US Letter.',
			'mode'       => null,
			'menu_order' => 13,
			'content'    => <<<'HTML'
<p><strong>Print one page, check the scale, and find your bangle size on paper.</strong> The free PDF has true-size circles for every Indian bangle size from 2.2 to 3.4 (plus kids sizes 1.10 to 2.0), a string scale for measuring your hand, and a 50 mm check line with a bank-card box so you can confirm it printed at the right size. Choose US Letter or A4 to match your paper.</p>

[rbs_printable_sizer type="bangle"]

<p class="rbs-muted">The preview shows sizes 2.2 to 2.12 in millimetres. Screens are not true size, so measure on the printed sheet or use the <a href="/bangle-size-calculator/">on-screen bangle sizer</a>, which is calibrated with a bank card.</p>

<h2>Step 1: Print it at the right size</h2>
<p>A printable sizer only works if the printer does not shrink the page. Most printers default to "Fit to page", which scales everything down by 3–6%. On a bangle that is 2–4 mm, which is a whole bangle size.</p>
<ul>
<li><strong>Chrome or Edge:</strong> open the PDF, press Print, open "More settings" and set Scale to <em>Default</em> or <em>100</em>, not "Fit to printable area".</li>
<li><strong>Adobe Acrobat Reader:</strong> under Page Size &amp; Handling choose <em>Actual size</em>.</li>
<li><strong>Mac Preview:</strong> set Scale to 100% and untick "Scale to fit".</li>
<li><strong>Phone:</strong> printing straight from a phone often scales the page. If the check line is not 50 mm, print from a computer instead.</li>
</ul>

<h2>Step 2: Check the scale</h2>
<p>Put a ruler on the line at the top of the sheet. It must be exactly 50 mm (5 cm) long. Then lay a bank card, debit card or ID card in the dashed box: these cards are 85.6 × 54 mm worldwide, so the card should fit the outline exactly. If the line is short or the card overhangs the box, reprint at 100%. Do not try to correct it by eye.</p>

<h2>Step 3: Find your size</h2>
<h3>With a bangle that fits (most accurate)</h3>
<ol>
<li>Lay the bangle flat on the large set of circles, centred on the small cross.</li>
<li>Find the circle that sits exactly on the <em>inside</em> edge of the bangle. Ignore the outside edge and the width of the metal.</li>
<li>If the inside edge falls between two circles, choose the larger size.</li>
<li>For a child's bangle, use the smaller set of circles on the right (1.10 to 2.0).</li>
</ol>
<p>The sizes are the Indian and Pakistani inch-and-sixteenths sizes used by almost every bangle shop: 2.6 means 2 6/16 inches (60.3 mm) across the inside. The sheet also lists the inside diameter of every size in mm, so you can check a bangle with a ruler too.</p>

<h3>With a string around your hand (estimate)</h3>
<ol>
<li>Tuck your thumb into your palm, the way your hand folds when you slide on a bangle.</li>
<li>Wrap a string or thread around the widest part of the hand, over the knuckles, snug but not tight. Mark where it meets.</li>
<li>Fold the string in half and lay it on the scale at the bottom of the sheet, starting from 0.</li>
<li>Read the first bangle size mark at or after the end of the folded string. That is the smallest bangle that should pass over your hand.</li>
</ol>
<p>The scale works because a bangle has to be at least as wide as your hand's circumference divided by π (3.14). Folding the string in half keeps the scale short enough for one sheet. Hands are not round and soft tissue squeezes, so this method is an estimate. A bangle that already fits you, matched on the circles, gives a better answer.</p>

<h2>Glass, gold or kada: which size?</h2>
<ul>
<li><strong>Rigid gold, silver, glass or lac bangles:</strong> your exact size from the circles. They cannot open, so they must pass over the hand. Glass and lac bangles are often made 0.5–1 mm small, so if you are between two circles, take the larger one.</li>
<li><strong>Openable kangan with a screw or hinge:</strong> can be one size smaller, because it does not have to pass over the hand.</li>
<li><strong>Wide or heavy kada:</strong> go one size larger than your thin-bangle size.</li>
<li><strong>Bridal chooda:</strong> the bride's exact size, never smaller. Measure a few weeks before the wedding. Our <a href="/blog/bangle-size-for-wedding/">bridal bangle size guide</a> has the details.</li>
</ul>

<h2>How accurate is a printable bangle sizer?</h2>
<p>The circles in the PDF are vector lines drawn to 0.01 mm, so the limit is your printer and your eye. A correctly scaled print is usually within about 0.5 mm, well inside the 3.2 mm step between bangle sizes. Matching a bangle on the circles is more reliable than the string method. For a second opinion without paper, use the <a href="/bangle-size-calculator/">bangle size calculator</a>.</p>

<h2>Common mistakes</h2>
<ul>
<li><strong>Measuring the outside of the bangle.</strong> Only the inside edge matters.</li>
<li><strong>Skipping the scale check.</strong> A 5% shrink is hard to see but changes the result by a full size.</li>
<li><strong>Measuring the wrist instead of the hand.</strong> A closed bangle must pass over the folded hand, which is wider than the wrist.</li>
<li><strong>Pulling the string too tight.</strong> Keep it snug, like a bangle sliding on.</li>
</ul>

<h2>Prefer not to print?</h2>
<p>The <a href="/bangle-size-calculator/">online bangle sizer</a> draws the same true-size circles on your phone after a one-time card calibration, and it can also size a bangle from a photo. The <a href="/bangle-size-chart/">bangle size chart</a> lists every size in mm, cm and inches, and <a href="/how-to-measure-bangle-size/">how to measure bangle size</a> compares every method. Need a ring size too? Use the <a href="/printable-ring-sizer/">printable ring sizer</a>.</p>
HTML
			,
			'faq'        => array(
				array( 'How do I check my printable bangle sizer is the right size?', 'Print at 100% or "Actual size" and measure the check line with a ruler: it must be exactly 50 mm. A bank or ID card should also fit the dashed card outline exactly.' ),
				array( 'Can I print the bangle sizer on A4 paper?', 'Yes. Download the A4 version. The circles are the same size on both versions; only the page layout changes.' ),
				array( 'Which bangle sizes are on the sheet?', 'Indian and Pakistani sizes 2.2 to 3.4 for adults and 1.10 to 2.0 for children, with the inside diameter of each in mm.' ),
				array( 'Can I find my bangle size without a bangle?', 'Yes, with the string scale: wrap a string around your folded hand, fold it in half and read the size on the scale. It is an estimate, so matching a bangle that fits is more accurate.' ),
				array( 'Is a printable bangle sizer accurate?', 'When printed at 100% it is usually within about 0.5 mm, much less than the 3.2 mm step between bangle sizes. Always check the 50 mm line first.' ),
			),
		),
	);
}
