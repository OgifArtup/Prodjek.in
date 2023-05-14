<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\WorkspaceList;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'ListID',
        'Name',
    ];

    public function task(){
        return $this->hasMany(Task::class, 'id');
    }

    public function workspaceList(){
        return $this->belongsTo(WorkspaceList::class, 'ListID');
    }
}
