<?php
/*
Template Name: Woocommerce Full-width Template page
*/

?>

<?php get_header(); ?>

<div id="page" class="hfeed site">

<div id="primary" class="content-area nosidebar">
	<main id="main" class="site-main" role="main">
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
				<div class="box-container">
					<?php get_template_part( 'views/content', get_post_type() ); ?>
				</div>
		<?php endwhile; endif; ?>
	</main>
	<aside id="sidebar" data-container="#primary" data-offset="50px">
		<?php get_sidebar(); ?>
	</aside>
</div>
<?php get_footer(); ?>
