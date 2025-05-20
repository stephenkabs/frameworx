<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //    $this->middleware('permission:view category',['only'=> ['index','show']]);
    //    $this->middleware('permission:create category',['only'=> ['create','store']]);
    //    $this->middleware('permission:edit category',['only'=> ['update','edit']]);
    //    $this->middleware('permission:delete category',['only'=> ['destroy']]);

    // }
    public function index()
    {
        $categories = Category::all(); // Fetch all categories
        return view('categories.index', compact('categories')); // Assuming a blade view for listing categories
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('categories.create'); // Assuming a blade view for creating a category
    }

    /**
     * Store a newly created category in the database.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $post = new Category();
        $post->name = $request->input('name');
        $post->type = $request->input('type');
        $post->slug = Str::slug($request->name);
        $post->user_id = $user->id;
        $post->save();


        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified category.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category')); // Show a single category
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category')); // Show the edit form
    }

    /**
     * Update the specified category in the database.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:categories,slug,' . $category->id,
        ]);

        // Update the category
        $category->update([
            'name' => $request->name,
            'type' => $request->type,
            'slug' => $request->slug ?? Str::slug($request->name),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified category from the database.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
