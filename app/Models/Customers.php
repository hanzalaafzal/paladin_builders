<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $primaryKey = 'customer_id';
    protected $table= "customers";
    protected $fillable = [
        'customer_name',
        'customer_cnic',
        'customer_number',
        'customer_network',
        'created_at'
    ];
    // protected $guard='admin';
}
