<article id="content-block-<?php echo $block->ID; ?>" <?php post_class( $block->html_class, $block->ID ); ?><?php echo $block->html_style; ?>>
	<div class="block-content">
		<?php echo apply_filters( 'the_content', $block->post_content ); ?>
	</div>
</article>