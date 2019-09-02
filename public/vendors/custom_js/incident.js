$(function () {

    let output = "";
    //get registration centers
    $.get(regCenterUrl, function (data) {
        regCenterData = data;
        //observerNumberList
    }).done(function () {
        //get getObservers
        $.get(observerUrl, function (data) {
            observerData = data;
            //observerNumberList
        }).done(function () {


            //get incident categories
            $.get(incidentCategoryUrl, function (data) {
                incidentData = data;
                //observerNumberList
            }).done(function () {


                //get sms reports
                $.get(flaggedIncidentsUrl, function (smsData) {
                    console.log("here" + smsData.length);
                    for (let i = 0; i < smsData.length; i++) {
                        try {
                            let smsStripped = smsData[i].report.text.split(";");
                            if (smsStripped[0].substring(0, 3) === "ICD") {
                                //convert date
                                let smsSentDate = Date.createFromMysql(smsData[i].report.created_at);
                                let smsHours = ("0" + (smsSentDate.getHours() + 2)).slice(-2);
                                let smsMinutes = ("0" + smsSentDate.getMinutes()).slice(-2);

                                //get incident count
                                getIncidentPerDayCount(smsData[i].report.text, smsSentDate.getDate()+" "+months[smsSentDate.getMonth()]);

                                output += "<tr style='background-color:"+ incidentColoursBackground[incidentCategoryMapping(smsData[i].report.text)] +"; color: #868686;'>\n" +
                                    "                                                        <td>Mobile - App</td>\n" +
                                    "                                                        <td>" + observerNumberMapping(smsData[i].report.number, observerData) + "</td>\n" +
                                    "                                                        <td>" + incidentMapping(smsData[i].report.text, incidentData) + "</td>\n" +
                                    "                                                        <td>" + smsHours + ":" + smsMinutes + " on " + months[smsSentDate.getMonth()] + " " + smsSentDate.getDate() + "</td>\n";
                                output += "<td><span class=\"label label-danger\">Unresolved</span></td>";
                                output += "<td>" + regCenterMapping(smsStripped[1], regCenterData) +
                                    "</td>" + "<td> " +
                                    "<button class=\"btn btn-danger btn-icon-anim btn-square delete-incident\"><i class=\"fa fa-trash-o\"></i></button>" +
                                    "<button class=\"btn btn-warning btn-icon-anim btn-square flag-incident\"><i class=\"fa fa-flag\"></i></button>" +
                                    +"</td>" +
                                    "</tr>";


                            }
                        } catch (e) {
                            console.log("Error" + e);
                        }
                    }
                }).done(function () {
                    //get the incident per day chat to show
                    getIndicentPerDayChart();

                    $(".incidents-list").html(output);


                    $(".incidents-list").on("click", "button.delete-incident", function () {
                        alert("Are you sure you want to delete this incident?");
                    });
                    $(".incidents-list").on("click", "button.flag-incident", function () {
                        alert("Are you sure you want to flag this incident?");
                    });
                }).fail(function () {
                    console.log("Failed to load sms url");
                });
            }).fail(function () {
                console.log("Failed to load incident data")
            });
        }).fail(function () {
            console.log("Failed to load observer data")
        });

    }).fail(function () {
        console.log("Failed to load registration center data")
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


    $(".districts-incident").html('<form><div class="form-group"><select class="form-control select2"><option>Select</option><optgroup label="Southern"><option value="SR"><option>North</option>\n' +
        '                                                    <option>Central</option>\n' +
        '                                                    <option>South</option></optgroup></select>/div></form>');

    $(".constituency-incident").html('<form><div class="form-group"><select class="form-control select2"><option>Select</option><optgroup label="Southern"><option value="SR"><option>Blantyre</option>\n' +
        '                                                        <option>Chikwawa</option>\n' +
        '                                                        <option>Mulanje</option>\n' +
        '                                                        <option>Machinga</option></optgroup></select></div></form>');

    $(".ward-incident").html('<form><div class="form-group mb-0"><select class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose" id="sam-try"><optgroup label="Southern"><option>Blantyre North West</option>\n' +
        '                                                    <option>Blantyre South West</option>\n' +
        '                                                    <option>Blantyre North East</option>\n' +
        '                                                    <option>Blantyre South East</option></optgroup></select></div></form>');

    /* Select2 Init*/
    $(".select2").select2();

    /* Bootstrap Select Init*/
    $('.selectpicker').selectpicker();

    /* Multiselect Init*/
    $('#pre-selected-options').multiSelect();

    $('#optgroup').multiSelect({
        selectableOptgroup: true
    });
    $('#public-methods').multiSelect();

    $('#select-all').click(function () {
        $('#public-methods').multiSelect('select_all');
        return false;
    });

    $('#deselect-all').click(function () {

        $('#public-methods').multiSelect('deselect_all');
        return false;
    });

    $('#refresh').on('click', function () {

        $('#public-methods').multiSelect('refresh');
        return false;
    });

    $('#add-option').on('click', function () {
        $('#public-methods').multiSelect('addOption', {value: 42, text: 'test 42', index: 0});
        return false;
    });

    //incident filter
    $(".incident-filter").on("change", function () {
        if ($(this).val() == 1) {
            //console.log("Value>>" + $(this).val());
            getMorrisOffline();
        } else {
            //console.log("Value>>" + $(this).val());
            generalIncidentMorris();
        }
    })


    //$('#sam-try').select2();
});
jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}

function initMorris() {
    morrisLine = Morris.Line({
        element: 'incident_line_chart',
        // The name of the data record attribute that contains x-incidentss.
        xkey: 'd',

        // Disables line smoothing
        pointSize: 3,
        pointStrokeColors: ['#fcb03b'],
        behaveLikeLine: true,
        gridLineColor: '#eee',
        gridTextColor: '#2f2c2c',
        lineWidth: 2,
        smooth: true,
        hideHover: 'auto',
        lineColors: ['#fcb03b'],
        resize: true,
        axes: true,
        grid: true,
        gridTextFamily: "Varela Round"
    });
}

function setMorris(data) {
    morrisLine.setData(data);
}

function getMorris() {
    $.get('@Url.Action("GetData")', function (result) {
        setMorris(result);
    });
}

function getMorrisOffline() {
    //set keys
    // A list of names of data record attributes that contain y-incidentss.
// Labels for the ykeys -- will be displayed when you hover over the
// chart.
    morrisLine.options.ykeys = ['violence', 'intimidation', 'threat', 'manipulation'];
    morrisLine.options.labels = ['Violence', 'Intimidation', 'Threat', 'Manipulation'];
    morrisLine.options.lineColors = ['#fcb03b', '#ea65a2', '#566FC9', '#3cb878'];
    morrisLine.options.pointStrokeColors = ['#fcb03b', '#ea65a2', '#566FC9', '#3cb878'];
    //set the categorised data to the morris chart
    var lineData = [{
        d: '2018-01-01 08:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 09:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 10:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 11:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 12:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 13:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 14:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 15:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 16:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    }, {
        d: '2018-01-01 17:00',
        violence: Math.floor((Math.random() * 40) + 1),
        intimidation: Math.floor((Math.random() * 40) + 1),
        threat: Math.floor((Math.random() * 40) + 1),
        manipulation: Math.floor((Math.random() * 40) + 1)
    },];

    setMorris(lineData);
}

function generalIncidentMorris() {
    let tempString = "[{\n" +
        "        \"d\": \"2018-10-01\",\n" +
        "        \"incidents\": 802\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-02\",\n" +
        "        \"incidents\": 783\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-03\",\n" +
        "        \"incidents\": 820\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-04\",\n" +
        "        \"incidents\": 839\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-05\",\n" +
        "        \"incidents\": 792\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-06\",\n" +
        "        \"incidents\": 859\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-07\",\n" +
        "        \"incidents\": 790\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-08\",\n" +
        "        \"incidents\": 1680\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-09\",\n" +
        "        \"incidents\": 1592\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-10\",\n" +
        "        \"incidents\": 1420\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-11\",\n" +
        "        \"incidents\": 882\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-12\",\n" +
        "        \"incidents\": 889\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-13\",\n" +
        "        \"incidents\": 819\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-14\",\n" +
        "        \"incidents\": 849\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-15\",\n" +
        "        \"incidents\": 870\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-16\",\n" +
        "        \"incidents\": 1063\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-17\",\n" +
        "        \"incidents\": 1192\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-18\",\n" +
        "        \"incidents\": 1224\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-19\",\n" +
        "        \"incidents\": 1329\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-20\",\n" +
        "        \"incidents\": 1329\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-21\",\n" +
        "        \"incidents\": 1239\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-22\",\n" +
        "        \"incidents\": 1190\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-23\",\n" +
        "        \"incidents\": 1312\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-24\",\n" +
        "        \"incidents\": 1293\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-25\",\n" +
        "        \"incidents\": 1283\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-26\",\n" +
        "        \"incidents\": 1248\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-27\",\n" +
        "        \"incidents\": 1323\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-28\",\n" +
        "        \"incidents\": 1390\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-29\",\n" +
        "        \"incidents\": 1420\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-30\",\n" +
        "        \"incidents\": 1529\n" +
        "    }, {\n" +
        "        \"d\": \"2018-10-31\",\n" +
        "        \"incidents\": 1892\n" +
        "    }, ]";
    // A list of names of data record attributes that contain y-incidentss.
    morrisLine.options.ykeys = ['incidents'];
    // Labels for the ykeys -- will be displayed when you hover over the
    // chart.
    morrisLine.options.labels = ['Incidents'];
    morrisLine.options.lineColors = ['#fc2218'];
    morrisLine.options.pointStrokeColors = ['#fc2218'];
    var lineData = parseMorrisJsonData();


    setMorris(lineData);

}

function incidentMapping(text, incidentData) {
    let smsTextSplit = text.split(";");
    let output = "";
    for (let i = 0; i < incidentData.length; i++) {
        if (smsTextSplit[0].substring(3, 4) === incidentData[i].id.toString()) {
            output = incidentData[i].name + ".<br /><br />Explanation: " + smsTextSplit[2];
            console.log(incidentData[i].name);
            break;
        } else {

        }
    }
    /*switch (smsTextSplit[0].substring(3, 4)) {
        case 1:
            output = "";
            break;
        case 2:
            break;
        case 3:
            break;
        case 4:
            break;
        case 5:
            break;
        case 6:
            break;
        case 7:
            break;
        case 8:
            break;
        case 9:
            break;
        default:
            break;
    }*/

    return output;
}

function getIncidentPerDayCount(incidentText, day) {
    let incidentFound = false;
    let smsTextSplit = incidentText.split(";");
    //check if message is an incident or not
    if (smsTextSplit[0].substring(0, 3) === "ICD") {
        //a multi dimension array to keep count of the number occurrence
        for (let i = 0; i < observerIncidentCount.length; i++) {
            let tempDay = observerIncidentCount[i][0];
            let tempType = observerIncidentCount[i][1];
            if (tempDay.toString() === day.toString()) {
                if (tempType.toString() === smsTextSplit[0].substring(0, 4).toString()) {
                    incidentFound = true;
                    observerIncidentCount[i][2] += 1;
                    break;
                }
                //console.log("Found");
            }
            //console.log("Number :"+number+", Array:"+tempNum);
        }


        //add number if it hasn't been found
        if (!incidentFound) {
            var newNumber = [
                day, smsTextSplit[0].substring(0, 4), 1, smsTextSplit[0]
            ];
            observerIncidentCount.push(newNumber);
        }
       /* //sort the array
        observerIncidentCount = observerIncidentCount.sort(function (a, b) {
            return b[0] - a[0];
        });*/
    }

}

function parseMorrisJsonData() {
    let revObserverIncidentCount = observerIncidentCount.sort(function (a, b) {
        return b[0] - a[0];
    });
    let jsonMorrisData = "[";
    let day = -1;
    let dayCount = 0;
    let firstEntry = true;
    for (let i = 0; i < revObserverIncidentCount.length; i++) {
        //console.log(day+"-"+revObserverIncidentCount[i][0]);
        if (day === revObserverIncidentCount[i][0] || day === -1) {
            dayCount += parseInt(revObserverIncidentCount[i][2]);

        } else {
            if (!firstEntry) {
                jsonMorrisData += ",";
            }
            jsonMorrisData += "{\"d\":\"2018-08-" + day + "\",\"incidents\": " + dayCount + "}";
            firstEntry = false;
            dayCount = 0;
            dayCount += parseInt(revObserverIncidentCount[i][2]);
        }
        day = revObserverIncidentCount[i][0];
    }
    if (firstEntry) {
        jsonMorrisData += "{\"d\":\"2018-08-" + day + "\",\"incidents\": " + dayCount + "}";
    } else {
        jsonMorrisData += ",{\"d\":\"2018-08-" + day + "\",\"incidents\": " + dayCount + "}";
    }
    jsonMorrisData += "]";
    //(jsonMorrisData);
    return JSON.parse(jsonMorrisData);
    //console.log(parsedMorr);
    /*let mstring = "[{\n" +
    "        d: '2018-01-01 08:00'," +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 09:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 10:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 11:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 12:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 13:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 14:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 15:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 16:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    }, {\n" +
    "        d: '2018-01-01 17:00',\n" +
    "        incidents: Math.floor((Math.random() * 40) + 1)\n" +
    "    },];";*/
}


function getIndicentPerDayChart(){
    var incidentPerDayChart = echarts.init(document.getElementById('incidentsPerDay'));

    var data= [];
    var labels= [];
    for(let i = 0;i<observerIncidentCount.length; i++){
        data.push(observerIncidentCount[i][2]);
        labels.push(observerIncidentCount[i][0]);
    }
    console.log(data);
    console.log(labels);
    incidentsPerDayOptions = {
        tooltip : {
            trigger: 'axis'
        },
        legend: {
            data: "Incidents"
        },
        toolbox: {
            show : true,
            feature : {
                mark : {show: true},
                dataView : {show: true, readOnly: false},
                magicType : {show: true, type: ['line', 'bar', 'stack', 'tiled']},
                restore : {show: true},
                saveAsImage : {show: true}
            }
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                boundaryGap : false,
                data : labels
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : {
            name:'Incidents',
            type:'line',
            data:data
        }
    };



    incidentPerDayChart.setOption(incidentsPerDayOptions);
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
            break;
        } else {
            // console.log("" + textNumber + ": " + observerNumberList[i].phone_number);
        }
    }

    return name;
}

function regCenterMapping(regCenterText, regCenterData) {
    let name = regCenterText;

    let incidentFound = false;

    for (let i = 0; i < regCenterData.length; i++) {
        if (regCenterText === regCenterData[i].code) {
            return regCenterData[i].name;
        }
    }
    return name;
}

function incidentCategoryMapping(text) {
    let smsTextSplit = text.split("D");
    let output = smsTextSplit[1];
    return parseInt(output);

}