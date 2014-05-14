yii2-talma-simplecolorpicker-widget
===========
Widget for Yii Framework 2.0 to use [jquery-simplecolorpicker](https://github.com/tkrotoff/jquery-simplecolorpicker)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist thiagotalma/yii2-simplecolorpicker "*"
```

or add

```
"thiagotalma/yii2-simplecolorpicker": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by :

```php
<?= \talma\widget\SimpleColorPicker::widget(); ?>;
```