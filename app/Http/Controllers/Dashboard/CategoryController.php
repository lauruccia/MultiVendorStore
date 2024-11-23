<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $query = Category::query();
        if($request->query('name'))
        {
            $query->where('name', 'like', '%'.$request->query('name').'%');
        }
        if($request->query('status'))
        {
            $query->wherestatus($request->query('status'));
        }
        $categories = $query->paginate(1); //return collection object 
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact(['parents', 'category']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Category::rules() ,[
            'unique'=>'The:attribute must be unique']);

        //request merge
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request);
        //mass assigment
        $category = Category::create($data);

        //PRG
        return redirect()->route('categories.index')->with('success', 'category created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findorfail($id);
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->wherenull('parent_id')
                    ->orwhere('parent_id', '<>', $id);
            })->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        //dd($request->all());
        $category = Category::findOrFail($id);
        $old_image = $category->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request);
        if ($new_image){
            $data['image'] = $new_image;}
        $category->update($data);

        if ($old_image && $new_image) {
            dd($data['image']);
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('categories.index')->with('success', 'category updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findorfail($id);
        $category->delete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.index')->with('success', 'category deleted successfuly');
    }

    protected function uploadImage(Request $request)
    {
        if (!$request->hasfile('image')) {
            return;
        }
        $path = $request->file('image')->store('images/categories', 'public'); //uploaded file object
        return $path;
    }
}
