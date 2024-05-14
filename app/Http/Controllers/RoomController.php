<?php

namespace App\Http\Controllers;

use App\RoomManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RoomController extends Controller
{
    public RoomManager $roomManager;

    public function __construct()
    {
        $this->roomManager = app(RoomManager::class);
    }

    public function index()
    {
        $rooms = $this->roomManager->getRooms();

        return Inertia::render('Rooms', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|alpha_dash:ascii',
            'hidden' => ['required', 'boolean'],
        ]);

        $room = $this->roomManager->createRoom($request->name, $request->hidden);

        return to_route('rooms.show', $room['name']);
    }

    public function show($name)
    {
        $room = $this->roomManager->getRoom($name);

        if (blank($room)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return Inertia::render('Chat', compact('room'));
    }
}