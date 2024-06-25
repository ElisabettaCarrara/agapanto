<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Agapanto
 */

if ( ! function_exists( 'agapanto_site_logo' ) ) :
	/**
	 * Displays the site logo in the header area
	 */
	function agapanto_site_logo() {

		if ( function_exists( 'the_custom_logo' ) ) {

			the_custom_logo();

		}
	}
endif;


if ( ! function_exists( 'agapanto_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function agapanto_site_title() {

		if ( is_home() or is_page_template( 'template-magazine.php' ) ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function agapanto_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) :
			?>

			<p class="site-description"><?php echo esc_html( $description ); ?></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function agapanto_header_image() {

		// Get theme options from database.
		$theme_options = agapanto_theme_options();

		// Display featured image as header image on static pages.
		if ( is_page() && has_post_thumbnail() ) :
			?>

			<div id="headimg" class="header-image featured-image-header">
				<?php the_post_thumbnail( 'agapanto-header-image' ); ?>
			</div>

			<?php
			// Display header image on single posts.
		elseif ( is_single() && has_post_thumbnail() && 'header' == $theme_options['post_layout_single'] ) :
			?>

			<div id="headimg" class="header-image featured-image-header">
				<?php the_post_thumbnail( 'agapanto-header-image' ); ?>
			</div>

			<?php
			// Display default header image set on Appearance > Header.
		elseif ( get_header_image() ) :

			// Hide header image on front page.
			if ( true === $theme_options['custom_header_hide'] and is_front_page() ) {
				return;
			}
			?>

			<div id="headimg" class="header-image">

			<?php
			// Check if custom header image is linked.
			if ( '' !== $theme_options['custom_header_link'] ) :
				?>

				<a href="<?php echo esc_url( $theme_options['custom_header_link'] ); ?>">
					<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>

			<?php else : ?>

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			<?php endif; ?>

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_blog_title' ) ) :
	/**
	 * Displays the blog title and description on the blog index (home.php)
	 */
	function agapanto_blog_title() {

		// Get theme options from database.
		$theme_options = agapanto_theme_options();

		// Set blog title and descripton.
		$blog_title       = $theme_options['latest_posts_title'];
		$blog_description = $theme_options['blog_description'];

		// Display Blog Title.
		if ( '' !== $blog_title || '' !== $blog_description || is_customize_preview() ) :
			?>

			<header class="page-header blog-header clearfix">

				<?php
				// Display Blog Title.
				if ( '' !== $blog_title || is_customize_preview() ) :
					?>

					<h2 class="archive-title blog-title"><?php echo wp_kses_post( $blog_title ); ?></h2>

					<?php
				endif;

				// Display Blog Description.
				if ( '' !== $blog_description || is_customize_preview() ) :
					?>

					<p class="blog-description"><?php echo wp_kses_post( $blog_description ); ?></p>

				<?php endif; ?>

			</header>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_post_image' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 *
	 * @param string $size Post thumbnail size.
	 * @param array  $attr Post thumbnail attributes.
	 */
	function agapanto_post_image( $size = 'post-thumbnail', $attr = array() ) {

		// Display Post Thumbnail.
		if ( has_post_thumbnail() ) :
			?>

			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( $size, $attr ); ?>
			</a>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive pages
	 */
	function agapanto_post_image_archives() {

		// Get theme options from database.
		$theme_options = agapanto_theme_options();

		// Return early if no featured image should be displayed.
		if ( 'none' === $theme_options['post_layout_archives'] || ! has_post_thumbnail() ) :
			return;
		endif;

		// Display featured image beside post content.
		if ( 'left' === $theme_options['post_layout_archives'] ) :
			?>

			<a class="post-thumbnail-small" href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail( 'agapanto-thumbnail-medium' ); ?>
			</a>

			<?php
			// Display featured image above post content.
		else :
			?>

			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php the_post_thumbnail(); ?>
			</a>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts
	 */
	function agapanto_post_image_single() {

		// Get theme options from database.
		$theme_options = agapanto_theme_options();

		// Display Post Thumbnail if activated.
		if ( 'top' == $theme_options['post_layout_single'] ) :

			the_post_thumbnail();

		endif;
	}
endif;


if ( ! function_exists( 'agapanto_entry_meta' ) ) :
	/**
	 * Displays the date, author and categories of a post
	 */
	function agapanto_entry_meta() {

		$postmeta  = agapanto_meta_date();
		$postmeta .= agapanto_meta_author();
		$postmeta .= agapanto_meta_category();

		// Values are already escaped in agapanto_meta_date(), agapanto_meta_category() and agapanto_meta_author()
		echo '<div class="entry-meta">' . $postmeta . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;


if ( ! function_exists( 'agapanto_meta_date' ) ) :
	/**
	 * Displays the post date
	 */
	function agapanto_meta_date() {

		$time_string = sprintf(
			'<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date published updated" datetime="%3$s">%4$s</time></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);

		return '<span class="meta-date">' . $time_string . '</span>';
	}
endif;


if ( ! function_exists( 'agapanto_meta_author' ) ) :
	/**
	 * Displays the post author
	 */
	function agapanto_meta_author() {

		$author_string = sprintf(
			'<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'agapanto' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		return '<span class="meta-author"> ' . $author_string . '</span>';
	}
endif;


if ( ! function_exists( 'agapanto_meta_category' ) ) :
	/**
	 * Displays the category of posts
	 */
	function agapanto_meta_category() {

		return '<span class="meta-category"> ' . get_the_category_list( ', ' ) . '</span>';

	}
endif;


if ( ! function_exists( 'agapanto_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function agapanto_entry_tags() {

		// Get tags.
		$tag_list = get_the_tag_list( '', '' );

		// Display tags.
		if ( $tag_list ) :
			?>

			<div class="entry-tags clearfix">
				<span class="meta-tags">
					<?php echo wp_kses_post( $tag_list ); ?>
				</span>
			</div><!-- .entry-tags -->

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function agapanto_more_link() {

		// Get Read More Text.
		$read_more = agapanto_get_option( 'read_more_text' );

		if ( '' !== $read_more || is_customize_preview() ) :
			?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php echo esc_html( $read_more ); ?></a>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'agapanto_post_navigation' ) ) :
	/**
	 * Displays Single Post Navigation
	 */
	function agapanto_post_navigation() {

		// Get theme options from database.
		$theme_options = agapanto_theme_options();

		if ( true === $theme_options['post_navigation'] || is_customize_preview() ) {

			the_post_navigation(
				array(
					'prev_text' => '<span class="screen-reader-text">' . esc_html_x( 'Previous Post:', 'post navigation', 'agapanto' ) . '</span>%title',
					'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Post:', 'post navigation', 'agapanto' ) . '</span>%title',
				)
			);

		}
	}
endif;


if ( ! function_exists( 'agapanto_breadcrumbs' ) ) :
	/**
	 * Displays ThemeZee Breadcrumbs plugin
	 */
	function agapanto_breadcrumbs() {

		if ( function_exists( 'elica_breadcrumbs' ) ) {

			elica_breadcrumbs(
				array(
					'before' => '<div class="breadcrumbs-container container clearfix">',
					'after'  => '</div>',
				)
			);

		}
	}
endif;


if ( ! function_exists( 'agapanto_related_posts' ) ) :
	/**
	 * Displays ThemeZee Related Posts plugin
	 */
	function agapanto_related_posts() {

		if ( function_exists( 'elica_related_posts' ) ) {

			elica_related_posts(
				array(
					'class'        => 'related-posts type-page clearfix',
					'before_title' => '<header class="page-header"><h2 class="archive-title related-posts-title">',
					'after_title'  => '</h2></header>',
				)
			);

		}
	}
endif;


if ( ! function_exists( 'agapanto_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function agapanto_pagination() {

		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => '&laquo;<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'agapanto' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'agapanto' ) . '</span>&raquo;',
			)
		);

	}
endif;


/**
 * Displays credit link on footer line
 */
function agapanto_footer_text() {
	?>

	<span class="credit-link">
		<?php
		// translators: Theme Name and Link to ThemeZee.
		printf(
			esc_html__( 'ClassicPress Theme: %1$s by %2$s.', 'agapanto' ),
			esc_html__( 'Agapanto', 'agapanto' ),
			'ThemeZee'
		);
		?>
	</span>

	<?php
}
add_action( 'agapanto_footer_text', 'agapanto_footer_text' );
