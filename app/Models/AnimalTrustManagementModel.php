<?php

namespace App\Models;

use CodeIgniter\Model;

class AnimalTrustManagementModel extends Model
{
    protected $table = 'animal_trust_management';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}