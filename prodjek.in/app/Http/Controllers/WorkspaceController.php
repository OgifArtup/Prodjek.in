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
use Hash;

class WorkspaceController extends Controller
{
    public function viewHome(){
        if(Hash::check('123456dummy', Auth::user()->password, [])){
            return to_route("firstTimeLogin");
        }

        $projectAmount = WorkspaceList::where('user_id', Auth::user()->id)->count();
        $temp = AssignmentList::where('user_id', Auth::user()->id)->get();
        $undoneTask = 0;
        foreach($temp as $i){
            if($i->task->status == 'Ongoing'){
                $undoneTask += 1;
            }
        }

        $doneTask = 0;
        foreach($temp as $i){
            if($i->task->status == 'Done'){
                $doneTask += 1;
            }
        }

        return view('home', compact('projectAmount', 'undoneTask', 'doneTask'));
    }

    public function viewProfile(){
        $profile = User::find(Auth::user()->id);
        return view('view_profile', compact('profile'));
    }

    public function updateProfile(Request $request){
        $profile = User::find(Auth::user()->id);
        $profile -> update([
            'username' => $request->Username,
        ]);
        return redirect(route('viewProfile'));
    }

    public function updatePassword(Request $request){
        $profile = User::find(Auth::user()->id);
        $hashedPassword = User::find(Auth::user()->id)->password;
        if (Hash::check($request->lastPass, $hashedPassword)) {
            if(($request->newPass == $request->confPass && $request->newPass!=null)){
                $profile -> update([
                    'password' => bcrypt($request->newPass),
                ]);
            }
        }
        return redirect(route('viewProfile'));
    }

    public function viewProjects(){
        if(Hash::check('123456dummy', Auth::user()->password, [])){
            return to_route("firstTimeLogin");
        }
        $projects = WorkspaceList::where('user_id', Auth::user()->id)->get();
        $taskAmount = array();

        for ($i = 0; $i < count($projects); $i++) {
            $temp = Task::where('workspace_id', $projects[$i]->workspace_id)->count();
            array_push($taskAmount, $temp);
        }
        return view('projek_list', compact('projects', 'taskAmount'));
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
        if(Hash::check('123456dummy', Auth::user()->password, [])){
            return to_route("firstTimeLogin");
        }

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
        if(is_null($memberId))
        {
            return back();
        }
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
