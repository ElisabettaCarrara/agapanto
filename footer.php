<?php
/**
 * The template for displaying the footer.
 *
 * Contains all content after the main content area and sidebar
 *
 * @package Agapanto
 */

?>

	</div><!-- #content -->

	<?php do_action( 'agapanto_before_footer' ); ?>

	<div id="footer" class="footer-wrap">

		<footer id="colophon" class="site-footer clearfix" role="contentinfo">

			<?php if ( is_active_sidebar( 'footer-widget-1' ) || is_active_sidebar( 'footer-widget-2' ) || is_active_sidebar( 'footer-widget-3' ) ) : ?>
  <div class="footer-widgets clearfix">
    <?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>
      <div class="footer-widget-column">
        <?php dynamic_sidebar( 'footer-widget-1' ); ?>
      </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>
      <div class="footer-widget-column">
        <?php dynamic_sidebar( 'footer-widget-2' ); ?>
      </div>
    <?php endif; ?>

    <?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>
      <div class="footer-widget-column">
        <?php dynamic_sidebar( 'footer-widget-3' ); ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
		</footer><!-- #colophon -->

	</div>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
