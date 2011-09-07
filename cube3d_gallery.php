<?php
/*
	Plugin Name: cube3d_gallery
	Plugin URI: http://www.pluginswp.com/cube3d-gallery/
	Description: Amazing 3D Flash Images gallery, slider, header or menus in Actionscript 3.
	Version: 2.1
	Author: Webpsilon
	Author URI: http://www.pluginswp.com/
*/	
$contador=0;

$nombrebox="Webpsilon".rand(99, 99999);
function cube3d_gallery_head() {
	
	$site_url = get_option( 'siteurl' );
			echo '
			
	<script type="text/javascript" src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/jquery.js"></script>
	  <script type="text/javascript" src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/swfobject.js"></script>
    <script type="text/javascript" src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/shadowbox-jquery.js"></script>
  <script type="text/javascript" src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/shadowbox.js"></script>
  <link href="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/a.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/shadowbox.css">
	
	<script type="text/javascript">
	var $j = jQuery.noConflict();

		$j(document).ready(function(){
		    var options = {
		        resizeLgImages:     true, loadingImage: "' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/images/loading.gif",
		        displayNav:         true, handleUnsupported:  \'remove\',
		        keysClose:          [\'c\', 27], // c or esc
		        autoplayMovies:     false,
				 text:           {

            cancel:     \'Cancel\',

            loading:    \'loading\',

            close:      \'<img src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/images/close.png" width="16" height="16" />\',

            next:      \'<img src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/images/next.png" width="16" height="16" />\',

            prev:      \'<img src="' . $site_url . '/wp-content/plugins/cube3d-gallery/inc/images/previous.png" width="16" height="16" />\',

            errors:     {
                single: \'You must install the <a href="{0}">{1}</a> browser plugin to view this content.\',
                shared: \'You must install both the <a href="{0}">{1}</a> and <a href="{2}">{3}</a> browser plugins to view this content.\',
                either: \'You must install either the <a href="{0}">{1}</a> or the <a href="{2}">{3}</a> browser plugin to view this content.\'
            }

        }
		    };
		    Shadowbox.init(options);
		});
		
		function abrirSB(type, title, url)
			 {
			     Shadowbox.init({skipSetup: true});
			     Shadowbox.open({type: type, title: title, content: url, gallery:  "'.$nombrebox.'"});
		}; 
		
		
	</script>
	
	
	';
			
}
function cube3d_gallery($content){
	$content = preg_replace_callback("/\[cube3d_gallery ([^]]*)\/\]/i", "cube3d_gallery_render", $content);
	return $content;
	
}

function cube3d_gallery_render($tag_string){
$contador=rand(9, 9999999);
	$site_url = get_option( 'siteurl' );
global $wpdb; 	
$table_name = $wpdb->prefix . "cube3d_gallery";	


if(isset($tag_string[1])) {
	$auxi1=str_replace(" ", "", $tag_string[1]);
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name WHERE id = ".$auxi1.";" );
}
if(count($myrows)<1) $myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );
	$conta=0;
	$id= $myrows[$conta]->id;
	$row= $myrows[$conta]->row;
	$folder = $myrows[$conta]->folder;
	$zoom1 = $myrows[$conta]->zoom1;
	$zoom2 = $myrows[$conta]->zoom2;
	$speed = $myrows[$conta]->speed;
	$onover = $myrows[$conta]->onover;
	$vertical = $myrows[$conta]->vertical;
	$transparency = $myrows[$conta]->transparency;
	$target = $myrows[$conta]->target;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$imageslink = $myrows[$conta]->imageslink;
	$links2 = $myrows[$conta]->links;
	$titles = $myrows[$conta]->titles;
	$imagebg = $myrows[$conta]->imagebg;
	$menu1 = $myrows[$conta]->menu1;
	$menu2 = $myrows[$conta]->menu2;
	$menu3 = $myrows[$conta]->menu3;
	$menu4 = $myrows[$conta]->menu4;
	$menu5 = $myrows[$conta]->menu5;
	$menu6 = $myrows[$conta]->menu6;
	$menu7 = $myrows[$conta]->menu7;
	$alpha = $myrows[$conta]->alpha;

	
	
		$type 		= 'png';
		$type1 		= 'jpg';
		$type2 		= 'gif';
		
		$files	= array();
		$images	= array();

		$dir = $folder;

		// check if directory exists
		if (is_dir($dir))
		{
			if ($handle = opendir($dir)) {
				while (false !== ($file = readdir($handle))) {
					if ($file != '.' && $file != '..' && $file != 'CVS' && $file != 'index.html' ) {
						$files[] = $file;
					}
				}
			}
			closedir($handle);

			$i = 0;
			foreach ($files as $img)
			{
				if (!is_dir($dir .DS. $img))
				{
					if (eregi($type, $img) || eregi($type1, $img)|| eregi($type2, $img)) {
						$images[$i]->name 	= $img;
						$images[$i]->folder	= $folder;
						++$i;
					}
				}
			}
			$cantidad=$i;
		}
		else $cantidad=0;




	$texto='';
	
	
	
	$texto='cantidad='.$cantidad.'&row='.$row.'&colorbordes='.'cccccc'.'&colortextos='.'cccccc'.'&vertical='.$vertical.'&zoom1='.$zoom1.'&zoom2='.$zoom2.'&target='.$target.'&onlink='.$imageslink.'&speed='.$speed.'&mouseover='.$onover.'&alpha='.$alpha.'&menu1='.$menu1.'&menu2='.$menu2.'&menu3='.$menu3.'&menu4='.$menu4.'&menu5='.$menu5.'&menu6='.$menu6.'&menu7='.$menu7;
	$conta=0;
	
	$links=split("\n", $titles);
$imagesc=split("\n", $links2);
$ligtext="";

	sort($images);
			foreach ($images as $img)
			{
 					$auxi1c="";
 					$auxi2c="";
					if(isset($links[$conta])) $auxi1c=$links[$conta];
					if(isset($imagesc[$conta])) $auxi2c=$imagesc[$conta];
					if ($imageslink==1) $texto.='&imagen'.$conta.'='.$site_url.'/'.$folder.''.$img->name.'&title'.$conta.'='.$auxi1c.'&link'.$conta.'='.$auxi2c;
					else{
					$texto.='&imagen'.$conta.'='.$site_url.'/'.$folder.''.$img->name.'&title'.$conta.'='.$auxi1c.'&link'.$conta.'='.$site_url.'/'.$folder.$img->name;
					$ligtext.= '<a href="'.$site_url.'/'.$folder.''.$img->name.'" rel="shadowbox['.$nombrebox.']"></a>';
					}
				
					$conta++;

			}
	
	
	$table_name = $wpdb->prefix . "cube3d_gallery";
	$saludo= $wpdb->get_var("SELECT id FROM $table_name ORDER BY RAND() LIMIT 0, 1; " );
	$output='
	<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="'.$width.'" height="'.$height.'" id="cube3d'.$id.'-'.$contador.'" title="'.$imagebg.'">
  <param name="movie" value="'.$site_url.'/wp-content/plugins/cube3d-gallery/cube3d.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  	<param name="flashvars" value="'.$texto.'" />
  <param name="swfversion" value="9.0.45.0" />
  <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
  <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/cube3d-gallery/Scripts/expressInstall.swf" />
  <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
  <!--[if !IE]>-->
  <object type="application/x-shockwave-flash" data="'.$site_url.'/wp-content/plugins/cube3d-gallery/cube3d.swf" width="'.$width.'" height="'.$height.'">
    <!--<![endif]-->
    <param name="quality" value="high" />
    <param name="wmode" value="transparent" />
    	<param name="flashvars" value="'.$texto.'" />
    <param name="swfversion" value="9.0.45.0" />
    <param name="expressinstall" value="'.$site_url.'/wp-content/plugins/cube3d-gallery/Scripts/expressInstall.swf" />
    <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
    <div>
      <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
      <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" width="112" height="33" /></a></p>
    </div>
    <!--[if !IE]>-->
  </object>
  <!--<![endif]-->
</object>
<script type="text/javascript">
<!--
swfobject.registerObject("cube3d'.$id.'-'.$contador.'");
//-->
</script>'.$ligtext;
	return $output;
}
function cube3d_gallery_instala(){
	global $wpdb; 
	$table_name= $wpdb->prefix . "cube3d_gallery";
   $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		row tinytext NOT NULL ,
		folder longtext NOT NULL ,
		zoom1 longtext NOT NULL ,
		zoom2 longtext NOT NULL ,
		speed longtext NOT NULL ,
		onover longtext NOT NULL ,
		links longtext NOT NULL ,
		titles longtext NOT NULL ,
		vertical longtext NOT NULL ,
		target longtext NOT NULL ,
		transparency longtext NOT NULL ,
		width longtext NOT NULL ,
		height longtext NOT NULL ,
		imageslink longtext NOT NULL ,
		imagebg longtext NOT NULL ,
		alpha longtext NOT NULL ,
		menu1 longtext NOT NULL ,
		menu2 longtext NOT NULL ,
		menu3 longtext NOT NULL ,
		menu4 longtext NOT NULL ,
		menu5 longtext NOT NULL ,
		menu6 longtext NOT NULL ,
		menu7 longtext NOT NULL ,
		PRIMARY KEY ( `id` )	
	) ;";
   
   
   
	$wpdb->query($sql);
	$sql = "INSERT INTO $table_name (row, folder, zoom1, zoom2, speed, onover, links, titles, vertical, target, transparency, width, height, imageslink, imagebg, alpha, menu1, menu2, menu3, menu4, menu5, menu6, menu7) VALUES ('8', 'wp-content/plugins/cube3d-gallery/images/', '300', '150', '4', '1', '', '', '1', '_blank', '1', '100%', '300px', '0', '', '1', '100', '0', '4', '666666', 'Arial', '14', 'cccccc');";
	$wpdb->query($sql);
}
function cube3d_gallery_desinstala(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "cube3d_gallery";
	$sql = "DROP TABLE $table_name";
	$wpdb->query($sql);
}	
function cube3d_gallery_panel(){
	global $wpdb; 
	$table_name = $wpdb->prefix . "cube3d_gallery";	
	
	if(isset($_POST['crear'])) {
		$re = $wpdb->query("select * from $table_name");
//autos  no existe
if(empty($re))
{
  $sql = " CREATE TABLE $table_name(
		id mediumint( 9 ) NOT NULL AUTO_INCREMENT ,
		row tinytext NOT NULL ,
		folder longtext NOT NULL ,
		zoom1 longtext NOT NULL ,
		zoom2 longtext NOT NULL ,
		speed longtext NOT NULL ,
		onover longtext NOT NULL ,
		links longtext NOT NULL ,
		titles longtext NOT NULL ,
		vertical longtext NOT NULL ,
		target longtext NOT NULL ,
		transparency longtext NOT NULL ,
		width longtext NOT NULL ,
		height longtext NOT NULL ,
		imageslink longtext NOT NULL ,
		imagebg longtext NOT NULL ,
		alpha longtext NOT NULL ,
		menu1 longtext NOT NULL ,
		menu2 longtext NOT NULL ,
		menu3 longtext NOT NULL ,
		menu4 longtext NOT NULL ,
		menu5 longtext NOT NULL ,
		menu6 longtext NOT NULL ,
		menu7 longtext NOT NULL ,
		PRIMARY KEY ( `id` )
	) ;";
	$wpdb->query($sql);

}
		
	$sql = "INSERT INTO $table_name (row, folder, zoom1, zoom2, speed, onover, links, titles, vertical, target, transparency, width, height, imageslink, imagebg, alpha, menu1, menu2, menu3, menu4, menu5, menu6, menu7) VALUES ('8', 'wp-content/plugins/cube3d-gallery/images/', '300', '150', '4', '1', '', '', '1', '_blank', '1', '100%', '300px', '0', '', '1', '100', '0', '4', '666666', 'Arial', '14', 'cccccc');";
	$wpdb->query($sql);
	}
	
