<?php

function get_encoded_title_for_share()
{
  // トップ以外はタイトルに「｜サイト名」を含める
  $title = get_page_title();
  if (!is_front_page() && !is_home()) {
    $title .= ' - ' . get_bloginfo('name');
  }
  return urlencode($title);
}

function get_tweet_url($url, $title)
{
  $via = '&via=hurikura';
  return 'https://twitter.com/share?url=' . $url . '&text=' . $title . $via;
}

function get_fb_share_url($url)
{
  return 'https://www.facebook.com/share.php?u=' . $url;
}

function insert_social_buttons($type = null)
{
  $encoded_url = urlencode(get_current_url());
  $encoded_title = get_encoded_title_for_share();

?>
  <div class="share">
    <span><i class="fa-solid fa-share-nodes"></i> シェア</span>
    <div class="share-warp">
      <a href="<?php echo get_tweet_url($encoded_url, $encoded_title); ?>" class="share-button">
        <i class="fa-brands fa-twitter"></i>
      </a>
      <a href="<?php echo get_fb_share_url($encoded_url); ?>" class="share-button">
        <i class="fa-brands fa-facebook"></i>
      </a>
    </div>
  </div>
<?php // END シェアボタン
}
