<?php
		if($_POST['kft_hidden'] == 'Y') {
			//Form data sent
			

			$kft_popup_top = $_POST['kft_popup_top'];
			update_option('kft_popup_top', $kft_popup_top);
			
			$kft_popup_left = $_POST['kft_popup_left'];
			update_option('kft_popup_left', $kft_popup_left);			

			$kft_popup_hide = $_POST['kft_popup_hide'];
			update_option('kft_popup_hide', $kft_popup_hide);				
			
			
			
			
			
			

			?>
			<div class="updated"><p><strong><?php _e('Changes Saved.' ); ?></strong></p>
            </div>

			<?php
		} else {
			//Normal page display
			$kft_popup_top = get_option( 'kft_popup_top' );
			$kft_popup_left = get_option( 'kft_popup_left' );			
			$kft_popup_hide = get_option( 'kft_popup_hide' );
		}

?>


<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('Kento Fancy Tags Settings')."</h2>";?>
		<form  method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="kft_hidden" value="Y">
        <?php settings_fields( 'kento_fancy_comments_plugin_options' );
				do_settings_sections( 'kento_fancy_comments_plugin_options' );
			
		?>

<table class="form-table">
               
	<tr valign="top">
		<th scope="row">Popup box top position on hover</th>
		<td style="vertical-align:middle;">                     
                     <input type="text" name="kft_popup_top" id="kft-popup-top"  value ="<?php if ( isset( $kft_popup_top ) ) echo $kft_popup_top; ?>">px
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">Popup box left position on hover</th>
		<td style="vertical-align:middle;">                     
                     <input type="text" name="kft_popup_left" id="kft-popup-left"  value ="<?php if ( isset( $kft_popup_left ) ) echo $kft_popup_left; ?>">px
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">Display popup box</th>
		<td style="vertical-align:middle;">
        
        
        
                     <input type="checkbox" name="kft_popup_hide" id="kft-popup-hide"  value ="1" <?php if ( isset( $kft_popup_hide ) ) echo "checked" ?>>
		</td>
	</tr>



</table>
                <p class="submit">
                    <input class="button button-primary" type="submit" name="Submit" value="<?php _e('Save Changes' ) ?>" />
                </p>
		</form>

   
</div>
