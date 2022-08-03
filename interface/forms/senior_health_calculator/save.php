<?php
/**
 * Senior Health Calculator save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Antonino Daplas <adaplas@gmail.com>
 * @copyright Copyright (c) 2022 Antonino Daplas <adaplas@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

use OpenEMR\Common\Csrf\CsrfUtils;

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}

function cga_fi_score($field_names)
{
	$ms = 0;
	$total = 43;
	$score = substr_count($field_names["pmhx"], ',') + substr_count($field_names["pmhx"], '.');
	$score += substr_count($field_names["fx"], ',') + substr_count($field_names["fx"], '.');

	if (isset($field_names["mmse"]) && $field_names["mmse"] != NULL && $field_names["mmse"] >= 0 && $field_names["mmse"] <= 30) {
		$mmse = $field_names["mmse"];
		if ($mmse <= 21)
			$score += 1.0;
		else if ($mmse <=  24)
			$score += 0.7;
		else if ($mmse <= 27)
			$score += 0.3;
		$ms = 1;
		$total++;
	}

	if (!$ms && isset($field_names["moca"]) && $field_names["moca"] != NULL && $field_names["moca"] >= 0 && $field_names["moca"] <= 30) {
		$moca = $field_names["moca"];
		if ($moca <= 15)
			$score += 1.0;
		else if ($moca <= 20)
			$score += 0.7;
		else if ($moca <= 25)
			$score += 0.3;
		$ms = 1;
		$total++;
	}

	if (!$ms &&isset($field_names["mini_cog"]) && $field_names["mini_cog"] != NULL && $field_names["mini_cog"] >= 0 && $field_names["mini_cog"] <= 5) {
		$mcog = $field_names["mini_cog"];
		if ($mcog <= 3)
			$score += 1.0;
		else if ($mcog <= 4)
			$score += 0.5;
		$ms = 1;
		$total++;
	}

	if (isset($field_names["gait_speed"]) && $field_names["gait_speed"] != NULL) {
		$gait_speed = $field_names["gait_speed"];
		if ($gait_speed <= 0.6)
			$score += 1;
		else if ($gait_speed <= 0.8)
			$score += 0.7;
		else if ($gait_speed <= 1)
			$score += 0.3;

		$total++;
	}

	if (isset($field_names["chair_stands"]) && $field_names["chair_stands"] != NULL) {
		$chair_stands = $field_names["chair_stands"];
		if ($chair_stands >= 61)
			$score += 1;
		else if ($chair_stands >= 16.7)
			$score += 0.75;
		else if ($chair_stands >= 13.7)
			$score += 0.5;
		else if ($chair_stands >= 11.2)
			$score += 0.25;

		$total++;
	}

	if (isset($field_names["grip_strength"]) && $field_names["grip_strength"] != NULL) {
		$grip_strength = $field_names["grip_strength"];
		if ($grip_strength <= 26)
			$score += 1;
		else if ($grip_strength <= 32)
			$score += 0.5;

		$total++;
	}


	if (isset($field_names["weight_loss"]) && $field_names["weight_loss"] == "yes") {
		$score++;
		$total++;
	}

	if (isset($field_names["bmi"]) && $field_names["bmi"] == "yes") {
		$score++;
		$total++;
	}

	if (isset($field_names["albumin"]) && $field_names["albumin"] == "yes") {
		$score++;
		$total++;
	}

	$score /= $total;
	$score = round($score, 3);

	if ($score < 0.15)
		$score .= " - Robust";
	else if ($score < 0.25)
		$score .= " - Pre-frailty";
	else if ($score < 0.35)
		$score .= " - Mild Frailty";
	else if ($score < 0.45)
		$score .= " - Moderate Frailty";
	else if ($score < 0.55)
		$score .= " - Severe Frailty";
	else
		$score .= " - Advanced Frailty";

	return $score;
}

//process form variables here
//create an array of all of the existing field names
$field_names = array('pmhx' => 'checkbox_group','fx' => 'checkbox_group','mmse' => 'textfield','moca' => 'textfield','mini_cog' => 'textfield','gait_speed' => 'textfield','chair_stands' => 'textfield','grip_strength' => 'textfield','weight_loss' => 'radio_group','bmi' => 'radio_group','albumin' => 'radio_group','score' => 'textfield');
$negatives = array();
//process each field according to it's type
foreach($field_names as $key=>$val)
{
  $pos = '';
  $neg = '';
	if ($val == "checkbox")
	{
		if (isset($_POST[$key]) && $_POST[$key]) {$field_names[$key] = "yes";}
		else {$field_names[$key] = "negative";}
	}
	elseif (($val == "checkbox_group")||($val == "scrolling_list_multiples"))
	{
		if (array_key_exists($key,$negatives)) #a field requests reporting of negatives
		{
                  if ($_POST[$key])
                  {
			foreach($_POST[$key] as $var) #check positives against list
			{
				if (array_key_exists($var, $negatives[$key]))
				{	#remove positives from list, leaving negatives
					unset($negatives[$key][$var]);
				}
			}
                  }
			if (is_array($negatives[$key]) && count($negatives[$key])>0)
			{
				$neg = "Negative for ".implode(', ',$negatives[$key]).'.';
			}
		}
		if (isset($_POST[$key]) && is_array($_POST[$key]) && count($_POST[$key])>0)
		{
			$pos = implode(', ',$_POST[$key]);
		}
		if($pos) {$pos = 'Positive for '.$pos.'.  ';}
		$field_names[$key] = $pos.$neg;
	}
	else
	{
		if (isset($_POST[$key]))
			$field_names[$key] = $_POST[$key];
		else
			$field_names[$key] = '';
	}
        if (isset($field_names[$key]) && $field_names[$key] != '')
        {
//          $field_names[$key] .= '.';
          $field_names[$key] = preg_replace('/\s*,\s*([^,]+)\./',', and $1.',$field_names[$key]); // replace last comma with 'and' and ending period
        }
}

$field_names["score"] = cga_fi_score($field_names);

//end special processing
foreach ($field_names as $k => $var) {
  #if (strtolower($k) == strtolower($var)) {unset($field_names[$k]);}
  $field_names[$k] = $var;
echo "$var\n";
}
if ($encounter == "")
$encounter = date("Ymd");
if ($_GET["mode"] == "new"){
reset($field_names);
$newid = formSubmit("form_senior_health_calculator", $field_names, $_GET["id"], $userauthorized);
addForm($encounter, "Senior Health Calculator", $newid, "senior_health_calculator", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlStatement("update form_senior_health_calculator set pid = '" . add_escape_custom($_SESSION["pid"]) . "', groupname='" . add_escape_custom($_SESSION["authProvider"]) . "', user='" . add_escape_custom($_SESSION["authUser"]) . "', authorized='" . add_escape_custom($userauthorized) . "', activity=1, date = NOW(), pmhx='".$field_names["pmhx"]."',fx='".$field_names["fx"]."',mmse='".$field_names["mmse"]."',moca='".$field_names["moca"]."',mini_cog='".$field_names["mini_cog"]."',gait_speed='".$field_names["gait_speed"]."',chair_stands='".$field_names["chair_stands"]."',grip_strength='".$field_names["grip_strength"]."',weight_loss='".$field_names["weight_loss"]."',bmi='".$field_names["bmi"]."',albumin='".$field_names["albumin"]."',score='".$field_names["score"]."' where id='" . $_GET["id"] . "'");
}

formHeader("Redirecting....");
formJump();
formFooter();
?>
