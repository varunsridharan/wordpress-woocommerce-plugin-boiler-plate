<?php
if(isset($_REQUEST['makePOT'])){
	$current_dir = __DIR__;
	$file_name = basename($current_dir);
	$lang_dir = $current_dir."/language/$file_name.pot";
	$php_path = 'C:\xampp\php\php.exe';
	$makePotFile = 'C:\xampp\htdocs\wptools\makepot.php';
	$project = 'wp-plugin';
	exec($php_path. ' '.$makePotFile.' '.$project.' '.$current_dir.' '.$lang_dir);
}


if(isset($_REQUEST['change'])){
	$files_check = array();
	get_php_files(__DIR__);
	foreach ($files_check as $f){
		$file = file_get_contents($f);
		
		$file = str_replace('WooCommerce_Plugin_Boiler_Plate', '', $file);
		$file = str_replace('WooCommerce Plugin Boiler Plate', '', $file);
		$file = str_replace('woocommerce-plugin-boiler-plate', '', $file);
		$file = str_replace('PLUGIN_NAME', '', $file);
		$file = str_replace('PLUGIN_SLUG', '', $file);
		$file = str_replace('PLUGIN_TXT', '', $file);
		$file = str_replace('PLUGIN_DB', '', $file);
		$file = str_replace('PLUGIN_V', '', $file);
		$file = str_replace('PLUGIN_PATH', '', $file);
		$file = str_replace('PLUGIN_LANGUAGE_PATH', '', $file);
		$file = str_replace('PLUGIN_INC', '', $file);
		$file = str_replace('PLUGIN_ADMIN', '', $file);
		$file = str_replace('PLUGIN_SETTINGS', '', $file);
		$file = str_replace('PLUGIN_URL', '', $file);
		$file = str_replace('PLUGIN_CSS', '', $file);
		$file = str_replace('PLUGIN_IMG', '', $file);
		$file = str_replace('PLUGIN_JS', '', $file);
		$file = str_replace('PLUGIN_FILE', '', $file);
		$file = str_replace('wc_pbp', '', $file);		
		
		file_put_contents($f,$file); 
	}


}

function get_php_files($dir = __DIR__){
	global $files_check;
	$files = scandir($dir); 
	foreach($files as $file) {
		if($file == '' || $file == '.' || $file == '..' ){continue;}
		if(is_dir($dir.'/'.$file)){
			get_php_files($dir.'/'.$file);
		} else {
			if(pathinfo($dir.'/'.$file, PATHINFO_EXTENSION) == 'php' || pathinfo($dir.'/'.$file, PATHINFO_EXTENSION) == 'txt'){
				if($file == 'generate.php'){continue;}
				$files_check[$file] = $dir.'/'.$file;
			}
		}
	}
}
?>


