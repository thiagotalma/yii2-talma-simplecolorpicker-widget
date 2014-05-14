<?php

/**
 * @copyright Copyright &copy; Thiago Talma, thiagomt.com, 2014
 * @package yii2-simplecolorpicker
 * @version 1.0.0
 */

namespace talma\widgets;

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

    /**
     * @var array Colors to display
     */
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
     * @var boolean Show the colors inside a picker instead of inline
     */
    public $picker = true;

    /**
     * @var integer Show and hide animation delay in milliseconds
     */
    public $pickerDelay = 0;

    /**
     * @var string Tag to hold the input if the colors are displayed in a picker
     */
    public $tag = 'div';

    /**
     * @var array the HTML attributes for the holder tag
     */
    public $tagOptions = [];
    
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = ['class' => 'form-control'];

    /**
     * @var string Hash of plugin options
     */
    public $hashOptions;

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
            $input = Html::activeDropDownList($this->model, $this->attribute, $this->colors, $this->options);
        } else {
            $input = Html::dropDownList($this->name, $this->value, $this->colors, $this->options);
        }

        if ($this->picker) {
            echo Html::tag($this->tag, $input, $this->tagOptions);
        } else {
            echo $input;
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
        $options['picker'] = $this->picker;
        $options['pickerDelay'] = $this->pickerDelay;

        $options = array_merge($options, $this->config);
        return Json::encode($options);
    }
}
