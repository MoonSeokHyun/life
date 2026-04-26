<?php
$hospitals = $hospitals ?? [];
$pager = $pager ?? null;
$search = $search ?? '';

echo view('includes/header', [
    'seoTitle' => $seoTitle,
    'seoDescription' => $seoDescription,
    'seoKeywords' => $seoKeywords,
    'canonicalUrl' => $canonicalUrl,
    'search' => $search
]);
?>

<main class="container">
    <div class="section-block">
        <h1 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem;">
            <?= $search ? '"'.esc($search).'" 검색 결과' : '전국 동물병원 목록' ?>
        </h1>

        <?php if (empty($hospitals)): ?>
            <p style="text-align: center; padding: 3rem 0; color: var(--muted);">검색 결과가 없습니다.</p>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                <?php foreach ($hospitals as $item): ?>
                    <a href="<?= site_url('hospitals/' . $item['id']) ?>" style="display: block; background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 1.5rem; transition: transform 0.2s, box-shadow 0.2s;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='var(--shadow)';" onmouseout="this.style.transform='none'; this.style.boxShadow='none';">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <span style="background: <?= $item['영업상태명'] === '정상영업' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $item['영업상태명'] === '정상영업' ? '#166534' : '#991b1b' ?>; font-size: 0.75rem; font-weight: 700; padding: 0.25rem 0.625rem; border-radius: 999px;">
                                <?= esc($item['영업상태명'] ?? '상태불명') ?>
                            </span>
                        </div>
                        <h2 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem; color: var(--text);">
                            <?= esc($item['사업장명']) ?>
                        </h2>
                        <p style="font-size: 0.875rem; color: var(--muted); margin-bottom: 1rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= esc($item['도로명주소'] ?: $item['지번주소']) ?>
                        </p>
                        <div style="font-size: 0.8125rem; color: var(--primary); font-weight: 600;">
                            <?= esc($item['전화번호'] ?: '전화번호 정보 없음') ?>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>

            <?php if ($pager): ?>
                <div style="margin-top: 3rem; display: flex; justify-content: center;">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<?= view('includes/footer') ?>
