<?php
/**
 * Template part for displaying post excerpts
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt box-container' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<div class="excerpt-meta">
		<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'author', 'date' ) ) ); ?>
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
		<div class="excerpt-meta">
			<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'categories' ) ) ); ?>
			<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'post_tags','edit' ) ) ); ?>
		</div>
		<?php do_action( 'jp_share_buttons' ); ?>
	</footer>
</article>