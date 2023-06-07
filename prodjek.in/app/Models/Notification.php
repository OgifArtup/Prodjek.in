<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Workspace;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'workspace_id',
        'type',
        'detail',
        'status',
    ];

    public function workspace(){
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