if(isset($_POST['borrar'])) {
		$sql = "DELETE FROM $table_name WHERE id = ".$_POST['borrar'].";";
	$wpdb->query($sql);
	}
	if(isset($_POST['id'])){	
	if($_POST["imageslink".$_POST['id']]=="") $_POST["imageslink".$_POST['id']]=1;

$sql= "UPDATE $table_name SET `row` = '".$_POST["row".$_POST['id']]."', `folder` = '".$_POST["folder".$_POST['id']]."', `zoom1` = '".$_POST["zoom1".$_POST['id']]."', `zoom2` = '".$_POST["zoom2".$_POST['id']]."', `speed` = '".$_POST["speed".$_POST['id']]."', `onover` = '".$_POST["onover".$_POST['id']]."', `links` = '".$_POST["links".$_POST['id']]."', `titles` = '".$_POST["titles".$_POST['id']]."', `target` = '".$_POST["target".$_POST['id']]."', `width` = '".$_POST["width".$_POST['id']]."', `height` = '".$_POST["height".$_POST['id']]."', `transparency` = '".$_POST["transparency".$_POST['id']]."', `vertical` = '".$_POST["vertical".$_POST['id']]."', `imageslink` = '".$_POST["imageslink".$_POST['id']]."', `alpha` = '".$_POST["alpha".$_POST['id']]."', `menu1` = '".$_POST["menu1".$_POST['id']]."', `menu2` = '".$_POST["menu2".$_POST['id']]."', `menu3` = '".$_POST["menu3".$_POST['id']]."', `menu4` = '".$_POST["menu4".$_POST['id']]."', `menu5` = '".$_POST["menu5".$_POST['id']]."', `menu6` = '".$_POST["menu6".$_POST['id']]."', `menu7` = '".$_POST["menu7".$_POST['id']]."', `imagebg` = '".$_POST["imagebg".$_POST['id']]."' WHERE `id` =  ".$_POST["id"]." LIMIT 1";
			$wpdb->query($sql);
	}
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name" );
$conta=0;

