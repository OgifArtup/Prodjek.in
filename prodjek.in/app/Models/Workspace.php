<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\WorkspaceList;

class Workspace extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];

    public function task(){
        return $this->hasMany(Task::class, 'id');
    }

    public function workspaceList(){
        return $this->hasMany(WorkspaceList::class, 'id');
    }
}
