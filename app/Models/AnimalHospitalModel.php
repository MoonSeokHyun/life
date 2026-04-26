<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalHospitalModel extends Model
{
    protected $table = 'animal_hospital';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}