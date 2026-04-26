<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class Home extends BaseController
{
    public function index(): string
    {
        $db = Config::connect();
        
        // 주요 카테고리의 통계 또는 샘플 데이터를 가져옴
        $categories = [
            ['name' => '숙박업', 'table' => 'lodgings', 'icon' => '🏨'],
            ['name' => '노래연습장', 'table' => 'karaoke_rooms', 'icon' => '🎤'],
            ['name' => 'PC방', 'table' => 'pc_bangs', 'icon' => '🎮'],
            ['name' => '영화상영관', 'table' => 'movie_theaters', 'icon' => '🎬'],
            ['name' => '여행사', 'table' => 'domestic_travel_agencies', 'icon' => '✈️'],
            ['name' => '박물관/미술관', 'table' => 'museums_and_art_galleries', 'icon' => '🖼️'],
        ];

        $recentData = [];
        foreach (array_slice($categories, 0, 4) as $cat) {
            $builder = $db->table($cat['table']);
            $recentData[$cat['name']] = $builder->orderBy('id', 'DESC')->limit(5)->get()->getResultArray();
        }

        $data = [
            'categories' => $categories,
            'recentData' => $recentData,
            'seoTitle' => '전국 생활·문화 서비스 종합 안내 | LifeHub',
            'seoDescription' => '숙박, 게임, 여행, 문화예술 등 전국 53개 카테고리의 생활 밀착형 정보를 한눈에 확인하세요.',
            'seoKeywords' => '숙박업, 노래방, PC방, 여행사, 박물관, 문화생활, 생활정보',
            'canonicalUrl' => base_url(),
        ];

        return view('welcome_message', $data);
    }
}
