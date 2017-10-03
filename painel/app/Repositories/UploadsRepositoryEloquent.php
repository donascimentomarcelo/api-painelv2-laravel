<?php

namespace Painel\Repositories;

use Painel\Models\Uploads;
use Painel\Presenters\UploadsPresenter;
use Painel\Repositories\UploadsRepository;
use Painel\Validators\UploadsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UploadsRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class UploadsRepositoryEloquent extends BaseRepository implements UploadsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Uploads::class;
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
        return UploadsPresenter::class;
    }
}
