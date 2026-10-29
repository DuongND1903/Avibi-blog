<?php
/**
 * Single post — layout of https://avibi.ai/blogs/{slug}
 */

defined( 'ABSPATH' ) || exit;

if ( ! avibi_blog_is_view() ) {
	require get_template_directory() . '/single.php';
	return;
}

get_header( 'avibi' );

while ( have_posts() ) :
	the_post();

	$avibi_cat = avibi_blog_primary_category();
	list( $avibi_content, $avibi_toc ) = avibi_blog_prepare_content( apply_filters( 'the_content', get_the_content() ) );

	if ( ! avibi_blog_show( 'single_show_toc' ) ) {
		$avibi_toc = array();
	}

	$avibi_byline = array();
	if ( avibi_blog_show( 'single_show_author' ) ) {
		$avibi_byline[] = esc_html( get_the_author() );
	}
	if ( avibi_blog_show( 'single_show_date' ) ) {
		$avibi_byline[] = avibi_blog_time( null, 'short' );
	}
	if ( avibi_blog_show( 'single_show_comments' ) ) {
		$avibi_byline[] = esc_html( get_comments_number() ) . ' bình luận';
	}

	$avibi_rel_count = avibi_blog_show( 'single_show_related' ) ? (int) avibi_blog_option( 'related_count' ) : 0;
	$avibi_related   = array();
	if ( $avibi_cat && $avibi_rel_count > 0 ) {
		$avibi_related = get_posts(
			array(
				'posts_per_page'      => $avibi_rel_count,
				'cat'                 => $avibi_cat->term_id,
				'post__not_in'        => array( get_the_ID() ),
				'ignore_sticky_posts' => true,
			)
		);
	}
	if ( count( $avibi_related ) < $avibi_rel_count ) {
		$avibi_related = array_merge(
			$avibi_related,
			get_posts(
				array(
					'posts_per_page'      => $avibi_rel_count - count( $avibi_related ),
					'post__not_in'        => array_merge( array( get_the_ID() ), wp_list_pluck( $avibi_related, 'ID' ) ),
					'ignore_sticky_posts' => true,
				)
			)
		);
	}
	?>
	<div class="blog-article-shell">
		<?php if ( avibi_blog_show( 'single_show_breadcrumb' ) ) : ?>
		<nav aria-label="Đường dẫn" class="blog-article-breadcrumb"><a href="<?php echo esc_url( avibi_blog_home_url() ); ?>"><?php echo esc_html( avibi_blog_option( 'blog_label' ) ); ?></a><span aria-hidden="true">/</span><?php if ( $avibi_cat ) : ?><a href="<?php echo esc_url( get_category_link( $avibi_cat ) ); ?>"><?php echo esc_html( $avibi_cat->name ); ?></a><span aria-hidden="true">/</span><?php endif; ?><span aria-current="page" class="blog-article-breadcrumb-title" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></span></nav>
		<?php endif; ?>

		<div class="blog-article-reading-layout">
			<?php if ( $avibi_toc ) : ?>
				<aside class="blog-article-toc"><?php get_template_part( 'template-parts/avibi/toc', null, array( 'items' => $avibi_toc ) ); ?></aside>
				<details class="blog-article-mobile-toc"><summary><?php echo esc_html( avibi_blog_option( 'toc_title' ) ); ?></summary><?php get_template_part( 'template-parts/avibi/toc', null, array( 'items' => $avibi_toc ) ); ?></details>
			<?php endif; ?>

			<div class="blog-article-main">
				<article <?php post_class( 'blog-article' ); ?>>
					<header class="blog-article-header">
						<h1><?php the_title(); ?></h1>
						<?php if ( $avibi_byline ) : ?>
						<p class="blog-article-byline"><?php echo implode( ' <span aria-hidden="true">·</span> ', $avibi_byline ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
						<?php endif; ?>
					</header>
					<?php if ( avibi_blog_show( 'single_show_cover' ) ) : ?>
						<?php echo avibi_blog_image( null, 'blog-article-cover', 'eager' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<?php endif; ?>
					<div class="blog-article-body"><div class="blog-content"><?php echo $avibi_content; // phpcs:ignore WordPress.Security.EscapeOutput ?></div></div>
					<?php
					wp_link_pages(
						array(
							'before' => '<nav class="blog-article-pages">',
							'after'  => '</nav>',
						)
					);
					?>
				</article>

				<?php if ( $avibi_related ) : ?>
					<section aria-labelledby="blog-related-heading" class="blog-related">
						<h2 id="blog-related-heading"><?php echo esc_html( avibi_blog_option( 'related_title' ) ); ?></h2>
						<div class="blog-post-grid">
							<?php foreach ( $avibi_related as $avibi_post ) : ?>
								<?php avibi_blog_story( $avibi_post, 'related' ); ?>
							<?php endforeach; ?>
						</div>
					</section>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
endwhile;

get_footer( 'avibi' );
