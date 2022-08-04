<?php
/**
 * Senior Health Calculator report.php
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Antonino Daplas <adaplas@gmail.com>
 * @copyright Copyright (c) 2022 Antonino Daplas <adaplas@gmail.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");
function senior_health_calculator_report( $pid, $encounter, $cols, $id) {
	$replace_array = [
		"Pmhx" => "Medical History",
		"Fx"   => "Functional Status",
		"Mmse" => "MMSE (out of 30)",
		"Moca" => "MoCA (out of 30)",
		"Mini Cog" => "Mini-Cog (out of 5)",
		"Chair Stands" => "5 Repeated Chair Stands (in seconds)",
		"Gait Speed" => "Gait Speed (in meters/second)",
		"Grip Strength" => "Dominant Hand Grip Strength (in kg)",
		"Weight Loss" => "Weight loss > 10 lbs in the past year",
		"Bmi" => "BMI < 21 kg/m2",
		"Albumin" => "Serum Albumin < 3.5 g/L",
	];

	$cols = 1; // Force single column report
	$count = 0;
	$data = formFetch("form_senior_health_calculator", $id);
	$ms_done = 0;
	$nutrition_done = 0;
	if ($data) {
		print "<hr><table><tr>";
		foreach($data as $key => $value) {
			if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized"
			    || $key == "activity" || $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
				continue;
			}
			if ($value == "on") {
				$value = "yes";
			}
			$key=ucwords(str_replace("_"," ",$key));
			$mykey = $key;
			if (!$ms_done && ($mykey == "Mmse" || $mykey == "Moca" || $mykey == "Mini Cog" || $mykey == "Grip Strength" ||
				$mykey == "Chair Stands" || $mykey == "Gait Speed")) {
				print "<td><br><hr><span class=bold>".text("Performance Tests")."</span><hr></td>";
				print "</tr><tr>";
 				$ms_done = 1;
				$cols = 1;
			}
			if (!$nutrition_done && ($mykey == "Weight Loss" || $mykey == "Bmi" || $mykey == "Albumin")) {
				print "<td><br><hr><span class=bold>".text("Nutrition")."</span><hr></td>";
				print "</tr><tr>";
 				$nutrition_done = 1;
				$cols = 1;
			}
			if ($mykey == "Score") {
				print "<td><br><hr><span class=bold>".text("Frailty Index")."</span><hr></td>";
				if ($count == $cols - 1) {
					$count = 0;
					print "</tr><tr>";
				}
		print "</tr><tr>";
			}
			$myval = $value;
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

