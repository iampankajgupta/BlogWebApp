$(document).ready(function(){
	$("#comment_btn").on('click',function(){
		var comment = $('#comment_text_box').val();
		if(comment.length > 3){
			$.ajax({
				url:'showClickedPage.php',
				method:'POST',
				dataType:'text',
				data:{
					addComment:1,
					comment:comment
				},success:function (response){
					console.log(response);
				}
			});
		}
	});

});