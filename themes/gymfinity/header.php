<?php
/**
 * The header for our theme.
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package mpress
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]>  <html lang="en" class="no-js ie6">  <![endif]-->
<!--[if IE 7 ]>     <html lang="en" class="no-js ie7">  <![endif]-->
<!--[if IE 8 ]>     <html lang="en" class="no-js ie8">  <![endif]-->
<!--[if IE 9 ]>     <html lang="en" class="no-js ie9">  <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->
<head>
	<!-- define character set -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<!-- XFN Metadata Profile -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- mobile specific metadeta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- specify IE rendering version -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Wordpress pingback url -->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- Humans.txt - Where we give credits and thanks -->
	<link type="text/plain" rel="author" href="<?php echo site_url( '/humans.txt' ); ?>" />
	<!-- Wordpress generated head area -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

	<?php do_action( 'wp_after_body' ); ?>

	<a class="skip-link screen-reader-text jumpscroll" href="#content"><?php esc_html_e( 'Skip to content', 'mpress' ); ?></a>

	<div id="page-wrapper">

		<?php if( get_theme_mod( 'mpress_menu_type' ) === 'offcanvas' ) : get_template_part( 'views/offcanvas' ); endif; ?>

		<header id="masthead" role="banner">
			<div class="top-banner">
				<div class="wrapper clearfix">
					<div class="widgets">
						<?php if ( is_active_sidebar( 'top-banner' ) ) : ?>
							<?php dynamic_sidebar( 'top-banner' ); ?>
						<?php endif; ?>
					</div>
					<nav id="secondary-navigation" class="navigation-menu" itemscope itemtype="https://schema.org/SiteNavigationElement">
						<?php if( has_nav_menu( 'secondary-navbar' ) ) : ?>
							<?php wp_nav_menu( array( 'theme_location' => 'secondary-navbar', 'container' => '', 'walker' => new \Mpress\Walker_Nav_Menu() ) ); ?>
						<?php endif; ?>
					</nav>
				</div>
			</div>
			<div class="main-banner wrapper">
				<div class="clearfix">
					<div class="site-branding" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						<?php the_custom_logo(); ?>
						<hgroup>
						    <h1 class='site-title'><a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'><?php bloginfo( 'name' ); ?></a></h1>
						    <h2 class='site-description'><?php bloginfo( 'description' ); ?></h2>
						</hgroup>
					</div>
				</div>
			</div>
		</header>

		<div id="appbar">
				<button class="menu-toggle" aria-expanded="false" data-toggle="<?php echo get_theme_mod( 'mpress_menu_type' ); ?>"><?php do_action( 'mpress_icon', 'menu' ) ?><span class="screen-reader-text"><?php esc_html_e( 'Menu', 'mpress' ); ?></span></button>
		</div>

		<div id="page" class="hfeed site">