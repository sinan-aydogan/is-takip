<?php

namespace App\Http\Controllers;

use App\Models\TaskType;
use App\Http\Requests\StoreTaskTypeRequest;
use App\Http\Requests\UpdateTaskTypeRequest;

class TaskTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function show(TaskType $taskType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function edit(TaskType $taskType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskTypeRequest  $request
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskTypeRequest $request, TaskType $taskType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskType  $taskType
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskType $taskType)
    {
        //
    }
}
