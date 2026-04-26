<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalFuneralModel extends Model
{
    protected $table = 'animal_funeral';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}