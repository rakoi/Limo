$('doument').ready(function (){
	$('#form').hide();
	$('.allcomments').hide();
	$('.hideallcomments').hide();

});
$('#rate').click(function(){
      $('#form').show();
      $('#rate').hide();
    });


$('.viewallcomments').click(function(){
		$('.allcomments').show();
		$('.viewallcomments').hide();
		$('.hideallcomments').show();
});

$('.hideallcomments').click(function(){
		$('.hideallcomments').hide();
		$('.allcomments').hide();
		$('.viewallcomments').show();
});