<?php

namespace Painel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Painel\Repositories\emailRepository;
use Painel\Models\Email;
use Painel\Validators\EmailValidator;

/**
 * Class EmailRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class EmailRepositoryEloquent extends BaseRepository implements EmailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Email::class;
    }

    public function EmailByStatus()
    {
        return $this->model->where(['status'=> 'active'])->lists('email');
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
