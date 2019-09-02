$(function () {

    let output = "";

    //get the height of the loader-overlay-parent and set it to the loader-overlay
    $(".loader-overlay").height($(".loader-overlay-parent").height());
    $(".loader-overlay").width($(".loader-overlay-parent").width());

    //console.log($(".loader-overlay-parent").width());


    $(".progress").html("<h4>Loading Message Data</h4>").hide().fadeIn("slow");
    console.log("Incident Categories Done");
    //$.get(genderUrl, function (Data) {

    smsData = smsUrl;
    //}).done(function () {
    $(".loader-overlay").hide();
    console.log("SMS Done");

    //SmsReader(smsData.text);
    totalMessagesCount = smsData.length;

    for (let i = 0; i < smsData.length; i++) {

        getQuestionAnswer(smsData[i].content);

    }
    getGenderChart();

    $.get(questionUrl + "/47", function () {

    }).done(function (data) {
        for (let i = 0; i < data.length; i++) {
            getQuestionStatistics(data[i].content, 0, 47);
        }
        //get question 50 data
        $.get(questionUrl + "/50", function () {
        }).done(function (data) {

            for (let i = 0; i < data.length; i++) {
                getQuestionStatistics(data[i].content, 0, 50);

            }

            //get incident data
            $.get(incidentUrl, function () {
            }).done(function (data) {
                for (let i = 0; i < data.length; i++) {
                    getIncidentPerDayCount(data[i].content, data[i].question_id, data[i].center_id);
                }
                //call chart functions
                //Charts();
                getIncidentCharts();
            }).fail(function () {

            });
        }).fail(function () {
        });
    }).fail(function () {

    });


    //get Questions


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


function getIncidentPerDayCount(incident, type, centerId) {
    let incidentFound = false;

    for (let i = 0; i < observerIncidentCount.length; i++) {
        let tempType = observerIncidentCount[i][0];
        if (tempType === type) {
            incidentFound = true;
            observerIncidentCount[i][1] += 1;
            break;
        }
    }
    //add number if it hasn't been found

    if (incidentFound === false) {
        var newNumber = [
            type, 1, centerId, incident
        ];
        observerIncidentCount.push(newNumber);
    }
}


/**
 * @return {string}
 */
function SmsReader(text) {
    let smsTextSplit = text.split(";");
    let output = "<span class=\"label label-danger\">Incorrect</span>"
    try {
        //check if message is correct or not correct
        if (smsTextSplit[0].substring(0, 3) === "ICD") {
            incidentCount++;
            output = "<span class=\"label label-success\">Correct</span>";
            return output;
        } else {
            for (let j = 0; j < regCenterData.length; j++) {
                let regCenterCode = regCenterData[j].code + "";
                //console.log(regCenterData[j].code+" -- "+regCenterCode);
                if (smsTextSplit[0].substring(0) === regCenterCode) {
                    currentCenterName = regCenterData[j].name;
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
                                            correctMessaegsCount++;
                                            return "<span class=\"label label-success\">Correct</span>\n";
                                        }
                                    }
                                }
                                //return "<span class=\"label label-danger\">Incorrect</span>\n";
                                //return "<span class=\"label label-success\">Correct</span>\n";
                            } else if (smsTextSplit[1].substring(1, 2) === "2" && smsTextSplit[1].substring(0, 1) === "B") {
                                correctMessaegsCount++;
                                return "<span class=\"label label-success\">Correct</span>\n";
                            }
                        }

                    } else {
                        output = "<span class=\"label label-danger\">Incorrect</span>";
                        return output;
                    }
                    break;
                }
            }
        }
    } catch (e) {
        //console.log("An error=>" + e.toString() + " happened on sms: " + text);
        output = "<span class=\"label label-danger\">Incorrect</span>";
        return output;
    }
    return "<span class=\"label label-danger\">Incorrect</span>";

    /**
     * @return {boolean}
     */
    function CorrectSmsReader(text) {
        let smsTextSplit = text.split(";");
        let output = false;
        try {
            //check if message is correct or not correct
            if (smsTextSplit[0].substring(0, 3) === "ICD") {
                incidentCount++;
                return true;
            } else {
                for (let j = 0; j < regCenterData.length; j++) {
                    let regCenterCode = regCenterData[j].code + "";
                    //console.log(regCenterData[j].code+" -- "+regCenterCode);
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
                                                correctMessaegsCou;
                                                nt++;
                                                return true;
                                            }
                                        }
                                    }
                                    //return "<span class=\"label label-danger\">Incorrect</span>\n";
                                    //return "<span class=\"label label-success\">Correct</span>\n";
                                } else if (smsTextSplit[1].substring(1, 2) === "2" && smsTextSplit[1].substring(0, 1) === "B") {
                                    correctMessaegsCount++;
                                    return true;
                                }
                            }

                        } else {

                            return false;
                        }
                        break;
                    }
                }
            }
        } catch (e) {
            //console.log("An error=>" + e.toString() + " happened on sms: " + text);
            return false;
        }
        return false;
    }
}

