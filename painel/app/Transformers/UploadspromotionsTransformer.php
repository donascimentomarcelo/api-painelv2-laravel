<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\Uploadspromotions;

/**
 * Class UploadspromotionsTransformer
 * @package namespace Painel\Transformers;
 */
class UploadspromotionsTransformer extends TransformerAbstract
{

    /**
     * Transform the \Uploadspromotions entity
     * @param \Uploadspromotions $model
     *
     * @return array
     */
    public function transform(Uploadspromotions $model)
    {
        return [
            'id'                => (int) $model->id,
            'original_filename' => $model->original_filename,
            'filename'          => $model->filename,
            'way'               => $model->way
        ];
    }
}
