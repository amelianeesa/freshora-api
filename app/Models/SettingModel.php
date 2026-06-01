<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table            = 'settings';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'price_daily', 
        'price_express', 
        'price_dry', 
        'price_iron', 
        'price_complete',
        'bank_name', 
        'bank_number', 
        'bank_holder', 
        'whatsapp_admin', 
        'qris_image'
    ];

    protected $useTimestamps = false;
}