<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = ['title', 'status', 'description', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function task() {
        return $this->hasMany(Task::class);
    }

    public static function get_status($status) {
        if ($status = 0) {
            return 'cancel';
        } elseif ($status = 2) {
            return 'done';
        } elseif ($status = 1) {
            return 'new';
        }
    }
}
