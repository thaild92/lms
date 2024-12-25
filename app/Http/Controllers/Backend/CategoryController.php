<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategory()
    {
        $category = Category::latest()->get();

        return view('admin.backend.category.all_category', compact('category'));
    } // End Method

    public function AddCategory()
    {
        return view('admin.backend.category.add_category');
    } // End Method

    public function StoreCategory(Request $request)
    {


        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

        Image::make($image)->resize(370, 246)->save('upload/category/' . $name_gen);


        $save_url = 'upload/category/' . $name_gen;
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            'image' => $save_url

        ]);

        $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.category')->with($notification);
    } // End Method


    public function EditCategory(string $category_id)
    {
        $category = Category::find($category_id);
        return view('admin.backend.category.edit_category', compact('category'));
    } //End Method


    public function UpdateCategory(Request $request)
    {
        $cat_id = $request->id;

        $category = Category::find($cat_id);

        $image = $request->file('image');

        if ($image) {
            unlink(public_path($category->image));
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            Image::make($image)->resize(370, 246)->save('upload/category/' . $name_gen);


            $save_url = 'upload/category/' . $name_gen;


            $category->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
                'image' => $save_url

            ]);
        } else {

            $category->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
            ]);
        }


        $notification = array(
            'message' => 'Category Updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->route('all.category')->with($notification);
    } //End Method


    public function DeleteCategory($id)
    {


        $category = Category::find($id);

        unlink($category->image);


        $category->delete();



        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    } //End Method
}
