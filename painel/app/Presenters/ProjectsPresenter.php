<?php

namespace Painel\Presenters;

use Painel\Transformers\ProjectsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProjectsPresenter
 *
 * @package namespace Painel\Presenters;
 */
class ProjectsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectsTransformer();
    }
}
