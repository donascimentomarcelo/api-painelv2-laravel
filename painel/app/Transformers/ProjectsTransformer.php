<?php

namespace Painel\Transformers;

use League\Fractal\TransformerAbstract;
use Painel\Models\Projects;
use Painel\Models\Uploads;
use Painel\Transformers\UploadsTransformer;

/**
 * Class ProjectsTransformer
 * @package namespace Painel\Transformers;
 */
class ProjectsTransformer extends TransformerAbstract
{
    protected $defaultIncludes   = ['upload'];
    // protected $availableIncludes = ['uploads'];
    /**
     * Transform the \Projects entity
     * @param \Projects $model
     *
     * @return array
     */
    public function transform(Projects $model)
    {
        return [
            'id'         => (int) $model->id,
            'name'       => $model->name,
            'category'   => $model->category,
            'link'       => $model->link,
            'description'=> $model->description
        ];
    }

    public function includeUpload(Projects $model)
    {

        if(!$model->upload)
        {
            return null;
        }

        return $this->collection($model->upload, new UploadsTransformer());
    }
}
