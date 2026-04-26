<?php

namespace App\Controllers;

use App\Models\AnimalHospitalModel;
use App\Models\NaverApiModel;

class AnimalHospital extends BaseController
{
    public function index()
    {
        $hospitalModel = new AnimalHospitalModel();

        $search = trim((string) $this->request->getGet('search'));
        $perPage = 12;
        $page = max(1, (int) ($this->request->getGet('page') ?? 1));

        if ($search) {
            $hospitalModel->groupStart()
                         ->like('사업장명', $search)
                         ->orLike('지번주소', $search)
                         ->orLike('도로명주소', $search)
                         ->orLike('전화번호', $search)
                         ->groupEnd();
        }

        // '영업상태명'이 '정상영업'인 데이터만 필터링하거나 전체를 보여줄 수 있음
        $hospitals = $hospitalModel
            ->orderBy('id', 'DESC')
            ->paginate($perPage);

        $seoTitle = $search
            ? "\"{$search}\" 검색 결과 | 전국 동물병원 목록 - AnimalCare"
            : '전국 동물병원 목록 및 지역 검색 | AnimalCare';

        $seoDescription = $search
            ? "{$search} 관련 동물병원 검색 결과입니다. 위치, 연락처, 진료 정보를 확인해보세요."
            : '전국 동물병원 목록을 지역별로 찾아보고 위치, 연락처 정보를 확인해보세요.';

        $data = [
            'hospitals' => $hospitals,
            'pager' => $hospitalModel->pager,
            'search' => $search,
            'seoTitle' => $seoTitle,
            'seoDescription' => $seoDescription,
            'seoKeywords' => '동물병원 목록, 동물병원 검색, 지역 동물병원, 24시 동물병원',
            'canonicalUrl' => site_url('hospitals'),
            'currentPage' => $page,
        ];

        return view('hospitals/index', $data);
    }

    public function detail($id)
    {
        $hospitalModel = new AnimalHospitalModel();
        $naverModel = new NaverApiModel();

        $hospital = $hospitalModel->find($id);
        if (!$hospital) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("해당 동물병원을 찾을 수 없습니다.");
        }

        // 사업장명을 기반으로 네이버 블로그/이미지 검색
        $keyword = $hospital['사업장명'];

        // API 호출
        $blogJson = $naverModel->blog($keyword);
        $imageJson = $naverModel->image($keyword);

        // 결과 디코딩
        $blog = $blogJson ? json_decode($blogJson, true) : [];
        $images = $imageJson ? json_decode($imageJson, true) : [];

        // 관련 동물병원 (같은 시/군/구 내에서 검색)
        // 주소에서 시/군/구 추출 (간단히 앞부분 사용)
        $addressParts = explode(' ', $hospital['지번주소'] ?? $hospital['도로명주소']);
        $city = $addressParts[0] ?? '';
        $county = $addressParts[1] ?? '';

        $relatedHospitals = $hospitalModel
            ->select('id, 사업장명, 지번주소, 도로명주소')
            ->like('지번주소', $city . ' ' . $county)
            ->where('id !=', $hospital['id'])
            ->orderBy('id', 'DESC')
            ->findAll(6);

        $hospitalName = $hospital['사업장명'] ?? '동물병원';
        $address = $hospital['도로명주소'] ?: $hospital['지번주소'];
        $phone = $hospital['전화번호'] ?? '';

        $jsonLd = [
            "@context" => "https://schema.org",
            "@type" => "VeterinaryCare",
            "name" => $hospitalName,
            "url" => site_url('hospitals/' . $hospital['id']),
            "telephone" => $phone,
            "address" => [
                "@type" => "PostalAddress",
                "streetAddress" => $address,
                "addressCountry" => "KR",
            ],
        ];

        return view('hospitals/detail', [
            'hospital' => $hospital,
            'blog' => $blog,
            'images' => $images,
            'relatedHospitals' => $relatedHospitals,
            'seoTitle' => "{$hospitalName} 위치/진료/연락처 상세 정보 | AnimalCare",
            'seoDescription' => "{$hospitalName}의 주소, 연락처, 영업 상태를 확인하고 주변 동물병원도 함께 찾아보세요.",
            'seoKeywords' => "{$hospitalName}, {$city}, {$county}, 동물병원 상세, 동물병원 전화번호",
            'canonicalUrl' => site_url('hospitals/' . $hospital['id']),
            'jsonLd' => $jsonLd,
        ]);
    }
}
