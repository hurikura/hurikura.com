<?php
function cta()
{
?>
  <?php if (is_home() || is_front_page()) : ?>
    <aside>
      <div class="wrap">
        <div class="cta">
          <div class="cta_content">
            <div class="cta_title">コミュニティ</div>
            <p class="text">コミュニケーションは主にDiscord上で行われており、現時点は無料ですぐに参加できます。大人の方 (18歳以上) は見学が可能です。</p>
            <div class="dsicord"> <a href="https://discord.gg/UsbHGENsc2"> <i class="fa-brands fa-discord"></i> Discordに参加 </a></div>
          </div>
          <div class="skin"> <img src="https://hurikura.com/wp-content/themes/hurikura/img/yu_skin.png" alt="yuのMinencraftのスキン"></div>
        </div>
      </div>
    </aside>
  <?php else : ?>
    <aside>
      <div class="wrap">
        <div class="cta">
          <div class="cta_content">
            <div class="cta_title">フリくらについて</div>
            <p class="text">フリくらは、Minecraftを活用して日本全国の不登校の子どもたちなどがのびのびと楽しめる第三の居場所を目指したコミュニティです。</p>
            <div class="cta-button"> <a class="respawn" href="https://hurikura.com/">もっと詳しく</a></div>
          </div>
          <div class="skin"> <img src="https://hurikura.com/wp-content/themes/hurikura/img/yu_skin.png" alt="yuのMinencraftのスキン"></div>
        </div>
      </div>
    </aside>
  <?php endif; ?>
<?php
}
