$(document).ready(function(){
	
	$('.js-comments').on('click', '.js-respond', function(){
		
		jForm = $('#js-form');
		jForm.find('input[name="CommentForm[parent_id]"]').val( $(this).prop('id') );
		jForm.find('input[name="CommentForm[path]"]').val( $(this).data('path') );
		jForm.find('input[name="CommentForm[level]"]').val( $(this).data('level') );
		
		$(this).after(jForm);
		jForm.find(".js-error").hide();
		
		return false; 
	});
	
	$('.js-comments').on('submit', '#js-form', function(e){
		
		var jForm = $('#js-form');

		e.preventDefault();
		e.stopImmediatePropagation();
		
		
		var jAfter = $('ul li:last');
		
		if ( $(this).parents('li').length ){
			jAfter = $(this).parents('li');
		} 
		
		$.ajax({
			  type: 'POST',
			  url: '/?r=json/create',
			  data: 'name=' +                  jForm.find('input[name="CommentForm[name]"]').val()
			  				+ '&email=' +      jForm.find('input[name="CommentForm[email]"]').val()
			  				+ '&article_id=' + jForm.find('input[name="CommentForm[article_id]"]').val()
			  				+ '&parent_id=' +  jForm.find('input[name="CommentForm[parent_id]"]').val()
			  				+ '&path=' +       jForm.find('input[name="CommentForm[path]"]').val()
			  				+ '&text=' +       jForm.find('input[name="CommentForm[text]"]').val(),
			}).done(function(data) {
				
					if (data.success) {
						  level = parseInt(jForm.find('input[name="CommentForm[level]"]').val())+1;
							
						  jAfter.after(
									'<li style="padding-left: ' +level*40 + 'px;">'
				            		   	+ '<b>' + data.model.name + '</b> | ' + data.model.email + ' |' 
				            		   	+ '<i>' + data.model.created_at + '</i>'
				            		    + '<p>' + linkify(data.model.text) + '</p>'
				            		    + '<p><a href="#" class="js-respond" id="' 
				            		    + data.model.id +'" data-path="' 
				            		    + data.model.path + '" data-level="' 
				            		    + level + '">Ответить</a></p>'
				            			+ '<hr>'
				            		+'</li>'
				            		);
						  
						  $('.js-form-holder').append(jForm);
					} else {
						jForm.find(".js-error").show().html(data.message);
					}
				
				  
			  })
			  .fail(function() {
				  jForm.find(".js-error").show().html('Ошибка добавления комментария');
			  });
			  

		return false; 
	});
	
});

function linkify(inputText) {
    var replacedText, replacePattern1, replacePattern2, replacePattern3;

    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    return replacedText;
}