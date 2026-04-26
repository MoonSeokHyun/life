<?= view('includes/header') ?>

<main class="container">
    <!-- 메인 히어로 섹션 -->
    <section style="position: relative; overflow: hidden; padding: 5rem 2rem; background: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%); border-radius: 2rem; color: #fff; margin-bottom: 4rem; box-shadow: 0 20px 25px -5px rgba(14, 165, 233, 0.2);">
        <div style="position: relative; z-index: 2; text-align: center;">
            <span style="display: inline-block; padding: 0.5rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 999px; font-size: 0.875rem; font-weight: 700; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 0.1em;">All About Life & Culture</span>
            <h1 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 900; margin-bottom: 1.5rem; letter-spacing: -0.05em; line-height: 1.1;">더 즐거운 생활을 위한<br/>전국 서비스 백과사전</h1>
            <p style="font-size: 1.25rem; opacity: 0.9; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto; font-weight: 500;">
                숙박, 게임, 여행, 문화예술 등 53개 분야의 정확한 위치와 상세 정보를 실시간으로 확인하세요.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <?php foreach (array_slice($categories, 0, 3) as $cat): ?>
                <a href="<?= site_url($cat['table']) ?>" style="background: #fff; color: #2563eb; padding: 1.25rem 2.5rem; border-radius: 1.5rem; font-weight: 800; box-shadow: 0 10px 15px rgba(0,0,0,0.1); transition: 0.3s; transform: translateY(0);" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                    <?= $cat['icon'] ?> <?= $cat['name'] ?> 찾기
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- 데코레이션 요소 -->
        <div style="position: absolute; top: -10%; right: -5%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, transparent 70%);"></div>
        <div style="position: absolute; bottom: -20%; left: -10%; width: 500px; height: 500px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);"></div>
    </section>

    <!-- 메인 광고 -->
    <div style="margin-bottom: 4rem;">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
        <!-- 카테고리 퀵 링크 -->
        <section>
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
                <h2 style="font-size: 1.75rem; font-weight: 900; letter-spacing: -0.04em;">인기 카테고리</h2>
                <span style="color: var(--muted); font-size: 0.875rem; font-weight: 600;">총 53개 카테고리 서비스 중</span>
            </div>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                <?php foreach ($categories as $cat): ?>
                <a href="<?= site_url($cat['table']) ?>" class="category-card">
                    <div class="icon-wrap"><?= $cat['icon'] ?></div>
                    <div style="font-weight: 800; font-size: 1.125rem;"><?= $cat['name'] ?></div>
                    <div style="font-size: 0.8125rem; color: var(--muted); margin-top: 0.25rem;">전국 정보 보기</div>
                </a>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- 최신 등록 정보 -->
        <section>
            <h2 style="font-size: 1.75rem; font-weight: 900; margin-bottom: 2rem; letter-spacing: -0.04em;">실시간 신규 등록</h2>
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <?php foreach ($recentData as $catName => $rows): ?>
                    <div style="margin-bottom: 1.5rem;">
                        <h3 style="font-size: 0.875rem; font-weight: 800; color: var(--primary); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                            <span style="width: 4px; height: 12px; background: var(--primary); border-radius: 2px;"></span>
                            <?= $catName ?>
                        </h3>
                        <?php foreach ($rows as $row): ?>
                        <a href="<?= site_url(str_replace(' ', '_', strtolower($catName)) . '/' . $row['id']) ?>" class="recent-item">
                            <div>
                                <div class="name"><?= esc($row['business_name']) ?></div>
                                <div class="addr"><?= esc($row['lot_address'] ?: $row['road_address']) ?></div>
                            </div>
                            <div class="arrow">›</div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>

    <!-- 하단 광고 -->
    <div style="margin-top: 4rem;">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
</main>

<style>
    .category-card {
        padding: 2rem 1.5rem;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 1.5rem;
        text-align: center;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .category-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary);
        box-shadow: 0 20px 25px -5px rgba(14, 165, 233, 0.1);
    }
    .icon-wrap {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        background: #f0f9ff;
        width: 70px;
        height: 70px;
        line-height: 70px;
        border-radius: 1.25rem;
        margin-left: auto;
        margin-right: auto;
    }
    .recent-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f1f5f9;
        transition: 0.2s;
    }
    .recent-item:hover { transform: translateX(10px); color: var(--primary); }
    .recent-item .name { font-weight: 700; margin-bottom: 0.25rem; }
    .recent-item .addr { font-size: 0.8125rem; color: var(--muted); }
    .recent-item .arrow { font-size: 1.25rem; font-weight: 300; opacity: 0.3; }

    @media (max-width: 992px) {
        main > div { grid-template-columns: 1fr !important; gap: 4rem !important; }
    }
</style>

<?= view('includes/footer') ?>
