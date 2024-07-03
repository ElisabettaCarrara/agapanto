<?php

/**
 * Portfolio Horizontal Box Widget
 *
 * Display the latest posts from a selected category in a horizontal box.
 * Intended to be used in the Portfolio Page widget area to build a portfolio-layout page.
 *
 * @package Agapanto
 */

/**
 * Portfolio Widget Class
 */
class Agapanto_Portfolio_Horizontal_Box_Widget extends WP_Widget
{

    /**
     * Widget Constructor
     */
    public function __construct()
    {
        // Setup Widget.
        parent::__construct(
            'agapanto-portfolio-posts-boxed', // ID.
            esc_html__('Portfolio (Horizontal Box)', 'agapanto'), // Name.
            array(
                'classname'                   => 'agapanto-portfolio-horizontal-box-widget',
                'description'                 => esc_html__('Displays your posts from a selected category in a horizontal box.', 'agapanto'),
                'customize_selective_refresh' => true,
            ) // Args.
        );
    }

    /**
     * Set default settings of the widget
     */
    private function default_settings()
    {
        $defaults = array(
            'title'    => esc_html__('Portfolio (Horizontal Box)', 'agapanto'),
            'category' => 0,
        );

        return $defaults;
    }

    /**
     * Main Function to display the widget
     *
     * @uses this->render()
     *
     * @param array $args Parameters from widget area created with register_sidebar().
     * @param array $instance Settings for this widget instance.
     */
    public function widget($args, $instance)
    {
        // Start Output Buffering.
        ob_start();

        // Get Widget Settings.
        $settings = wp_parse_args($instance, $this->default_settings());

        // Output.
        echo wp_kses_post($args['before_widget']);
?>

        <div class="widget-portfolio-posts-horizontal-box widget-portfolio-posts clearfix">

            <?php
            // Display Title.
            $this->widget_title($args, $settings);
            ?>

            <div class="widget-portfolio-posts-content portfolio-horizontal-box clearfix">

                <?php $this->render($settings); ?>

            </div>

        </div>

    <?php
        echo wp_kses_post($args['after_widget']);

        // End Output Buffering.
        ob_end_flush();
    }

    /**
     * Renders the Widget Content
     *
     * Switches between horizontal and vertical layout style based on widget settings
     *
     * @uses this->portfolio_posts_horizontal() or this->portfolio_posts_vertical()
     * @used-by this->widget()
     *
     * @param array $settings Settings for this widget instance.
     */
    protected function render($settings)
    {
        // Get cached post ids.
        $post_ids = agapanto_get_portfolio_post_ids($this->id, $settings['category'], 4);

        if (empty($post_ids)) {
            echo '<p class="no-posts-found">' . esc_html__('No posts found in this category.', 'agapanto') . '</p>';
            return;
        }

        // Fetch posts from database.
        $query_arguments = array(
            'post__in'            => $post_ids,
            'posts_per_page'      => 4,
            'ignore_sticky_posts' => true,
            'no_found_rows'       => true,
        );
        $posts_query = new WP_Query($query_arguments);

        // Check if there are posts.
        if ($posts_query->have_posts()) :

            // Limit the number of words for the excerpt.
            add_filter('excerpt_length', 'agapanto_portfolio_posts_excerpt_length');

            // Display Posts.
            while ($posts_query->have_posts()) :
                $posts_query->the_post();

                // Display first post differently.
                if (0 === $posts_query->current_post) :
                    get_template_part('template-parts/widgets/portfolio-large-post', 'horizontal-box');
                    echo '<div class="medium-posts clearfix">';
                else :
                    get_template_part('template-parts/widgets/portfolio-medium-post', 'horizontal-box');
                endif;

            endwhile;

            echo '</div><!-- end .medium-posts -->';

            // Remove excerpt filter.
            remove_filter('excerpt_length', 'agapanto_portfolio_posts_excerpt_length');

        else :
            echo '<p class="no-posts-found">' . esc_html__('No posts found in this category.', 'agapanto') . '</p>';
        endif;

        // Reset Postdata.
        wp_reset_postdata();
    }
    /**
     * Displays Widget Title
     *
     * @param array $args Parameters from widget area created with register_sidebar().
     * @param array $settings Settings for this widget instance.
     */
    public function widget_title($args, $settings)
    {
        // Add Widget Title Filter.
        $widget_title = apply_filters('widget_title', $settings['title'], $settings, $this->id_base);

        if (!empty($widget_title)) :
            // Link Widget Title to category archive when possible.
            $widget_title = agapanto_magazine_widget_title($widget_title, $settings['category']);

            // Display Widget Title.
            echo wp_kses_post($args['before_title'] . $widget_title . $args['after_title']);
        endif;
    }

    /**
     * Update Widget Settings
     *
     * @param array $new_instance New Settings for this widget instance.
     * @param array $old_instance Old Settings for this widget instance.
     * @return array $instance
     */
    public function update($new_instance, $old_instance)
    {
        $instance             = $old_instance;
        $instance['title']    = sanitize_text_field($new_instance['title']);
        $instance['category'] = (int) $new_instance['category'];

        agapanto_flush_portfolio_post_ids();

        return $instance;
    }

    /**
     * Displays Widget Settings Form in the Backend
     *
     * @param array $instance Settings for this widget instance.
     */
    public function form($instance)
    {
        // Get Widget Settings.
        $settings = wp_parse_args($instance, $this->default_settings());
    ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'agapanto'); ?>
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($settings['title']); ?>" />
            </label>
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>"><?php esc_html_e('Category:', 'agapanto'); ?></label><br />
            <?php
            // Display Category Select.
            $args = array(
                'show_option_all' => esc_html__('All Categories', 'agapanto'),
                'show_count'      => true,
                'hide_empty'      => false,
                'selected'        => $settings['category'],
                'name'            => $this->get_field_name('category'),
                'id'              => $this->get_field_id('category'),
            );
            wp_dropdown_categories($args);
            ?>
        </p>

<?php
    }
}

/**
 * Register Widget
 */
function agapanto_register_portfolio_posts_horizontal_box_widget()
{
    register_widget('Agapanto_Portfolio_Horizontal_Box_Widget');
}
add_action('widgets_init', 'agapanto_register_portfolio_posts_horizontal_box_widget');
