<?php
//------------report.php
require_once("../../globals.php");
require_once($GLOBALS["srcdir"]."/api.inc");
function senior_health_calculator_report( $pid, $encounter, $cols, $id) {
$count = 0;
$data = formFetch("form_senior_health_calculator", $id);
if ($data) {
print "<hr><table><tr>";
foreach($data as $key => $value) {
if ($key == "id" || $key == "pid" || $key == "user" || $key == "groupname" || $key == "authorized" || $key == "activity" || $key == "date" || $value == "" || $value == "0000-00-00 00:00:00") {
	continue;
}
if ($value == "on") {
$value = "yes";
}
$key=ucwords(str_replace("_"," ",$key));
$mykey = $key;
$myval = $value;
print "<td><span class=bold>".text($mykey).": </span><span class=text>".text($myval)."</span></td>";
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
