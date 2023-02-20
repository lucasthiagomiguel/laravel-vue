<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{

    public function __construct(Task $task)
    {
        $this->task = $task;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = $this->task->all();
        return  response()->json($task,200); 
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
       
        $request->validate($this->task->rules(),$this->task->feedback());
        $task = $this->task->create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'date_conclusion' => $request->date_conclusion,
            'status' => $request->status
        ]);
        return response()->json($task,201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->task->find($id);
        if($task === null){
            return response()->json(['error' => 'Not exist'],404); 
            
        }
        return response()->json($task,200); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $id)
    {
        $task = $this->task->find($id);
        if($task === null){
            return response()->json(['error' => 'Task not exist'],404);
        }
        if($request->method() === 'PATCH'){
            $ruleDinamic = array();

            //testing all rules of model task
            foreach($task->rules() as $input => $rules){
                $ruleDinamic[$input] = $rules;
            }

            $request->validate($ruleDinamic,$this->task->feedback());
        }else{
            $request->validate($this->task->rules(),$this->task->feedback());
        }
        $task->update($request->all());
        return response()->json($task,200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}

