<!-- view.php --> 
 <?php 
 require_once("../../globals.php"); 
 require_once("$srcdir/api.inc"); 
  
 use OpenEMR\Common\Csrf\CsrfUtils; 
 use OpenEMR\Core\Header; 
  
 formHeader("Form: ASCVD Risk Calculators"); 
 $obj = formFetch("form_ASCVD_Risk_Calculators", $_GET["id"]);  //#Use the formFetch function from api.inc to get values for existing form. 
  
 function chkdata_Txt(&$obj, $var) { 
         return attr($obj["$var"]); 
 } 
 function chkdata_Date(&$obj, $var) { 
         return attr($obj["$var"]); 
 } 
 function chkdata_CB(&$obj, $nam, $var) { 
 	if (preg_match("/Negative.*$var/",$obj[$nam])) {return;} else {return "checked";} 
 } 
 function chkdata_Radio(&$obj, $nam, $var) { 
 	if (strpos($obj[$nam],$var) !== false) {return "checked";} 
 } 
  function chkdata_PopOrScroll(&$obj, $nam, $var) { 
 	if (preg_match("/Negative.*$var/",$obj[$nam])) {return;} else {return "selected";} 
 } 
  
 ?> 
 <html><head> 
 <?php Header::setupHeader('datetime-picker'); ?> 
 </head> 
 <body <?php echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0> 
  
 <form method=post action="<?php echo $rootdir?>/forms/ASCVD_Risk_Calculators/save.php?mode=update&id=<?php echo attr_url($_GET["id"]); ?>" name="my_form" onsubmit="return top.restoreSession()"> 
 <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" /> 
 <h1> ASCVD Risk Calculators </h1> 
 <hr> 
 <input type="submit" name="submit form" value="submit form" /><br /> 
 <br /> 
 <h3> <?php echo xlt("Age (years)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Age") ?> </td> <td><input type="text" name="age" value="<?php $result = chkdata_Txt($obj,"age"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Sex") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Sex") ?> </td> <td><label><input type="radio" name="sex" value="male" <?php $result = chkdata_Radio($obj,"sex","male"); echo $result;?>> <?php echo xlt("male") ?> </label> 
 <label><input type="radio" name="sex" value="female" <?php $result = chkdata_Radio($obj,"sex","female"); echo $result;?>> <?php echo xlt("female") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Race") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Race") ?> </td> <td><select name="race"  size="5"> 
 <option value="white" <?php $result = chkdata_PopOrScroll($obj,"race","white"); echo $result;?>> <?php echo xlt("white") ?> </option> 
 <option value="african american" <?php $result = chkdata_PopOrScroll($obj,"race","african american"); echo $result;?>> <?php echo xlt("african american") ?> </option> 
 <option value="chinese" <?php $result = chkdata_PopOrScroll($obj,"race","chinese"); echo $result;?>> <?php echo xlt("chinese") ?> </option> 
 <option value="hispanic" <?php $result = chkdata_PopOrScroll($obj,"race","hispanic"); echo $result;?>> <?php echo xlt("hispanic") ?> </option> 
 <option value="other" <?php $result = chkdata_PopOrScroll($obj,"race","other"); echo $result;?>> <?php echo xlt("other") ?> </option> 
 </select></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Systolic Blood Pressure (mm/Hg)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Sbp") ?> </td> <td><input type="text" name="sbp" value="<?php $result = chkdata_Txt($obj,"sbp"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Body Mass Index (mm/kg2)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Bmi") ?> </td> <td><input type="text" name="bmi" value="<?php $result = chkdata_Txt($obj,"bmi"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("HDL (mg/dL)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Hdl") ?> </td> <td><input type="text" name="hdl" value="<?php $result = chkdata_Txt($obj,"hdl"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Total Cholesterol (mg/dL)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Tot chol") ?> </td> <td><input type="text" name="tot_chol" value="<?php $result = chkdata_Txt($obj,"tot_chol"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Blood Pressure Medications") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Bp med") ?> </td> <td><label><input type="radio" name="bp_med" value="yes" <?php $result = chkdata_Radio($obj,"bp_med","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="bp_med" value="no" <?php $result = chkdata_Radio($obj,"bp_med","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Smoking") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Smoking") ?> </td> <td><label><input type="radio" name="smoking" value="yes" <?php $result = chkdata_Radio($obj,"smoking","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="smoking" value="no" <?php $result = chkdata_Radio($obj,"smoking","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Diabetes") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Diabetes") ?> </td> <td><label><input type="radio" name="diabetes" value="yes" <?php $result = chkdata_Radio($obj,"diabetes","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="diabetes" value="no" <?php $result = chkdata_Radio($obj,"diabetes","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Lipid Medications") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Lipid med") ?> </td> <td><label><input type="radio" name="lipid_med" value="yes" <?php $result = chkdata_Radio($obj,"lipid_med","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="lipid_med" value="no" <?php $result = chkdata_Radio($obj,"lipid_med","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Family History of Heart Attacks") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Fh heartattack") ?> </td> <td><label><input type="radio" name="fh_heartattack" value="yes" <?php $result = chkdata_Radio($obj,"fh_heartattack","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="fh_heartattack" value="no" <?php $result = chkdata_Radio($obj,"fh_heartattack","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Coronary Artery Calcification (Agatston)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("Cac") ?> </td> <td><input type="text" name="cac" value="<?php $result = chkdata_Txt($obj,"cac"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("ACC/AHA 2013 ASCVD Risk Score") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("10y accaha") ?> </td> <td><input type="text" name="10y_accaha" value="<?php $result = chkdata_Txt($obj,"10y_accaha"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Framingham 2008 Risk Score") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("10y frs") ?> </td> <td><input type="text" name="10y_frs" value="<?php $result = chkdata_Txt($obj,"10y_frs"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Framingham 200 Risk Score (no labs)") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("10y frs simple") ?> </td> <td><input type="text" name="10y_frs_simple" value="<?php $result = chkdata_Txt($obj,"10y_frs_simple"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("MESA 2015 CVD Risk Score") ?> </h3> 
  
 <table> 
  
 <tr><td> <?php echo xlt("10y mesa") ?> </td> <td><input type="text" name="10y_mesa" value="<?php $result = chkdata_Txt($obj,"10y_mesa"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("MESA 2015 Risk Score with CAC") ?> </he> 
  
 <table> 
  
 <tr><td> <?php echo xlt("10y mesa cac") ?> </td> <td><input type="text" name="10y_mesa_cac" value="<?php $result = chkdata_Txt($obj,"10y_mesa_cac"); echo $result;?>"></td></tr> 
  
 </table> 
 <table></table><input type="submit" name="submit form" value="submit form" /> 
  
 </form> 
 <?php 
 formFooter(); 
 ?> 
