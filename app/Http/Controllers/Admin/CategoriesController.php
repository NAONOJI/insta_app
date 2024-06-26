<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    /**
     * Retrieve all the categories from categories table and sort the result in descending order by updating_at colum, limit the result to 5 categories per page
     */
    public function index(){
        $all_categories = $this->category->orderBy('updated_at', 'desc')->paginate(5);

        /**
         * Uncategorized post
         */
        $uncategorized_count = 0;
        $all_posts = $this->post->all();
        foreach ($all_posts as $post) {
            if($post->categoryPost->count() == 0){
                $uncategorized_count++;
                //categoryPosts comes from Post Model
            }
        }

        return view('admin.categories.index')
            ->with('all_categories', $all_categories)
            ->with('uncategorized_count', $uncategorized_count);
    }

    /**
     * Add new category
     */
    public function store(Request $request){
        #Validate the data
        $request->validate([
            'name' => 'required|min:1|max:50|unique:categories,name'
        ]);

        #Save the new category into the table
        $this->category->name = ucwords(strtolower($request->name));
        #Note: ucwords() -> use to convert the first letter of the word to uppercase
        #Note: strtolower()->use to convert the UPPERCASE into lowercase
        # Example: SWIMMING ->swimming ->Swimming
        #           Category strtolower() ucwords()

        $this->category->save();
        #First 'name' -> comes from database(categories->name), Second 'name' -> comes from form

        return redirect()->back();
    }

    /**
     * Update the category name
     */
    public function update(Request $request, $id){
        #Validate the data
        $request->validate([
            'new_name' => 'required|min:1|max:50|unique:categories,name,' . $id
            //new_name comes from input name
            //name should be unique except for $id
        ]);

        #Note: The "$id" is the id of the category that we are trying to update
        $category = $this->category->findOrFail($id);
        $category->name = ucwords(strtolower($request->new_name));
        $category->save();

        return redirect()->back();
    }

    /**
     * Method to delete categories
     */
    public function destroy($id){
        $this->category->destroy($id);
        return redirect()->back();
    }

}
