<?php

namespace App\Models;

use CodeIgniter\Model;

class LivestockFarmingModel extends Model
{
    protected $table = 'livestock_farming';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}