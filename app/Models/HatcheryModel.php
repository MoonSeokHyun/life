<?php

namespace App\Models;

use CodeIgniter\Model;

class HatcheryModel extends Model
{
    protected $table = 'hatchery';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}