<?php

/**
 * Template Name: Portfolio Homepage
 *
 * Description: A custom page template for displaying the portfolio homepage widgets.
 *
 * @package Agapanto
 */

get_header(); ?>

<section id="primary" class="fullwidth-content-area content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Display Portfolio Homepage Widgets.
        agapanto_portfolio_widgets();
        ?>

    </main><!-- #main -->
</section><!-- #primary -->

<?php get_footer(); ?>