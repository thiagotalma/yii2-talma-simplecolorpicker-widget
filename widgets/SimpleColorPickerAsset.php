<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-simplecolorpicker
 * @version 1.0.0
 */

namespace talma\widgets;

use yii\web\AssetBundle;

/**
 * Asset bundle for jquery-simplecolorpicker Widget
 *
 * @author Thiago Talma <thiago@thiagomt.com>
 * @since 1.0
 */
class SimpleColorPickerAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->js = ['jquery.simplecolorpicker.js'];
        $this->css = ['jquery.simplecolorpicker.css'];
        $this->sourcePath = __DIR__ . '/../assets';
        parent::init();
    }
}
