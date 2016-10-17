
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
<?= \dixonstarter\pdfprint\Pdfprint::widget([
  'elementClass' => '.btn-pdfprint'
]);?>
```

```html
<a href="url/test.pdf" class="btn-pdfprint">open</a>
```

in GridView

```php

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
              'class' => 'yii\grid\SerialColumn',
              'options'=>['style'=>'width:30px;'],
              'contentOptions'=>['class'=>'text-center']
            ],
            // use in column
            [
              'attribute'=>'value',
              'format'=>'html',
              'value'=>function($model){
                return Html::a('<i class="glyphicon glyphicon-print"></i>',['pdf/url'],['class'=>'btn-pdfprint btn btn-default','data-pjax'=>'0']);
              }
            ],
            // use in ActionColumn
            [
              'class' => 'yii\grid\ActionColumn',
              'header'=>'Actions',
              'options'=>['style'=>'width:150px;'],
              'buttonOptions'=>['class'=>'btn btn-default'],
              'template'=>'<div class="btn-group btn-group-sm text-center" role="group">{print} {view} {update} {delete} </div>',
              'buttons'=>[
                'print'=>function($url,$model){
                  return Html::a('<i class="glyphicon glyphicon-print"></i>',['pdf/url'],['class'=>'btn-pdfprint btn btn-default','data-pjax'=>'0']);
                }
              ]
            ],
        ],
    ]); ?>
```
