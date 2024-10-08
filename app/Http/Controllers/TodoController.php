<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function list(Request $request){
        $result = Todo::all();
        return response()->json([
        'data' => $result,
        'status' => true,
        'status_code' => 200]);
    }

    public function store(Request $request){
        $result = Todo::create([
            'name' => $request->name,
        ]);

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 201,
                'mesage' => 'Data Saved!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'status_code' => 500,
        'mesage' => 'Data Save Failed !'],500);
    }

    public function delete(Request $request){
        $result = Todo::find($request->id)->delete();

        if($result){
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'mesage' => 'Data Deleted!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'status_code' => 500,
        'mesage' => 'Data Failed to Delete !'],500);
    }

    public function items($todo){
        $result = TodoItem::where('todo_id',$todo)->get();

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 200,
                'mesage' => ''
            ],201);
        }
        
    }
    public function itemsStore(Request $request,$todo){
        $result = TodoItem::create([
            'todo_id' => $todo,
            'item' => $request->itemName,
        ]);

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 201,
                'mesage' => 'Data Saved!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'status_code' => 500,]);
    }

    public function itemGet($todo,$item){
        $result = TodoItem::where('todo_id',$todo)->where('id',$item)->first();

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 200,
            ],201);
        }
        return response()->json([
            'status' => false,
            'status_code' => 404,
            'message' => 'Data Not Found!'
        ]);
    }

    public function itemStatus(Request $request,$todo,$item){
        $result = TodoItem::where('todo_id',$todo)->where('id',$item)->first();
        $result->status = $request->status;
        $result->save();

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 200,
            ],201);
        }
        return response()->json([
            'status' => false,
            'status_code' => 404,
            'message' => 'Data Not Found!'
        ]);
    }

    public function itemRename(Request $request,$todo,$item){
        $result = TodoItem::where('todo_id',$todo)->where('id',$item)->first();
        $result->item = $request->itemName;
        $result->save();

        if($result){
            return response()->json([
                'data' => $result,
                'status' => true,
                'status_code' => 200,
                'mesage' => 'Data Saved!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'message' => 'Data Not Found!',
        'status_code' => 404,]);
    }

    public function itemDelete($todo,$item){
        $result = TodoItem::where('todo_id',$todo)->where('id',$item)->delete();

        if($result){
            return response()->json([
                'status' => true,
                'status_code' => 200,
                'mesage' => 'Data Deleted!'
            ],201);
        }
        return response()->json([
        'status' => false,
        'message' => 'Data Not Found!',
        'status_code' => 500,]);
    }
      
}