<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\News;

/**
 * Class NewsTransformer
 * @package namespace Painel\Transformers;
 */
class NewsTransformer extends TransformerAbstract
{

    /**
     * Transform the \News entity
     * @param \News $model
     *
     * @return array
     */
    public function transform(News $model)
    {
        return [
            'id'         => (int) $model->id,
            'title'      => $model->title,
            'subject'    => $model->subject,
            'description'=> $model->description
        ];
    }
}