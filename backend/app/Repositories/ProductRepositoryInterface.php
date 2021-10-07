<?php

namespace App\Repositories;

interface ProductRepositoryInterface
{
    /**
     * Get search product and include filter
     *
     * @param array
     * @return array
     */
    public function searchProduct($filters);

    /**
     * Get list of suburbs in NSW
     *
     * @return array
     */
    public function suburbList();

    /**
     * Get list of areas in NSW
     *
     * @return array
     */
    public function areaList();
}