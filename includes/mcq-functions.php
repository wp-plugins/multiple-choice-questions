<?php


function mcq_check_result()
	{
		$mcq_id = $_POST['mcq_id'];
		$ans_input = $_POST['ans'];		
		
		$user_point = 0;
		$total_correct_ans = 0;		
		$total_wrong_ans = 0;			
		
		
		$mcq_questions_correct_ans = get_post_meta( $mcq_id, 'mcq_questions_correct_ans', true );
		$mcq_pass_mark = get_post_meta( $mcq_id, 'mcq_pass_mark', true );
		$mcq_questions_point = get_post_meta( $mcq_id, 'mcq_questions_point', true );					
		
		if(empty($ans_input))
			{
				$ans_input = array('');
			}
		
		
		unset($ans_input[0]);
				
		echo '<ul>';
		$i = 1;
		foreach($ans_input as $key => $value)
			{
				echo '<li>';
				if($mcq_questions_correct_ans[$key] == $value)
					{
						echo '<i class="correct"></i>';
						$user_point += $mcq_questions_point[$key];
						$total_correct_ans +=1;
					}
				else
					{
						echo '<i class="incorrect"></i>';	
						$total_wrong_ans +=1;
					}
				echo 'Question '.$i .' : Your  Answer : '.sanitize_text_field($value).'<br />';
				echo '</li>';
				$i++;
			}
		echo '</ul>';
		
		echo '<div class="point">Your Point: '.$user_point.'</div>';
		
		echo '<div class="total-correct-ans">Total Correct Answers: '.$total_correct_ans.'</div>';
		echo '<div class="total-wrong-ans">Total Wrong Answers: '.$total_wrong_ans.'</div>';		
		
		
		if($user_point<$mcq_pass_mark)
			{
				echo '<div class="failed">You have Failed!</div>';
			}
		else
			{
			echo '<div class="pass">Congratulation! You Passed</div>';
			}
		
		
					
		
		die();
		
	}

add_action('wp_ajax_mcq_check_result', 'mcq_check_result');
add_action('wp_ajax_nopriv_mcq_check_result', 'mcq_check_result');
	
	function mcq_share_plugin()
		{
			
			?>
            <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwordpress.org%2Fplugins%2Fmcq&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80&amp;appId=652982311485932" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
            
            <br />
            <!-- Place this tag in your head or just before your close body tag. -->
            <script src="https://apis.google.com/js/platform.js" async defer></script>
            
            <!-- Place this tag where you want the +1 button to render. -->
            <div class="g-plusone" data-size="medium" data-annotation="inline" data-width="300" data-href="<?php echo mcq_share_url; ?>"></div>
            
            <br />
            <br />
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo mcq_share_url; ?>" data-text="<?php echo mcq_plugin_name; ?>" data-via="ParaTheme" data-hashtags="WordPress">Tweet</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>



            <?php
			
			
			
		
		
		}
	
	
	
	
	
	