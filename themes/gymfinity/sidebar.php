<?php
/**
 * The sidebar containing the main widget area.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package mpress
 */
?>
<div class="fixed-scroll-column">
	<nav id="sidebar-navigation" class="navigation-menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
		<?php if( has_nav_menu( 'primary-navbar' ) ) : ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-navbar', 'container' => '', 'walker' => new \Mpress\Walker_Nav_Menu() ) ); ?>
		<?php endif; ?>
	</nav>

	<?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
	    <div class="widget-area secondary sidebar" role="complementary">
	        <?php dynamic_sidebar( 'primary-sidebar' ); ?>
	    </div>
	<?php endif; ?>
</div>
