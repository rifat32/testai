<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function userInfo(Request $request)
    {

        if (DB::table('user_infos')->where([
            'website' => $request->website,
            'ip' => $request->ip
        ])->exists()) {
            $data = DB::table('user_infos')->where([
                'website' => $request->website,
                'ip' => $request->ip
            ])->get();

            $visited = $data[0]->visited;

            DB::table('user_infos')->where([
                'website' => $request->website,
                'ip' => $request->ip
            ])->update([
                'visited' => $visited + 1
            ]);
        } else {
            DB::table('user_infos')->insert(
                [
                    'city' => $request->city,
                    'country' => $request->country,
                    'isp' => $request->isp,
                    'ip' => $request->ip,
                    'region' => $request->region,
                    'timezone' => $request->timezone,
                    'zip' => $request->zip,
                    'website' => $request->website,
                    "visited" => 1,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
        }
        return response()->json(["success" => 'success']);
    }
    public function getUserInfo()
    {
        $users =  DB::table('user_infos')->get();
        return response()->json($users);
    }
}
