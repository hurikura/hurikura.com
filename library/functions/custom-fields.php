<?php

// カスタムフィールドの作成

add_action('admin_menu', 'add_meta_field');
add_action('save_post', 'save_meta_field');

function add_meta_field()
{
  // 作成
  // 投稿ページ
  add_meta_box('meta-description', 'メタデスクリプション', 'field_meta_description', 'post', 'normal');
  add_meta_box('meta-description', 'メタデスクリプション', 'field_meta_description', 'page', 'normal');
  add_meta_box('side-setting', "設定", 'field_side', 'page', 'side');
  add_meta_box('canonical-url', 'Canonical URL', 'field_canonical_url', 'post', 'normal');
  add_meta_box('canonical-url', 'Canonical URL', 'field_canonical_url', 'page', 'normal');
}

function field_meta_description()
{
  global $post;
  echo '<p class="howto">記事の概要を紹介する100〜120文字程度の文章です（入力は必須ではありません）。GoogleやYahoo!などの検索エンジンに説明文として表示されることがあります。</p><textarea name="meta_description" cols="65" rows="4" onkeyup="document.getElementById(\'description_count\').innerText=this.value.length + \'字\'" style="max-width: 100%">' . get_post_meta($post->ID, 'meta_description', true) . '</textarea><p><strong><span id="description_count" style="float: none;display: inline-block;border: none;box-shadow: none; background-color: var(--wp--preset--color--sango-pastel); padding: 5px 10px;">0字</span></strong></p>';
}

function field_canonical_url()
{
  global $post;
  $result = '<p class="howto">Canonical URLを指定します。基本的には空で問題ありません。<a href="https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls">Canonical URLとは?</a></p>';
  $result .= '<textarea name="canonical_url" cols="65" rows="1" style="max-width: 100%" placeholder="https://example.com/duplicate-page">' . get_post_meta($post->ID, 'canonical_url', true) . '</textarea>';
  echo $result;
}

function field_side()
{
  field_meta_robots();
}
	
function field_meta_robots()
{
  global $post;
  $exist_options = get_post_meta($post->ID, 'noindex_options', true);
  $noindex_options = $exist_options ? $exist_options : array();
  $data = array("noindex", "nofollow");
  echo '<p class="field-title" style="margin-top: 20px;"><img draggable="false" role="img" class="emoji" alt="🛠" src="https://s.w.org/images/core/emoji/13.1.0/svg/1f6e0.svg"> SEO設定</p>';
  foreach ($data as $d) {
    $check = (in_array($d, $noindex_options)) ? "checked" : "";
    echo '<div style="margin-top: 10px;"><label><input type="checkbox" name="noindex_options[]" value="' . $d . '" ' . $check . '>' . $d . '</label></div>';
  }
}

function update_custom_text_fields($post_id, $field_name)
{
  if (!is_user_logged_in()) {
    return;
  }
  (isset($_POST[$field_name])) ? update_post_meta($post_id, $field_name, $_POST[$field_name]) : "";
}

// 値を保存
function save_meta_field($post_id)
{

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // クイックポストの時は何もしない 
  if (isset($_POST['action']) && $_POST['action'] == 'inline-save') {
    return $post_id;
  }

  // Ajaxなどの時は何もしない
  if (defined('DOING_AJAX') && DOING_AJAX) {
    return $post_id;
  }

  // $_POSTデータが何もない場合は何もしない
  if (count($_POST) == 0) {
    return $post_id;
  }

  update_custom_text_fields($post_id, 'meta_description');
  update_custom_option_fields($post_id, 'noindex_options');
  update_custom_option_fields($post_id, 'canonical_url');
}
