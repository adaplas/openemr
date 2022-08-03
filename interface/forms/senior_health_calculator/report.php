<?php
//------------report.php
require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");
function senior_health_calculator_report( $pid, $encounter, $cols, $id) {
	$replace_array = [
		"Pmhx" => "Medical History",
		"Fx"   => "Functional Status",
		"Mmse" => "MMSE",
		"Moca" => "MoCA",
		"Mini Cog" => "Mini-Cog",
		"Chair Stands" => "5 Repeated Chair Stands",
		"Gait Speed" => "Gait Speed",
		"Grip Strenth" => "Dominant Hand Grip Strength",
		"Weight Loss" => "Weight loss > 10lbs in the past year",
		"Bmi" => "BMI < 21 kg/m2",
		"Albumin" => "Serum Albumin < 3.5 g/L",
	];

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
				if ($count == $cols-1) {
					$count = 0;
					print "</tr><tr>";
				}
				print "<td><br><hr><span class=bold>".text("Performance Tests")."</span><hr></td>";
				print "</tr><tr>";
 				$ms_done = 1;
			}
			if (!$nutrition_done && ($mykey == "Weight Loss" || $mykey == "Bmi" || $mykey == "Albumin")) {
				if ($count == $cols-1) {
					$count = 0;
					print "</tr><tr>";
				}
				print "<td><br><hr><span class=bold>".text("Nutrition")."</span><hr></td>";
				print "</tr><tr>";
 				$nutrition_done = 1;
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

