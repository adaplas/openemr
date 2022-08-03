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
<form method=post action="<?php echo $rootdir;?>/forms/senior_health_calculator/save.php?mode=new" name="my_form" onsubmit="return top.restoreSession()">
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<h1> senior_health_calculator </h1>
<hr>
<input type="submit" name="submit form" value="submit form" /><br />
<br />
<h3> <?php echo xlt("Medical History") ?> </h3>

<table>

<tr><td> <?php echo xlt("Pmhx") ?> </td> <td><label><input type="checkbox" name="pmhx[]" value="Angina" /> <?php echo xlt("Angina") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Anxiety disorder" /> <?php echo xlt("Anxiety disorder") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Arthritis" /> <?php echo xlt("Arthritis") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Asthma" /> <?php echo xlt("Asthma") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Atrial fibrillation or flutter" /> <?php echo xlt("Atrial fibrillation or flutter") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Cancer within 5 years" /> <?php echo xlt("Cancer within 5 years") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Chronic kidney disease (eGFR less than 60)" /> <?php echo xlt("Chronic kidney disease (eGFR less than 60)") ?> </label> <label><input type="checkbox" name="pmhx[]" value="COPD" /> <?php echo xlt("COPD") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Coronary artery disease" /> <?php echo xlt("Coronary artery disease") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Degenerative spine disease" /> <?php echo xlt("Degenerative spine disease") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Dementia" /> <?php echo xlt("Dementia") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Depression" /> <?php echo xlt("Depression") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Diabetes" /> <?php echo xlt("Diabetes") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Fall within the past year" /> <?php echo xlt("Fall within the past year") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Heart failure" /> <?php echo xlt("Heart failure") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Hypertension" /> <?php echo xlt("Hypertension") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Myocardial infarction" /> <?php echo xlt("Myocardial infarction") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Peripheral vascular disease" /> <?php echo xlt("Peripheral vascular disease") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Sensory impairment" /> <?php echo xlt("Sensory impairment") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Stroke or TIA" /> <?php echo xlt("Stroke or TIA") ?> </label> <label><input type="checkbox" name="pmhx[]" value="Use of more than 5 prescription drugs" /> <?php echo xlt("Use of more than 5 prescription drugs") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Functional Status") ?> </h3>

<table>

<tr><td> <?php echo xlt("Fx") ?> </td> <td><label><input type="checkbox" name="fx[]" value="Feeding" /> <?php echo xlt("Feeding") ?> </label> <label><input type="checkbox" name="fx[]" value="Using telephone" /> <?php echo xlt("Using telephone") ?> </label> <label><input type="checkbox" name="fx[]" value="Pulling or pushing a large object" /> <?php echo xlt("Pulling or pushing a large object") ?> </label> <label><input type="checkbox" name="fx[]" value="Dressing/undressing" /> <?php echo xlt("Dressing/undressing") ?> </label> <label><input type="checkbox" name="fx[]" value="Using transportation" /> <?php echo xlt("Using transportation") ?> </label> <label><input type="checkbox" name="fx[]" value="Stooping, crouching or kneeling" /> <?php echo xlt("Stooping, crouching or kneeling") ?> </label> <label><input type="checkbox" name="fx[]" value="Grooming" /> <?php echo xlt("Grooming") ?> </label> <label><input type="checkbox" name="fx[]" value="Shopping" /> <?php echo xlt("Shopping") ?> </label> <label><input type="checkbox" name="fx[]" value="Lifting or carrying 10 lbs" /> <?php echo xlt("Lifting or carrying 10 lbs") ?> </label> <label><input type="checkbox" name="fx[]" value="Walking (or use of a walker)" /> <?php echo xlt("Walking (or use of a walker)") ?> </label> <label><input type="checkbox" name="fx[]" value="Preparing own meals" /> <?php echo xlt("Preparing own meals") ?> </label> <label><input type="checkbox" name="fx[]" value="Reaching arms above shoulder" /> <?php echo xlt("Reaching arms above shoulder") ?> </label> <label><input type="checkbox" name="fx[]" value="Getting in and out of bed" /> <?php echo xlt("Getting in and out of bed") ?> </label> <label><input type="checkbox" name="fx[]" value="Housework" /> <?php echo xlt("Housework") ?> </label> <label><input type="checkbox" name="fx[]" value="Writing or handling small objects" /> <?php echo xlt("Writing or handling small objects") ?> </label> <label><input type="checkbox" name="fx[]" value="Toileting" /> <?php echo xlt("Toileting") ?> </label> <label><input type="checkbox" name="fx[]" value="Taking own medications" /> <?php echo xlt("Taking own medications") ?> </label> <label><input type="checkbox" name="fx[]" value="Walking up/dn a flight of stairs" /> <?php echo xlt("Walking up/dn a flight of stairs") ?> </label> <label><input type="checkbox" name="fx[]" value="Bathing or shower" /> <?php echo xlt("Bathing or shower") ?> </label> <label><input type="checkbox" name="fx[]" value="Managing money" /> <?php echo xlt("Managing money") ?> </label> <label><input type="checkbox" name="fx[]" value="Walking half a mile" /> <?php echo xlt("Walking half a mile") ?> </label> <label><input type="checkbox" name="fx[]" value="Heavy work around house" /> <?php echo xlt("Heavy work around house") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Performance Tests") ?> </h3>
<br />
<h4> <?php echo xlt("Mental State Examination") ?> </h4>

<table>

<tr><td> <?php echo xlt("Mmse") ?> </td> <td><input type="text" name="mmse"  /></td></tr>

</table>

<table>

<tr><td> <?php echo xlt("Moca") ?> </td> <td><input type="text" name="moca"  /></td></tr>

</table>

<table>

<tr><td> <?php echo xlt("Mini cog") ?> </td> <td><input type="text" name="mini_cog"  /></td></tr>

</table>
<br />
<h4> <?php echo xlt("Gait Speed") ?> </h4>

<table>

<tr><td> <?php echo xlt("Gait speed") ?> </td> <td><input type="text" name="gait_speed"  /></td></tr>

</table>
<br />
<h4> <?php echo xlt("5 Repeated Chair Stands") ?> </h4>

<table>

<tr><td> <?php echo xlt("Chair stands") ?> </td> <td><input type="text" name="chair_stands"  /></td></tr>

</table>
<br />
<h4> <?php echo xlt("Dominant Handgrip Strength") ?> </hr>

<table>

<tr><td> <?php echo xlt("Grip strength") ?> </td> <td><input type="text" name="grip_strength"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Nutritional Status") ?> </h3>

<table>

<tr><td> <?php echo xlt("Weight loss") ?> </td> <td><label><input type="radio" name="weight_loss" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="weight_loss" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>

<table>

<tr><td> <?php echo xlt("Bmi") ?> </td> <td><label><input type="radio" name="bmi" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="bmi" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>

<table>

<tr><td> <?php echo xlt("Albumin") ?> </td> <td><label><input type="radio" name="albumin" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="albumin" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>

<table>

<tr><td> <?php echo xlt("Score") ?> </td> <td><input type="text" name="score"  /></td></tr>

</table>
<table></table><input type="submit" name="submit form" value="submit form" />
</form>
<?php
formFooter();
?>
