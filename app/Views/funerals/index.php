<?php include APPPATH . 'Views/includes/header.php'; ?>

<main>
    <div class="container">
        <section class="section-block">
            <h1 style="font-size:28px; margin-bottom:8px;">장례식장 목록</h1>
            <p style="font-size:14px; color:#5d6670;">
                <?= $search ? '"' . esc($search) . '" 검색 결과입니다.' : '전국 장례식장 정보를 지역별로 확인할 수 있습니다.' ?>
            </p>
        </section>

        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

        <section class="section-block">
            <?php if (empty($facilities)): ?>
                <p>검색 결과가 없습니다. 다른 키워드로 검색해보세요.</p>
            <?php else: ?>
                <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap:12px;">
                    <?php foreach ($facilities as $f): ?>
                        <article style="border:1px solid #e2e8eb; border-radius:12px; background:#fff; overflow:hidden;">
                            <a href="<?= site_url('funerals/' . $f['id']) ?>" style="display:block; padding:14px;">
                                <h2 style="font-size:16px; margin-bottom:6px;"><?= esc($f['facility_name']) ?></h2>
                                <p style="font-size:13px; color:#5d6670;">지역: <?= esc($f['city']) ?> <?= esc($f['county']) ?></p>
                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="section-block" style="padding:16px;">
            <nav aria-label="페이지 이동">
                <?= $pager->links() ?>
            </nav>
        </section>
    </div>
</main>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
