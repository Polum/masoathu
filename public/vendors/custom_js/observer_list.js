$(function(){
    $.get(observerListUrl, function(data){
        var output = "";
        console.log(data);
        for ( var i = 0; i< data.length;i++){
            let gender = (data[i].gender === "M") ? ("Male") : ("Female");
            let device = (data[i].device === 1) ? ("Yes") : ("No");
            output+="<tr>\n" +
                "                                                <td>"+ data[i].first_name +"</td>\n" +
                "                                                <td>"+ data[i].first_name +"</td>\n" +
                "                                                <td>"+ gender +"</td>\n" +
                "                                                <td> +265"+ data[i].phone_number +"</td>\n" +
                "                                                <td>"+ data[i].polling_station_id +"</td>\n" +
                "                                                <td>"+ device +"</td>\n" +
                "\n" +
                "                                                <td>" +
                "<button class=\"btn btn-primary btn-icon-anim btn-square\"><i class=\"fa fa-pencil\"></i></button>" +
                "<button class=\"btn btn-danger btn-icon-anim btn-square\"><i class=\"fa fa-times\"></i></button>" +
                "<button class=\"btn btn-warning btn-icon-anim btn-square\"><i class=\"fa fa-exclamation-triangle\"></i></button>" +

                "</td>\n" +
                "                                            </tr>";
        }

        $(".observer-list").html(output).hide().fadeIn("slow");

        $.loadScript(fancyDropDownScript, function () {
            console.log("script 1 loaded");
        });

        $.loadScript(dtscript1, function () {
            console.log("script 1 loaded");
        });

        $.loadScript(dtscript2, function () {
            console.log("script 2 loaded");
        });

        $.loadScript(dtscript3, function () {
            console.log("script 3 loaded");
        });

        $.loadScript(dtscript4, function () {
            console.log("script 4 loaded");
        });

        $.loadScript(dtscript5, function () {
            console.log("script 5 loaded");
        });

        $.loadScript(dtscript6, function () {
            console.log("script 6 loaded");
        });

        $.loadScript(dtscript7, function () {
            console.log("script 7 loaded");
        });

        $.loadScript(dtscript8, function () {
            console.log("script 8 loaded");
        });
    })

});
/**
 * function to load external js scripts dynamically
 * @param url
 * @param callback
 */
jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}