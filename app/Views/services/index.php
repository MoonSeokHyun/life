<?php
$items = $items ?? [];
$pager = $pager ?? null;
$search = $search ?? '';
$type = $type ?? 'hospitals';

echo view('includes/header', [
    'seoTitle' => $seoTitle,
    'seoDescription' => $seoDescription,
    'seoKeywords' => $seoKeywords,
    'canonicalUrl' => $canonicalUrl,
    'search' => $search,
    'config' => $config
]);
?>

<main class="container">
    <!-- 상단 광고 -->
    <div style="margin-bottom: 2rem;">
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-6686738239613464"
             data-ad-slot="1204098626"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>

    <div class="section-block" style="padding: 2.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; border-bottom: 2px solid var(--primary); padding-bottom: 1rem;">
            <h1 style="font-size: 1.75rem; font-weight: 900; color: var(--text);">
                <?= $search ? '"'.esc($search).'" 검색 결과' : esc($config['title']) . ' 목록' ?>
            </h1>
            <span style="font-size: 0.9rem; color: var(--muted); font-weight: 500;">
                전국 데이터를 실시간으로 제공합니다
            </span>
        </div>

        <?php if (empty($items)): ?>
            <div style="text-align: center; padding: 5rem 0;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
                <p style="color: var(--muted); font-size: 1.125rem;">검색 결과가 없습니다. 다른 키워드로 검색해 보세요.</p>
            </div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;">
                <?php foreach ($items as $item): ?>
                    <a href="<?= site_url($type . '/' . $item['id']) ?>" class="item-card">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <span class="status-badge <?= ($item['영업상태명'] ?? '') === '정상영업' ? 'status-active' : 'status-closed' ?>">
                                <?= esc($item['영업상태명'] ?? '상태불명') ?>
                            </span>
                        </div>
                        <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.75rem; color: var(--text); line-height: 1.3;">
                            <?= esc($item['사업장명']) ?>
                        </h2>
                        <p style="font-size: 0.9375rem; color: var(--muted); margin-bottom: 1.25rem; min-height: 2.8rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= esc($item['도로명주소'] ?: $item['지번주소']) ?>
                        </p>
                        <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; color: var(--primary); font-weight: 700; border-top: 1px solid #f1f5f9; padding-top: 1rem;">
                            <span>📞</span> <?= esc($item['전화번호'] ?: '정보 없음') ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if ($pager): ?>
                <div style="margin-top: 4rem;">
                    <?= $pager->links('default', 'custom_pager') ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- 하단 광고 -->
    <div style="margin-top: 3rem;">
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
    .item-card {
        display: block; background: #fff; border: 1px solid var(--line); border-radius: 1.25rem; 
        padding: 1.75rem; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }
    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: var(--primary);
    }
    .status-badge {
        font-size: 0.75rem; font-weight: 800; padding: 0.35rem 0.75rem; border-radius: 2rem;
    }
    .status-active { background: #dcfce7; color: #166534; }
    .status-closed { background: #fee2e2; color: #991b1b; }
</style>

<?= view('includes/footer') ?>
