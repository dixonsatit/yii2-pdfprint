<?php

namespace dixonstarter\pdfprint;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/**
 * This is just an example.
 */
class Pdfprint extends \yii\base\Widget
{
  public $iframeId;

  public $elementClass = '.btn-print';

  public function init(){
    parent::init();
    if($this->iframeId==null){
      $this->iframeId = 'pdfprint-'.$this->id;
    }
    $this->registerJs();
  }

    public function run()
    {
        NprogressAsset::register($this->getView());
        return Html::tag('iframe',null ,['id' => $this->iframeId, 'style'=>'display:none;']);
    }

    public function registerJs()
 {
$js = <<<JS
/**
 * @referent https://www.sitepoint.com/load-pdf-iframe-call-print/
 */
$(document).on('click', '{$this->elementClass}', function(e){
  e.preventDefault();
  NProgress.start();
  _pdfprint($(this).data('url'));
});

function _pdfprint(url)
{
    var iframeId = "{$this->iframeId}",
    iframe = $("iframe#{$this->iframeId}");
    iframe.attr('src', url);
    iframe.load(function() {
        _callPdfPrint(iframeId);
        NProgress.done();
    });
}

function _callPdfPrint(iframeId) {
    var PDF = document.getElementById(iframeId);
    PDF.focus();
    PDF.contentWindow.print();
}
JS;
     $this->view->registerJs($js, View::POS_READY, 'dixonstarter-pdfprint');
 }
}
