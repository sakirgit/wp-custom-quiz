<?php 


/* ====================================== */// Add options page for post_type_quiz
function post_type_quiz_options_page() {
    add_submenu_page(
        'edit.php?post_type=post_type_quiz',
        'Quiz Settings',
        'Settings',
        'manage_options',
        'post_type_quiz_options',
        'post_type_quiz_options_page_callback'
    );
}
add_action( 'admin_menu', 'post_type_quiz_options_page' );

// Options page callback
function post_type_quiz_options_page_callback() {
    ?>
	 <style>
	 .post_type_quiz_opt_input{
		 width: 400px;
	 }
	 </style>
    <div class="wrap post_type_quiz_options_page">
        <h1>Quiz Options</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'post_type_quiz_options' );
            do_settings_sections( 'post_type_quiz_options' );
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="post_type_quiz_quiz_title">Quiz Title</label></th>
                    <td><input type="text" name="post_type_quiz_quiz_title" id="post_type_quiz_quiz_title" value="<?php echo esc_attr( get_option( 'post_type_quiz_quiz_title' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="post_type_quiz_receive_mail">Receive email</label></th>
                    <td><input type="email" name="post_type_quiz_receive_mail" id="post_type_quiz_receive_mail" value="<?php echo esc_attr( get_option( 'post_type_quiz_receive_mail' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="post_type_quiz_receive_mail_name">Receive email name</label></th>
                    <td><input type="text" name="post_type_quiz_receive_mail_name" id="post_type_quiz_receive_mail_name" value="<?php echo esc_attr( get_option( 'post_type_quiz_receive_mail_name' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>
                <tr>
                    <th scope="row"><label for="post_type_quiz_mail_tem_footer">Email Template footer </label></th>
                    <td>
								<textarea name="post_type_quiz_mail_tem_footer" class="post_type_quiz_opt_input" ><?php echo esc_attr( get_option( 'post_type_quiz_mail_tem_footer' ) ); ?></textarea>
							</td>
                </tr>
					 
                <tr>
                    <th scope="row"><label for="post_type_quiz_success_image2">Image for Success Template</label></th>
                    <td>
                        <?php $success_image = get_option( 'post_type_quiz_success_image2' ); ?>
                        <img src="<?php echo esc_url( $success_image ); ?>" id="post_type_quiz_success_image_preview" style="max-width: 300px; max-height: 300px; display: block; margin-bottom: 10px;" />
                        <input type="text" name="post_type_quiz_success_image2" id="post_type_quiz_success_image2" value="<?php echo esc_attr( $success_image ); ?>" class="post_type_quiz_opt_input" />
                        <button class="button" id="post_type_quiz_success_image_button">Select Image</button>
                    </td>
                </tr>
					 
                <tr>
                    <th scope="row"><label for="post_type_quiz_gt_title">Quiz Last Form Great Job Title</label></th>
                    <td><input type="text" name="post_type_quiz_gt_title" id="post_type_quiz_gt_title" value="<?php echo esc_attr( get_option( 'post_type_quiz_gt_title' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>

                <tr>
                    <th scope="row"><label for="post_type_quiz_gt_text">Last form Great Job Text</label></th>
                    <td><input type="text" name="post_type_quiz_gt_text" id="post_type_quiz_gt_text" value="<?php echo esc_attr( get_option( 'post_type_quiz_gt_text' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>

                <tr>
                    <th scope="row"><label for="post_type_last_check_text">Last form checkbox text</label></th>
                    <td><input type="text" name="post_type_last_check_text" id="post_type_last_check_text" value="<?php echo esc_attr( get_option( 'post_type_last_check_text' ) ); ?>" class="post_type_quiz_opt_input" /></td>
                </tr>

            </table>
            <?php submit_button(); ?>
        </form>
    </div>

    <script>
        jQuery(document).ready(function($) {
            var mediaUploader;
            $('#post_type_quiz_success_image_button').click(function(e) {
                e.preventDefault();
                if (mediaUploader) {
                    mediaUploader.open();
                    return;
                }
                mediaUploader = wp.media.frames.file_frame = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });
                mediaUploader.on('select', function() {
                    var attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#post_type_quiz_success_image2').val(attachment.url);
                    $('#post_type_quiz_success_image_preview').attr('src', attachment.url);
                });
                mediaUploader.open();
            });
        });
    </script>
	 <hr>
	 <div style="padding: 10px 30px 10px 0">
	 <?php 

					global $wpdb;

					$table_name = $wpdb->prefix . 'qcd_quiz_records';

					$per_page = 10; // Change this to set the number of items per page
					$page_number = isset( $_GET['qpage'] ) ? absint( $_GET['qpage'] ) : 1;

					$offset = ( $page_number - 1 ) * $per_page;

					$query = $wpdb->prepare( "SELECT * FROM $table_name ORDER BY id DESC LIMIT %d OFFSET %d", $per_page, $offset );

					$results = $wpdb->get_results( $query );

					$total_items = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" );

					$page_count = ceil( $total_items / $per_page );
		?>
				<style>
				table.tbl_q_records thead th{
					background: #fff;
				}
				table.tbl_q_records tr th,
				table.tbl_q_records tr td{
					padding: 10px;
				}
				table.tbl_q_records tr td:nth-child(1){
					font-size: 17px;
					font-weight: bold;
				}
				table.tbl_q_records tr td:nth-child(2){
					
				}
				table.tbl_q_records tbody > tr:hover td{
					background: #fff;
				}
				.quiz_id{
					font-size: 10px;
				}
				.q_img{
					width: 70px;
				}
				.tablenav-pages{
					text-align: right;
				}
				.tablenav-pages > span,
				.tablenav-pages a{
					font-size: 30px;
					font-weight: bold;
					padding: 10px;
				}
				</style>
		<?php 
			$qpage = 1;
			if( isset($_GET['qpage']) ){
				$qpage = $_GET['qpage'];
			}
			echo "<h3>Page No. (" . $qpage . ")</h3>";
			echo '<table class="tbl_q_records">';
			echo '<thead><tr><th>ID</th><th>Quiz ID</th><th>Quiz Ans</th><th>User</th><th>Date Time</th></tr></thead>
				<tbody>';

			foreach ( $results as $result_k => $result ) {
				$result->quiz_ans = json_decode($result->quiz_ans);
				?>
				 <tr>
					 <td><?= $result_k +1 ?></td>
					 <td>(<?= 'ID <b>' . $result->id . '</b>' ?>)<br><span class="quiz_id"><?= $result->quiz_id . '</span><br>Min: '. $result->quiz_min_score .' &nbsp; Max: '. $result->quiz_max_score .'<br>User Score :<b> '. $result->quiz_user_score ?></b></td>
					 <td style="padding: 0;"><?php 
						$sl = 1;
						foreach( $result->quiz_ans as $quiz_ans_k => $quiz_ans_v ){ 
							$quiz_ans_v = json_decode($quiz_ans_v);
							?>
							
							<table >
								<tr>
									<td style=" border-collapse: none !important; border: none !important;">
										<table style="border-collapse: none !important; border: none !important;">
											<tr style="">
												<td colspan="2" style="padding: 0; border-radius: 5px;border-collapse: none !important; border: none !important;">
													<p style="font-size: 15px;font-weight: bold;color: #E95959;margin: 0; line-height:1.1;">(<?= $sl ?>) <?php echo $quiz_ans_v->q_quiz_text; ?></p>
												</td>
											</tr>
											<tr>
												<td style="border-collapse: none !important; border: none !important;padding: 0;width: 70px;">
													<img src="<?php echo $quiz_ans_v->ans_thumb; ?>" class="q_img" >
												</td>
												<td style="padding-left: 5px;border-collapse: none !important; border: none !important;">
													<p style="margin: 0; line-height:1.1;font-style: italic;font-size: 15px;"><?php echo $quiz_ans_v->ans_text; ?></p>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						<?php $sl++;	} ?>
					</td>
					 <td><?= $result->q_user_name . '<br>' . $result->q_user_email . '<br>Is Loggedin User: '. $result->is_loggedin_user_id ?></td>
					 <td><?= $result->q_datetime ?></td>
				 </tr>
				 <?php 
			}

			echo '<tbody></table>';

			echo '<div class="tablenav">';
			echo '<div class="tablenav-pages">';
			echo paginate_links( array(
				 'base' => add_query_arg( 'qpage', '%#%' ),
				 'format' => '',
				 'prev_text' => __( '&laquo;' ),
				 'next_text' => __( '&raquo;' ),
				 'total' => $page_count,
				 'current' => $page_number,
			) );
			echo '</div>';
			echo '</div>';
	 ?>
	 </div>
    <?php
}

// Register settings
function post_type_quiz_register_options() {
    register_setting( 'post_type_quiz_options', 'post_type_quiz_quiz_title' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_receive_mail' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_receive_mail_name' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_mail_tem_footer' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_success_image2' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_gt_title' );
    register_setting( 'post_type_quiz_options', 'post_type_quiz_gt_text' );
    register_setting( 'post_type_quiz_options', 'post_type_last_check_text' );
}
add_action( 'admin_init', 'post_type_quiz_register_options' );


/* ====================================== */

