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
        $list = WorkspaceList::where('user_id', '1')->where('workspace_id', $id)->get();
        // if($list->user_id != Auth::user()->id){
        //     return redirect(route('projek_list'));
        // }
        if(is_null($workspace) or is_null($list)) return back();
        return view('detail_prodjek', compact('workspace', 'list'));
    }
}
