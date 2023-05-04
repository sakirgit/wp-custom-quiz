
				(function($) {
				  // Hide all quiz parts except the first one
				  $(".cquiz_cov_slide").hide();
				  $(".cquiz_cov_slide:first").show();

				  // Set initial progress percentage to 0%
				  $(".progress_percentage .progress_percentage").text("0%");

				  // Set initial current part to 1
				  var currentPart = 1;

				  // Get total number of parts
				  var totalParts = $(".cquiz_cov_part").length;

				  // Set progress bar width to 0%
				  $(".progress_wrap .progress_percentage").css("width", "0%");

				  // Function to update progress bar and percentage
				  function updateProgress() {
					 var progress = ((currentPart - 1) / totalParts) * 100;
					 if( progress > 100 ){
						 progress = 100;
					 }
					 
					 $(".progress_wrap .progress_percentage").css("width", progress + "%");
					 $(".progress_percentage").text(Math.floor(progress) + "%");
					 
					 if( progress > 99 ){
						 $( "#quiz_page_banner" ).slideUp('slow');
					 }else{
						 $( "#quiz_page_banner" ).slideDown('slow');
					 }
				  }

				  // Function to show/hide quiz parts
				  function showPart(partNum) {
					 // Hide all quiz parts
				//	 $(".cquiz_cov_part").hide();
					 // Show the selected quiz part
				//	 $(".cquiz_cov_part:nth-child(" + partNum + ")").show();
					 // Update current part variable
					 currentPart = partNum;
					 // Update progress bar and percentage
					 updateProgress();
				  }
				  
				  // Function to handle "Next" button click
				  $(".slide_start").on('click', function() {
									  
					  $(this).closest('.cquiz_cov_slide').hide();
					  $(this).closest('.cquiz_cov_slide').next('.cquiz_cov_slide').show();
					//  $(this).closest('.cquiz_cov_slide').prev('.cquiz_cov_slide').show();
				  });
					$(".next").on('click', function() {
						
						
					//	/*
						var nextData = $(this).closest('.cquiz_cov_slide').find("input[type=radio]:checked");
						console.log("nextData:: ", nextData.length);
						if( !nextData.length ){
							alert("Please select an answer.");
							return false;
						}
					//	*/
						
						$(this).closest('.cquiz_cov_slide').hide();
						$(this).closest('.cquiz_cov_slide').next('.cquiz_cov_slide').show();
					//  $(this).closest('.cquiz_cov_slide').prev('.cquiz_cov_slide').show();
					  
						if( $(this).closest('.cquiz_cov_slide').hasClass('cquiz_cov_part') ){
							showPart(currentPart + 1);
						}
						
						
						
						/*
							// Get the value of the selected radio button
							var selected = $("input[name=quiz_ans_" + currentPart + "]:checked").val();
							// If no radio button is selected, show an error message
							if (!selected) {
								alert("Please select an answer.");
								//   return;
							}
							// If this is the last quiz part, show the submit button
							if (currentPart == totalParts) {
								$(".next").hide();
								$(".submit").show();
							}
							// Otherwise, show the next quiz part
							else {
								showPart(currentPart + 1);
							}
						*/
					});
					
				  // Function to handle "Prev" button click
				  $(".prev").on('click', function() {
					  
					  
					  $(this).closest('.cquiz_cov_slide').hide();
					  $(this).closest('.cquiz_cov_slide').prev('.cquiz_cov_slide').show();
					  
					  
					  
					//	if( $(this).closest('.cquiz_cov_slide').hasClass('cquiz_cov_part') ){
							showPart(currentPart - 1);
					//	}
					  
					  /*
					 // If this is the first quiz part, do nothing
					 if (currentPart == 1) {
						return;
					 }
					 // Otherwise, show the previous quiz part
					 showPart(currentPart - 1);
					 // Hide the submit button if it's visible
					 $(".submit").hide();
					 // Show the next button
					 $(".next").show();
					 */
				  });

				})(jQuery);