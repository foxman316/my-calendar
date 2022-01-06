<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return response()->json(Calendar::all());
    }

    public function show(int $id)
    {
        return response()->json(Calendar::find($id));
    }


    public function create(Request $request)
    {
        $calendar = new Calendar();

        return $this->_saveCalendar($request, $calendar);
    }

    public function save(Request $request)
    {
        $calendar = Calendar::find($request->id);

        return $this->_saveCalendar($request, $calendar);
    }

    public function destroy(Request $request)
    {
        $calendar = Calendar::find($request->id);

        if ($calendar->delete()) {
            return response()->json($calendar);
        } else {
            return response()->json(['error', 'Delete Error']);
        }
    }

    private function _saveCalendar(Request $request, $calendar)
    {
        $calendar->name = $request->input('name');
        $calendar->color = $request->input('color');
        $calendar->visibility = $request->input('visibility');
        $calendar->user_id = $request->input('user_id');

        if ($calendar->save()) {
            return response()->json($calendar);
        } else {
            return response()->json(['error' => 'Save Error']);
        }
    }
}