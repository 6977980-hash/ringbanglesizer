/* Chart tables: swipe hint, tap a row to highlight it, "find your size" box.
   Printed inline by inc/engage.php on pages that have a chart. */
(function () {
	function norm(t) {
		return String(t).toLowerCase()
			.replace(/\s*1\/2/g, '.5').replace(/\s*1\/4/g, '.25').replace(/\s*3\/4/g, '.75')
			.replace(/½/g, '.5').replace(/¼/g, '.25').replace(/¾/g, '.75')
			.replace(/^(us|uk|eu|size|india|indian size)\s+/, '')
			.replace(/\s+/g, '').replace(/mm$|cm$/, '');
	}
	function same(a, b) {
		if (a === b) { return true; }
		var x = parseFloat(a), y = parseFloat(b);
		return /^\d+(\.\d+)?$/.test(a) && /^\d+(\.\d+)?$/.test(b) && x === y && a.split('.')[1] !== '10' && b.split('.')[1] !== '10';
	}
	document.querySelectorAll('.rbs-tw').forEach(function (tw) {
		var wrap = tw.querySelector('.rbs-table-wrap'), table = wrap.querySelector('table');
		var rows = table.tBodies[0] ? Array.prototype.slice.call(table.tBodies[0].rows) : [];

		function overflow() { tw.classList.toggle('rbs-scrolls', wrap.scrollWidth > wrap.clientWidth + 4); }
		overflow();
		window.addEventListener('resize', overflow);
		wrap.addEventListener('scroll', function () { if (wrap.scrollLeft > 10) { tw.classList.add('rbs-swiped'); } }, { passive: true });

		table.addEventListener('click', function (e) {
			var tr = e.target.closest('tbody tr');
			if (tr && !e.target.closest('a')) { tr.classList.toggle('rbs-hl'); }
		});

		var input = tw.querySelector('.rbs-find-in'), msg = tw.querySelector('.rbs-find-msg'), timer;
		if (!input) { return; }
		function find(scroll) {
			var q = norm(input.value);
			rows.forEach(function (r) { r.classList.remove('rbs-hit'); });
			msg.textContent = '';
			if (!q) { return; }
			var first = rows.filter(function (r) { return r.cells[0] && same(norm(r.cells[0].textContent), q); });
			var hits = first.length ? first : rows.filter(function (r) {
				return Array.prototype.some.call(r.cells, function (c) { return same(norm(c.textContent), q); });
			});
			if (!hits.length) { msg.textContent = 'No exact match. Type the size as it is written in the chart.'; return; }
			hits.forEach(function (r) { r.classList.add('rbs-hit'); });
			if (scroll) {
				wrap.scrollLeft = 0;
				hits[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
			}
		}
		input.addEventListener('input', function () {
			find(false);
			clearTimeout(timer);
			timer = setTimeout(function () { find(true); }, 700);
		});
		input.addEventListener('keydown', function (e) {
			if (e.key === 'Enter') { e.preventDefault(); clearTimeout(timer); find(true); input.blur(); }
		});
	});
})();
