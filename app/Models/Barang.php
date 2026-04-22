<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = ['nama'
    , 'category_id'
    , 'kondisi'
    , 'status'
    ,'tanggal_masuk'
    ,'deskripsi'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
