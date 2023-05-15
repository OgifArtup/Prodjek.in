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
        ]);

        WorkspaceList::create([
            // isi user_id ganti sama Auth::user()->id,
            'user_id' => '1',
            'workspace_id' => $workspace->id,
            'role' => 'Manager',
        ]);

        return back();
    }
}
