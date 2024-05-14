<?php

namespace App\Http\Controllers;

use App\CustomAuth;
use App\Events\SendingMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __invoke(Request $request)
    {
        /** @var CustomAuth $user */
        $user = Auth::guard('no-auth')->user();

        $data = $request->validate([
            'message' => 'required|min:1|max:200',
            'room' => 'required|min:1|max:200',
        ]);

        SendingMessage::dispatch(
            $data['room'],
            $data['message'],
            $user->getData()
        );

        return response()->json(['status' => 'OK']);
    }
}
