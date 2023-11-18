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

    public function getUserInfoById($userId)
    {
        return $this->user->getSingleUserByParam("id", $userId) ?? null;
    }

    public function assignMemberShipId($id, $membership_id)
    {
        try {
            $update = $this->membershipDetail->updateMemberByParam("id", $id, ['membership_id' => $membership_id]);
            if($update) {
                return ["success", "Membership ID assigned successfully!"];
            }
        } catch (QueryException | Exception $e) {
            return ["error", "Something Went Wrong. Error: ".$e->getMessage()];
        }
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

    public function createMemberWithUserDetails($memberData, $userData)
    {
        try {
            $userData['password'] = bcrypt($userData['email']);
            // dd($userData);
            $createUser = $this->user->createUser($userData);
            if($createUser) {
                $userId = $createUser->id;
                $memberData['user_id'] = $userId;
                if($memberData['image_path']){
                    $dirName = storeOrUpdateImage("storage/img/profile/$userId/", $memberData['image_path'], 'profile');
                    $memberData['image_path'] = $dirName;
                } else {
                    unset($memberData['image_path']);
                }
                if($this->membershipDetail->createNewMember($memberData)) {
                    return ["success", "Member created successfully!"];
                }
            }

        } catch (QueryException | Exception $e) {
            return ["error", "Something Went Wrong. Error: ".$e->getMessage()];
        }
    }

    public function updateUserInfoById(int $userId, $memberData, $userData)
    {
        try {
            if($memberData['image_path']){
                $dirName = storeOrUpdateImage("storage/img/profile/$userId/", $memberData['image_path'], 'profile');
                $memberData['image_path'] = $dirName;
            } else {
                unset($memberData['image_path']);
            }
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
