<?php
/**
 * The template for displaying articles in the slideshow loop
 *
 * @package Agapanto
 */

?>

<li id="slide-<?php the_ID(); ?>" class="zeeslide clearfix">

	<?php agapanto_slider_image( 'agapanto-header-image', array( 'class' => 'slide-image', 'loading' => false ) ); ?>

	<div class="slide-post clearfix">

		<div class="slide-content container clearfix">

			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php agapanto_entry_meta(); ?>

		</div>

	</div>

</li>
