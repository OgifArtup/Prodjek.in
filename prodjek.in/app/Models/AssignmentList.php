<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class AssignmentList extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_id',
    ];

    public function task(){
        return $this->belongsTo(Task::class, 'task_id');
    }
}