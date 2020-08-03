<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    protected $table = 'model_has_roles';
    public $timestamps = false;

    public function role(){

    	return $this->hasOne(Role::class, 'id','role_id');
    }
}
