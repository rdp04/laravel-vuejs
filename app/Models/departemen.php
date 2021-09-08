<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departemen extends Model
{
    // use HasFactory;
    protected $table = "departemen";
    protected $primarykey = "id";
    protected $fillable = ['id','nama_departemen'];
}
