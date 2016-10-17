<?php

namespace dixonstarter\pdfprint;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
/**
 * This is just an example.
 * <a href="http:www.pdf.com/test.pdf" class="btn-pdfprint">open</a>
 */
class Pdfprint extends \yii\base\Widget
{
  public $iframeId;

  public $elementClass = '.btn-pdfprint';

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
        //return Html::tag('iframe',null ,['id' => $this->iframeId, 'style'=>'display:none;']);
    }

    public function registerJs()
    {

$pdfPrint = '
/**
 *  ================================================================
 *  Yii2 PDF Print
 *  ================================================================
 *  @author Sathit Seethaphon <dixonsatit@gmail.com>
 *  @ref https://www.sitepoint.com/load-pdf-iframe-call-print/
 */

function _createIframe(url){
    NProgress.start();
  _removeIframe();
  var d = new Date();
  var n = d.getTime();
  var iframe = document.createElement(\'iframe\');
      iframe.className = \'pdfprint\';
      iframe.style.display = \'none\';
      iframe.src = url;
      iframe.id = "{$this->iframeId}"+n;

  if(iframe.addEventListener){
    iframe.addEventListener(\'load\', _onload, true);
  }
  else if(iframe.attachEvent){
    iframe.attachEvent(\'onload\',_onload);
  }
  document.body.appendChild(iframe);
}

function _removeIframe(){
  var iframes = document.getElementsByClassName("pdfprint");
  for (var key in iframes) {
    if (iframes.hasOwnProperty(key)) {
       var e = document.getElementById(iframes[key].id);
       if(e != undefined){
         e.remove()
       }
    }
  }
}

function _onload(e){
  console.info(\'load pdf to print!\',this.id);
  var PDF = document.getElementById(this.id);
      PDF.focus();
      PDF.contentWindow.print();
      NProgress.done();
}

function _pdfprint(url)
{
  var iframe = document.getElementById("'.$this->iframeId.'");
  var ifWin = iframe.contentWindow || iframe;
  iframe.src = url;
  iframe.onload = function(){
    try {
      ifWin.focus();
      ifWin.print();
    }catch(e) {
      console.log(e);
    }
    NProgress.done();
  }
}
/**
 * ===== End: Yii2 PDF Pint ==================================
 */
';

$js = <<<JS
$(document).on('click', '{$this->elementClass}', function(e){
  e.preventDefault();
  _createIframe($(this).attr('href'));
});
JS;
     $this->view->registerJs($pdfPrint, View::POS_HEAD);
     $this->view->registerJs($js, View::POS_READY, 'dixonstarter-pdfprint');
 }
}
