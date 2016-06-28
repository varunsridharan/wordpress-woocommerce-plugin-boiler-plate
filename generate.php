<?php 
if(isset($_REQUEST['change'])){
	$files_check = array();
	get_php_files(__DIR__);
	foreach ($files_check as $f){
		$file = file_get_contents($f);
		
		$file = str_replace('WooCommerce Plugin Boiler Plate','',$file);
		$file = str_replace('woocommerce-plugin-boiler-plate','',$file);
		$file = str_replace('WooCommerce_Plugin_Boiler_Plate','',$file);
		$file = str_replace('https://wordpress.org/plugins/woocommerce-plugin-boiler-plate/', '' , $file ); 
		$file = str_replace('[version]', '' , $file ); 
		$file = str_replace('[package]', '' , $file ); 
		$file = str_replace('[plugin_name]', '' , $file ); 
		$file = str_replace('[plugin_url]', '' , $file ); 
		$file = str_replace('wc_pbp_','',$file);
		$file = str_replace('PLUGIN_FILE', '' , $file);
		$file = str_replace('PLUGIN_PATH', '' , $file);
		$file = str_replace('PLUGIN_INC', '' , $file);
		$file = str_replace('PLUGIN_DEPEN', '' , $file);
		$file = str_replace('PLUGIN_NAME', '' , $file);
		$file = str_replace('PLUGIN_SLUG', '' , $file);
		$file = str_replace('PLUGIN_TXT', '' , $file);
		$file = str_replace('PLUGIN_DB', '' , $file);
		$file = str_replace('PLUGIN_V', '' , $file);
		$file = str_replace('PLUGIN_LANGUAGE_PATH', '' , $file);
		$file = str_replace('PLUGIN_ADMIN', '' , $file);
		$file = str_replace('PLUGIN_SETTINGS', '' , $file);
		$file = str_replace('PLUGIN_URL', '' , $file);
		$file = str_replace('PLUGIN_CSS', '' , $file);
		$file = str_replace('PLUGIN_IMG', '' , $file);
		$file = str_replace('PLUGIN_JS', '' , $file);		
		
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
[plugin_url] <br/> <br/>
[plugin_name] <br/> <br/>
[version] <br/> <br/>
[package] <br/> <br/>
WooCommerce Plugin Boiler Plate <br/> <br/>
WooCommerce_Plugin_Boiler_Plate  <br/> <br/>
woocommerce-plugin-boiler-plate <br/> <br/>
wc_pbp	 <br/> <br/>
wc-pbp <br/> <br/>
PLUGIN_FILE <br/> <br/>
PLUGIN_PATH <br/> <br/>
PLUGIN_INC <br/> <br/>
PLUGIN_DEPEN <br/> <br/>
PLUGIN_NAME <br/> <br/>
PLUGIN_SLUG <br/> <br/>
PLUGIN_TXT <br/> <br/>
PLUGIN_DB <br/> <br/>
PLUGIN_V <br/> <br/>
PLUGIN_LANGUAGE_PATH <br/> <br/>
PLUGIN_ADMIN <br/> <br/>
PLUGIN_SETTINGS <br/> <br/>
PLUGIN_ADDON <br/> <br/>
PLUGIN_URL <br/> <br/>
PLUGIN_CSS <br/> <br/>
PLUGIN_IMG <br/> <br/>
PLUGIN_JS <br/> <br/>
PLUGIN_ADDON_URL <br/> <br/>
PLUGIN_ADDON_CSS <br/> <br/>
PLUGIN_ADDON_IMG <br/> <br/>
PLUGIN_ADDON_JS <br/> <br/>