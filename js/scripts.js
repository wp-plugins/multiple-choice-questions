jQuery(document).ready(function($)
	{



		$(document).on('click', '.mcq-submit', function()
			{
				
				$(this).addClass('loading');
				
				var mcq_id = $(this).attr('mcq-id');
								

				ans = [];

				$(".mcq_questions_ans:checked").each(function() {
				
				var qid = $(this).attr('qid');
				ans[ qid ] = $(this).val();

				});

				
				
				$.ajax(
					{
				type: 'POST',
				url:mcq_ajax.mcq_ajaxurl,
				data: {"action": "mcq_check_result", "mcq_id":mcq_id, "ans":ans},
				success: function(data)
						{	
							
							$('.mcq-submit').removeClass('loading');
							$('.mcq-result').html(data);
	
						
						}
					});
				
				
				
			})






		$(document).on('click', '.add-ans', function()
			{
				var row = $('.mcq-ans-list li').length;
				var qid = $(this).attr('qid');
				
				$(".mcq-ans-list-"+qid).append('<li class="mcq-ans"><input type="text" value="" name="mcq_questions_ans['+row+']['+qid+']" /></li>');

			
			})


		$(document).on('click', '.add-questions', function()
			{
				var row = parseInt($('.questions-list tr').length+1);
				
				
				str = '';
				str += '<tr><td><input type="text" class="mcq-question" name="mcq_questions['+row+']" value="" /><ul class="mcq-ans-list mcq-ans-list-'+row+'">';
				for(i=1; i<=4;i++)
					{
					str += '<li class="mcq-ans"><input type="text" value="" name="mcq_questions_ans['+i+']['+row+']" /></li>';
					}
							
				
				str += '</ul>';				
				
				str += 'Correct Answer<br />';						
				str += '<input type="text" value="" name="mcq_questions_correct_ans['+row+']" />';
				str += '<br />Question Point:<br />';									
				str += '<input type="text" value="" name="mcq_questions_point['+row+']" />';				
				str += '<br />Answer Hint<br />';
				str += '<input type="text" value="" name="mcq_questions_hint['+row+']" /><br /><br /><hr /><br />';								
				
				
				str += '</td></tr>';				
				
				$(".questions-list").append(str);

			
			})



		

	
 		

	});