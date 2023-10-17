<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function deadline()
    {
        return $this->belongsTo(DeadLine::class,'dead_line_id', 'id');
    }
    public function education()
    {
        return $this->belongsTo(EducationLevel::class,'education_level_id', 'id');
    }
    public function noword()
    {
        return $this->belongsTo(NoWords::class,'no_word_id', 'id');
    }
    public function papertype()
    {
        return $this->belongsTo(PaperType::class,'paper_type_id', 'id');
    }
    public function reference()
    {
        return $this->belongsTo(ReferenceStyle::class,'reference_style_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }



}
