<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-simplecolorpicker
 * @version 1.0.0
 */

namespace talma\widgets;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * Talma Simple Color Picker widget is a Yii2 wrapper for the jquery-simplecolorpicker.
 *
 * @author Thiago Talma <thiago@thiagomt.com>
 * @since 1.0
 * @see https://github.com/tkrotoff/jquery-simplecolorpicker
 */
class SimpleColorPicker extends InputWidget
{
    /**
     * @var array Additional config
     */
    public $config = [];
    
    public $colors = [
        '#7bd148' => 'Green',
        '#5484ed' => 'Bold blue',
        '#a4bdfc' => 'Blue',
        '#46d6db' => 'Turquoise',
        '#7ae7bf' => 'Light green',
        '#51b749' => 'Bold green',
        '#fbd75b' => 'Yellow',
        '#ffb878' => 'Orange',
        '#ff887c' => 'Red',
        '#dc2127' => 'Bold red',
        '#dbadff' => 'Purple',
        '#e1e1e1' => 'Gray'
    ];
    
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        $this->registerClientScript();

        $this->options['data-plugin-name'] = 'simplecolorpicker';

        if ($this->hasModel()) {
            echo Html::activeSelectInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::selectInput($this->name, $this->value, $this->options);
        }
    }

    /**
     * Registers the needed JavaScript.
     */
    public function registerClientScript()
    {
        $options = $this->getClientOptions();
        $this->hashOptions = 'simplecolorpicker_' . hash('crc32', serialize($options));
        $js = '';
        $id = $this->options['id'];
        $view = $this->getView();
        $view->registerJs("var {$this->hashOptions} = {$options};", $view::POS_HEAD);
        $js .= "jQuery(\"#{$id}\").simplecolorpicker({$this->hashOptions});";
        SimpleColorPickerAsset::register($view);
        $view->registerJs($js);
    }

    /**
     * @return array the options for the text field
     */
    protected function getClientOptions()
    {
        $options = array_merge($options, $this->config);
        return Json::encode($options);
    }
}
