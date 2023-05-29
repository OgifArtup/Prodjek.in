<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WorkspaceRequest;
use App\Http\Requests\TaskRequest;
use App\Models\Workspace;
use App\Models\WorkspaceList;
use App\Models\Task;
use App\Models\AssignmentList;
use App\Models\User;

class WorkspaceController extends Controller
{
    public function viewHome(){
        return view('home');
    }

    public function viewProjects(){
        $projects = WorkspaceList::where('user_id', Auth::user()->id)->get();

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
            'user_id' => Auth::user()->id,
            'workspace_id' => $workspace->id,
            'role' => 'Manager',
        ]);

        return back();
    }

    public function viewDetails($id){
        $workspace = Workspace::find($id);
        $workspace_list = WorkspaceList::where('workspace_id', $id)->where('user_id', Auth::user()->id)->first();
        $members = WorkspaceList::where('workspace_id', $id)->get();

        if($workspace_list->user_id != Auth::user()->id){
            return redirect(route('viewProjects'));
        }

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

        return view('detail_prodjek', compact('workspace', 'workspace_list', 'members', 'tasks', 'assignedMember', 'nonAssignedMember'));
    }

    public function inviteMember(Request $request, $id){
        $memberId = User::where('username', $request->username)->value('id');
        $workspaceList = WorkspaceList::create([
            'user_id' => $memberId,
            'workspace_id' => $id,
            'role' => 'Member'
        ]);

        return back();
    }

    public function createTask(TaskRequest $request, $id){
        $task = Task::create([
            'workspace_id' => $id,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'priority' => $request->priority,
            'status' => 'Ongoing',
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

    public function checkTask($id){
        $task = Task::find($id);
        $task -> update([
            'status' => 'Done',
        ]);
        return back();
    }

    public function uncheckTask($id){
        $task = Task::find($id);
        $task -> update([
            'status' => 'Ongoing',
        ]);
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
