<?php

namespace App\Models;

use CodeIgniter\Model;

class MedicalSupplySalesModel extends Model
{
    protected $table = 'medical_supply_sales';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}