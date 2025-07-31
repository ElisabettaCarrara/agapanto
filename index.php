<?php
/**
 * The main template file.
 *
 * @package Agapanto
 */

get_header();
?>

<main id="main" class="site-main" role="main">

    <?php if ( have_posts() ) : ?>

        <?php
        // Start the Loop.
        while ( have_posts() ) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>

        <?php
        // Previous/next page navigation.
        the_posts_navigation();
        ?>

    <?php else : ?>

        <section class="no-results not-found">
            <h2><?php _e( 'Nothing Found', 'agapanto' ); ?></h2>
            <p><?php _e( 'It seems we can’t find what you’re looking for.', 'agapanto' ); ?></p>
        </section>

    <?php endif; ?>

</main>

<?php
get_footer();
