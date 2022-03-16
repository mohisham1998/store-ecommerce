<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use DB;
use Exception;

class CategoriesController extends Controller
{

    public function index($type)
    {

        switch ($type) {

            case 'main_category' :
                $categories = Category::parent()->paginate(PAGINATION_COUNT);
                $category_type = 'main';
                break;

            case 'child_category' :
                $categories = Category::child()->paginate(PAGINATION_COUNT);
                $category_type = 'child';
                break;

            default :
                /** Error 404 page.. */
                $categories = Category::parent()->paginate(PAGINATION_COUNT);
                $category_type = 'main';

        }
        return view('dashboard.categories.index', compact('categories', 'category_type', 'type'));
    }


    public function create($type)
    {
        $categories = '';
        $category_type = 'main';
        if ($type === 'child_category') {
            $categories = Category::parent()->paginate(PAGINATION_COUNT);
            $category_type = 'child';

        }
        return view('dashboard.categories.create', compact('categories', 'type', 'category_type'));

    }


    public function edit($id)
    {
        $categories = '';
        $category_type = 'main'; // used for translations
        $type = 'main_category'; // used for url routes
        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.categories', $type)->with('error', __('admin\redirect.category-not-exist'));
            }
            if (isset($category->parent_id)) {
                $category_type = 'child';
                $type = 'child_category';
                $categories = Category::parent()->paginate(PAGINATION_COUNT);
            }


            return view('dashboard.categories.edit', compact('category', 'category_type', 'type', 'categories'));
        } catch (Exception $ex) {
            return redirect()->route('admin.categories', $type)->with(['error', __('admin\redirect.error')]);
        }

    }


    public function update(CategoryRequest $request, $id)
    {


        if ($request->has('child')) {
            $type = 'child_category';
        }


        try {
            $category = Category::find($id);


            if (!$category) {
                return redirect()->route('admin.categories')->with('error', __('admin\redirect.category-not-exist'));
            }


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            DB::beginTransaction();

            if ($request->has('photo')) {
                $filePath = uploadImage('categories', $request->photo);
                Category::where('id', $id)
                    ->update([
                        'photo' => $filePath,
                    ]);
            }


            if ($type === 'child_category') {

                $category->update([
                    'slug' => $request->slug,
                    'is_active' => $request->is_active,
                    'parent_id' => $request->main_category,
                ]);


            } else {
                $type = 'main_category';
                $category->update([
                    'slug' => $request->slug,
                    'is_active' => $request->is_active,
                ]);

            }


            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('admin.categories', $type)->with(['success' => __('admin\redirect.successfully-updated')]);
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.categories', $type)->with(['error', __('admin\redirect.error')]);
        }


    }

    public function store(CategoryRequest $request)
    {
        try {

            $type = 'main_category';

            if ($request->has('child')) {
                $type = 'child_category';
            }


            /** Saving photo */
            $filePath = "";
            if ($request->has('photo')) {
                $filePath = uploadImage('categories', $request->photo);
            }


            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            DB::beginTransaction();


            if ($type === 'child_category') {
                $category = Category::create([
                    'slug' => $request->slug,
                    'is_active' => $request->is_active,
                    'photo' => $filePath,
                    'parent_id' => $request->main_category,
                ]);
            } else {
                $category = Category::create([
                    'slug' => $request->slug,
                    'is_active' => $request->is_active,
                    'photo' => $filePath,
                ]);
            }

            //save translations
            $category->name = $request->name;
            $category->save();

            DB::commit();

            return redirect()->route('admin.categories', $type)->with(['success' => __('admin\redirect.successfully-added')]);

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.categories', $type)->with(['error' => __('admin\redirect.error')]);
        }


    }


    public function destroy($id)
    {
        $type = 'child_category';

        try {

            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.categories', $type)->with('error', __('admin\redirect.category-not-exist'));


            if (!isset($category->parent_id)) {
                $type = 'main_category';
                $sub_categories = (new Category)->getChildren($category->id);
                if (isset($sub_categories) && $sub_categories->count() > 0) {
                    return redirect()->route('admin.categories', $type)->with(['error' => __('admin\redirect.cant-delete-category')]);
                }
            }


            $category->translations()->delete();
            $category->delete();


            return redirect()->route('admin.categories', $type)->with(['success' => __('admin\redirect.successfully-deleted')]);

        } catch (Exception $ex) {
            return redirect()->route('admin.categories', $type)->with('error', __('admin\redirect.error'));
        }
    }


}
