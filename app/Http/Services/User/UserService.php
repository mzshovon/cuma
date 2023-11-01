<?php

namespace App\Http\Services\User;

use App\Events\ActivityLogEvent;
use App\Http\Enums\ModuleEnum;
use App\Models\MembershipDetail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserService {

    public function __construct(private User $user, private MembershipDetail $membershipDetail){}

    public function getUsersInfo()
    {
        return $this->user->getUsersList() ?? [];
    }

    public function getUserInfoById()
    {

    }

    public function storeUserInfo($name, $email, $status)
    {
        try {
            $formatForStoreUser = [
                "name" => $name,
                "email" => $email,
                "password" => \bcrypt($email),
                "status" => $status,
            ];

            if ($this->user::create($formatForStoreUser)) {
                return ["success", "User Created Sucessfully!"];
            }

        } catch (QueryException | Exception $e) {
            return ["error", "Something Went Wrong. Error: ".$e->getMessage()];
        }
    }

    public function updateUserInfoById(int $userId, $memberData, $userData)
    {
        try {
            if ($this->user::updateUserByParam("id", $userId, $userData)) {
                if ($this->membershipDetail::updateMemberByParam("user_id", $userId, $memberData)) {
                    return ["success", "Profile Info Updated Sucessfully!"];
                }
            }

        } catch (QueryException | Exception $e) {
            return ["error", "Something Went Wrong. Error: ".$e->getMessage()];
        }
    }

    public function deleteUserById(int $userId)
    {
        try {
            $deleteUserParam = 'id';
            $userInfo = $this->user::getSingleUserByParam($deleteUserParam, $userId);
            if($this->user::deleteUserByParam($deleteUserParam, $userId)) {
                event(new ActivityLogEvent(ModuleEnum::UserDelete->value, "Delete user by $userId with param $deleteUserParam", "User named $userInfo->name deleted", "user-delete"));
                return ["success", "User Deleted Sucessfully!"];
            }

        } catch (QueryException | Exception $e) {
            return ["error", "Something Went Wrong. Error: ".$e->getMessage()];
        }
    }

}
