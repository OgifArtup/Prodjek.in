<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WorkspaceRequest;
use App\Models\Workspace;
use App\Models\WorkspaceList;

class WorkspaceController extends Controller
{
    public function viewProjects(){
        // isi user_id ganti sama Auth::user()->id,
        $projects = WorkspaceList::where('user_id', '1')->get();

        // $members = array();
        // for ($y = 0; $y < count($projects); $y++) {
        //     $list = WorkspaceList::where('workspace_id', )->get();        
        //     for ($x = 0; $x < count($list); $x++) {
        //         array_push($members, $list[$x]->user->name);
        //     }
        // }

        // $members = WorkspaceList::where('workspace_id', '1')->get();

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
        // if($list->user_id != Auth::user()->id){
        //     return redirect(route('projek_list'));
        // }
        
        $members = WorkspaceList::where('workspace_id', $id)->get();
        return view('detail_prodjek', compact('workspace', 'workspace_list', 'members'));
    }

    public function createTask(){
        
    }
}
