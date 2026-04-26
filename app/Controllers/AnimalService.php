<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class AnimalService extends BaseController
{
    private $serviceConfig = [
        'hospitals' => [
            'model' => '\App\Models\AnimalHospitalModel',
            'title' => '전국 동물병원',
            'search_placeholder' => '병원명, 주소, 지역명 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물병원, 24시 동물병원, 응급 동물병원, 야간 동물병원, 지역별 동물병원, 동물병원 전화번호',
            'desc' => '전국 지역별 동물병원 위치, 연락처, 진료 상태 정보를 실시간으로 확인하고 검색하세요.'
        ],
        'funerals' => [
            'model' => '\App\Models\AnimalFuneralModel',
            'title' => '전국 동물 장례업',
            'search_placeholder' => '장례식장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 장례식장, 반려동물 장례, 반려동물 화장장, 강아지 장례, 고양이 장례, 애견 장례식장',
            'desc' => '전국 반려동물 장례식장 및 화장 시설의 위치와 연락처 정보를 안내합니다.'
        ],
        'pharmacies' => [
            'model' => '\App\Models\AnimalPharmacyModel',
            'title' => '전국 동물 약국',
            'search_placeholder' => '약국명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물약국, 반려동물약, 심장사상충약, 강아지 구충제, 동물용 의약품, 근처 동물약국',
            'desc' => '근처 동물약국 위치를 찾고 반려동물 전용 의약품 구입이 가능한 곳을 검색하세요.'
        ],
        'sales' => [
            'model' => '\App\Models\AnimalSalesModel',
            'title' => '전국 동물 판매업',
            'search_placeholder' => '업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 판매업, 애견샵, 분양업체, 강아지 분양, 고양이 분양, 반려동물 샵',
            'desc' => '전국 동물 판매업체 및 분양 샵 정보를 위치와 연락처별로 확인하세요.'
        ],
        'grooming' => [
            'model' => '\App\Models\PetGroomingModel',
            'title' => '전국 동물 미용업',
            'search_placeholder' => '미용실명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '애견 미용실, 동물 미용실, 반려동물 미용, 강아지 미용, 고양이 미용, 가위컷',
            'desc' => '우리 동네 동물 미용실 위치와 연락처 정보를 한눈에 확인하세요.'
        ],
        'transport' => [
            'model' => '\App\Models\AnimalTransportModel',
            'title' => '전국 동물 운송업',
            'search_placeholder' => '운송업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 운송, 펫 택시, 동물 이송, 반려동물 이동 서비스',
            'desc' => '반려동물과 안전하게 이동할 수 있는 동물 운송업체 정보를 확인하세요.'
        ],
        'exhibition' => [
            'model' => '\App\Models\AnimalExhibitionModel',
            'title' => '전국 동물 전시업',
            'search_placeholder' => '전시장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 전시, 수족관, 펫 카페, 동물원, 체험 동물원',
            'desc' => '아이들과 함께 방문하기 좋은 전국 동물 전시업체 정보를 확인하세요.'
        ],
        'production' => [
            'model' => '\App\Models\AnimalProductionModel',
            'title' => '전국 동물 생산업',
            'search_placeholder' => '업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 생산, 브리더, 강아지 생산, 전문 견사',
            'desc' => '합법적인 전국 동물 생산업체 정보를 확인하세요.'
        ],
        'import' => [
            'model' => '\App\Models\AnimalImportModel',
            'title' => '전국 동물 수입업',
            'search_placeholder' => '수입업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 수입, 해외 반려동물 수입, 수입 유통',
            'desc' => '전국 동물 수입업체 정보를 확인하세요.'
        ],
        'trust' => [
            'model' => '\App\Models\AnimalTrustManagementModel',
            'title' => '전국 동물 위탁관리업',
            'search_placeholder' => '업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물 위탁, 애견 호텔, 펫 유치원, 반려동물 호텔, 위탁 보호',
            'desc' => '믿고 맡길 수 있는 전국 반려동물 호텔 및 위탁관리업체 정보를 확인하세요.'
        ],
        'breeding' => [
            'model' => '\App\Models\BreedingStockModel',
            'title' => '전국 종축업',
            'search_placeholder' => '업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '종축업, 축산, 종축 시설, 종축 유통',
            'desc' => '전국 종축업체 및 관련 시설 정보를 확인하세요.'
        ],
        'feed' => [
            'model' => '\App\Models\FeedManufacturingModel',
            'title' => '전국 사료 제조업',
            'search_placeholder' => '공장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '사료 제조, 강아지 사료, 고양이 사료, 사료 공장, 간식 제조',
            'desc' => '전국 사료 제조업체 정보를 확인하세요.'
        ],
        'hatchery' => [
            'model' => '\App\Models\HatcheryModel',
            'title' => '전국 부화업',
            'search_placeholder' => '부화장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '부화업, 병아리 부화, 가축 부화, 부화장',
            'desc' => '전국 부화업체 정보를 확인하세요.'
        ],
        'livestock-ai' => [
            'model' => '\App\Models\LivestockAiCenterModel',
            'title' => '전국 가축 인공수정소',
            'search_placeholder' => '인공수정소명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '가축 인공수정, 수정소, 축산 시설, 가축 번식',
            'desc' => '전국 가축 인공수정소 정보를 확인하세요.'
        ],
        'livestock-farming' => [
            'model' => '\App\Models\LivestockFarmingModel',
            'title' => '전국 가축 사육업',
            'search_placeholder' => '농장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '가축 사육, 농장, 축산업, 한우 농장, 양돈 농장',
            'desc' => '전국 가축 사육 농장 및 축산업체 정보를 확인하세요.'
        ],
        'medical-supply' => [
            'model' => '\App\Models\MedicalSupplySalesModel',
            'title' => '전국 의료기기 판매업',
            'search_placeholder' => '판매업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '의료기기 판매, 동물 의료기기, 반려동물 의료 용품',
            'desc' => '전국 동물용 의료기기 판매업체 정보를 확인하세요.'
        ],
        'slaughterhouse' => [
            'model' => '\App\Models\SlaughterhouseModel',
            'title' => '전국 도축업',
            'search_placeholder' => '도축장명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '도축장, 도축 시설, 축산 가공, 도축 업체',
            'desc' => '전국 도축업체 및 도축 시설 정보를 확인하세요.'
        ],
        'drug-wholesale' => [
            'model' => '\App\Models\VeterinaryDrugWholesaleModel',
            'title' => '전국 동물용 의약품 도매업',
            'search_placeholder' => '도매업체명, 주소 검색',
            'view_path' => 'services/index',
            'detail_view' => 'services/detail',
            'keywords' => '동물의약품 도매, 동물 약품 유통, 수의사용 의약품',
            'desc' => '전국 동물용 의약품 도매업체 정보를 확인하세요.'
        ]
    ];

    public function index($type = 'hospitals')
    {
        if (!isset($this->serviceConfig[$type])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("요청하신 서비스를 찾을 수 없습니다.");
        }

        $config = $this->serviceConfig[$type];
        $modelClass = $config['model'];
        $model = new $modelClass();

        $search = trim((string) $this->request->getGet('search'));
        $perPage = 12;
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));

        if ($search) {
            $model->groupStart()
                  ->like('사업장명', $search)
                  ->orLike('지번주소', $search)
                  ->orLike('도로명주소', $search)
                  ->groupEnd();
        }

        $items = $model->orderBy('id', 'DESC')->paginate($perPage);

        $data = [
            'type' => $type,
            'items' => $items,
            'pager' => $model->pager,
            'search' => $search,
            'config' => $config,
            'seoTitle' => ($search ? "\"{$search}\" " : "") . "{$config['title']} 위치/연락처 목록 | AnimalCare",
            'seoDescription' => $search ? "{$search} 관련 {$config['title']} 검색 결과입니다. 전국 {$config['title']} 정보를 실시간으로 확인하세요." : ($config['desc'] ?? "전국 {$config['title']} 정보를 확인하세요."),
            'seoKeywords' => $config['keywords'],
            'canonicalUrl' => site_url($type),
            'currentPage' => $page,
        ];

        return view($config['view_path'], $data);
    }

    public function detail($type, $id)
    {
        if (!isset($this->serviceConfig[$type])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $config = $this->serviceConfig[$type];
        $modelClass = $config['model'];
        $model = new $modelClass();
        $naverModel = new \App\Models\NaverApiModel();

        $item = $model->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $name = $item['사업장명'];
        $address = $item['도로명주소'] ?: $item['지번주소'];
        
        // 지도 좌표 가져오기
        $mapData = $naverModel->map($address);

        // 네이버 블로그 검색
        $blogJson = $naverModel->blog($name);
        $blog = $blogJson ? json_decode($blogJson, true) : [];

        // 관련 업체 (같은 도시 내에서 검색)
        $address = $item['지번주소'] ?: $item['도로명주소'];
        $addressParts = explode(' ', $address);
        $city = $addressParts[0] ?? '';
        $county = $addressParts[1] ?? '';

        $relatedItems = [];
        if (!empty($city)) {
            $relatedItems = $model
                ->select('id, 사업장명, 지번주소, 도로명주소')
                ->groupStart()
                    ->like('지번주소', $city . ' ' . $county)
                    ->orLike('도로명주소', $city . ' ' . $county)
                ->groupEnd()
                ->where('id !=', $item['id'])
                ->orderBy('id', 'DESC')
                ->findAll(6);
        }

        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "LocalBusiness",
            "name" => $name,
            "description" => "{$name} - {$config['title']} 상세 정보, 위치, 전화번호 안내",
            "url" => current_url(),
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $address,
                "addressCountry" => "KR",
            ],
            "telephone" => $item['전화번호'] ?? ''
        ];

        return view($config['detail_view'], [
            'type' => $type,
            'item' => $item,
            'blog' => $blog,
            'relatedItems' => $relatedItems,
            'config' => $config,
            'mapData' => $mapData,
            'seoTitle' => "{$name} - {$config['title']} 위치/전화번호 안내 | AnimalCare",
            'seoDescription' => "{$name}의 주소, 연락처, 영업 상태 등 상세 정보를 확인하세요. 주변의 다른 {$config['title']} 정보도 함께 제공합니다.",
            'seoKeywords' => "{$name}, {$city}, {$county}, {$config['title']}, 동물서비스 위치",
            'canonicalUrl' => current_url(),
            'jsonLd' => $jsonLd,
        ]);
    }
}
