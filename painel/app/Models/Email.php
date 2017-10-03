<?php

namespace Painel\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Email extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['email'];

}
