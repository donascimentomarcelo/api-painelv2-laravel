<?php

namespace Painel\Presenters;

use Painel\Transformers\UploadspromotionsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UploadspromotionsPresenter
 *
 * @package namespace Painel\Presenters;
 */
class UploadspromotionsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UploadspromotionsTransformer();
    }
}
