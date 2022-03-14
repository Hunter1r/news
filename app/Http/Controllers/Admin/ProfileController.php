<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Profiles\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * @param Request $request
     */
    public function update(Request $request) {

        $user = Auth::user();

        if($request->isMethod('post')) {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email:rfc,dns', 'unique:users,email,' . Auth::id()],
                'password' => ['required'],
                'password_confirmation' => ['required', 'min:8'],
            ]);
            if(Hash::check($request->post('password'), $user->password)) {
                $user->fill([
                    'name' => $request->post('name'),
                    'password' => Hash::make($request->post('password_confirmation')),
                    'email' => $request->post('email'),
                ]);
                $user->save();
                return redirect()->route('admin.updateProfile')->with('success', 'Profile is up to date');
            };
            return back()->with('error', 'Profile isn\'t update')
            ->withInput();
        }
        return view('admin.profile.update', ['user' => $user]);

    }
}
