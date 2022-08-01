<?php

/**
 * ASCVD Risk Calculator report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Antonino Daplas <adaplas@gmail.com>
 * @copyright Copyright (c) 2022 Antonino Daplas <adaplas@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

//------------report.php
require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");

function ASCVD_Risk_Calculators_report( $pid, $encounter, $cols, $id) {

	$replace_array = [
		"Sbp" => "Systolic BP (mmHg)",
		"Hdl" => "HDL (mg/dL)",
		"Bmi" => "BMI (kg/m2)",
		"Tot Chol" => "Total Cholesterol (mg/dL)",
		"Bp Med" => "On BP medications",
		"Lipid Med" => "On Lipid Medications/Statins",
		"Fh Heartattack" => "Family History of Heart Attacks",
		"Cac" => "Coronary Artery Calcification (Agatston)",
		"10y Accaha" => "ACC/AHA 2013 ASCVD risk score (%)",
		"10y Frs" => "Framingham 2008 ASCVD risk score (with lab measurement) (%)",
		"10y Frs Simple" => "Framingham 2008 ASCVD risk score (no lab measurement) (%)",
		"10y Frs Hard" => "Framingham 1998 Hard Coronary risk score (%)",
		"10y Mesa" => "MESA 2015 CHD risk score (%)",
		"10y Mesa Cac" => "MESA 2015 CHD risk score with CAC (%)",
	];


	$count = 0;
	$data = formFetch("form_ASCVD_Risk_Calculators", $id);
	if ($data) {
		print "<hr><table><tr>";
		foreach($data as $key => $value) {
			if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" ||
				$key == "authorized" || $key == "activity" || $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
				continue;
			}
			if ($value == "on") {
				$value = "yes";
			}
			$key=ucwords(str_replace("_"," ",$key));
			$mykey = $key;
			$myval = $value;
			if ($mykey == "10y Accaha") {
				$cols = 1;
				$count = 0;
				print "</tr><tr>\n";
				print "<td><br><hr><span class=bold>Risk Scores (10 year risk of CVD)</span><br><hr></td>";
				print "</tr><tr>\n";

			}
			print "<td><span class=bold>".text(($replace_array[$mykey]) ? $replace_array[$mykey] : $mykey).": </span><span class=text>".text($myval)."</span></td>";
			$count++;
			if ($count == $cols) {
				$count = 0;
				print "</tr><tr>\n";
			}
		}
	}
	print "</tr></table><hr>";
}
?>
