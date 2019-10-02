$(document).ready(function(){
	$(function(){
		$('#signup').on('click',function(e){
			$('.form1').css('display','none');
			$('.form2').css('display','inline');
			e.preventDefault();		
		});
	});
	$(function(){
		$('#login').on('click',function(e){
			$('.form1').css('display','inline');
			$('.form2').css('display','none');
			e.preventDefault();		
		});
	});

});