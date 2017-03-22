<div class="top-banner">
	<div class="wrapper clearfix">
		<div class="widgets">
			<?php if ( is_active_sidebar( 'top-banner-widgets' ) ) : ?>
				<?php dynamic_sidebar( 'top-banner-widgets' ); ?>
			<?php endif; ?>
		</div>
		<nav id="secondary-navigation" class="navigation-menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
			<?php if( has_nav_menu( 'secondary-navbar' ) ) : ?>
				<?php wp_nav_menu( array( 'theme_location' => 'secondary-navbar', 'container' => '', 'walker' => new \Mpress\Walker_Nav_Menu() ) ); ?>
			<?php endif; ?>
		</nav>
	</div>
</div>