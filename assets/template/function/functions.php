<?php

//記事文章
function get_cnt($num = -1, $except = '...'){
  $cnt = get_the_content();
  if(($num>-1)&&($num<mb_strlen($cnt))){
    $cnt  = mb_substr($cnt, 0, $num,"UTF-8");
    $cnt .= $except;
  }
  return $cnt;
}

//サムネイル取得
function get_thumb($thumb = 'medium'){
  $str = $post->post_content;
  $searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
  if(has_post_thumbnail()){
    $img = get_the_post_thumbnail_url(get_the_ID(), $thumb);
  }else if(preg_match( $searchPattern, $str, $imgurl)){
    $img = $imgurl[2];
  }else{
    $img = get_bloginfo('template_url').'/assets/img/common/default_img.png';
  }
  return $img;
}

?>
