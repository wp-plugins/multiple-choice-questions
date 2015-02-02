<?php

function mcq_themes_flat($post_id)
	{
		
		
		$mcq_questions = get_post_meta( $post_id, 'mcq_questions', true );		
		$mcq_questions_ans = get_post_meta( $post_id, 'mcq_questions_ans', true );
		$mcq_questions_correct_ans = get_post_meta( $post_id, 'mcq_questions_correct_ans', true );		
		$mcq_questions_hint = get_post_meta( $post_id, 'mcq_questions_hint', true );
		
		$mcq_question_font_color = get_post_meta( $post_id, 'mcq_question_font_color', true );
		$mcq_question_font_size = get_post_meta( $post_id, 'mcq_question_font_size', true );		
		$mcq_answers_font_color = get_post_meta( $post_id, 'mcq_answers_font_color', true );
		$mcq_answers_font_size = get_post_meta( $post_id, 'mcq_answers_font_size', true );		
								
		
		
		$html = '';
	
		$html .= '<div class="mcq-main flat">';
		
		
		$html .= '<ul class="mcq-questions-list">';
		
		$k = 1;
		foreach($mcq_questions as $key => $question)
			{
				$html .= '<li class="questions-single">';
				$html .= '<div class="question" style="color:#'.$mcq_question_font_color.';font-size:'.$mcq_question_font_size.';">'.$k.'. '.$question.'</div>';
				$html .= '<div class="question-hint">'.$mcq_questions_hint[$key].'</div>';				
				
				$html .= '<ul class="ans-list" >';		
				for($i=1; $i<=4; $i++)
					{

						if(!empty($mcq_questions_ans[$i][$key]))
							{
								$html .= '<li style="color:#'.$mcq_answers_font_color.';font-size:'.$mcq_answers_font_size.';" class="ans-single">';
								$html .= '<label><input qid="'.$key.'" type="radio" class="mcq_questions_ans" name="mcq_questions_ans['.$key.']" value="'.$i.'">';									
								$html .= $mcq_questions_ans[$i][$key];								
								$html .= '</label></li>';
							}

					}
				$html .= '</ul>';		
					
				$html .= '</li>';
				

				$k++;
			}
		$html .= '</ul>';
		
		$html .= '<div  class="mcq-submit" mcq-id="'.$post_id.'">Submit</div>';

		
		$html .= '<div  class="mcq-result">';
		$html .= '</div>';		
		
		$html .= '</div>';

		return $html;

		
	}