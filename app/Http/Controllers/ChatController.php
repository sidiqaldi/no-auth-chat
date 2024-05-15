<?php

namespace App\Http\Controllers;

use App\CustomAuth;
use App\Events\SendingMessage;
use App\RoomManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        /** @var CustomAuth $user */
        $user = Auth::guard('no-auth')->user();

        $data = $request->validate([
            'message' => 'required|min:1|max:200',
            'room' => 'required|min:1|max:200',
        ]);

        $manager = new RoomManager();

        $room = $manager->getRoom($data['room']);

        if (blank($room)) {
            return response()->json(['error' => 'expired'], Response::HTTP_NOT_FOUND);
        }

        SendingMessage::dispatch(
            $data['room'],
            $data['message'],
            $user->getData()
        );

        return response()->json(['status' => 'OK']);
    }
}
