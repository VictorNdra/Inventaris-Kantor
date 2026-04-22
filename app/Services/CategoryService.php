<?php

namespace App\Services;

use App\Models\Category;

class CategoryService{
    public function getAll(){
        return Category::all();
    }
    
    public function getById($id){
        return Category::findOrFail($id);
    }

    public function create(array $data){
        return Category::create($data);
    }

    public function update($id,array $data){
        $category = Category::findOrFail($id);
        if($category){
            $category->update($data);
            return $category;
        }
        return null;
    }

    public function delete($id){
        $category = Category::findOrFail($id);
        if($category){
        $category->delete();
        return true;
        }
        return false;
    }
    
}