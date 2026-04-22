<?php

namespace App\Services;

use App\Models\Peminjaman;

class PeminjamanService{
  public function getAll(){
    return Peminjaman::with(['user', 'barang'])->get(); 
 }
  public function getById($id){
    return Peminjaman::findOrFail($id);
  }

  public function create(array $data){
    return Peminjaman::create($data);
  }

  public function update($id, array $data){
    $peminjaman = Peminjaman::findOrFail($id);
    if($peminjaman){
        $peminjaman->update($data);
        return $peminjaman;
    }
    return null;
  }

  public function delete($id){
    $peminjaman = Peminjaman::findOrFail($id);
    if($peminjaman){
        $peminjaman->delete();
        return true;
    }
    return false;
  }
 }
