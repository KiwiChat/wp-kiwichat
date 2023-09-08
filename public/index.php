<?php

defined('ABSPATH') or die("Do not change anything here!");
function kiwichat_page( $atts ) {
    $url = KIWICHAT_URLBASE."nextclient/?";
    if (get_option('kiwichat_style') != '')
        $url = $url."theme=".get_option('kiwichat_style');
	  if (get_option('kiwichat_server') != '')
        $url = $url."#irc://".get_option('kiwichat_server');
	
	  $channels = isset($atts['chan']) ? $atts['chan'] : '';
    if ($channels == '')
        $channels = get_option('kiwichat_chan');
    if ($channels != '')
        $url = $url."/".$channels;

    if (get_option('kiwichat_nick') != '')
        $url = $url."?nick=".str_replace("?", rand(10000,99999), get_option('kiwichat_nick'));
	/* charset attribute */
	 if (get_option('kiwichat_coding') != '')
        $url = $url."&encoding=".get_option('kiwichat_coding');
	
?>
<center>
        <iframe marginwidth="0" marginheight="0" src="<?php echo $url; ?>"
<?php
    if (get_option('kiwichat_width') != '') echo "width=\"".get_option('kiwichat_width')."\"";
    if (get_option('kiwichat_height') != '') echo "height=\"".get_option('kiwichat_height')."\"";?> scrolling="no" frameborder="0">
        </iframe>
<?php
}
function kiwichat( $atts ) {
    ob_start();
    kiwichat_page( $atts );
    return ob_get_clean();
}
add_shortcode( 'kiwichat', 'kiwichat' );
?>