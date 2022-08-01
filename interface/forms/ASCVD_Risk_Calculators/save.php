<?php

/**
 * ASCVD Risk Calculator save.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Antonino Daplas <adaplas@gmail.com>
 * @copyright Copyright (c) 2022 Antonino Daplas <adaplas@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

//------------This file inserts your field data into the MySQL database
require_once("../../globals.php");
require_once("$srcdir/api.inc");
require_once("$srcdir/forms.inc");

use OpenEMR\Common\Csrf\CsrfUtils;

const PARAM_DIABETES       = 1;
const PARAM_TOT_CHOL       = 2;
const PARAM_HDL            = 4;
const PARAM_SBP            = 8;
const PARAM_SMOKING        = 16;
const PARAM_BP_MED         = 32;
const PARAM_LIPID_MED      = 64;
const PARAM_RACE           = 128;
const PARAM_BMI            = 256;
const PARAM_CAC            = 512;
const PARAM_FH_HEARTATTACK = 1024;
const PARAM_AGE            = 2048;
const PARAM_SEX            = 4096;

function check_params($params, $field_names)
{
	$error = 0;

	if ($params & PARAM_AGE && $field_names["age"] == NULL)
		$error |= PARAM_AGE;

	if ($params & PARAM_SEX && $field_names["sex"] == NULL)
		$error |= PARAM_SEX;

	if ($params & PARAM_RACE && $field_names["race"] == NULL)
		$error |= PARAM_RACE;

	if ($params & PARAM_DIABETES && $field_names["diabetes"] == NULL)
		$error |= PARAM_DIABETES;

	if ($params & PARAM_TOT_CHOL && $field_names["tot_chol"] == NULL)
		$error |= PARAM_TOT_CHOL;

	if ($params & PARAM_HDL && $field_names["hdl"] == NULL)
		$error |= PARAM_HDL;

	if ($params & PARAM_SBP && $field_names["sbp"] == NULL)
		$error |= PARAM_SBP;

	if ($params & PARAM_SMOKING && $field_names["smoking"] == NULL)
		$error |= PARAM_SMOKING;

	if ($params & PARAM_BP_MED && $field_names["bp_med"] == NULL)
		$error |= PARAM_BP_MED;

	if ($params & PARAM_LIPID_MED && $field_names["lipid_med"] == NULL)
		$error |= PARAM_LIPID_MED;

	if ($params & PARAM_BMI && $field_names["bmi"] == NULL)
		$error |= PARAM_BMI;

	if ($params & PARAM_CAC && $field_names["cac"] == NULL)
		$error |= PARAM_CAC;

	if ($params & PARAM_FH_HEARTATTACK && $field_names["fh_heartattack"] == NULL)
		$error |= PARAM_FH_HEARTATTACK;

	return $error;
}

function return_error($error_code)
{
	$error_string = 'Missing ';

	if ($error_code & PARAM_AGE)
		$error_string .= "Age, ";
	if ($error_code & PARAM_SEX)
		$error_string .= "Sex, ";
	if ($error_code & PARAM_RACE)
		$error_string .= "Race, ";
	if ($error_code & PARAM_DIABETES)
		$error_string .= "Diabetes, ";
	if ($error_code & PARAM_TOT_CHOL)
		$error_string .= "Total Cholesterol, ";
	if ($error_code & PARAM_HDL)
		$error_string .= "HDL, ";
	if ($error_code & PARAM_SBP)
		$error_string .= "Systolic BP, ";
	if ($error_code & PARAM_SMOKING)
		$error_string .= "Smoking, ";
	if ($error_code & PARAM_BP_MED)
		$error_string .= "BP Medications, ";
	if ($error_code & PARAM_LIPID_MED)
		$error_string .= "Lipid Medications/Statins, ";
	if ($error_code & PARAM_BMI)
		$error_string .= "BMI, ";
	if ($error_code & PARAM_CAC)
		$error_string .= "Coronory Artery Calcification, ";
	if ($error_code & PARAM_FH_HEARTATTACK)
		$error_string .= "Family History of Heart Attacks, ";

	return rtrim($error_string, ", ");
}

// David C. GoffJr, Donald M. Lloyd-Jones, et al.2013 ACC/AHA Guideline on the Assessment of Cardiovascular Risk:
// A Report of the American College of Cardiology/American Heart Association Task Force on Practice Guidelines.
// Circulation. 2014 | Volume 129, Issue 25_suppl_2: S1–S45.
function accaha_10y($field_names)
{
	$params = PARAM_AGE | PARAM_SEX | PARAM_RACE | PARAM_TOT_CHOL | PARAM_HDL | PARAM_SBP | PARAM_SMOKING |
		  PARAM_DIABETES | PARAM_BP_MED;

	$error_code = check_params($params, $field_names);
	if ($error_code)
		return return_error($error_code);

	$age = $field_names["age"];
	if ($age < 20 || $age > 79)
		return "Age=20-79";

	$tot_chol = $field_names["tot_chol"];
	if ($tot_chol < 130 || $tot_chol > 320)
		return "Total Cholesterol = 130-120 mg/dL";

	$hdl = $field_names["hdl"];
	if ($hdl < 20 || $hdl > 100)
		return "HDL = 20-100 mg/dL";

	$sbp = $field_names["sbp"];
	if ($sbp < 90 || $sbp > 200)
		return "Systolic BP = 90-200 mmHg";

	$smoking = $field_names["smoking"];
	$diabetes = $field_names["diabetes"];
	$bp_med = $field_names["bp_med"];
	$sex = $field_names["sex"];

	$ascvd_pooled_coef = array(
		array(-29.799, 4.884, 13.540, -3.114, -13.578, 3.149, 2.019, 0.000, 1.957,
		 0.000, 7.574, -1.665, 0.661, -29.18, 0.9665), // white-female
		array(17.114, 0.000, 0.940, 0.000, -18.920, 4.475, 29.291, -6.432, 27.820,
		 -6.087, 0.691, 0.000, 0.874, 86.61, 0.9533),  // aa-female
		array(12.344, 0.000, 11.853, -2.664, -7.990, 1.769, 1.797, 0.000, 1.764,
		0.000, 7.837, -1.795, 0.658, 61.18, 0.9144),    // white-male
		array(2.469, 0.000, 0.302, 0.000, -0.307, 0.000, 1.916, 0.000, 1.809, 0.000,
		 0.549, 0.000, 0.645, 19.54, 0.8954)         // aa-male
	);

	$race = $field_names["race"];
	if ($race == "african american") {
		if ($sex == "female")
			$idx = 1;
		else
			$idx = 3;
	} else {
		if ($sex == "female")
			$idx = 0;
		else
			$idx = 2;
	}

	$sbp_treated = ($bp_med == "yes") ? $sbp : 1;
	$sbp_untreated = ($bp_med == "no") ? $sbp : 1;

	$sum = log($age) * $ascvd_pooled_coef[$idx][0];
	$sum += pow(log($age), 2) * $ascvd_pooled_coef[$idx][1];
	$sum += log($tot_chol) * $ascvd_pooled_coef[$idx][2];
	$sum += log($age) * log($tot_chol) * $ascvd_pooled_coef[$idx][3];
	$sum += log($hdl) * $ascvd_pooled_coef[$idx][4];
	$sum += log($age) * log($hdl) * $ascvd_pooled_coef[$idx][5];
	$sum += log($sbp_treated) * $ascvd_pooled_coef[$idx][6];
	$sum += log($sbp_treated) * log($age) * $ascvd_pooled_coef[$idx][7];
	$sum += log($sbp_untreated) * $ascvd_pooled_coef[$idx][8];
	$sum += log($sbp_untreated) * log($age) * $ascvd_pooled_coef[$idx][9];
	$sum += (($smoking == "yes") ? 1 : 0) * $ascvd_pooled_coef[$idx][10];
	$sum += (($smoking == "yes") ? 1 : 0) * log($age) *  $ascvd_pooled_coef[$idx][11];
	$sum += (($diabetes == "yes") ? 1 : 0) * $ascvd_pooled_coef[$idx][12];

	$exponent = exp($sum - $ascvd_pooled_coef[$idx][13]);

	$risk_score = round((1 - pow($ascvd_pooled_coef[$idx][14], $exponent)) * 100, 2);
	return ($risk_score < 1) ? 1.00 : $risk_score;
}

// D'Agostino RB Sr, Vasan RS, Pencina MJ, et al. General cardiovascular risk profile for use in primary care: the Framingham Heart Study. Circulation 2008; 117:743.
function frs_10y($field_names)
{
	$params = PARAM_AGE | PARAM_SEX | PARAM_TOT_CHOL | PARAM_HDL | PARAM_SBP | PARAM_SMOKING |
		  PARAM_DIABETES | PARAM_BP_MED;

	$error_code = check_params($params, $field_names);
	if ($error_code)
		return return_error($error_code);

	$age = $field_names["age"];
	if ($age < 30 || $age > 74)
		return "Age = 30-74";

	$sex = $field_names["sex"];
	$tot_chol = $field_names["tot_chol"];
	$hdl = $field_names["hdl"];
	$sbp = $field_names["sbp"];
	$smoking = $field_names["smoking"];
	$diabetes = $field_names["diabetes"];
	$bp_med = $field_names["bp_med"];

	$frs_coef = array(
		array(3.06117, 1.12370, -0.93263, 1.93303, 1.99881, 0.65451, 0.57367, 23.9802,
		 0.88936), //male
		array(2.32888, 1.20904, -0.70833, 2.76157, 2.82263, 0.52873, 0.69154, 26.1931,
		 0.95012)  //female
	);

	$idx = ($sex == "male") ? 0 : 1;
	$sbp_treated = ($bp_med == "yes") ? $sbp : 1;
	$sbp_untreated = ($bp_med == "no") ? $sbp : 1;

	$sum = log($age) * $frs_coef[$idx][0];
	$sum += log($tot_chol) * $frs_coef[$idx][1];
	$sum += log($hdl) * $frs_coef[$idx][2];
	$sum += log($sbp_untreated) * $frs_coef[$idx][3];
	$sum += log($sbp_treated) * $frs_coef[$idx][4];
	$sum += (($smoking == "yes") ? 1 : 0) * $frs_coef[$idx][5];
	$sum += (($diabetes == "yes") ? 1 : 0) * $frs_coef[$idx][6];

	$exponent = exp($sum - $frs_coef[$idx][7]);
	$risk_score = round((1 - pow($frs_coef[$idx][8], $exponent)) * 100, 2);
	return ($risk_score < 1) ? 1.00 : $risk_score;
}

// D'Agostino RB Sr, Vasan RS, Pencina MJ, et al. General cardiovascular risk profile for use in primary care: the Framingham Heart Study. Circulation 2008; 117:743.
function frs_10y_simple($field_names)
{
	$params = PARAM_AGE | PARAM_SEX | PARAM_BMI | PARAM_SBP | PARAM_SMOKING |
		  PARAM_DIABETES | PARAM_BP_MED;

	$error_code = check_params($params, $field_names);
	if ($error_code)
		return return_error($error_code);

	$age = $field_names["age"];
	if ($age < 30 || $age > 74)
		return "Age = 30-74";

	$sex = $field_names["sex"];
	$bmi = $field_names["bmi"];
	$sbp = $field_names["sbp"];
	$smoking = $field_names["smoking"];
	$diabetes = $field_names["diabetes"];
	$bp_med = $field_names["bp_med"];

	$frs_coef_simple = array(
		array(3.11296, 0.79277, 1.85508, 1.92672, 0.70953, 0.53160, 23.9388,
		 0.88431), //male
		array(2.72107, 0.51125, 2.81291, 2.88267, 0.61868, 0.77763, 26.0145,
		 0.94833)  //female
	);

	$idx = ($sex == "male") ? 0 : 1;
	$sbp_treated = ($bp_med == "yes") ? $sbp : 1;
	$sbp_untreated = ($bp_med == "no") ? $sbp : 1;

	$sum = log($age) * $frs_coef_simple[$idx][0];
	$sum += log($bmi) * $frs_coef_simple[$idx][1];
	$sum += log($sbp_untreated) * $frs_coef_simple[$idx][2];
	$sum += log($sbp_treated) * $frs_coef_simple[$idx][3];
	$sum += (($smoking == "yes") ? 1 : 0) * $frs_coef_simple[$idx][4];
	$sum += (($diabetes == "yes") ? 1 : 0) * $frs_coef_simple[$idx][5];

	$exponent = exp($sum - $frs_coef_simple[$idx][6]);
	$risk_score = round((1 - pow($frs_coef_simple[$idx][7], $exponent)) * 100, 2);
	return ($risk_score < 1) ? 1.00 : $risk_score;
}

// Sytkowski PA, Kannel WB, D'agostino RB. Changes in risk factors and the decline in mortality
// from cardiovascular disease. The Framingham Heart Study. N Engl J Med. 1990;322(23):1635-41.  
function frs_10y_simple($field_names)
{
	return 0;
}

// Robyn L. McClelland, PhD; Neal W. Jorgensen, MS; et al. 10-Year Coronary Heart Disease Risk Prediction Using
// Coronary Artery Calcium and Traditional Risk Factors: Derivation in the MESA (Multi-Ethnic Study of Atherosclerosis)
// With Validation in the HNR (Heinz Nixdorf Recall) Study and the DHS (Dallas Heart Study).
// J Am Coll Cardiol. 2015 Oct 13;66(15):1643-53.
function mesa_10y($field_names)
{
	$params = PARAM_AGE | PARAM_SEX | PARAM_RACE | PARAM_TOT_CHOL | PARAM_HDL | PARAM_SBP | PARAM_SMOKING |
		  PARAM_DIABETES | PARAM_BP_MED | PARAM_LIPID_MED | PARAM_FH_HEARTATTACK;

	$error_code = check_params($params, $field_names);
	if ($error_code)
		return return_error($error_code);

	$race = $field_names["race"];
	if (!($race == "african american" || $race == "chinese" || $race == "hispanic"))
		return "Only for African American, Chinese or Hispanic Race/Ethnicity";

	$age = $field_names["age"];
	if ($age < 1 || $age > 120)
		return "Age = 1-120";

	$sex = $field_names["sex"];
	$tot_chol = $field_names["tot_chol"];
	$hdl = $field_names["hdl"];
	$diabetes = $field_names["diabetes"];
	$smoking = $field_names["smoking"];
	$lipid_med = $field_names["lipid_med"];
	$bp_med = $field_names["bp_med"];
	$fh_heartattack = $field_names["fh_heartattack"];
	$sbp = $field_names["sbp"];

	$mesa_coef = array(0.0455, 0.7496, -0.5055, -0.2111, -0.19, 0.5168, 0.4732, 0.0053,
	 -0.014, 0.2473, 0.0085, 0.3381, 0.4522, 0.99963);

	$race_chinese = ($race == "chinese") ? 1 : 0;
	$race_aa = ($race == "african american") ? 1 : 0;
	$race_hispanic = ($race == "hispanic") ? 1 : 0;
	$sex_male = ($sex == "male") ? 1 : 0;

	$sum = $age * $mesa_coef[0];
	$sum += $sex_male * $mesa_coef[1];
	$sum += $race_chinese * $mesa_coef[2];
	$sum += $race_aa * $mesa_coef[3];
	$sum += $race_hispanic * $mesa_coef[4];
	$sum += (($diabetes == "yes") ? 1 : 0) * $mesa_coef[5];
	$sum += (($smoking == "yes") ? 1 : 0) * $mesa_coef[6];
	$sum += $tot_chol * $mesa_coef[7];
	$sum += $hdl * $mesa_coef[8];
	$sum += (($lipid_med == "yes") ? 1 : 0) * $mesa_coef[9];
	$sum += $sbp * $mesa_coef[10];
	$sum += (($bp_med == "yes") ? 1 : 0) * $mesa_coef[11];
	$sum += (($fh_heartattack == "yes") ? 1 : 0) * $mesa_coef[12];

	$exponent = exp($sum);
	$risk_score = round((1 - pow($mesa_coef[13], $exponent)) * 100, 2);

	$risk_score = ($risk_score < 1) ? 1.00 : $risk_score;
	$risk_score = ($risk_score > 30) ? 30.00 : $risk_score;
	return $risk_score;
}

// Robyn L. McClelland, PhD; Neal W. Jorgensen, MS; et al. 10-Year Coronary Heart Disease Risk Prediction Using
// Coronary Artery Calcium and Traditional Risk Factors: Derivation in the MESA (Multi-Ethnic Study of Atherosclerosis)
// With Validation in the HNR (Heinz Nixdorf Recall) Study and the DHS (Dallas Heart Study).
// J Am Coll Cardiol. 2015 Oct 13;66(15):1643-53.
function mesa_10y_cac($field_names)
{
	$params = PARAM_AGE | PARAM_SEX | PARAM_RACE | PARAM_TOT_CHOL | PARAM_HDL | PARAM_SBP | PARAM_SMOKING |
		  PARAM_DIABETES | PARAM_BP_MED | PARAM_LIPID_MED | PARAM_FH_HEARTATTACK | PARAM_CAC;

	$error_code = check_params($params, $field_names);
	if ($error_code)
		return return_error($error_code);

	$race = $field_names["race"];
	if (!($race == "african american" || $race == "chinese" || $race == "hispanic"))
		return "Only for African American, Chinese or Hispanic Race/Ethnicity";

	$age = $field_names["age"];
	if ($age < 1 || $age > 120)
		return "Age = 1-120";

	$sex = $field_names["sex"];
	$tot_chol = $field_names["tot_chol"];
	$hdl = $field_names["hdl"];
	$diabetes = $field_names["diabetes"];
	$smoking = $field_names["smoking"];
	$lipid_med = $field_names["lipid_med"];
	$bp_med = $field_names["bp_med"];
	$fh_heartattack = $field_names["fh_heartattack"];
	$sbp = $field_names["sbp"];
	$cac = $field_names["cac"];

	$mesa_coef_cac = array(0.0172, 0.4079, -0.3475, 0.0353, -0.0222, 0.3892, 0.3717, 0.0043,
	 -0.0114, 0.1206, 0.0066, 0.2278, 0.3239, 0.2743, 0.99833);

	$race_chinese = ($race == "chinese") ? 1 : 0;
	$race_aa = ($race == "african american") ? 1 : 0;
	$race_hispanic = ($race == "hispanic") ? 1 : 0;
	$sex_male = ($sex == "male") ? 1 : 0;

	$sum = $age * $mesa_coef_cac[0];
	$sum += $sex_male * $mesa_coef_cac[1];
	$sum += $race_chinese * $mesa_coef_cac[2];
	$sum += $race_aa * $mesa_coef_cac[3];
	$sum += $race_hispanic * $mesa_coef_cac[4];
	$sum += (($diabetes == "yes") ? 1 : 0) * $mesa_coef_cac[5];
	$sum += (($smoking == "yes") ? 1 : 0) * $mesa_coef_cac[6];
	$sum += $tot_chol * $mesa_coef_cac[7];
	$sum += $hdl * $mesa_coef_cac[8];
	$sum += (($lipid_med == "yes") ? 1 : 0) * $mesa_coef_cac[9];
	$sum += $sbp * $mesa_coef_cac[10];
	$sum += (($bp_med == "yes") ? 1 : 0) * $mesa_coef_cac[11];
	$sum += (($fh_heartattack == "yes") ? 1 : 0) * $mesa_coef_cac[12];
	$sum += log1p($cac) * $mesa_coef_cac[13];

	$exponent = exp($sum);
	$risk_score = round((1 - pow($mesa_coef_cac[14], $exponent)) * 100, 2);

	$risk_score = ($risk_score < 1) ? 1.00 : $risk_score;
	$risk_score = ($risk_score > 30) ? 30.00 : $risk_score;
	return $risk_score;
}

if (!CsrfUtils::verifyCsrfToken($_POST["csrf_token_form"])) {
    CsrfUtils::csrfNotVerified();
}


//process form variables here
//create an array of all of the existing field names
$field_names = array('age' => 'textfield','sex' => 'radio_group','race' => 'scrolling_list','sbp' => 'textfield','bmi' => 'textfield','hdl' => 'textfield','tot_chol' => 'textfield','bp_med' => 'radio_group','smoking' => 'radio_group','diabetes' => 'radio_group','lipid_med' => 'radio_group','fh_heartattack' => 'radio_group','cac' => 'textfield','10y_accaha' => 'textfield','10y_frs' => 'textfield','10y_frs_simple' => 'textfield','10y_mesa' => 'textfield','10y_mesa_cac' => 'textfield');
$negatives = array();
//process each field according to it's type
foreach($field_names as $key=>$val)
{
  $pos = '';
  $neg = '';
	if ($val == "checkbox")
	{
		if ($_POST[$key]) {$field_names[$key] = "yes";}
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
		if (is_array($_POST[$key]) && count($_POST[$key])>0)
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
        if ($field_names[$key] != '')
        {
//          $field_names[$key] .= '.';
          $field_names[$key] = preg_replace('/\s*,\s*([^,]+)\./',' and $1.',$field_names[$key]); // replace last comma with 'and' and ending period
        }
}
https://exerror.com/warning-undefined-array-key/
$field_names["10y_accaha"] = accaha_10y($field_names);
$field_names["10y_frs"] = frs_10y($field_names);
$field_names["10y_frs_simple"] = frs_10y_simple($field_names);
$field_names["10y_frs_hard"] = frs_10y_hard($field_names);
$field_names["10y_mesa"] = mesa_10y($field_names);
$field_names["10y_mesa_cac"] = mesa_10y_cac($field_names);

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
$newid = formSubmit("form_ASCVD_Risk_Calculators", $field_names,
	isset($_GET["id"]) ? $_GET["id"] : '', $userauthorized);
addForm($encounter, "ASCVD Risk Calculator", $newid, "ASCVD_Risk_Calculators", $pid, $userauthorized);
}elseif ($_GET["mode"] == "update") {
sqlStatement("update form_ASCVD_Risk_Calculators set pid = '" . add_escape_custom($_SESSION["pid"]) . "', groupname='" . add_escape_custom($_SESSION["authProvider"]) . "', user='" . add_escape_custom($_SESSION["authUser"]) . "', authorized='" . add_escape_custom($userauthorized) . "', activity=1, date = NOW(), age='".$field_names["age"]."',sex='".$field_names["sex"]."',race='".$field_names["race"]."',sbp='".$field_names["sbp"]."',bmi='".$field_names["bmi"]."',hdl='".$field_names["hdl"]."',tot_chol='".$field_names["tot_chol"]."',bp_med='".$field_names["bp_med"]."',smoking='".$field_names["smoking"]."',diabetes='".$field_names["diabetes"]."',lipid_med='".$field_names["lipid_med"]."',fh_heartattack='".$field_names["fh_heartattack"]."',cac='".$field_names["cac"]."',10y_accaha='".$field_names["10y_accaha"]."',10y_frs='".$field_names["10y_frs"]."',10y_frs_simple='".$field_names["10y_frs_simple"]."',10y_frs_hard='".$field_names["10y_frs_hard"]."',10y_mesa='".$field_names["10y_mesa"]."',10y_mesa_cac='".$field_names["10y_mesa_cac"]."' where id='" . $_GET["id"] . "'");
}

formHeader("Redirecting....");
formJump();
formFooter();
?>

