<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function editProfile()
    {
        $admin = Admin::find(auth('admin')->user()->id);

        return view('dashboard.profile.edit', compact('admin'));

    }


    public function updateProfile(ProfileRequest $request)
    {

        $flag = false;
        /** Checking whether password is entered or not */
        try {

            $admin = Admin::find(auth('admin')->user()->id);

            unset($request['id']);
            unset($request['password_confirmation']);

            if ($request->filled('password')) {
                $flag = true;
                $request->merge(['password' => bcrypt($request->password)]);
            }

            if (!$flag)
                unset($request['password']);


            $admin->update($request->all());

                return redirect()->back()->with(['success' => __('admin\redirect.success')]);

        } catch (Exception $ex) {
            return redirect()->back()->with(['error' => __('admin\redirect.error')]);

        }
    }

}
