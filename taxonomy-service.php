<?php
/**
 * Template for Service Taxonomy Archive
 * Shows all Projects under a specific Service
 *
 * @package Custom-Catalog
 */

get_header();

$service = get_queried_object();

// Fetch ACF image for this service term
$service_image = get_field('service_image', 'service_' . $service->term_id);
$hero_src = $service_image ? $service_image['url'] : 'https://placehold.co/1600x400?text=' . urlencode($service->name);
?>

<section class="hero small-hero">
    <div class="hero-overlay"></div>

    <img
        src="<?php echo esc_url($hero_src); ?>"
        class="hero-bg"
        alt="<?php echo esc_attr($service->name); ?>"
    />

    <div class="container hero-content">
        <h1><?php echo esc_html($service->name); ?></h1>
        <?php if (!empty($service->description)) : ?>
            <p class="hero-subtitle"><?php echo esc_html($service->description); ?></p>
        <?php endif; ?>
    </div>
</section>

<?php cc_breadcrumbs(); ?>

<section class="section section-light">
    <div class="container">
        <header class="section-header">
            <h2><?php echo esc_html($service->name); ?> Projects</h2>
            <p>Explore completed work for this interior service category.</p>
        </header>

        <div class="grid grid-3">

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>

                    <article class="card project-card project-item">
                        <div class="project-image-wrapper">
                            <span class="badge badge-top-left">
                                <?php echo esc_html($service->name); ?>
                            </span>

                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <img src="https://placehold.co/800x500?text=No+Image" alt="">
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <h3><?php the_title(); ?></h3>
                            <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top:10px;">
                                View Project
                            </a>
                        </div>
                    </article>

                <?php endwhile; ?>
            <?php else : ?>

                <p style="text-align:center;">No projects found in this service.</p>

            <?php endif; ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>
