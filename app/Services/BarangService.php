<?php
namespace App\Services;

use App\Models\Barang;

class BarangService{
    public function getAll(){
        return Barang::with('category')->get();
    }

    public function getById($id){
        return Barang::findOrFail($id);
    }

    public function create(array $data){
        return Barang::create($data);
    }

    public function update($id, array $data){
        $barang = Barang::findOrFail($id);
        if($barang){
            $barang->update($data);
            return $barang;
        }
        return null;
    }

    public function delete($id){
        $barang = Barang::findOrFail($id);
        if($barang){
            $barang->delete();
            return true;
        }
        return false;
    }
}

