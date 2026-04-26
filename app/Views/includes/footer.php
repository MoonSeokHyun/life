<style>
  .site-footer {
    margin-top: 60px;
    border-top: 1px solid var(--line);
    background: #fff;
    padding: 60px 0 30px;
  }

  .footer-inner {
    max-width: var(--max);
    margin: 0 auto;
    padding: 0 1.25rem;
    display: grid;
    gap: 40px;
    grid-template-columns: 2fr 1fr 1fr;
  }

  .footer-brand .logo {
    margin-bottom: 1rem;
    font-size: 1.5rem;
  }

  .footer-brand p {
    color: var(--muted);
    font-size: 0.9375rem;
    max-width: 300px;
  }

  .footer-title {
    font-size: 1rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    color: var(--text);
  }

  .footer-links {
    list-style: none;
  }

  .footer-links li {
    margin-bottom: 0.75rem;
  }

  .footer-links a {
    color: var(--muted);
    font-size: 0.875rem;
  }

  .footer-links a:hover {
    color: var(--primary);
  }

  .footer-bottom {
    max-width: var(--max);
    margin: 40px auto 0;
    padding: 30px 1.25rem 0;
    border-top: 1px solid var(--line);
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: var(--muted);
    font-size: 0.8125rem;
  }

  @media (max-width: 768px) {
    .footer-inner { grid-template-columns: 1fr; gap: 30px; }
    .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
  }
</style>

<footer class="site-footer">
  <div class="footer-inner">
    <div class="footer-brand">
      <div class="logo">✨ <span>LifeHub</span></div>
      <p>공공데이터를 활용하여 전국 53개 카테고리의 생활 및 문화 서비스 정보를 제공합니다.</p>
    </div>
    <div>
      <h2 class="footer-title">주요 서비스</h2>
      <ul class="footer-links">
        <li><a href="<?= site_url('lodgings') ?>">숙박업 정보</a></li>
        <li><a href="<?= site_url('karaoke_rooms') ?>">노래연습장 정보</a></li>
        <li><a href="<?= site_url('pc_bangs') ?>">PC방 정보</a></li>
        <li><a href="<?= site_url('domestic_travel_agencies') ?>">여행사 정보</a></li>
      </ul>
    </div>
    <div>
      <h2 class="footer-title">고객지원</h2>
      <ul class="footer-links">
        <li><a href="mailto:gjqmaoslwj@naver.com">gjqmaoslwj@naver.com</a></li>
        <li>평일 09:00 ~ 18:00 운영</li>
        <li>정보 수정 및 삭제 요청</li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© 2024 LifeHub. All rights reserved.</p>
    <p>Powered by Public Data Portal</p>
  </div>
</footer>

<script type="text/javascript" src="//wcs.naver.net/wcslog.js"></script>
<script type="text/javascript">
if (window.location.hostname !== "localhost" && window.location.hostname !== "127.0.0.1") {
    if (!wcs_add) var wcs_add = {};
    wcs_add["wa"] = "730e1004015aa8";
    if (window.wcs) {
        wcs_do();
    }
}
</script>
</body>
</html>