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
        //return Html::tag('iframe',null ,['id' => $this->iframeId, 'style'=>'display:none;']);
    }

    public function registerJs()
    {

$js = <<<JS

/**
 *  ================================================================
 *  Yii2 PDF Print
 *  ================================================================
 *  @author Sathit Seethaphon <dixonsatit@gmail.com>
 *  @referent https://www.sitepoint.com/load-pdf-iframe-call-print/
 */

$(document).on('click', '{$this->elementClass}', function(e){
  e.preventDefault();
  NProgress.start();
  _createIframe($(this).data('url'));
  //_pdfprint($(this).data('url'));
});

function _createIframe(url){
  _removeIframe();
  var d = new Date();
  var n = d.getTime();
  var iframe = document.createElement('iframe');
      iframe.className = 'pdfprint';
      iframe.style.display = 'none';
      iframe.src = url;
      iframe.id = "{$this->iframeId}"+n;

  if(iframe.addEventListener){
    iframe.addEventListener('load', _onload, true);
  }
  else if(iframe.attachEvent){
    iframe.attachEvent('onload',_onload);
  }
  document.body.appendChild(iframe);
}

function _removeIframe(){
  var iframes = document.getElementsByClassName("pdfprint");
  console.log(typeof iframes);
  console.log(iframes);
  for (var key in iframes) {
    if (iframes.hasOwnProperty(key)) {
       document.getElementById(iframes[key].id).remove();
    }
  }
}

function _onload(e){
  console.info('load pdf to print!',this.id);
  var PDF = document.getElementById(this.id);
      PDF.focus();
      PDF.contentWindow.print();
      NProgress.done();
}

function _pdfprint(url)
{
  var iframe = document.getElementById("{$this->iframeId}");
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
 * ===== End: Yii2 PDF Pint ========================================================================
 */
JS;
     $this->view->registerJs($js, View::POS_READY, 'dixonstarter-pdfprint');
 }
}
