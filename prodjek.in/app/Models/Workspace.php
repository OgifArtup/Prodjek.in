<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\WorkspaceList;
use App\Models\Notification;

class Workspace extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'team_name',
        'project_detail',
    ];

    public function task(){
        return $this->hasMany(Task::class, 'id');
    }

    public function workspaceList(){
        return $this->hasMany(WorkspaceList::class, 'id');
    }
    
    public function notification(){
        return $this->hasMany(Notification::class, 'id');
    }
}
