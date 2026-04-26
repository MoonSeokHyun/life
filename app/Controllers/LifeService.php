<?php

namespace App\Controllers;

use CodeIgniter\Database\Config;

class LifeService extends BaseController
{
    protected $tableMap = [
        'lodgings' => '숙박업',
        'karaoke_rooms' => '노래연습장',
        'pc_bangs' => 'PC방',
        'movie_theaters' => '영화상영관',
        'domestic_travel_agencies' => '국내 여행사',
        'museums_and_art_galleries' => '박물관/미술관',
        'performance_halls' => '공연장',
        'general_game_providers' => '일반 게임장',
        'rural_homestays' => '농어촌 민박',
        'hanok_experience' => '한옥 체험',
        'tourist_accommodations' => '관광 숙박업',
        'tourist_pensions' => '관광 펜션',
        'general_campgrounds' => '일반 야영장',
        'auto_campgrounds' => '자동차 야영장',
        'film_producers' => '영화 제작업',
        'game_producers' => '게임 제작업',
        'music_video_producers' => '음반/비디오 제작',
        'pop_culture_art_planners' => '대중문화 예술기획',
        'amusement_facilities_other' => '기타 유원시설',
        'video_viewing_rooms' => '비디오물 감상실',
        'youth_game_providers' => '청소년 게임장',
        'domestic_international_travel_agencies' => '국외 여행사',
        'comprehensive_travel_agencies' => '종합 여행사',
    ];

    public function index($type)
    {
        $db = Config::connect();
        $tableName = $type;
        $displayName = $this->tableMap[$type] ?? str_replace('_', ' ', $type);

        $search = $this->request->getGet('search');
        $builder = $db->table($tableName);

        if ($search) {
            $builder->groupStart()
                    ->like('사업장명', $search)
                    ->orLike('지번주소', $search)
                    ->orLike('도로명주소', $search)
                    ->groupEnd();
        }

        $perPage = 20;
        $page = $this->request->getGet('page') ?? 1;
        
        $total = $builder->countAllResults(false);
        $results = $builder->orderBy('id', 'DESC')->limit($perPage, ($page - 1) * $perPage)->get()->getResultArray();

        $pager = service('pager');

        $data = [
            'type' => $type,
            'displayName' => $displayName,
            'results' => $results,
            'pager' => $pager,
            'total' => $total,
            'perPage' => $perPage,
            'search' => $search,
            'seoTitle' => "전국 {$displayName} 정보 검색 | LifeHub",
            'seoDescription' => "전국 {$total}곳의 {$displayName} 위치, 연락처, 영업상태 등 상세 정보를 확인하세요.",
        ];

        return view('services/list', $data);
    }

    public function detail($type, $id)
    {
        $db = Config::connect();
        $displayName = $this->tableMap[$type] ?? str_replace('_', ' ', $type);
        
        $item = $db->table($type)->where('id', $id)->get()->getRowArray();

        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'type' => $type,
            'displayName' => $displayName,
            'item' => $item,
            'seoTitle' => "{$item['사업장명']} - {$displayName} 상세 정보 | LifeHub",
            'seoDescription' => "{$item['사업장명']}의 주소: " . ($item['도로명주소'] ?: $item['지번주소']) . ", 영업상태: {$item['영업상태명']}",
        ];

        return view('services/detail', $data);
    }
}
