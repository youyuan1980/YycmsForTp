<?php
function GetID()
{
	$id=0;
	$time =microtime(true)-strtotime('1970-01-01 00:00:00');
	$id=ceil($time*100);
	return $id;
}
 ?>