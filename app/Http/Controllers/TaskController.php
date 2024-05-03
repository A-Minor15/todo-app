<?php

# Note: In our application, the Controller serves as the brain of
# the application. The logic of our application is located in the controller

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task; // inherit the Task.php model

class TaskController extends Controller
{
    private $task;

    # Constructor
    public function __construct(Task $task) {
        $this->task = $task;
    }

    #Read All / SELECT All Data
    public function index() {
        $all_tasks = $this->task->latest()->get(); // retrieve all data and sort it in descending order

        //go to index.blade.php with the data ($all_tasks)
        return view('tasks.index')->with('all_tasks', $all_tasks);
    }

    # Create/Store
    public function store(Request $request) {

        # 1. Validate the data first before inserting it to the database
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);

        // set the name table field to data coming from the form
        $this->task->name = $request->name;
        // insert the data into the table
        $this->task->save();
        #the same as: "INSERT INTO tasks(name) VALUES('$request->name')";

        return redirect()->back();
        #go back or redirect to homepage
    }

    # Select and Edit 1 record
    public function edit($id) {
        # Search for the task id ($id) of the task to be updated
        # Same as: "SELECT * FROM tasks WHERE id = '$id"
        $task = $this->task->findOrFail($id);

        # Go to the edit.blade.php with the data($task)
        return view('tasks.edit')->with('task', $task);
    }

    public function update(Request $request, $id) {
        $task = $this->task->findOrFail($id);
        $task->name = $request->name;
        $task->save();

        return redirect()->route('index');
    }

    public function destroy($id) {
        $this->task->destroy($id);

        return redirect()->back();

        /*
        destroy -- you have the primary key
        delete -- you have a where query / don't have the primary key

        DELETE FROM users WHERE name = 'John';
        $this->user->where('name', 'John')->delete();

        

        $this->task->findOrFail($id)->delete();
        return back();
        */
    }

    # Main/Parent blade template --> app.blade.php
    # Child Blade template --> index.blade.php

}
