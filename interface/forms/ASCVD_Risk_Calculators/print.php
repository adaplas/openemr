<?php

/**
 * ASCVD Risk Calculator print.php
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

formHeader("Form: ASCVD Risk Calculator");
?>
<html><head>
<?php Header::setupHeader('datetime-picker'); ?>
</head>
<body <?php echo $top_bg_line;?> topmargin=0 rightmargin=0 leftmargin=2 bottommargin=0 marginwidth=2 marginheight=0>
<form method=post action="<?php echo $rootdir;?>/forms/ASCVD_Risk_Calculators/save.php?mode=new" name="my_form" onsubmit="return top.restoreSession()">
<input type="hidden" name="csrf_token_form" value="<?php echo attr(CsrfUtils::collectCsrfToken()); ?>" />
<h1> ASCVD Risk Calculators </h1>
<hr>
<input type="submit" name="submit form" value="submit form" /><br />
<br />
<h3> <?php echo xlt("Age (years)") ?> </h3>

<table>

<tr><td> <?php echo xlt("Age") ?> </td> <td><input type="text" name="age"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Sex") ?> </h3>

<table>

<tr><td> <?php echo xlt("Sex") ?> </td> <td><label><input type="radio" name="sex" value="male" /> <?php echo xlt("male") ?> </label> <label><input type="radio" name="sex" value="female" /> <?php echo xlt("female") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Race") ?> </h3>

<table>

<tr><td> <?php echo xlt("Race") ?> </td> <td><select name="race"  size="5">
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

<tr><td> <?php echo xlt("Sbp") ?> </td> <td><input type="text" name="sbp"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Body Mass Index (mm/kg2)") ?> </h3>

<table>

<tr><td> <?php echo xlt("Bmi") ?> </td> <td><input type="text" name="bmi"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("HDL (mg/dL)") ?> </h3>

<table>

<tr><td> <?php echo xlt("Hdl") ?> </td> <td><input type="text" name="hdl"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Total Cholesterol (mg/dL)") ?> </h3>

<table>

<tr><td> <?php echo xlt("Tot chol") ?> </td> <td><input type="text" name="tot_chol"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Blood Pressure Medications") ?> </h3>

<table>

<tr><td> <?php echo xlt("Bp med") ?> </td> <td><label><input type="radio" name="bp_med" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="bp_med" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Smoking") ?> </h3>

<table>

<tr><td> <?php echo xlt("Smoking") ?> </td> <td><label><input type="radio" name="smoking" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="smoking" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Diabetes") ?> </h3>

<table>

<tr><td> <?php echo xlt("Diabetes") ?> </td> <td><label><input type="radio" name="diabetes" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="diabetes" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Lipid Medications") ?> </h3>

<table>

<tr><td> <?php echo xlt("Lipid med") ?> </td> <td><label><input type="radio" name="lipid_med" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="lipid_med" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Family History of Heart Attacks") ?> </h3>

<table>

<tr><td> <?php echo xlt("Fh heartattack") ?> </td> <td><label><input type="radio" name="fh_heartattack" value="yes" /> <?php echo xlt("yes") ?> </label> <label><input type="radio" name="fh_heartattack" value="no" /> <?php echo xlt("no") ?> </label></td></tr>

</table>
<br />
<h3> <?php echo xlt("Coronary Artery Calcification (Agatston)") ?> </h3>

<table>

<tr><td> <?php echo xlt("Cac") ?> </td> <td><input type="text" name="cac"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("ACC/AHA 2013 ASCVD Risk Score") ?> </h3>

<table>

<tr><td> <?php echo xlt("10y accaha") ?> </td> <td><input type="text" name="10y_accaha"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Framingham 2008 Risk Score") ?> </h3>

<table>

<tr><td> <?php echo xlt("10y frs") ?> </td> <td><input type="text" name="10y_frs"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("Framingham 200 Risk Score (no labs)") ?> </h3>

<table>

<tr><td> <?php echo xlt("10y frs simple") ?> </td> <td><input type="text" name="10y_frs_simple"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("MESA 2015 CVD Risk Score") ?> </h3>

<table>

<tr><td> <?php echo xlt("10y mesa") ?> </td> <td><input type="text" name="10y_mesa"  /></td></tr>

</table>
<br />
<h3> <?php echo xlt("MESA 2015 Risk Score with CAC") ?> </he>

<table>

<tr><td> <?php echo xlt("10y mesa cac") ?> </td> <td><input type="text" name="10y_mesa_cac"  /></td></tr>

</table>
<table></table><input type="submit" name="submit form" value="submit form" />
</form>
<?php
formFooter();
?>
