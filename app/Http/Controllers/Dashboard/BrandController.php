<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use DB;

class BrandController extends Controller
{

    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('dashboard.brands.create');
    }


    public function store(BrandRequest $request)
    {

        try {
            DB::beginTransaction();

            //validation

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create([
                'is_active' => $request -> is_active,
                'photo' => $fileName
            ]);

            //save translations
            $brand->name = $request->name;
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => __('admin\redirect.successfully-added')]);

        }

        catch (\Exception $ex) {
            DB::rollback();
            return $ex;
        }




    }


    public function edit($id)
    {

        //get specific categories and its translations
        $brand = Brand::find($id);

        if (!$brand)
            return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.brand-not-exist')]);

        return view('dashboard.brands.edit', compact('brand'));

    }


    public function update($id, BrandRequest $request)
    {
        try {
            //validation

            //update DB


            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.brand-not-exist')]);


            DB::beginTransaction();
            if ($request->has('photo')) {
                $fileName = uploadImage('brands', $request->photo);
                Brand::where('id', $id)
                    ->update([
                        'photo' => $fileName,
                    ]);
            }

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('_token', 'id', 'photo'));

            //save translations
            $brand->name = $request->name;
            $brand->save();

            DB::commit();
            return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.successfully-updated')]);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.error')]);
        }

    }


    public function destroy($id)
    {
        try {
            //get specific categories and its translations
            $brand = Brand::find($id);

            if (!$brand)
                return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.brand-not-exist')]);

            $brand->delete();

            return redirect()->route('admin.brands')->with(['success' => __('admin\redirect.successfully-deleted')]);

        } catch (\Exception $ex) {
            return redirect()->route('admin.brands')->with(['error' => __('admin\redirect.error')]);
        }
    }

}
