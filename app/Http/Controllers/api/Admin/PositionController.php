<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\position\PositionStoreRequest;
use App\Models\Position;

class PositionController extends Controller
{
    public function index(Request $request){
        $name = $request->query('name');
        $positions = Position::select('id','full_name as label')
        ->where('full_name', 'LIKE', "%{$name}%")
        ->orWhere('id', 'LIKE', "%{$name}%")
        ->orWhere('category','LIKE',"%{$name}%")->get();
        return response()->json($positions);
    }

    public function store(PositionStoreRequest $request){
        $position = Position::create($request->validated());
        return response()->json($position);
    }
}