include('template/cabezera_panel.html');
while($conta<count($myrows)) {
	$id= $myrows[$conta]->id;
	$row= $myrows[$conta]->row;
	$folder = $myrows[$conta]->folder;
	$zoom1 = $myrows[$conta]->zoom1;
	$zoom2 = $myrows[$conta]->zoom2;
	$speed = $myrows[$conta]->speed;
	$onover = $myrows[$conta]->onover;
	$vertical = $myrows[$conta]->vertical;
	$transparency = $myrows[$conta]->transparency;
	$target = $myrows[$conta]->target;
	$width = $myrows[$conta]->width;
	$height = $myrows[$conta]->height;
	$imageslink = $myrows[$conta]->imageslink;
	$links2 = $myrows[$conta]->links;
	$titles = $myrows[$conta]->titles;
	$imagebg = $myrows[$conta]->imagebg;
	$menu1 = $myrows[$conta]->menu1;
	$menu2 = $myrows[$conta]->menu2;
	$menu3 = $myrows[$conta]->menu3;
	$menu4 = $myrows[$conta]->menu4;
	$menu5 = $myrows[$conta]->menu5;
	$menu6 = $myrows[$conta]->menu6;
	$menu7 = $myrows[$conta]->menu7;
	$alpha = $myrows[$conta]->alpha;
	include('template/panel.html');			
	$conta++;
	}

}




