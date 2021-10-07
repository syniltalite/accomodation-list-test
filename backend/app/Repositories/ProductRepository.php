<?php

namespace App\Repositories;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * search and filter products
     *
     * @param array
     * @return collection
     */

    const DATA_URL = 'https://atlas.atdw-online.com.au/api/atlas/';
    const API_KEY = '123456789101112';
    const PAGE_SIZE = '10';
    const PRODUCT_SEARCH_PARAM = [
        'key' => self::API_KEY,
        'cats' => 'ACCOMM',
        'out' => 'json',
        'st' => 'NSW',
        'size' => self::PAGE_SIZE,
        'pg' => 1
    ];
    const SUBURB_SEARCH_PARAM = [
        'key' => self::API_KEY,
        'out' => 'json',
        'st' => 'NSW',
    ];
    const AREA_SEARCH_PARAM = [
        'key' => self::API_KEY,
        'out' => 'json',
        'st' => 'NSW',
    ];

    public function searchProduct($filters = []){
        $params = self::PRODUCT_SEARCH_PARAM;
        $filters = $filters ? $filters : [];
        $params = array_merge($params, $filters);
        $result = $this::apiCall('products', $params);
        $result['page'] = !array_key_exists('pg', $filters) ? 1: $filters['pg'];
        $result['pageLimit'] = self::PAGE_SIZE;
        return $result;
    }

    public function suburbList(){
        $params = self::SUBURB_SEARCH_PARAM;
        $result = $this::apiCall('suburbs', $params);
        return $result[0];
    }

    public function areaList($filters = []){
        $params = self::AREA_SEARCH_PARAM;
        $result = $this::apiCall('areas', $params);
        return $result;
    }

    protected static function apiCall($type, $params){

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json; charset=UTF-8'
        ])->get(self::DATA_URL.$type, $params);

        $result = iconv($in_charset = 'UTF-16LE' , $out_charset = 'UTF-8' , $response->body());
        return json_decode($result, true);;
    }

}