<?php
/**
 * Footer for Avibi blog views.
 */

defined( 'ABSPATH' ) || exit;

$avibi_footer_cols = array();

if ( avibi_blog_show( 'footer_show_col1' ) ) {
	$avibi_footer_cols[] = array(
		avibi_blog_option( 'footer_col1_title' ),
		avibi_blog_menu_items(
			'avibi_blog_footer_products',
			array(
				array( 'title' => 'Mô hình', 'url' => avibi_blog_site_url( '/models' ), 'active' => false, 'target' => '' ),
				array( 'title' => 'Bảng giá', 'url' => avibi_blog_site_url( '/pricing' ), 'active' => false, 'target' => '' ),
			)
		),
	);
}

if ( avibi_blog_show( 'footer_show_col2' ) ) {
	$avibi_footer_cols[] = array(
		avibi_blog_option( 'footer_col2_title' ),
		avibi_blog_menu_items(
			'avibi_blog_footer_about',
			array(
				array( 'title' => 'Về chúng tôi', 'url' => avibi_blog_site_url( '/about-us' ), 'active' => false, 'target' => '' ),
				array( 'title' => 'Liên hệ', 'url' => avibi_blog_site_url( '/contact' ), 'active' => false, 'target' => '' ),
				array( 'title' => 'Chính sách thanh toán', 'url' => avibi_blog_site_url( '/payment-policy' ), 'active' => false, 'target' => '' ),
				array( 'title' => 'Chính sách bảo vệ dữ liệu cá nhân', 'url' => avibi_blog_site_url( '/privacy' ), 'active' => false, 'target' => '' ),
				array( 'title' => 'Điều khoản sử dụng dịch vụ', 'url' => avibi_blog_site_url( '/terms' ), 'active' => false, 'target' => '' ),
			)
		),
	);
}

