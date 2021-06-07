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
            $platform = $user[0]->platform;
            $visited = $user[0]->visited;
            if (str_contains($platform, $request->platform)) {
                DB::table('user_infos')->where([
                    'website' => $request->website,
                    'ip' => $request->ip
                ])->update([
                    'visited' => $visited + 1,
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
            } else {
                DB::table('user_infos')->where([
                    'website' => $request->website,
                    'ip' => $request->ip
                ])->update([
                    'visited' => $visited + 1,
                    'platform' => $platform . ' , ' . $request->platform,
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
            }


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
                    'platform' => $request->platform,
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
        $userRes = [];
        foreach ($users as $user) {
            $created_at = $user->created_at;
            $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created_at, 'Asia/Dhaka');
            $updated_at = $user->updated_at;
            $updated_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $updated_at, 'Asia/Dhaka');
            $user->created_at =  $created_at->setTimezone('UTC');
            $user->updated_at =  $updated_at->setTimezone('UTC');
            array_push($userRes, $user);
        }
        return response()->json($userRes);
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
        $messages =  DB::table('messages')->orderByDesc('id')->get();
        $messagesRes = [];
        foreach ($messages as $message) {
            $created_at = $message->created_at;
            $created_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $created_at, 'Asia/Dhaka');
            $updated_at = $message->updated_at;
            $updated_at = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $updated_at, 'Asia/Dhaka');
            $message->created_at =  $created_at->setTimezone('UTC');
            $message->updated_at =  $updated_at->setTimezone('UTC');
            array_push($messagesRes, $message);
        }
        return response()->json($messagesRes);
    }
    public function test(Request $request)
    {

        return response()->json([
            'number' => $request->number
        ]);
    }
    public function duplicate(Request $request)
    {

        $inputText = $request->text;
        $table = DB::table('duplicate_counts');
        $tableQuery = $table->where([
            'text' => $inputText
            ]);


        if($tableQuery->exists()){
            $text = $tableQuery->first();
            $tableQuery->update([
            'count' => $text->count + 1
            ]);
            return response()->json([
           'status' => 200,
           'count' =>$text->count + 1
                ]);


        }
        else {
            $table->insert([
                'text' => $inputText,
                'count' => 1
            ]);
            return response()->json([
                'status' => 201,
                'count' => 1
                     ]);
        }

    }
}
