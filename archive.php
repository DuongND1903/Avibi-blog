<?php
/**
 * Post archives (category, tag, author, date) — layout of https://avibi.ai/blogs/category/…
 */

defined( 'ABSPATH' ) || exit;

if ( ! avibi_blog_is_view() ) {
	require get_template_directory() . '/index.php';
	return;
}

add_filter( 'get_the_archive_title_prefix', '__return_empty_string' );
$avibi_title = wp_strip_all_tags( get_the_archive_title() );

get_header( 'avibi' );
?>
<div class="blog-archive-shell">
	<?php if ( avibi_blog_show( 'archive_show_breadcrumb' ) ) : ?>
	<nav aria-label="Đường dẫn" class="blog-archive-breadcrumb"><a href="<?php echo esc_url( avibi_blog_home_url() ); ?>"><?php echo esc_html( avibi_blog_option( 'blog_label' ) ); ?></a><span aria-hidden="true">/</span><span aria-current="page"><?php echo esc_html( $avibi_title ); ?></span></nav>
	<?php endif; ?>
	<header class="blog-archive-header">
		<h1><?php echo esc_html( $avibi_title ); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div class="blog-archive-intro"><p><?php echo esc_html( wp_strip_all_tags( get_the_archive_description() ) ); ?></p></div>
		<?php endif; ?>
	</header>
	<?php
	global $wp_query;
	get_template_part(
		'template-parts/avibi/archive-list',
		null,
		array(
			'query'       => $wp_query,
			'illustrated' => true,
			'thumbnail'   => avibi_blog_show( 'archive_show_thumbnail' ),
			'excerpt'     => avibi_blog_show( 'archive_show_excerpt' ),
		)
	);
	?>
</div>
<?php
get_footer( 'avibi' );
