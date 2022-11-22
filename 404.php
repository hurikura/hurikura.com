<?php get_header(); ?>
<div class="wrap error">
	<h1>404</h1>
	<?php if (is_user_logged_in()) : ?>
		<p><?php
			$user = wp_get_current_user();
			echo $user->display_name; //ユーザーID
			?>は未知のページに試みた。</p>
	<?php else : ?>
		<p>あなたは未知のページに試みた。</p>
	<?php endif; ?>
	<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/404.png" alt-"404">
	<a class="respawn" href="<?php echo esc_url(home_url('/')); ?>">Respawn</a>
</div>
<?php get_footer();
