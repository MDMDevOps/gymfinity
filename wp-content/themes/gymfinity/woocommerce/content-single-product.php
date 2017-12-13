<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<?php
	/**
	 * woocommerce_before_single_product hook.
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<header class="entry-header">
	<?php woocommerce_template_single_title(); ?>
	<hr>
</header>

<div class="entry-content">
	<div class="row add-padding-bottom">
		<div class="column sm-6">
			<?php echo apply_filters( 'the_content', get_the_excerpt() ); ?>
		</div>
		<div class="column sm-6">
			<?php woocommerce_template_single_add_to_cart(); ?>
			<?php woocommerce_template_single_sharing(); ?>
		</div>

	</div>

	<?php //do_action( 'woocommerce_single_product_summary' ); ?>
	<?php the_content(); ?>

</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
