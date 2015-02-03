<?php
//---------------------------------------------------------------------------------
// mm_widget_framedtab
// Create tab with framed content (iframe), optional URL parametrization
//--------------------------------------------------------------------------------- 
function mm_widget_framedtab($title='', $tabid='', $docid='', $tabhei='500', $scrolling='yes', $roles='', $templates='') {
 global $modx, $id;
  $e = &$modx->Event;
  if ($e->name == 'OnDocFormRender' && useThisRule($roles, $templates)) {
    $tabid = empty($tabid) ? "framedtab".rand(1,10000) : $tabid;
    $title = empty($title) ? "Manage ".$tabid : $title;
    $tabhei = empty($tabhei) ? "500" : $tabhei;
    $framecontent = ($id != 0) ?
      '<iframe id="'.$tabid.'" src="" rel="'.$modx->config['site_url'].'?id='.$docid.'&res_id='.$id.'" height="'.$tabhei.'" width="100%" scrolling="'.$scrolling.'" frameborder="0"></iframe>'
    : 'Unos će biti omogućen nakon uspješnog <a onclick="document.mutate.save.click();" href="#">spremanja novog dokumenta</a>.';
    $output = "//  -------------- FramedTab widget lazyload: [{$tabid}] ------------- \n";
    $output .= "var {$tabid}Loaded = false;
    function {$tabid}Selected() {
      if (!{$tabid}Loaded) {
        \$j('iframe#{$tabid}').attr( 'src', \$j('iframe#{$tabid}').attr('rel') );
        {$tabid}Loaded = true; // execute only once
      }
    }";
    $e->output($output . "\nsetTimeout(function(){\n");
    mm_createTab($title, $tabid, $roles, $templates, $framecontent, '680', $tabhei, "{$tabid}Selected");
    $e->output("\n}, 250);\n");
  }
}//function mm_widget_framedtab
