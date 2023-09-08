<?php
if ( !defined( 'ABSPATH' ) ) exit;

/*
 * A function that generates an entry in the Administration menu
 */
function kiwichat_plugin_menu() {
    add_menu_page('Configuring KiwiChat', //Page title
        'KiwiChat',                        //Menu title
        'administrator',                      //Role with permissions
        'settings_kiwichat',                //Page Id
        'kiwichat_settingspage_nextclient',            //The playback function
        plugins_url('kiwichat/img/kiwichat.png'), //Icon
        80                                     //Position
        );
}

add_action('admin_menu', 'kiwichat_plugin_menu');

/*
 * Function that records values in internal DB
 */
function kiwichat_info() {

    register_setting('kiwichat-nextlient',
                     'kiwichat_nick');
	register_setting('kiwichat-nextlient',
                     'kiwichat_server');
    register_setting('kiwichat-nextlient',
                     'kiwichat_chan');
    register_setting('kiwichat-nextlient',
                     'kiwichat_style');
    register_setting('kiwichat-nextlient',
                     'kiwichat_height');
    register_setting('kiwichat-nextlient',
                     'kiwichat_width');
	register_setting('kiwichat-nextlient', // charset attribute
                     'kiwichat_coding');
}

add_action('admin_init', 'kiwichat_info');


/*
 * Feature that plays the main configuration page
 */
function kiwichat_settingspage() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
?>
    
       
<?php
}


/*
 * Feature that plays the main configuration page
 */
function kiwichat_settingspage_nextclient() {
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    //Error message
    if (isset($_GET['settings-updated'])) {
        add_settings_error('kiwiirc_messages', 'kiwiirc_message_ok', ('Updated values'), 'updated');
    }
    if (isset($_GET['settings-error'])) {
        add_settings_error('kiwiirc_messages', 'kiwiirc_message_error', ('There was a rescue error'), 'error');
    }

    settings_errors('kiwiirc_messages');
?>


<style>
        #kiwichat-options ul { margin-left: 10px; }
        #kiwichat-options ul li { margin-left: 15px; list-style-type: disc;}
        #kiwichat-options h1 {margin-top: 5px; margin-bottom:10px; color: #00557f}
        .fz-span { margin-left: 23px;}


    .kiwichat-signup-button {
      float: left;
      vertical-align: top;
      width: auto;
      height: 30px;
      line-height: 30px;
      padding: 10px;
      font-size: 22px;
      color: white;
      text-align: center;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.25);
      background: #c0392b;
      border-radius: 5px;
      border-bottom: 2px solid #b53224;
      cursor: pointer;
      -webkit-box-shadow: inset 0 -2px #b53224;
      box-shadow: inset 0 -2px #b53224;
      text-decoration: none;
      margin-top: 10px;
      margin-bottom: 10px;
      clear: both;
    }

    a.kiwichat-signup-button:hover {
      cursor: pointer;
      color: #f8f8f8;
    }

	#kiwichat-buttons a img {
margin: 8px 10px 0 0;
float: left;
}
</style>

<div id="kiwichat-options" style="width:100%; margin-top:10px;">
    <div style="float: left; width: 300px;">
        <?php
            echo '<a target="_blank" href="https://wordpress.org/plugins/kiwichat">';
            echo '<img style="border-radius:5px;border:0px;" src="' . plugins_url('images/kiwichat-logo.png', __FILE__) . '" > ';
            echo '</a>'; ?>
		
 <div id="kiwichat-buttons">
 
