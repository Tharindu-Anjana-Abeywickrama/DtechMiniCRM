<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='employee';
    protected $fillable=[
    'id',
    'frist_name',
    'last_name',
    'company',
    'email',
    'phone',
    'created_at',   
    'updated_at',   
   ];
}
