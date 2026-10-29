<?php
/**
 * Blog home — layout of https://avibi.ai/blogs
 */

defined( 'ABSPATH' ) || exit;

if ( ! avibi_blog_is_view() ) {
	require get_template_directory() . '/index.php';
	return;
}

$avibi_announce = avibi_blog_announcements_term();
$avibi_exclude  = $avibi_announce ? array( $avibi_announce->term_id ) : array();
$avibi_sticky   = array_map( 'intval', (array) get_option( 'sticky_posts' ) );

$avibi_featured = array();
if ( avibi_blog_show( 'home_show_featured' ) ) {
	$avibi_featured = get_posts(
		array(
			'posts_per_page'      => 1,
			'post__not_in'        => $avibi_sticky,
			'category__not_in'    => $avibi_exclude,
			'ignore_sticky_posts' => true,
		)
	);
}

$avibi_rows = array();
if ( avibi_blog_show( 'home_show_rows' ) && (int) avibi_blog_option( 'row_count' ) > 0 ) {
	$avibi_rows = get_posts(
		array(
			'posts_per_page'      => (int) avibi_blog_option( 'row_count' ),
			'post__not_in'        => array_merge( $avibi_sticky, wp_list_pluck( $avibi_featured, 'ID' ) ),
			'category__not_in'    => $avibi_exclude,
			'ignore_sticky_posts' => true,
		)
	);
}

$avibi_sidebar = avibi_blog_show( 'home_show_sidebar' );

$avibi_pinned = array();
if ( $avibi_sidebar && $avibi_sticky && avibi_blog_show( 'home_show_pinned' ) && (int) avibi_blog_option( 'pinned_count' ) > 0 ) {
	$avibi_pinned = get_posts(
		array(
			'posts_per_page'      => (int) avibi_blog_option( 'pinned_count' ),
			'post__in'            => $avibi_sticky,
			'ignore_sticky_posts' => true,
		)
	);
}

$avibi_recent = array();
if ( $avibi_sidebar && $avibi_announce && avibi_blog_show( 'home_show_recent' ) && (int) avibi_blog_option( 'recent_count' ) > 0 ) {
	$avibi_recent = get_posts(
		array(
			'posts_per_page'      => (int) avibi_blog_option( 'recent_count' ),
			'cat'                 => $avibi_announce->term_id,
			'ignore_sticky_posts' => true,
		)
	);
}

$avibi_sidebar   = $avibi_pinned || $avibi_recent;
$avibi_all_link  = avibi_blog_show( 'home_show_all_link' );
$avibi_rss_link  = avibi_blog_show( 'home_show_rss' );

$avibi_eager = 2; // First two row images load eagerly, like avibi.ai.

get_header( 'avibi' );
?>
<div class="blog-browse-shell">
	<h1 class="sr-only">Blog</h1>
	<p class="sr-only">Cập nhật sản phẩm, chia sẻ kiến thức và hướng dẫn ứng dụng AI cùng đội ngũ Avibi.</p>
	<div class="blog-discovery-content">
		<?php if ( avibi_blog_show( 'home_show_categories' ) ) : ?>
		<div class="blog-toolbar">
			<nav aria-label="Danh mục bài viết" class="blog-category-nav">
				<ul class="blog-category-list">
					<?php foreach ( avibi_blog_category_items() as $item ) : ?>
						<li><a class="blog-category-link"<?php echo $item['active'] ? ' aria-current="page"' : ''; ?><?php echo avibi_blog_link_attrs( $item ); // phpcs:ignore WordPress.Security.EscapeOutput ?>><?php echo esc_html( $item['title'] ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</nav>
		</div>
		<?php endif; ?>

		<div class="blog-discovery-layout<?php echo $avibi_sidebar ? '' : ' is-no-sidebar'; ?>">
			<div class="blog-primary">
				<div class="blog-browse-results">
					<?php if ( ! $avibi_featured && ! $avibi_rows ) : ?>
						<div class="blog-empty-state">
							<h2>Chưa có bài viết</h2>
							<p>Bài viết mới sẽ xuất hiện tại đây.</p>
						</div>
					<?php endif; ?>

					<?php foreach ( $avibi_featured as $avibi_post ) : ?>
						<?php avibi_blog_story( $avibi_post, 'featured', array( 'loading' => 'eager' ) ); ?>
					<?php endforeach; ?>

					<?php if ( $avibi_rows ) : ?>
						<section aria-label="Bài viết gần đây" class="blog-post-list">
							<?php foreach ( $avibi_rows as $avibi_i => $avibi_post ) : ?>
								<?php avibi_blog_story( $avibi_post, 'row', array( 'loading' => $avibi_i < $avibi_eager ? 'eager' : 'lazy' ) ); ?>
							<?php endforeach; ?>
						</section>
					<?php endif; ?>
				</div>

				<?php if ( $avibi_all_link || $avibi_rss_link ) : ?>
				<div class="blog-discovery-footer">
					<?php if ( $avibi_all_link ) : ?>
						<a href="<?php echo esc_url( avibi_blog_all_url() ); ?>"><?php echo esc_html( avibi_blog_option( 'home_all_text' ) ); ?></a>
					<?php else : ?>
						<span></span>
					<?php endif; ?>
					<?php if ( $avibi_rss_link ) : ?>
						<a href="<?php echo esc_url( get_feed_link() ); ?>" aria-label="RSS" class="blog-feed-link"><img alt="" width="14" height="14" src="<?php echo esc_url( avibi_blog_asset( 'img/blog-rss.svg' ) ); ?>">RSS</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<?php if ( $avibi_sidebar ) : ?>
			<aside class="blog-sidebar">
				<?php if ( $avibi_pinned ) : ?>
					<section class="blog-sidebar-cards" aria-label="Bài viết ghim">
						<?php foreach ( $avibi_pinned as $avibi_post ) : ?>
							<?php avibi_blog_story( $avibi_post, 'card' ); ?>
						<?php endforeach; ?>
					</section>
				<?php endif; ?>

				<?php if ( $avibi_recent ) : ?>
					<section class="blog-recent" aria-labelledby="blog-recent-title">
						<h2 id="blog-recent-title"><?php echo esc_html( avibi_blog_option( 'recent_title' ) ); ?></h2>
						<ul>
							<?php foreach ( $avibi_recent as $avibi_post ) : ?>
								<li><a href="<?php echo esc_url( get_permalink( $avibi_post ) ); ?>"><span><?php echo esc_html( get_the_title( $avibi_post ) ); ?></span><?php echo avibi_blog_time( $avibi_post, 'long' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></a></li>
							<?php endforeach; ?>
						</ul>
						<a class="blog-recent-more" href="<?php echo esc_url( get_category_link( $avibi_announce ) ); ?>"><?php echo esc_html( avibi_blog_option( 'recent_more_text' ) ); ?> <span aria-hidden="true">→</span></a>
					</section>
				<?php endif; ?>
			</aside>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php
get_footer( 'avibi' );
