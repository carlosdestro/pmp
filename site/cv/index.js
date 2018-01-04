$(function()
{

	$("input").keydown(function(a)
	{
		setTimeout(function(){
	        a.target.value = a.target.value.toUpperCase();
	    }, 1);
	});



});