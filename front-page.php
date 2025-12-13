<?php
/**
 * The front page template file
 *
 * @package Custom-Catalog
 */

get_header();
?>

<main id="primary" class="site-main">

	<!-- HERO -->
	<section id="hero" class="hero">
		<div class="hero-overlay"></div>
		<img src="https://placehold.co/1600x700?text=Interior+Hero+Image" alt="Modern interior design hero placeholder"
			class="hero-bg" />
		<div class="container hero-content">
			<p class="hero-kicker">Interior Designing &amp; Modular Furniture</p>
			<h1>Transforming Spaces.<br>Crafting Futures.</h1>
			<p class="hero-subtitle">
				Demo catalog for MR Furniture showcasing interior design, modular kitchens, wardrobes and more.
			</p>
			<div class="hero-actions">
				<a href="#projects" class="btn btn-primary">View Catalog</a>
				<a href="#contact" class="btn btn-outline">Request Free Consultation</a>
			</div>
		</div>
	</section>

	<!-- SERVICES / CATEGORIES -->
	<section id="services" class="section section-light">
		<div class="container">
			<header class="section-header">
				<h2>Modular Furniture &amp; Interior Services</h2>
				<p>Explore the key service categories offered by MR Furniture.</p>
			</header>


			<div class="grid grid-4">

				<?php
				$services = get_terms(array(
					'taxonomy' => 'service',
					'hide_empty' => false,
				));

				if (!empty($services) && !is_wp_error($services)):
					foreach ($services as $service):

						// Optional: Add default placeholder images for each service
						$image = get_field('service_image', 'service_' . $service->term_id);
