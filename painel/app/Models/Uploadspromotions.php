<?php

namespace Painel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Uploadspromotions extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [ 'promotions_id',
							'filename',
							'way',
							'mime',
							'original_filename'
							];

	public function promotions()
	{
		return $this->hasOne(Promotions::class,'id', 'promotions_id');
	}

}
