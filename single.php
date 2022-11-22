<?php get_header();
?>
<div id="content">
    <main>
        <article class="entry">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="wrap">
                        <?php breadcrumb(); ?>
                    </div>
                    <div class="main">
                        <div class="wrap">
                            <header class="article-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="entry-meta">
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="post-author">
                                        <img title="<?php the_author(); ?>" class="author-photo" width="30px" height="30px" src="<?php echo get_avatar_onlyurl(get_the_author_id(), 30); ?>" alt="<?php the_author_meta('display_name'); ?>">
                                        <div class="author-info">
                                            <?php the_author(); ?>
                                        </div>
                                    </a>
                                    <time class="pubdate" itemprop="datePublished" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y/m/d'); ?></time>
                                    <time class="updated" itemprop="dateModified" datetime="<?php the_modified_date('Y-m-d'); ?>"><?php the_modified_date('Y/m/d'); ?></time>
                                </div>
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                <?php endif; ?>
                            </header>
                        </div>
                    </div>
                    <?php insert_social_buttons(); ?>
                    <section class="entry-content">
                        <div class="main">
                            <div class="wrap">
                                <?php
                                $keikanissuu = 365;
                                if (date('U') - get_the_modified_time('U') > 60 * 60 * 24 * $keikanissuu) : ?>
                                    <div class="alert-title"><i class="fa-solid fa-circle-exclamation"></i> この記事は最新更新から1年以上が経過しています。</div>
                                <?php endif; ?>

                                <?php the_content(); ?>
                                <div class="author-box">
                                    <div class="author-image">
                                        <img title="<?php the_author(); ?>" src="<?php echo get_avatar_onlyurl(get_the_author_id(), 30); ?>" alt="<?php the_author_meta('display_name'); ?>">
                                    </div>
                                    <div class="author-content">
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?></a>
                                        <p><?php the_author_meta('description'); ?></p>
                                        <ul class="author-link">
                                            <?php if (get_the_author_meta('twitter') != "") : ?>
                                                <li>
                                                    <a href="<?php the_author_meta('twitter'); ?>" title="Twitter" rel="noopener"><i class="fab fa-twitter"></i></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_the_author_meta('instagram') != "") : ?>
                                                <li>
                                                    <a href="<?php the_author_meta('instagram'); ?>" title="Instagram" rel="noopener"><i class="fab fa-instagram"></i></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_the_author_meta('youtube') != "") : ?>
                                                <li>
                                                    <a href="<?php the_author_meta('youtube'); ?>" title="YouTube" rel="noopener"><i class="fab fa-youtube"></i></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if (get_the_author_meta('user_url') != "") : ?>
                                                <li>
                                                    <a href="<?php the_author_meta('user_url'); ?>" title="Website" rel="noopener"><i class="fa-solid fa-link"></i></a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                </div>
                                <!--
								<?php get_template_part('parts/single/prev-next-entry'); // 前後の記事へのリンク 
                                ?>
-->
                            </div>
                        </div>
                    </section>
            <?php endwhile;
            endif; ?>
        </article>
    </main>
    <?php cta(); // CTA
    ?>
</div>
<?php get_footer();
