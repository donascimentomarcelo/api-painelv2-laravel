<?php

namespace Painel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Promotions extends Model implements Transformable
{
    use TransformableTrait;

    
    protected $fillable = [ 
					    	'name',	
					    	'email',
					    	'responsable',	
					    	'title',	
					    	'price',	
					    	'percent',
					    	'result',
					    	'status',
					    	'dt_end',
					    	'description' ];

	public function uploadspromotions()
	{
		return $this->hasMany(Uploadspromotions::class);
	}

}
