<?php
// app/Models/FuneralItemModel.php

namespace App\Models;
use CodeIgniter\Model;

class FuneralItemModel extends Model
{
    protected $table = 'funeral_items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'facility_type',
        'funeral_home_name',
        'item_category',
        'item_type',
        'item_name',
        'item_detail',
        'price'
    ];
}
