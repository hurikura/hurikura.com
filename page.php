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
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('full'); ?>
                                <?php endif; ?>
                            </header>
                        </div>
                    </div>
                    <section class="entry-content">
                        <div class="main">
                            <div class="wrap">
                                <?php the_content(); ?>
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
