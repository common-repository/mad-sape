<html>
<body>
<?php require('../../../wp-blog-header.php'); ?>
<style type="text/css">
   .layer1 {
    position: absolute;
    bottom: 50%;
    left: 30%;
   }
 </style>
<div class="layer1"><center>
<?php
   	global $wpdb;
   	$table_name = $wpdb->prefix . "madsape";
   	$wpdb->query("DROP TABLE IF EXISTS $table_name");
	$sql = "CREATE TABLE `$table_name` (`code` VARCHAR(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, PRIMARY KEY (`code`)) ENGINE = MyISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      	dbDelta($sql);
  	$rows_affected = $wpdb->insert($table_name, array('code' => $_POST["new_code"]));

echo "Код Sape был заменён на: <b>" . $_POST["new_code"] . ".</b><br /><br />";
echo "Теперь можете закрыть страницу.";
?>
</center></div>
<br />
</body>
</html>
