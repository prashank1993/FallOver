<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Packages;
use App\Role;
use App\User;
use Hash;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\UserPortfolio;
use Illuminate\Support\Facades\Storage;

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

        $data['roles'] = Role::all()->pluck('title', 'id');
        $data['countries'] = $this->getCountry();
        $data['states'] = $this->getState();
        return view('admin.users.create', $data);
    }

    public function store(Request $request)
    {
        if (isset($request->social_link) && $request->social_link == 'social_link') {
            $validated = $request->validate([
                'user_id' => 'required',
            ]);
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
                'full_name' => 'required|max:255',
                // 'lastName' => 'required|max:255',
                'profile_photo' => 'mimes:jpg,png,jpeg',
            ]);

            $user_data = [
                'full_name' => $request->full_name,
                // 'last_name' => $request->lastName,
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
                $file->move('userPhotos/' . $user->id, $filename);
                $user->profile_photo = 'userPhotos/'  . $user->id . '/' . $filename;
                $user->save();
            }

            $user_meta = [
                'organization'  => ($request->organization) ?? '',
                'country'       => ($request->country) ?? '',
                'state'         => ($request->state) ?? '',
                'zipCode'       => ($request->zipCode) ?? '',
                'city'          => ($request->city) ?? '',
                'address'       => ($request->address) ?? '',
                'brief_desc'       => ($request->brief_desc) ?? '',
                'whatsapp'       => ($request->whatsapp) ?? '',
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
        $user->load('portfolio');
        $user->load('packages');
        $user_meta = (object)$this->getUserMeta($user->id);
        $user->meta = $user_meta;
        $data['user'] = $user;
        $data['countries'] = $this->getCountry();
        $data['states'] = $this->getState($user_meta->country);
        $data['roles'] = Role::all()->pluck('title', 'id');

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
        $html = '<option value="">Select</option>';
        foreach ($states as $key => $value) {
            # code...
            $html .= '<option value="' . $value['id'] . '">' . $value['name'] . '</option>';
        }
        return response()->json(['status' => true, 'html' => $html]);
    }

    // Add or Edit User Portfolio
    public function addPortfolio(Request $request)
    {
        # code...
        $data = [
            'user_id' => $request->user_id,
            'type' => $request->filetype,
            'status' => $request->status,
            'title' => $request->title,
            'tags' => $request->tags,
        ];

        if ($request->filetype == 'image') {
            if ($request->file('portfolioImage')) {
                $file = $request->file('portfolioImage');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move('portfolio/' . $request->user_id . '/images', $filename);
                $data['url'] = 'portfolio/' . $request->user_id . '/images/' . $filename;
            }
        }

        if ($request->filetype == 'video') {
            if ($request->videotype == 'manual') {
                if ($request->file('video_File')) {
                    $file = $request->file('video_File');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move('portfolio/' . $request->user_id . '/videos', $filename);
                    $data['url'] = 'portfolio/' . $request->user_id . '/videos/' . $filename;
                }
            } else {
                if (isset($request->video_link)) {
                    $data['url'] = $request->video_link;
                }
            }
            $data['video_type'] = $request->videotype;
        }

        UserPortfolio::updateOrCreate(['id' => $request->portfolio_id], $data);
        return back();
    }


    // All Influencer
    public function allInfluencer()
    {
        # code...
        $users = Role::where('title', 'Influencer')->first()->users()->get();
        return view('admin.users.index', compact('users'));
    }

    // Packages
    public function addPackage(Request $request)
    {
        # code...
        $data = [
            'user_id'       => $request->user_id,
            'name'          => $request->package_name,
            'status'        => $request->status,
            'description'   => $request->package_desc,
            'cost'          => $request->package_cost,
            'type'          => $request->package_type,
            'time'          => $request->time_duration_time . ' ' . $request->time_duration,
            'image'         => ''
        ];

        if ($request->file('package_image')) {
            $file = $request->file('package_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move('packages/' . $request->user_id, $filename);
            $data['image'] = 'packages/' . $request->user_id . '/' . $filename;
        }


        Packages::updateOrCreate(['id' => $request->package_id], $data);
        return back();
    }


    public function getPortfolioDetails(Request $request)
    {
        # code...
        $data = UserPortfolio::where('id', $request->portfolio_id)->first();
        return response()->json(['status' => ($data) ? true : false, 'data' => $data]);
    }

    public function deletePortfolio(Request $request)
    {
        # code...
        UserPortfolio::where('id', $request->portfolio_id)->delete();
        return response()->json(['status' => true]);
    }
    // All Influencer
    public function allBrand()
    {
        # code...

        $users = Role::where('title', 'Brand')->first()->users()->get();
        return view('admin.users.brand.index', compact('users'));
    }
    public function brandusercreate()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data['roles'] = Role::all()->pluck('title', 'id');
        return view('admin.users.brand.create', $data);
    }
    public function brandusersave(Request $request)
    {

        $user = [
            'full_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->number,
            'password' => Hash::make($request->password),
        ];
        $user = User::Create($user);
        $user->roles()->sync($request->input('roles', []));
        return back();
    }
    public function brandedit(User $user)
    {
        dd('adf');
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $roles = Role::all()->pluck('title', 'id');
        $user->load('roles');
        return view('admin.users.brand.create', compact('roles', 'user'));
    }

    public function showBrandUser(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user->load('roles');
        $user->load('portfolio');
        $user->load('packages');
        // $user_meta = (object)$this->getUserMeta($user->id);
        // $user->meta = $user_meta;
        $data['user'] = $user;
        // $data['countries'] = $this->getCountry();
        // $data['states'] = $this->getState($user_meta->country);
        $data['roles'] = Role::all()->pluck('title', 'id');

        return view('user-profile.index', $data);
    }
}
