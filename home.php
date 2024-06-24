<?php
/**
 * The template for displaying the blog index (latest posts)
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Agapanto
 */

get_header();

// Get Theme Options from Database.
$theme_options = agapanto_theme_options();
?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		// Display Magazine Homepage Widgets.
		agapanto_magazine_widgets();

		do_action( 'agapanto_before_blog' );

		// Display Latest Posts.
		if ( have_posts() ) :

			// Display Blog Title.
			agapanto_blog_title();
			?>

			<div id="post-wrapper" class="post-wrapper clearfix">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', esc_attr( $theme_options['post_content'] ) );

				endwhile; ?>

			</div>

			<?php agapanto_pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
