<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return response()->json(Event::all());
    }

    public function show(int $id)
    {
        return response()->json(Event::find($id));
    }

    public function create(Request $request)
    {
        $event = new Event();

        return $this->_saveEvent($request, $event);
    }

    public function save(Request $request)
    {
        $event = Event::find($request->id);

        return $this->_saveEvent($request, $event);
    }

    public function destroy(Request $request)
    {
        $event = Event::find($request->id);

        if ($event->delete()) {
            return response()->json($event);
        } else {
            return response()->json(['error', 'Delete Error']);
        }
    }


    public function _saveEvent(Request $request, $event)
    {
        $event->name = $request->input('name');
        $event->start = new Carbon($request->input('start')); // JSからのデータを日時形式に変換
        $event->end = new Carbon($request->input('end')); // JSからのデータを日時形式に変換
        $event->timed = $request->input('timed');
        $event->calendar_id = $request->input('calendar_id');
        $event->description = $request->input('description');
        $event->color = $request->input('color');

        if ($event->save()) {
            return response()->json($event);
        } else {
            return response()->json(['error' => 'Save Error']);
        }
    }
}