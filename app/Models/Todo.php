<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'is_completed', 'due_date', 'priority'];

    public function scopeFilter($query, array $filters)
    {
            if ($filters['priority']?? false)
            {
                $query->where('priority' , 'like' , '%' . request('priority') . '%');
            }
            if ($filters['is_completed']?? false)
            {
                $query->where('is_completed' , 'like' , '%' . request('is_completed') . '%');
            }
    }


}


