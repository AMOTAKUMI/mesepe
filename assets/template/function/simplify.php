<?php
// 管理バー項目非表示
function remove_admin_bar_menu( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu('wp-logo');      // Wロゴ
    //$wp_admin_bar->remove_menu('site-name');  // サイト名
    $wp_admin_bar->remove_menu('view-site');    // サイト名 -> サイトを表示
    $wp_admin_bar->remove_menu('comments');     // コメント
    $wp_admin_bar->remove_menu('new-content');  // 新規
    $wp_admin_bar->remove_menu('new-post');     // 新規 -> 投稿
    $wp_admin_bar->remove_menu('new-media');    // 新規 -> メディア
    $wp_admin_bar->remove_menu('new-link');     // 新規 -> リンク
    $wp_admin_bar->remove_menu('new-page');     // 新規 -> 固定ページ
    $wp_admin_bar->remove_menu('new-user');     // 新規 -> ユーザー
    $wp_admin_bar->remove_menu('updates');      // 更新
    $wp_admin_bar->remove_menu('my-account');   // マイアカウント
    $wp_admin_bar->remove_menu('user-info');    // マイアカウント -> プロフィール
    $wp_admin_bar->remove_menu('edit-profile'); // マイアカウント -> プロフィール編集
    $wp_admin_bar->remove_menu('logout');       // マイアカウント -> ログアウト
}
add_action( 'admin_bar_menu', 'remove_admin_bar_menu', 70 );

// 管理バーログアウト追加
function add_new_item_in_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu(array(
        'id' => 'new_item_in_admin_bar',
        'title' => __('ログアウト'),
        'href' => wp_logout_url()
    ));
}
add_action('wp_before_admin_bar_render', 'add_new_item_in_admin_bar');

// デフォルトウィジェット非表示
function unregister_default_widget() {
    unregister_widget('WP_Widget_Pages');            // 固定ページ
    unregister_widget('WP_Widget_Calendar');         // カレンダー
    unregister_widget('WP_Widget_Archives');         // アーカイブ
    unregister_widget('WP_Widget_Meta');             // メタ情報
    unregister_widget('WP_Widget_Search');           // 検索
    unregister_widget('WP_Widget_Text');             // テキスト
    unregister_widget('WP_Widget_Categories');       // カテゴリー
    unregister_widget('WP_Widget_Recent_Posts');     // 最近の投稿
    unregister_widget('WP_Widget_Recent_Comments');  // 最近のコメント
    unregister_widget('WP_Widget_RSS');              // RSS
    unregister_widget('WP_Widget_Tag_Cloud');        // タグクラウド
    unregister_widget('WP_Nav_Menu_Widget');         // カスタムメニュー
    unregister_widget('Twenty_Fourteen_Ephemera_Widget');  // Twenty Fourteen 短冊
}
add_action( 'widgets_init', 'unregister_default_widget' );

// ダッシュボードウィジェット非表示
function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);      // 現在の状況
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);// 最近のコメント
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // 被リンク
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);        // プラグイン
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);       // アクティビティ
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);      // クイック投稿
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);    // 最近の下書き
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);          // WordPressブログ
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);        // WordPressフォーラム
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets');

//HTMLソース整頓
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'print_emoji_detection_script', 7 );
remove_action('wp_print_styles', 'print_emoji_styles', 10 );
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
remove_action('template_redirect', 'rest_output_link_header', 11 );
add_theme_support( 'automatic-feed-links' );

//DNSプリフェッチ削除
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
function remove_dns_prefetch( $hints, $relation_type ) {
	if ( 'dns-prefetch' === $relation_type ) {
		return array_diff( wp_dependencies_unique_hosts(), $hints );
	}
	return $hints;
}
?>
