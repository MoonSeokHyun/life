<?php

namespace App\Models;

use CodeIgniter\Model;

class FuneralFacilityModel extends Model
{
    protected $table = 'funeral_facilities';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'city', 'county', 'facility_name', 'address', 'phone_number',
        'parking_capacity', 'restaurant', 'convenience_store', 'parking_lot',
        'family_waiting_room', 'disabled_facilities', 'operation_type',
        'total_burial_capacity', 'facility_type'
    ];
}
