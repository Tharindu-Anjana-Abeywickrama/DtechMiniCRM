<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='company';
    protected $fillable=[
    'id',
    'company_name',
    'email',
    'website_name',
    'logo_path',
    'created_at',   
    'updated_at',   
   ];
}
