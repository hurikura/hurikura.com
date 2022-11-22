<footer class="footer">
    <div class="wrap footer-column">
        <div>
            <?php mycustom_logo(); ?>
            <?php $description = get_bloginfo('description');
            if ($description) : ?>
                <h4 class="subtitle"><?php bloginfo('description'); ?></h4>
            <?php endif; ?>
            <ul class="social-icons">
                <li>
                    <a href="https://discord.com/invite/UsbHGENsc2" title="Discord" rel="noopener">
                        <i class="fa-brands fa-discord"></i>
                    </a>
                </li>
                <li class="icon">
                    <a href="https://twitter.com/hurikura" title="Twitter" rel="noopener">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                </li>
                <li class="icon">
                    <a href="https://www.instagram.com/hurikura/" title="Instagram" rel="noopener">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
                <li class="icon">
                    <a href="https://www.youtube.com/@hurikura" title="YouTube" rel="noopener">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
        <nav class="footer-nav">
            <h4>フリくらについて</h4>
            <ul>
                <li>
                    <a href="/about">ストーリー</a>
                </li>
                <li>
                    <a href="/staff">スタッフ情報</a>
                </li>
                <li>
                    <a href="http://map.hurikura.com:34625/">ワールドマップ</a>
                </li>
                <li>
                    <a href="/mediakit">メディアキット</a>
                </li>
            </ul>
        </nav>
        <nav class="footer-nav">
            <h4>サポート</h4>
            <ul>
                <li>
                    <a href="https://wiki.hurikura.com">ウィキ</a>
                </li>
                <li>
                    <a href="https://status.hurikura.com">ステータス</a>
                </li>
                <li>
                    <a href="/contribute">支援</a>
                </li>
                <li>
                    <a href="https://forms.gle/i56UZNeQPpNFm46bA">お問い合わせ</a>
                </li>
            </ul>
        </nav>
        <nav class="footer-nav">
            <h4>ポリシー</h4>
            <ul>
                <li>
                    <a href="/terms">利用規約</a>
                </li>
                <li>
                    <a href="/privacy">プライバシーポリシー</a>
                </li>
            </ul>
        </nav>
        <nav class="footer-nav">
            <h4>リンク</h4>
            <ul>
                <li>
                    <a href="/feed">RSS</a>
                </li>
                <li>
                    <a href="https://github.com/hurikura">Github</a>
                </li>
                <li>
                    <a href="https://zenn.dev/p/hurikura">Zenn</a>
                </li>
                <li>
                    <a href="https://hurikura.notion.site/99d00d3c4aed4c50bc888025cb4a307b">フィードバック</a>
                </li>
            </ul>
        </nav>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>