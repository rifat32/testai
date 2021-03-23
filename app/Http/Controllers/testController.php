<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class testController extends Controller
{
    public function userInfo(Request $request)
    {

        $user = DB::table('user_infos')->where([
            'website' => $request->website,
            'ip' => $request->ip
        ])->get();

        if (count($user)) {
            $visited = $user[0]->visited;
            DB::table('user_infos')->where([
                'website' => $request->website,
                'ip' => $request->ip
            ])->update([
                'visited' => $visited + 1
            ]);
            return response()->json(["success" => $user[0]]);
        } else {

            $id =   DB::table('user_infos')->insertGetId(
                [
                    'ip' => $request->ip,
                    'continent_name' => $request->continent_name,
                    'calling_code' => $request->calling_code,
                    'city' => $request->city,
                    'country_name' => $request->country_name,
                    'district' => $request->district,
                    'zipcode' => $request->zipcode,
                    'isp' => $request->isp,
                    'website' => $request->website,
                    "visited" => 1,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]
            );
            $user =  DB::table('user_infos')->where([
                'id' => $id
            ])->get();
            return response()->json(["success" => $user[0]]);
        }
    }
    public function getUserInfo()
    {
        $users =  DB::table('user_infos')->orderByDesc('id')->get();
        return response()->json($users);
    }
    public function userMessage(Request $request)
    {

        DB::table('messages')->insert(
            [
                'name' => $request->name,
                'email' => $request->email,
                'message' => $request->message,
                'visitorId' => $request->visitorId,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
        return response()->json([
            'success' => true
        ]);
    }
    public function getUserMessage()
    {
        $messages =  DB::table('messages')->orderBy('id')->get();
        return response()->json($messages);
    }
}
