<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\Promotions;
use Painel\Models\Uploadspromotions;
use Painel\Transformers\UploadspromotionsTransformer;

/**
 * Class PromotionsTransformer
 * @package namespace Painel\Transformers;
 */
class PromotionsTransformer extends TransformerAbstract
{
    protected $defaultIncludes   = ['Uploadspromotions'];
    // definir smp o nome dessa variavel com o nome do transformer q faz o relacionamento, no caso Uploadspromotions 
    /**
     * Transform the \Promotions entity
     * @param \Promotions $model
     *
     * @return array
     */
    public function transform(Promotions $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'title'      => $model->title,
            'description'=> $model->description,
            'dt_start'   => $model->dt_start,
            'dt_middle'  => $model->dt_middle,
            'dt_end'     => $model->dt_end

        ];
    }

    public function includeUploadspromotions(Promotions $model)
    // definir smp o nome desse metodo com o nome do transformer q faz o relacionamento, no caso Uploadspromotions 
    {
        if(!$model->Uploadspromotions)
        {
            return null;
        }

        return $this->collection($model->Uploadspromotions, new UploadspromotionsTransformer());
    }
}
