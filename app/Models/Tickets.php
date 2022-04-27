<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $primaryKey = 'ticket_id';
    protected $table= "tickets";
    // protected $guard='admin';
}
