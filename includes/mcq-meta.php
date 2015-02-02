<?php


function mcq_posttype_register() {
 
        $labels = array(
                'name' => _x('MCQ', 'mcq'),
                'singular_name' => _x('MCQ', 'mcq'),
                'add_new' => _x('New MCQ', 'mcq'),
                'add_new_item' => __('New MCQ'),
                'edit_item' => __('Edit MCQ'),
                'new_item' => __('New MCQ'),
                'view_item' => __('View MCQ'),
                'search_items' => __('Search MCQ'),
                'not_found' =>  __('Nothing found'),
                'not_found_in_trash' => __('Nothing found in Trash'),
                'parent_item_colon' => ''
        );
 
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => null,
                'rewrite' => true,
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title'),
				'menu_icon' => 'dashicons-media-spreadsheet',
				
          );
 
        register_post_type( 'mcq' , $args );

}

add_action('init', 'mcq_posttype_register');





/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_mcq()
	{
		$screens = array( 'mcq' );
		foreach ( $screens as $screen )
			{
				add_meta_box('mcq_metabox',__( 'MCQ Options','mcq' ),'meta_boxes_mcq_input', $screen);
			}
	}
add_action( 'add_meta_boxes', 'meta_boxes_mcq' );


function meta_boxes_mcq_input( $post ) {
	
	global $post;
	wp_nonce_field( 'meta_boxes_mcq_input', 'meta_boxes_mcq_input_nonce' );
	
	
	$mcq_bg_img = get_post_meta( $post->ID, 'mcq_bg_img', true );
	$mcq_themes = get_post_meta( $post->ID, 'mcq_themes', true );
	
	$mcq_question_font_color = get_post_meta( $post->ID, 'mcq_question_font_color', true );	
	$mcq_question_font_size = get_post_meta( $post->ID, 'mcq_question_font_size', true );
	
	$mcq_answers_font_color = get_post_meta( $post->ID, 'mcq_answers_font_color', true );	
	$mcq_answers_font_size = get_post_meta( $post->ID, 'mcq_answers_font_size', true );		
	
	$mcq_content_title = get_post_meta( $post->ID, 'mcq_content_title', true );	
	$mcq_content_body = get_post_meta( $post->ID, 'mcq_content_body', true );
	
	$mcq_questions = get_post_meta( $post->ID, 'mcq_questions', true );
	$mcq_questions_point = get_post_meta( $post->ID, 'mcq_questions_point', true );	
	$mcq_questions_ans = get_post_meta( $post->ID, 'mcq_questions_ans', true );	 
	$mcq_questions_correct_ans = get_post_meta( $post->ID, 'mcq_questions_correct_ans', true );	 
	$mcq_questions_hint = get_post_meta( $post->ID, 'mcq_questions_hint', true );
	 
	$mcq_pass_mark = get_post_meta( $post->ID, 'mcq_pass_mark', true );

?>




    <div class="para-settings">

        <div class="option-box">
            <p class="option-title">Shortcode</p>
            <p class="option-info">Copy this shortcode and paste on page or post where you want to display mcq, Use PHP code to your themes file to display mcq.</p>
        <br /> 
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" >[mcq <?php echo ' id="'.$post->ID.'"';?> ]</textarea>
        <br />
        PHP Code:<br />
        <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[mcq id='; echo "'".$post->ID."' ]"; echo '"); ?>'; ?></textarea>  
        
        </div>
        
        
        <ul class="tab-nav"> 
            <li nav="1" class="nav1 active">Style</li>
            <li nav="2" class="nav2">Questions</li>
            
        </ul> <!-- tab-nav end -->
        
		<ul class="box">
            
            <li style="display: block;" class="box1 tab-box active">
				<div class="option-box">
                    <p class="option-title">Themes</p>
                    <p class="option-info"></p>
                    <select class="mcq_themes" name="mcq_themes"  >
                    <option  value="flat" <?php if($mcq_themes=="flat")echo "selected"; ?>>Flat</option>
                    </select>
                </div>
                
				<div class="option-box">
                    <p class="option-title">Background Image</p>
                    <p class="option-info"></p>
					<script>
                    jQuery(document).ready(function(jQuery)
                        {
                                jQuery(".mcq_bg_img_list li").click(function()
                                    { 	
                                        jQuery('.mcq_bg_img_list li.bg-selected').removeClass('bg-selected');
                                        jQuery(this).addClass('bg-selected');
                                        
                                        var mcq_bg_img = jQuery(this).attr('data-url');
                    
                                        jQuery('#mcq_bg_img').val(mcq_bg_img);
                                        
                                    })	
                    
                                        
                        })
                    
                    </script> 
                    
            
					<?php
                    
                    
                    
                        $dir_path = mcq_plugin_dir."css/bg/";
                        $filenames=glob($dir_path."*.png*");
                    
                    
                        $mcq_bg_img = get_post_meta( $post->ID, 'mcq_bg_img', true );
                        
                        if(empty($mcq_bg_img))
                            {
                            $mcq_bg_img = "";
                            }
                    
                    
                        $count=count($filenames);
                        
                    
                        $i=0;
                        echo "<ul class='mcq_bg_img_list' >";
                    
                        while($i<$count)
                            {
                                $filelink= str_replace($dir_path,"",$filenames[$i]);
                                
                                $filelink= mcq_plugin_url."css/bg/".$filelink;
                                
                                
                                if($mcq_bg_img==$filelink)
                                    {
                                        echo '<li  class="bg-selected" data-url="'.$filelink.'">';
                                    }
                                else
                                    {
                                        echo '<li   data-url="'.$filelink.'">';
                                    }
                                
                                
                                echo "<img  width='70px' height='50px' src='".$filelink."' />";
                                echo "</li>";
                                $i++;
                            }
                            
                        echo "</ul>";
                        
                        echo "<input style='width:100%;' value='".$mcq_bg_img."'    placeholder='Please select image or left blank' id='mcq_bg_img' name='mcq_bg_img'  type='text' />";
                    
                    
                    
                    ?>

                    
                   
				</div>



				<div class="option-box">
                    <p class="option-title">Question Font Color</p>
                    <p class="option-info"></p>
                    <input class="color" type="text" name="mcq_question_font_color" value="<?php if(!empty($mcq_question_font_color)) echo $mcq_question_font_color; ?>" />                </div>


				<div class="option-box">
                    <p class="option-title">Question Font Size</p>
                    <p class="option-info"></p>
                    
                    <input type="text" name="mcq_question_font_size" placeholder="ex:14px number with px" id="mcq_question_font_size" value="<?php if(!empty($mcq_question_font_size)) echo $mcq_question_font_size; else echo "15px"; ?>" />
                    
                </div>


				<div class="option-box">
                    <p class="option-title">Answers Font Color</p>
                    <p class="option-info"></p>
                    <input class="color" type="text" name="mcq_answers_font_color" value="<?php if(!empty($mcq_answers_font_color)) echo $mcq_answers_font_color; ?>" />
                </div>
                

				<div class="option-box">
                    <p class="option-title">Answers Font Size</p>
                    <p class="option-info"></p>
                    <input type="text" name="mcq_answers_font_size" id="mcq_answers_font_size" value="<?php if(!empty($mcq_answers_font_size)) echo $mcq_answers_font_size; else echo "14px"; ?>" />
                </div>                
                
                
                
                            
            </li>
            <li style="display: none;" class="box2 tab-box ">
				
				<div class="option-box">
                    <p class="option-title">Pass Marks</p>
                    <p class="option-info">Number Only.</p>
                    <input type="text" name="mcq_pass_mark"value="<?php if(!empty($mcq_pass_mark)) echo $mcq_pass_mark; ?>" />
                </div> 
                
				<div class="option-box">
                    <p class="option-title">MCQ Questions</p>
                    <p class="option-info"></p>
                    
                    <div class="mcq-admin-questions">
                    <table class="questions-list">
                    
                    <?php
					
					if(empty($mcq_questions))
						{
							$mcq_questions = array('1'=>'');
						}
                    
						foreach($mcq_questions as $key => $question)
							{
								echo '<tr><td>';
								echo '<input placeholder="Question..." type="text" class="mcq-question" name="mcq_questions['.$key.']" value="'.$question.'" />';
								
								echo '<ul class="mcq-ans-list mcq-ans-list-'.$key.'">';
								
								for($i=1; $i<=4; $i++)
									{
										echo '<li class="mcq-ans"><input placeholder="Answer..."  type="text" value="'.$mcq_questions_ans[$i][$key].'" name="mcq_questions_ans['.$i.']['.$key.']" /></li>';

									
									}

								
								
								
								echo '</ul>';
								//echo '<div class="add-ans button" qid="'.$key.'">Add Ans</div>';
								echo 'Correct Answer(Answers number from above, number only)<br />';
								echo '<input placeholder="ex: 3" type="text" value="'.$mcq_questions_correct_ans[$key].'" name="mcq_questions_correct_ans['.$key.']" />';
								echo '<br />Question Point(Marks for correct answer, calculated for pass mark.):<br />';
								echo '<input placeholder="" type="text" value="'.$mcq_questions_point[$key].'" name="mcq_questions_point['.$key.']" />';								
								
								echo '<br />Question description or hint<br />';
								echo '<input type="text" value="'.$mcq_questions_hint[$key].'" name="mcq_questions_hint['.$key.']" /><br /><br /><hr /><br />';								
								
								echo '</td></tr>';
							
							}
					?>
                    </table>
                    <div class="add-questions button">Add Question</div>
                    </div>
                </div>
                  
            </li>
        
        </ul>
        


    </div> <!-- para-settings -->



<?php


	
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function meta_boxes_mcq_save( $post_id ) {

  /*
   * We need to verify this came from the our screen and with proper authorization,
   * because save_post can be triggered at other times.
   */

  // Check if our nonce is set.
  if ( ! isset( $_POST['meta_boxes_mcq_input_nonce'] ) )
    return $post_id;

  $nonce = $_POST['meta_boxes_mcq_input_nonce'];

  // Verify that the nonce is valid.
  if ( ! wp_verify_nonce( $nonce, 'meta_boxes_mcq_input' ) )
      return $post_id;

  // If this is an autosave, our form has not been submitted, so we don't want to do anything.
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
      return $post_id;



  /* OK, its safe for us to save the data now. */

  // Sanitize user input.
	$mcq_bg_img = sanitize_text_field( $_POST['mcq_bg_img'] );	
	$mcq_themes = sanitize_text_field( $_POST['mcq_themes'] );

	$mcq_question_font_color = sanitize_text_field( $_POST['mcq_question_font_color'] );	
	$mcq_question_font_size = sanitize_text_field( $_POST['mcq_question_font_size'] );	

	$mcq_answers_font_color = sanitize_text_field( $_POST['mcq_answers_font_color'] );	
	$mcq_answers_font_size = sanitize_text_field( $_POST['mcq_answers_font_size'] );	
	
	$mcq_content_title = stripslashes_deep( $_POST['mcq_content_title'] );	
	$mcq_content_body = stripslashes_deep( $_POST['mcq_content_body'] );		
	
	$mcq_questions = stripslashes_deep( $_POST['mcq_questions'] );
	$mcq_questions_point = stripslashes_deep( $_POST['mcq_questions_point'] );	
	$mcq_questions_ans = stripslashes_deep( $_POST['mcq_questions_ans'] );	
	$mcq_questions_correct_ans = stripslashes_deep( $_POST['mcq_questions_correct_ans'] );		
	$mcq_questions_hint = stripslashes_deep( $_POST['mcq_questions_hint'] );
	
	$mcq_pass_mark = sanitize_text_field( $_POST['mcq_pass_mark'] );				


  // Update the meta field in the database.
	update_post_meta( $post_id, 'mcq_bg_img', $mcq_bg_img );	
	update_post_meta( $post_id, 'mcq_themes', $mcq_themes );

	update_post_meta( $post_id, 'mcq_question_font_color', $mcq_question_font_color );
	update_post_meta( $post_id, 'mcq_question_font_size', $mcq_question_font_size );

	update_post_meta( $post_id, 'mcq_answers_font_color', $mcq_answers_font_color );
	update_post_meta( $post_id, 'mcq_answers_font_size', $mcq_answers_font_size );
	
	update_post_meta( $post_id, 'mcq_content_title', $mcq_content_title );
	update_post_meta( $post_id, 'mcq_content_body', $mcq_content_body );	
	
	update_post_meta( $post_id, 'mcq_questions', $mcq_questions );
	update_post_meta( $post_id, 'mcq_questions_point', $mcq_questions_point );	
	update_post_meta( $post_id, 'mcq_questions_ans', $mcq_questions_ans );	
	update_post_meta( $post_id, 'mcq_questions_correct_ans', $mcq_questions_correct_ans );
	update_post_meta( $post_id, 'mcq_questions_hint', $mcq_questions_hint );

	update_post_meta( $post_id, 'mcq_pass_mark', $mcq_pass_mark );


}
add_action( 'save_post', 'meta_boxes_mcq_save' );


























?>