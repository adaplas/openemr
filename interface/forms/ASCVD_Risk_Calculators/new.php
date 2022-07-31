<?php
require_once("../../globals.php");
require_once("$srcdir/api.inc");

use OpenEMR\Common\Csrf\CsrfUtils;
use OpenEMR\Core\Header;

formHeader("Form: ASCVD Risk Calculator");
?>
<html><head>
<?php Header::setupHeader('datetime-picker'); ?>
</head>
<body <?php echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>

<form method=post action="<?php echo $rootdir;?>/forms/ASCVD_Risk_Calculators/save.php?mode=new" name="ASCVD Risk Calculators" onsubmit="return top.restoreSession()">
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />

<style>
h3 {
	font-size: 20px;
}
</style>

<hr>
<h1> <?php echo xlt("ASCVD Risk Calculator") ?> </h1>
<hr>
<input type="submit" name="Save" value="Save" />
<a href='<?php echo $GLOBALS['form_exit_url']; ?>' onclick='top.restoreSession()'> <?php echo xlt("[Discard]") ?> </a><br />
<br />
<h3> <?php echo xlt("Age (years)") ?> </h3>

<table>

<tr><td><input type="text" name="age"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Sex") ?> </h3>

<table>

<tr> <td><label><input type="radio" name="sex" value="male" /> <?php echo xlt("male") ?> </label> <label><input type="radio" name="sex" value="female" /> <?php echo xlt("female") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Race") ?> </h3>

<table>

<tr><td>select name="race"  size="5">
<option value="white"> <?php echo xlt("white") ?> </option>
<option value="african american"> <?php echo xlt("african american") ?> </option>
<option value="chinese"> <?php echo xlt("chinese") ?> </option>
<option value="hispanic"> <?php echo xlt("hispanic") ?> </option>
<option value="other"> <?php echo xlt("other") ?> </option>
</select></td></tr>

</table>
<br />
<h3> <?php echo xlt("Systolic Blood Pressure (mm/Hg)") ?> </h3>

<table>

<tr><td><input type="text" name="sbp"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Body Mass Index (mm/kg2)") ?> </h3>

<table>

<tr><td><input type="text" name="bmi"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("HDL (mg/dL)") ?> </h3>

<table>

<tr><td><input type="text" name="hdl"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Total Cholesterol (mg/dL)") ?> </h3>

<table>

<tr><td><input type="text" name="tot_chol"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Blood Pressure Medications") ?> </h3>

<table>

<tr><td><label><input type="radio" name="bp_med" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="bp_med" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Smoking") ?> </h3>

<table>

<tr><td><label><input type="radio" name="smoking" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="smoking" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Diabetes") ?> </h3>

<table>

<tr><td><label><input type="radio" name="diabetes" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="diabetes" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Lipid Medications") ?> </h3>

<table>

<tr><td><label><input type="radio" name="lipid_med" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="lipid_med" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Family History of Heart Attacks") ?> </h3>

<table>

<tr><td><label><input type="radio" name="fh_heartattack" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="fh_heartattack" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>

<table>
<br />
<h3> <?php echo xlt("Coronary Artery Calcification (Agatston)") ?> </h3>
</table>

<table>
<tr><td><input type="text" name="cac"  /></td></tr>
</table>

<tr><td><input type="hidden" name="10y_accaha"  /></td></tr>
<tr><td><input type="hidden" name="10y_frs"  /></td></tr>
<tr><td><input type="hidden" name="10y_frs_simple"  /></td></tr>
<tr><td><input type="hidden" name="10y_mesa"  /></td></tr>
<tr><td><input type="hidden" name="10y_mesa_cac"  /></td></tr>

<table></table><input type="submit" name="Save" value="Save" />
</form>
<a href='<?php echo $GLOBALS['form_exit_url']; ?>' onclick='top.restoreSession()'> <?php echo xlt("[Discard]") ?> </a>
<?php
formFooter();
?>


