<?php
/**
 * Header for Avibi blog views.
 */

defined( 'ABSPATH' ) || exit;

$avibi_nav        = avibi_blog_show( 'header_show_menu' ) ? avibi_blog_header_items() : array();
$avibi_show_lang  = avibi_blog_show( 'header_show_lang' );
$avibi_show_curr  = avibi_blog_show( 'header_show_currency' );
$avibi_show_login = avibi_blog_show( 'header_show_login' );
$avibi_currencies = avibi_blog_currencies();
$avibi_login_url  = avibi_blog_option( 'login_url' );
$avibi_login_text = avibi_blog_option( 'login_text' );
$avibi_page_class = 'blog-page avibi-page' . ( avibi_blog_show( 'header_sticky' ) ? '' : ' is-header-static' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="antialiased">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="<?php echo esc_attr( $avibi_page_class ); ?>">
	<div class="avibi-header-spacer">
		<header class="avibi-header">
			<div class="avibi-header-inner">
				<div class="avibi-header-brand">
					<?php if ( avibi_blog_show( 'header_show_logo' ) ) : ?>
						<a class="avibi-logo-mobile" href="<?php echo esc_url( avibi_blog_site_url( '/' ) ); ?>"><img alt="<?php bloginfo( 'name' ); ?>" width="32" height="32" src="<?php echo esc_url( avibi_blog_image_option( 'header_logo_mobile', 'img/favicon-avibi.svg' ) ); ?>"></a>
						<a class="avibi-logo-desktop" href="<?php echo esc_url( avibi_blog_site_url( '/' ) ); ?>"><img alt="<?php bloginfo( 'name' ); ?>" width="190" height="28" src="<?php echo esc_url( avibi_blog_image_option( 'header_logo', 'img/avibigateway-beta.svg' ) ); ?>"><?php if ( avibi_blog_show( 'header_show_beta' ) && avibi_blog_option( 'header_beta_text' ) ) : ?><span class="avibi-beta"><?php echo esc_html( avibi_blog_option( 'header_beta_text' ) ); ?></span><?php endif; ?></a>
					<?php endif; ?>
				</div>

				<?php if ( $avibi_nav ) : ?>
					<nav class="avibi-nav" aria-label="Điều hướng chính">
						<?php foreach ( $avibi_nav as $item ) : ?>
							<a<?php echo avibi_blog_link_attrs( $item ); // phpcs:ignore WordPress.Security.EscapeOutput ?>><div class="avibi-nav-pill<?php echo $item['active'] ? ' is-active' : ''; ?>"><span><?php echo esc_html( $item['title'] ); ?></span></div></a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>

				<div class="avibi-header-actions">
					<?php if ( $avibi_show_lang ) : ?>
						<div class="avibi-lang">
							<button type="button" class="avibi-lang-button" aria-haspopup="menu" aria-expanded="false" data-avibi-lang-toggle><img alt="" width="20" height="20" src="<?php echo esc_url( avibi_blog_asset( 'img/flag-vi.svg' ) ); ?>"><?php echo esc_html( avibi_blog_option( 'lang_vi_label' ) ); ?><img alt="" width="16" height="16" src="<?php echo esc_url( avibi_blog_asset( 'img/chevron.svg' ) ); ?>"></button>
						</div>
					<?php endif; ?>
					<?php if ( $avibi_show_curr ) : ?>
						<div class="avibi-currency" role="group" aria-label="Đơn vị tiền hiển thị">
							<?php foreach ( $avibi_currencies as $avibi_i => $avibi_code ) : ?>
								<button type="button"<?php echo 0 === $avibi_i ? ' class="is-active"' : ''; ?> aria-pressed="<?php echo 0 === $avibi_i ? 'true' : 'false'; ?>" data-avibi-currency="<?php echo esc_attr( $avibi_code ); ?>"><?php echo esc_html( $avibi_code ); ?></button>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<?php if ( $avibi_show_login ) : ?>
						<a class="avibi-login" href="<?php echo esc_url( $avibi_login_url ); ?>"><?php echo esc_html( $avibi_login_text ); ?></a>
					<?php endif; ?>
				</div>

				<div class="avibi-header-mobile">
					<?php if ( $avibi_show_lang ) : ?>
						<button type="button" aria-label="Ngôn ngữ: <?php echo esc_attr( avibi_blog_option( 'lang_vi_short' ) ); ?>" class="avibi-chip" aria-haspopup="menu" aria-expanded="false" data-avibi-lang-toggle><img alt="" width="20" height="20" src="<?php echo esc_url( avibi_blog_asset( 'img/flag-vi.svg' ) ); ?>"><?php echo esc_html( avibi_blog_option( 'lang_vi_short' ) ); ?></button>
					<?php endif; ?>
					<?php if ( $avibi_show_curr ) : ?>
						<button type="button" aria-label="Đơn vị tiền hiển thị: <?php echo esc_attr( $avibi_currencies[0] ); ?>" class="avibi-chip" data-avibi-currency-cycle="<?php echo esc_attr( implode( ',', $avibi_currencies ) ); ?>"><?php echo esc_html( $avibi_currencies[0] ); ?></button>
					<?php endif; ?>
					<?php if ( $avibi_nav || $avibi_show_login ) : ?>
						<button type="button" class="avibi-burger" aria-label="Toggle menu" aria-expanded="false" aria-controls="avibi-mobile-menu" data-avibi-menu-toggle><span></span><span></span><span></span></button>
					<?php endif; ?>
				</div>

				<?php if ( $avibi_show_lang ) : ?>
					<div class="avibi-lang-menu" role="menu" hidden data-avibi-lang-menu>
						<a role="menuitem" class="is-active" href="<?php echo esc_url( avibi_blog_home_url() ); ?>"><img alt="" width="20" height="20" src="<?php echo esc_url( avibi_blog_asset( 'img/flag-vi.svg' ) ); ?>"><?php echo esc_html( avibi_blog_option( 'lang_vi_label' ) ); ?></a>
						<?php if ( avibi_blog_option( 'en_url' ) ) : ?>
							<a role="menuitem" href="<?php echo esc_url( avibi_blog_option( 'en_url' ) ); ?>"><img alt="" width="20" height="20" src="<?php echo esc_url( avibi_blog_asset( 'img/flag-en.svg' ) ); ?>"><?php echo esc_html( avibi_blog_option( 'lang_en_label' ) ); ?></a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</header>

		<?php if ( $avibi_nav || $avibi_show_login ) : ?>
			<div class="avibi-mobile-menu" id="avibi-mobile-menu" hidden data-avibi-mobile-menu>
				<?php if ( $avibi_nav ) : ?>
					<nav aria-label="Điều hướng chính">
						<?php foreach ( $avibi_nav as $item ) : ?>
							<a class="avibi-mobile-link<?php echo $item['active'] ? ' is-active' : ''; ?>"<?php echo avibi_blog_link_attrs( $item ); // phpcs:ignore WordPress.Security.EscapeOutput ?>><?php echo esc_html( $item['title'] ); ?></a>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
				<?php if ( $avibi_show_login ) : ?>
					<a class="avibi-login avibi-login--block" href="<?php echo esc_url( $avibi_login_url ); ?>"><?php echo esc_html( $avibi_login_text ); ?></a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
	<main class="avibi-main">
