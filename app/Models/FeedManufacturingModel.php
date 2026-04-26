<?php

namespace App\Models;

use CodeIgniter\Model;

class FeedManufacturingModel extends Model
{
    protected $table = 'feed_manufacturing';
    protected $primaryKey = 'id';
    protected $protectFields = false;
    protected $returnType = 'array';
}