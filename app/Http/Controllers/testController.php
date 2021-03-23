<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class testController extends Controller
{
    public function userInfo(Request $request)
    {

        // if (DB::table('user_infos')->where([
        //     'website' => $request->website,
        //     'ip' => $request->ip
        // ])->exists()) {
        //     $data = DB::table('user_infos')->where([
        //         'website' => $request->website,
        //         'ip' => $request->ip
        //     ])->get();

        //     $visited = $data[0]->visited;

        //     DB::table('user_infos')->where([
        //         'website' => $request->website,
        //         'ip' => $request->ip
        //     ])->update([
        //         'visited' => $visited + 1
        //     ]);
        // } else {
        //     DB::table('user_infos')->insert(
        //         [
        //             'ip' => $request->ip,
        //             'continent_name' => $request->continent_name,
        //             'calling_code' => $request->calling_code,
        //             'city' => $request->city,
        //             'country_name' => $request->country_name,
        //             'district' => $request->district,
        //             'zipcode' => $request->zipcode,
        //             'isp' => $request->isp,
        //             'website' => $request->website,
        //             "visited" => 1,
        //             "created_at" =>  \Carbon\Carbon::now(),
        //             "updated_at" => \Carbon\Carbon::now(),
        //         ]
        //     );
        // }
        $locationData = Location::get();;
        return response()->json(["success" => $locationData]);
    }
    public function getUserInfo()
    {
        $users =  DB::table('user_infos')->get();
        return response()->json($users);
    }
}
