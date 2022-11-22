<?php

require_once 'library/functions/breadcrumb.php';
require_once 'library/functions/share-buttons.php';
require_once 'library/functions/entry-functions.php';

if (is_user_logged_in()) {
  require_once 'library/functions/custom-fields.php';
}

// 色々有効化

add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('post-thumbnails');
add_image_size('thumb-520', 520, 300, true);
add_image_size('thumb-160', 160, 160, true);
add_filter('document_title_separator', 'document_title_separator');
add_filter('document_title_parts', '__document_title_parts');

// titleタグを変更

function document_title_separator($sep)
{
  $sep = '-';
  return $sep;
}

// 著者ページとアーカイブページのタイトルを変更

function __document_title_parts($title_part)
{
  if (is_author()) {
    $title_part['title'] .= 'の記事一覧';
  } elseif (is_archive()) {
    $title_part['title'] = '「' . $title_part['title'] . '」の記事一覧';
  }
  return $title_part;
}

// Canonical URL

function filter_canonical_url($default_url, $post)
{
  if (!is_singular() || !$post) return $default_url;
  $custom_url = get_post_meta($post->ID, 'canonical_url', true);
  return ($custom_url && strlen($custom_url) > 1) ? $custom_url : $default_url;
};
add_filter('get_canonical_url', 'filter_canonical_url', 10, 2);

// サムネイル画像を登録

function mytheme_customize_register($wp_customize)
{
  $wp_customize->add_setting('ga_code', array(
    'default' => 0,
    'type' => 'option'
  ));

  $wp_customize->add_control(
    new WP_Customize_Control(
      $wp_customize,
      'ga_code',
      array(
        'label'          => 'トラッキングID',
        'value' => get_option('ga_code', ''),
        'description' => 'トラッキングID（G-から始まる）を貼り付けてください。',
        'section'        => 'title_tagline',
        'settings'       => 'ga_code',
        'type'           => 'text'
      )
    )
  );
}
add_action('customize_register', 'mytheme_customize_register');

