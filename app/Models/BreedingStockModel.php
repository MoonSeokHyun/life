<?php

namespace App\Models;

use CodeIgniter\Model;

class BreedingStockModel extends Model
{
    protected $table = 'breeding_stock';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}