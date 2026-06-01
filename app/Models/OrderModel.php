<?php
namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'user_id', 'service_name', 'fullname', 'whatsapp', 
        'address', 'pickup_time', 'notes', 'promo_code', 
        'resi_code', 'status', 'payment_method', 'weight', 
        'total_price', 'payment_proof', 'laundry_photo'
    ];
    
    protected $useTimestamps = true; 
}