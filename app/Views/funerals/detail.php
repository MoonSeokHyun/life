<?php include APPPATH . 'Views/includes/header.php'; ?>

<main>
  <div class="container">
    <section class="section-block">
      <p style="font-size:13px; color:#5d6670; margin-bottom:8px;">
        <a href="<?= site_url('/') ?>">홈</a> / <a href="<?= site_url('funerals') ?>">장례식장 목록</a>
      </p>
      <h1 style="font-size:28px; line-height:1.4; margin-bottom:10px;"><?= esc($facility['facility_name']) ?></h1>
      <p style="font-size:14px; color:#5d6670;">
        <?= esc($facility['city']) ?> <?= esc($facility['county']) ?> · <?= esc($facility['address']) ?>
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
      <h2 style="font-size:20px; margin-bottom:12px;">기본 정보</h2>
      <div style="display:grid; gap:8px;">
        <p><strong>주소:</strong> <?= esc($facility['address']) ?></p>
        <p><strong>전화번호:</strong> <?= esc($facility['phone_number']) ?></p>
        <p><strong>지역:</strong> <?= esc($facility['city']) ?> <?= esc($facility['county']) ?></p>
        <p><strong>주차 가능 대수:</strong> <?= esc($facility['parking_capacity']) ?></p>
        <p><strong>운영 형태:</strong> <?= esc($facility['operation_type']) ?></p>
        <p><strong>시설 종류:</strong> <?= esc($facility['facility_type']) ?></p>
        <p><strong>유족 대기실:</strong> <?= esc($facility['family_waiting_room']) ?></p>
        <p><strong>장애인 편의시설:</strong> <?= esc($facility['disabled_facilities']) ?></p>
      </div>
    </section>

    <section class="section-block">
      <h2 style="font-size:20px; margin-bottom:12px;">관련 비용</h2>
      <?php if (empty($items)): ?>
        <p>관련 비용 정보가 없습니다.</p>
      <?php else: ?>
        <div style="display:grid; gap:10px;">
          <?php foreach ($items as $item): ?>
            <article style="border:1px solid #e2e8eb; border-radius:10px; padding:12px;">
              <p style="font-size:12px; color:#5d6670;"><?= esc($item['item_category']) ?> / <?= esc($item['item_type']) ?></p>
              <h3 style="font-size:16px; margin:4px 0;"><?= esc($item['item_name']) ?></h3>
              <p style="font-size:14px; color:#5d6670;"><?= esc($item['item_detail']) ?></p>
              <p style="font-size:16px; color:#0e7f63; font-weight:800; margin-top:6px;"><?= number_format((int) $item['price']) ?>원</p>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </section>

    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-6686738239613464"
         data-ad-slot="1204098626"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>

    <?php if (!empty($relatedFacilities)): ?>
      <section class="section-block">
        <h2 style="font-size:20px; margin-bottom:12px;">같은 지역의 다른 장례식장</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap:10px;">
          <?php foreach ($relatedFacilities as $related): ?>
            <a href="<?= site_url('funerals/' . $related['id']) ?>" style="border:1px solid #e2e8eb; border-radius:10px; padding:12px;">
              <h3 style="font-size:15px; margin-bottom:4px;"><?= esc($related['facility_name']) ?></h3>
              <p style="font-size:13px; color:#5d6670;"><?= esc($related['city']) ?> <?= esc($related['county']) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php if (!empty($blog['items'])): ?>
      <section class="section-block">
        <h2 style="font-size:20px; margin-bottom:12px;">관련 블로그 글</h2>
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap:10px;">
          <?php foreach (array_slice($blog['items'], 0, 8) as $item): ?>
            <a href="<?= esc($item['link']) ?>" target="_blank" rel="noopener noreferrer" style="display:block; border:1px solid #e2e8eb; border-radius:10px; padding:12px;">
              <h3 style="font-size:15px; margin-bottom:5px;"><?= strip_tags($item['title']) ?></h3>
              <p style="font-size:13px; color:#5d6670;"><?= esc(mb_strimwidth(strip_tags($item['description']), 0, 90, '...')) ?></p>
            </a>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <p style="margin-top: 16px;">
      <a href="<?= site_url('funerals') ?>" style="font-weight:700; color:#0e7f63;">← 목록으로 돌아가기</a>
    </p>
  </div>
</main>

<?php include APPPATH . 'Views/includes/footer.php'; ?>