//SVGをアップロードを許可
//
function add_file_types_to_uploads($file_types)
{

  $new_filetypes = array();
  $new_filetypes['svg'] = 'image/svg+xml';
  $file_types = array_merge($file_types, $new_filetypes);

  return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

function mycustom_logo()
{
  if (has_custom_logo()) {
    $custom_logo_id = get_theme_mod('custom_logo');
    $image = wp_get_attachment_image_src($custom_logo_id, 'full');
    $mylogo = $image[0];
    $mylogo = '<img src="' . $mylogo . '" class="custom-logo" alt="' . get_bloginfo('name') . '" />';
  } else {
    $mylogo = get_bloginfo('name');
  }
  echo '<p class="logo"><a href="' . home_url() . '" rel="home">' . $mylogo . '</a></p>';
}

function output_catogry_link($cat = null)
{
  if (!$cat) {
    $cat = get_the_category();
  }
  if (is_array($cat) && isset($cat[0])) {
    $cat = $cat[0];
  }
  if (!$cat) return false;
  $catId = $cat->cat_ID;
  $catName = esc_attr($cat->cat_name);
  $catLink = esc_url(get_category_link($catId));
  if ($catLink && $catName) {
    echo '<a class="cat-name cat-name' . $catId . '" href="' . $catLink . '">' . $catName . '</a>';
  }
}

// meta robots

function meta_robots()
{
  global $post;
  $rogots_tags = null;

  if (is_attachment()) {
    $rogots_tags = 'noindex,nofollow';
  } elseif (is_singular()) {
    $robots_r = get_post_meta($post->ID, "noindex_options", true);
    if (is_array($robots_r)) {
      $rogots_tags = (in_array('noindex', $robots_r) && !in_array('nofollow', $robots_r)) ? 'noindex,follow' : implode(",", $robots_r);
    }
  } elseif (is_paged() || is_tag() || is_date()) {
    $rogots_tags = 'noindex,follow';
  }
  if ($rogots_tags) echo '<meta name="robots" content="' . $rogots_tags . '" />';
} // END meta_robots()
add_action('wp_head', 'meta_robots');

// 「WordPress のご利用ありがとうございます。」を置換

add_filter('admin_footer_text', 'custom_admin_footer');
function custom_admin_footer()
{
  echo '<a href="https://github.com/hurikura/wordpress-theme">Github Repository</a>';
}

// ユーザープロフィールの追加

function my_user_meta($profile)
{
  $profile['twitter']  = 'TwitterのID (@は含めずに入力)';
  $profile['instagram'] = 'InstagramのURL';
  $profile['youtube'] = 'YoutubeのURL';
  return $profile;
}
add_filter('user_contactmethods', 'my_user_meta', 10, 1);

// 年齢を自動更新して表示するショートコード [age birth="yyyymmdd"]

add_shortcode('age', 'auto_update_age');
function auto_update_age($atts, $content = null)
{
  $atts = shortcode_atts(
    array(
      'birth' => '',
    ),
    $atts
  );
  $birth = intval($atts['birth']);
  if ($birth > 0) {
    return (int) ((date('Ymd') - $birth) / 10000);
  } else {
    return '?';
  }
}

// 画像のURLだけを取り出し

function get_avatar_onlyurl($id_or_email, $size = null, $default = null, $alt = null)
{
  $image = get_avatar($id_or_email, $size, $default, $alt);
  if (preg_match("/src='(.*?)'/", $image, $match)) {
    if (isset($match[1])) {
      return $match[1];
    } else {
      return false;
    }
  } else {
    return false;
  }
}

///////////////////////////////////////
// 自前でプロフィール画像の設定
// 👏 https://nelog.jp/wordpress-original-profile-image-custom
///////////////////////////////////////
//プロフィール画面で設定したプロフィール画像
if (!function_exists('get_the_author_upladed_avatar_url_demo')) :
  function get_the_author_upladed_avatar_url_demo($user_id)
  {
    if (!$user_id) {
      $user_id = get_the_posts_author_id();
    }
    return esc_html(get_the_author_meta('upladed_avatar', $user_id));
  }
endif;

//ユーザー情報追加
add_action('show_user_profile', 'add_avatar_to_user_profile_demo');
add_action('edit_user_profile', 'add_avatar_to_user_profile_demo');
if (!function_exists('add_avatar_to_user_profile_demo')) :
  function add_avatar_to_user_profile_demo($user)
  {
?>
    <h3>プロフィール画像</h3>
    <table class="form-table">
      <tr>
        <th>
          <label for="avatar">プロフィール画像URL</label>
        </th>
        <td>
          <input type="text" name="upladed_avatar" size="70" value="<?php echo get_the_author_upladed_avatar_url_demo($user->ID); ?>" placeholder="画像URLを入力してください">
          <p class="description">GravatarとMinecraftのスキンアイコンよりこちらのプロフィール画像が優先されます。240×240pxの正方形の画像がお勧めです。</p>
        </td>
      </tr>
    </table>
<?php
  }
endif;

//入力した値を保存する
add_action('personal_options_update', 'update_avatar_to_user_profile_demo');
if (!function_exists('update_avatar_to_user_profile_demo')) :
  function update_avatar_to_user_profile_demo($user_id)
  {
    if (current_user_can('edit_user', $user_id)) {
      update_user_meta($user_id, 'upladed_avatar', $_POST['upladed_avatar']);
    }
  }
endif;

//プロフィール画像を変更する
add_filter('get_avatar', 'get_uploaded_user_profile_avatar_demo', 1, 5);
if (!function_exists('get_uploaded_user_profile_avatar_demo')) :

  function get_uploaded_user_profile_avatar_demo($avatar, $id_or_email, $size, $default, $alt)
  {
    if (is_numeric($id_or_email))
      $user_id = (int) $id_or_email;
    elseif (is_string($id_or_email) && ($user = get_user_by('email', $id_or_email)))
      $user_id = $user->ID;
    elseif (is_object($id_or_email) && !empty($id_or_email->user_id))
      $user_id = (int) $id_or_email->user_id;

    if (empty($user_id))
      return $avatar;

    if (get_the_author_upladed_avatar_url_demo($user_id)) {
      $alt = !empty($alt) ? $alt : get_the_author_meta('display_name', $user_id);;
      $author_class = is_author($user_id) ? ' current-author' : '';
      $avatar = "<img alt='" . esc_attr($alt) . "' src='" . esc_url(get_the_author_upladed_avatar_url_demo($user_id)) . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
    }

    return $avatar;
  }
endif;

// headからWordPressのバージョン情報を削除

remove_action('wp_head', 'wp_generator');

// 筆者ページのURLを変更

add_action('init', 'cng_author_base');
function cng_author_base()
{
  global $wp_rewrite;
  $author_slug = 'staff';
  $wp_rewrite->author_base = $author_slug;
  $wp_rewrite->flush_rules();
}

// メタディスクリプション

function get_meta_description()
{
  global $post;
  if (is_singular() && get_post_meta($post->ID, 'meta_description', true)) {
    // 投稿ページ
    return get_post_meta($post->ID, 'meta_description', true);
  } elseif (is_front_page() || is_home()) {
    // トップページ
    return "フリくらは、Minecraftを活用して日本全国の不登校の子どもたちなどがのびのびと楽しめる第三の居場所を目指したコミュニティです。";
  }
  return null;
}

// og:title

function get_page_title()
{
  if (is_front_page() || is_home()) {
    $catchy = (get_bloginfo('description')) ? '｜' . get_bloginfo('description') : "";
    return get_bloginfo('name') . $catchy;
  }
  if (is_category()) {
    return '「' . single_cat_title('', false) . '」の記事一覧';
  }
  if (is_author()) {
    return get_the_author_meta('display_name') . 'の記事一覧';
  }
  if (is_archive()) {
    return get_the_archive_title();
  }
  global $post;
  if ($post) { // 投稿ページ
    return $post->post_title;
  }
  // 見つからなかった場合はサイトタイトルだけ返す
  return get_bloginfo('name');
}

// 現在のURLを取得

function get_current_url()
{
  if (is_front_page() || is_home()) { // トップページ
    return home_url('/');
  } elseif (is_category()) { // カテゴリーページ
    return get_category_link(get_query_var('cat'));
  } elseif (is_author()) { // 著者ページ
    return get_author_posts_url(get_the_author_meta('ID'));
  } else { // 投稿ページ等
    return get_permalink();
  }
}

function set_ogp_description()
{
  global $post;
  if (is_singular()) {
    // 投稿ページ
    if (get_post_meta($post->ID, 'meta_description', true)) {
      return get_post_meta($post->ID, 'meta_description', true);
    }
    setup_postdata($post);
    return get_the_excerpt();
    wp_reset_postdata();
  } elseif (is_front_page() || is_home()) {
    // トップページ
    return "フリくらは、Minecraftを活用して日本全国の不登校の子どもたちなどがのびのびと楽しめる第三の居場所を目指したコミュニティです。";
  } elseif (is_category()) {
    // カテゴリーページ
    return get_bloginfo('name') . 'の「' . single_cat_title('', false) . '」についての投稿一覧です。';
  } elseif (is_tag()) {
    // タグページ
    return wp_strip_all_tags(term_description());
  } elseif (is_author() && get_the_author_meta('description')) {
    // 著者ページ
    return get_the_author_meta('description');
  }
  return "";
}

// headに出力

function meta_ogp()
{
  $insert = '';


  if (get_meta_description()) {
    $insert = '<meta name="description" content="' . esc_attr(get_meta_description()) . '" />';
  }

  $ogp_descr = set_ogp_description();
  $ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';
  $ogp_title = get_page_title();
  $ogp_url = get_current_url();

  // 出力するOGPタグをまとめる

  $insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
  $insert .= '<meta property="og:description" content="' . esc_attr($ogp_descr) . '" />' . "\n";
  $insert .= '<meta property="og:type" content="' . $ogp_type . '" />' . "\n";
  $insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
  $insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
  $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";

  // 出力
  if (is_front_page() || is_home() || is_singular() || is_category() || is_author() || is_tag()) {
    echo $insert;
  }
} //END meta_ogp
add_action('wp_head', 'meta_ogp');

add_filter('redirect_canonical', 'disable_redirect_canonical');
function disable_redirect_canonical($redirect_url)
{
  if (is_404()) {
    return false;
  }
  return $redirect_url;
}
