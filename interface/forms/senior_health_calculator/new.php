<?php
require_once("../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

formHeader("Form: senior_health_calculator");
?>
<html><head>
<?php Header::setupHeader('datetime-picker'); ?>
</head>
<body <?php echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
DATE_HEADER
<a href='<?php echo $GLOBALS['form_exit_url']; ?>' onclick='top.restoreSession()'> <?php echo xlt("[do not save]") ?> </a>
<form method=post action="<?php echo $rootdir;?>/forms/senior_health_calculator/save.php?mode=new" name="senior_health_calculator" onsubmit="return top.restoreSession()">
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<hr>
<h1> <?php echo xlt("senior_health_calculator") ?> </h1>
<hr>
<input type="submit" name="submit form" value="submit form" /><br />
<br />
<h3> <?php echo xlt("Medical History") ?> </h3>
<p><?php echo xlt("Check any items that the patient has in his/her medical history.") ?></p>
<table>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Angina" /> <?php echo xlt("Angina") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Anxiety disorder" /> <?php echo xlt("Anxiety disorder") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Arthritis" /> <?php echo xlt("Arthritis") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Asthma" /> <?php echo xlt("Asthma") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Atrial fibrillation or flutter" /> <?php echo xlt("Atrial fibrillation or flutter") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Cancer within 5 years" /> <?php echo xlt("Cancer within 5 years") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Chronic kidney disease (eGFR less than 60)" /> <?php echo xlt("Chronic kidney disease (eGFR less than 60)") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="COPD" /> <?php echo xlt("COPD") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Coronary artery disease" /> <?php echo xlt("Coronary artery disease") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Degenerative spine disease" /> <?php echo xlt("Degenerative spine disease") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Dementia" /> <?php echo xlt("Dementia") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Depression" /> <?php echo xlt("Depression") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Diabetes" /> <?php echo xlt("Diabetes") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Fall within the past year" /> <?php echo xlt("Fall within the past year") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Heart failure" /> <?php echo xlt("Heart failure") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Hypertension" /> <?php echo xlt("Hypertension") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Myocardial infarction" /> <?php echo xlt("Myocardial infarction") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Peripheral vascular disease" /> <?php echo xlt("Peripheral vascular disease") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="pmhx[]" value="Sensory impairment" /> <?php echo xlt("Sensory impairment") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Stroke or TIA" /> <?php echo xlt("Stroke or TIA") ?> </label></td>
<td><label><input type="checkbox" name="pmhx[]" value="Use of more than 5 prescription drugs" /> <?php echo xlt("Use of more than 5 prescription drugs") ?> </label></td>
</tr>

</table>
<br />
<h3> <?php echo xlt("Functional Status") ?> </h3>
<p> <?php echo xlt("Does the patient need help from another person to perform the following activities?") ?></p>
<table>
<tr>
<th>Activities of Daily Living</th>
<th>Independent Activities of Daily Living</th>
<th>Nagi & Rosow-Breslau Activities</th>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Feeding" /> <?php echo xlt("Feeding") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Using telephone" /> <?php echo xlt("Using telephone") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Pulling or pushing a large object" /> <?php echo xlt("Pulling or pushing a large object") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Dressing/undressing" /> <?php echo xlt("Dressing/undressing") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Using transportation" /> <?php echo xlt("Using transportation") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Stooping, crouching or kneeling" /> <?php echo xlt("Stooping, crouching or kneeling") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Grooming" /> <?php echo xlt("Grooming") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Shopping" /> <?php echo xlt("Shopping") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Lifting or carrying 10 lbs" /> <?php echo xlt("Lifting or carrying 10 lbs") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Walking (or use of a walker)" /> <?php echo xlt("Walking (or use of a walker)") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Preparing own meals" /> <?php echo xlt("Preparing own meals") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Reaching arms above shoulder" /> <?php echo xlt("Reaching arms above shoulder") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Getting in and out of bed" /> <?php echo xlt("Getting in and out of bed") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Housework" /> <?php echo xlt("Housework") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Writing or handling small objects" /> <?php echo xlt("Writing or handling small objects") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Toileting" /> <?php echo xlt("Toileting") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Taking own medications" /> <?php echo xlt("Taking own medications") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Walking up/dn a flight of stairs" /> <?php echo xlt("Walking up/dn a flight of stairs") ?> </label></td>
</tr>

<tr>
<td><label><input type="checkbox" name="fx[]" value="Bathing or shower" /> <?php echo xlt("Bathing or shower") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Managing money" /> <?php echo xlt("Managing money") ?> </label></td>
<td><label><input type="checkbox" name="fx[]" value="Walking half a mile" /> <?php echo xlt("Walking half a mile") ?> </label></td>
</tr>

<tr>
<td></td>
<td></td>
<td><label><input type="checkbox" name="fx[]" value="Heavy work around house" /> <?php echo xlt("Heavy work around house") ?> </label></td>
</tr>

</table>
<br />
<h3> <?php echo xlt("Performance Tests") ?> </h3>
<br />
<h4> <?php echo xlt("Mental State Examination") ?> </h4>
<p> <?php echo xlt("Choose one test and enter the score") ?> </p>

<table>

<tr><td> <?php echo xlt("MMSE") ?> </td> <td><input type="text" name="mmse"  /></td></tr>
<tr><td> <?php echo xlt("MoCA") ?> </td> <td><input type="text" name="moca"  /></td></tr>
<tr><td> <?php echo xlt("Mini-Cog") ?> </td> <td><input type="text" name="mini_cog"  /></td></tr>

</table>

<br />
<h4> <?php echo xlt("Gait Speed") ?> </h4>
<p> <?php echo xlt("(in meters per second)") ?> </p>

<table>

<tr><td><input type="text" name="gait_speed"  /></td></tr>

</table>
<br />
<h4> <?php echo xlt("5 Repeated Chair Stands") ?> </h4>
<p> <?php echo xlt("(in seconds)") ?> </p>

<table>

<tr><td><input type="text" name="chair_stands"  /></td></tr>

</table>
<br />
<h4> <?php echo xlt("Dominant Handgrip Strength") ?> </h4>
<p> <?php echo xlt("(in kg)") ?> </p>
<table>

<tr><td><input type="text" name="grip_strength"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Nutritional Status") ?> </h3>

<table>

<tr><td> <?php echo xlt("Weight loss > 10 lbs in past year") ?> </td> <td><label><input type="radio" name="weight_loss" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="weight_loss" value="no" /> <?php echo xlt("no") ?> </label></td></tr>
<tr><td> <?php echo xlt("BMI < 21 kg/m2") ?> </td> <td><label><input type="radio" name="bmi" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="bmi" value="no" /> <?php echo xlt("no") ?> </label></td></tr>
<tr><td> <?php echo xlt("Serum albumin < 3.5 gm/L") ?> </td> <td><label><input type="radio" name="albumin" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="albumin" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>

<table>

<tr><td><input type="hidden" name="score"  /></td></tr>

</table>
<table></table><input type="submit" name="submit form" value="submit form" />
</form>
<a href='<?php echo $GLOBALS['form_exit_url']; ?>' onclick='top.restoreSession()'> <?php echo xlt("[do not save]") ?> </a>
<?php
formFooter();
?>
