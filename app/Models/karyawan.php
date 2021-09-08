<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class karyawan extends Model
{
    protected $table = "karyawan";
    protected $primarykey = "id";
    protected $fillable = ['id','nama','nik','departemen_id'];

}
