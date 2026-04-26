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

    // 컬럼명 한글 매핑 테이블
    protected $columnLabels = [
        'business_name' => '사업장명',
        'road_address' => '도로명 주소',
        'lot_address' => '지번 주소',
        'phone_number' => '전화번호',
        'permit_date' => '인허가 일자',
        'business_status_name' => '영업 상태',
        'detail_status_name' => '상세 영업 상태',
        'closure_date' => '폐업 일자',
        'business_category' => '업태 구분',
        'site_area' => '소재지 면적',
        'zip_code' => '우편번호',
        'male_employees' => '남성 종사자 수',
        'female_employees' => '여성 종사자 수',
        'total_employees' => '총 종사자 수',
        'coordinate_x' => '좌표(X)',
        'coordinate_y' => '좌표(Y)',
        'hygiene_business_type' => '위생업태명',
        'is_multi_use_facility' => '다중이용업소 여부',
        'total_facility_scale' => '시설 총 규모',
        'building_ownership' => '건물 소유 구분',
        'deposit' => '보증금',
        'monthly_rent' => '월세',
        'homepage' => '홈페이지',
        'last_modified_at' => '최종 수정 시점',
        'permit_number' => '인허가 번호',
        'room_count' => '객실 수',
        'floor_count' => '층수',
        'water_supply_type' => '급수시설 구분',
        'surrounding_environment' => '주변 환경',
        'grade_name' => '등급',
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
                    ->like('business_name', $search)
                    ->orLike('lot_address', $search)
                    ->orLike('road_address', $search)
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
            'columnLabels' => $this->columnLabels,
            'seoTitle' => "{$item['business_name']} - {$displayName} 상세 정보 | LifeHub",
            'seoDescription' => "{$item['business_name']}의 주소: " . ($item['road_address'] ?: $item['lot_address']) . ", 영업상태: {$item['business_status_name']}",
        ];

        return view('services/detail', $data);
    }
}
