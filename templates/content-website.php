<?php
    if ( get_query_var('paged') )
      $paged = get_query_var('paged');
  elseif ( get_query_var('page') ) 
      $paged = get_query_var('page');
  else 
    $paged = 1;
    query_posts("post_type=websites&paged=$paged"); 
?>  
<?php while (have_posts()) : the_post(); ?>
  <?php the_content(); ?>
  <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
<?php endwhile; ?>
