$(function(){
    console.log("here");

    $.get(questionListUrl, function(data){
        console.log(data);
        let output = "";
        for ( var i = 0; i< data.length;i++){
            let category;
            let questionType;

            switch (data[i].category_id){
                case 1:
                    category = "Voter Info & Education";
                    break;
                case 2:
                    category = "Voter Registration";
                    break;
                case 3:
                    category = "Primary Elections";

            }

            switch (data[i].type_id){
                case 1:
                    questionType = "Yes or No";
                    break;
                case 2:
                    questionType = "Range";
                    break;
                case 3:
                    questionType = "Multiple Choice";
                    break;
                case 4:
                    questionType = "Number";
                    break;
                case 5:
                    qestionType = "Gender";
                    break;
                case 6:
                    questionType = "Other";

            }

            let hasExplanation = (data[i].has_explanation === 1) ? ("Yes") : ("No");
           output+="<tr>\n" +
               "                                                <td>"+ category +"</td>\n" +
               "                                                <td>"+ data[i].body +"</td>\n" +
               "                                                <td>"+ questionType +"</td>\n" +
               "                                                <td>"+ hasExplanation +"</td>\n" +
               "                                                <td>" +
               "<button class=\"btn btn-primary btn-icon-anim btn-square\"><i class=\"fa fa-pencil\"></i></button>" +
               "<button class=\"btn btn-danger btn-icon-anim btn-square\"><i class=\"fa fa-times\"></i></button>" +
               "</td>\n" +
               "</tr>";
       }

       $(".question-list").html(output).hide().fadeIn("slow");

       $.loadScript(dtscript1, function () {

       });

       $.loadScript(dtscript2, function () {

       });

       $.loadScript(dtscript3, function () {

       });
       $.loadScript(dtscript4, function () {

       });
       $.loadScript(dtscript5, function () {

       });
       $.loadScript(dtscript6, function () {

       });
       $.loadScript(dtscript7, function () {

       });
       $.loadScript(dtscript8, function () {

       });
   });
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