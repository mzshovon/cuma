<?php

namespace App\Http\Services\Dashboard;

use App\Models\MembershipDetail;
use App\Models\User;

class DashboardService {

    private $valueListForTop = ["first_name", "nid"];

    public function getDashboardData()
    {
        $member = new User();
        return $member->getUsersList(10);
    }

    public function getMembersCount()
    {
        $member = new User();
        return $member->count();
    }

}
