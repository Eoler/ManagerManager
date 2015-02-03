<?php
//---------------------------------------------------------------------------------
// mm_widget_heading
// Change resource entry form heading and compact title/intro field layout
//--------------------------------------------------------------------------------- 
function mm_widget_heading($field, $prologue='', $roles='', $templates='') {
 global $modx, $id, $manager_theme;
  $e = &$modx->Event;
  if ($e->name == 'OnDocFormRender' && useThisRule($roles, $templates)) {
    $output = " // ----------- Set heading -------------- \n";
    if (empty($prologue)) {
      $titleicon = ($id != 0) ? "write.png" : "add.png";
      $titleaction = ($id != 0) ? "Editing" : "Adding";
      $titlehtml = '\'<img src="media/style/'.$manager_theme.'/images/icons/'.$titleicon.'" alt="'.$titleaction.'" class="tooltip" />&nbsp;\'';
    } else {
      $titlehtml = $prologue; //jsSafe()
    }  
    if (!empty($field)) {
      $titlehtml .= ' + $j("input[type=text][name='.$field.']").val()';
    }
    $output .= '$j("#create_edit h1").html( '.$titlehtml.' );'."\n";
    $output .= '$j("#content_header").css({clear:"both"})'."\n";
    $output .= 'var $gentbl = $j("#tabGeneral table").first();'."\n";
    $output .= '$gentbl.attr("width", "56%").css({float:"left"})'."\n";
    $output .= '$gentbl.after(\'<table width="44%" style="float:right;margin-bottom:10px" border="0" cellspacing="5" cellpadding="0"><tbody id="introll"></tbody></table>\');'."\n";
    $output .= '$j("#introll").append( $j("textarea[name=introtext]").closest("tr") );'."\n";
    $output .= 'var $introlbl = $j("#introll td").first();'."\n";
    $output .= '$j("textarea[name=introtext]").attr("placeholder", $introlbl.text());'."\n";
    $output .= '$introlbl.remove();';
    $e->output($output . "\n");
  } // endif ruleUsed
}//function mm_widget_heading
