<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;
    public $timestamps = false;
    public function getQuestion() {
        return $this->belongsTo(ExamQuestion::class, 'question_id', 'id');
    }
}
