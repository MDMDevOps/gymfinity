<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package mpress
 */
?>



<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="row">
		<div class="column md-4 outter-widget">
			<?php if ( is_active_sidebar( 'footer-widgets-left' ) ) : ?>
				<?php dynamic_sidebar( 'footer-widgets-left' ); ?>
			<?php endif; ?>
		</div>
		<div class="column md-4">
			<?php the_custom_logo(); ?>
		</div>
		<div class="column md-4 outter-widget">
			<?php if ( is_active_sidebar( 'footer-widgets-right' ) ) : ?>
				<?php dynamic_sidebar( 'footer-widgets-right' ); ?>
			<?php endif; ?>
		</div>
	</div>

	<div class="site-info">
		<div class="wrapper">
			<?php do_action( 'copyright_message' ); ?>
		</div>
	</div>
</footer>

</div><!-- #page -->

</div> <!-- #page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>