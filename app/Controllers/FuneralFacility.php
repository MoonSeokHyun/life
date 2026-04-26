<?php

// app/Controllers/FuneralFacility.php

namespace App\Controllers;

use App\Models\FuneralFacilityModel;
use App\Models\FuneralItemModel;
use App\Models\NaverApiModel;

class FuneralFacility extends BaseController
{
    public function index()
    {
        $facilityModel = new FuneralFacilityModel();

        $search = trim((string) $this->request->getGet('search'));
        $perPage = 12;
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));

        if ($search) {
            $facilityModel->like('facility_name', $search)
                         ->orLike('address', $search)
                         ->orLike('city', $search)
                         ->orLike('county', $search)
                         ->orLike('phone_number', $search);
        }

        $facilities = $facilityModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        $seoTitle = $search
            ? "\"{$search}\" 검색 결과 | 장례식장 목록 - F.easehub"
            : '전국 장례식장 목록 및 지역 검색 | F.easehub';

        $seoDescription = $search
            ? "{$search} 관련 장례식장 검색 결과입니다. 위치, 연락처, 시설 정보를 확인해보세요."
            : '전국 장례식장 목록을 지역별로 찾아보고 위치, 연락처, 시설 정보를 확인해보세요.';

        $data = [
            'facilities' => $facilities,
            'pager' => $facilityModel->pager,
            'search' => $search,
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'seoKeywords' => '장례식장 목록, 장례식장 검색, 지역 장례시설, 장례시설 비교',
            'canonicalUrl' => site_url('funerals'),
            'currentPage' => $page,
        ];

        return view('funerals/index', $data);
    }

    public function detail($id)
    {
        $facilityModel = new FuneralFacilityModel();
        $itemModel = new FuneralItemModel();
        $naverModel = new NaverApiModel();

        $facility = $facilityModel->find($id);
        if (!$facility) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("해당 시설을 찾을 수 없습니다.");
        }

        // facility_name을 기반으로 검색
        $keyword = $facility['facility_name'];

        // API 호출
        $blogJson = $naverModel->blog($keyword);
        $imageJson = $naverModel->image($keyword);

        // 결과 디코딩
        $blog = $blogJson ? json_decode($blogJson, true) : [];
        $images = $imageJson ? json_decode($imageJson, true) : [];

        // 관련 항목
        $items = $itemModel
            ->where('funeral_home_name', $facility['facility_name'])
            ->findAll();

        $relatedFacilities = $facilityModel
            ->select('id, facility_name, city, county')
            ->where('city', $facility['city'])
            ->where('id !=', $facility['id'])
            ->orderBy('id', 'DESC')
            ->findAll(6);

        $facilityName = $facility['facility_name'] ?? '장례식장';
        $city = $facility['city'] ?? '';
        $county = $facility['county'] ?? '';
        $address = $facility['address'] ?? '';
        $phone = $facility['phone_number'] ?? '';

        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "FuneralHome",
            "name" => $facilityName,
            "url" => site_url('funerals/' . $facility['id']),
            "telephone" => $phone,
            "address" => [
                "@type" => "PostalAddress",
                "addressLocality" => trim($city . ' ' . $county),
                "streetAddress" => $address,
                "addressCountry" => "KR",
            ],
        ];

        return view('funerals/detail', [
            'facility' => $facility,
            'items' => $items,
            'blog' => $blog,
            'images' => $images,
            'relatedFacilities' => $relatedFacilities,
            'seoTitle' => "{$facilityName} 위치/시설/비용 상세 정보 | F.easehub",
            'seoDescription' => "{$facilityName}의 주소, 연락처, 시설, 비용 정보를 확인하고 유사한 지역 장례식장도 비교해보세요.",
            'seoKeywords' => "{$facilityName}, {$city}, {$county}, 장례식장 상세, 장례시설 비용",
            'canonicalUrl' => site_url('funerals/' . $facility['id']),
            'jsonLd' => $jsonLd,
        ]);
    }
}
