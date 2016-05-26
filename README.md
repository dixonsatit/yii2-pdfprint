
PdfPrint
========
Load PDF into iframe and call print.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist dixonstarter/yii2-pdfprint "*"
```

or add

```
"dixonstarter/yii2-pdfprint": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \dixonstarter\pdfprint\Pdfprint::widget();?>
```
