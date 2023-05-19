<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignmentList;
use App\Models\Workspace;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'description',
        'workspace_id',
        'due_date',
        'priority',
        'status',
    ];

    public function assignment(){
        return $this->hasMany(AssignmentList::class, 'id');
    }

    public function workspace(){
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
