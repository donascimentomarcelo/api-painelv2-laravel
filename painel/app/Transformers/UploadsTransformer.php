<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\Uploads;

/**
 * Class UploadsTransformer
 * @package namespace Painel\Transformers;
 */
class UploadsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Uploads entity
     * @param \Uploads $model
     *
     * @return array
     */
    public function transform(Uploads $model)
    {
        return [
            'id'                => (int) $model->id,
            'original_filename' => $model->original_filename,
            'filename'          => $model->filename,
            'way'               => $model->way,
            'order'             => (int)$model->order
        ];
    }
}
