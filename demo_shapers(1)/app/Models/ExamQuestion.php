<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    use HasFactory;
    
    public function getExamSetName()
    {
        return $this->belongsTo(ExamSet::class,'exam_set','id');

    }

    public function getCategoryName()
    {
        return $this->belongsTo(FormCategory::class,'category','id');
    }
}
