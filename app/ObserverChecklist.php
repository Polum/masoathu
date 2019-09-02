<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObserverChecklist extends Model
{
    
    protected $table = "observer_checklist";
    
    protected $fillables = ["category", "question_no", "body", "code", "has_explanation", "type_id", "predifined_answers", "timeline"];
}
