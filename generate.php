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
		
		$file = str_replace('WooCommerce_Plugin_Boiler_Plate','Broken_Url_Notifier',$file);
		$file = str_replace('woocommerce-plugin-boiler-plate','broken-url-notifier',$file);
		$file = str_replace('WooCommerce Plugin Boiler Plate','broken url notifier',$file);

		$file = str_replace('PLUGIN_NAME','BUN_NAME',$file);
		$file = str_replace('PLUGIN_SLUG','BUN_SLUG',$file);
		$file = str_replace('PLUGIN_PATH','BUN_PATH',$file);
		$file = str_replace('PLUGIN_LANGUAGE_PATH','BUN_LANGUAGE_PATH',$file);
		$file = str_replace('PLUGIN_TEXT_DOMAIN','BUN_TEXT_DOMAIN',$file);
		$file = str_replace('PLUGIN_URL','BUN_URL',$file);
		$file = str_replace('PLUGIN_FILE','BUN_FILE',$file);
		$file = str_replace('wc-pbp','broken-url-notifier',$file);
		
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
			if(pathinfo($dir.'/'.$file, PATHINFO_EXTENSION) == 'php'){
				if($file == 'generate.php'){continue;}
				$files_check[$file] = $dir.'/'.$file;
			}
		}
	}
}
?>