$image_url = $image ? $image['url'] : "https://placehold.co/600x400?text=" . urlencode($service->name);
						?>

						<a href="<?php echo esc_url(get_term_link($service)); ?>" class="card service-card">
							<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($service->name); ?>">
							<div class="card-body">
								<h3><?php echo esc_html($service->name); ?></h3>

								<?php if (!empty($service->description)): ?>
									<p><?php echo esc_html(wp_trim_words($service->description, 20)); ?></p>
								<?php else: ?>
									<p>Explore our work in <?php echo esc_html($service->name); ?>.</p>
								<?php endif; ?>
							</div>
						</a>

						<?php
					endforeach;
				else:
					echo "<p>No services found.</p>";
				endif;
				?>

			</div>

	</section>

	<!-- PROJECT CATALOG -->
	<section id="projects" class="section">
		<div class="container">
			<header class="section-header">
				<h2>Latest Creations (Demo Catalog)</h2>
				<p>Sample projects to demonstrate how the portfolio grid will look.</p>
			</header>
			<?php
			$services = get_terms(array(
				'taxonomy' => 'service',
				'hide_empty' => false,
			));

			$current_service = get_queried_object();
			?>

			<div class="service-tabs">

				<a href="<?php echo home_url('/projects/'); ?>"
					class="service-tab <?php echo (is_post_type_archive('project')) ? 'active' : ''; ?>">
					All
				</a>

				<?php foreach ($services as $service): ?>
					<a href="<?php echo esc_url(get_term_link($service)); ?>"
						class="service-tab <?php echo (isset($current_service->term_id) && $current_service->term_id === $service->term_id) ? 'active' : ''; ?>">
						<?php echo esc_html($service->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

			<div class="grid grid-3">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$projects = new WP_Query(array(
					'post_type' => 'project',
					'posts_per_page' => 6,
					'paged' => $paged,
					'order' => 'DESC',
				));

				?>

				<?php if ($projects->have_posts()): ?>
					<?php while ($projects->have_posts()):
						$projects->the_post(); ?>

						<article class="card project-card project-item">
							<div class="project-image-wrapper">

								<?php
								$services = get_the_terms(get_the_ID(), 'service');
								if (!empty($services) && !is_wp_error($services)):
									$service_name = $services[0]->name;
									?>
									<span class="badge badge-top-left">
										<?php echo esc_html($service_name); ?>
									</span>
								<?php endif; ?>

								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('large'); ?>
								<?php else: ?>
									<img src="https://placehold.co/800x500?text=No+Image" alt="">
								<?php endif; ?>
							</div>

							<div class="card-body">
								<h3><?php the_title(); ?></h3>
								<p><?php echo wp_trim_words(get_the_content(), 20); ?></p>

								<a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top:10px;">
									View Project
								</a>
							</div>
						</article>

					<?php endwhile;
					?>
					<div class="catalog-pagination">
						<?php
						echo paginate_links(array(
							'total' => $projects->max_num_pages,
							'current' => $paged,
							'prev_text' => '← Prev',
							'next_text' => 'Next →'
						));
						?>
					</div>

				<?php else: ?>
					<p style="grid-column: 1 / -1; text-align:center;">No projects found.</p>
				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>
		</div>
	</section>

	<!-- ABOUT / FACTS -->
	<section id="about" class="section section-light">
		<div class="container about-grid">
			<div>
				<h2>About MR Furniture</h2>
				<p>
					MR Furniture is an interior design and furniture manufacturer based in Pardi, Gujarat.
					Since 2017 the brand has been delivering office, residential and commercial interiors with
					a focus on practical layouts and contemporary styling.
				</p>
				<p>
					This demo page uses placeholder images and text so you can visualize how your future catalog
					website could look before adding real projects and content.
				</p>
			</div>

			<div class="about-facts">
				<h3>Key Facts</h3>
				<ul>
					<li><strong>Year of Establishment:</strong> 2017</li>
					<li><strong>Nature of Business:</strong> Manufacturer &amp; Interior Designer</li>
					<li><strong>Team Size:</strong> Approx. 51–100 people</li>
					<li><strong>Location:</strong> Pardi, Gujarat, India</li>
				</ul>
			</div>
		</div>
	</section>

	<!-- CONTACT -->
	<section id="contact" class="section">
		<div class="container contact-grid">
			<div>
				<h2>Request a Free Consultation</h2>
				<p>Use the form below to share your project details and we'll get back to you.</p>

				<?php
				$form_shortcode = get_field('contact_form_shortcode', 'option');

				if ($form_shortcode) {
					echo do_shortcode($form_shortcode);
				} else {
					?>
					<form class="contact-form">
						<div class="form-row">
							<label for="name">Full Name</label>
							<input id="name" type="text" placeholder="Enter your name" required />
						</div>
						<div class="form-row">
							<label for="phone">Phone Number</label>
							<input id="phone" type="tel" placeholder="Enter your phone number" required />
						</div>
						<div class="form-row">
							<label for="email">Email Address</label>
							<input id="email" type="email" placeholder="Enter your email" />
						</div>
						<div class="form-row">
							<label for="message">Project Details</label>
							<textarea id="message" rows="4" placeholder="Share requirements, area (sq.ft), city, etc."></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit Enquiry</button>
					</form>
					<?php
				}
				?>
			</div>

			<div class="contact-details">
				<h3>Contact Details</h3>
				<ul>
					<?php if ($phone = get_field('contact_phone', 'option')) : ?>
						<li><strong>Phone:</strong> <?php echo esc_html($phone); ?></li>
					<?php endif; ?>

					<?php if ($whatsapp = get_field('contact_whatsapp', 'option')) : ?>
						<li>
							<strong>WhatsApp:</strong>
							<a href="https://wa.me/<?php echo preg_replace('/\D+/', '', $whatsapp); ?>" target="_blank" rel="noopener">
								<?php echo esc_html($whatsapp); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ($email = get_field('contact_email', 'option')) : ?>
						<li>
							<strong>Email:</strong>
							<a href="mailto:<?php echo esc_attr($email); ?>">
								<?php echo esc_html($email); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ($address = get_field('contact_address', 'option')) : ?>
						<li><strong>Address:</strong> <?php echo nl2br(esc_html($address)); ?></li>
					<?php endif; ?>
				</ul>

				<div class="contact-note">
					All contact details above are managed from the Site Settings (ACF Options) panel.
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();
