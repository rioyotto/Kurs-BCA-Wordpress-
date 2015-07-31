<?php
/*
Plugin Name: Kurs BCA
Plugin URI: http://www.rioyotto.com/
Description: A simple plugin to add Kurs Bank BCA as a widget to your wordpress Sidebar - Develop by Rio Yotto 0815 1314 2125
Version: 2.0.
Author: RioYotto
Author URI: http://www.rioyotto.com/
License: GPL2
*/

class wp_kurs_bca extends WP_Widget {

	// constructor
    function wp_kurs_bca() {
        parent::WP_Widget(false, $name = __('Kurs BCA', 'wp_widget_kurs') );
    }

	// widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
	     $title = esc_attr($instance['title']);
	     //$text = esc_attr($instance['text']);
	     //$textarea = esc_textarea($instance['textarea']);
	} else {
	     $title = '';
	     $text = '';
	     $textarea = '';
	}
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_widget_kurs'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	</p>
	
	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
	      $instance = $old_instance;
	      // Fields
	      $instance['title'] = strip_tags($new_instance['title']);
	      $instance['text'] = strip_tags($new_instance['text']);
	      $instance['textarea'] = strip_tags($new_instance['textarea']);
	     return $instance;
	}

	// display widget
	function widget($args, $instance) {
	   extract( $args );
	   // these are the widget options
	   $title = apply_filters('widget_title', $instance['title']);
	   $text = $instance['text'];
	   $textarea = $instance['textarea'];
	   echo $before_widget;
	   // Display the widget
	   echo '<div class="widget-kurs">';
	   // Check if title is set
	   if ( $title ) {
	      echo $before_title . $title . $after_title;
	   }      
		
	   /* start kurs */
	   include('simple_html_dom.php');
	   //$html = file_get_html('http://www.bca.co.id/id/biaya-limit/kurs_counter_bca/kurs_counter_bca_landing.jsp');
	   $html = file_get_html('http://www.bca.co.id/id/kurs-sukubunga/kurs_counter_bca/kurs_counter_bca_landing.jsp');
	   ?>
	   <style>
		.datagridrio table { 
			border-collapse: collapse; text-align: left; 
			width: 200px; 
			padding-left:5px;
			padding-right:5px;
			} 
		.datagridrio {
			font: normal 12px/150% Verdana, Arial, Helvetica, sans-serif; 
			background: #fff; 
			overflow: hidden; 
			border: 1px solid #006699;
			-webkit-border-radius: 3px; 
			-moz-border-radius: 3px; 
			border-radius: 3px; 
			width:200px;
			padding:5px;
			}
		.datagridrio table td, 
		.datagridrio table th { 
			padding: 0px 0px; 
			width: auto;
			}
		.datagridrio table thead th {
			background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
			background-color:#006699; 
			color:#FFFFFF; 
			font-size: 10px; 
			font-weight: normal; 
			border-left: 1px solid #0070A8; 
			width: auto;
			} 
		.datagridrio table thead th:first-child { 
			border: none; 
			}
		.datagridrio table tbody td { 
			color: #00557F; 
			border-left: 1px solid #E1EEF4;
			font-size: 10px;font-weight: normal; 
			}
		.datagridrio table tbody tr td table { width:200px !important;	 }	/* rio */
		.datagridrio table tbody 
		.alt td { background: #E1EEf4; color: #00557F; }
		.datagridrio table tbody td:first-child { border-left: none; }
		.datagridrio table tbody tr:last-child td { border-bottom: none; }
		</style>
		
		<?php
	    foreach($html->find('table') as $tr) {
			$rowdata[] = $tr;		
		}

		for($i=0;$i<count($rowdata);$i++) {
			$tgl = $rowdata[1];
			$titlekurs = $rowdata[2];
			//$kurs = $rowdata[3];	
			//$data[] = $rowdata[$i];
			$data[] = $rowdata[$i];	
		}	

		echo '<img src="' . plugins_url( 'images/logo_bca.jpg' , __FILE__ ) . '" width="75" height="30" > ';
		echo '<table><tr><td valign=top>
				  <table width="80" border="1" style="float:left;">
				        <tbody><tr height="60px" bgcolor="#d7d7d7" style="text-align:center;">
							<td><strong><br>Mata Uang<br></strong></td>
				        </tr>		
						
				        <tr>
						<td style="text-align:center;">USD</td> </tr>	
				        <tr>
						<td style="text-align:center;">SGD</td> </tr>	
				        <tr>
						<td style="text-align:center;">EUR</td> </tr>	
				        <tr>
						<td style="text-align:center;">AUD</td> </tr>	
				        <tr>
						<td style="text-align:center;">DKK</td> </tr>	
				        <tr>
						<td style="text-align:center;">SEK</td> </tr>	
				        <tr>
						<td style="text-align:center;">CAD</td> </tr>	
				        <tr>
						<td style="text-align:center;">CHF</td> </tr>	
				        <tr>
						<td style="text-align:center;">NZD</td> </tr>	
				        <tr>
						<td style="text-align:center;">GBP</td> </tr>	
				        <tr>
						<td style="text-align:center;">HKD</td> </tr>	
				        <tr>
						<td style="text-align:center;">JPY</td> </tr>	
				        <tr>
						<td style="text-align:center;">SAR</td> </tr>	
				        <tr>
						<td style="text-align:center;">CNY</td> </tr>	
				            
				    </tbody></table>';

		echo "<td valign=top><div style='width:150px;'>".$data[2]."</div>";


		/*
		$cek = explode("<tr>",$data[2]);
		echo $cek[1];
		// exit;

		//echo $data[1]; exit;
		$expdate = explode("<br>",$data[1]); 
		$waktu = $data[1];
		$title = $data[2];
		$kurs2 = $data[3];
		*/
		//echo '<img src="http://www.klikbca.com/images/top_BCA1.jpg" width="75" height="30"/>';
		//echo '<img src="' . plugins_url( 'images/logo_bca.jpg' , __FILE__ ) . '" width="75" height="30" > ';
		/*
		echo "<div class=datagridrio><table border=0 width=300><tr><td colspan=2>";
		echo str_replace("DD/TT", "&nbsp;Klik BCA",$waktu); 
		echo "</td></tr><tr><td>";
		echo $title;
		echo $kurs2;
		echo $data[4];
		echo $data[5];
		echo $data[6];
		echo $data[7];
		echo $data[8];
		echo $data[9];
		echo $data[10];
		echo $data[11];
		echo $data[12];
		echo $data[13];
		echo $data[14];
		echo $data[15];
		echo $data[16];
		*/

		echo "</table></div>";
	   /* end kurs */	

		echo '</div>';
	   echo $after_widget;
	}


}

// register widget
//add_action('widgets_init', create_function('', 'return register_widget("kurs_bca");'));

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_kurs_bca");'));

?>
