<?= view('includes/header') ?>

<main class="container">
    <div style="margin-bottom: 2rem;">
        <nav style="font-size: 0.875rem; color: var(--muted); margin-bottom: 1rem;">
            <a href="<?= site_url('/') ?>">홈</a> › <span style="color: var(--text); font-weight: 600;"><?= esc($displayName) ?></span>
        </nav>
        <h1 style="font-size: 2rem; font-weight: 900; letter-spacing: -0.05em;"><?= esc($displayName) ?> 전국 정보</h1>
        <p style="color: var(--muted); margin-top: 0.5rem;">총 <?= number_format($total) ?>개의 업체를 확인하실 수 있습니다.</p>
    </div>

    <!-- 목록 광고 -->
    <div style="margin-bottom: 2rem;">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>

    <div class="section-block">
        <div style="display: grid; gap: 1rem;">
            <?php if (empty($results)): ?>
                <div style="text-align: center; padding: 4rem 0;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                    <p style="color: var(--muted); font-weight: 600;">검색 결과가 없습니다.</p>
                </div>
            <?php else: ?>
                <?php foreach ($results as $row): ?>
                <a href="<?= site_url($type . '/' . $row['id']) ?>" class="list-card">
                    <div style="flex: 1;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <h2 style="font-size: 1.125rem; font-weight: 800;"><?= esc($row['business_name']) ?></h2>
                            <span class="status-badge <?= $row['business_status_name'] === '영업/정상' ? 'normal' : 'closed' ?>">
                                <?= esc($row['business_status_name']) ?>
                            </span>
                        </div>
                        <div style="font-size: 0.875rem; color: var(--muted); display: flex; align-items: center; gap: 0.5rem;">
                            📍 <?= esc($row['road_address'] ?: $row['lot_address'] ?: '주소 정보 없음') ?>
                        </div>
                    </div>
                    <div style="color: var(--primary); font-weight: 700; font-size: 0.875rem;">상세보기 ›</div>
                </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div style="margin-top: 3rem; display: flex; justify-content: center;">
            <?= $pager->makeLinks($pager->getCurrentPage(), $perPage, $total, 'default_full') ?>
        </div>
    </div>
</main>

<style>
    .list-card {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        border-radius: 1rem;
        border: 1px solid #f1f5f9;
        transition: 0.2s;
    }
    .list-card:hover {
        background: #f8fafc;
        border-color: var(--primary);
        transform: translateX(5px);
    }
    .status-badge {
        padding: 0.25rem 0.6rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .status-badge.normal { background: #dcfce7; color: #166534; }
    .status-badge.closed { background: #fee2e2; color: #991b1b; }

    /* Pager Custom Styling */
    .pagination { display: flex; gap: 0.5rem; list-style: none; }
    .pagination li a { padding: 0.5rem 1rem; border: 1px solid var(--line); border-radius: 0.5rem; background: #fff; }
    .pagination li.active a { background: var(--primary); color: #fff; border-color: var(--primary); }
</style>

<?= view('includes/footer') ?>
