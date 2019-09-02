$(function () {

    var region = [];
    var districts = [];
    var constituencies = [];
    var wards = [];
    var centres = [];
    var candidates = [];

    $.get(baseUrl+"/candidates/list", function(data){ 
        candidates = data;
        $.each(candidates, function(index, value){
            $('.candidate').append("<option value="+value.id+">"+value.name+"</option>");
        });
    });
    $.get(baseUrl+"/regions", function(data){ 
        region = data;
        $.each(region, function(index, value){
            $('.region').append("<option value="+value.id+">"+value.name+"</option>");
        });
    });
    $.get(baseUrl+"/districts/list", function(data){ 
        districts = data;
    });
    $.get(baseUrl+"/constituencies/list", function(data){ 
        constituencies = data;
    });
    $.get(baseUrl+"/wards/list", function(data){ 
        wards = data;
    });
    $.get(baseUrl+"/centres/list", function(data){ 
        centres = data;
    });


    $('.region').on('change', function(){
        let region_id = $('.region').val();
        $('.district').html('');
        $.each(districts, function(index, value){
            if(value.region_id == region_id){
                $('.district').append("<option value="+value.id+">"+value.name+"</option>");
            }
        });
    });
    $('.district').on('change', function(){
        let district_id = $('.district').val();
        $('.constituency').html('');
        $.each(constituencies, function(index, value){
            if(value.district_id == district_id){
                $('.constituency').append("<option value="+value.id+">"+value.name+"</option>");
            }
        });
    });
    $('.constituency').on('change', function(){
        let constituency_id = $('.constituency').val();
        $('.ward').html('');
        $.each(wards, function(index, value){
            if(value.constituency_id == constituency_id){
                $('.ward').append("<option value="+value.id+">"+value.name+"</option>");
            }
        });
    });
    $('.ward').on('change', function(){
        let ward_id = $('.ward').val();
        $('.centre').html('');
        $.each(centres, function(index, value){
            if(value.ward_id == ward_id){
                $('.centre').append("<option value="+value.id+">"+value.name+"</option>");
            }
        });
    });

});