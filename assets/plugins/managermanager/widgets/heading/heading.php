<?php
//---------------------------------------------------------------------------------
// mm_widget_heading
// Change resource entry form heading
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
    $output .= '$j("#create_edit h1").html( '.$titlehtml.' );';
    $e->output($output . "\n");
  } // endif ruleUsed
}//function mm_widget_heading
