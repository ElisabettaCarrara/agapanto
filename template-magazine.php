<?php
/**
 * Template Name: Magazine Homepage
 *
 * Description: A custom page template for displaying the magazine homepage widgets.
 *
 * @package Agapanto
 */

get_header(); ?>

	<section id="primary" class="fullwidth-content-area content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Display Magazine Homepage Widgets.
		agapanto_magazine_widgets();
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
