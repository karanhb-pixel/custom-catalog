<?php
/**
 * The main template file for blog posts
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
				<li class="breadcrumb-item">Blog</li>
			</ol>
		</nav>
	</div>
</section>

<!-- Blog Header -->
<section class="blog-header" style="padding: 3rem 0; background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);">
	<div class="container">
		<div style="text-align: center; max-width: 600px; margin: 0 auto;">
			<h1 style="font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 1rem;">Blog & Insights</h1>
			<p style="font-size: 1.1rem; color: #6b7280;">
				Stay updated with the latest trends in interior design, modular furniture, and space optimization.
			</p>
		</div>
	</div>
</section>

<!-- Blog Posts Grid -->
<section class="blog-posts" style="padding: 4rem 0;">
	<div class="container">
		<div class="grid grid-3" id="blogGrid">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="card blog-card">
						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'medium', array( 'alt' => get_the_title() ) ); ?>
							</a>
						<?php else : ?>
							<img src="https://placehold.co/600x400?text=Blog+Post" alt="<?php the_title(); ?>" />
						<?php endif; ?>
						<div class="card-body">
							<div class="blog-meta" style="font-size: 0.85rem; color: #6b7280; margin-bottom: 0.5rem;">
								<i class="fas fa-calendar"></i> <?php echo get_the_date(); ?>
								<?php if ( get_the_category() ) : ?>
									| <i class="fas fa-folder"></i> <?php the_category( ', ' ); ?>
								<?php endif; ?>
							</div>
							<h3 style="margin-bottom: 0.5rem;">
								<a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
									<?php the_title(); ?>
								</a>
							</h3>
							<p style="color: #6b7280; margin-bottom: 1rem;">
								<?php echo wp_trim_words( get_the_excerpt(), 20 ); ?>
							</p>
							<a href="<?php the_permalink(); ?>" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
								Read More <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			<?php else : ?>
				<!-- Default blog posts if no content -->
				<article class="card blog-card">
					<img src="https://placehold.co/600x400?text=Blog+Post+1" alt="Blog Post 1" />
					<div class="card-body">
						<div class="blog-meta" style="font-size: 0.85rem; color: #6b7280; margin-bottom: 0.5rem;">
							<i class="fas fa-calendar"></i> Dec 9, 2025 | <i class="fas fa-folder"></i> Design Tips
						</div>
						<h3>10 Modern Office Design Trends for 2025</h3>
						<p style="color: #6b7280; margin-bottom: 1rem;">
							Discover the latest trends shaping modern office spaces and how they can boost productivity.
						</p>
						<a href="#" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
							Read More <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
						</a>
					</div>
				</article>

				<article class="card blog-card">
					<img src="https://placehold.co/600x400?text=Blog+Post+2" alt="Blog Post 2" />
					<div class="card-body">
						<div class="blog-meta" style="font-size: 0.85rem; color: #6b7280; margin-bottom: 0.5rem;">
							<i class="fas fa-calendar"></i> Dec 7, 2025 | <i class="fas fa-folder"></i> Modular Furniture
						</div>
						<h3>Maximizing Space with Modular Kitchen Solutions</h3>
						<p style="color: #6b7280; margin-bottom: 1rem;">
							Learn how modular kitchen designs can transform your cooking space into a functional masterpiece.
						</p>
						<a href="#" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
							Read More <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
						</a>
					</div>
				</article>

				<article class="card blog-card">
					<img src="https://placehold.co/600x400?text=Blog+Post+3" alt="Blog Post 3" />
					<div class="card-body">
						<div class="blog-meta" style="font-size: 0.85rem; color: #6b7280; margin-bottom: 0.5rem;">
							<i class="fas fa-calendar"></i> Dec 5, 2025 | <i class="fas fa-folder"></i> Wardrobes
						</div>
						<h3>Smart Storage Solutions for Modern Wardrobes</h3>
						<p style="color: #6b7280; margin-bottom: 1rem;">
							Explore innovative storage ideas that maximize space while keeping your wardrobe organized.
						</p>
						<a href="#" class="btn btn-outline" style="font-size: 0.85rem; padding: 0.5rem 1rem;">
							Read More <i class="fas fa-arrow-right" style="margin-left: 0.5rem;"></i>
						</a>
					</div>
				</article>
			<?php endif; ?>
		</div>

		<!-- Pagination -->
		<?php if ( have_posts() ) : ?>
			<div style="text-align: center; margin-top: 3rem;">
				<?php
				echo paginate_links( array(
					'prev_text' => '<i class="fas fa-chevron-left"></i> Previous',
					'next_text' => 'Next <i class="fas fa-chevron-right"></i>',
				) );
				?>
			</div>
		<?php endif; ?>
	</div>
</section>

<!-- Newsletter Signup -->
<section class="newsletter" style="padding: 4rem 0; background: linear-gradient(135deg, #111827 0%, #1f2937 100%); color: white;">
	<div class="container" style="text-align: center;">
		<h2 style="margin-bottom: 1rem;">Stay Updated</h2>
		<p style="margin-bottom: 2rem; opacity: 0.9;">Subscribe to our newsletter for design tips and project updates.</p>
		<form class="newsletter-form" style="display: flex; gap: 1rem; max-width: 400px; margin: 0 auto; flex-wrap: wrap;">
			<input type="email" placeholder="Enter your email" required 
				style="flex: 1; padding: 0.75rem 1rem; border: none; border-radius: 6px; min-width: 200px;">
			<button type="submit" class="btn btn-primary">Subscribe</button>
		</form>
	</div>
</section>

<?php
get_footer();