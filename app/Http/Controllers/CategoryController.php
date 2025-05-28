<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{

    public function Adminindex()
    {
        $categories = Category::withCount('products')->get();
        return view('admin.category.index', compact('categories'));
    }
  public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    try {
        $category = new Category();
        $category->name = $request->name;

        if ($request->hasFile('image')) {
    $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('storage'), $imageName);
                $imagePath = $imageName;
            }
   if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $category->image = $imagePath;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withInput()
            ->with('error', 'Error creating category: ' . $e->getMessage());
    }
}
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete category with associated products.');
        }

        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $category->name = $request->name;

            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($category->image && Storage::disk('public')->exists($category->image)) {
                    Storage::disk('public')->delete($category->image);
                }

                // Upload the new image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('storage'), $imageName);
                $category->image = $imageName;
            }

            $category->save();

            return redirect()->back()->with('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error updating category: ' . $e->getMessage());
        }
    }
}
