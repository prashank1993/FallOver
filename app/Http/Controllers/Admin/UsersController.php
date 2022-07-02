<?php

namespace App\Http\Controllers\Admin;

use App\Countries;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\UserMeta;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        if (isset($request->social_link) && $request->social_link == 'social_link') {
            $user = User::where('id', $request->user_id)->first();
            if ($user) {
                $user_meta = [
                    'google'        => $request->google,
                    'facebook'      => $request->facebook,
                    'twitter'       => $request->twitter,
                    'instagram'     => $request->instagram,
                    'linkedin'      => $request->linkedin,
                ];
                $status = $this->updateUserMeta($request->user_id, 'socialLinks', json_encode($user_meta));
            }
        }
        if (isset($request->profile_details)) {
            $validated = $request->validate([
                'firstName' => 'required|max:255',
                'lastName' => 'required|max:255',
                'profile_photo' => 'mimes:jpg,png,jpeg',
            ]);

            $user_data = [
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'name' => $request->firstName . ' ' . $request->lastName,
                'email' => $request->email,
                'phone' => $request->phoneNumber,
            ];

            if (isset($request->password)) {
                $user_data['password'] = $request->password;
            }
            if (isset($request->language)) {
                $user_data['language'] = $request->language;
            }
            if (isset($request->timezone)) {
                $user_data['timezone'] = $request->timezone;
            }
            if (isset($request->currency)) {
                $user_data['currency'] = $request->currency;
            }

            $user = User::updateOrCreate([
                'id' => $request->user_id
            ], $user_data);

            $user->roles()->sync($request->input('roles', []));
            if ($request->file('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('userPhotos/' . $user->id), $filename);
                $user->profile_photo = $filename;
                $user->save();
            }

            $user_meta = [
                'organization'  => $request->organization,
                'country'       => $request->country,
                'state'         => $request->state,
                'zipCode'       => $request->zipCode,
                'city'          => $request->city,
                'address'       => $request->address,
            ];

            if (count($user_meta) > 0) {
                $this->updateUserAllMeta($user->id, $user_meta);
            }
        }

        $msg = 'Success';
        return redirect()->back()->with('msg', $msg);
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');

        $user->load('roles');

        return view('admin.users.edit', compact('roles', 'user'));
    }

    // public function update(UpdateUserRequest $request, User $user)
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        $msg = 'Success';
        return redirect()->back()->with('msg', $msg); //route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles');
        $user_meta = (object)$this->getUserMeta($user->id);
        $user->meta = $user_meta;
        $data['user'] = $user;
        $data['countries'] = $this->getCountry();
        $data['states'] = $this->getState($user_meta->country);

        return view('user-profile.index', $data);
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getStates(Request $request)
    {
        # code...
        $states = $this->getState($request->country_id);
        // dd($states);
        $html = '<option value="">Select</option>';
        foreach ($states as $key => $value) {
            # code...
            $html .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
        return response()->json(['status' => true, 'html' => $html]);
    }
}
