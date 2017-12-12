<?php
/**
 * Template part for displaying content
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">

	<div class="entry-content" itemprop="text articleBody">
		<?php if( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail alignleft">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php do_action( 'mpress_entry_title' ); ?>
			<p class="staff_position"><?php do_action( 'staff_position' ) ?></p>
		</header>
		<div class="content-wrapper">
			<?php the_content(); ?>
		</div>
	</div>
	<footer class="entry-footer">
		<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'edit' ) ) ); ?>
	</footer>
</article>