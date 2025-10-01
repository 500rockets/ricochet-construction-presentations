<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<!-- Layout-->
		<div class="layout">

			<!-- Header-->
			<header class="header <?php echo esc_attr( apply_filters( 'core_navigation_menu_alignment', 'header-center' ) ); ?>">
				<div class="container-fluid">
					<!-- Logos-->
					<div class="inner-header">
						<a class="inner-brand" href="<?php echo esc_url( home_url() ); ?>">
							<?php echo apply_filters( 'core_brand_logo_content', esc_html( get_bloginfo( 'name' ) ) ); ?>
						</a>
					</div>
					<!-- Navigation-->
					<div class="inner-navigation collapse">
						<div class="inner-navigation-inline">
							<div class="inner-nav">

								<?php
								if ( has_nav_menu( 'primary' ) ) {
									$menu_args = array(
										'theme_location' => 'primary',
										'menu'           => apply_filters( 'core_special_navigation_menu', '' ),
										'container'      => false,
									);
									wp_nav_menu( $menu_args );
								} else { ?>
									<?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
										<ul><li><a href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>">
											<?php _e( 'Add your menu', 'core' ); ?>
										</a></li></ul>
									<?php endif; ?>
								<?php } ?>

							</div>
						</div>
					</div>

					<!-- Extra menu-->
					<div class="extra-nav">
						<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
							<ul><li><a class="open-offcanvas" href="#">
								<span><?php echo esc_html( apply_filters( 'core_extra_sidebar_label', '' ) ); ?></span>
								<span class="fa fa-bars"></span>
							</a></li></ul>
						<?php endif; ?>
					</div>
					<!-- Mobile menu-->
					<div class="nav-toggle">
						<a href="#" data-toggle="collapse" data-target=".inner-navigation">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</a>
					</div>
				</div>
			</header>
			<!-- Header end-->

			<!-- Wrapper-->
			<div class="wrapper">
				<?php core_get_page_header(); ?>