function incidentMapping(type) {

    let output = "";
    for (let i = 0; i < incidentData.length; i++) {
        if (type === incidentData[i].id) {
            output = incidentData[i].name;
            console.log(incidentData[i].name);
            break;
        }
    }
    //console.log("current incident: " + output + " -- " + type);
    return output;
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


function getQuestionAnswer(text) {
    let male = false;
    try {
        if (text.substring(0, 1) === "M") {
            let smsTextSplitGender = text.substring(0).split(" ");
            for (let j = 0; j < smsTextSplitGender.length; j++) {
                var txt = smsTextSplitGender[j];
                try {
                    var numb = txt.match(/\d/g);
                    numb = numb.join("");
                    numb = parseInt(numb);
                    //console.log(numb);
                    if (male) {
                        femaleCount += numb;

                    } else {
                        maleCount += numb;
                        male = true;
                    }
                    if (numb > 1000) {
                        //console.log("Male -- " + maleCount+" -- "+text);
                    }
                    //console.log("Female" + femaleCount);
                } catch (e) {
                    //console.log("Get Number Error=>" + e.toString() + "--" + text);
                }
            }
        } else {
            console.log(text.substring(0, 1));
        }

    } catch (e) {
        console.log("Error: " + e)
    }


}

function roundUpToOne(number) {
    return number.toFixed(1);
}

function roundUpToTwo(number) {
    return number.toFixed(2);
}

function getTopNumbers(number, text) {
    let numberFound = false;

    //a multi dimension array to keep count of the number occurrence
    for (let i = 0; i < observerMessageCount.length; i++) {
        let tempNum = observerMessageCount[i][0];
        if (tempNum.toString() === number.toString()) {

            observerMessageCount[i][1] += 1;
            numberFound = true;
            //console.log("Found");
        }
        //console.log("Number :"+number+", Array:"+tempNum);
    }

    //add number if it hasn't been found
    if (!numberFound) {
        var newNumber = [
            number, 1,
        ];
        observerMessageCount.push(newNumber);
    }
    //console.log(observerMessageCount);
    //sort the array
    observerMessageCount = observerMessageCount.sort(function (a, b) {
        return b[1] - a[1];
    });

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

function getQuestionStatistics(response, sentNumber, questionNumber) {
    //console.log("Response from Server: "+response);
    //console.log("Response from Server On QuestionData: "+questionSetData);
    /*var yesResponsesq47 = 0;
    var noResponsesq47 = 0;
    var predefinedResponses47 = new Array();*/

    //let smsTextSplit = response.split(";");
    //console.log("In stat==>"+questionNumber+response);
    if (response !== undefined) {
        try {
            //questionNumber = smsTextSplit[1].split("q");

            let alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T"];
            let predefinedActual = new Array();

            //question plotting
            switch (questionNumber) {
                case 47:
                    //Mapping the predifined answers to letters so that the responses are graphed with the correct labels

                    for (let i = 0; i < questionSetData.length; i++) {
                        if (questionSetData[i].id === 47) {
                            let answerSet = questionSetData[i].predefined_answers.split("*");
                            for (let j = 0; j < answerSet.length; j++) {
                                //console.log(answerSet);
                                var newPreRecord = [
                                    alphabet[j], answerSet[j]
                                ];
                                predefinedActual.push(newPreRecord);
                            }
                            break;
                        }
                    }
                    //console.log(response);
                    if (response.substring(0, 1) === "2") {
                        noResponsesq47++;
                    } else if (response.substring(0, 1) === "1") {
                        yesResponsesq47++;
                        //predefinedResponses47
                        let responseSet = response.split(" ");

                        //index starts at 2 because 0 = the yes response an 1 = a null
                        for (let k = 2; k < responseSet.length; k++) {
                            let found = false;
                            for (let l = 0; l < predefinedActual.length; l++) {
                                if (predefinedActual[l][0] === responseSet[k]) {

                                    for (let i = 0; i < predefinedResponses47.length; i++) {

                                        if (predefinedResponses47[i][0] === predefinedActual[l][1]) {
                                            predefinedResponses47[i][1]++;
                                            found = true;
                                            break;
                                        }
                                    }

                                    if (!found) {
                                        //console.log("Responses: " + predefinedActual[l][1]);
                                        var newRecord = [
                                            predefinedActual[l][1], 1
                                        ];
                                        predefinedResponses47.push(newRecord);
                                        //console.log("-" + predefinedResponses47);
                                    }

                                    break;

                                }
                            }
                        }
                    }
                    //console.log("In Question==>" + questionNumber);
                    break;
                case 50:
                    //Mapping the predefined answers to letters so that the responses are graphed with the correct labels

                    for (let i = 0; i < questionSetData.length; i++) {
                        if (questionSetData[i].id === 50) {
                            let answerSet = questionSetData[i].predefined_answers.split("*");
                            //console.log(answerSet);
                            for (let j = 0; j < answerSet.length; j++) {
                                //console.log(answerSet);
                                var newPreRecord = [
                                    alphabet[j], answerSet[j]
                                ];
                                predefinedActual.push(newPreRecord);
                            }
                            break;
                        }
                    }
                    //console.log(response);

                    yesResponsesq47++;
                    //predefinedResponses47
                    let responseSet = response.split(" ");

                    //index starts at 2 because 0 = the yes response an 1 = a null
                    for (let k = 2; k < responseSet.length; k++) {
                        let found = false;
                        for (let l = 0; l < predefinedActual.length; l++) {
                            if (predefinedActual[l][0] === responseSet[k]) {

                                for (let i = 0; i < predefinedResponses50.length; i++) {

                                    if (predefinedResponses50[i][0] === predefinedActual[l][1]) {
                                        predefinedResponses50[i][1]++;
                                        found = true;
                                        break;
                                    }
                                }

                                if (!found) {
                                    // console.log("Responses: " + predefinedActual[l][1]);
                                    var newRecord = [
                                        predefinedActual[l][1], 1
                                    ];
                                    predefinedResponses50.push(newRecord);
                                    //console.log("-" + predefinedResponses50);
                                }

                                break;

                            }
                        }

                    }
                    // console.log("In Question==>" + questionNumber);
                    break;
                default:
                    // console.log("==>" + questionNumber);
                    break;

            }
        } catch (e) {
            //console.log("Error==>" + e);
        }
    }


//overall question plotting
    /*for (let j = 0; j < regCenterData.length; j++) {
        let regCenterFound = false;
        let wardFound = false;
        let constituencyFound = false;
        let DistrictFound = false;
        let RegionFound = false;
        let numberFound = false;

        let centerCodeFound = regCenterData[j].code + "";
        if (smsTextSplit[0] === centerCodeFound) {
            //a multi dimension array to keep count of the number occurrence for the registration centers
            for (let i = 0; i < regCenterCount.length; i++) {
                //regCenterCount[i][0];

                if (regCenterCount[i][0] === regCenterData[j].name) {
                    regCenterFound = true;
                    regCenterCount[i][1] += 1;
                    break;
                }
                //console.log("Found");

                //console.log("Number :"+number+", Array:"+tempNum);
            }

            //add number if it hasn't been found
            if (!regCenterFound) {
                try {
                    var newRegCenterRecord = [
                        regCenterData[j].name, 1
                    ];
                } catch (e) {
                    //console.log(e);

                }

                regCenterCount.push(newRegCenterRecord);
            }


            //a multi dimension array to keep count of the number occurrence for the wards
            /!*            for (let i = 0; i < wardCount.length; i++) {
                            //regCenterCount[i][0];

                            if (wardCount[i][0] === regCenterData[j].administrative_divisions.name) {
                                wardFound = true;
                                wardCount[i][1] += 1;
                                break;
                            }
                            //console.log("Found");

                            //console.log("Number :"+number+", Array:"+tempNum);
                        }

                        //add number if it hasn't been found
                        if (!wardFound) {
                            try {
                                var newWardRecord = [
                                    regCenterData[j].administrative_divisions.name, 1
                                ];
                                wardCount.push(newWardRecord);
                            } catch (e) {
                                //console.log(e);
                            }
                        }*!/


            //a multi dimension array to keep count of the number occurrence for the Constituency
            /!*            for (let i = 0; i < constituencyCount.length; i++) {
                            //regCenterCount[i][0];

                            if (constituencyCount[i][0] === regCenterData[j].administrative_divisions.administrative_divisions_parent.name) {
                                constituencyFound = true;
                                constituencyCount[i][1] += 1;
                                break;
                            }
                            //console.log("Found");

                            //console.log("Number :"+number+", Array:"+tempNum);
                        }

                        //add constituency if it hasn't been found
                        if (!constituencyFound) {
                            try {
                                var newConstituencyRecord = [
                                    regCenterData[j].administrative_divisions.administrative_divisions_parent.name, 1
                                ];
                                constituencyCount.push(newConstituencyRecord);
                            } catch (e) {
                                //console.log(e);
                            }
                        }*!/

            //a multi dimension array to keep count of the number occurrence for the district
            /!* for (let i = 0; i < districtCount.length; i++) {
                 //regCenterCount[i][0];

                 if (districtCount[i][0] === regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name) {
                     DistrictFound = true;
                     districtCount[i][1] += 1;
                     break;
                     //if (regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name === "Mzimba") {

                     //}
                 }
                 //console.log("Found");

                 //console.log("Number :"+number+", Array:"+tempNum);
             }

             //add district if it hasn't been found
             if (!DistrictFound) {
                 if (regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name === "Mzimba") {
                     console.log(regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name + " -- " + regCenterData[j].name + " -- " + regCenterData[j].code + " -- " + response);
                 }
                 try {
                     var newDistrictRecord = [
                         regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name, 1
                     ];
                     districtCount.push(newDistrictRecord);
                 } catch (e) {
                     //console.log(e)
                 }

             }*!/

            //a multi dimension array to keep count of the number occurrence for the region
            /!* for (let i = 0; i < regionCount.length; i++) {
                 //regCenterCount[i][0];

                 if (regionCount[i][0] === regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name) {
                     RegionFound = true;
                     regionCount[i][1] += 1;
                     break;
                 }
                 //console.log("Found");

                 //console.log("Number :"+number+", Array:"+tempNum);
             }

             //add region if it hasn't been found
             if (!RegionFound) {
                 try {
                     var newRegionRecord = [
                         regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name, 1
                     ];
                     regionCount.push(newRegionRecord);
                 } catch (e) {
                     //console.log(e)
                 }

             }*!/

            //count numbers per district
            /!*for (let i = 0; i < numberPerDistrictCount.length; i++) {
                if (numberPerDistrictCount[i][1] === sentNumber) {
                    numberFound = true;
                    break;
                }
            }*!/

            //add new district number combo
            /!*if (!numberFound) {
                try {
                    var newNumberRecord = [
                        regCenterData[j].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.name, sentNumber
                    ];
                    numberPerDistrictCount.push(newNumberRecord);
                    numberFound = true;
                } catch (e) {
                    //console.log(e)
                }

            }*!/
            break;

        }
        /!*if (!numberFound) {
            for (let i = 0; i < numberPerDistrictCount.length; i++) {
                if (numberPerDistrictCount[i][1] === sentNumber) {
                    numberFound = true;
                    break;
                }
            }
            if (!numberFound) {
                var newNumberRecord = [
                    "Unidentified District/Center", sentNumber
                ];
                numberPerDistrictCount.push(newNumberRecord);
            }
        }*!/


    }*/
}

function getGenderChart() {
    var male_female_chart_overall = echarts.init(document.getElementById('male_female_chart_overall'));
    var male_female_bar_chart_overall = echarts.init(document.getElementById('male_female_bar_chart_overall'));

    male_female_bar_chart_overall_option = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 25
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Percentages of Male and Female Registrants']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: ['Male', 'Female']
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: [roundUpToOne(((maleCount) / (maleCount + femaleCount)) * 100), roundUpToOne(((femaleCount) / (maleCount + femaleCount)) * 100)],
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };
    male_female_pie_options = {

        // Add title
        title: {
            text: 'Male and Female',
            x: 'center'
        },

        // Add tooltip
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Male', 'Female']
        },

        // Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        pie: 'Switch to pies',
                        funnel: 'Switch to funnel',
                    },
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            y: '20%',
                            width: '50%',
                            height: '70%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [{
            name: 'Male Female Registrants',
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: [
                {value: maleCount, name: 'Male'},
                {value: femaleCount, name: 'Female'}
            ],
            label: {
                normal: {
                    formatter: "{b}: {c}\n({d}%)"
                }
            }
        }]
    };

    male_female_chart_overall.setOption(male_female_pie_options);
    male_female_bar_chart_overall.setOption(male_female_bar_chart_overall_option);
}

