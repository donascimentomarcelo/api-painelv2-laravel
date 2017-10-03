<?php

namespace Painel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Uploads extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
    			'projects_id',
                'filename',
                'way',
                'mime',
                'original_filename',
                'order',
    			];

    public function projects()
    {
    	return $this->hasOne(Projects::class, 'id', 'projects_id');
    }

}
