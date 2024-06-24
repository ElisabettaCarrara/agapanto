<?php
/**
 * The template for displaying medium posts in Magazine Post widgets
 *
 * @package Agapanto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'medium-post clearfix' ); ?>>

	<?php agapanto_post_image( 'agapanto-thumbnail-medium' ); ?>

	<header class="entry-header">

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php agapanto_magazine_entry_date(); ?>

	</header><!-- .entry-header -->

</article>
