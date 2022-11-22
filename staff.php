<?php
get_header();
/*
Template Name: スタッフ一覧テンプレート
*/
?>
<div id="content">
    <div class="wrap">
        <header class="page-header">
            <?php breadcrumb(); ?>
            <h1 class="page-title"><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </header>
        <div class="members-cards">
            <?php

            define("MEMBER_NUMBER_PER_PAGE", get_option('posts_per_page'));
            $paged     = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $offset   = ($paged - 1) * MEMBER_NUMBER_PER_PAGE;
            $users     = get_users();
            $query     = get_users('&offset=' . $offset . '&number=' . MEMBER_NUMBER_PER_PAGE);
            $total_users = count($users);
            $total_query = count($query);
            $total_pages = intval($total_users / MEMBER_NUMBER_PER_PAGE) + 1;

            foreach ($query as $user) {
                $uid = $user->ID ?>
                <div class="member-card">
                    <div class="authorall_img"><?php echo get_avatar($uid, 150); ?></div>
                    <div class="authortext">
                        <a href="<?php echo get_author_posts_url($uid); ?>"><?php echo $user->display_name; ?></a>
                    </div>
					<?php if ( $user->user_description ): ?>
                    <p class="authordescri"><?php echo $user->user_description; ?></p>
					<?php endif; ?>
                    <ul class="profile-sns">
                        <?php if (get_user_meta($uid, 'twitter', true) != "") : ?>
                            <li>
                                <a href="https://twitter.com/<?php echo $user->twitter; ?>" title="twitter" rel="noopener"><i class="fab fa-twitter"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_user_meta($uid, 'instagram', true) != "") : ?>
                            <li>
                                <a href="<?php echo $user->instagram; ?>" title="instagram" rel="noopener"><i class="fab fa-instagram"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if (get_user_meta($uid, 'youtube', true) != "") : ?>
                            <li>
                                <a href="<?php echo $user->youtube; ?>" title="youtube" rel="noopener"><i class="fab fa-youtube"></i></a>
                            </li>
                        <?php endif; ?>
                        <?php if ($user->user_url != "") : ?>
                            <li>
                                <a href="<?php echo $user->user_url; ?>" title="<?php echo $user->user_url; ?>" rel="noopener"><i class="fa-solid fa-link"></i></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

            <?php }
            ?>
        </div>
        <div class="pagination">
            <?php
            if ($total_users > $total_query) {
                $current_page = max(1, get_query_var('paged'));
                echo paginate_links(array(
                    'format' => 'page/%#%/',
                    'total' => $total_pages,
                    'current' => $current_page,
                    "prev_text" => "<i class='fa fa-chevron-left'></i>",
                    'next_text'    => "<i class='fa fa-chevron-right'></i>",
                    'type'         => 'list',
                ));
            }
            ?>
        </div>
    </div>
</div>
<?php get_footer();