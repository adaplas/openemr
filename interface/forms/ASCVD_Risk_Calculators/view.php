 <?php 
 
 /**
 * ASCVD Risk Calculator view.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Antonino Daplas <adaplas@gmail.com>
 * @copyright Copyright (c) 2022 Antonino Daplas <adaplas@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

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
 	if (preg_match("/$var/",$obj[$nam])) {return "selected";} else {return;} 
 } 
  
 ?> 
 <html><head> 
 <?php Header::setupHeader('datetime-picker'); ?> 
 </head> 
 <body <?php echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0> 
  
 <form method=post action="<?php echo $rootdir?>/forms/ASCVD_Risk_Calculators/save.php?mode=update&id=<?php echo attr_url($_GET["id"]); ?>" name="my_form" onsubmit="return top.restoreSession()"> 
 <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" /> 
 
 <style>
h3 {
	font-size: 20px;
}
</style>
 <h1> ASCVD Risk Calculators </h1> 
 <hr> 
 <input type="submit" name="Save" value="Save" /><br /> 
 <br /> 
 <h3> <?php echo xlt("Age (years)") ?> </h3> 
  
 <table> 
  
 <tr><td><input type="text" name="age" value="<?php $result = chkdata_Txt($obj,"age"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Sex") ?> </h3> 
  
 <table> 
  
 <tr><td><td><label><input type="radio" name="sex" value="male" <?php $result = chkdata_Radio($obj,"sex","male"); echo $result;?>> <?php echo xlt("male") ?> </label> 
 <label><input type="radio" name="sex" value="female" <?php $result = chkdata_Radio($obj,"sex","female"); echo $result;?>> <?php echo xlt("female") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Race") ?> </h3> 
  
 <table> 
  
 <tr><td><select name="race"  size="5"> 
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
  
 <tr><td><input type="text" name="sbp" value="<?php $result = chkdata_Txt($obj,"sbp"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Body Mass Index (mm/kg2)") ?> </h3> 
  
 <table> 
  
 <tr><td><input type="text" name="bmi" value="<?php $result = chkdata_Txt($obj,"bmi"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("HDL (mg/dL)") ?> </h3> 
  
 <table> 
  
 <tr><td><input type="text" name="hdl" value="<?php $result = chkdata_Txt($obj,"hdl"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Total Cholesterol (mg/dL)") ?> </h3> 
  
 <table> 
  
 <tr><td><input type="text" name="tot_chol" value="<?php $result = chkdata_Txt($obj,"tot_chol"); echo $result;?>"></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Blood Pressure Medications") ?> </h3> 
  
 <table> 
  
 <tr><td><label><input type="radio" name="bp_med" value="yes" <?php $result = chkdata_Radio($obj,"bp_med","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="bp_med" value="no" <?php $result = chkdata_Radio($obj,"bp_med","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Smoking") ?> </h3> 
  
 <table> 
  
 <tr><td><label><input type="radio" name="smoking" value="yes" <?php $result = chkdata_Radio($obj,"smoking","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="smoking" value="no" <?php $result = chkdata_Radio($obj,"smoking","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Diabetes") ?> </h3> 
  
 <table> 
  
 <tr><td><label><input type="radio" name="diabetes" value="yes" <?php $result = chkdata_Radio($obj,"diabetes","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="diabetes" value="no" <?php $result = chkdata_Radio($obj,"diabetes","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Lipid Medications") ?> </h3> 
  
 <table> 
  
 <tr><td><label><input type="radio" name="lipid_med" value="yes" <?php $result = chkdata_Radio($obj,"lipid_med","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="lipid_med" value="no" <?php $result = chkdata_Radio($obj,"lipid_med","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 <br /> 
 <h3> <?php echo xlt("Family History of Heart Attacks") ?> </h3> 
  
 <table> 
  
 <tr><td><label><input type="radio" name="fh_heartattack" value="yes" <?php $result = chkdata_Radio($obj,"fh_heartattack","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label> 
 <label><input type="radio" name="fh_heartattack" value="no" <?php $result = chkdata_Radio($obj,"fh_heartattack","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr> 
  
 </table> 
 
 <br /> 
 <h3> <?php echo xlt("Coronary Artery Calcification (Agatston)") ?> </h3> 
  
 <table> 
  
 <tr><td><input type="text" name="cac" value="<?php $result = chkdata_Txt($obj,"cac"); echo $result;?>"></td></tr> 
</table>  

  <tr><td><input type="hidden" name="10y_accaha" value="<?php $result = chkdata_Txt($obj,"10y_accaha"); echo $result;?>"></td></tr> 
  
 <tr><td><input type="hidden" name="10y_frs" value="<?php $result = chkdata_Txt($obj,"10y_frs"); echo $result;?>"></td></tr> 
  
 <tr><td><input type="hidden" name="10y_frs_simple" value="<?php $result = chkdata_Txt($obj,"10y_frs_simple"); echo $result;?>"></td></tr> 
   
 <tr><td><input type="hidden" name="10y_mesa" value="<?php $result = chkdata_Txt($obj,"10y_mesa"); echo $result;?>"></td></tr> 

 <tr><td><input type="hidden" name="10y_mesa_cac" value="<?php $result = chkdata_Txt($obj,"10y_mesa_cac"); echo $result;?>"></td></tr> 
  
 </table> 
 <table></table><input type="submit" name="Save" value="Save" /> 
  
 </form> 
 <?php 
 formFooter(); 
 ?> 
