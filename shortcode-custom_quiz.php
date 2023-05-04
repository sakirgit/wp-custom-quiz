<?php 


// Add Shortcode
function dvs_cs_custom_quiz($atts) {
	
	if ( !is_admin() ){
		
		$cur_url = '//' . $_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
				
		if( isset($_GET['q_submit']) && isset($_GET['status']) && $_GET['status'] == "success" ){
			
			$cur_url = '//' . $_SERVER['HTTP_HOST'].$_SERVER['REDIRECT_URL'];
			
			echo "<a href='" . $cur_url . "' style='text-align: center;display: block;'>Back to Quiz Page</a>";
			echo get_quiz_record_by_quiz_id( $_GET['q_submit'], ["user_for" => "user", "place_for" => "success_temp" ] );
			echo "<br><a href='" . $cur_url . "' style='text-align: center;display: block;'>Back to Quiz Page</a>";
			
		}else{
				?>
				<style>
				/* Custom quiz styles */
				.cquiz_cov {
				  width: 100%;
				  max-width: 800px;
				  margin: 0 auto;
				  padding: 20px;
				  background-color: #fff;
				  border: 1px solid #ccc;
				  border-radius: 5px;
				}
				
				.cquiz_cov_part {
				  display: none;
				}
				
				.cquiz_cov_part:first-of-type {
				  display: block;
				}
				
				.cquiz_in_top {
					font-size: 24px;
					font-weight: bold;
					margin-bottom: 20px;
					color: #E95959;
					border: 1px solid #E95959;
					padding: 20px;
					border-radius: 10px;
					line-height: 1.1;
					text-align: center;
				}
				.cquiz_in_top img{
					margin: 10px auto;
					margin-bottom: 0;
					display: block;
					border: 1px solid #ddd;
				}
				
				.cquiz_in {
				  display: flex;
					flex-wrap: wrap;
					align-items: stretch;
					margin-bottom: 20px;
					align-content: stretch;
					justify-content: space-between;
				}
				label{width: 100%;}
				
				.cquiz_in .cquiz_in_options {
				  display: flex;
				  margin-bottom: 10px;
				  cursor: pointer;
					width: 32%;
					text-align: center;
				}
				.cquiz_in .cquiz_in_options img{
					margin: 0px auto;
					display: block;
				}
				
				.cquiz_in .cquiz_in_options label{
					border: 1px solid #ddd;
					border-radius: 10px;
					padding: 20px;
					position: relative;
				}
				
				.cquiz_in_options label:hover{
					border: 1px solid tomato;
				}
				
				/* Style for the checked radio button's section */
				.cquiz_in_options input[type=radio]:checked + label {
					 border-color: tomato;
					 background: tomato;
					 color: #fff;
				}
				.cquiz_in_options input[type=radio]{
					display: none;
				}
				.cquiz_in_options input[type=radio]:checked + label:before {
					content: "";
					width: 50px;
					height: 50px;
					background: url('https://demo7.boostbarrel.com/wp-content/uploads/2023/05/check.png');
					background-repeat: no-repeat;
					position: absolute;
					background-position: center;
					left: 15px;
				}
				
				.cquiz_in label p {
				  margin: 10px 0;
				  font-size: 18px;
				}
				
				.cquiz_in label img {
				  width: 150px;
				  height: 150px;
				  object-fit: cover;
				  border-radius: 50%;
				  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
				}
				
				.cquiz_in_bottom {
				  display: flex;
				  justify-content: space-between;
				}
				
				.cquiz_in_bottom button {
				  padding: 10px 20px;
				  font-size: 18px;
				  font-weight: bold;
				  color: #fff;
				  background-color: #555;
				  border: none;
				  border-radius: 5px;
				  cursor: pointer;
				  transition: all 0.3s ease;
				}
				.cquiz_in_bottom button.slide_start,
				.cquiz_in_bottom button.btn_submit{
					background-color: #e95959;
				}
				
				.cquiz_in_bottom button:hover {
				  background-color: #333;
				}
				
				.progress_wrap {
					 max-width: 72%;
					 height: 20px;
					 background-color: #eee;
					 border-radius: 7px;
					 overflow: hidden;
					 margin: -30px auto;
					 margin-bottom: 10px;
				}
				
				.progress_percentage {
				  height: 100%;
				  background-color: #e95959;
				  transition: all 0.3s ease;
				  color: #fff;
				  line-height: 1.2;
					text-align: center;
				}
				
				/* Pagination styles */

				.pagination a {
				  display: inline-block;
				  margin: 0 5px;
				  color: #555;
				  padding: 5px 10px;
				  border-radius: 5px;
				  transition: all 0.3s ease;
				}
				
				.pagination a:hover {
				  color: #fff;
				  background-color: #555;
				  transform: translateY(-3px);
				}
				
				.pagination .current {
				  color: #fff;
				  background-color: #555;
				  cursor: default;
				  transform: translateY(-3px);
				}
				
				.pagination .disabled {
				  opacity: 0.5;
				  pointer-events: none;
				}
				.pagination .prev, .pagination .next {
				  display: inline-block;
				  margin: 0 10px;
				  font-weight: bold;
				}
				
				button:disabled,
				button:[disabled]{
					opacity: 0.5;
				}
				
				.pagination .prev:hover, .pagination .next:hover {
				  color: #fff;
				  background-color: #555;
				}
				
				@media only screen and (max-width: 800px)  {
					
					.cquiz_in .cquiz_in_options {
						width: 49%;
					}
					
					.progress_wrap {
						margin-top: 15px;
						max-width: 98%;
					}
					.progress_wrap{
					}
				}
				@media only screen and (max-width: 550px)  {
					
					.cquiz_in .cquiz_in_options {
						width: 90%;
					}
					.cquiz_in {
						 justify-content: center;
					}
				}
				</style>
				
					<div class="cquiz_cov">
						<form action="" method="post">

							<div class="cquiz_cov_slide">
								<div class="cquiz_in_bottom">
									<button type="button" class="slide_start">&nbsp; Start >> &nbsp;</button>
								</div>
							</div>
				<?php 
					// WP_Query arguments
					$args = array(
						'post_type'              => array( 'post_type_quiz' ),
						'order'                  => 'ASC',
					);

					// The Query
					$query_quiz = new WP_Query( $args );
					$q_min_sqr = $q_max_sqr = 0;
					$qi = 1;
					// The Loop
					if ( $query_quiz->have_posts() ) {
						while ( $query_quiz->have_posts() ) {

							$query_quiz->the_post();
							
							$quiz_title = get_the_title(); 
							$quiz_question_id = get_the_ID();
							$quiz_ans_1 = get_field('quiz_ans_1');
							$quiz_ans_2 = get_field('quiz_ans_2');
							$quiz_ans_3 = get_field('quiz_ans_3');
							
							$q_min_sqr += $quiz_ans_1['option_ans_point'];
							$q_max_sqr += $quiz_ans_3['option_ans_point'];
							
							$q_quiz_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($quiz_question_id),"medium");
							$q_quiz_thumb = $q_quiz_thumb[0];
							
							?>
							<div class="cquiz_cov_part cquiz_cov_slide">
									<div class="cquiz_in_top">(<?php echo $qi; ?>) 
									<?php echo $quiz_title; the_post_thumbnail( 'medium' ); ?>
									</div>
									<div class="cquiz_in">
										<div class="cquiz_in_options cquiz_in_1_<?php echo $qi; ?>">
											<?php 
												$cquiz_ans_1 = [
													"q_quiz_text" => str_replace("'","&#39;",$quiz_title),
													"q_quiz_img" => $q_quiz_thumb,
													"ans_text" => str_replace("'","&#39;",$quiz_ans_1['option_ans']),
													"ans_thumb" => $quiz_ans_1['option_ans_thumb']['sizes']['medium'],
													"point" => $quiz_ans_1['option_ans_point']
												];
											?>
											<input type="radio" name="quiz_ans[<?php echo $quiz_question_id; ?>]" id="quiz_ans_<?php echo $qi; ?>_1" value='<?php echo json_encode($cquiz_ans_1); ?>'>
											<label class="" for="quiz_ans_<?php echo $qi; ?>_1">
												<img src="<?php echo $quiz_ans_1['option_ans_thumb']['sizes']['medium']; ?>">
												<p><?= $quiz_ans_1['option_ans'] ?></p>
											</label>
										</div>
										<div class="cquiz_in_options cquiz_in_1_<?php echo $qi; ?>">
											<?php 
												$cquiz_ans_2 = [
													"q_quiz_text" => str_replace("'","&#39;",$quiz_title),
													"q_quiz_img" => $q_quiz_thumb,
													"ans_text" => str_replace("'","&#39;",$quiz_ans_2['option_ans']),
													"ans_thumb" => $quiz_ans_2['option_ans_thumb']['sizes']['medium'],
													"point" => $quiz_ans_2['option_ans_point']
												];
											?>
											<input type="radio" name="quiz_ans[<?php echo $quiz_question_id; ?>]" id="quiz_ans_<?php echo $qi; ?>_2" value='<?php echo json_encode($cquiz_ans_2); ?>'>
											<label class="" for="quiz_ans_<?php echo $qi; ?>_2">
												<img src="<?php echo $quiz_ans_2['option_ans_thumb']['sizes']['medium']; ?>">
												<p><?php echo $quiz_ans_2['option_ans']; ?></p>
											</label>
										</div>
										<div class="cquiz_in_options cquiz_in_1_<?php echo $qi; ?>">
											<?php 
												$cquiz_ans_3 = [
													"q_quiz_text" => str_replace("'","&#39;",$quiz_title),
													"q_quiz_img" => $q_quiz_thumb,
													"ans_text" => str_replace("'","&#39;",$quiz_ans_3['option_ans']),
													"ans_thumb" => $quiz_ans_3['option_ans_thumb']['sizes']['medium'],
													"point" => $quiz_ans_3['option_ans_point']
												];
											?>
											<input type="radio" name="quiz_ans[<?php echo $quiz_question_id; ?>]" id="quiz_ans_<?php echo $qi; ?>_3" value='<?php echo json_encode($cquiz_ans_3); ?>'>
											<label class="" for="quiz_ans_<?php echo $qi; ?>_3">
												<img src="<?php echo $quiz_ans_3['option_ans_thumb']['sizes']['medium']; ?>">
												<p><?php echo $quiz_ans_3['option_ans']; ?></p>
											</label>
										</div>
									</div>
									<div class="cquiz_in_bottom pagination">
									<?php 
										if( $qi > 1 ){ ?>
										<button type="button" class="prev"  >Prev</button>
									<?php }else{ ?> 
										<button type="button" class="prev disabled" disabled >Prev</button>
									<?php } ?>
										
										<button type="button" class="next" >Next</button>
									</div>
							</div>
							
							<?php 
						//	echo '<pre>';
						//	print_r($quiz_ans_1);
						//	echo '</pre>';
							$qi++;
						}
					} else {
						// no posts found
					}

					// Restore original Post Data
					wp_reset_postdata();
				?>
							<div class="cquiz_cov_slide">
							
									<div class="form-top-safe">
										<h3 style="color: #E95959;"><?php echo esc_attr( get_option( 'post_type_quiz_gt_title' ) ); ?></h3>
										<p><?php echo esc_attr( get_option( 'post_type_quiz_gt_text' ) ); ?></p>
									</div>
									<br>
									<div class="cquiz_in">
									
										<label class="cquiz_in_1_" for="q_user_name">
											Your Name: 
											<input type="text" name="q_user_name" id="q_user_name" required >
										</label>
										<label class="cquiz_in_1_" for="q_user_email">
											Your Email: 
											<input type="email" name="q_user_email" id="q_user_email" required >
											<input type="hidden" name="q_min_sqr" value="<?php echo $q_min_sqr; ?>" >
											<input type="hidden" name="q_max_sqr" value="<?php echo $q_max_sqr; ?>" >
										</label>
										
										<label class="quiz_last_checkbox_lbl"><input type="checkbox" class="" value="1" name="quiz_last_checkbox" required > 
										<?php echo esc_attr( get_option( 'post_type_last_check_text' ) ); ?></label>
									</div>
									<div class="cquiz_in_bottom">
										<button type="button" class="prev">Prev</button>
										<button type="submit" class="btn_submit" name="cquiz_submit" >Submit</button>
									
									</div>
							</div>
								<div class="progress_wrap"><div class="progress_percentage"></div></div>
						</form>
					</div>
					<script>

					</script>
				<?php 
			
			
		}
		
	}
}
add_shortcode( 'custom_quiz', 'dvs_cs_custom_quiz' );


function devs_quiz_enqueue_scripts_for_shortcode(){
 
		global $post;
     
		if(has_shortcode( $post->post_content, 'custom_quiz') && ( is_single() || is_page() ) ){
     
		wp_enqueue_script('quiz-custom-devs', plugin_dir_url( __FILE__ ).'/js/quiz-custom-devs.js', array( 'jquery' ), '1.0.0', true );    
   }
}
add_action( 'wp_enqueue_scripts', 'devs_quiz_enqueue_scripts_for_shortcode' );
