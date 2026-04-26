<?php

namespace App\Models;

use CodeIgniter\Model;

class LivestockAiCenterModel extends Model
{
    protected $table = 'livestock_ai_center';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}