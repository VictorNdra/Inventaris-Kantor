<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   protected $categoryService;

   public function __construct(CategoryService $categoryService){
            $this->categoryService = $categoryService;
   }
   
    public function index()
    {
       $categories = $this->categoryService->getAll();
        return view('admin.category',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
       $this->categoryService->create($request->validated());
      return redirect()->route('kategori.index')->with('success','Category Added');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $this->categoryService->getById($id);
         return redirect()->route('kategori.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id,CategoryRequest $request)
    {
        $this->categoryService->update($id,$request->validated());
         return redirect()->route('kategori.index')->with('success','Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->categoryService->delete($id);
         return redirect()->route('kategori.index')->with('success','Category Deleted');
    }
}
