<?php

/**
 * 前の記事へ、次の記事へ
 */
$prev_post = get_adjacent_post(false, '', true);
$next_post = get_adjacent_post(false, '', false);
if ($prev_post || $next_post) :
?>
  <div class="prnx_box">
    <?php
    if ($prev_post) :
      $prev_id = $prev_post->ID;
    ?>
      <a href="<?php the_permalink($prev_id); ?>" class="prnx pr">
        <p>前の記事</p>
      </a>
    <?php
    endif;
    if ($next_post) :
      $next_id = $next_post->ID;
    ?>
      <a href="<?php the_permalink($next_id); ?>" class="prnx nx">
        <p>次の記事</p>
      </a>
    <?php endif; ?>
  </div>
<?php endif; ?>