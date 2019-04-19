<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Model\Task;

class ToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ['code' => 0, 'message' => '', 'data' => Task::all()];

        return response()->json($response);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = ['code' => 0, 'message' => '', 'data' => array()];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'string',
            'done_at' => 'date', 
        ]);

        if ($validator->passes()) {
            $task = new Task();
            $task->title = $request->input('title');
            $task->content = $request->input('content');
            if ($request->input('attachment')) {
                $task->attachment = $request->input('attachment');
            }

            if ($request->input('done_at')) {
                $task->done_at = $request->input('done_at');
            }

            $task->save();
            $response['code'] = 0;
        } else {
            $response['code'] = -1;
            $response['message'] = 'error input';
        }
        
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = ['code' => 0, 'message' => '', 'data' => array()];

        $task = Task::find($id);
        if ($task !== null) {
            $response['data'] = $task;
        } else {
            $response['code'] = -1;
            $response['message'] = 'resource not found';
        }
        

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $response = ['code' => 0, 'message' => '', 'data' => array()];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'attachment' => 'string',
            'done_at' => 'date',
        ]);

        $task = Task::find($id);
        if ($task === null) {
            $response['code'] = -1;
            $response['message'] = 'resource not found';

            return response()->json($response);
        } 

        if ($validator) {
            $task->title = $request->input('title');
            $task->content = $request->input('content');
            
            if ($request->input('attachment')) {
                $task->attachment = $request->input('attachment');
            }

            if ($request->input('done_at')) {
                $task->done_at = $request->input('done_at');
            }

            $task->save();
            $response['code'] = 0;
        } else {
            $response['code'] = -1;
            $response['message'] = 'error input';
        }
        
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['code' => 0, 'message' => '', 'data' => array()];

        $task = Task::find($id);

        if ($task === null) {
            $response['code'] = -1;
            $response['message'] = 'resource not found';

            return response()->json($response);
        } 

        $task->delete();
        if ($task->first()) {   //確認是否刪除成功
            $response['message'] = 'delete success';
        } else {
            $response['code'] = -1;
            $response['message'] = 'delete fail';
        }
         
        return response()->json($response);
    }


    public function destroyAll() {
        $response = ['code' => 0, 'message' => '', 'data' => array()];
        
        Task::where('deleted_at', '=', null)->delete();

        return response()->json($response);
    }
}
