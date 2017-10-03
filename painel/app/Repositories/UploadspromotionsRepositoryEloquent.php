<?php

namespace Painel\Repositories;

use Painel\Models\Uploadspromotions;
use Painel\Presenters\UploadspromotionsPresenter;
use Painel\Repositories\uploadspromotionsRepository;
use Painel\Validators\UploadspromotionsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UploadspromotionsRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class UploadspromotionsRepositoryEloquent extends BaseRepository implements UploadspromotionsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Uploadspromotions::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return UploadspromotionsPresenter::class;
    }
}
