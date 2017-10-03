<?php

namespace Painel\Presenters;

use Painel\Transformers\UploadsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UploadsPresenter
 *
 * @package namespace Painel\Presenters;
 */
class UploadsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UploadsTransformer();
    }
}
