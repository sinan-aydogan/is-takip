<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'task_id',
        'task_type_id',
        'planned_date',
        'deadline_date',
        'production_target',
        'status_id'
    ];
}
