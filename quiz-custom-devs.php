<?php
/**
 * Quiz custom Devs
 *
 * @package       QSD
 * @author        -
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Quiz custom Devs
 * Plugin URI:    #
 * Description:   This is some demo short description...
 * Version:       1.0.0
 * Author:        -
 * Author URI:    #
 * Text Domain:   quiz-custom-devs
 * Domain Path:   /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

// Include your custom code here.




// Hook into the activation event
register_activation_hook( __FILE__, 'qcd_quiz_records_create_table' );

function qcd_quiz_records_create_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'qcd_quiz_records';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        quiz_id text NOT NULL,
        quiz_user_score int(3) NOT NULL,
        quiz_min_score int(3) NOT NULL,
        quiz_max_score int(3) NOT NULL,
        quiz_ans text NOT NULL,
        q_user_name varchar(255) NOT NULL,
        q_user_email varchar(255) NOT NULL,
        q_datetime datetime NOT NULL,
        is_loggedin_user_id int(11) NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function get_quiz_record_by_quiz_id($quiz_id, $settings = [
																				"user_for" => "user",
																				"place_for" => "email_temp",
																			] ){
	
	global $wpdb;

	$table_name = $wpdb->prefix . 'qcd_quiz_records';
	$sql = "SELECT * FROM $table_name WHERE quiz_id='$quiz_id'";

	$result = $wpdb->get_results(  $sql );
	$result = $result[0];
/*
	echo '<pre>';
	print_r($result);
	echo '</pre>';
*/
	$html_output = '';
	ob_start();
	?>
	<style>
	#quiz_page_banner{
		display: none;
	}
	</style>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="font-family:arial, 'helvetica neue', helvetica, sans-serif">
		 <head>
				  <meta charset="UTF-8">
				  <meta content="width=device-width, initial-scale=1" name="viewport">
				  <meta name="x-apple-disable-message-reformatting">
				  <meta http-equiv="X-UA-Compatible" content="IE=edge">
				  <meta content="telephone=no" name="format-detection">
				  <title>Quiz score result</title><!--[if (mso 16)]>
					 <style type="text/css">
					 a {text-decoration: none;}
					 </style>
					 <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
				<xml>
					 <o:OfficeDocumentSettings>
					 <o:AllowPNG></o:AllowPNG>
					 <o:PixelsPerInch>96</o:PixelsPerInch>
					 </o:OfficeDocumentSettings>
				</xml>
				<![endif]-->
				  <style type="text/css">
				#outlook a {
					padding:0;
				}
				.es-button {
					mso-style-priority:100!important;
					text-decoration:none!important;
				}
				a[x-apple-data-detectors] {
					color:inherit!important;
					text-decoration:none!important;
					font-size:inherit!important;
					font-family:inherit!important;
					font-weight:inherit!important;
					line-height:inherit!important;
				}
				.es-desk-hidden {
					display:none;
					float:left;
					overflow:hidden;
					width:0;
					max-height:0;
					line-height:0;
					mso-hide:all;
				}
				@media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120% } h1 { font-size:30px!important; text-align:left } h2 { font-size:24px!important; text-align:left } h3 { font-size:20px!important; text-align:left } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:30px!important; text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:24px!important; text-align:left } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important; text-align:left } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:inline-block!important } a.es-button, button.es-button { font-size:18px!important; display:inline-block!important } .es-adaptive table, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } .h-auto { height:auto!important } }
				</style>
		 </head>
		 <body data-new-gr-c-s-loaded="14.1107.0" style="width:100%;font-family:arial, 'helvetica neue', helvetica, sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
		  <div class="es-wrapper-color" style="background-color:#E95959"><!--[if gte mso 9]>
					<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
						<v:fill type="tile" color="#f6f6f6"></v:fill>
					</v:background>
				<![endif]-->
			<table class="es-wrapper" cellspacing="0" cellpadding="0" style="border-collapse: none !important; border: none !important;mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0px auto;width:100%;height:100%;background-repeat:repeat;background-position:center top;background-color:#E95959; max-width: 700px;box-shadow: 0 1px 2px rgba(0,0,0,0.07), 0 2px 4px rgba(0,0,0,0.07), 0 4px 8px rgba(0,0,0,0.07), 0 8px 16px rgba(0,0,0,0.07), 0 16px 32px rgba(0,0,0,0.07), 0 32px 64px rgba(0,0,0,0.07);">
			  <tr>
				<td valign="top" style="padding:0;Margin:0;background: #fff;border-collapse: none !important; border: none !important;">
					<center><img src="https://demo7.boostbarrel.com/wp-content/uploads/2023/04/Beyond-Culture-Logo.png" style="padding:20px"></center>
				 <table class="es-header" cellspacing="0" cellpadding="0" align="center" style="border-collapse: none !important; border: none !important;mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-repeat:repeat;background-position:center top">
					<tr style="background-color:#E95959;">
					 <td align="center" style="padding:50px 30px;Margin:0;color: #fff;text-align: center;">
						<h2 style="font-size: 25px; line-height: 1.1em;color: #fff;">
						<?php if($settings["user_for"] == "admin"){ ?>
						Quiz From: <span style="color: #fff;"><?php echo $result->q_user_email; ?></span>
						<?php }else{ ?>
						Thank you for taking the quiz!:
						<?php } ?>
						</h2>
						<p style="font-size: 20px;line-height: 1.1em;">
						<?php if( $settings["user_for"] == "admin" ){ ?> <?php }else{ ?>Your <?php } ?>Score:<br><span style="font-size: 100px;line-height: 1.1em;font-weight: bold;"><?php echo $result->quiz_user_score; ?></span></p>
						<p style="font-size: 18px;line-height: 1.1em;margin: 0;">Min Score: <b><?php echo $result->quiz_min_score; ?></b> &nbsp; &nbsp; Max Score: <b><?php echo $result->quiz_max_score; ?></b></p>
						<span></span>
					 </td>
					</tr>
					<?php if($settings["user_for"] == "admin"){ ?>
					
					<?php }else{ ?>
					<tr>
					 <td align="center" style="padding:30px;Margin:0;text-align: center;">
						<p style="font-size: 18px;line-height: 1.1em;">It sounds like your organizational culture is strong in some ways & may be struggling in some costly ways. Here's what I'd like you to know....There is more! There is better!<br>
						This could be extremely transformational for you and your organization.</p>
						<p style="font-size: 18px;color: #E95959;margin: 0;">Here's what I <strong>suggest:</strong></p>
						<p>1.  Read the list of organizational needs below.  Select your top 3 pain points. <br>
						2.Let's talk about it!  I'll reach out to you via email to schedule a call.  I'd love to hear about your organization and explain more about the Beyond Culture Visioning Experience.  It's fun and impactful!</p>
						<span></span>
					 </td>
					</tr>
					<?php } ?>
					<tr>
					 <td align="center" style="padding:30px;padding-top:0;Margin:0; border-collapse: none !important; border: none !important;">
					 <?php 
						$result->quiz_ans = json_decode($result->quiz_ans);
							/*
							echo '<pre>';
							print_r($result->quiz_ans);
							echo '</pre>';
							*/
						$sl = 1;
						foreach( $result->quiz_ans as $quiz_ans_k => $quiz_ans_v ){ 
							$quiz_ans_v = json_decode($quiz_ans_v);
							/*
							echo '<pre>';
							print_r($quiz_ans_v);
							echo '</pre>';
							*/
						?>
								
							<table style="border: 1px dotted #E95959;padding: 10px;border-radius: 5px;margin: 10px;">
								<tr>
									<td style="vertical-align: top;border-collapse: none !important; border: none !important;">
										<h4 style="font-size: 30px;color: #E95959"><?= $sl ?>.</h4>
									</td>
									<td style="padding: 10px;padding-left: 0; border-collapse: none !important; border: none !important;">
										<table style="border-collapse: none !important; border: none !important;">
											<tr style="">
												<td colspan="2" style="padding: 10px 15px;background: #E95959; border-radius: 5px;border-collapse: none !important; border: none !important;">
													<p style="font-size: 18px;font-weight: bold;color: #fff;margin: 0; line-height:1.1 !important;"><?php echo $quiz_ans_v->q_quiz_text; ?></p>
												</td>
											</tr>
											<tr>
												<td style="border-collapse: none !important; border: none !important;padding: 0;width: 150px;">
													<img src="<?php echo $quiz_ans_v->ans_thumb; ?>" width="150" style="border-radius: 10px;border: 1px solid #ddd;width: 150px;">
												</td>
												<td style="padding-left: 5px;font-weight: bold;border-collapse: none !important; border: none !important;">
													<p style="margin: 0; line-height:1.1 !important;font-style: italic;"><?php echo $quiz_ans_v->ans_text; ?></p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						<?php $sl++; } ?>
					 </td>
					</tr>
					
					<?php
					/*
						echo "<pre>";
						print_r($settings);
						echo "</pre>";
					*/
					if($settings["place_for"] != "email_temp" ){ ?>
						<tr>
						 <td align="center" style="padding:30px;Margin:0;color: #fff;">
							<img src="<?php echo esc_url( get_option( 'post_type_quiz_success_image2' ) ); ?>" style="max-width: 100%; display: block;" />
						 </td>
						</tr>
					<?php } ?>
					
					<tr style="background-color:#E95959;">
					 <td align="center" style="padding:30px;Margin:0;color: #fff;">
						<p style="font-size: 18px;line-height: 1.1 !important;padding: 0;margin: 0;"><?php echo esc_attr( get_option( 'post_type_quiz_mail_tem_footer' ) ); ?> </p>
						<span></span>
					 </td>
					</tr>
				 </table>
				 </td>
			  </tr>
			</table>
		  </div>
		 </body>
		</html>
	<?php 
	$html_output = ob_get_contents();
	// Close the buffer and clear the contents.
	ob_end_clean();
	return $html_output;
}


