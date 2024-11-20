<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::latest()->get();
        return view('dashboard.category.index',compact('categorys'));
    }

    public function created(Request $request){
        $manager = new ImageManager(new Driver());

        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        $newName = $request->title.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
        $image = $manager->read($request->file('image'));
        $image->toPng()->save(base_path('public/upload/category/'.$newName));

        if($request->slug){
            Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->slug,'-'),
                'image' => $newName,
                'created_at' => now(),
            ]);
            return back()->with('created', "Catehory Created SuccessFul");
        }else{
            Category::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title,'-'),
                'image' => $newName,
                'created_at' => now(),
            ]);
        return back()->with('created', "Catehory Created SuccessFul");

        }



    }
    public function action($slug){
        $category = Category::where('slug',$slug)->first();

        if($category->status == 'deactive'){
            Category::find($category->id)->update([
                'status' => "active",
                'updated_at' => now(),
            ]);
            return redirect()->route('category.index')->with('action',"Category active Successful");
        }else{
            Category::find($category->id)->update([
                'status' => "deactive",
                'updated_at' => now(),
            ]);
            return redirect()->route('category.index')->with('action',"Category deactive Successful");
        }

    }


    public function edit($slug){
        $category = Category::where('slug',$slug)->first();
        return view('dashboard.category.edit',compact('category'));
    }

    public function update(Request $request, $slug){
        $manager = new ImageManager(new Driver());

        $category = Category::where('slug',$slug)->first();

        if($request->image){

            $oldPath = base_path('public/upload/category/'.$category->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }

            $newName = $request->title.'-'.rand(1111,9999).'.'.$request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/upload/category/'.$newName));

            if($request->slug){
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'image' => $newName,
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('update',"Category Update Successful");
            }else{
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'image' => $newName,
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('update',"Category Update Successful");

            }
        }else{
            if($request->slug){
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->slug,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('update',"Category Update Successful");

            }else{
                Category::find($category->id)->update([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title,'-'),
                    'updated_at' => now(),
                ]);
                return redirect()->route('category.index')->with('update',"Category Update Successful");

            }
        }
    }

    public function delete($slug){
        $category = Category::where('slug',$slug)->first();

        if($category->image){
            $oldPath = base_path('public/upload/category/'.$category->image);
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }

        Category::find($category->id)->delete();
        return redirect()->route('category.index')->with('delete',"Category Delete Successful");



    }
}
