<?php

namespace common\components;

use common\components\collection\IconCollection;
use yii\helpers\Html;
use yii\web\View as BaseView;

class View extends BaseView
{

    public function beginBody()
    {
        parent::beginBody();
        $this->printIcons();
    }


    protected function printIcons()
    {
        $defaultViewBox = '0 0 24 24';

        $svg = '<svg aria-hidden="true" style="display:none;position:absolute;width:0;height:0;overflow:hidden;" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs>';
        foreach ((new IconCollection()) as $key => $value) {
            $iconOptions['id'] = IconCollection::PREFIX . $key;
            
            if ($key === 'mytarget') {
                $iconOptions['viewBox'] = '0 0 2277.2 1322';
            } elseif($key === 'recuring') {
                $iconOptions['viewBox'] = '0 0 92 92';
            } else {
                $iconOptions['viewBox'] = $defaultViewBox;
            }

            $svg .= Html::tag('symbol', $value, $iconOptions);

        }
        $svg .= '</defs></svg>';
        echo $svg;
    }


}