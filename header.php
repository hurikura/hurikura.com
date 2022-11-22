<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/minecraftia" type="text/css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <?php if (has_post_thumbnail()) : ?>
        <meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
        <meta property="og:thumbnail" content="<?php the_post_thumbnail_url(); ?>" />
    <?php else : ?>
        <meta property="og:image" content="<?php echo get_stylesheet_directory_uri(); ?>/img/ogimage.jpg" />
        <meta property="og:thumbnail" content="<?php echo get_stylesheet_directory_uri(); ?>/img/ogimage.jpg" />
    <?php endif; ?>
    <?php if (get_option('ga_code')) : ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_html(get_option('ga_code')); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', '<?php echo esc_html(get_option('ga_code')); ?>');
        </script>
    <?php endif; ?>
    <script>
        (function(d) {
            var config = {
                    kitId: 'ces5edb',
                    scriptTimeout: 3000,
                    async: true
                },
                h = d.documentElement,
                t = setTimeout(function() {
                    h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
                }, config.scriptTimeout),
                tk = d.createElement("script"),
                f = false,
                s = d.getElementsByTagName("script")[0],
                a;
            h.className += " wf-loading";
            tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
            tk.async = true;
            tk.onload = tk.onreadystatechange = function() {
                a = this.readyState;
                if (f || a && a != "complete" && a != "loaded") return;
                f = true;
                clearTimeout(t);
                try {
                    Typekit.load(config)
                } catch (e) {}
            };
            s.parentNode.insertBefore(tk, s)
        })(document);
    </script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="container">
        <header class="header">
            <div class="wrap">
                <div class="inner">
                    <?php mycustom_logo(); ?>
                    <div>
                        <a href="https://hurikura.com/dev/login.php" class="login">Log In</a>
                    </div>
                </div>
            </div>
        </header>
        <?php if (in_category(8)) : ?>
            <div class="alert">
                <div class="wrap">
                    各種ツールの利用方法など、ご不明点などあればお気軽に<a href="https://forms.gle/i56UZNeQPpNFm46bA">お問い合わせフォーム</a>や<a href="https://discord.com/invite/UsbHGENsc2">Discordサーバー</a>などでお知らせください。
                </div>
            </div>
        <?php endif; ?>