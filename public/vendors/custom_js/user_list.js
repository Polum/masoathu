$(function(){
    $.get(userListUrl, function(data){
        var output = "";
        console.log(data);
        for ( var i = 0; i< data.length;i++){
            /*switch (data[i].user_type){
                case
            } */
            output+="<tr>\n" +
                "                                                <td>"+ data[i].name +"</td>\n" +
                "                                                <td>"+ data[i].email +"</td>\n" +
                "                                                <td>"+ userType(data[i].user_type) +"</td>\n" +
                "\n" +
                "                                                <td>" +
                "<a class=\"btn btn-primary btn-icon-anim btn-square\" href=\""+editUserUrl+"\\"+data[i].id+"\"><i class=\"fa fa-pencil\"></i></a>" +
                "<button class=\"btn btn-danger btn-icon-anim btn-square\"><i class=\"fa fa-times\"></i></button>" +
                "<button class=\"btn btn-warning btn-icon-anim btn-square\"><i class=\"fa fa-exclamation-triangle\"></i></button>" +

                "</td>\n" +
                "                                            </tr>";
        }

        $(".user-list").html(output).hide().fadeIn("slow");

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

function userType(userTypeNumber){
    var type;
    switch(userTypeNumber){
        case 1:
            type = "System Administrator";
            break;
        case 2:
            type = "System User";
            break;
        case 3:
            type = "Data Clerk";
            break;
        default:
            type = "User";
    }
    return type;
}
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