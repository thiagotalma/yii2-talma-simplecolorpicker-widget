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
        '#AC725E' => 'Santa Fe',
        '#D06B64' => 'Chestnut Rose',
        '#F83A22' => 'Pomegranateapprox',
        '#FA573C' => 'Sunset Orange',
        '#FF7537' => 'Burning Orange',
        '#FFAD46' => 'Yellow Orange',
        '#42D692' => 'Shamrock',
        '#16A765' => 'Mountain Meadow',
        '#7BD148' => 'Atlantis',
        '#B3DC6C' => 'Yellow Green',
        '#FBE983' => 'Sweet Corn',
        '#FAD165' => 'Goldenrod',
        '#92E1C0' => 'Algae Green',
        '#9FE1E7' => 'Water Leaf',
        '#9FC6E7' => 'Regent St Blue',
        '#4986E7' => 'Royal Blue',
        '#9A9CFF' => 'Melrose',
        '#B99AFF' => 'Mauve',
        '#C2C2C2' => 'Silver',
        '#CABDBF' => 'Cold Turkey',
        '#CCA6AC' => 'Clam Shell',
        '#F691B2' => 'Persian Pink',
        '#CD74E6' => 'Lavender',
        '#A47AE2' => 'Medium Purple'
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

        $colors = $this->colors;

        if ($this->hasModel()) {
            $value = Html::getAttributeValue($this->model, $this->attribute);
        } else {
            $value = $this->value;
        }

        if ($value !== null && !in_array($value, $colors)) {
            $colors = array_merge($colors, [$value => 'Custom']);
        }

        if ($this->hasModel()) {
            $input = Html::activeDropDownList($this->model, $this->attribute, $colors, $this->options);
        } else {
            $input = Html::dropDownList($this->name, $this->value, $colors, $this->options);
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
