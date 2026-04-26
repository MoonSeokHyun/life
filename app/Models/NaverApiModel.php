<?php

namespace App\Models;

use CodeIgniter\Model;

class NaverApiModel extends Model
{

    public function blog($keyword){

        $client_id = "c5eleOJ1iSyifj4woKPl";
        $client_secret = "rIvkWeqPq5";
        $encText = urlencode($keyword);
        $url = "https://openapi.naver.com/v1/search/blog?query=".$encText."&display=5"; // json 결과

        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close ($ch);
        if($status_code == 200) {
            return $response;
        } else {
            return null;
        }
    }

    public function image($keyword, $start = 1){
        $client_id = "c5eleOJ1iSyifj4woKPl";
        $client_secret = "rIvkWeqPq5";
        $encText = urlencode($keyword);
        $url = "https://openapi.naver.com/v1/search/image?start=".$start."&query=".$encText."&display=10&sort=sim"; // json 결과

        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close ($ch);
        if($status_code == 200) {
            return $response;
        } else {
            return null;
        }
    }

    public function news($keyword){
        $client_id = "c5eleOJ1iSyifj4woKPl";
        $client_secret = "rIvkWeqPq5";
        $encText = urlencode($keyword);
        $url = "https://openapi.naver.com/v1/search/news?query=".$encText; // json 결과

        $is_post = false;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $is_post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = array();
        $headers[] = "X-Naver-Client-Id: ".$client_id;
        $headers[] = "X-Naver-Client-Secret: ".$client_secret;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec ($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close ($ch);
        if($status_code == 200) {
            return $response;
        } else {
            return null;
        }
    }

    public function map($address){
        $result = ['x' => 0, 'y' => 0, 'roadAddress' => $address, 'jibunAddress' => $address];

        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';

        if (strpos($userAgent, 'Googlebot') !== false) {
            return $result;
        }
    
        $url = "https://naveropenapi.apigw.ntruss.com/map-geocode/v2/geocode";

        $clientId = "24lj4g8fug";
        $clientSecret = "82t6USZN3Fsd2SMV8tDfAaFQAMpDWm40NPPb6o1g";

        $query = urlencode($address);
        $requestUrl = "$url?query=$query";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-NCP-APIGW-API-KEY-ID: $clientId",
            "X-NCP-APIGW-API-KEY: $clientSecret"
        ]);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return $result;
        }

        $data = json_decode($response, true);
        
        if (!empty($data['addresses'][0])) {
            $result['x'] = $data['addresses'][0]['x'] ?? 0;
            $result['y'] = $data['addresses'][0]['y'] ?? 0;
            $result['roadAddress'] = $data['addresses'][0]['roadAddress'] ?? $address;
            $result['jibunAddress'] = $data['addresses'][0]['jibunAddress'] ?? $address;
        }

        return $result;
    }
}
