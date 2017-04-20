<?php
/**
 * Template part for displaying post excerpts
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<div class="excerpt-meta">
		<?php do_action( 'mpress_entry_meta' ); ?>
	</div>
	<header class="excerpt-header">
		<?php do_action( 'mpress_entry_title', 'excerpt-title' ); ?>
	</header>
	<div class="excerpt-content-wrapper" itemprop="text articleBody">
		<?php if( has_post_thumbnail() ) : ?>
			<div class="excerpt-thumbnail">
				<?php the_post_thumbnail( 'gymfinity-featured-small' ); ?>
			</div>
		<?php endif; ?>
		<div class="excerpt-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
	<footer class="excerpt-footer">
		<?php do_action( 'jp_share_buttons' ); ?>
	</footer>
</article>