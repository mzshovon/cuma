<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateUserRequest;
use App\Http\Requests\admin\UpdateUserRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Services\User\UserService;
use App\Models\Role;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getUsers(UserService $userService){
        try {
            $data['users'] = $userService->getUsersInfo();
            // dd($data['users']);
            $data['title'] = "Members List";
            $data['roles'] = Role::all();
            return view('admin.user.index', $data);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function createUser(CreateUserRequest $request){
        try {
            $name = $request->name ?? null;
            $email = $request->email ?? null;
            $status = $request->status ?? null;
            [$statusName, $message] = $this->repo->storeUserInfo($name, $email, $status);
            return redirect()->route('admin.usersList')->with($statusName, $message);

        } catch (\Throwable $th) {
            return $th;
        }
    }

    public function updateUser(UpdateUserRequest $request, $userId){
        try {
            $name = $request->name ?? null;
            $email = $request->email ?? null;
            $status = $request->status ?? null;
            [$statusName, $message] = $this->repo->updateUserInfoById($userId, $name, $email, $status);
            return redirect()->route('admin.usersList')->with($statusName, $message);

        } catch (\Throwable $th) {
            return back()->with(500, $th->getMessage());
        }
    }

    public function deleteUser($userId){
        try {
            $data = [];
            [$data['statusName'], $data['message']] = $this->repo->deleteUserById($userId);
            return $this->success($data);

        } catch (\Exception $e) {
            return $this->error("Something went wrong with error ".$e, null, $e->getCode());
        }
    }

    public function assignRoleToUser(Request $request) {
        if(DB::table('model_has_roles')->where('model_id',$request->user_id)->first()) {
            DB::table('model_has_roles')->where('model_id',$request->user_id)->update(['role_id'=>$request->role_id]);
        } else {
            $user = User::find($request->user_id);
            $user->assignRole([$request->role_id]);
        }
        return back()->with('success', 'Role assigned successfully.');
    }

    public function profile()
    {
        $data['title'] = "User Profile";
        return view("admin.profile.index", $data);
    }

    public function profileUpdate(ProfileUpdateRequest $request, UserService $userService)
    {
        $userId= $request->id;
        $memberData['first_name'] = $request->first_name;
        $memberData['last_name'] = $request->last_name;
        $userData['name'] = $request->first_name . " " . $request->last_name;
        $userData['email'] = $request->email;
        $userData['contact'] = $request->contact;
        $memberData['nid'] = $request->nid;
        $memberData['dob'] = $request->dob;
        $memberData['address'] = $request->address;
        $memberData['blood_group'] = $request->blood_group;
        $memberData['batch'] = $request->batch;
        $memberData['payment'] = $request->payment;
        $memberData['employeer_name'] = $request->employeer_name;
        $memberData['designation'] = $request->designation;
        $memberData['employeer_address'] = $request->employeer_address;
        $memberData['reference'] = $request->reference;
        $memberData['reference_number'] = $request->reference_number;
        $memberData['image_path'] = $request->profile_image ?? null;
        [$message, $status] = $userService->updateUserInfoById($userId, $memberData, $userData);
        Session::put($message, $status);
        return redirect("/admin/user-profile");
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect('/login');
    }
}
