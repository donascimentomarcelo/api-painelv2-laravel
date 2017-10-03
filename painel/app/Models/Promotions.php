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
				            'title',
				            'description',
				            'dt_start',
				            'dt_middle',
				            'dt_end' ];

	public function uploadspromotions()
	{
		return $this->hasMany(Uploadspromotions::class);
	}

}
