<?php

namespace App\Http\Controllers;

use App\Http\Requests\BarangRequest;
use App\Models\Barang;
use App\Models\Category;
use App\Services\BarangService;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    protected $barang;
    protected $categories;
    
    public function __construct(BarangService $barangService, CategoryService $categoryService){
     $this->barang=$barangService;
     $this->categories=$categoryService;
    }
    

    public function index()
    {
     $barangs = $this->barang->getAll(); 
   $categories = $this->categories->getAll();
    return view('admin.barang', compact('barangs', 'categories'));
    }

    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangRequest $request)
    {
         $this->barang->create($request->validated());
         return redirect()->route('barang.index')->with('success','Item Added');

        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->barang->getById($id);
        return view('admin.barang', compact('barangs', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BarangRequest $request,$id)
    {
        $this->barang->update($id,$request->validated());
        return redirect()->route('barang.index')->with('success','Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
     $this->barang->delete($id);
     return redirect()->route('barang.index')->with('success','Item Deleted');  
    }
}
