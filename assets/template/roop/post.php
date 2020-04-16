<li class="c-flex is-reset">
  <div class="post_li__imgbox">
    <a class="c-hover" href="<?php the_permalink(); ?>"><img src="<?php echo get_thumb(); ?>" alt="<?php the_title(); ?>"></a>
  </div>
  <div class="post_li__txtbox">
    <time class="post_li__time" datetime="<?php the_time( 'Y-m-d' ); ?>"><?php the_time( 'Y/m/d' ); ?></time>
    <ul class="post_li__cat_li c-flex">CAT:
    <?php
    $cat               = get_the_category();
    $cat_id            = $cat[0]->term_id;
    $post_type         = $wp_query->query_vars["post_type"];
    $single            = get_post();
    $post_type_single  = $single->post_type;
    if(is_tax())$terms = get_the_terms($post->ID,$post_type_single.'_cat');
    else $terms = get_the_terms($post->ID,$post_type.'_cat');
    if ($cat_id == 0) {
      $class = 'is-' . $terms[0]->slug;
      $ancestors = array_reverse(get_ancestors($terms[0]->term_id,$post_type.'_cat'));
      foreach($ancestors as $ancestor){
        $index++;
        $str.='<li><a class="'.$class.'" href="'.get_category_link($ancestor).'">'.get_cat_name($ancestor).'</a></li>';
      }
      $str.='<li><a class="'.$class.'" href="'.get_category_link($terms[0]).'">'.$terms[0]->name.'</a></li>';
    } else {
      $class = 'is-' . $cat[0]->slug;
      $ancestors = array_reverse(get_ancestors($cat_id,'category'));
      foreach($ancestors as $ancestor){
        $index++;
        $str.='<li><a class="'.$class.'" href="'.get_category_link($ancestor).'" itemprop="url"><span itemprop="name">'.get_cat_name($ancestor).'</span></a><meta itemprop="position" content="'.$index.'" /></li>';
      }
      $str.='<li><a class="'.$class.'" href="'.get_category_link($cat[0]).'">'.$cat[0]->name.'</a></li>';
    }
    echo $str;
    ?>
    </ul>
    <h3 class="post_li__ttl is-ttl03"><a href="<?php the_permalink(); ?>">TTL:<?php the_title(); ?></a><h3>
    <p class="post_li__lead">CNT:<?php echo get_cnt(10, '...'); ?></p>
  </div>
</li>
