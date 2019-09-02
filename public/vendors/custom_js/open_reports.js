$(function () {

    //get the height of the loader-overlay-parent and set it to the loader-overlay
    $(".loader-overlay").height($(".loader-overlay-parent").height());
    $(".loader-overlay").width($(".loader-overlay-parent").width());

    //get reg centers
    $.get(regCenterUrl, function (data) {
        $(".progress").html("<h4>Loading Question Data</h4>").hide().fadeIn("slow");
        regCentersData = data;
    }).done(function () {
        //get Questions
        $.get(questionSetUrl, function (data) {
            questionSetData = data;
        }).done(function () {
            $(".progress").html("<h4>Loading Observer Data</h4>").hide().fadeIn("slow");
            //get the observers numbers to map to the sent sms numbers
            $.get(observerUrl, function (observerData) {
                $(".progress").html("<h4>Loading Message Data</h4>").hide().fadeIn("slow");
                $.get(smsUrl, function (smsData) {
                    console.log(smsData);
                    let output = "";
                    //sent the count of sent messages
                    $(".mobile-app").html(smsData.length);
                    for ($x = 0; $x < smsData.length; $x++) {
                        $(".loader-overlay").hide();
                        //convert date
                        let smsSentDate = Date.createFromMysql(smsData[$x].created_at);
                        let smsHours = ("0" + (smsSentDate.getHours() + 2)).slice(-2);
                        let smsMinutes = ("0" + smsSentDate.getMinutes()).slice(-2);
                        output += "<tr>\n" +
                            "                                                        <td>" + fromChannel(smsData[$x].number) + "</td>\n" +
                            "                                                        <td id=\"number_column_" + smsData[$x].id + "\">" + observerNumberMapping(smsData[$x].number, observerData) + "</td>\n" +
                            "                                                        <td id=\"body_column_" + smsData[$x].id + "\">" + smsData[$x].text.substring(0, 15) + "...</td>\n" +
                            "                                                        <td>" + smsHours + ":" + smsMinutes + " on " + months[smsSentDate.getMonth()] + " " + smsSentDate.getDate() + "</td>\n";
                        output += "<td>" + SmsReader(smsData[$x].text) + " </td>";
                        output += "<td>" +
                            "<button class=\"btn btn-primary btn-icon-anim btn-square edit-message\" data-toggle=\"modal\" data-target=\"#exampleModal\" data-body=\"" + smsData[$x].text + "\" data-sender=\"" + observerNumberMapping(smsData[$x].number, observerData) + "\" data-id=\"" + smsData[$x].id + "\" ><i class=\"fa fa-pencil\"></i></button>" +
                            "<button class=\"btn btn-danger btn-icon-anim btn-square \"><i class=\"fa fa-times\"></i></button>" +
                            "<button class=\"btn btn-default btn-icon-anim btn-square flag-message\" id=\""+smsData[$x].id+"\"><i class=\"fa fa-flag-o\"></i></button>" +
                            //"<button class=\"btn btn-default btn-icon-anim btn-square flag-message\" onclick=\"event.preventDefault();document.getElementById('flag-message-form').submit();\"><i class=\"fa fa-flag-o\"></i></button><form id=\"flag-message-form\" action=\""+store_flagged_resources_url+"\" method=\"POST\" style=\"display: none;\"><input type=\"hidden\" name=\"_token\" value=\" "+ token +"\"><input type=\"hidden\" name=\"incident_id\" value=\"1\"><input type=\"hidden\" name=\"user_id\" value=\"1\"> </form>" +
                            "<div class=\"modal fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"exampleModalLabel1\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t<div class=\"modal-dialog\" role=\"document\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"modal-content\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"modal-header\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"recipient-name\" class=\"control-label mb-10\">Sender:</label>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" id=\"recipient-name1\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"message-text\" class=\"control-label mb-10\">Message:</label>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<textarea class=\"form-control\"  id=\"message-text1\"></textarea> <input type=\"hidden\" name=\"edit_sms_id\" id=\"edit_sms_id\"  \" \n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t</form>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"modal-footer\">\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<button type=\"submit\" data-dismiss=\"modal\" class=\"btn btn-primary model-submit\">Save</button>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t\t</div>\n" +
                            "\t\t\t\t\t\t\t\t\t\t</div>" +
                            "</td>\n" +
                            "\n" +
                            "        </tr>";
                        output += "</tr>";
                        /*output += "<tr>\n" +
                            "        <td>Mobile-App</td>\n" +
                            "        <td>" + observerNumberMapping(smsData[$x].number, observerData) + "</td>\n" +
                            "        <td>" + smsData[$x].text.substring(0, 15) + "...</td>\n" +
                            "        <td>" + smsHours + ":" + smsMinutes + " on " + months[smsSentDate.getMonth()] + " " + smsSentDate.getDay() + "</td>\n";
                        output += SmsReader(smsData[$x].text);

                        output += "<td>" +
                            "<button class=\"btn btn-primary btn-icon-anim btn-square\"><i class=\"fa fa-pencil\"></i></button>" +
                            "<button class=\"btn btn-danger btn-icon-anim btn-square\"><i class=\"fa fa-times\"></i></button>" +
                            "<button class=\"btn btn-warning btn-icon-anim btn-square\"><i class=\"fa fa-exclamation-triangle\"></i></button>" +
                            "</td>\n" +
                            "\n" +
                            "        </tr>";*/

                    }

                    $(".sms-text-list").html(output).hide().fadeIn("slow");
                    console.log("Script :" + fancyDropDownScript);
                    $.loadScript(fancyDropDownScript, function () {
                        console.log("script 0 loaded");
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


                });
            });
        }).fail(function () {
            console.log("Questions Fail");
        });
    }).fail(function () {
        console.log("regData Fail");
    });


    Date.createFromMysql = function (mysql_string) {
        var t, result = null;

        if (typeof mysql_string === 'string') {
            t = mysql_string.split(/[- :]/);

            //when t[3], t[4] and t[5] are missing they defaults to zero
            result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
        }

        return result;
    };

    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

    //onclick function for the edit
    /*$(".sms-text-list").on("click", "button.edit-message", function(){
        alert("Edit");
    });*/
    /**
     * Edit, flag and delete a message
     */
    //flag messages
    //alert(token);
    $(".sms-text-list").on("click", "button.flag-message", function(){
        //alert($(this).attr("id"));
        var myKeyVals = {"incident_id": $(this).attr("id"), "user_id": userId, "resolved": 0, "_token": token};
        var saveData = $.ajax({
            type: 'POST',
            url: store_flagged_resources_url,
            data: myKeyVals,
            dataType: "text",
            success: function (resultData) {
                alert("Message Flagged"+resultData)
            }
        });
        saveData.error(function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Something went wrong: "+textStatus+" --- "+errorThrown+ "---"+XMLHttpRequest);
        });
    });
    $('.sms-text-list').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var sender_model = button.data('sender'); // Extract info from data-* attributes
        var text_model = button.data('body'); // Extract info from data-* attributes
        var id_model = button.data('id'); // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this);
        modal.find('#recipient-name1').val(sender_model);
        modal.find('#message-text1').val(text_model);
        modal.find('#edit_sms_id').val(id_model);

        //perform the action of the messages
        modal.find('.model-submit').on("click", function (e) {
            e.preventDefault();
            console.log("Here");
            console.log($("#edit_sms_id").val());
            let id = $("#edit_sms_id").val();

            $("#body_column_" + id).html($("#message-text1").val());
            $("#number_column_" + id).html($("#recipient-name1").val());


            var myKeyVals = {"text": text_model, "number": sender_model};
            var saveData = $.ajax({
                type: 'POST',
                url: smsUrl + "/" + id_model + "/edit",
                data: myKeyVals,
                dataType: "text",
                success: function (resultData) {
                    alert("Update Complete")
                }
            });
            saveData.error(function () {
                alert("Something went wrong");
            });
        });
        $('#edit_form').attr('action', smsUrl + "/" + id_model + "/edit");
    });
    $(".model-submit").submit(function (event) {
        console.log("Handler for .submit() called.");
        event.preventDefault();
    });

    /* $(".model-submit").on("submit", function (e) {
         e.preventDefault();
         console.log("Here");
         ("#body_column_"+$("#edit_sms_id").val()).html($("#message-text1").val());
         ("#number_column_"+$("#edit_sms_id").val()).html($("#message-text1").val());
     });*/
});

