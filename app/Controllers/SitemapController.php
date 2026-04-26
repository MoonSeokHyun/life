<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class SitemapController extends Controller
{
    protected $perPage = 5000;
    
    private $tables = [
        'hospitals' => '\App\Models\AnimalHospitalModel',
        'funerals' => '\App\Models\AnimalFuneralModel',
        'pharmacies' => '\App\Models\AnimalPharmacyModel',
        'sales' => '\App\Models\AnimalSalesModel',
        'grooming' => '\App\Models\PetGroomingModel',
        'transport' => '\App\Models\AnimalTransportModel',
        'exhibition' => '\App\Models\AnimalExhibitionModel',
        'production' => '\App\Models\AnimalProductionModel',
        'import' => '\App\Models\AnimalImportModel',
        'trust' => '\App\Models\AnimalTrustManagementModel',
        'breeding' => '\App\Models\BreedingStockModel',
        'feed' => '\App\Models\FeedManufacturingModel',
        'hatchery' => '\App\Models\HatcheryModel',
        'livestock-ai' => '\App\Models\LivestockAiCenterModel',
        'livestock-farming' => '\App\Models\LivestockFarmingModel',
        'medical-supply' => '\App\Models\MedicalSupplySalesModel',
        'slaughterhouse' => '\App\Models\SlaughterhouseModel',
        'drug-wholesale' => '\App\Models\VeterinaryDrugWholesaleModel'
    ];

    public function index()
    {
        helper('url');

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        $xml .= "  <sitemap>\n";
        $xml .= "    <loc>" . base_url("sitemap/generate/static") . "</loc>\n";
        $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
        $xml .= "  </sitemap>\n";

        foreach ($this->tables as $key => $modelClass) {
            $model = new $modelClass();
            $total = $model->countAll();
            $pages = (int) ceil($total / $this->perPage);

            for ($i = 1; $i <= $pages; $i++) {
                $loc = base_url("sitemap/generate/{$key}/{$i}");
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

    public function generate($type = 'hospitals', $pageNumber = null)
    {
        if ($type === 'static') {
            return $this->generateStaticUrls();
        }

        if (!isset($this->tables[$type]) || empty($pageNumber)) {
            return $this->response
                        ->setStatusCode(404)
                        ->setBody('Invalid sitemap type.');
        }

        helper('url');

        $modelClass = $this->tables[$type];
        $model = new $modelClass();
        $offset = ($pageNumber - 1) * $this->perPage;

        $items = $model
                    ->orderBy('id', 'ASC')
                    ->findAll($this->perPage, $offset);

        $xml  = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";

        foreach ($items as $item) {
            $url = base_url("{$type}/{$item['id']}");
            $lastmod = date('Y-m-d');

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$url}</loc>\n";
            $xml .= "    <lastmod>{$lastmod}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.6</priority>\n";
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
        
        foreach ($this->tables as $key => $val) {
            $xml .= "  <url><loc>".base_url($key)."</loc><lastmod>{$today}</lastmod><changefreq>daily</changefreq><priority>0.8</priority></url>\n";
        }

        $xml .= "</urlset>";

        return $this->response
            ->setHeader('Content-Type', 'application/xml; charset=utf-8')
            ->setBody($xml);
    }
}
