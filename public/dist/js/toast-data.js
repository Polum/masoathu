/*Toast Init*/


$(document).ready(function() {
	"use strict";
	
	$.toast({
		heading: 'Welcome to the mHub Situation Room Dashboard',
		text: '',
		position: 'top-right',
		loaderBg:'#3cb878',
		icon: 'error',
		hideAfter: 3000, 
		stack: 6
	});
	
	$('.tst1').on('click',function(e){
	    $.toast().reset('all'); 
		$("body").removeAttr('class');
		$.toast({
            heading: 'Welcome to mHub Situation Room Dashboard',
            text: '',
            position: 'top-right',
            loaderBg:'#3cb878',
            icon: 'info',
            hideAfter: 3000, 
            stack: 6
        });
		return false;
    });

	$('.tst2').on('click',function(e){
        $.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            heading: 'Welcome to the mHub Situation Room Dashboard',
            text: '',
            position: 'top-right',
            loaderBg:'#3cb878',
            icon: 'warning',
            hideAfter: 3500, 
            stack: 6
        });
		return false;
	});
	
	$('.tst3').on('click',function(e){
        $.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            heading: 'Welcome to the mHub Situation Room Dashboard',
            text: '',
            position: 'top-right',
            loaderBg:'#3cb878',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
		return false;  
	});

	$('.tst4').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            heading: 'Welcome to the mHub Situation Room Dashboard',
            text: '',
            position: 'top-right',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
    });
	
	$('.tst5').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class');
		$.toast({
            heading: 'top left',
            text: '',
            position: 'top-left',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
    });
	
	$('.tst6').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            heading: 'top right',
            text: '',
            position: 'top-right',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
    });
	
	$('.tst7').on('click',function(e){
		$.toast().reset('all');
		$("body").removeAttr('class');
		$.toast({
            heading: 'bottom left',
            text: '',
            position: 'bottom-left',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
    });
	
	$('.tst8').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class');
		$.toast({
            heading: 'bottom right',
            text: '',
            position: 'bottom-right',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
	});
	
	$('.tst9').on('click',function(e){
	    $.toast().reset('all');   
		$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
		$.toast({
            heading: 'top center',
            text: '',
            position: 'top-center',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
	});
	
	$('.tst10').on('click',function(e){
	    $.toast().reset('all');
		$("body").removeAttr('class').addClass("bottom-center-fullwidth");
		$.toast({
            heading: 'bottom right',
            text: '',
            position: 'bottom-center',
            loaderBg:'#3cb878',
            icon: 'error',
            hideAfter: 3500
        });
		return false;
	});
});
          
