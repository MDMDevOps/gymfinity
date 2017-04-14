<?php
/**
 * The main template file.
 * This is the most generic template file in a WordPress theme
 * It is used to display a page when nothing more specific matches a query.
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package mpress
 */
?>

<?php get_header(); ?>

<div id="primary" class="content-area row full-width">
	<main id="main" class="site-main" role="main">
	<?php
		if( have_posts() ) :
			while( have_posts() ) : the_post();
				the_content();
			endwhile;
		endif;
	?>
	</main>
</div>
<?php get_footer(); ?>
