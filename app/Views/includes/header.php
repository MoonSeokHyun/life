<?php
helper('url');

$siteName = 'LifeHub';
$defaultTitle = '전국 생활·문화 서비스 종합 정보 | LifeHub';
$defaultDescription = '숙박, 게임, 여행, 문화예술 등 전국 53개 카테고리의 생활 밀착형 정보를 한눈에 확인하세요.';
$defaultKeywords = '숙박업, 노래방, PC방, 여행사, 박물관, 문화생활, 생활정보, 공공데이터';

$seoTitle = $seoTitle ?? $defaultTitle;
$seoDescription = $seoDescription ?? $defaultDescription;
$seoKeywords = $seoKeywords ?? $defaultKeywords;
$canonicalUrl = $canonicalUrl ?? current_url();
$seoImage = base_url('favicon.ico');

if (!isset($jsonLd)) {
    $jsonLd = [
        "@context" => "https://schema.org",
        "@type" => "WebSite",
        "name" => $siteName,
        "url" => base_url(),
    ];
}

$searchAction = site_url($type ?? 'lodgings');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <title><?= esc($seoTitle) ?></title>
  <meta name="description" content="<?= esc($seoDescription) ?>" />
  <meta name="keywords" content="<?= esc($seoKeywords) ?>" />
  <meta name="naver-site-verification" content="c7b559257f7b084e11eb67b7056c1f47b89af3b2" />
  <link rel="canonical" href="<?= esc($canonicalUrl) ?>" />

  <meta property="og:type" content="website" />
  <meta property="og:title" content="<?= esc($seoTitle) ?>" />
  <meta property="og:description" content="<?= esc($seoDescription) ?>" />
  <meta property="og:url" content="<?= esc($canonicalUrl) ?>" />
  <meta property="og:site_name" content="<?= esc($siteName) ?>" />

  <script type="application/ld+json">
  <?= json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
  </script>

  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6686738239613464" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://oapi.map.naver.com/openapi/v3/maps.js?ncpClientId=24lj4g8fug"></script>

  <style>
    :root {
      --bg: #f8fafc;
      --surface: #ffffff;
      --text: #0f172a;
      --muted: #64748b;
      --line: #e2e8f0;
      --primary: #0ea5e9;
      --primary-dark: #0284c7;
      --shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      --radius: 1rem;
      --max: 1200px;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { font-family: 'Pretendard', -apple-system, BlinkMacSystemFont, system-ui, Roboto, sans-serif; background: var(--bg); color: var(--text); line-height: 1.6; }
    a { color: inherit; text-decoration: none; transition: 0.2s; }

    .site-header { background: var(--surface); border-bottom: 1px solid var(--line); position: sticky; top: 0; z-index: 100; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .header-inner { max-width: var(--max); margin: 0 auto; padding: 1rem 1.25rem; display: flex; align-items: center; justify-content: space-between; }
    
    .logo { font-size: 1.5rem; font-weight: 900; color: var(--primary); letter-spacing: -0.05em; display: flex; align-items: center; gap: 0.5rem; }
    .logo span { color: var(--text); }

    .nav-menu { display: flex; gap: 1.5rem; align-items: center; }
    .nav-item { position: relative; padding: 0.5rem 0; font-weight: 600; cursor: pointer; color: var(--text); }
    .nav-item:hover { color: var(--primary); }
    .nav-item::after { content: '▼'; font-size: 0.6rem; margin-left: 0.4rem; opacity: 0.5; }
    
    .dropdown {
        position: absolute; top: 100%; left: 50%; transform: translateX(-50%); background: #fff; border: 1px solid var(--line); 
        border-radius: 1rem; box-shadow: var(--shadow); padding: 1.25rem; 
        display: none; grid-template-columns: repeat(2, 160px); gap: 0.5rem; min-width: 360px;
    }
    .nav-item:hover .dropdown { display: grid; }
    .dropdown a { padding: 0.6rem 0.8rem; border-radius: 0.5rem; font-size: 0.875rem; color: var(--muted); display: flex; align-items: center; justify-content: space-between; }
    .dropdown a:hover { background: #f0f9ff; color: var(--primary); }
    .dropdown a::after { content: '›'; opacity: 0; transition: 0.2s; }
    .dropdown a:hover::after { opacity: 1; transform: translateX(3px); }

    .search-section { background: #fff; border-bottom: 1px solid var(--line); padding: 1.5rem 0; }
    .search-container { max-width: 700px; margin: 0 auto; padding: 0 1.25rem; }
    .search-form { display: flex; gap: 0.5rem; background: #f1f5f9; border-radius: 999px; padding: 0.5rem 0.5rem 0.5rem 1.5rem; border: 1px solid transparent; }
    .search-form:focus-within { border-color: var(--primary); background: #fff; box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1); }
    .search-form input { flex: 1; border: 0; outline: 0; background: transparent; font-size: 1rem; }
    .search-form button { background: var(--primary); color: #fff; border: 0; padding: 0.75rem 2rem; border-radius: 999px; font-weight: 700; cursor: pointer; }
    
    .container { max-width: var(--max); margin: 0 auto; padding: 2rem 1.25rem; }
    .section-block { background: #fff; border: 1px solid var(--line); border-radius: var(--radius); padding: 2rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }

    @media (max-width: 768px) {
        .nav-menu { display: none; }
        .logo { font-size: 1.25rem; }
    }
  </style>
</head>
<body>
  <header class="site-header">
    <div class="header-inner">
      <a href="<?= site_url('/') ?>" class="logo">✨ <span>LifeHub</span></a>
      <nav class="nav-menu">
        <div class="nav-item">숙박/여행
            <div class="dropdown">
                <a href="<?= site_url('lodgings') ?>">일반 숙박업</a>
                <a href="<?= site_url('tourist_accommodations') ?>">관광 숙박업</a>
                <a href="<?= site_url('tourist_pensions') ?>">관광 펜션</a>
                <a href="<?= site_url('general_campgrounds') ?>">야영장</a>
                <a href="<?= site_url('rural_homestays') ?>">농어촌 민박</a>
                <a href="<?= site_url('hanok_experience') ?>">한옥 체험</a>
                <a href="<?= site_url('domestic_travel_agencies') ?>">국내 여행사</a>
                <a href="<?= site_url('comprehensive_travel_agencies') ?>">종합 여행사</a>
            </div>
        </div>
        <div class="nav-item">문화/여가
            <div class="dropdown">
                <a href="<?= site_url('karaoke_rooms') ?>">노래 연습장</a>
                <a href="<?= site_url('pc_bangs') ?>">PC방</a>
                <a href="<?= site_url('general_game_providers') ?>">일반 게임장</a>
                <a href="<?= site_url('movie_theaters') ?>">영화 상영관</a>
                <a href="<?= site_url('museums_and_art_galleries') ?>">박물관/미술관</a>
                <a href="<?= site_url('performance_halls') ?>">공연장</a>
                <a href="<?= site_url('amusement_facilities_other') ?>">유원 시설</a>
            </div>
        </div>
        <div class="nav-item">미디어/제작
            <div class="dropdown">
                <a href="<?= site_url('film_producers') ?>">영화 제작업</a>
                <a href="<?= site_url('game_producers') ?>">게임 제작업</a>
                <a href="<?= site_url('music_video_producers') ?>">음반/비디오 제작</a>
                <a href="<?= site_url('pop_culture_art_planners') ?>">대중문화 예술</a>
            </div>
        </div>
      </nav>
    </div>
  </header>

  <section class="search-section">
    <div class="search-container">
        <form class="search-form" action="<?= esc($searchAction) ?>" method="get">
            <input type="text" name="search" placeholder="<?= esc($config['search_placeholder'] ?? '업체명 또는 지역 검색') ?>" value="<?= esc($search ?? '') ?>" />
            <button type="submit">찾기</button>
        </form>
    </div>
  </section>
