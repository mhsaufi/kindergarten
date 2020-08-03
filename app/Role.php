<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    public function modelhasrole(){

    	return $this->belongsTo(ModelHasRole::class, 'id', 'model_id');
    }
}
