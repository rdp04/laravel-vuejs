<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permintaan extends Model
{
    protected $table = "permintaan";
    protected $primarykey = "id";
    protected $fillable = ['id','id_barang','kuantiti','satuan','keterangan','id_peminta','status'];

    public function karyawan()
    {
        return $this->hasOne('App\Models\karyawan', 'id','id_peminta');
    }
    public function barang()
    {
        return $this->hasOne('App\Models\barang', 'id','id_barang');
    }

}
