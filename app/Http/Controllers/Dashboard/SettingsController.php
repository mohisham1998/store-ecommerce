<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function editShipping($type)
    {

        switch ($type) {

            case 'free' :
                return Setting::where('key', 'free_shipping_label')->first();
            case 'inner' :
                return Setting::where('key', 'local_label')->first();

            case 'outer' :
                return Setting::where('key', 'outer_label')->first();
            default :
                return 'msh 3alya yalaa';

        }
    }

    public function updateShipping($id) {

    }


}
