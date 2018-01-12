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
            'email'      => $model->email,
            'responsable'=> $model->responsable,  
            'price'      => (double)$model->price,    
            'percent'    => (int)$model->percent,
            'result'     => (double)$model->result,
            'status'     => $model->status,
            'description'=> $model->description,
            'created_at' => str_replace(" ", "T", $model->created_at),
            'updated_at' => str_replace(" ", "T", $model->updated_at),
            'dt_end'     => str_replace(" ", "T", $model->dt_end)

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
