<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// 메인 페이지
$routes->get('/', 'Home::index');

// 사이트맵
$routes->get('sitemap.xml', 'SitemapController::index');

// 동적 서비스 라우트 (숙박업, 노래방 등 53개 테이블 대응)
$routes->get('(:segment)', 'LifeService::index/$1');
$routes->get('(:segment)/(:num)', 'LifeService::detail/$1/$2');
