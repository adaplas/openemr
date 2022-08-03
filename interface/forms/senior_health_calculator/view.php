<!-- view.php -->
 <?php
 require_once("../../globals.php");
 require_once("$srcdir/api.inc");

 use OpenEMR\Common\Csrf\CsrfUtils;
 use OpenEMR\Core\Header;

 formHeader("Form: senior_health_calculator");
 $obj = formFetch("form_senior_health_calculator", $_GET["id"]);  //#Use the formFetch function from api.inc to get values for existing form.

 function chkdata_Txt(&$obj, $var) {
         return attr($obj["$var"]);
 }
 function chkdata_Date(&$obj, $var) {
         return attr($obj["$var"]);
 }
 function chkdata_CB(&$obj, $nam, $var) {
 	if (preg_match("/Negative.*$var/",$obj[$nam]))
 		{return;}
 	else if (preg_match("/Positive.*$var/",$obj[$nam]))
 		 {return "checked";}
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
 DATE_HEADER
 <form method=post action="<?php echo $rootdir?>/forms/senior_health_calculator/save.php?mode=update&id=<?php echo attr_url($_GET["id"]); ?>" name="my_form" onsubmit="return top.restoreSession()">
 <input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
 <h1> senior_health_calculator </h1>
 <hr>
 <input type="submit" name="submit form" value="submit form" /><br />
 <br />
 <h3> <?php echo xlt("Medical History") ?> </h3>

 <table>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Angina" <?php $result = chkdata_CB($obj,"pmhx","Angina"); echo $result;?>> <?php echo xlt("Angina") ?> </label></td></td>
<td><label><input type="checkbox" name="pmhx[]" value="Anxiety disorder" <?php $result = chkdata_CB($obj,"pmhx","Anxiety disorder"); echo $result;?>> <?php echo xlt("Anxiety disorder") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Arthritis" <?php $result = chkdata_CB($obj,"pmhx","Arthritis"); echo $result;?>> <?php echo xlt("Arthritis") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Asthma" <?php $result = chkdata_CB($obj,"pmhx","Asthma"); echo $result;?>> <?php echo xlt("Asthma") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Atrial fibrillation or flutter" <?php $result = chkdata_CB($obj,"pmhx","Atrial fibrillation or flutter"); echo $result;?>> <?php echo xlt("Atrial fibrillation or flutter") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Cancer within 5 years" <?php $result = chkdata_CB($obj,"pmhx","Cancer within 5 years"); echo $result;?>> <?php echo xlt("Cancer within 5 years") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Chronic kidney disease with eGFR less than 60" <?php $result = chkdata_CB($obj,"pmhx","Chronic kidney disease with eGFR less than 60"); echo $result;?>> <?php echo xlt("Chronic kidney disease with eGFR less than 60") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="COPD" <?php $result = chkdata_CB($obj,"pmhx","COPD"); echo $result;?>> <?php echo xlt("COPD") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Coronary artery disease" <?php $result = chkdata_CB($obj,"pmhx","Coronary artery disease"); echo $result;?>> <?php echo xlt("Coronary artery disease") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Degenerative spine disease" <?php $result = chkdata_CB($obj,"pmhx","Degenerative spine disease"); echo $result;?>> <?php echo xlt("Degenerative spine disease") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Dementia" <?php $result = chkdata_CB($obj,"pmhx","Dementia"); echo $result;?>> <?php echo xlt("Dementia") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Depression" <?php $result = chkdata_CB($obj,"pmhx","Depression"); echo $result;?>> <?php echo xlt("Depression") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Diabetes" <?php $result = chkdata_CB($obj,"pmhx","Diabetes"); echo $result;?>> <?php echo xlt("Diabetes") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Fall within the past year" <?php $result = chkdata_CB($obj,"pmhx","Fall within the past year"); echo $result;?>> <?php echo xlt("Fall within the past year") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Heart failure" <?php $result = chkdata_CB($obj,"pmhx","Heart failure"); echo $result;?>> <?php echo xlt("Heart failure") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Hypertension" <?php $result = chkdata_CB($obj,"pmhx","Hypertension"); echo $result;?>> <?php echo xlt("Hypertension") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Myocardial infarction" <?php $result = chkdata_CB($obj,"pmhx","Myocardial infarction"); echo $result;?>> <?php echo xlt("Myocardial infarction") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Peripheral vascular disease" <?php $result = chkdata_CB($obj,"pmhx","Peripheral vascular disease"); echo $result;?>> <?php echo xlt("Peripheral vascular disease") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Sensory impairment" <?php $result = chkdata_CB($obj,"pmhx","Sensory impairment"); echo $result;?>> <?php echo xlt("Sensory impairment") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Stroke or TIA" <?php $result = chkdata_CB($obj,"pmhx","Stroke or TIA"); echo $result;?>> <?php echo xlt("Stroke or TIA") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Use of more than 5 prescription drugs" <?php $result = chkdata_CB($obj,"pmhx","Use of more than 5 prescription drugs"); echo $result;?>> <?php echo xlt("Use of more than 5 prescription drugs") ?> </label></td></td></tr>
</tr>

 </table>
 <br />
 <h3> <?php echo xlt("Functional Status") ?> </h3>

 <table>

<tr>
<th>Activities of Daily Living</th>
<th>Independent Activities of Daily Living</th>
<th>Nagi & Rosow-Breslau Activities</th>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Feeding" <?php $result = chkdata_CB($obj,"fx","Feeding"); echo $result;?>> <?php echo xlt("Feeding") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Using telephone" <?php $result = chkdata_CB($obj,"fx","Using telephone"); echo $result;?>> <?php echo xlt("Using telephone") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Pulling or pushing a large object" <?php $result = chkdata_CB($obj,"fx","Pulling or pushing a large object"); echo $result;?>> <?php echo xlt("Pulling or pushing a large object") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Dressing or undressing" <?php $result = chkdata_CB($obj,"fx","Dressing or undressing"); echo $result;?>> <?php echo xlt("Dressing or undressing") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Using transportation" <?php $result = chkdata_CB($obj,"fx","Using transportation"); echo $result;?>> <?php echo xlt("Using transportation") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Stooping or crouching or kneeling" <?php $result = chkdata_CB($obj,"fx","Stooping or crouching or kneeling"); echo $result;?>> <?php echo xlt("Stooping or crouching or kneeling") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Grooming" <?php $result = chkdata_CB($obj,"fx","Grooming"); echo $result;?>> <?php echo xlt("Grooming") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Shopping" <?php $result = chkdata_CB($obj,"fx","Shopping"); echo $result;?>> <?php echo xlt("Shopping") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Lifting or carrying 10 lbs" <?php $result = chkdata_CB($obj,"fx","Lifting or carrying 10 lbs"); echo $result;?>> <?php echo xlt("Lifting or carrying 10 lbs") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Walking or use of a walker" <?php $result = chkdata_CB($obj,"fx","Walking or use of a walker"); echo $result;?>> <?php echo xlt("Walking or use of a walker") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Preparing own meals" <?php $result = chkdata_CB($obj,"fx","Preparing own meals"); echo $result;?>> <?php echo xlt("Preparing own meals") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Reaching arms above shoulder" <?php $result = chkdata_CB($obj,"fx","Reaching arms above shoulder"); echo $result;?>> <?php echo xlt("Reaching arms above shoulder") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Getting in and out of bed" <?php $result = chkdata_CB($obj,"fx","Getting in and out of bed"); echo $result;?>> <?php echo xlt("Getting in and out of bed") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Housework" <?php $result = chkdata_CB($obj,"fx","Housework"); echo $result;?>> <?php echo xlt("Housework") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Writing or handling small objects" <?php $result = chkdata_CB($obj,"fx","Writing or handling small objects"); echo $result;?>> <?php echo xlt("Writing or handling small objects") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Toileting" <?php $result = chkdata_CB($obj,"fx","Toileting"); echo $result;?>> <?php echo xlt("Toileting") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Taking own medications" <?php $result = chkdata_CB($obj,"fx","Taking own medications"); echo $result;?>> <?php echo xlt("Taking own medications") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Walking up or down a flight of stairs" <?php $result = chkdata_CB($obj,"fx","Walking up or down a flight of stairs"); echo $result;?>> <?php echo xlt("Walking up or down a flight of stairs") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Bathing or shower" <?php $result = chkdata_CB($obj,"fx","Bathing or shower"); echo $result;?>> <?php echo xlt("Bathing or shower") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Managing money" <?php $result = chkdata_CB($obj,"fx","Managing money"); echo $result;?>> <?php echo xlt("Managing money") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Walking half a mile" <?php $result = chkdata_CB($obj,"fx","Walking half a mile"); echo $result;?>> <?php echo xlt("Walking half a mile") ?> </label></td>
</tr>

<tr>
<td></td>
<td></td>
<td><label><input type="checkbox" name="fx[]" value="Heavy work around house" <?php $result = chkdata_CB($obj,"fx","Heavy work around house"); echo $result;?>> <?php echo xlt("Heavy work around house") ?> </label></td>
</tr>

 </table>
 <br />
 <h3> <?php echo xlt("Performance Tests") ?> </h3>
 <br />
 <h4> <?php echo xlt("Mental State Examination") ?> </h4>

 <table>

 <tr><td> <?php echo xlt("Mmse") ?> </td> <td><input type="text" name="mmse" value="<?php $result = chkdata_Txt($obj,"mmse"); echo $result;?>"></td></tr>

 </table>

 <table>

 <tr><td> <?php echo xlt("Moca") ?> </td> <td><input type="text" name="moca" value="<?php $result = chkdata_Txt($obj,"moca"); echo $result;?>"></td></tr>

 </table>

 <table>

 <tr><td> <?php echo xlt("Mini cog") ?> </td> <td><input type="text" name="mini_cog" value="<?php $result = chkdata_Txt($obj,"mini_cog"); echo $result;?>"></td></tr>

 </table>
 <br />
 <h4> <?php echo xlt("Gait Speed") ?> </h4>

 <table>

 <tr><td> <?php echo xlt("Gait speed") ?> </td> <td><input type="text" name="gait_speed" value="<?php $result = chkdata_Txt($obj,"gait_speed"); echo $result;?>"></td></tr>

 </table>
 <br />
 <h4> <?php echo xlt("5 Repeated Chair Stands") ?> </h4>

 <table>

 <tr><td> <?php echo xlt("Chair stands") ?> </td> <td><input type="text" name="chair_stands" value="<?php $result = chkdata_Txt($obj,"chair_stands"); echo $result;?>"></td></tr>

 </table>
 <br />
 <h4> <?php echo xlt("Dominant Handgrip Strength") ?> </hr>

 <table>

 <tr><td> <?php echo xlt("Grip strength") ?> </td> <td><input type="text" name="grip_strength" value="<?php $result = chkdata_Txt($obj,"grip_strength"); echo $result;?>"></td></tr>

 </table>
 <br />
 <h3> <?php echo xlt("Nutritional Status") ?> </h3>

 <table>

 <tr><td> <?php echo xlt("Weight loss") ?> </td> <td><label><input type="radio" name="weight_loss" value="yes" <?php $result = chkdata_Radio($obj,"weight_loss","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label>
 <label><input type="radio" name="weight_loss" value="no" <?php $result = chkdata_Radio($obj,"weight_loss","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr>

 </table>

 <table>

 <tr><td> <?php echo xlt("Bmi") ?> </td> <td><label><input type="radio" name="bmi" value="yes" <?php $result = chkdata_Radio($obj,"bmi","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label>
 <label><input type="radio" name="bmi" value="no" <?php $result = chkdata_Radio($obj,"bmi","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr>

 </table>

 <table>

 <tr><td> <?php echo xlt("Albumin") ?> </td> <td><label><input type="radio" name="albumin" value="yes" <?php $result = chkdata_Radio($obj,"albumin","yes"); echo $result;?>> <?php echo xlt("yes") ?> </label>
 <label><input type="radio" name="albumin" value="no" <?php $result = chkdata_Radio($obj,"albumin","no"); echo $result;?>> <?php echo xlt("no") ?> </label></td></tr>

 </table>

 <table>

 <tr><td> <?php echo xlt("Score") ?> </td> <td><input type="text" name="score" value="<?php $result = chkdata_Txt($obj,"score"); echo $result;?>"></td></tr>

 </table>
 <table></table><input type="submit" name="submit form" value="submit form" />

 </form>
 <?php
 formFooter();
 ?>
