<section id="<?php echo $block->html_id; ?>" class="content-block<?php echo $block->html_class; ?>"<?php echo $block->html_style; ?>>
	<article id="content-block-<?php echo $block->ID; ?>" <?php post_class( '', $block->ID ); ?>>
		<div class="block-content">
			<?php echo apply_filters( 'the_content', $block->post_content ); ?>
		</div>
	</article>
</section>