<?php
/**
 * Custom-Catalog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Custom-Catalog
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function custom_catalog_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Custom-Catalog, use a find and replace
		* to change 'custom-catalog' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'custom-catalog', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'custom-catalog' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'custom_catalog_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'custom_catalog_setup' );

/**
 * Add SEO meta description for archive pages
 */
function cc_seo_meta_description() {
    if (is_post_type_archive('project')) {
        $description = 'Explore our portfolio of interior design projects including modular kitchens, wardrobes, and complete home interiors by MR Furniture.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}
add_action( 'wp_head', 'cc_seo_meta_description' );

/**
 * Optimize images by serving scaled versions
 * Replace full size images with large size where appropriate
 */
function cc_optimize_image_sizes($html, $post_id, $post_image_id) {
    // Only optimize for project post type
    if (get_post_type($post_id) === 'project') {
        // Replace 'full' size with 'large' size in image HTML
        $html = str_replace('size-full', 'size-large', $html);
    }
    return $html;
}
add_filter('post_thumbnail_html', 'cc_optimize_image_sizes', 10, 3);

/**
 * Add admin notice for caching plugin recommendation
 */
function cc_caching_plugin_recommendation() {
    // Only show on production environments, not local
    if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'local') {
        return;
    }
    
    // Check if caching plugins are already active
    $active_plugins = get_option('active_plugins');
    $cache_plugins = array('wp-super-cache/wp-cache.php', 'w3-total-cache/w3-total-cache.php', 'wp-rocket/wp-rocket.php', 'cache-enabler/cache-enabler.php');
    
    $has_cache_plugin = false;
    foreach ($cache_plugins as $plugin) {
        if (in_array($plugin, $active_plugins)) {
            $has_cache_plugin = true;
            break;
        }
    }
    
    if (!$has_cache_plugin && current_user_can('install_plugins')) {
        echo '<div class="notice notice-warning is-dismissible">
            <p><strong>Performance Recommendation:</strong> To improve your site speed, consider installing a caching plugin like WP Super Cache, W3 Total Cache, or WP Rocket. This is especially important for shared hosting environments like InfinityFree.</p>
        </div>';
    }
}
add_action('admin_notices', 'cc_caching_plugin_recommendation');

/**
 * Enqueue lightbox assets for project gallery
 */
function cc_enqueue_lightbox_assets() {
    if (is_singular('project')) {
        // Add lightbox CSS
        wp_enqueue_style('cc-lightbox', get_template_directory_uri() . '/css/lightbox.css');
        
        // Add lightbox JS
        wp_enqueue_script('cc-lightbox', get_template_directory_uri() . '/js/lightbox.js', array('jquery'), _S_VERSION, true);
    }
}
add_action('wp_enqueue_scripts', 'cc_enqueue_lightbox_assets');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_catalog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'custom_catalog_content_width', 640 );
}
add_action( 'after_setup_theme', 'custom_catalog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_catalog_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'custom-catalog' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'custom-catalog' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'custom_catalog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function custom_catalog_scripts() {
	wp_enqueue_style( 'custom-catalog-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'custom-catalog-style', 'rtl', 'replace' );

	wp_enqueue_script( 'custom-catalog-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'custom_catalog_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function cc_enqueue_swiper_assets() {
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'cc_enqueue_swiper_assets');

/**
 * ACF Options Page for Site Settings
 */
if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
        'page_title'    => 'Site Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'site-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
}

/**
 * ACF Contact Settings Field Group
 */
if( function_exists('acf_add_local_field_group') ) {
    acf_add_local_field_group(array(
        'key' => 'group_contact_settings',
        'title' => 'Contact Settings',
        'fields' => array(
            array(
                'key' => 'field_contact_phone',
                'label' => 'Primary Phone',
                'name' => 'contact_phone',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '+91-9876543210',
            ),
            array(
                'key' => 'field_contact_email',
                'label' => 'Contact Email',
                'name' => 'contact_email',
                'type' => 'email',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'contact@yourcompany.com',
            ),
            array(
                'key' => 'field_contact_address',
                'label' => 'Office Address',
                'name' => 'contact_address',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => 'Your office address',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_contact_whatsapp',
                'label' => 'WhatsApp Number',
                'name' => 'contact_whatsapp',
                'type' => 'text',
                'instructions' => 'Number only or full international format.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '+919876543210',
            ),
            array(
                'key' => 'field_contact_form_shortcode',
                'label' => 'Contact Form Shortcode',
                'name' => 'contact_form_shortcode',
                'type' => 'text',
                'instructions' => 'Paste a CF7 / Fluent Forms shortcode here, e.g. [contact-form-7 id="123"]',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placeholder' => '[contact-form-7 id="123"]',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'site-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
}

function cc_breadcrumbs() {
    if (is_front_page()) {
        return;
    }

    echo '<nav class="cc-breadcrumbs" aria-label="Breadcrumbs">';
    echo '<a href="' . esc_url(home_url('/')) . '">Home</a>';

    if (is_post_type_archive('project')) {
        echo ' <span class="sep">/</span> ';
        echo '<span>Projects</span>';

    } elseif (is_singular('project')) {
        // Single Project
        $services = get_the_terms(get_the_ID(), 'service');

        echo ' <span class="sep">/</span> ';
        echo '<a href="' . esc_url(get_post_type_archive_link('project')) . '">Projects</a>';

        if (!empty($services) && !is_wp_error($services)) {
            $service = $services[0];

            echo ' <span class="sep">/</span> ';
            echo '<a href="' . esc_url(get_term_link($service)) . '">' . esc_html($service->name) . '</a>';
        }

        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html(get_the_title()) . '</span>';

    } elseif (is_tax('service')) {
        // Service archive
        $service = get_queried_object();

        echo ' <span class="sep">/</span> ';
        echo '<a href="' . esc_url(get_post_type_archive_link('project')) . '">Projects</a>';

        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html($service->name) . '</span>';

    } elseif (is_page()) {
        // Generic page fallback
        echo ' <span class="sep">/</span> ';
        echo '<span>' . esc_html(get_the_title()) . '</span>';
    }

    echo '</nav>';
}
