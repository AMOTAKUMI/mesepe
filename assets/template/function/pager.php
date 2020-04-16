<?php

//ページャー
function pager($posts_per_page=5, $max=''){
  $paged = $_GET['page']?$_GET['page']:1;
  $base  = '//'.$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
  $url   = strtok($base, '?').'?page=';
  $prev  = strtok($base, '?').'?page='.($paged-1);
  $next  = strtok($base, '?').'?page='.($paged+1);
  $ceil  = ceil($max/$posts_per_page);
  echo '<ol class="pager c-flex is-center">';
  if($paged!=1) echo '<li class="pager__item pager--prev"><a href="'.$prev.'"><span>前へ</span></a></li>';
  for ($i=$paged;$i<=$pages+5;$i++){
    if($i==$paged)                                  echo '<li class="pager__item is-current"><span>'.$i.'</span></li>';
    else if($i<=$ceil) echo '<li class="pager__item"><a href="'.$url.$i.'"><span>'.$i.'</span></a></li>';
  }
  if($paged!=$ceil && $ceil)   echo '<li class="pager__item pager--next"><a href="'.$next.'"><span>次へ</span></a></li>';
  echo '</ol>';
}

?>
