<?php
/**
 * The template for displaying single posts
 *
 * @package Agapanto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php agapanto_post_image_single(); ?>

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php agapanto_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content clearfix">

		<?php the_content(); ?>

		<?php wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'agapanto' ),
			'after'  => '</div>',
		) ); ?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php agapanto_entry_tags(); ?>
		<?php do_action( 'agapanto_author_bio' ); ?>
		<?php agapanto_post_navigation(); ?>

	</footer><!-- .entry-footer -->

</article>
