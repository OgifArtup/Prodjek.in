<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Workspace;
use App\Models\User;

class WorkspaceList extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'workSpaceID',
        'Role',
    ];

    public function workspace(){
        return $this->hasMany(Workspace::class, 'id', 'workSpaceID');
    }

    public function user(){
        return $this->belongsTo(User::class, 'userID');
    }
}
