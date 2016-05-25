<?php

namespace dixonstarter\pdfprint;

use yii\helpers\Html;
use yii\helpers\Url;
/**
 * This is just an example.
 */
class Pdfprint extends \yii\base\Widget
{
  public $iframeId = 'iframeprint';

  public $elementClass = '.btn-print';

  public function init(){
    $this->registerJs();
  }

  public function run()
  {
      return Html::tag('iframe',null ,['id' => $this->id, 'style'=>'display:none;']);
  }

  public function registerJs()
  {
$js = <<<JS

$(document).on('click', '{$this->elementClass}', function(e){
  e.preventDefault();
  _pdfprint($(this).data('url'));
});

function _pdfprint(url)
{
    var iframeId = "{$this->iframeId}",
    iframe = $("iframe#{$this->iframeId}");
    iframe.attr('src', url);
    iframe.load(function() {
        _callPdfPrint(iframeId);
    });
}
//initiates print once content has been loaded into iframe
function _callPdfPrint(iframeId) {
    var PDF = document.getElementById(iframeId);
    PDF.focus();
    PDF.contentWindow.print();
}
JS;
     $this->view->registerJs($js, View::POS_READY, 'dixonstarter-pdfprint');
 }
}
