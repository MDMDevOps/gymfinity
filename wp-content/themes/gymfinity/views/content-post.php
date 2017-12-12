<?php
/**
 * Template part for displaying content
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting">
	<header class="entry-header">
	<?php do_action( 'mpress_entry_title', 'entry-title' ); ?>
		<?php if( is_singular() && !is_page() ) : ?>
			<div class="entry-meta">
				<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'author', 'date' ) ) ); ?>
			</div>
		<?php endif; ?>
	</header>
	<div class="entry-content" itemprop="text articleBody">
		<?php eo_get_template_part( 'event-single' ); ?>
		<?php the_content(); ?>
	</div>
	<footer class="entry-footer">
		<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'categories' ) ) ); ?>
		<?php do_action( 'mpress_entry_meta', array( 'meta_type' => array( 'post_tags','edit' ) ) ); ?>
	</footer>
</article>