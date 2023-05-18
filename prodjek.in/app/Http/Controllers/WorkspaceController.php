<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Workspace;
use App\Models\WorkspaceList;
use App\Models\Task;
use App\Models\AssignmentList;
use App\Models\User;

class WorkspaceController extends Controller
{
    public function viewProjects(){
        // isi user_id ganti sama Auth::user()->id,
        $projects = WorkspaceList::where('user_id', '1')->get();

        return view('projek_list', compact('projects'));
    }

    public function createProject(WorkspaceRequest $request){
        $workspace = Workspace::create([
            'name' => $request->name,
            'team_name' => $request->team_name,
            'project_detail' => $request->project_detail,
        ]);

        WorkspaceList::create([
            // isi user_id ganti sama Auth::user()->id,
            'user_id' => '1',
            'workspace_id' => $workspace->id,
            'role' => 'Manager',
        ]);

        return back();
    }

    public function viewDetails($id){
        $workspace = Workspace::find($id);
        // Ganti '1' sama Auth::user()->id
        $workspace_list = WorkspaceList::where('workspace_id', $id)->where('user_id', '1')->first();
        $members = WorkspaceList::where('workspace_id', $id)->get();

        // if($list->user_id != Auth::user()->id){
        //     return redirect(route('projek_list'));
        // }
        
        $tasks = Task::where('workspace_id', $id)->get();
        $assignedMember = array();
        $nonAssignedMember = array();
        for ($i = 0; $i < count($tasks); $i++) {
            $temp = AssignmentList::where('task_id', $tasks[$i]->id)->get();
            $temp_array = array();
            foreach ($temp as $x){
                array_push($temp_array, $x->user);
            }
            array_push($assignedMember, $temp_array);

            $temp_array = array();
            foreach ($members as $y){
                if(is_null(AssignmentList::where('user_id', $y->user->id)->where('task_id', $tasks[$i]->id)->first())){
                    array_push($temp_array, $y->user);
                }
            }
            array_push($nonAssignedMember, $temp_array);
        }

        // dd($nonAssignedMember);
        return view('detail_prodjek', compact('workspace', 'workspace_list', 'members', 'tasks', 'assignedMember', 'nonAssignedMember'));
    }

    public function createTask(TaskRequest $request, $id){
        $task = Task::create([
            'workspace_id' => $id,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'priority' => $request->priority,
        ]);

        foreach ($request->assign as $x) {
            AssignmentList::create([
                'user_id' => $x,
                'task_id' => $task->id,
            ]);
        }

        return back();
    }

    public function deleteTask($id){
        $task = Task::find($id);
        Task::where("id", $task->id)->delete();
        Task::destroy($id);
        return back();
    }

    public function addAssignedMembers(Request $request, $id){
        foreach ($request->assign as $x) {
            AssignmentList::create([
                'user_id' => $x,
                'task_id' => $id,
            ]);
            
        }
        
        return back();
    }

    public function deleteAssignedMember(Request $request){
        $assign = AssignmentList::where("user_id", $request->user_id)->where("task_id", $request->task_id)->first();
        AssignmentList::where("id", $assign->id)->delete();
        AssignmentList::destroy($assign->id);
        return back();
    }
}
