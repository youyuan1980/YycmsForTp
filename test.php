<?php
	echo PHP_VERSION;
	if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
 ?>