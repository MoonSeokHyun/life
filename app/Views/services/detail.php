<?= view('includes/header') ?>

<main class="container">
    <div style="margin-bottom: 2rem;">
        <nav style="font-size: 0.875rem; color: var(--muted); margin-bottom: 1rem;">
            <a href="<?= site_url('/') ?>">홈</a> › <a href="<?= site_url($type) ?>"><?= esc($displayName) ?></a> › <span style="color: var(--text); font-weight: 600;"><?= esc($item['business_name']) ?></span>
        </nav>
        <div style="display: flex; align-items: center; gap: 1rem;">
            <h1 style="font-size: 2.5rem; font-weight: 900; letter-spacing: -0.05em;"><?= esc($item['business_name']) ?></h1>
            <span class="status-badge <?= $item['business_status_name'] === '영업/정상' ? 'normal' : 'closed' ?>">
                <?= esc($item['business_status_name']) ?>
            </span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 2rem;">
        <div>
            <section class="section-block" style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 4px; height: 18px; background: var(--primary); border-radius: 2px;"></span>
                    상세 정보
                </h2>
                <table class="detail-table">
                    <tr>
                        <th>주소</th>
                        <td><?= esc($item['road_address'] ?: $item['lot_address'] ?: '정보 없음') ?></td>
                    </tr>
                    <?php if (isset($item['phone_number']) && $item['phone_number']): ?>
                    <tr>
                        <th>전화번호</th>
                        <td><a href="tel:<?= esc($item['phone_number']) ?>" style="color: var(--primary); font-weight: 700;"><?= esc($item['phone_number']) ?></a></td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <th>인허가일자</th>
                        <td><?= esc($item['permit_date'] ?? '정보 없음') ?></td>
                    </tr>
                    <tr>
                        <th>영업상태</th>
                        <td><?= esc($item['business_status_name'] ?? '정보 없음') ?> (<?= esc($item['detail_status_name'] ?? '') ?>)</td>
                    </tr>
                    <?php if (isset($item['closure_date']) && $item['closure_date']): ?>
                    <tr>
                        <th>폐업일자</th>
                        <td><?= esc($item['closure_date']) ?></td>
                    </tr>
                    <?php endif; ?>
                    <?php if (isset($item['business_category']) && $item['business_category']): ?>
                    <tr>
                        <th>업태</th>
                        <td><?= esc($item['business_category']) ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
            </section>

            <!-- 상세 광고 -->
            <div style="margin-bottom: 2rem;">
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-client="ca-pub-6686738239613464"
                     data-ad-slot="1204098626"
                     data-ad-format="auto"
                     data-full-width-responsive="true"></ins>
                <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>
        </div>

        <div>
            <section class="section-block" style="padding: 1rem; position: sticky; top: 100px;">
                <h2 style="font-size: 1rem; font-weight: 800; margin-bottom: 1rem; padding-left: 0.5rem;">📍 위치 안내</h2>
                <div id="map" style="width:100%; height:350px; border-radius: 1rem;"></div>
                <div style="margin-top: 1rem; padding: 0.5rem;">
                    <p style="font-size: 0.875rem; color: var(--muted); word-break: keep-all;">
                        <?= esc($item['road_address'] ?: $item['lot_address']) ?>
                    </p>
                    <a href="https://map.naver.com/v5/search/<?= urlencode($item['business_name'] . ' ' . ($item['road_address'] ?: $item['lot_address'])) ?>" target="_blank" style="display: block; margin-top: 1rem; background: #03c75a; color: #fff; text-align: center; padding: 0.75rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.875rem;">네이버 지도에서 보기</a>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    var mapOptions = {
        center: new naver.maps.LatLng(37.3595704, 127.105399),
        zoom: 15
    };

    var map = new naver.maps.Map('map', mapOptions);
    var address = "<?= esc($item['road_address'] ?: $item['lot_address']) ?>";

    naver.maps.Service.geocode({
        query: address
    }, function(status, response) {
        if (status !== naver.maps.Service.Status.OK) {
            return;
        }
        var result = response.v2,
            item = result.addresses[0];

        var point = new naver.maps.LatLng(item.y, item.x);
        map.setCenter(point);
        new naver.maps.Marker({
            position: point,
            map: map,
            title: "<?= esc($item['business_name']) ?>"
        });
    });
</script>

<style>
    .status-badge {
        padding: 0.4rem 1rem;
        border-radius: 999px;
        font-size: 0.875rem;
        font-weight: 800;
    }
    .status-badge.normal { background: #dcfce7; color: #166534; }
    .status-badge.closed { background: #fee2e2; color: #991b1b; }

    .detail-table { width: 100%; border-collapse: collapse; }
    .detail-table th { text-align: left; padding: 1rem; width: 140px; color: var(--muted); font-size: 0.9375rem; border-bottom: 1px solid #f1f5f9; }
    .detail-table td { padding: 1rem; font-weight: 600; border-bottom: 1px solid #f1f5f9; }

    @media (max-width: 992px) {
        main > div:nth-child(2) { grid-template-columns: 1fr !important; }
    }
</style>

<?= view('includes/footer') ?>
