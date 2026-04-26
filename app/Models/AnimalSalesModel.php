<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalSalesModel extends Model
{
    protected $table = 'animal_sales';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}