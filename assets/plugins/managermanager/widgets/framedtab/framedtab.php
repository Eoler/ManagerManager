<?php
//---------------------------------------------------------------------------------
// mm_widget_framedtab
// Create tab with framed content (iframe), optional URL parametrization
//--------------------------------------------------------------------------------- 
function mm_widget_framedtab($title='', $tabid='', $docid='', $tabhei='500', $scrolling='yes', $roles='', $templates='') {
 global $modx, $id/*, $content, $manager_theme*/;
  $e = &$modx->Event;
  if ($e->name == 'OnDocFormRender' && useThisRule($roles, $templates)) {
    $tabid = empty($tabid) ? "framedtab".rand(1,1000) : $tabid;
    $title = empty($title) ? "Manage ".$tabid : $title;
    $tabhei = empty($tabhei) ? "500" : $tabhei;
    $framecontent = ($id != 0) ?
      '<iframe id="'.$tabid.'" src="" rel="'.$modx->config['site_url'].'?id='.$docid.'&res_id='.$id.'" height="'.$tabhei.'" width="100%" scrolling="'.$scrolling.'" frameborder="0"></iframe>'
    : 'Unos će biti omogućen nakon uspješnog <a onclick="document.mutate.save.click();" href="#">spremanja novog dokumenta</a>.';
    $output = "//  -------------- FramedTab widget lazyload: [{$tabid}] ------------- \n";
    $output .= "var ".$tabid."loaded = false;
    function ".$tabid."selected() {
      if (!".$tabid."loaded) {
        \$j('iframe#{$tabid}').attr( 'src', \$j('iframe#{$tabid}').attr('rel') );
        ".$tabid."loaded = true; // execute only once
      }
    }";
    $e->output($output . "\n");
    mm_createTab($title, $tabid, '', '', $framecontent, '680', $tabhei, $tabid."selected");
  }
}//function mm_widget_framedtab
