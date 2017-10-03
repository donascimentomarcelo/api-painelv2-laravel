<?php

namespace Painel\Presenters;

use Painel\Transformers\PromotionsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PromotionsPresenter
 *
 * @package namespace Painel\Presenters;
 */
class PromotionsPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PromotionsTransformer();
    }
}
