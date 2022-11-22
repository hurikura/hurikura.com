<?php
get_header();
$user_lastname = get_the_author_meta('user_lastname');
$user_firstname = get_the_author_meta('user_firstname');
$user_url = get_the_author_meta('user_url');
$description = get_the_author_meta('description');
?>
<div id="content">
    <div class="wrap">
        <div class="header_container">
            <header class="page-header">
                <?php breadcrumb(); ?>
                <?php if (is_author()) : // 著者ページの場合 
                ?>
                    <div class="header-profile">
                        <div class="header-profile-icon">
                            <img title="<?php the_author(); ?>" class="author-photo" width="120px" height="120px" src="<?php echo get_avatar_onlyurl(get_the_author_id(), 120); ?>" alt="<?php the_author_meta('display_name'); ?>">
                        </div>
                        <div class="header-profile-text">
                            <h1 class="page-title mcfont"><?php the_author(); ?></h1>
                            <p><?php the_author_meta('description'); ?></p>
                            <ul class="header-sns">
                                <?php if (get_the_author_meta('twitter')) : ?>
                                    <li>
                                        <a href="https://twitter.com/<?php the_author_meta('twitter'); ?>"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_the_author_meta('instagram')) : ?>
                                    <li>
                                        <a href="<?php the_author_meta('instagram'); ?>"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_the_author_meta('youtube')) : ?>
                                    <li>
                                        <a class="header-icon" href="<?php the_author_meta('youtube'); ?>"><i class="fa-brands fa-youtube"></i></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (get_the_author_meta('user_url')) : ?>
                                    <li>
                                        <a class="header-icon" href="<?php the_author_meta('user_url'); ?>"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php else : // その他 
                ?>
                    <h1 class="page-title">「<?php single_cat_title(); ?>」の記事一覧</h1>
                    <?php
                    if (!is_paged()) {
                        // 説明文（2ページ目以降には非表示）
                        the_archive_description('<div class="entry-content">', '</div>');
                    }
                    ?>
                <?php endif; ?>
            </header>
            <?php
            get_template_part('parts/post-grid');
            ?>
        </div>
    </div>
    <?php get_footer();
