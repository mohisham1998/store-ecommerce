<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use DB;
use Exception;

class MainCategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::parent()->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }


    public function create()
    {
        return view('dashboard.categories.create');

    }


    public function edit($id)
    {

        try {
            $category = Category::find($id);
            if (!$category) {
                return redirect()->route('admin.categories')->with('error', __('admin\redirect.category-not-exist'));
            }

            return view('dashboard.categories.edit', compact('category'));
        } catch (Exception $ex) {
            return redirect()->route('admin.categories')->with(['error', __('admin\redirect.error')]);
        }

    }


    public function update(MainCategoryRequest $request, $id)
    {

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


            $category->update([
                'slug' => $request->slug,
                'is_active' => $request->is_active,
            ]);

            //save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();

            return redirect()->route('admin.categories')->with(['success' => __('admin\redirect.successfully-updated')]);
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.categories')->with(['error', __('admin\redirect.error')]);
        }


    }

    public function store(MainCategoryRequest $request)
    {
        try {

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

            $category = Category::create([
                'slug' => $request->slug,
                'is_active' => $request->is_active,
                'photo' => $filePath,
            ]);

            //save translations
            $category->name = $request->name;
            $category->save();

            DB::commit();
            return redirect()->route('admin.categories')->with(['success' => __('admin\redirect.successfully-added')]);

        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.categories')->with(['error' => __('admin\redirect.error')]);
        }


    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.categories')->with('error', __('admin\redirect.category-not-exist'));

            $category->translations() -> delete();
            $category->delete();


            return redirect()->route('admin.categories')->with(['success' => __('admin\redirect.successfully-deleted')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.categories')->with('error', __('admin\redirect.error'));
        }
    }



}
