<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\User;

/**
 * Class UserTransformer
 * @package namespace Painel\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'     => (int) $model->id,
            'name'   => $model->name,
            'email'  => $model->email,
        ];
    }
}
