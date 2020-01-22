<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:categories',
            'image'=>'required|mimes:jpeg,png,bmp,jpg'
        ]);
        $image=$request->file('image');
        $slug=str_slug($request->name);
        if(isset($image))
        {
            $currentdate=Carbon::now()->toDateString();
            $imagename=$slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');
            }
            $category=Image::make($image)->resize(1600,479)->save('my-image.jpg', 90);
            Storage::disk('public')->put('category/'.$imagename,$category);
            if(!Storage::disk('public')->exists('category/slider'))
            {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            $slider=Image::make($image)->resize(400,333)->save('my-image.jpg', 90);
            Storage::disk('public')->put('category/slider/'.$imagename,$slider);

        }else{
            $imagename='default.png';
        }
        $category= new Category();
        $category->name=$request->name;
        $category->slug=$slug;
        $category->image=$imagename;
        $category->save();
        return redirect()->route('admin.category.index')->with('message','data stored successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::find($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name'=>'required :categories',
            'image'=>'mimes:jpeg,png,jpg'

        ]);
        $image=$request->file('image');
        $slug=str_slug($request->name);
        $category=Category::find($id);
        if(isset($image))
        {
             $currentdate=Carbon::now()->toDateString();
             $imagename=$slug.'-'.$currentdate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('category'))
            {
                Storage::disk('public')->makeDirectory('category');

            }
             $categoryimage=Image::make($image)->resize(1600,479)->save('my-image.jpg',90);
             Storage::disk('public')->put('category/'.$imagename,$categoryimage);

             if(Storage::disk('public')->exists('category/'.$category->image))
             {
                 Storage::disk('public')->delete('category/'.$category->image);
             }

             if(!Storage::disk('public')->exists('category/slider'))
             {
                 Storage::disk('public')->makeDirectory('category/slider');
             }
             if(Storage::disk('public')->exists('category/slider/'.$category->image))
             {
                 Storage::disk('public')->delete('category/slider/'.$category->image);
             }
             $slider=Image::make($image)->resize(400,333)->save('my-image.jpg',90);
             Storage::disk('public')->put('category/slider/'.$imagename,$slider);
        }else{
            $imagename=$category->image;
        }

        $category->name=$request->name;
        $category->slug=$slug;
        $category->image=$imagename;
        $category->save();
        return redirect()->route('admin.category.index')->with('message','Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::find($id);
        if(Storage::disk('public')->exists('category/'.$category->image))
        {
            Storage::disk('public')->delete('category/'.$category->image);
        }
        if(Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }
        $category->delete();
        return redirect()->back()->with('message','Deleted successfully!');
    }
}
