<?php

namespace App\Models;

use CodeIgniter\Model;

class SlaughterhouseModel extends Model
{
    protected $table = 'slaughterhouse';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}