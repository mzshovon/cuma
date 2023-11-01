<?php

namespace App\Http\Services\Dashboard;

use App\Models\MembershipDetail;

class DashboardService {

    private $valueListForTop = ["first_name", "nid", ];

    public function getDashboardData()
    {
        $member = new MembershipDetail();
        return $member->getMemberList();
    }

}