if( isset($_POST['cquiz_submit']) ){
	$quiz_submit_id = uniqid(time(), true);
	
	$quiz_user_score = 0;
	$quiz_ans = $_POST['quiz_ans'];
	foreach( $quiz_ans as $quiz_ans_k => $quiz_ans_v ){
		$quiz_ans_v = json_decode($quiz_ans_v);
		/*
		echo '<pre>';
		print_r($quiz_ans_v);
		echo '</pre>';
		*/
		$quiz_user_score += $quiz_ans_v->point;
	}
	
	$_POST['quiz_ans'] = json_encode($_POST['quiz_ans']);
	/*
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
	echo current_time( 'mysql' );
	echo get_current_user_id();
	*/
	
	$data = array(
		 'quiz_id' => $quiz_submit_id,
		 'quiz_user_score' => $quiz_user_score,
		 'quiz_min_score' => $_POST['q_min_sqr'],
		 'quiz_max_score' => $_POST['q_max_sqr'],
		 'quiz_ans' => $_POST['quiz_ans'],
		 'q_user_name' => $_POST['q_user_name'],
		 'q_user_email' => $_POST['q_user_email'],
		 'q_datetime' => current_time( 'mysql' ),
		 'is_loggedin_user_id' => get_current_user_id(),
	);
	/*
	echo '<pre>';
//	print_r($data);
	echo '</pre>';
//	exit;
*/
		
	$table_name = $wpdb->prefix . 'qcd_quiz_records';

	$wpdb->insert( $table_name, $data );
	
	$cur_url = '//' . $_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
	

	$to = $_POST['q_user_email'];

	$subject_q_title = get_option( 'post_type_quiz_quiz_title' );
	
	$subject = $subject_q_title;
	$body_4_user = get_quiz_record_by_quiz_id($quiz_submit_id, ["user_for" => "user", "place_for" => "email_temp" ] );	
	$body_4_admin = get_quiz_record_by_quiz_id($quiz_submit_id, ["user_for" => "admin", "place_for" => "email_temp" ] );	
	
	
	// Set content-type header for sending HTML email 
	$headers = "MIME-Version: 1.0" . "\r\n"; 
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	$headers_4_user .= $headers . 'From: '. get_option( 'post_type_quiz_receive_mail_name' ) .' <'. get_bloginfo('admin_email') .'>' . "\r\n"; 
	
	$headers_4_admin .= $headers . 'From: '. $_POST['q_user_name'] .' <'. $_POST['q_user_email'] .'>' . "\r\n"; 
	
	
//	/*
	// Send email to Admin
	$to_q_admin = get_option( 'post_type_quiz_receive_mail' );
	$subject_admin_q_title = trim($subject_q_title);
	
	if(mail($to_q_admin, $subject_admin_q_title, $body_4_admin, $headers_4_admin)){ 
		 echo 'Email has sent successfully.'; 
	}else{ 
		echo 'Email sending failed.'; 
	}
	
	// Send email to User
	if(mail($to, $subject, $body_4_user, $headers_4_user)){ 
		 echo 'Email has sent successfully.'; 
	}else{ 
		echo 'Email sending failed.'; 
	}
	
//	*/

	header( "Location: $cur_url" . "?q_submit=" . $quiz_submit_id  . "&status=success" );
	exit;
}



	// ================== Custom Post for Quiz 
   require_once( 'cpt-quiz.php' );
   require_once( 'cpt-quiz-settings.php' );




// Add Featured Image support for custom post type
add_theme_support( 'post-thumbnails', array( 'post_type_quiz' ) );

// Add Featured Image column to admin screen
function custom_post_type_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['featured_image'] = __( 'Featured Image', 'your-textdomain' );
    unset( $columns['cb'] );
    return array_merge( $new_columns, $columns );
}
add_filter( 'manage_post_type_quiz_posts_columns', 'custom_post_type_columns' );

// Populate Featured Image column with image
function custom_post_type_column_content( $column_name, $post_ID ) {
    if ( $column_name == 'featured_image' ) {
        echo get_the_post_thumbnail( $post_ID, array( 50, 50 ) );
    }
}
add_action( 'manage_post_type_quiz_posts_custom_column', 'custom_post_type_column_content', 10, 2 );


// ==================== Shortcode [custom_quiz] 
   require_once( 'shortcode-custom_quiz.php' );
	
	
	
	
	
	
	
	
