<?php
/**
 * Legal and trust pages. Same format as inc/page-content.php.
 * Legal pages are noindex,follow and have no editorial box; About, Contact and
 * How We Measure stay indexable (they carry the E-E-A-T signals).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function rbs_legal_pages() {
	$updated = 'November 6, 2026';

	return array(

		/* ------------------------------------------------------------ ABOUT */
		'about' => array(
			'slug'       => 'about',
			'title'      => 'About Ring Bangle Sizer',
			'seo_title'  => 'About Ring Bangle Sizer – Free Ring and Bangle Size Tools',
			'seo_desc'   => 'Who runs Ring Bangle Sizer, why we built free on-screen ring and bangle sizers, where our size data comes from and how to reach us.',
			'mode'       => null,
			'menu_order' => 50,
			'content'    => '
<p><strong>Ring Bangle Sizer is a free, independent website that helps you find your ring, bangle and bracelet size at home.</strong> Our tools draw true-to-size circles on your phone or computer screen, so you can check a ring or bangle you already own against the standard size charts without buying a sizer kit or visiting a jeweller.</p>

<h2>Who runs Ring Bangle Sizer</h2>
<p>Ring Bangle Sizer was founded by <strong>Ali Ahmad</strong> (<a href="https://www.linkedin.com/in/ali-ahmad-chaudhry-12777486/" rel="noopener" target="_blank">LinkedIn</a>), who builds free, practical web tools for everyday measuring problems. Ali writes, checks and updates every tool and guide on the site. You can reach Ali at [rbs_email].</p>

<h2>Why we built it</h2>
<p>Buying a ring or a set of bangles online usually ends with the same question: which size do I order? Most size charts online are copied from each other, give only one system (US letters or Indian numbers, never both), and do not explain what the numbers actually mean. People in the US, UK, India and Pakistan also use completely different sizing systems for the same piece of jewellery. We wanted one place that shows every system side by side, explains the maths, and lets you measure on the screen you are already holding.</p>

<h2>What you will find here</h2>
<ul>
<li><a href="/">Online ring sizer</a> – match a ring on your screen and read US, UK, EU, Indian and mm sizes.</li>
<li><a href="/bangle-size-calculator/">Bangle size calculator</a> – Indian sizes 1.10 to 3.4 from a bangle you own or a hand measurement.</li>
<li><a href="/bracelet-size-calculator/">Bracelet size calculator</a> – chain, bangle and cuff lengths from your wrist size.</li>
<li>Size charts and single-size guides such as <a href="/bangle-size/2-6/">bangle size 2.6</a> and <a href="/ring-size-in-mm/size-7/">ring size 7 in mm</a>.</li>
</ul>

<h2>Where our numbers come from</h2>
<p>Ring diameters follow ISO 8653, the international standard that defines ring size as the inner circumference in millimetres. US, UK and Indian sizes are mapped to those diameters using the conversion tables jewellers use. Indian bangle sizes follow the traditional inch-and-sixteenths system, where 2.6 means 2 6/16 inches across the inside. Screen calibration uses the ISO/IEC 7810 ID-1 card size (85.60 × 53.98 mm) shared by every bank card. The full method, including rounding rules and known limits, is on our <a href="/how-we-measure/">how we measure</a> page.</p>

<h2>Our editorial rules</h2>
<ul>
<li>Every page is written by founder Ali Ahmad and checked against the standards listed in its sources box. We do not publish auto-generated size pages.</li>
<li>Numbers on the page are produced from one shared data file, so a chart and a size guide can never disagree.</li>
<li>When a size is a judgement call (for example a hand between two bangle sizes) we say so and explain both options.</li>
<li>We correct mistakes quickly. If you spot one, <a href="/contact/">tell us</a> and we will fix it and update the date on the page.</li>
</ul>

<h2>How the site is funded</h2>
<p>The tools are free and need no sign-up. In future the site may show advertising and may include affiliate links to jewellery shops; any such link will be disclosed as explained in our <a href="/affiliate-disclosure/">affiliate disclosure</a>. Advertisers and shops never decide which sizes or products we recommend.</p>

<h2>Contact</h2>
<p>Questions, corrections or a size you cannot find? E-mail [rbs_email] or use the <a href="/contact/">contact page</a>.</p>
',
			'faq' => array(
				array( 'Is Ring Bangle Sizer free to use?', 'Yes. All tools and charts are free, need no account and work in any modern browser.' ),
				array( 'Do you sell rings or bangles?', 'No. We only provide sizing tools and guides. Buy from any jeweller or shop and use our tools to choose the size.' ),
				array( 'Who runs Ring Bangle Sizer?', 'The site was founded and is run by Ali Ahmad, who writes and checks every page. Every guide is based on published sizing standards and the conversion maths is shown on the page.' ),
				array( 'How can I report a wrong size?', 'Use the contact page and tell us the page and the size. We check it against the standard and correct the page if needed.' ),
			),
		),

		/* ------------------------------------------------------- HOW WE MEASURE */
		'method' => array(
			'slug'       => 'how-we-measure',
			'title'      => 'How We Measure: Our Ring and Bangle Sizing Method',
			'seo_title'  => 'How We Measure – Ring Bangle Sizer Method and Accuracy',
			'seo_desc'   => 'The standards, formulas and rounding rules behind our on-screen ring and bangle sizers, how screen calibration works and how accurate the results are.',
			'mode'       => null,
			'menu_order' => 51,
			'content'    => '
<p><strong>This page explains exactly how our sizers turn a circle on your screen into a ring or bangle size,</strong> which standards the numbers come from, and how accurate you can expect the result to be.</p>

<h2>1. Screen calibration</h2>
<p>Screens have different pixel densities, so a circle drawn "50 pixels wide" is a different real size on every phone. To draw true-size circles we need the number of pixels per millimetre on your screen. Every credit, debit and ID card is made to the ISO/IEC 7810 ID-1 standard: 85.60 mm wide and 53.98 mm tall. On a computer you match the card\'s long side, so the tool divides the outline width in pixels by 85.60. Phone screens are narrower than a card, so on any screen narrower than 480 CSS pixels the card is held upright and you match its short side; the tool then divides by 53.98. You can also calibrate with a coin of known diameter: India ₹10 (27 mm), Pakistan Rs 10 (25.5 mm), US quarter (24.26 mm), UK 10p (24.5 mm) or €2 (25.75 mm). Pick your coin from the list in the tool. A card is more accurate because it is larger. The result is stored in your browser (local storage key <code>rbs_ppm_v1</code>). Nothing is sent to our server.</p>
<p>Without calibration the tool starts from a guess and marks every result as approximate, because browsers do not report the real screen size. On narrow screens (phones) the guess is 6 CSS pixels per mm, which is close to most current phones; on wider screens it is the CSS standard of 96 pixels per inch (3.78 px/mm). Either guess can be off by a size or more, so calibrate before you rely on the number.</p>

<h2>2. Ring sizes</h2>
<p>ISO 8653 defines a ring size as the inner circumference in millimetres. We store the inner diameter for each US size from 3 to 15 in half steps (for example US 7 = 17.3 mm) and calculate everything else from it:</p>
<ul>
<li><strong>Circumference</strong> = diameter × π (US 7: 17.3 × 3.1416 = 54.3 mm).</li>
<li><strong>EU / ISO size</strong> = circumference rounded to the nearest mm (54).</li>
<li><strong>Italian / Spanish / Swiss size</strong> = EU size − 40 (14).</li>
<li><strong>India / Pakistan size</strong> = inner circumference − 40 mm, rounded (54.3 − 40 = 14). This is the scale Indian jewellers such as Tanishq and BlueStone print (India 22 = 62 mm around = US 10).</li>
<li><strong>UK / Australian letters</strong> are taken from the standard US-to-UK conversion table, because the letter scale does not follow a single formula.</li>
</ul>
<p>The full table is on the <a href="/ring-size-chart/">ring size chart</a> and the <a href="/ring-size-in-mm/">ring size in mm</a> page.</p>

<h2>3. Bangle sizes</h2>
<p>Indian and Pakistani bangle sizes are written as inches and sixteenths of an inch of inner diameter. "2.4" means 2 + 4/16 = 2.25 inches; "2.10" means 2 + 10/16 = 2.625 inches. We convert to millimetres with 1 inch = 25.4 mm, so 2.4 = 57.2 mm and 2.10 = 66.7 mm. Adult sizes step by 2/16 inch (3.2 mm).</p>
<p>For the hand method, the calculator divides your hand circumference (measured over the knuckles with the thumb tucked in) by π to get the smallest opening your hand can pass through, then picks the <em>first bangle size that is at least that wide</em>. Rounding up is deliberate: a rigid bangle that is 1 mm too small will not go on at all. Hands are not round and soft tissue squeezes, so the hand method is an estimate. Matching a bangle that already fits is the more accurate method, and the calculator offers it first.</p>

<h2>4. Bracelet lengths</h2>
<p>Bracelet length = wrist circumference + an ease allowance that depends on the style: ½ to 1¼ inch for chain bracelets, ¼ to ¾ inch for open cuffs. The allowances match the ranges most jewellers publish for snug, comfortable and loose fits.</p>

<h2>5. How accurate is it?</h2>
<p>After calibration the circle is drawn to the nearest physical pixel. On a typical phone (about 16 physical pixels per mm) that is better than 0.1 mm, far finer than the 0.4 mm between half ring sizes or the 3.2 mm between bangle sizes. In practice the limit is how well the card and the ring are lined up by eye. The tool is therefore <strong>designed for</strong> the following accuracy; we will replace these design targets with measured results once the test in section 6 is published:</p>
<ul>
<li><strong>Rings:</strong> designed to land within about ±¼ US size of a caliper measurement. Measure twice, with two rings if you can.</li>
<li><strong>Bangles:</strong> designed to be right to one size; if you are between sizes, choose the larger for a rigid bangle.</li>
</ul>

<h2>6. Real-world accuracy test</h2>
<p>We are testing the sizer on several phones and laptops against rings and bangles measured with a digital vernier caliper. The results, with photos and the size each device reported, will be published in this section once testing is complete. Until then, treat every on-screen result as a strong estimate and confirm it with a jeweller or the seller\'s own chart before buying an expensive piece.</p>

<h2>7. Known limits</h2>
<ul>
<li>Some phones apply display scaling or zoom that changes after calibration. If you zoom the page, calibrate again.</li>
<li>Thick or comfort-fit bands fit tighter than their inner diameter suggests; go up ¼–½ size for bands wider than 6 mm.</li>
<li>Bangle sizes vary slightly between makers. Glass bangles are often made a little smaller than metal ones of the same number.</li>
</ul>
<p>Found a problem? Please <a href="/contact/">contact us</a>.</p>
',
			'faq' => array(
				array( 'Why do I need a credit card to calibrate?', 'All bank cards are the same ID-1 size, 85.60 × 53.98 mm, so matching one on the screen tells the tool how many pixels make a millimetre on your device. On a phone, hold the card upright and match its short side; on a computer, match its long side. You can use any ID-1 card, including a library card or ID card.' ),
				array( 'Is my calibration or measurement uploaded?', 'No photos, names or calibration values ever leave your device, and the sizing happens in your browser. Once you settle on a result, the size it shows (for example US 7 or bangle 2.6) is counted anonymously in Google Analytics, so we can see which sizes people need. Names you type are never sent.' ),
				array( 'How accurate is an on-screen ring sizer?', 'After calibration the circle is drawn to about 0.1 mm. Lining up the ring by eye is the real limit, so the tool is designed to land within about a quarter US size. Our device test results will be published on this page; until then, confirm expensive purchases with a jeweller.' ),
				array( 'Which standard do you use for ring sizes?', 'ISO 8653, which defines ring size as the inner circumference in millimetres. Other systems are converted from the inner diameter.' ),
			),
		),

		/* ---------------------------------------------------------- CONTACT */
		'contact' => array(
			'slug'       => 'contact',
			'title'      => 'Contact Ring Bangle Sizer',
			'seo_title'  => 'Contact Us – Ring Bangle Sizer',
			'seo_desc'   => 'Contact the Ring Bangle Sizer team with questions, size corrections, tool problems or partnership requests. We usually reply within two working days.',
			'mode'       => null,
			'menu_order' => 52,
			'content'    => '
<p><strong>Have a question about your size, found a mistake, or the sizer is not working on your device?</strong> Send us a message and we will usually reply within two working days.</p>

[rbs_contact]

<h2>Before you write</h2>
<ul>
<li><strong>Tool problem:</strong> tell us your phone or computer model and browser (for example "Samsung A54, Chrome"). Most problems are fixed by calibrating again after changing the page zoom.</li>
<li><strong>Wrong size on a page:</strong> include the page address and the size you think is wrong.</li>
<li><strong>Which size to buy:</strong> tell us what you measured (ring inner diameter in mm, or hand circumference in cm) and the shop\'s size chart if you have it.</li>
</ul>

<h2>Who you are writing to</h2>
<p>Messages go straight to founder Ali Ahmad (<a href="https://www.linkedin.com/in/ali-ahmad-chaudhry-12777486/" rel="noopener" target="_blank">LinkedIn</a>). E-mail: [rbs_email].</p>

<h2>What we cannot help with</h2>
<p>We do not sell jewellery, so we cannot help with orders, deliveries or returns from a shop. Please contact the seller for those.</p>

<p>Your message is used only to reply to you. See our <a href="/privacy-policy/">privacy policy</a> for details.</p>
',
			'faq' => array(),
		),

		/* ---------------------------------------------------------- PRIVACY */
		'privacy' => array(
			'slug'       => 'privacy-policy',
			'title'      => 'Privacy Policy',
			'seo_title'  => 'Privacy Policy – Ring Bangle Sizer',
			'seo_desc'   => 'How Ring Bangle Sizer handles your data: on-device sizing, cookies, analytics, advertising partners including Google, your rights and how to contact us.',
			'mode'       => null,
			'noindex'    => true,
			'author_box' => false,
			'menu_order' => 60,
			'content'    => '
<p><em>Last updated: November 7, 2026</em></p>
<p>This privacy policy explains what information ringbanglesizer.com ("Ring Bangle Sizer", "we", "us") collects when you use the website, how it is used and the choices you have.</p>

<h2>1. The sizing tools run on your device</h2>
<p>The ring, bangle and bracelet sizers work in your browser. The screen calibration value (a single number, pixels per millimetre) is saved in your browser\'s local storage under the key <code>rbs_ppm_v1</code> so you do not have to calibrate again. Sizes you choose to save, with the name you type for them, are kept only in local storage (<code>rbs_people_v1</code>), and the name you type for a WhatsApp "ask for a size" link is remembered there too (<code>rbs_ask_name_v1</code>). None of these are sent to us. You can delete them at any time by clearing your browser\'s site data.</p>
<p>To learn which sizes people need, the sizer sends an anonymous event to Google Analytics (see section 3) when you settle on a result: the size shown (for example "US 7" or "2.6"), its inside diameter in mm, how it was measured (matched on screen, typed, or from the hand) and whether the screen was calibrated. It also records which result buttons were used (save, size card, share, ask link). Names and anything else you type are never included. We may publish totals from these events, such as the most common sizes by country; we never publish anything about an individual visitor.</p>

<h2>2. Information collected automatically</h2>
<p>Like almost every website, our hosting provider and content delivery network receive technical data when your browser requests a page: IP address, browser type, device type, referring page, the page requested and the date and time. This data is kept in server logs for security, to prevent abuse and to fix errors, and is deleted on a rolling basis. Our CDN may set a strictly necessary security cookie to tell real visitors from bots.</p>

<h2>3. Analytics (Google Analytics and Google Tag Manager)</h2>
<p>We use Google Analytics 4, a web analytics service provided by Google LLC / Google Ireland Limited, to understand which pages and tools are used, so we can improve them. Google Analytics is loaded through Google Tag Manager, a Google tool that loads tags such as Google Analytics on our pages. Tag Manager itself does not set cookies or store personal data, but it does load scripts from Google\'s servers, so Google receives your IP address and browser details in that request.</p>
<p>Google Analytics collects information such as the pages you view, how long you stay, the links and tools you use, the page that referred you, approximate location (country and city), and device, browser and operating system. It uses first-party cookies (<code>_ga</code> and <code>_ga_&lt;ID&gt;</code>, which last up to 2 years) to tell new visitors from returning ones. Google Analytics 4 does not log or store IP addresses; they are used only briefly to estimate location and then discarded. We do not send your name, e-mail address or any sizing measurements to Google Analytics, and we do not use it to identify you personally. Google keeps the data for a limited retention period set in our account (at most 14 months) and processes it under its own <a href="https://policies.google.com/privacy" rel="nofollow noopener" target="_blank">privacy policy</a>; see also <a href="https://policies.google.com/technologies/partner-sites" rel="nofollow noopener" target="_blank">how Google uses data from sites that use its services</a>.</p>
<p>How to opt out of Google Analytics:</p>
<ul>
<li>Install the <a href="https://tools.google.com/dlpage/gaoptout" rel="nofollow noopener" target="_blank">Google Analytics opt-out browser add-on</a>.</li>
<li>Block or delete cookies for this site in your browser settings, or use your browser\'s tracking protection or a content blocker. The sizing tools keep working without cookies.</li>
</ul>
<p>We do not show a cookie consent banner at the moment, because we do not run advertising yet. Before we show ads, we will add a consent tool so that visitors in the European Economic Area, the UK and Switzerland can accept or refuse analytics and advertising cookies, and this policy will be updated.</p>

<h2>4. Advertising</h2>
<p>This website may display advertising served by Google AdSense or other advertising partners.</p>
<ul>
<li>Third-party vendors, including Google, use cookies to serve ads based on your prior visits to this website or other websites.</li>
<li>Google\'s use of advertising cookies enables it and its partners to serve ads to you based on your visits to this site and/or other sites on the Internet.</li>
<li>You may opt out of personalised advertising by visiting <a href="https://adssettings.google.com" rel="nofollow noopener" target="_blank">Google Ads Settings</a>. You can also opt out of some third-party vendors\' use of cookies for personalised advertising at <a href="https://www.aboutads.info/choices/" rel="nofollow noopener" target="_blank">www.aboutads.info</a> or, in the EU/UK, <a href="https://www.youronlinechoices.eu/" rel="nofollow noopener" target="_blank">www.youronlinechoices.eu</a>.</li>
<li>Learn how Google uses information from sites that use its services: <a href="https://policies.google.com/technologies/partner-sites" rel="nofollow noopener" target="_blank">policies.google.com/technologies/partner-sites</a>.</li>
</ul>
<p>No ads are shown on the site at the moment. If we start showing ads, visitors in the European Economic Area, the UK and Switzerland will be asked for consent through a certified consent management platform before personalised ads are used. If you do not consent, any ads shown will be non-personalised.</p>

<h2>5. Cookies and local storage</h2>
<table class="rbs-table">
<thead><tr><th>Name / type</th><th>Purpose</th><th>Category</th></tr></thead>
<tbody>
<tr><td><code>rbs_ppm_v1</code> (local storage)</td><td>Remembers your screen calibration</td><td>Functional, stays on your device</td></tr>
<tr><td><code>rbs_people_v1</code>, <code>rbs_ask_name_v1</code> (local storage)</td><td>Sizes you saved and your name for ask links</td><td>Functional, stays on your device</td></tr>
<tr><td>CDN security cookie</td><td>Bot and abuse protection</td><td>Strictly necessary</td></tr>
<tr><td><code>_ga</code>, <code>_ga_&lt;ID&gt;</code> (Google Analytics, up to 2 years)</td><td>Visitor statistics: tells new and returning visitors apart</td><td>Analytics</td></tr>
<tr><td>Advertising cookies (e.g. Google)</td><td>Showing and measuring ads (only once ads are added)</td><td>Marketing, with consent where required</td></tr>
</tbody>
</table>
<p>You can block or delete cookies at any time in your browser settings. When we add a consent tool, it will also include a link to change your choices.</p>

<h2>6. Contact form and e-mail</h2>
<p>If you contact us, we receive your name, e-mail address and message. We use them only to reply and keep the conversation for up to 24 months, unless you ask us to delete it sooner. We do not add you to any mailing list.</p>

<h2>7. Affiliate links</h2>
<p>Some pages may contain links to shops. If a link is an affiliate link, the shop may use a cookie to record that you came from our site so we can earn a commission. See our <a href="/affiliate-disclosure/">affiliate disclosure</a>.</p>

<h2>8. Legal bases and your rights</h2>
<p>If you are in the EEA, UK or Switzerland, we process data on the basis of our legitimate interest in running, securing and improving the website (including analytics, which you can opt out of as described in section 3), and on your consent for personalised advertising once ads are added. You have the right to access, correct or delete your personal data, to object to or restrict processing, to data portability, to withdraw consent at any time, and to complain to your local data protection authority.</p>
<p>If you are a California resident, you have the right to know what personal information is collected, to request deletion, to correct it, and to opt out of the "sale" or "sharing" of personal information for cross-context behavioural advertising. We do not sell personal information for money. To exercise any right, contact us using the details below.</p>

<h2>9. Children</h2>
<p>This website is intended for a general audience and is not directed at children under 13. We do not knowingly collect personal information from children. Our kids\' bangle size guide is written for parents.</p>

<h2>10. International transfers and retention</h2>
<p>Our service providers (hosting, CDN, analytics and advertising partners) may process data outside your country, including in the United States, under their own safeguards such as standard contractual clauses. We keep personal data only as long as needed for the purposes above.</p>

<h2>11. Changes to this policy</h2>
<p>We will update this page if our practices change and revise the date at the top.</p>

<h2>12. Contact</h2>
<p>Questions about privacy: [rbs_email] or our <a href="/contact/">contact page</a>.</p>
',
			'faq' => array(),
		),

		/* ------------------------------------------------------------ TERMS */
		'terms' => array(
			'slug'       => 'terms',
			'title'      => 'Terms of Use',
			'seo_title'  => 'Terms of Use – Ring Bangle Sizer',
			'seo_desc'   => 'The terms that apply when you use ringbanglesizer.com, its free ring, bangle and bracelet sizing tools, size charts and guides.',
			'mode'       => null,
			'noindex'    => true,
			'author_box' => false,
			'menu_order' => 61,
			'content'    => '
<p><em>Last updated: ' . $updated . '</em></p>
<p>By using ringbanglesizer.com (the "site") you agree to these terms. If you do not agree, please do not use the site.</p>

<h2>1. What the site provides</h2>
<p>The site offers free tools, charts and guides to help you estimate ring, bangle and bracelet sizes. They are provided for general information only. We do not sell jewellery and are not responsible for orders you place with any shop.</p>

<h2>2. Estimates, not guarantees</h2>
<p>Sizes from the tools depend on correct screen calibration, how carefully you line up a ring or bangle, the accuracy of measurements you enter, and differences between manufacturers. Results are estimates. Before buying, especially for engraved, resized or non-returnable items, confirm the size with the seller or a jeweller. See our <a href="/disclaimer/">disclaimer</a>.</p>

<h2>3. Acceptable use</h2>
<ul>
<li>Do not use the site for any unlawful purpose or in a way that could damage, overload or impair it.</li>
<li>Do not scrape, copy or republish our pages or charts in bulk, or frame the tools on another website, without written permission.</li>
<li>Do not try to gain unauthorised access to the site, its server or related systems.</li>
</ul>

<h2>4. Intellectual property</h2>
<p>The text, tool code, charts, graphics and design of the site belong to Ring Bangle Sizer unless stated otherwise. You may print or save pages for your own personal, non-commercial use and share links to them. Size standards themselves (such as ISO 8653) belong to their publishers.</p>

<h2>5. Third-party links and ads</h2>
<p>The site may contain links to other websites and may display ads. We do not control and are not responsible for the content, products or privacy practices of other sites. Some links may be affiliate links; see our <a href="/affiliate-disclosure/">affiliate disclosure</a>.</p>

<h2>6. No warranty</h2>
<p>The site and tools are provided "as is" and "as available" without warranties of any kind, express or implied, including fitness for a particular purpose and accuracy. We do not guarantee that the site will be uninterrupted or error-free.</p>

<h2>7. Limitation of liability</h2>
<p>To the fullest extent allowed by law, Ring Bangle Sizer is not liable for any indirect, incidental or consequential loss, or for costs of resizing, returns, exchanges or lost purchases, arising from your use of the site or reliance on any size it shows. Nothing in these terms limits liability that cannot be limited by law.</p>

<h2>8. Privacy</h2>
<p>Our <a href="/privacy-policy/">privacy policy</a> explains how we handle information.</p>

<h2>9. Changes</h2>
<p>We may update these terms from time to time. The date at the top shows the latest version. Continued use of the site after a change means you accept the updated terms.</p>

<h2>10. Contact</h2>
<p>Questions about these terms: [rbs_email].</p>
',
			'faq' => array(),
		),

		/* ------------------------------------------------------- DISCLAIMER */
		'disclaimer' => array(
			'slug'       => 'disclaimer',
			'title'      => 'Disclaimer',
			'seo_title'  => 'Disclaimer – Ring Bangle Sizer Size Estimates',
			'seo_desc'   => 'Sizes from Ring Bangle Sizer tools and charts are estimates. Read the limits of on-screen sizing and why you should confirm with the seller before buying.',
			'mode'       => null,
			'noindex'    => true,
			'author_box' => false,
			'menu_order' => 62,
			'content'    => '
<p><em>Last updated: ' . $updated . '</em></p>

<h2>Sizes are estimates</h2>
<p>The ring, bangle and bracelet sizes shown by our tools, charts and guides are <strong>estimates</strong> intended to help you choose a size. They are not a professional fitting. Accuracy depends on:</p>
<ul>
<li>calibrating the screen correctly with a standard ID-1 card (on a phone, match the card\'s short side; on a computer, its long side), and calibrating again if you change zoom or device;</li>
<li>how precisely you line up a ring or bangle with the circle on screen;</li>
<li>the accuracy of any hand, finger or wrist measurement you enter;</li>
<li>the band width, profile and material of the piece (wide or comfort-fit rings, and thick kadas, fit tighter);</li>
<li>differences between manufacturers and countries, some of which do not follow the standard sizes exactly;</li>
<li>temperature and time of day, which change finger and hand size.</li>
</ul>

<h2>Confirm before you buy</h2>
<p>Always check the seller\'s own size chart, and for engagement rings, wedding bands, bridal bangle sets, engraved or custom pieces, confirm the size with a jeweller or a physical ring or bangle sizer before ordering. Ring Bangle Sizer is not responsible for resizing costs, returns or purchases made using our estimates.</p>

<h2>No professional advice</h2>
<p>Content on this site is general information, not professional jewellery, medical or legal advice. If a ring is stuck or a bangle cannot be removed, or if swelling or pain is involved, seek help from a jeweller or a medical professional.</p>

<h2>External links and ads</h2>
<p>We are not responsible for the content of external websites linked from our pages or for products advertised on the site. Some links may be affiliate links; see our <a href="/affiliate-disclosure/">affiliate disclosure</a>.</p>

<h2>Errors</h2>
<p>We check our data against published standards, but mistakes can happen. If you find one, please <a href="/contact/">let us know</a>.</p>
',
			'faq' => array(),
		),

		/* ------------------------------------------------ AFFILIATE DISCLOSURE */
		'affiliate' => array(
			'slug'       => 'affiliate-disclosure',
			'title'      => 'Affiliate Disclosure',
			'seo_title'  => 'Affiliate Disclosure – Ring Bangle Sizer',
			'seo_desc'   => 'How Ring Bangle Sizer may earn money from affiliate links and ads, and how we keep size recommendations independent of any shop or brand.',
			'mode'       => null,
			'noindex'    => true,
			'author_box' => false,
			'menu_order' => 63,
			'content'    => '
<p><em>Last updated: ' . $updated . '</em></p>
<p>Ring Bangle Sizer is free to use. To keep it that way, some pages may contain affiliate links and the site may display advertising.</p>

<h2>What an affiliate link is</h2>
<p>An affiliate link is a link to a shop that includes a tracking code. If you click it and buy something, the shop may pay us a small commission. The price you pay is the same as going to the shop directly.</p>

<h2>How we disclose them</h2>
<ul>
<li>Pages that contain affiliate links say so near the top of the page or next to the link.</li>
<li>Affiliate links are marked with <code>rel="sponsored"</code> so search engines can identify them.</li>
<li>We never hide affiliate links inside size charts or tool results.</li>
</ul>

<h2>Our independence</h2>
<p>Size information on this site comes from published standards and our own method, explained on <a href="/how-we-measure/">how we measure</a>. No shop, brand or advertiser pays to change a size, a chart or a recommendation. We do not accept paid reviews.</p>

<h2>Advertising</h2>
<p>Ads, if shown, are provided by third-party networks such as Google AdSense and are labelled as advertisements. We do not choose individual ads and do not endorse the products advertised. See our <a href="/privacy-policy/">privacy policy</a> for how ad cookies work and how to opt out.</p>

<h2>Questions</h2>
<p>Contact us at [rbs_email].</p>
',
			'faq' => array(),
		),
	);
}
