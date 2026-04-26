<?php
$hospital = $hospital ?? [];
$blog = $blog ?? [];
$images = $images ?? [];
$relatedHospitals = $relatedHospitals ?? [];

echo view('includes/header', [
    'seoTitle' => $seoTitle,
    'seoDescription' => $seoDescription,
    'seoKeywords' => $seoKeywords,
    'canonicalUrl' => $canonicalUrl,
    'jsonLd' => $jsonLd
]);
?>

<main class="container">
    <div style="display: grid; grid-template-columns: 1fr 320px; gap: 2rem; align-items: start;">
        <div class="content-main">
            <!-- 기본 정보 섹션 -->
            <section class="section-block" style="margin-top: 0;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                    <h1 style="font-size: 2rem; font-weight: 800; color: var(--text);"><?= esc($hospital['사업장명']) ?></h1>
                    <span style="background: <?= $hospital['영업상태명'] === '정상영업' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $hospital['영업상태명'] === '정상영업' ? '#166534' : '#991b1b' ?>; font-size: 0.875rem; font-weight: 700; padding: 0.375rem 0.75rem; border-radius: 999px;">
                        <?= esc($hospital['영업상태명']) ?>
                    </span>
                </div>
                
                <div style="display: grid; grid-template-columns: 100px 1fr; gap: 1rem; font-size: 0.95rem; line-height: 1.8;">
                    <div style="color: var(--muted); font-weight: 600;">도로명주소</div>
                    <div><?= esc($hospital['도로명주소'] ?: '-') ?></div>
                    
                    <div style="color: var(--muted); font-weight: 600;">지번주소</div>
                    <div><?= esc($hospital['지번주소'] ?: '-') ?></div>
                    
                    <div style="color: var(--muted); font-weight: 600;">전화번호</div>
                    <div style="font-weight: 700; color: var(--primary);"><?= esc($hospital['전화번호'] ?: '정보 없음') ?></div>
                    
                    <div style="color: var(--muted); font-weight: 600;">인허가일자</div>
                    <div><?= esc($hospital['인허가일자'] ?: '-') ?></div>

                    <div style="color: var(--muted); font-weight: 600;">폐업일자</div>
                    <div><?= esc($hospital['폐업일자'] ?: '-') ?></div>
                </div>
            </section>

            <!-- 네이버 블로그 정보 -->
            <?php if (!empty($blog['items'])): ?>
                <section class="section-block" style="margin-top: 2rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                        <span style="color: #2db400;">N</span> 블로그 소식
                    </h2>
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <?php foreach (array_slice($blog['items'], 0, 5) as $item): ?>
                            <a href="<?= $item['link'] ?>" target="_blank" rel="nofollow" style="display: block; group">
                                <h3 style="font-size: 1.05rem; font-weight: 700; margin-bottom: 0.4rem; color: var(--text);"><?= $item['title'] ?></h3>
                                <p style="font-size: 0.9rem; color: var(--muted); margin-bottom: 0.4rem;"><?= strip_tags($item['description']) ?></p>
                                <div style="font-size: 0.8rem; color: var(--primary); font-weight: 500;">
                                    <?= esc($item['bloggername']) ?> | <?= date('Y.m.d', strtotime($item['postdate'])) ?>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        </div>

        <!-- 사이드바 -->
        <aside class="sidebar">
            <div class="section-block" style="margin-top: 0; padding: 1.5rem;">
                <h2 style="font-size: 1.125rem; font-weight: 800; margin-bottom: 1.25rem;">주변 동물병원</h2>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <?php foreach ($relatedHospitals as $rel): ?>
                        <a href="<?= site_url('hospitals/' . $rel['id']) ?>" style="display: block; padding-bottom: 1rem; border-bottom: 1px solid var(--line);">
                            <div style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.25rem;"><?= esc($rel['사업장명']) ?></div>
                            <div style="font-size: 0.8rem; color: var(--muted);"><?= esc($rel['지번주소'] ?: $rel['도로명주소']) ?></div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>
    </div>
</main>

<style>
@media (max-width: 992px) {
    main > div {
        grid-template-columns: 1fr !important;
    }
}
</style>

<?= view('includes/footer') ?>
