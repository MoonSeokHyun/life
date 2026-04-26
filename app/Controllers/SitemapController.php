<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Database\Config;

class SitemapController extends Controller
{
    protected $perPage = 5000;
    
    // LifeHub 주요 서비스 테이블 목록 (동적 처리)
    private $tables = [
        'lodgings', 'karaoke_rooms', 'pc_bangs', 'movie_theaters', 
        'domestic_travel_agencies', 'museums_and_art_galleries', 
        'performance_halls', 'general_game_providers', 'rural_homestays', 
        'hanok_experience', 'tourist_accommodations', 'tourist_pensions', 
        'general_campgrounds', 'auto_campgrounds', 'film_producers', 
        'game_producers', 'music_video_producers', 'pop_culture_art_planners', 
        'amusement_facilities_other', 'video_viewing_rooms', 'youth_game_providers',
        'domestic_international_travel_agencies', 'comprehensive_travel_agencies'
    ];

    public function index()
    {
        helper('url');
        $db = Config::connect();

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        
        // 정적 URL (홈페이지 등)
        $xml .= "  <sitemap>\n";
        $xml .= "    <loc>" . base_url("sitemap/generate/static") . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "  </sitemap>\n";

        // 각 테이블별 사이트맵 분할
        foreach ($this->tables as $table) {
            $builder = $db->table($table);
            $total = $builder->countAllResults();
            if ($total == 0) continue;

            $pages = (int) ceil($total / $this->perPage);

            for ($i = 1; $i <= $pages; $i++) {
                $loc = base_url("sitemap/generate/{$table}/{$i}");
                $xml .= "  <sitemap>\n";
                $xml .= "    <loc>{$loc}</loc>\n";
                $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
                $xml .= "  </sitemap>\n";
            }
        }

        $xml .= "</sitemapindex>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }

    public function generate($type = 'lodgings', $pageNumber = null)
    {
        helper('url');
        
        if ($type === 'static') {
            return $this->generateStaticUrls();
        }

        if (!in_array($type, $this->tables) || empty($pageNumber)) {
            return $this->response->setStatusCode(404)->setBody('Invalid sitemap type.');
        }

        $db = Config::connect();
        $offset = ($pageNumber - 1) * $this->perPage;

        $items = $db->table($type)
                    ->select('id')
                    ->orderBy('id', 'ASC')
                    ->limit($this->perPage, $offset)
                    ->get()
                    ->getResultArray();

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($items as $item) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . base_url("{$type}/{$item['id']}") . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.5</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
                    ->setHeader('Content-Type', 'application/xml; charset=utf-8')
                    ->setBody($xml);
    }

    protected function generateStaticUrls()
    {
        helper('url');
        $today = date('Y-m-d');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        $xml .= "  <url><loc>".base_url('/')."</loc><lastmod>{$today}</lastmod><changefreq>daily</changefreq><priority>1.0</priority></url>\n";
        
        foreach ($this->tables as $table) {
            $xml .= "  <url><loc>".base_url($table)."</loc><lastmod>{$today}</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }
}
