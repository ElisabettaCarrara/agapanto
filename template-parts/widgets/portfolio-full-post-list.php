<?php

/**
 * The template for displaying large posts in the Portfolio List widget.
 *
 * @package Agapanto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

    <?php agapanto_post_image(); ?>

    <header class="entry-header">

        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

        <?php agapanto_portfolio_entry_meta(); ?>

    </header><!-- .entry-header -->

    <div class="entry-content">

        <?php the_excerpt(); ?>
        <?php agapanto_more_link(); ?>

    </div><!-- .entry-content -->

</article>