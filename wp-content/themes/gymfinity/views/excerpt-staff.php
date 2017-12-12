<?php
/**
 * Template part for displaying post excerpts
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt box-container' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<div class="excerpt-content-wrapper" itemprop="text articleBody">
		<?php if( has_post_thumbnail() ) : ?>
			<div class="excerpt-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<header class="excerpt-header">
			<?php do_action( 'mpress_entry_title', 'excerpt-title' ); ?>
			<p class="staff_position"><?php do_action( 'staff_position' ) ?></p>
		</header>
		<div class="excerpt-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
	<footer class="excerpt-footer clearfix">
		<a href="<?php the_permalink(); ?>" class="button pull-right">Read Full Bio</a>
	</footer>
</article>