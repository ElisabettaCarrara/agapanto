<?php
/**
 * The template for displaying full image posts in Portfolio Post widgets
 *
 * @package Agapanto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php agapanto_post_image( 'agapanto-thumbnail-single' ); ?>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php agapanto_entry_meta(); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_excerpt(); ?>
		<?php agapanto_more_link(); ?>

	</div><!-- .entry-content -->

</article>
