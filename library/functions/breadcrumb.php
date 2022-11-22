<?php

function bc_item($name, $url, $position = "1")
{
  return '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="' . $url . '" itemprop="item"><span itemprop="name">' . $name . '</span></a><meta itemprop="position" content="' . $position . '" /></li>';
}

function get_bc_single()
{
  global $post;
  $categories = get_the_category($post->ID);
  if (!$categories) return '';
  $cat = $categories[0];
  $result = '';
  $i = 2;
  if ($cat->parent != 0) {
    $ancestors = array_reverse(get_ancestors($cat->cat_ID, 'category'));
    foreach ($ancestors as $ancestor) {
      $result .= bc_item(esc_attr(get_cat_name($ancestor)), esc_url(get_category_link($ancestor)), $i);
      $i++;
    }
  }
  $result .= bc_item(esc_attr($cat->cat_name), esc_url(get_category_link($cat->term_id)), $i);
  return $result;
}

function get_bc_page()
{
  global $post;
  if ($post->post_parent == 0) return '';
  $ancestors = array_reverse(get_post_ancestors($post->ID));
  $i = 2;
  $result = '';
  foreach ($ancestors as $ancestor) {
    $result .= bc_item(esc_attr(get_the_title($ancestor)), esc_url(get_permalink($ancestor)), $i);
    $i++;
  }
  return $result;
}

function breadcrumb()
{
  if (is_home() || is_admin()) return; // トップページ、管理画面では表示しない
  $str = '<nav id="breadcrumb" class="breadcrumb"><ul itemscope itemtype="http://schema.org/BreadcrumbList">';
  $str .= bc_item("ホーム", home_url(), "1"); // ホームのパンくずは共通して表示
  if (is_single()) {
    $str .= get_bc_single();
  } elseif (is_author()) {
    $str .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="/staff">スタッフ</a></li>';
  } elseif (is_page()) {
    $str .= get_bc_page();
  } else {
    $str .= '<li>' . wp_title('', false) . '</li>';
  }
  $str .= '</ul></nav>';
  echo $str;
}
