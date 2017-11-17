<?php

namespace App\Http\Controllers;

use App\Entity\User;
use App\Services\TelegramService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getUsers()
    {
        $users = User::where('subscribe',true)->get();
        return response()->json($users);
    }

    /**
     * @param Request $request
     */
    public function send(Request $request)
    {
        $status = true;
        $text = $request->input('text');
        $users_selected = $request->input('users_selected');

        if($text && count($users_selected)){
            foreach ($users_selected as $user) {
                try{
                    $user = User::find($user['id']);

                    if($user && $user->subscribe){
                        TelegramService::sendMessage($text,$user['id']);
                    }
                }catch (\Exception $exception) {
                    $status = false;
                }
            }
        }

        return response()->json($status);
    }

    /**
     * @param Request $request
     */
    public function delete(Request $request)
    {
        $ids = [];

        $users_selected = $request->input('users_selected');

        if(count($users_selected)){
            foreach ($users_selected as $item) {
                try {
                    $user = User::find($item['id']);

                    if($user){
                        $user->delete();
                        $ids[] = $item['id'];
                    }
                }catch (\Exception $exception) {

                }

            }
            return response()->json($ids);
        }
    }

}
