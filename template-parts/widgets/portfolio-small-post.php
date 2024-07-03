<?php
/**
 * The template for displaying small posts in Portfolio Post widgets
 *
 * @package Agapanto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'small-post clearfix' ); ?>>

	<?php agapanto_post_image( 'agapanto-thumbnail-small' ); ?>

	<div class="post-content clearfix">

		<header class="entry-header">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php agapanto_portfolio_entry_date(); ?>

		</header><!-- .entry-header -->

	</div>

</article>
