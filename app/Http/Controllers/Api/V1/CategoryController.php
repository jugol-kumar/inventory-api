<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private string $description = "Category all api endpoints";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "yes called";
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Category $category
     */
    public function show(Category $category)
    {
        try {
            $categories = Category::with(['childrenRecursive'])
                ->where('parent_id', 0)
                ->select(['id','parent_id', 'name', 'slug'])
                ->get();
            if ($categories->count() > 0){
                return response()->api(
                    status: true,
                    message:"Category collection retrieved successfully.",
                    description: $this->description,
                    data: [
                        'category' => [
                            $categories
                        ]
                    ]
                );
            }
            return response()->api(
                status: false,
                message: "Category Could Not Be Found.",
                description: $this->description,
            );
        }catch(\Exception $e){
            return response()->api(
                status: false,
                message: "Category collection not retrieved",
                description: $e->getMessage(),
            );
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Category $category
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     */
    public function destroy(Category $category)
    {
        //
    }
}
