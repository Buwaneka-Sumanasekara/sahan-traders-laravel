<?php

namespace App\Http\Traits;

use App;
use App\Models\UmUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{


    public function getNextUserId()
    {
        $next_id =  UmUser::max("id") + 1;
        return $next_id;
    }

    public function user_role_getUserRolePermissions($user_role)
    {
        $permissions = DB::select("select per.id from sm_permissions per inner join um_user_role_has_sm_permissions ur_per on per.id=ur_per.sm_permissions_id
        where ur_per.um_user_role_id='" . $user_role . "'  order by `order_no` asc ");
        return $permissions;
    }
    public function user_role_getUserRolePermissions_menus($user_role)
    {
        $permissions = DB::select("select per.id from sm_permissions per inner join um_user_role_has_sm_permissions ur_per on per.id=ur_per.sm_permissions_id
        where ur_per.um_user_role_id='" . $user_role . "' and per.is_display_menu=1  order by `order_no` asc ");
        return $permissions;
    }

    public function user_role_isPermissionAvailable($permissions, $perid)
    {
        $isAvilable = false;
        foreach ($permissions as $key => $value) {
            if ($value->id == $perid) {
                $isAvilable = true;
                break;
            }
        }
        return $isAvilable;
    }
}
