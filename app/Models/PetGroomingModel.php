<?php

namespace App\Models;

use CodeIgniter\Model;

class PetGroomingModel extends Model
{
    protected $table = 'pet_grooming';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}