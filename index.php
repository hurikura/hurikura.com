<?php get_header();
?>
<div id="content">
  <section class="about">
    <div class="wrap">
      <div class="hurikura-grid">
        <div class="hurikura-about">
          <h1>
            <span class="name_1">フリ</span><span class="name_2">くら</span>とは?
          </h1>
          <p class="hero-description">フリくらは、Minecraftを活用して日本全国の不登校の子どもたちなどがのびのびと楽しめる第三の居場所を目指したコミュニティです。</p>
          <div class="dsicord">
            <a href="https://discord.gg/UsbHGENsc2">
              <i class="fa-brands fa-discord"></i> Discordに参加
            </a>
          </div>
        </div>
        <div class="player">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/EfxH5Wczhac?controls=0&rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </section>
  <section class="why-minecraft">
    <div class="wrap">
      <div class="minecraft">
        <div class="about-minecraft">
          <img class="minecraft-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/img/minecraft.png" alt="草ブロック">
          <h3>
            Minecraftを活用する<br class="br-res">理由
          </h3>
          <p class="hero-description">月間アクティブユーザー約1億4千万人を抱えるポピュラーなサンドボックスゲームで、テクノロジー教育などにも利用されており、デジタル上での活動やコミュニケーションが得意な人も中には存在します。</p>
        </div>
        <div class="hurikura-world">
          <img class="image" src="<?php echo get_stylesheet_directory_uri(); ?>/img/hurikura-world.png">
        </div>
      </div>
    </div>
  </section>
  <section class="hurikura-activity">
    <div class="wrap">
      <h3>フリくらではこんなことをしています</h3>
      <div class="tabs">
        <input id="chat" type="radio" name="tab_item" checked>
        <input id="games" type="radio" name="tab_item">
        <input id="design" type="radio" name="tab_item">
        <div class="tab">
          <label id="chat" class="tab_item" for="chat">💬 コミュニケーション</label>
          <label id="games" class="tab_item" for="games">🌏 ワールド</label>
          <label id="design" class="tab_item" for="design">🚀 アップデート</label>
        </div>
        <div class="tab_content" id="chat_content">
          <img src="https://hurikura.com/wp-content/uploads/2022/10/discord-screenshots.png" alt="Discord ロビーチャットチャンネルのスクリーンショット">
          <p>Minecraftを通じて多様な人と繋がることができます。さらに話すことが苦手であればゲーム内のチャット機能やDiscordなどのツールを使ってコミュニケーションを取ることもでき、安心して自分の居場所を作ることができます。他にも<a href="https://hurikura.com/support/discord-ticket">様々な安全機能</a>を導入しています。</p>
          <div class="status">
            <div><i class="status-online"></i><span>
                <?php
                $jsonIn = file_get_contents('https://discord.com/api/guilds/972742767224705044/embed.json');
                $JSON = json_decode($jsonIn, true);

                $membersCount = $JSON["presence_count"];

                $result = array_filter($JSON['members'], function ($element) {
                  return $element['status'] == 'online';
                });

                $onlineCount = count($JSON);
                echo $onlineCount;
                ?>
                人がオンライン</span></div>
            <div><i class="status-user"></i><span>
                <?php
                $jsonIn = file_get_contents('https://discord.com/api/guilds/972742767224705044/embed.json');
                $JSON = json_decode($jsonIn, true);

                $membersCount = $JSON["presence_count"];
                echo $membersCount;
                ?>
                人</span></div>
          </div>
        </div>
        <div class="tab_content" id="games_content"><iframe title="Minecraft World" src="http://map.hurikura.com:34625/#world:22:0:0:1500:0:0:0:0:perspective"></iframe>
          <p>上記はMinecraftのワールドマップです。様々な建築物などを確認できます。</p>
        </div>
        <div class="tab_content" id="design_content">
          <img src="https://hurikura.com/wp-content/uploads/2022/10/yu.png" width="100%">
          <p>今後も様々な取り組みや頂いた<a href="https://hurikura.notion.site/99d00d3c4aed4c50bc888025cb4a307b">フィードバック</a>を元に改善を続けていきます。</p>
        </div>
      </div>
    </div>
  </section>
  <section class="staff">
    <div class="wrap">
      <div class="about-staff">
        <div class="staf-hero">
          <h3>スタッフ</h3>
          <p class="staff-text">フリくらはMinecraftが好きだったり、技術的<br class="br-res">なことが得意な多様な小中学生のスタッフが運営しています。</p>
          <p class="cta-button"><a class="mc-button" href="/staff">スタッフ一覧を見る →</a></p>
        </div>
        <div>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/staff.png">
        </div>
      </div>
    </div>
  </section>
  <section class="articles">
    <div class="wrap">
      <h4>🔔 最新のお知らせ</h3>
        <?php
        get_template_part('parts/post-grid');
        ?>
    </div>
  </section>
  <section class="faq">
    <div class="wrap">
      <div class="faq_content">
        <h4>🚀 よくある質問</h4>
        <p class="dec">問題が解決しなかった場合は<a href="https://forms.gle/i56UZNeQPpNFm46bA">お問い合わせフォーム</a>、<br class="br-res">または<a href="https://discord.com/invite/UsbHGENsc2">Discordサーバー</a>をご利用ください。</p>
        <div class="accordion">
          <input id="block-01" type="checkbox" class="accordion-input">
          <label class="Label" for="block-01">Minecraftのエディションは何ですか?</label>
          <div class="content">
            <p>Java Edition (PC版)を推奨していますが、Bedrock Edition (統合版)でも不安定ですが同じワールドに参加できます。(アップデートなどにより参加できなくなる可能性があります。)</p>
          </div>
        </div>
        <div class="accordion">
          <input id="block-02" type="checkbox" class="accordion-input">
          <label class="Label" for="block-02">ゲームバーションは何ですか?</label>
          <div class="content">
            <p>推奨はJava Edition 1.18.2ですが、1.8~1.18.xまで対応しています。</p>
          </div>
        </div>
        <div class="accordion">
          <input id="block-03" type="checkbox" class="accordion-input">
          <label class="Label" for="block-03">Modなどの使用は許可されていますか?</label>
          <div class="content">
            <p>クライアントModであれば原則使用が可能です。詳しくはポリシーを確認してください。</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php cta(); // CTA
  ?>
</div>
<?php get_footer(); ?>