<?= view('includes/header') ?>

<main class="container">
    <div style="margin-bottom: 2rem;">
        <nav style="font-size: 0.875rem; color: var(--muted); margin-bottom: 1rem;">
            <a href="<?= site_url('/') ?>">홈</a> › <a href="<?= site_url($type) ?>"><?= esc($displayName) ?></a> › <span style="color: var(--text); font-weight: 600;"><?= esc($item['business_name']) ?></span>
        </nav>
        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
            <h1 style="font-size: clamp(1.75rem, 4vw, 2.5rem); font-weight: 900; letter-spacing: -0.05em;"><?= esc($item['business_name']) ?></h1>
            <span class="status-badge <?= $item['business_status_name'] === '영업/정상' ? 'normal' : 'closed' ?>">
                <?= esc($item['business_status_name']) ?>
            </span>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 2.5rem;">
        <div>
            <!-- 핵심 요약 정보 -->
            <section class="section-block" style="margin-bottom: 2rem; border-left: 5px solid var(--primary);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
                    <div>
                        <div style="font-size: 0.75rem; color: var(--muted); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">주소</div>
                        <div style="font-weight: 700; font-size: 1.0625rem;"><?= esc($item['road_address'] ?: $item['lot_address'] ?: '정보 없음') ?></div>
                    </div>
                    <?php if (isset($item['phone_number']) && $item['phone_number']): ?>
                    <div>
                        <div style="font-size: 0.75rem; color: var(--muted); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">연락처</div>
                        <div style="font-weight: 700; font-size: 1.25rem;"><a href="tel:<?= esc($item['phone_number']) ?>" style="color: var(--primary);"><?= esc($item['phone_number']) ?></a></div>
                    </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- 상세 데이터 표 -->
            <section class="section-block" style="margin-bottom: 2rem;">
                <h2 style="font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 4px; height: 18px; background: var(--primary); border-radius: 2px;"></span>
                    상세 정보
                </h2>
                <table class="detail-table">
                    <?php 
                    // 핵심 정보는 이미 상단에 보여줬으므로 제외
                    $exclude = ['business_name', 'road_address', 'lot_address', 'phone_number'];
                    
                    // 정의된 한글 라벨 순서대로 노출 시도
                    foreach ($columnLabels as $key => $label): 
                        if (in_array($key, $exclude) || !isset($item[$key]) || empty($item[$key]) || $item[$key] === '0' || $item[$key] === '0.0') continue;
                        $value = $item[$key];
                    ?>
                    <tr>
                        <th><?= esc($label) ?></th>
                        <td>
                            <?php 
                            if (strpos($key, 'date') !== false) {
                                echo esc(substr($value, 0, 10));
                            } elseif (is_numeric($value) && (strpos($key, 'count') !== false || strpos($key, 'floors') !== false)) {
                                echo number_format($value) . "개";
                            } elseif (is_numeric($value) && strpos($key, 'employees') !== false) {
                                echo number_format($value) . "명";
                            } elseif ($key === 'homepage') {
                                echo '<a href="' . (strpos($value, 'http') === 0 ? esc($value) : 'http://'.esc($value)) . '" target="_blank" style="color: var(--primary); text-decoration: underline;">홈페이지 방문</a>';
                            } else {
                                echo esc($value);
                            }
                            ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
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
            <!-- 지도 및 길찾기 -->
            <section class="section-block" style="padding: 1.25rem; position: sticky; top: 100px;">
                <h2 style="font-size: 1rem; font-weight: 800; margin-bottom: 1.25rem; padding-left: 0.25rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="font-size: 1.25rem;">📍</span> 위치 및 지도
                </h2>
                <div id="map" style="width:100%; height:320px; border-radius: 1rem; margin-bottom: 1.25rem;"></div>
                
                <div style="display: grid; gap: 0.75rem;">
                    <a href="https://map.naver.com/v5/search/<?= urlencode($item['business_name'] . ' ' . ($item['road_address'] ?: $item['lot_address'])) ?>" 
                       target="_blank" 
                       style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; background: #03c75a; color: #fff; padding: 1rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.9375rem;">
                       네이버 지도 열기
                    </a>
                    <a href="https://map.kakao.com/link/search/<?= urlencode($item['business_name'] . ' ' . ($item['road_address'] ?: $item['lot_address'])) ?>" 
                       target="_blank" 
                       style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; background: #fee500; color: #3c1e1e; padding: 1rem; border-radius: 0.75rem; font-weight: 800; font-size: 0.9375rem;">
                       카카오 맵 열기
                    </a>
                </div>
            </section>
        </div>
    </div>
</main>

<script>
    var mapOptions = { center: new naver.maps.LatLng(37.3595704, 127.105399), zoom: 16 };
    var map = new naver.maps.Map('map', mapOptions);
    var address = "<?= esc($item['road_address'] ?: $item['lot_address']) ?>";
    naver.maps.Service.geocode({ query: address }, function(status, response) {
        if (status !== naver.maps.Service.Status.OK) return;
        var pointData = response.v2.addresses[0];
        var point = new naver.maps.LatLng(pointData.y, pointData.x);
        map.setCenter(point);
        new naver.maps.Marker({ position: point, map: map, title: "<?= esc($item['business_name']) ?>", animation: naver.maps.Animation.DROP });
    });
</script>

<style>
    .status-badge { padding: 0.4rem 1rem; border-radius: 999px; font-size: 0.875rem; font-weight: 800; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
    .status-badge.normal { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
    .status-badge.closed { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
    .detail-table { width: 100%; border-collapse: collapse; margin-top: 0.5rem; }
    .detail-table th { text-align: left; padding: 1.125rem 1rem; width: 160px; color: var(--muted); font-size: 0.875rem; border-bottom: 1px solid #f1f5f9; background: #fafafa; }
    .detail-table td { padding: 1.125rem 1rem; font-weight: 600; border-bottom: 1px solid #f1f5f9; color: var(--text); }
    @media (max-width: 992px) { main > div:nth-child(2) { grid-template-columns: 1fr !important; } .detail-table th { width: 120px; } }
</style>

<?= view('includes/footer') ?>
