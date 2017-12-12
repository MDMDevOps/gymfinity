<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package mpress
 */
?>



<footer id="colophon" class="site-footer" role="contentinfo"  style="background-image: url( '<?php header_image(); ?>' );">
	<section class="widgets">
		<div class="wrapper">
			<div class="row">
				<div class="column md-6 widgets-left">
					<?php if ( is_active_sidebar( 'footer-widgets-left' ) ) : ?>
						<?php dynamic_sidebar( 'footer-widgets-left' ); ?>
					<?php endif; ?>
				</div>
				<div class="column md-6 widgets-right">
					<?php if ( is_active_sidebar( 'footer-widgets-right' ) ) : ?>
						<?php the_custom_logo(); ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
	<section class="site-info">
		<div class="wrapper">
			<?php do_action( 'copyright_message' ); ?>
		</div>
	</section>
</footer>

</div><!-- #page -->

</div> <!-- #page-wrapper -->

<?php wp_footer(); ?>

</body>
</html>