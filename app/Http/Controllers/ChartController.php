<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index() {

        $users = DB::table('useract')
        ->join('user', 'useract.id_user', '=', 'user.id')
        ->select('user.email', 'lastLogin', 'lastLogout')
        ->get();

        $ex_user   = [];
        $ex_time   = [];
        $ex_numb   = [];
        $ex_login  = [];
        $ex_logout = [];
        foreach($users as $k=>$v) {
            $diff  = date_diff(date_create($v->lastLogin), date_create($v->lastLogout));
            $time  = sprintf("%02d", $diff->h) .':'. sprintf("%02d", $diff->i) .':'. sprintf("%02d", $diff->s);
            $listr = strtotime($v->lastLogin);
            $lostr = strtotime($v->lastLogout);

            $ex_user  [$k] = $v->email;
            $ex_time  [$k] = $time;
            $ex_numb  [$k] = str_replace(':', '', $time);
            $ex_login [$k] = date('H:i:s', $listr);
            $ex_logout[$k] = date('H:i:s', $lostr);
        }

        return view('home')
        ->with('data', json_encode($ex_user, JSON_NUMERIC_CHECK))
        ->with('numb', json_encode($ex_numb, JSON_NUMERIC_CHECK))
        ->with('time', json_encode($ex_time, JSON_NUMERIC_CHECK))
        ->with('login', json_encode($ex_login, JSON_NUMERIC_CHECK))
        ->with('logout', json_encode($ex_logout, JSON_NUMERIC_CHECK));

    }
}
