<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['title', 'description', 'todo_id'];

    public function todo() {
        return $this->belongsTo(Todo::class);
    }
}
