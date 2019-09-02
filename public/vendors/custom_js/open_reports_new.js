$(function () {

    //get the observers numbers to map to the sent sms numbers
    $.get(observerUrl, function (observerData) {

        $.get(smsUrl, function (smsData) {
            console.log(smsData);
            let output = "";
            //sent the count of sent messages
            $(".mobile-app").html(smsData.length);
            for ($x = 0; $x < smsData.length; $x++) {
                //convert date
                let smsSentDate = Date.createFromMysql(smsData[$x].created_at);
                let smsHours = ("0" + (smsSentDate.getHours() + 2)).slice(-2);
                let smsMinutes = ("0" + smsSentDate.getMinutes()).slice(-2);
                output += "<tr>\n" +
                    "                                                        <td>Mobile - App</td>\n" +
                    "                                                        <td>" + observerNumberMapping(smsData[$x].number, observerData) + "</td>\n" +
                    "                                                        <td>" + smsData[$x].text.substring(0, 15) + "...</td>\n" +
                    "                                                        <td>" + smsHours + ":" + smsMinutes + " on " + months[smsSentDate.getMonth()] + " " + smsSentDate.getDay() + "</td>\n";
                output += "<td>" + SmsReader(smsData[$x].text) + " </td>";
                output += "<td>" +
                    "<button class=\"btn btn-primary btn-icon-anim btn-square\"><i class=\"fa fa-pencil\"></i></button>" +
                    "<button class=\"btn btn-danger btn-icon-anim btn-square\"><i class=\"fa fa-times\"></i></button>" +
                    "<button class=\"btn btn-warning btn-icon-anim btn-square\"><i class=\"fa fa-exclamation-triangle\"></i></button>" +
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

            $(".sms-text-list").html(output);
            console.log("Script :"+fancyDropDownScript);
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


    Date.createFromMysql = function (mysql_string) {
        var t, result = null;

        if (typeof mysql_string === 'string') {
            t = mysql_string.split(/[- :]/);

            //when t[3], t[4] and t[5] are missing they defaults to zero
            result = new Date(t[0], t[1] - 1, t[2], t[3] || 0, t[4] || 0, t[5] || 0);
        }

        return result;
    }

    var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

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
};

/**
 * @return {string}
 */
function SmsReader(text) {
    smsTextSplit = text.split(";");
    try {
        //check if message is correct or not correct
        if (smsTextSplit[0].substring(0, 3) === "ICD") {
            let output = "<span class=\"label label-success\">Correct</span>";
            return output;
        } else {
            if (smsTextSplit[1].substring(0, 1) === "A" || smsTextSplit[1].substring(0, 1) === "B" || smsTextSplit[1].substring(0, 1) === "C") {
                if (!isNaN(smsTextSplit[1].substring(1, 2))) {
                    if ((!isNaN(smsTextSplit[1].substring(2, 3))) || (smsTextSplit[1].substring(2, 3) === "E")) {
                        return "<span class=\"label label-success\">Correct</span>\n";
                    }
                }
            } else {
                let output = "<span class=\"label label-danger\">Incorrect</span>";
                return output;
            }
        }
    } catch (e) {
        console.log("An error=>" + e.toString() + " happened on sms: " + text);
        let output = "<span class=\"label label-danger\">Incorrect</span>";
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
