<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalPharmacyModel extends Model
{
    protected $table = 'animal_pharmacy';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}