function getIncidentCharts() {

    // Initialize charts
    // ------------------------------

    //var reg_center_bar_overall = echarts.init(document.getElementById('reg_center_bar_overall'));
    //var ward_bar_overall = echarts.init(document.getElementById('ward_bar_overall'));
    //var constituency_bar_overall = echarts.init(document.getElementById('constituency_bar_overall'));
    //var district_bar_overall = echarts.init(document.getElementById('district_bar_overall'));
    //var region_bar_overall = echarts.init(document.getElementById('region_bar_overall'));

    var Q47_bar_overall = echarts.init(document.getElementById('Q47_bar_overall'));
    var Q47_chart_overall = echarts.init(document.getElementById('Q47_chart_overall'));
    var Q50_bar_overall = echarts.init(document.getElementById('Q50_bar_overall'));
    var incident_bar_overall = echarts.init(document.getElementById('incident_bar_overall'));
    //var observerStats = echarts.init(document.getElementById('observerStats'));
    //var monitors_bar_chart_overall = echarts.init(document.getElementById('monitors_bar_chart_overall'));
    // Charts setup
    // ------------------------------


    //
    // Basic columns options
    //

    //Messages Per Registration Center
    let labels = new Array();
    let figures = new Array();
    let total = 0;
    for (let i = 0; i < regCenterCount.length; i++) {

        total += regCenterCount[i][1];
    }
    for (let i = 0; i < regCenterCount.length; i++) {
        if (regCenterCount[i][0] === null) {
            console.log(regCenterCount[i][0]);
        } else {
            labels.push(regCenterCount[i][0]);
            figures.push(regCenterCount[i][1]);
        }
    }

    var dataStyle = {
        normal: {
            label: {
                show: true,
                position: 'insideLeft',
                formatter: '{c}%'
            }
        }
    };

    reg_center_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'
                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 60
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value'
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //ward Option
    //Messages Per Ward
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < wardCount.length; i++) {

        total += wardCount[i][1];
    }
    for (let i = 0; i < wardCount.length; i++) {
        labels.push(wardCount[i][0]);
        figures.push(wardCount[i][1]);
    }
    ward_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'
                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 60
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value'
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //constituency Options
    //Messages Per Constituency
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < constituencyCount.length; i++) {

        total += constituencyCount[i][1];
    }
    for (let i = 0; i < constituencyCount.length; i++) {
        labels.push(constituencyCount[i][0]);
        figures.push(constituencyCount[i][1]);
    }

    constituency_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 80,
            y: 35,
            y2: 110
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart',
                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 60
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value'
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //District Options
    //Messages Per District
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < districtCount.length; i++) {

        total += districtCount[i][1];
    }
    for (let i = 0; i < districtCount.length; i++) {
        labels.push(districtCount[i][0]);
        figures.push(districtCount[i][1]);
    }
    district_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 75
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'
                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 60
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value'
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //Region Options
    //Messages Per District
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < regionCount.length; i++) {

        total += regionCount[i][1];
    }
    for (let i = 0; i < regionCount.length; i++) {
        labels.push(regionCount[i][0]);
        figures.push(regionCount[i][1]);
    }

    region_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 70
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 60
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "%"
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };
    //Incidents Options
    //Incidents
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < observerIncidentCount.length; i++) {

        total += observerIncidentCount[i][1];
    }
    for (let i = 0; i < observerIncidentCount.length; i++) {
        labels.push(incidentMapping(observerIncidentCount[i][0]));
        figures.push(observerIncidentCount[i][1]);
    }

    let allData = [];

    for(let n=0; n<figures.length; n++)
    {
        allData.push(
            {
            name: labels[n],
            type: 'bar',
            data: [figures[n]],
            itemStyle: {
                normal: {
                    barBorderColor: 'rgb(234,101,162,.8)',
                    color: function (params) {
                        return incidentColours[n]
                    },
                    label: {}
                }
            }
        })
    }

    console.log(allData);
    console.log(labels);

    //options for incidents
    incident_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 100,
            y2: 100
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ''
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                interval: 0,
                show: false,
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Number of Incidents",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: allData,
    };

    //organisations Mobilisation Strategies Options
    //Strategies
    labels = new Array();
    figures = new Array();
    total = 0;

    for (let i = 0; i < predefinedResponses50.length; i++) {

        total += predefinedResponses50[i][1];
    }
    for (let i = 0; i < predefinedResponses50.length; i++) {
        labels.push(predefinedResponses50[i][0]);
        figures.push(roundUpToOne((predefinedResponses50[i][1] / total) * 100));
    }


    Q50_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: []
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                interval: 0,
                rotate: 30
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };
    //organisations Mobilisation Strategies Options
    //Strategies
    labels = new Array();
    figures = new Array();
    total = 0;
    for (let i = 0; i < predefinedResponses47.length; i++) {

        total += predefinedResponses47[i][1];
    }
    for (let i = 0; i < predefinedResponses47.length; i++) {
        labels.push(predefinedResponses47[i][0]);
        figures.push(roundUpToOne((predefinedResponses47[i][1] / total) * 100));
    }

    Q47_bar_overall_options = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 110
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: []
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: labels,
            axisLabel: {
                rotate: 30
            }
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: figures,
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //Male Female bar Options
    //Strategies


    male_female_bar_chart_overall_option = {

        // Setup grid
        grid: {
            x: 40,
            x2: 40,
            y: 35,
            y2: 25
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis'
        },

        // Add legend
        legend: {
            data: ['Percentages of Male and Female Registrants']
        },
        // Add toolbox
        toolbox: {
            show: true,
            orient: 'horizontal',
            x: 'right',
            y: 'top',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        line: 'Switch to line chart',
                        bar: 'Switch to bar chart'

                    },
                    type: ['line', 'bar']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'category',
            data: ['Male', 'Female']
        }],

        // Vertical axis
        yAxis: [{
            type: 'value',
            name: "Percentage (%)",
            nameTextStyle:{
                align: 'right',
                padding: [0,0,0,70]
            }
        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                data: [roundUpToOne(((maleCount) / (maleCount + femaleCount)) * 100), roundUpToOne(((femaleCount) / (maleCount + femaleCount)) * 100)],
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            formatter: '{c}%',
                            textStyle: {
                                fontWeight: 500
                            }
                        }
                    }
                }
            }
        ]
    };

    //monitors per district
    //Strategies
    let districts = new Array();

    console.log("PerDistrict: " + numberPerDistrictCount);
    for (let i = 0; i < numberPerDistrictCount.length; i++) {
        let found = false;
        for (let j = 0; j < districts.length; j++) {
            if (districts[j][0] === numberPerDistrictCount[i][0]) {
                districts[j][1] += 1;
                found = true;
                console.log("District Count/number" + numberPerDistrictCount.length);
                break;
            }
        }
        if (!found) {
            var newDistrictRecord = [
                numberPerDistrictCount[i][0], 1
            ];
            districts.push(newDistrictRecord);
        }
    }

    labels = new Array();
    figures = new Array();

    for (let i = 0; i < districts.length; i++) {
        labels.push(districts[i][0]);
        figures.push(districts[i][1]);
    }
    console.log("Labels: " + labels + " -- Figures" + figures);


    /* monitors_bar_chart_overall_option = {

         // Setup grid
         grid: {
             x: 40,
             x2: 40,
             y: 35,
             y2: 90
         },

         // Add tooltip
         tooltip: {
             trigger: 'axis'
         },

         // Add legend
         legend: {
             data: labels
         },
         // Add toolbox
         toolbox: {
             show: true,
             orient: 'horizontal',
             x: 'right',
             y: 'top',
             feature: {
                 mark: {
                     show: true,
                     title: {
                         mark: 'Markline switch',
                         markUndo: 'Undo markline',
                         markClear: 'Clear markline'
                     }
                 },
                 dataView: {
                     show: true,
                     readOnly: false,
                     title: 'View data',
                     lang: ['View chart data', 'Close', 'Update']
                 },
                 magicType: {
                     show: true,
                     title: {
                         line: 'Switch to line chart',
                         bar: 'Switch to bar chart'

                     },
                     type: ['line', 'bar']
                 },
                 restore: {
                     show: true,
                     title: 'Restore'
                 },
                 saveAsImage: {
                     show: true,
                     title: 'Same as image',
                     lang: ['Save']
                 }
             }
         },

         // Enable drag recalculate
         calculable: true,

         // Horizontal axis
         xAxis: [{
             type: 'category',
             data: labels,
             axisLabel: {
                 rotate: 60
             }
         }],

         // Vertical axis
         yAxis: [{
             type: 'value'
         }],

         // Add series
         series: [
             {
                 name: 'Messages',
                 type: 'bar',
                 data: figures,
                 itemStyle: {
                     normal: {
                         barBorderColor: 'rgb(234,101,162,.8)',
                         color: 'rgb(252,176,59,.8)',
                         label: {
                             show: true,
                             textStyle: {
                                 fontWeight: 500
                             }
                         }
                     }
                 }
             }
         ]
     };*/

    //male Female pie options


    male_female_pie_options = {

        // Add title
        title: {
            text: 'Male and Female',
            x: 'center'
        },

        // Add tooltip
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Male', 'Female']
        },

        // Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        pie: 'Switch to pies',
                        funnel: 'Switch to funnel',
                    },
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            y: '20%',
                            width: '50%',
                            height: '70%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [{
            name: 'Male Female Registrants',
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: [
                {value: maleCount, name: 'Male'},
                {value: femaleCount, name: 'Female'}
            ],
            label: {
                normal: {
                    formatter: "{b}: {c}\n({d}%)"
                }
            }
        }]
    };

    //Organisation mobilisation yes no options


    organisation_mobilisation_yes_no_options = {

        // Add title
        title: {
            text: 'Yes No',
            x: 'center'
        },

        // Add tooltip
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },

        // Add legend
        legend: {
            orient: 'vertical',
            x: 'left',
            data: ['Yes', 'No']
        },

        // Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                magicType: {
                    show: true,
                    title: {
                        pie: 'Switch to pies',
                        funnel: 'Switch to funnel',
                    },
                    type: ['pie', 'funnel'],
                    option: {
                        funnel: {
                            x: '25%',
                            y: '20%',
                            width: '50%',
                            height: '70%',
                            funnelAlign: 'left',
                            max: 1548
                        }
                    }
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },

        // Enable drag recalculate
        calculable: true,

        // Add series
        series: [{
            name: 'Organisation Mobilisation',
            type: 'pie',
            radius: '70%',
            center: ['50%', '57.5%'],
            data: [
                {value: yesResponsesq47, name: 'Yes'},
                {value: noResponsesq47, name: 'No'}
            ],
            label: {
                normal: {
                    formatter: "{b}: {c}\n({d}%)"
                }
            }
        }]
    };

    figures = new Array();
    labels = new Array();
    let foundNumber = false;
    observerMessageCount = observerMessageCount.sort(function (a, b) {
        return b[1] - a[1];
    });

    /*for (let i = 0; i < observerData.length; i++) {
        let localPhoneNumber = "0" + observerData[i].phone_number;
        for (let i = 0; i < observerMessageCount.length; i++) {
            if (localPhoneNumber === observerMessageCount[i][0]) {
                foundNumber = true;
                break;
            }
        }
        if (!foundNumber) {

            figures.push(0);
            labels.push(observerData[i].first_name + observerData[i].last_name);

        }
    }

    for (let i = observerMessageCount.length - 1; i >= 0; i--) {
        figures.push(observerMessageCount[i][1]);
        labels.push(observerNumberMapping(observerMessageCount[i][0], observerData));
    }


    observerStats_options = {

        // Setup grid
        grid: {
            x: 105,
            x2: 25,
            y: 35,
            y2: 25
        },

        // Add tooltip
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },

        // Add legend
        legend: {
            data: ['Messages']
        },
// Display toolbox
        toolbox: {
            show: true,
            orient: 'vertical',
            feature: {
                mark: {
                    show: true,
                    title: {
                        mark: 'Markline switch',
                        markUndo: 'Undo markline',
                        markClear: 'Clear markline'
                    }
                },
                dataView: {
                    show: true,
                    readOnly: false,
                    title: 'View data',
                    lang: ['View chart data', 'Close', 'Update']
                },
                restore: {
                    show: true,
                    title: 'Restore'
                },
                saveAsImage: {
                    show: true,
                    title: 'Same as image',
                    lang: ['Save']
                }
            }
        },
        // Enable drag recalculate
        calculable: true,

        // Horizontal axis
        xAxis: [{
            type: 'value'
        }],

        // Vertical axis
        yAxis: [{
            type: 'category',
            data: labels,

        }],

        // Add series
        series: [
            {
                name: 'Messages',
                type: 'bar',
                stack: 'Total',
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true,
                            position: 'insideRight'
                        }
                    },
                    emphasis: {
                        barBorderColor: 'rgb(234,101,162,.8)',
                        color: 'rgb(252,176,59,.8)',
                        label: {
                            show: true
                        }
                    }
                },
                data: figures
            }
        ]
    };*/


    // Apply options
    // ------------------------------

    //reg_center_bar_overall.setOption(reg_center_bar_overall_options);
    //ward_bar_overall.setOption(ward_bar_overall_options);
    //constituency_bar_overall.setOption(constituency_bar_overall_options);
    //district_bar_overall.setOption(district_bar_overall_options);
    //region_bar_overall.setOption(region_bar_overall_options);
    Q50_bar_overall.setOption(Q50_bar_overall_options);
    Q47_chart_overall.setOption(organisation_mobilisation_yes_no_options);
    Q47_bar_overall.setOption(Q47_bar_overall_options);
    incident_bar_overall.setOption(incident_overall_options);

    //observerStats.setOption(observerStats_options);
    //monitors_bar_chart_overall.setOption(monitors_bar_chart_overall_option);

    // Resize charts
    // ------------------------------
    /*
                window.onresize = function () {
                    setTimeout(function () {
                        reg_center_bar_overall.resize();
                        ward_bar_overall.resize();
                        constituency_bar_overall.resize();
                        district_bar_overall.resize()
                        Q50_bar_overall.resize();
                        male_female_chart_overall.resize();
                        Q47_chart_overall.resize();
                        Q47_bar_overall.resize();
                        male_female_bar_chart_overall.resize();
                        monitors_bar_chart_overall.resize();
                    }, 200);
                }*/
}

