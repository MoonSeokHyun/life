<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalExhibitionModel extends Model
{
    protected $table = 'animal_exhibition';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}