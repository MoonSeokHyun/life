<?php

namespace App\Models;

use CodeIgniter\Model;

class VeterinaryDrugWholesaleModel extends Model
{
    protected $table = 'veterinary_drug_wholesale';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}