/**
 *
 * @param number
 * @returns {string}
 */
function fromChannel(number) {
    let sentNumber = number + "";
    if (sentNumber.substring(0, 3) === "265") {
        return "SMS - 6466";
    } else {
        return "Mobile - App";
    }
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
};

/**
 * @return {string}
 */
function SmsReader(text, number) {
    let sentNumber = number + "";
    if (sentNumber.substring(0, 3) === "265") {

        smsTextSplit = text.split(";");
        for (let m = 0; m < smsTextSplit.length; m++) {
            //if()
            let output = "<span class=\"label label-danger\">Incorrect - Format</span>";
            try {
                //check if message is correct or not correct
                if (smsTextSplit[0].substring(0, 3) === "ICD") {
                    output = "<span class=\"label label-success\">Correct - Incident</span>";
                    return output;
                } else {
                    for (let j = 0; j < regCentersData.length; j++) {
                        let regCenterCode = regCentersData[j].code + "";

                        //console.log(regCentersData[j].code+" -- "+regCenterCode);
                        if (smsTextSplit[0].substring(0) === regCenterCode) {
                            if (smsTextSplit[m].substring(0, 1) === "A" || smsTextSplit[m].substring(0, 1) === "B" || smsTextSplit[m].substring(0, 1) === "C" || smsTextSplit[m].substring(0, 1) === "D") {
                                if (!isNaN(smsTextSplit[m].substring(1, 2))) {
                                    if ((!isNaN(smsTextSplit[m].substring(2, 3))) || (smsTextSplit[m].substring(2, 3) === "E")) {
                                        output = "<span class=\"label label-success\">Correct</span>\n";
                                    }
                                } else {
                                    output = "<span class=\"label label-danger\">Incorrect - Q Category</span>";
                                }
                                break;
                            } else {
                                output = "<span class=\"label label-danger\">Incorrect - Reg Center</span>";
                            }
                        }
                    }
                }
            }
            catch
                (e) {
                console.log("An error=>" + e.toString() + " happened on sms: " + text);
                output = "<span class=\"label label-danger\">Incorrect - Whole Format</span>";
                //return output;
            }
        }
        return output;
    }
    else {
        smsTextSplit = text.split(";");
        let output = "<span class=\"label label-danger\">Incorrect - Format</span>";
        try {
            //check if message is correct or not correct
            if (smsTextSplit[0].substring(0, 3) === "ICD") {
                output = "<span class=\"label label-success\">Correct - Incident</span>";
                return output;
            } else {
                for (let j = 0; j < regCentersData.length; j++) {
                    let regCenterCode = regCentersData[j].code + "";

                    //console.log(regCentersData[j].code+" -- "+regCenterCode);
                    if (smsTextSplit[0].substring(0) === regCenterCode) {
                        if (smsTextSplit[1].substring(0, 1) === "A" || smsTextSplit[1].substring(0, 1) === "B" || smsTextSplit[1].substring(0, 1) === "C" || smsTextSplit[1].substring(0, 1) === "D") {
                            if (!isNaN(smsTextSplit[1].substring(1, 2))) {
                                if ((!isNaN(smsTextSplit[1].substring(2, 3))) || (smsTextSplit[1].substring(2, 3) === "E") || (smsTextSplit[1].substring(2, 3) === "q") || (smsTextSplit[1].substring(3, 4) === "q")) {

                                    //determine what question number it is
                                    let questionSplit = smsTextSplit[1].split("q");

                                    //if (smsTextSplit[1].substring(2, 3) === "q" || smsTextSplit[1].substring(3, 4) === "q" ) {
                                    if (questionSplit.length > 1) {
                                        for (let i = 0; i < questionSetData.length; i++) {
                                            let idString = questionSetData[i].id + "";
                                            //if (smsTextSplit[1].substring(3) === idString) {
                                            if (questionSplit[1].substring(0) === idString) {
                                                output = "<span class=\"label label-success\">Correct</span>\n";
                                            }
                                        }
                                    }
                                    //return "<span class=\"label label-danger\">Incorrect</span>\n";
                                    //return "<span class=\"label label-success\">Correct</span>\n";
                                } else if (smsTextSplit[1].substring(1, 2) === "2" && smsTextSplit[1].substring(0, 1) === "B") {
                                    output = "<span class=\"label label-success\">Correct</span>\n";
                                }
                            }

                        } else {
                            output = "<span class=\"label label-danger\">Incorrect - Q Category</span>";
                        }
                        break;
                    } else {
                        output = "<span class=\"label label-danger\">Incorrect - Reg Center</span>";
                    }
                }
            }
        } catch (e) {
            console.log("An error=>" + e.toString() + " happened on sms: " + text);
            output = "<span class=\"label label-danger\">Incorrect - Whole Format</span>";
            //return output;
        }
        return output;
    }

}

/**
 *
 * @param textNumber
 * @param observerNumberList
 * @returns {string}
 */
function observerNumberMapping(textNumber, observerNumberList) {

    let name = textNumber;
    //map text number to observer number list
    for (let i = 0; i < observerNumberList.length; i++) {
        let observerNumber = "0" + observerNumberList[i].phone_number;
        if (textNumber === observerNumber) {
            name = observerNumberList[i].first_name + " " + observerNumberList[i].last_name;

        } else {
            // console.log("" + textNumber + ": " + observerNumberList[i].phone_number);
        }
    }

    return name;
}

function displayTextBody() {
    alert("Text");
}
