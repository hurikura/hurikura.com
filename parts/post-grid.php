<?php if (have_posts()) : ?>
    <div class="articles-cards">
        <?php while (have_posts()) : the_post(); ?>
            <article class="article-card">
                <?php
                // カテゴリーを出力
                if (!is_category()) {
                    output_catogry_link();
                }
                ?>
                <a href="<?php echo get_permalink(); ?>" class="article-card-link">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-thumbnail">
                            <?php the_post_thumbnail('thumb-520'); ?>
                        </div> <?php else : ?>
                        <div class="post-thumbnail">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/default-image.jpg">
                        </div> <?php endif; ?>
                    <div class="post-dec">
                        <div>
                            <time class="pubdate" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time>
                            <h2><?php the_title(); ?></h2>
                        </div>
                    </div>
                </a>
                <?php if (!is_author()) : ?>
                    <div class="article-card-meta">
                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="post-author">
                            <img title="<?php the_author(); ?>" class="author-photo" width="30px" height="30px" src="<?php echo get_avatar_onlyurl(get_the_author_id(), 30); ?>" alt="<?php the_author_meta('display_name'); ?>">
                            <div class="author-info">
                                <?php the_author(); ?>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
<?php else : ?>
    <div class="no-articles">
        <?php if (is_author()) : // 著者ページの場合 
        ?>
            <p><?php the_author(); ?>さんはまだ記事を投稿していません</p>
        <?php else : ?>
            <p>まだ記事が投稿されていません</p>
        <?php endif; ?>
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/yu_skin.png" alt="yu minecraft skin">
        <?php if (is_author()) : // 著者ページの場合
        ?>
            <div>
                <?php if (get_the_author_meta('twitter')) : ?>
                    <a class="respawn" href="https://twitter.com/<?php the_author_meta('twitter'); ?>"><i class="fa-brands fa-twitter"></i> @<?php the_author_meta('twitter'); ?>をフォロー</a>
                <?php else : ?>
                    <a class="respawn" href="https://twitter.com/hurikura"><i class="fa-brands fa-twitter"></i> @hurikuraをフォロー</a>
                <?php endif; ?>
            </div>
        <?php else : ?>
            <div>
                <a class="respawn" href="https://twitter.com/hurikura"><i class="fa-brands fa-twitter"></i> @hurikuraをフォロー</a>
            </div>
        <?php endif; ?>
    </div>
<?php endif;
$args = array(
    'end_size' => 1,
    'mid_size' => 1,
    'prev_text' => '<i class="fa fa-chevron-left"></i>',
    'next_text' => '<i class="fa fa-chevron-right"></i>',
);
the_posts_pagination($args);
?>