<?php
// ビルトイン投稿アーカイブ有効化
function post_has_archive( $args, $post_type ) {
	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'post'; // ページ名
	}
	return $args;
}
add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );
add_theme_support( 'post-thumbnails' );
?>
