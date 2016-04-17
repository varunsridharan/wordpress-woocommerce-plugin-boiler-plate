<?php $slug =  $wc_pbp_plugin_data['addon_slug']; ?>
<div class="plugin-card plugin-card-<?php echo $slug; ?> wc-pbp-addon-all wc-pbp-addon-<?php echo $wc_pbp_plugin_data['CategorySlug']; ?>">
	<?php wc_pbp_get_ajax_overlay(); ?>
	<div class="plugin-card-top">
		<div class="name column-name">
			<h3> 
			   <?php echo $wc_pbp_plugin_data['Name']; ?> 
			   [<small><?php _e('V',PLUGIN_TXT);?> <?php echo $wc_pbp_plugin_data['Version']; ?></small>] 
			   <?php $this->get_addon_icon($wc_pbp_plugin_data); ?>
			</h3>
		</div>
		<div class="desc column-description">
			<p><?php echo $wc_pbp_plugin_data['Description']; ?></p>
			<p class="authors">
				
				<cite>
					<?php _e('By',PLUGIN_TXT); ?> 
					<a href="<?php echo $wc_pbp_plugin_data['AuthorURI']; ?>"> <?php echo $wc_pbp_plugin_data['Author']; ?></a> 
				</cite> 
			</p>
		</div>
	</div>
	<div class="plugin-card-top wc-pbp-addons-required-plugins">
		<?php if(!empty($required_plugins)): ?>
			<div>
				<h3><?php _e('Required Plugins :',PLUGIN_TXT); ?></h3>
				<ul>
					<?php
						$echo = '';
						foreach($required_plugins as $plugin){
							$plugin_status = $this->check_plugin_status($plugin['Slug']);
							$status_val = __('InActive',PLUGIN_TXT);
							$class = 'deactivated';
							if($plugin_status === 'notexist'){ $status_val = __('Plugin Dose Not Exist',PLUGIN_TXT); $class = 'notexist'; } 
							else if($plugin_status === true){ $status_val = __('Active',PLUGIN_TXT); $class = 'active'; }
							if(!isset($plugin['Version'])){$plugin['version'] = '';}
							echo '<li class="'.$class.'">';
							
								echo '<span class="wc_pbp_required_addon_plugin_name"> <a href="'.$plugin['URL'].'" > '.
									$plugin['Name'].' ['.$plugin['Version'].'] </a> </span> : ';
								echo '<span class="wc_pbp_required_addon_plugin_status '.$class.'">'.$status_val.'</span>';
							echo '</li>';
							unset($plugin_status);
						}
					?>
				</ul>
				<p> <span><?php _e('Above Mentioned Plugin name with version are Tested Upto',PLUGIN_TXT);?></span> </p>
				<small><strong><?php _e('Addon Slug : ',PLUGIN_TXT); ?></strong><?php echo $wc_pbp_plugin_slug;?></small>
			</div>
		<?php endif; ?>
	</div>
	<div class="plugin-card-bottom">
		<div class="column-updated" data-pluginslug="<?php echo $slug; ?>">
			<?php echo $this->get_addon_action_button($wc_pbp_plugin_slug,$required_plugins); ?>
		</div>
		<div class="column-downloaded"><strong><?php _e('Last Updated:',PLUGIN_TXT);?></strong>
			<span title="<?php echo $wc_pbp_plugin_data['last_update']; ?>"><?php echo $wc_pbp_plugin_data['last_update']; ?></span>
		</div>
		<div class="column-downloaded wc_pbp_ajax_response"></div>
	</div>
</div>
