<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\WorkspaceList;
use Illuminate\Support\Facades\Auth;


class NotificationController extends Controller
{
    public function createNotification($user_id, $workspace_id, $type, $detail, $status){
        Notification::create([
            'user_id' => $user_id,
            'workspace_id' => $workspace_id,
            'type' => $type,
            'detail' => $detail,
            'status' => $status,
        ]);
    }

    public function acceptInvitation($id){
        $invitation = Notification::find($id);
        $workspaceList = WorkspaceList::create([
            'user_id' => Auth::user()->id,
            'workspace_id' => $invitation->workspace_id,
            'role' => 'Member'
        ]);
        $this->deleteNotification($id);
        return back();
    }

    public function deleteNotification($id){
        $notification = Notification::find($id);
        Notification::where("id", $notification->id)->delete();
        Notification::destroy($id);
        return back();
    }

}