function widget_cube3d_gallery($args) {

 
  
    extract($args);
	
	  $options = get_option("widget_cube3d_gallery");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'cube3d Gallery',
	  'id' => '1'
      );
  }

	$aaux=array();
	$aaux[0]="cube3d_gallery";
	
  echo $before_widget;
  echo $before_title;
  echo $options['title'];
  echo $after_title;
  $aaux[1]=$options['id'];
 echo cube3d_gallery_render($aaux);
  echo $after_widget;

}



function cube3d_gallery_control()
{
  $options = get_option("widget_cube3d_gallery");
  if (!is_array( $options ))
{
$options = array(
      'title' => 'cube3d Gallery',
	  'id' => '1'
      );
  }
 
  if ($_POST['cube3d-Submit'])
  {
    $options['title'] = htmlspecialchars($_POST['cube3d-WidgetTitle']);
	 $options['id'] = htmlspecialchars($_POST['cube3d-WidgetId']);
    update_option("widget_cube3d_gallery", $options);
  }
  
  
  global $wpdb; 
	$table_name = $wpdb->prefix . "cube3d_gallery";
	
	$myrows = $wpdb->get_results( "SELECT * FROM $table_name;" );

if(empty($myrows)) {
	
	echo '
	<p>First create a new gallery of images, from the administration of cube3d plugin.</p>
	';
}

else {
	$contaa1=0;
	$selector='<select name="cube3d-WidgetId" id="cube3d-WidgetId">';
	while($contaa1<count($myrows)) {
		
		
		$tt="";
		if($options['id']==$myrows[$contaa1]->id)  $tt=' selected="selected"';
		$selector.='<option value="'.$myrows[$contaa1]->id.'"'.$tt.'>'.$myrows[$contaa1]->id.'</option>';
		$contaa1++;
		
	}
	
	$selector.='</select>';
	
	
 
echo '
  <p>
    <label for="cube3d-WidgetTitle">Widget Title: </label>
    <input type="text" id="cube3d-WidgetTitle" name="cube3d-WidgetTitle" value="'.$options['title'].'" /><br/>
	<label for="cube3d-WidgetTitle">cube3d Gallery ID: </label>
   '.$selector.'
    <input type="hidden" id="cube3d-Submit" name="cube3d-Submit" value="1" />
  </p>
';
}


}


function cube3d_gallery_init(){
	register_sidebar_widget(__('cube3d Gallery'), 'widget_cube3d_gallery');
	register_widget_control(   'cube3d Gallery', 'cube3d_gallery_control', 300, 300 );
}



function cube3d_gallery_add_menu(){	
	if (function_exists('add_options_page')) {
		//add_menu_page
		//add_options_page('cube3d_gallery', 'cube3d', 8, basename(__FILE__), 'cube3d_gallery_panel');
		
		add_menu_page('cube3d_gallery', 'cube3d', 8, basename(__FILE__), 'cube3d_gallery_panel');
	}
}
if (function_exists('add_action')) {
	add_action('admin_menu', 'cube3d_gallery_add_menu'); 
}
add_action('wp_head', 'cube3d_gallery_head');
add_filter('the_content', 'cube3d_gallery');
add_action('activate_cube3d_gallery/cube3d_gallery.php','cube3d_gallery_instala');
add_action('deactivate_cube3d_gallery/cube3d_gallery.php', 'cube3d_gallery_desinstala');
add_action("plugins_loaded", "cube3d_gallery_init");
?>