<a target="_blank" href="https://kiwichat.github.io"><img src="<?php echo plugins_url( 'images/home.png', __FILE__ ) ?>" /></a>
<a target="_blank" href="https://github.com/KiwiChat/wp-kiwichat"><img src="<?php echo plugins_url( 'images/github.png', __FILE__ ) ?>"  /></a>
<a target="_blank" href="https://wordpress.org/support/plugin/kiwichat"><img src="<?php echo plugins_url( 'images/help.png', __FILE__ ) ?>" /></a>
<a target="_blank" href="https://kiwiirc.com"><img src="<?php echo plugins_url( 'images/kiwiirc.png', __FILE__ ) ?>" /></a>
</div>
  </div>  
    

    <div style="float: left; margin-left: 10px; width: 50%; background-color:#f8f8f8; padding: 10px; border-radius: 5px;">
        <h1>Configuring KiwiChat NextClient</h1>		
        <form method="POST" action="options.php">
            <?php
                settings_fields('kiwichat-nextlient');
                do_settings_sections('kiwichat-nextlient');
            ?>
   <table width="100%" border="0">

		<tr>
    <td><strong><?php _e("Network Server:" ); ?></strong></td>
    <td><input type="text" id="kiwichat_server" name="kiwichat_server" value="<?php echo get_option('kiwichat_server'); ?>" size="25"></td>
    <td><em>Network IRC Server de chat.(Default is irc.libera.chat)</em></td>
  </tr>   
	    
	<tr>
    <td><strong><?php _e("Nickname Suggestion:" ); ?></strong></td>
    <td><input type="text" id="kiwichat_nick" name="kiwichat_nick" value="<?php echo get_option('kiwichat_nick'); ?>" size="25"></td>
    <td><em>Default nickname for your chatroom's KiwiChat. (Default is KiwiChat_?) [? is replaced with 5 random numbers]</em></td>
  </tr>
  
    <tr>
    <td><strong><?php _e("Channel:" ); ?></strong></td>
    <td><input type="text" name="kiwichat_chan"  value="<?php echo get_option('kiwichat_chan'); ?>" size="25"></td>
    <td><em>The name of your chatroom. (Default is #libera)</em></td>
  </tr>
						
  <tr>
    <td><strong><?php _e("KiwiChat Theme:" ); ?></strong></td>
    <td><select name="kiwichat_style"
	            id="kiwichat_style">
			   <option value="radioactive" <?php selected(get_option('kiwichat_style'), "radioactive"); ?>>Radioactive</option>
	           <option value="dark" <?php selected(get_option('kiwichat_style'), "dark"); ?>>Dark</option>
               <option value="nightswatch" <?php selected(get_option('kiwichat_style'), "nightswatch"); ?>>Nightswatch</option>
               <option value="osprey" <?php selected(get_option('kiwichat_style'), "osprey"); ?>>Osprey</option>
               <option value="sky" <?php selected(get_option('kiwichat_style'), "sky"); ?>>Sky</option>
			   <option value="coffee" <?php selected(get_option('kiwichat_style'), "coffee"); ?>>Coffee</option>
        </select>
    <td><em>Color style of the chatroom. (Default is Radioactive)</em></td>
  </tr>
	   
	<tr>
    <td><strong><?php _e("Width:" ); ?></strong></td>
    <td><input type="text" 
	name="kiwichat_width"
	id="kiwichat_width"
	value="<?php echo get_option('kiwichat_width'); ?>" size="8"></td>
    <td><em>Width of your chatroom. (Default is 100%)</em></td>
  </tr>
  
  <tr>
    <td><strong><?php _e("Height:" ); ?></strong></td>
    <td><input type="text" name="kiwichat_height" id="kiwichat_height"
    value="<?php echo get_option('kiwichat_height'); ?>" size="8"></td>
    <td><em>Height of your chatroom. (Default is 500)</em></td>
  </tr>
  
    <tr>
    <td><strong><?php _e("Coding:" ); ?></strong></td>
    <td><input type="text" name="kiwichat_coding" id="kiwichat_coding"
    value="<?php echo get_option('kiwichat_coding'); ?>" size="8"></td>
    <td><em>Character Set Names. (Default is utf8)</em></td>
  </tr>
<br/>
		       </table>	
			
	  <div class="wrap">
		         <div class="card pressthis">
            <h3>Enter the following code on a page: [kiwichat] </h3>
				<p>For more documentation on usage and configuration <a href="https://kiwichat.github.io" target="_blank" title="Documentation">Click Here.</a>
				<p>Current stable version of the plugin 6.2</p>
			 
        </div> 
		 </div>  
        <p style="font-weight: bold;">
		NOTE: Users' preferences will always have priority over this configuration. For example, if a user configures that a particular nickname is used and a particular channel is accessed, then that configuration will always have priority over that of that configuration, so it will enter the channel specified in the configuration.</p>
            <?php submit_button(); ?>
        </form>
    </div> 
</div>
<?php
}
?>