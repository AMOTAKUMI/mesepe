<?php
//http://magonote.skr.jp/custom-2/

function create_post_type() {
  $custom01 = 'custom01';
  $custom02 = 'custom02';

  $labels01 = array(
    'name' => __('カスタム投稿01'),
    'singular_name' => __('カスタム投稿01')
  );
  $labels02 = array(
    'name' => __('カスタム投稿02'),
    'singular_name' => __('カスタム投稿02')
  );

  $type_args01 = array(
    'labels'        => $labels01,
    'public'        => true,
    'has_archive'   => true,
    'menu_position' => 5,
    'supports'      => array(
      'title',
      'editor',
      'thumbnail'
    )
  );

  $type_args02 = array(
    'labels'        => $labels02,
    'public'        => true,
    'has_archive'   => true,
    'menu_position' => 6,
    'supports'      => array(
      'title',
      'editor',
      'thumbnail'
    )
  );

  $tax_args = array(
    'hierarchical'          => true,
    'update_count_callback' => '_update_post_term_count',
    'label'                 => 'カテゴリー',
    'singular_label'        => 'カテゴリー',
    'public'                => true,
    'show_ui'               => true
  );

  register_post_type($custom01, $type_args01);
  register_post_type($custom02, $type_args02);
  register_taxonomy($custom01.'_cat', 'custom01', $tax_args);
  register_taxonomy($custom02,'_cat', 'custom02', $tax_args);

}
add_action( 'init', 'create_post_type' );
?>
