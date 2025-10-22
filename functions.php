<?php
// Enqueue styles and scripts
function womenfirst_scripts()
{
    // Main CSS
    wp_enqueue_style('womenfirst-style', get_stylesheet_uri());

    // Custom CSS
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/assets/custom.css', array(), '1.0.0');

    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=Lora:wght@400;500;600&display=swap');

    // JavaScript
    wp_enqueue_script('womenfirst-script', get_template_directory_uri() . '/assets/script.js', array('jquery'), '1.0.0', true);

    // AJAX support
    if (!is_admin()) {
        wp_localize_script('womenfirst-script', 'ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('womenfirst_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'womenfirst_scripts');

// Theme support
function womenfirst_theme_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 60,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('title-tag');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

    // Register menus
    register_nav_menus(array(
        'main-menu' => 'Main Navigation',
        'category-menu' => 'Category Menu'
    ));
}
add_action('after_setup_theme', 'womenfirst_theme_setup');

// Estimate reading time
function estimate_reading_time()
{
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200);
    return $reading_time;
}

// Add AJAX handler for loading more posts
function load_more_posts()
{
    if (!wp_verify_nonce($_POST['nonce'], 'womenfirst_nonce')) {
        wp_die('Security check failed');
    }

    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : 'all';

    $args = array(
        'posts_per_page' => 6,
        'paged' => $page,
        'post_status' => 'publish'
    );

    if ($category !== 'all') {
        $args['category_name'] = $category;
    }

    $posts = new WP_Query($args);

    if ($posts->have_posts()) {
        while ($posts->have_posts()) {
            $posts->the_post();
?>
            <article class="blog-card" data-categories="<?php echo esc_attr(get_the_category_list(',', '', get_the_ID())); ?>">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                <div class="post-content">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                </div>
            </article>
<?php
        }
        wp_reset_postdata();
    } else {
        echo 'no_more';
    }
    wp_die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

// Category fallback menu
function womenfirst_category_fallback_menu()
{
    $categories = array(
        'hormone-health' => 'Hormone Health',
        'mental-wellness' => 'Mental Wellness',
        'reproductive-health' => 'Reproductive Health',
        'nutrition' => 'Nutrition',
        'fitness' => 'Fitness',
        'advocacy' => 'Advocacy Tools'
    );

    echo '<div class="category-nav">';
    foreach ($categories as $slug => $name) {
        echo '<a href="/category/' . $slug . '" class="category-btn">' . $name . '</a>';
    }
    echo '</div>';
}
?>