$avibi_show_logo    = avibi_blog_show( 'footer_show_logo' );
$avibi_company      = avibi_blog_show( 'footer_show_company' ) ? avibi_blog_company_lines() : array();
$avibi_show_contact = avibi_blog_show( 'footer_show_contacts' );
$avibi_email        = $avibi_show_contact ? trim( avibi_blog_option( 'footer_email' ) ) : '';
$avibi_phone        = $avibi_show_contact ? trim( avibi_blog_option( 'footer_phone' ) ) : '';
$avibi_copyright    = str_replace( '{year}', wp_date( 'Y' ), avibi_blog_option( 'footer_copyright' ) );
$avibi_has_top      = $avibi_show_logo || $avibi_company || $avibi_footer_cols;
$avibi_has_bottom   = $avibi_email || $avibi_phone;
?>
	</main>
	<?php if ( avibi_blog_show( 'footer_show' ) ) : ?>
	<footer class="avibi-footer">
		<?php if ( $avibi_has_top || $avibi_has_bottom ) : ?>
		<div class="avibi-footer-container">
			<?php if ( $avibi_has_top ) : ?>
			<div class="avibi-footer-top">
				<?php if ( $avibi_show_logo || $avibi_company ) : ?>
				<div class="avibi-footer-info">
					<?php if ( $avibi_show_logo ) : ?>
						<img alt="<?php bloginfo( 'name' ); ?>" width="207" height="42" class="avibi-footer-logo" src="<?php echo esc_url( avibi_blog_image_option( 'footer_logo', 'img/avibigateway.svg' ) ); ?>">
					<?php endif; ?>
					<?php if ( $avibi_company ) : ?>
						<div class="avibi-footer-company">
							<?php foreach ( $avibi_company as $avibi_line ) : ?>
								<p><?php if ( $avibi_line[0] ) : ?><span class="avibi-fw-medium"><?php echo esc_html( $avibi_line[0] ); ?>: </span><?php endif; ?><?php if ( $avibi_line[2] ) : ?><a href="<?php echo esc_url( $avibi_line[2] ); ?>" target="_blank" rel="noreferrer"><?php echo esc_html( $avibi_line[1] ); ?></a><?php else : ?><span><?php echo esc_html( $avibi_line[1] ); ?></span><?php endif; ?></p>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
				<?php if ( $avibi_footer_cols ) : ?>
				<nav aria-label="Điều hướng chân trang" class="avibi-footer-nav">
					<?php foreach ( $avibi_footer_cols as $avibi_col ) : ?>
						<div class="avibi-footer-col">
							<?php if ( $avibi_col[0] ) : ?><h2><?php echo esc_html( $avibi_col[0] ); ?></h2><?php endif; ?>
							<div class="avibi-footer-links">
								<?php foreach ( $avibi_col[1] as $item ) : ?>
									<a<?php echo avibi_blog_link_attrs( $item ); // phpcs:ignore WordPress.Security.EscapeOutput ?>><?php echo esc_html( $item['title'] ); ?></a>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</nav>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php if ( $avibi_has_top && $avibi_has_bottom ) : ?>
			<div class="avibi-footer-divider"></div>
			<?php endif; ?>
			<?php if ( $avibi_has_bottom ) : ?>
			<div class="avibi-footer-bottom">
				<div class="avibi-footer-contacts">
					<?php if ( $avibi_phone ) : ?>
					<a href="tel:<?php echo esc_attr( $avibi_phone ); ?>" class="avibi-footer-contact"><span class="avibi-footer-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M4.718 3.092c1.226-1.291 3.254-1.05 4.268.384l1.26 1.784c.811 1.147.743 2.74-.225 3.76l-.245.257l-.002.006c-.013.036-.045.152-.013.372c.067.455.418 1.381 1.846 2.884c1.432 1.508 2.3 1.863 2.703 1.929a.6.6 0 0 0 .294-.007l.408-.43c.874-.92 2.236-1.101 3.335-.469l1.91 1.1c1.633.94 2.013 3.239.708 4.613l-1.42 1.495c-.443.467-1.048.866-1.795.94c-1.824.18-6.049-.055-10.478-4.719c-4.134-4.351-4.919-8.136-5.018-9.985l.666-.036l-.666.036c-.049-.914.358-1.697.894-2.262zm3.043 1.25c-.512-.724-1.433-.768-1.956-.217l-1.570 1.652c-.33.35-.505.75-.483 1.149c.08 1.51.731 4.952 4.607 9.032c4.064 4.28 7.809 4.4 9.244 4.259c.283-.028.575-.186.854-.48l1.42-1.495c.614-.646.453-1.808-.368-2.28l-1.91-1.1c-.513-.295-1.114-.204-1.499.202l-.456.48l-.527-.501c.527.5.527.501.526.502l-.001.001l-.003.004l-.007.006l-.014.014a1 1 0 0 1-.136.112c-.08.056-.186.119-.321.172c-.276.109-.64.167-1.091.094c-.878-.142-2.028-.773-3.55-2.376c-1.528-1.608-2.113-2.807-2.243-3.7c-.067-.454-.014-.817.084-1.092a1.6 1.6 0 0 1 .23-.427l.03-.037l.014-.015l.006-.007l.003-.003l.002-.001s0-.002.533.503l-.532-.505l.287-.302c.445-.469.51-1.263.088-1.86z" clip-rule="evenodd"/><path fill="currentColor" d="M13.26 1.88a.75.75 0 0 1 .861-.62c.025.005.107.02.15.03q.129.027.352.09c.297.087.712.23 1.21.458c.996.457 2.321 1.256 3.697 2.631c1.376 1.376 2.175 2.702 2.632 3.698c.228.498.37.912.457 1.21a6 6 0 0 1 .113.454l.005.031a.765.765 0 0 1-.617.878a.75.75 0 0 1-.86-.617a3 3 0 0 0-.081-.327a7.4 7.4 0 0 0-.38-1.004c-.39-.85-1.092-2.024-2.33-3.262s-2.411-1.939-3.262-2.329a7.4 7.4 0 0 0-1.003-.38a6 6 0 0 0-.318-.08a.76.76 0 0 1-.626-.861"/><path fill="currentColor" fill-rule="evenodd" d="M13.486 5.33a.75.75 0 0 1 .927-.516l-.206.721l.207-.72h.002l.004.001l.007.002l.02.007q.023.006.057.019q.067.023.177.07c.145.062.344.158.589.303c.49.29 1.157.77 1.942 1.556c.785.785 1.267 1.453 1.556 1.942c.145.245.241.444.304.59a3 3 0 0 1 .089.233l.006.02l.002.008l.001.003v.002l-.72.207l.721-.206a.75.75 0 0 1-1.44.422l-.003-.01l-.035-.088a4 4 0 0 0-.216-.417c-.223-.376-.625-.946-1.325-1.646s-1.27-1.102-1.646-1.325a4 4 0 0 0-.504-.25l-.01-.004a.75.75 0 0 1-.506-.925" clip-rule="evenodd"/></svg></span><span><?php echo esc_html( $avibi_phone ); ?></span></a>
					<?php endif; ?>
					<?php if ( $avibi_email ) : ?>
					<a href="mailto:<?php echo antispambot( $avibi_email, 1 ); // phpcs:ignore WordPress.Security.EscapeOutput ?>" class="avibi-footer-contact"><span class="avibi-footer-icon" aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" fill-rule="evenodd" d="M9.944 3.25h4.112c1.838 0 3.294 0 4.433.153c1.172.158 2.121.49 2.870 1.238c.748.749 1.080 1.698 1.238 2.870c.153 1.140.153 2.595.153 4.433v.112c0 1.838 0 3.294-.153 4.433c-.158 1.172-.49 2.121-1.238 2.870c-.749.748-1.698 1.080-2.870 1.238c-1.140.153-2.595.153-4.433.153H9.944c-1.838 0-3.294 0-4.433-.153c-1.172-.158-2.121-.49-2.870-1.238c-.748-.749-1.080-1.698-1.238-2.870c-.153-1.140-.153-2.595-.153-4.433v-.112c0-1.838 0-3.294.153-4.433c.158-1.172.49-2.121 1.238-2.870c.749-.748 1.698-1.080 2.870-1.238c1.140-.153 2.595-.153 4.433-.153M5.710 4.890c-1.006.135-1.586.389-2.010.812c-.422.423-.676 1.003-.811 2.009c-.138 1.028-.14 2.382-.14 4.289s.002 3.262.14 4.290c.135 1.005.389 1.585.812 2.008s1.003.677 2.009.812c1.028.138 2.382.14 4.289.14h4c1.907 0 3.262-.002 4.290-.14c1.005-.135 1.585-.389 2.008-.812s.677-1.003.812-2.009c.138-1.028.14-2.382.14-4.289s-.002-3.261-.14-4.290c-.135-1.005-.389-1.585-.812-2.008s-1.003-.677-2.009-.812c-1.027-.138-2.382-.14-4.289-.14h-4c-1.907 0-3.261.002-4.290.14m-.287 2.630a.75.75 0 0 1 1.056-.096L8.640 9.223c.933.777 1.580 1.315 2.128 1.667c.529.34.888.455 1.233.455s.704-.114 1.233-.455c.547-.352 1.195-.89 2.128-1.667l2.159-1.8a.75.75 0 1 1 .96 1.153l-2.196 1.830c-.887.74-1.605 1.338-2.240 1.746c-.66.425-1.303.693-2.044.693s-1.384-.269-2.045-.693c-.634-.408-1.352-1.007-2.239-1.745L5.520 8.577a.75.75 0 0 1-.096-1.057" clip-rule="evenodd"/></svg></span><span><?php echo antispambot( $avibi_email ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span></a>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if ( avibi_blog_show( 'footer_show_copyright' ) && $avibi_copyright ) : ?>
		<div class="avibi-copyright<?php echo ( $avibi_has_top || $avibi_has_bottom ) ? '' : ' is-alone'; ?>"><p><?php echo esc_html( $avibi_copyright ); ?></p></div>
		<?php endif; ?>
	</footer>
	<?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
