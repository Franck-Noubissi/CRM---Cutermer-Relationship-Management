<?php

use App\Http\Resources\UpcomingResource;
use App\Models\Today;
use App\Models\Upcoming;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//** Upcoming Task */
// Get the upcoming tasks
Route::get('/upcoming', function () {
    $upcoming = Upcoming::all();

    return UpcomingResource::collection($upcoming);
});

// Add new task
Route::post('/upcoming', function (Request $request) {
    return Upcoming::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'waiting' => $request->waiting
    ]);
});

// Delete upcoming task
Route::delete('/upcoming/{taskId}', function ($taskId) {
    DB::table('upcomings')->where('taskId', $taskId)->delete();

    return 204;
});


//** Today's Task */
//Add new task
Route::post('/dailytask', function (Request $request) {
    return Today::create([
        'id' => $request->id,
        'title' => $request->title,
        'taskId' => $request->taskId
    ]);
});

// Delete today's task
Route::delete('/dailytask/{taskId}', function ($taskId) {
    DB::table('todays')->where('taskId', $taskId)->delete();

    return 204;
});