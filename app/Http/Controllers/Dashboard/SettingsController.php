<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\Setting;
use DB;

class SettingsController extends Controller
{

    public function editShipping($type)
    {
        switch ($type) {

            case 'inner' :
                $shippingMethod = Setting::where('key', 'local_label')->first();
                break;

            case 'outer' :
                $shippingMethod = Setting::where('key', 'outer_label')->first();
                break;
            default :
                $shippingMethod  = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shipping.edit', compact('shippingMethod'));


    }

    public function updateShipping(ShippingRequest $request , $id) {

        try {
            $shipping_method = Setting::find($id);

            DB::beginTransaction();
            $shipping_method->update(['plain_value' => $request->plain_value]);
            //save translations
            $shipping_method->value = $request->value;
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => __('admin\redirect.success')]);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => __('admin\redirect.error')]);
            DB::rollback();
        }

    }



}
