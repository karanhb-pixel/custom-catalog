<?php
/**
 * Single Project Template
 *
 * Displays details of a single Project (CPT: project)
 *
 * @package Custom-Catalog
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()):
        the_post();

        $services = get_the_terms(get_the_ID(), 'service');
        $service_names = array();

        if (!is_wp_error($services) && !empty($services)) {
            foreach ($services as $service) {
                $service_names[] = $service->name;
            }
        }
        ?>

        <!-- Project Hero / Banner -->
        <section class="hero small-hero project-hero">
            <div class="hero-overlay"></div>

            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('full', array('class' => 'hero-bg')); ?>
            <?php else: ?>
                <img src="https://placehold.co/1600x400?text=Project+Image" class="hero-bg"
                    alt="<?php the_title_attribute(); ?>" />
            <?php endif; ?>

            <div class="container hero-content">
                <p class="hero-kicker">
                    <?php
                    if (!empty($service_names)) {
                        echo esc_html(implode(' · ', $service_names));
                    } else {
                        echo 'Interior Project';
                    }
                    ?>
                </p>
                <h1><?php the_title(); ?></h1>
            </div>
        </section>

        <?php cc_breadcrumbs(); ?>

        <!-- Project Content -->
        <section class="section section-light">
            <div class="container project-single-grid">

                <div class="project-main">

    <h2>Project Overview</h2>
    <div class="project-content">
        <?php the_content(); ?>
    </div>

    <?php
    $gallery = get_field('gallery_images');
    if ($gallery):
    ?>
        <h2 style="margin-top:2.5rem;">Project Gallery</h2>

        <div class="swiper project-gallery-slider">
            <div class="swiper-wrapper">
                <?php foreach ($gallery as $image): ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($image['url']); ?>"
                             alt="<?php echo esc_attr($image['alt'] ?? ''); ?>"
                             onerror="this.src='https://placehold.co/800x500?text=Image+Not+Found'; this.onerror=null;">
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    <?php endif; ?>

</div> <!-- END project-main -->


                    <script>
           // Wait for both DOM and window load to ensure everything is ready
           window.addEventListener('load', function() {
               console.log("Window loaded, initializing swiper...");

               // Check if Swiper is available
               if (typeof Swiper === 'undefined') {
                   console.error("Swiper is not loaded!");
                   return;
               }

               const slider = document.querySelector(".project-gallery-slider");
               if (!slider) {
                   console.log("No slider found");
                   return;
               }

               const wrapper = slider.querySelector(".swiper-wrapper");
               const slides = wrapper ? wrapper.querySelectorAll(".swiper-slide") : [];
               const slideCount = slides.length;

               console.log("Slides found:", slideCount);
               console.log("Slides:", slides);

               // Check if we have multiple slides
               if (slideCount <= 1) {
                   console.log("Only one slide, no need for navigation");
                   return;
               }

               // Initialize Swiper with comprehensive configuration
               const swiper = new Swiper(slider, {
                   loop: true,
                   slidesPerView: 1,
                   spaceBetween: 20,
                   autoHeight: true,
                   speed: 800,

                   // Enable both pagination and navigation
                   pagination: {
                       el: slider.querySelector(".swiper-pagination"),
                       clickable: true,
                   },

                   navigation: {
                       nextEl: slider.querySelector(".swiper-button-next"),
                       prevEl: slider.querySelector(".swiper-button-prev"),
                   },

                   // Debug events
                   on: {
                       init: function() {
                           console.log("Swiper initialized successfully");
                       },
                       slideChange: function() {
                           console.log("Slide changed to index:", this.realIndex);
                       },
                       click: function(e) {
                           console.log("Swiper clicked:", e);
                       }
                   }
               });

               console.log("Swiper instance:", swiper);

               // Handle image loading
               const images = slider.querySelectorAll("img");
               let loadedImages = 0;

               function checkAllImagesLoaded() {
                   loadedImages++;
                   console.log("Image loaded:", loadedImages, "/", images.length);

                   if (loadedImages === images.length) {
                       setTimeout(() => {
                           console.log("All images loaded, updating swiper");
                           if (swiper && !swiper.destroyed) {
                               swiper.update();
                               swiper.slideTo(0); // Reset to first slide
                           }
                       }, 300);
                   }
               }

               images.forEach((img, index) => {
                   console.log("Setting up image", index, ":", img.src);

                   // Handle successful load
                   img.addEventListener("load", checkAllImagesLoaded);

                   // Handle errors
                   img.addEventListener("error", function() {
                       console.error("Image failed to load:", this.src);
                       this.src = 'https://placehold.co/800x500?text=Image+Error';
                       checkAllImagesLoaded();
                   });

                   // If image is already cached, trigger load event manually
                   if (img.complete && img.naturalHeight !== 0) {
                       console.log("Image", index, "already cached");
                       checkAllImagesLoaded();
                   }
               });

               // Force a reflow to ensure everything is rendered
               setTimeout(() => {
                   if (swiper && !swiper.destroyed) {
                       swiper.update();
                       console.log("Forced swiper update after timeout");
                   }
               }, 500);

               // Expose swiper to global scope for debugging
               window.projectGallerySwiper = swiper;
           });
           </script>


               



                <aside class="project-sidebar">
                    <div class="project-meta-card">
                        <h3>Project Details</h3>
                        <ul>
                            <?php if (!empty($service_names)): ?>
                                <li><strong>Service:</strong> <?php echo esc_html(implode(', ', $service_names)); ?></li>
                            <?php endif; ?>

                            <li><strong>Date:</strong> <?php echo get_the_date(); ?></li>
                            <li><strong>Project ID:</strong> #<?php echo esc_html(get_the_ID()); ?></li>
                        </ul>
                    </div>

                    <a href="<?php echo esc_url(get_post_type_archive_link('project')); ?>"
                        class="btn btn-primary project-back-btn">
                        ← Back to All Projects
                    </a>

                    <?php if (!empty($services)): ?>
                        <div class="project-meta-card">
                            <h3>More in this Service</h3>
                            <ul class="project-service-links">
                                <?php foreach ($services as $service): ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_term_link($service)); ?>">
                                            <?php echo esc_html($service->name); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </aside>

            </div>
        </section>

        <!-- Related Projects (same service) -->
        <?php
        if (!empty($services)):
            $service_ids = wp_list_pluck($services, 'term_id');

            $related_args = array(
                'post_type' => 'project',
                'posts_per_page' => 3,
                'post__not_in' => array(get_the_ID()),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'service',
                        'field' => 'term_id',
                        'terms' => $service_ids,
                    ),
                ),
            );

            $related_query = new WP_Query($related_args);

            if ($related_query->have_posts()):
                ?>
                <section class="section">
                    <div class="container">
                        <header class="section-header">
                            <h2>Related Projects</h2>
                            <p>More work from the same service category.</p>
                        </header>

                        <div class="grid grid-3">
                            <?php
                            while ($related_query->have_posts()):
                                $related_query->the_post();
                                ?>
                                <article class="card project-card project-item">
                                    <div class="project-image-wrapper">
                                        <?php
                                        $related_services = get_the_terms(get_the_ID(), 'service');
                                        if (!is_wp_error($related_services) && !empty($related_services)):
                                            $first_service = $related_services[0];
                                            ?>
                                            <span class="badge badge-top-left">
                                                <?php echo esc_html($first_service->name); ?>
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
                                        <p><?php echo wp_trim_words(get_the_content(), 15); ?></p>
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top:10px;">
                                            View Project
                                        </a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </section>
                <?php
            endif;
            wp_reset_postdata();
        endif;
        ?>

    <?php endwhile; // End of the loop. ?>

</main><!-- #primary -->

<?php
get_footer();
