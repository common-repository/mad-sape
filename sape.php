<p id="copyright">
<center>
<?php 
if (!defined('_SAPE_USER')) {
	define('_SAPE_USER', "$c"); 
}
require_once($_SERVER['DOCUMENT_ROOT'].'/'._SAPE_USER.'/sape.php'); 
        $o['charset'] = 'UTF-8';
	$sape = new SAPE_client($o);
	unset($o);
    	echo $sape->return_links();
?>
</center>
</p>
