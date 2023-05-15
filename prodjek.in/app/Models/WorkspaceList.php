<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workspace;
use App\Models\User;

class WorkspaceList extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'workspace_id',
        'role',
    ];

    public function workspace(){
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
