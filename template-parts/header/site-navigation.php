<?php
/**
 * Main Navigation
 *
 * @version 1.1
 * @package Agapanto
 */
?>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<button class="primary-menu-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false" <?php agapanto_amp_menu_toggle(); ?>>
    <?php
    agapanto_svg_icon('menu');
    agapanto_svg_icon('close');
    ?>
    <span class="menu-toggle-text screen-reader-text"><?php esc_html_e( 'Menu', 'agapanto' ); ?></span>
</button>
	<div class="primary-navigation">
		<nav id="site-navigation" class="main-navigation" role="navigation" <?php agapanto_amp_menu_is_toggled(); ?> aria-label="<?php esc_attr_e( 'Primary Menu', 'agapanto' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'menu_id'        => 'primary-menu',
					'container'      => false,
				)
			);
			?>
		</nav><!-- #site-navigation -->
	</div><!-- .primary-navigation -->
<?php endif; ?>
<?php do_action( 'agapanto_after_navigation' ); ?>
