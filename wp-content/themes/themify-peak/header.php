<!DOCTYPE html>
<html <?php echo themify_get_html_schema(); ?> <?php language_attributes(); ?>>
<head>
	<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<?php
/**
 * Document title is generated in theme-functions.php
 * Stylesheets and Javascript files are enqueued in theme-functions.php
 */
?>

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<?php themify_body_start(); // hook ?>

	<div id="pagewrap" class="hfeed site">

		<div id="headerwrap">

			<?php themify_header_before(); // hook ?>

			<header id="header" class="pagewidth clearfix">

				<?php themify_header_start(); // hook ?>

				<?php echo themify_logo_image(); ?>

				<?php echo themify_site_description(); ?>

				<div id="menu-wrapper">

					<?php if ( ! themify_check( 'setting-exclude_search_form' ) ) : ?>
						<div id="searchform-wrap">
							<?php get_search_form(); ?>
						</div>
						<!-- /#searchform-wrap -->
					<?php endif; ?>

					<div class="social-widget">
						<?php dynamic_sidebar('social-widget'); ?>

						<?php if ( ! themify_check('setting-exclude_rss' ) ) : ?>
							<div class="rss"><a href="<?php themify_theme_feed_link(); ?>"></a></div>
						<?php endif; ?>
					</div>
					<!-- /.social-widget -->

					<nav id="main-nav-wrap">
						<?php themify_theme_main_menu(); ?>
					</nav>
					<!-- /#main-nav -->

				</div>
				<!-- /#menu-wrapper -->
				<a id="menu-icon" href="#mobile-menu"></a>

				<div id="mobile-menu" class="sidemenu sidemenu-off">
						<div class="slideout-widgets">
							<?php dynamic_sidebar( 'slideout-widgets' ); ?>
							<a id="menu-icon-close" href="#mobile-menu"></a>
						</div>
						<!-- /.slideout-widgets -->
				</div>
				<!-- /#mobile-menu -->
				<?php themify_header_end(); // hook ?>

			</header>
			<!-- /#header -->

			<?php themify_header_after(); // hook ?>

		</div>
		<!-- /#headerwrap -->

		<div id="body" class="clearfix">

			<?php themify_layout_before(); //hook ?>