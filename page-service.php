<?php
/**
 * Template for individual service pages
 *
 * @package Custom-Catalog
 */

get_header();
?>

<!-- Breadcrumbs -->
<section class="breadcrumbs">
	<div class="container">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb-list">
				<li class="breadcrumb-item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
				<li class="breadcrumb-item"><a href="#services">Services</a></li>
				<li class="breadcrumb-item"><?php the_title(); ?></li>
			</ol>
		</nav>
	</div>
</section>

<!-- Service Hero -->
<section class="service-hero" style="padding: 4rem 0; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
	<div class="container">
		<div style="text-align: center; max-width: 800px; margin: 0 auto;">
			<h1 style="font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1rem; color: #111827;">
				<?php the_title(); ?>
			</h1>
			<p style="font-size: 1.1rem; color: #6b7280; margin-bottom: 2rem;">
				<?php 
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						echo get_the_content();
					endwhile;
				endif;
				?>
			</p>
			<div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
				<a href="#contact" class="btn btn-primary">Get Free Quote</a>
				<a href="#portfolio" class="btn btn-outline">View Portfolio</a>
			</div>
		</div>
	</div>
</section>

<!-- Service Features -->
<section class="service-features" style="padding: 4rem 0;">
	<div class="container">
		<div class="grid grid-3">
			<div class="card" style="text-align: center; padding: 2rem;">
				<i class="fas fa-award" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
				<h3>Premium Quality</h3>
				<p>High-grade materials and superior craftsmanship in every project.</p>
			</div>
			<div class="card" style="text-align: center; padding: 2rem;">
				<i class="fas fa-clock" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
				<h3>Timely Delivery</h3>
				<p>On-time project completion with regular progress updates.</p>
			</div>
			<div class="card" style="text-align: center; padding: 2rem;">
				<i class="fas fa-tools" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
				<h3>Expert Installation</h3>
				<p>Professional installation by skilled technicians and designers.</p>
			</div>
		</div>
	</div>
</section>

<!-- Process Steps -->
<section class="process-steps" style="padding: 4rem 0; background: #f8fafc;">
	<div class="container">
		<header class="section-header">
			<h2>Our Process</h2>
			<p>How we bring your vision to life</p>
		</header>
		<div class="grid grid-4">
			<div style="text-align: center;">
				<div style="width: 60px; height: 60px; background: #f97316; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">1</div>
				<h4>Consultation</h4>
				<p>Initial meeting to understand your requirements and preferences.</p>
			</div>
			<div style="text-align: center;">
				<div style="width: 60px; height: 60px; background: #f97316; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">2</div>
				<h4>Design & Planning</h4>
				<p>Creating detailed designs and 3D visualizations of your space.</p>
			</div>
			<div style="text-align: center;">
				<div style="width: 60px; height: 60px; background: #f97316; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">3</div>
				<h4>Manufacturing</h4>
				<p>Precision manufacturing using modern equipment and techniques.</p>
			</div>
			<div style="text-align: center;">
				<div style="width: 60px; height: 60px; background: #f97316; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; font-weight: bold;">4</div>
				<h4>Installation</h4>
				<p>Professional installation with quality checks and final touches.</p>
			</div>
		</div>
	</div>
</section>

<!-- Related Projects -->
<section id="portfolio" class="section">
	<div class="container">
		<header class="section-header">
			<h2>Related Projects</h2>
			<p>See our work in action</p>
		</header>
		<div class="grid grid-3">
			<!-- Sample related projects -->
			<article class="card">
				<img src="https://placehold.co/600x400?text=Project+1" alt="Project 1" />
				<div class="card-body">
					<h3>Modern Office Setup</h3>
					<p>Complete office interior with modular workstations and meeting rooms.</p>
				</div>
			</article>
			<article class="card">
				<img src="https://placehold.co/600x400?text=Project+2" alt="Project 2" />
				<div class="card-body">
					<h3>Corporate Headquarters</h3>
					<p>Large-scale corporate interior with executive spaces and collaboration areas.</p>
				</div>
			</article>
			<article class="card">
				<img src="https://placehold.co/600x400?text=Project+3" alt="Project 3" />
				<div class="card-body">
					<h3>Startup Workspace</h3>
					<p>Innovative workspace design for a growing technology startup.</p>
				</div>
			</article>
		</div>
	</div>
</section>

<!-- CTA Section -->
<section id="contact" class="section" style="background: linear-gradient(135deg, #111827 0%, #1f2937 100%); color: white;">
	<div class="container" style="text-align: center;">
		<h2>Ready to Get Started?</h2>
		<p style="font-size: 1.1rem; margin-bottom: 2rem; opacity: 0.9;">Contact us today for a free consultation and quote.</p>
		<div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
			<a href="tel:+918047674202" class="btn btn-primary">Call Now</a>
			<a href="mailto:info@mrfurniture.com" class="btn btn-outline">Email Us</a>
		</div>
	</div>
</section>

<?php
get_footer();