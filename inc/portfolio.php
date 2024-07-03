<?php

/**
 * Portfolio Functions
 *
 * Custom Functions and Template tags used in the Portfolio widgets and Portfolio templates
 *
 * @package Agapanto
 */


/**
 * Displays Portfolio widget area
 */
function agapanto_portfolio_widgets()
{

    // Get theme options from database.
    $theme_options = agapanto_theme_options();

    // Return early if Magazine widgets are deactivated on blog index.
    if (is_home() && false === $theme_options['blog_portfolio_widgets']) {
        return;
    }

    // Only display on first page of blog.
    if (is_home() && is_paged()) {
        return;
    }

    // Check if there are widgets in Magazine sidebar.
    if (is_active_sidebar('portfolio-homepage')) : ?>

        <div id="portfolio-homepage-widgets" class="widget-area clearfix">

            <?php dynamic_sidebar('portfolio-homepage'); ?>

        </div><!-- #portfolio-homepage-widgets -->

<?php
    elseif (is_page_template('template-portfolio.php') && current_user_can('edit_theme_options')) :

        echo '<p class="empty-widget-area">';
        esc_html_e('Please go to Customize &#8594; Widgets and add at least one widget to the Portfolio Homepage widget area.', 'agapanto');
        echo '</p>';

    endif;
}


if (!function_exists('agapanto_portfolio_widget_title')) :
    /**
     * Displays the widget title with link to the category archive
     *
     * @param String $widget_title Widget Title.
     * @param int    $category_id  Category ID.
     * @return String Widget Title
     */
    function agapanto_portfolio_widget_title($widget_title, $category_id)
    {

        // Check if widget shows a specific category.
        if ($category_id > 0) {

            // Set URL and Title for Category.
            $category_title = sprintf(esc_html__('View all posts from category %s', 'agapanto'), get_cat_name($category_id));
            $category_url   = get_category_link($category_id);

            // Set Widget Title with link to category archive.
            $widget_title = '<a class="category-archive-link" href="' . esc_url($category_url) . '" title="' . esc_attr($category_title) . '">' . $widget_title . '</a>';
        }

        return $widget_title;
    }
endif;


if (!function_exists('agapanto_portfolio_entry_meta')) :
    /**
     * Displays the date and author of magazine posts
     */
    function agapanto_portfolio_entry_meta()
    {

        $postmeta  = agapanto_meta_date();
        $postmeta .= agapanto_meta_author();

        // Values are already escaped in agapanto_meta_date() and agapanto_meta_author()
        echo '<div class="entry-meta">' . $postmeta . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;


if (!function_exists('agapanto_portfolio_entry_date')) :
    /**
     * Displays the date of magazine posts
     */
    function agapanto_portfolio_entry_date()
    {
        // Value is already escaped in agapanto_meta_date()
        echo '<div class="entry-meta">' . agapanto_meta_date() . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;


/**
 * Function to change excerpt length for posts in category posts widgets
 *
 * @param int $length Length of excerpt in number of words.
 * @return int
 */
function agapanto_portfolio_posts_excerpt_length($length)
{
    return 15;
}


/**
 * Get Portfolio Post IDs
 *
 * @param String $cache_id        Portfolio Widget Instance.
 * @param int    $category        Category ID.
 * @param int    $number_of_posts Number of posts.
 * @return array Post IDs
 */

function agapanto_get_portfolio_post_ids($cache_id, $category, $number_of_posts)
{
    $cache_id = sanitize_key($cache_id);
    $post_ids = get_transient('agapanto_portfolio_post_ids');

    if (!is_array($post_ids)) {
        $post_ids = array();
    }

    if (!isset($post_ids[$cache_id]) || is_customize_preview()) {
        // Get Posts from Database.
        $query_arguments = array(
            'fields'              => 'ids',
            'cat'                 => (int) $category,
            'posts_per_page'      => (int) $number_of_posts,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        );
        $query = new WP_Query($query_arguments);

        // Create an array of all post ids.
        $post_ids[$cache_id] = $query->have_posts() ? $query->posts : array();

        // Set Transient.
        set_transient('agapanto_portfolio_post_ids', $post_ids);
    }

    return apply_filters('agapanto_portfolio_post_ids', $post_ids[$cache_id] ?? array(), $cache_id);
}

/**
 * Delete Cached Post IDs
 *
 * @return void
 */
function agapanto_flush_portfolio_post_ids()
{
    delete_transient('agapanto_portfolio_post_ids');
}
add_action('save_post', 'agapanto_flush_portfolio_post_ids');
add_action('deleted_post', 'agapanto_flush_portfolio_post_ids');
add_action('customize_save_after', 'agapanto_flush_portfolio_post_ids');
add_action('switch_theme', 'agapanto_flush_portfolio_post_ids');