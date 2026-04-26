<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalProductionModel extends Model
{
    protected $table = 'animal_production';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}