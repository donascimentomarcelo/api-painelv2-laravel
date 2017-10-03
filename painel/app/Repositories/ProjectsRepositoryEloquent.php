<?php

namespace Painel\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Painel\Models\Projects;
use Painel\Presenters\ProjectsPresenter;
use Painel\Repositories\ProjectsRepository;
use Painel\Validators\ProjectsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ProjectsRepositoryEloquent
 * @package namespace Painel\Repositories;
 */
class ProjectsRepositoryEloquent extends BaseRepository implements ProjectsRepository
{
    // protected $skipPresenter = true;
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Projects::class;
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
        return ProjectsPresenter::class;
    }

     public function edit($id)
    {
        $return = $this->model->with(['upload'])->where(['id'=> $id])->first();
        if($return)
        {
            // O parserResult adiciona subnivel data: ao objeto
            $response['return'] = $this->parserResult($return);
            $response['status'] = 200;
            return $response;
        }
        else
        {
            $error['message'] = 'Projeto não localizado!';
            $error['status']  = 404;
            return $error;
        }  
        throw (new ModelNotFoundException())->setModel(get_class($this->model));
      
    }
}
