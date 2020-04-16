<?php
// パンくずリスト
function breadcrumbs(){
  global $post;
  global $wp_query;
  $post_type        = $wp_query->query_vars["post_type"];
  $name             = get_post_type_object($post_type)->labels->name;
  $single           = get_post();
  $post_type_single = $single->post_type;
  $name_single   = get_post_type_object($post_type_single)->label;

  $str       = '';
  $index     = 1;
  if(!is_home()&&!is_admin()){
    $str.= '<ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumbs__li c-flex">';
    $str.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.home_url().'"><span itemprop="name">TOP</span></a><meta itemprop="position" content="1" /></li>';
    if(is_category()) {
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.home_url().'/'.$post_type_single.'" itemprop="url"><span itemprop="name">'.$name_single.'</span></a><meta itemprop="position" content="2" /></li>';
      $cat    = get_the_category();
      $cat_q  = get_queried_object();
      $cat_id = $cat_q->cat_ID;
      $ancestors = array_reverse(get_ancestors($cat_id,'category'));
      $index++;
      foreach($ancestors as $ancestor){
        $index++;
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($ancestor).'" itemprop="url"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
      }
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($cat[0]->cat_ID).'" itemprop="url"><span itemprop="name">'.single_cat_title('', false).'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
    }elseif(is_tax()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.home_url().'/'.$post_type_single.'" itemprop="url"><span itemprop="name">'.$name_single.'</span></a><meta itemprop="position" content="2" /></li>';
      $term = get_queried_object();
      $ancestors = array_reverse(get_ancestors($term->term_taxonomy_id,$wp_query->query_vars["taxonomy"]));
      $index++;
      foreach($ancestors as $ancestor){
        $index++;
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($ancestor).'" itemprop="url"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
      }
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($term).'" itemprop="url"><span itemprop="name">'.$term->name.'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
    }elseif(is_page()){
      if($post->post_parent != 0 ){
        $ancestors = array_reverse(get_post_ancestors($post->ID));
        foreach($ancestors as $ancestor){
          $index++;
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_permalink($ancestor).'" itemprop="url"><span itemprop="name">'.get_the_title($ancestor).'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
        }
      }
    }elseif(is_archive()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.home_url().'/'.$post_type.'" itemprop="url"><span itemprop="name">'.$name.'</span></a><meta itemprop="position" content="2" /></li>';
    }elseif(is_single()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.home_url().'/'.$post_type_single.'" itemprop="url"><span itemprop="name">'.$name_single.'</span></a><meta itemprop="position" content="2" /></li>';
      $cat       = get_the_category();
      $cat_id    = $cat[0]->term_id;
      $post_type = $wp_query->query_vars["post_type"];
      $terms = get_the_terms($post->ID,$post_type.'_cat');
      if ($cat_id == 0) {
        $ancestors = array_reverse(get_ancestors($terms[0]->term_id,'custom01_cat'));
        foreach($ancestors as $ancestor){
          $index++;
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($ancestor).'" itemprop="url"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
        }
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($terms[0]).'" itemprop="url"><span itemprop="name">'.$terms[0]->name.'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_the_permalink().'" itemprop="url"><span itemprop="name">'.get_the_title().'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
      } else {
        $ancestors = array_reverse(get_ancestors($cat_id,'category'));
        foreach($ancestors as $ancestor){
          $index++;
          $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($ancestor).'" itemprop="url"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
        }
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_category_link($cat[0]).'" itemprop="url"><span itemprop="name">'.$cat[0]->name.'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
        $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_the_permalink().'" itemprop="url"><span itemprop="name">'.get_the_title().'</span></a><meta itemprop="position" content="'.++$index.'" /></li>';
      }
    }elseif(is_search()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_the_permalink().'" itemprop="url"><span itemprop="name">検索結果</span></a><meta itemprop="position" content="2" /></li>';
    }elseif(is_404()){
      $str.='<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.get_the_permalink().'" itemprop="url"><span itemprop="name">ページがみつかりませんでした。</span></a><meta itemprop="position" content="2" /></li>';
    }
    $str.='</ol>';
  }
  echo $str;
}
?>
