<?php
/**
 * The template for displaying the footer
 *
 * @package Custom-Catalog
 */
?>

</div><!-- #content -->

<footer class="site-footer">
	<div class="container footer-inner">
		<p>© <span id="year"></span> MR Furniture – Demo Catalog Website.</p>
		<div class="footer-links">
			<a href="#hero"><?php esc_html_e('Home', 'custom-catalog'); ?></a>
			<a href="#services"><?php esc_html_e('Services', 'custom-catalog'); ?></a>
			<a href="#projects"><?php esc_html_e('Projects', 'custom-catalog'); ?></a>
			<a href="#contact"><?php esc_html_e('Contact', 'custom-catalog'); ?></a>
		</div>
	</div>
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
	// Mobile nav toggle
	(function () {
		const navToggle = document.querySelector('.nav-toggle');
		const navLinks = document.querySelector('.nav-links');

		if (!navToggle || !navLinks) return;

		navToggle.addEventListener('click', function () {
			const isOpen = navLinks.classList.toggle('nav-open');
			navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		});

		// Close menu on link click (mobile UX)
		navLinks.querySelectorAll('a').forEach(function (link) {
			link.addEventListener('click', function () {
				if (navLinks.classList.contains('nav-open')) {
					navLinks.classList.remove('nav-open');
					navToggle.setAttribute('aria-expanded', 'false');
				}
			});
		});
	})();

	// Dynamic year in footer
	(function () {
		var yearSpan = document.getElementById('year');
		if (yearSpan) {
			yearSpan.textContent = new Date().getFullYear();
		}
	})();
</script>
<script>
	document.addEventListener("DOMContentLoaded", function () {
		const cards = document.querySelectorAll('.project-card');

		const observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				if (entry.isIntersecting) {
					entry.target.classList.add('visible');
				}
			});
		}, { threshold: 0.2 });

		cards.forEach(card => observer.observe(card));
	});
</script>

</body>

</html>