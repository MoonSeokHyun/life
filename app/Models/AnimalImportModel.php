<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalImportModel extends Model
{
    protected $table = 'animal_import';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}