$(function () {
    var regionsArray = new Array();
    var districtArray = new Array();
    var constituencyArray = new Array();
    var wardArray = new Array();
    var centerArray = new Array();
    var plotDataArray = new Array();
    let predefinedAnswerIndex = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "y", "Z"];
    var selectedregionId;
    var selectedDistrictId;
    var selectedConstituencyId;
    var selectedWardId;
    var selectedQuestionVal;
    var questionType;
    var questionResponses = "";
    


    /**
     * get the slider setup and working set the minimum with the admin divisions
     */


        // Sliders with pips
        // ------------------------------

        // Demo data for ranges
    var range_all_sliders = {
            'min': [0],
            '33%': [3],
            '66%': [6],
            'max': [9]
        };
    /*

        $("#range_6").ionRangeSlider({
            min: +moment().subtract(12, "hours").format("X"),
            max: +moment().format("X"),
            from: +moment().subtract(6, "hours").format("X"),
            grid: true,
            force_edges: true,
            prettify: function(num) {
                var m = moment(num, "X");
                return m.format("Do MMMM, HH:mm");
            }
        });
    */

    //
    // Filtered pips
    //

    // Filter pips
    function filter500(value, type) {
        return value % 10 ? 2 : 1;
    }

    // Define element
    var pips_filter = document.getElementById('noui-slider-pips-filter');
    var dminDivsRange = ['Regions', 'Districts', 'Constituencies', 'Wards', 'Registration Centers'];


    $('#noui-slider-pips-filter').slider({
        min: 0,
        max: 4,
        step: 1,
        create: function (event, ui) {
            $('#selected_admin_filter').text(dminDivsRange[0]);
        },
        slide: function (event, ui) {
            $('#selected_admin_filter').text(dminDivsRange[ui.value]);
        }
    });

    $('#noui-slider-pips-filter').slider("pips", {
        labels: dminDivsRange,
        reset: "labels"
    });
    $('#noui-slider-pips-filter').slider("float", {
        labels: dminDivsRange,
        reset: "labels"
    });
    //
    // Values mode
    //

    // Define element
    var pips_values = document.getElementById('noui-slider-pips-values');


    //populate the chart dropdownlist
    var output = "<select class=\"form-control select2 poll-category\" data-style=\"form-control\">";
    //get Registration Center Data
    $.get(adminDivisionsUrl, function (data) {
        adminDivisions = data;
    }).done(function () {
        $.get(regCenterUrl, function (data) {
            RegistrationCenterData = data;
        }).done(function () {
            $.get(questionsUrl, function (data) {
                questionData = data;

            }).done(function () {
                //get SMS Data
                $.get(smsUrl, function (data) {
                    smsData = data;
                }).done(function () {
                    $.get(questionsUrl, function (data) {
                        questionData = data;

                    }).done(function () {

                        for (let i = 0; i < questionData.length; i++) {
                            output += "<option value=\"" + questionData[i].id + "\">" + questionData[i].body + "</option>";
                        }
                        output += "</select>";
                        //console.log(output);

                        //$.loadScript(dropDownScript, function () {
                        //console.log("script dropDownScript loaded");
                        $(".poll-select").html(output);

                        //populate the dropdowns for the location
                        let dropdownRegionOptions = "<label class=\"control-label mb-10\">Region</label> <select class=\"selectpicker \" data-style=\"form-control\"><option value=\"0\">Nothing Selected</option>";
                        for (let j = 0; j < adminDivisions.length; j++) {
                            console.log(typeof adminDivisions[j].level_id);
                            if(isNaN(adminDivisions[j].level_id )){
                                console.log("not a number");
                            }else{
                                console.log("A number");
                            }
                            if (adminDivisions[j].level_id === "1") {
                                dropdownRegionOptions += "<option value='" + adminDivisions[j].id + "'> " + adminDivisions[j].name + "</option>";
                                //console.log(dropdownRegionOptions);
                            }else{
                                //console.log(adminDivisions[j].level_id);
                            }
                        }
                        dropdownRegionOptions += "</select>";
                        //console.log(adminDivisions.length);
                        $(".regions").html(dropdownRegionOptions);
                        //chart_js();
                        /* Select2 Init*/
                        $(".select2").select2();

                        /* Bootstrap Select Init*/
                        $('.selectpicker').selectpicker();

                        //});

                        /**
                         * Adding event listener for the location drop downs
                         */
                        //first we handle the region drop down listener
                        $(".regions").on("change", "select", function () {
                            districtArray = [];
                            constituencyArray = [];
                            wardArray = [];
                            //console.log($(this).val());
                            //dropdown population of the regions selected

                            let output = "<label class=\"control-label mb-10\">Districts</label>\n" +
                                "<select class=\"selectpicker\" data-style=\"form-control\"><option value=\"0\">Nothing Selected</option>\n";
                            selectedregionId = parseInt($(this).val());
                            for (let j = 0; j < adminDivisions.length; j++) {
                                if (adminDivisions[j].id === selectedregionId) {
                                    //console.log("Selected id = " + $(this).val() + " : Current Id = " + adminDivisions[j].id);
                                    for (let k = 0; k < adminDivisions[j].lower_admin.length; k++) {
                                        output += "<option value=\" " + adminDivisions[j].lower_admin[k].id + " \">" + adminDivisions[j].lower_admin[k].name + "</option>\n";
                                    }
                                }
                            }
                            //collect the district centers under the selected Region
                            for (let i = 0; i < adminDivisions.length; i++) {
                                let found = false;
                                if (adminDivisions[i].parent_id === selectedregionId) {
                                    for (let j = 0; j < districtArray.length; j++) {
                                        if (districtArray[j][0] === adminDivisions[i].id) {
                                            found = true;
                                            break;
                                        }
                                    }
                                    if (!found) {
                                        let newRegCenterRecord = [
                                            adminDivisions[i].id, adminDivisions[i].name, adminDivisions[i].code, adminDivisions[i].x_coordinate, adminDivisions[i].y_coordinate
                                        ];
                                        districtArray.push(newRegCenterRecord);
                                    }
                                }
                            }

                            console.log(districtArray);
                            output += "</select>";
                            $(".districts").html(output);
                            /* Select2 Init*/
                            $(".select2").select2();

                            /* Bootstrap Select Init*/
                            $('.selectpicker').selectpicker();
                            //console.log(output);

                            //move the slider to the district section
                            $("#noui-slider-pips-filter").slider('value', 1);
                            $('#selected_admin_filter').text(dminDivsRange[1]);
                        });

                        //first we handle the district drop down listener
                        $(".districts").on("change", "select", function () {
                            constituencyArray = [];
                            wardArray = [];
                            //console.log($(this).val());
                            //dropdown population of the regions selected

                            let output = "<label class=\"control-label mb-10\">Const...</label>\n" +
                                "<select class=\"selectpicker\" data-style=\"form-control\"><option value=\"0\">Nothing Selected</option>\n";
                            selectedDistrictId = parseInt($(this).val());
                            for (let j = 0; j < adminDivisions.length; j++) {
                                if (adminDivisions[j].id === selectedDistrictId) {
                                    //console.log("Selected id = " + $(this).val() + " : Current Id = " + adminDivisions[j].id);
                                    for (let k = 0; k < adminDivisions[j].lower_admin.length; k++) {
                                        output += "<option value=\" " + adminDivisions[j].lower_admin[k].id + " \">" + adminDivisions[j].lower_admin[k].name + "</option>\n";
                                    }
                                }
                            }
                            //collect the constituency centers under the selected District
                            for (let i = 0; i < adminDivisions.length; i++) {
                                let found = false;
                                if (adminDivisions[i].parent_id === selectedDistrictId) {
                                    for (let j = 0; j < constituencyArray.length; j++) {
                                        if (constituencyArray[j][0] === adminDivisions[i].id) {
                                            found = true;
                                            break;
                                        }
                                    }
                                    if (!found) {
                                        let newRegCenterRecord = [
                                            adminDivisions[i].id, adminDivisions[i].name, adminDivisions[i].code, adminDivisions[i].x_coordinate, adminDivisions[i].y_coordinate
                                        ];
                                        constituencyArray.push(newRegCenterRecord);
                                    }

                                }
                            }
                            console.log(constituencyArray);
                            output += "</select>";
                            $(".constituencies").html(output);
                            /* Select2 Init*/
                            $(".select2").select2();

                            /* Bootstrap Select Init*/
                            $('.selectpicker').selectpicker();
                            //console.log(output);
                            //move the slider to the district section
                            $("#noui-slider-pips-filter").slider('value', 2);
                            $('#selected_admin_filter').text(dminDivsRange[2]);
                        });

                        //then we handle the constituency drop down listener
                        $(".constituencies").on("change", "select", function () {
                            wardArray = [];
                            //console.log($(this).val());
                            //dropdown population of the regions selected

                            let output = "<label class=\"control-label mb-10\">Wards</label>\n" +
                                "<select class=\"selectpicker\" data-style=\"form-control\"><option value=\"0\">Nothing Selected</option>\n";
                            selectedConstituencyId = parseInt($(this).val());
                            for (let j = 0; j < adminDivisions.length; j++) {
                                if (adminDivisions[j].id === selectedConstituencyId) {
                                    //console.log("Selected id = " + $(this).val() + " : Current Id = " + adminDivisions[j].id);
                                    for (let k = 0; k < adminDivisions[j].lower_admin.length; k++) {
                                        output += "<option value=\" " + adminDivisions[j].lower_admin[k].id + " \">" + adminDivisions[j].lower_admin[k].name + "</option>\n";
                                    }
                                }
                            }
                            //collect the ward centers under the selected constituency
                            for (let i = 0; i < adminDivisions.length; i++) {
                                let found = false;
                                if (adminDivisions[i].parent_id === selectedConstituencyId) {
                                    for (let j = 0; j < wardArray.length; j++) {
                                        if (wardArray[j][0] === adminDivisions[i].id) {
                                            found = true;
                                            break;
                                        }
                                    }
                                    if (!found) {
                                        let newRegCenterRecord = [
                                            adminDivisions[i].id, adminDivisions[i].name, adminDivisions[i].code, adminDivisions[i].x_coordinate, adminDivisions[i].y_coordinate
                                        ];
                                        wardArray.push(newRegCenterRecord);
                                    }

                                }
                            }
                            console.log(wardArray);
                            if (plotDataArray.length > 1) {
                                getCharts(plotDataArray, selectedQuestionVal, questionType, questionResponses);
                            }
                            output += "</select>";
                            $(".wards").html(output);
                            /* Select2 Init*/
                            $(".select2").select2();

                            /* Bootstrap Select Init*/
                            $('.selectpicker').selectpicker();
                            //move the slider to the district section
                            $("#noui-slider-pips-filter").slider('value', 3);
                            $('#selected_admin_filter').text(dminDivsRange[3]);
                        });

                        //and then we handle the ward drop down listener
                        $(".wards").on("change", "select", function () {
                            //console.log($(this).val());
                            selectedWardId = parseInt($(this).val());
                            centerArray = new Array();
                            // console.log(output);
                            //collect the registration centers under the selected ward
                            for (let i = 0; i < RegistrationCenterData.length; i++) {
                                if (RegistrationCenterData[i].parent_id === selectedWardId) {
                                    var newRegCenterRecord = [
                                        RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                                    ];
                                    centerArray.push(newRegCenterRecord);
                                }
                            }
                            //move the slider to the district section
                            $("#noui-slider-pips-filter").slider('value', 4);
                            $('#selected_admin_filter').text(dminDivsRange[4]);

                            //console.log(centerArray);
                        });

                        for (let i = 0; i < RegistrationCenterData.length; i++) {
                            let regionFound = false;
                            let districtFound = false;
                            let constituencyFound = false;
                            let wardFound = false;

                            /*//get all regions
                            for (let j = 0; regionsArray.length; i++){
                                if (regionsArray[j] === RegistrationCenterData[i].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name){
                                    regionFound = true;
                                    break;
                                }
                            }

                            if(!regionFound){
                                regionFound.push(RegistrationCenterData[i].administrative_divisions.administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name);
                            }

                            //get all districts
                            for (let j = 0; districtArray.length; i++){
                                if (districtArray[j] === RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name){
                                    districtFound = true;
                                    break;
                                }
                            }

                            if(!districtFound){
                                districtFound.push(RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.administrative_divisions_parent.name);
                            }

                            //get all constituencies
                            for (let j = 0; constituencyArray.length; i++){
                                if (constituencyArray[j] === RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.name){
                                    constituencyFound = true;
                                    break;
                                }
                            }

                            if(!constituencyFound){
                                constituencyFound.push(RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.name);
                            }

                            //get all wards
                            for (let j = 0; wardArray.length; i++){
                                if (wardArray[j] === RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.name){
                                    wardFound = true;
                                    break;
                                }
                            }

                            if(!wardFound){
                                wardFound.push(RegistrationCenterData[i].administrative_divisions_parent.administrative_divisions_parent.name);
                            }*/
                        }


                        //load dropdown script

                        //addData(hBar, labels, dataset);
                        $(".poll-select").on("change", "select.poll-category", function () {
                            selectedQuestionVal = parseInt($(this).val());
                            processSelectedQuestion(selectedQuestionVal, questionType, questionResponses);
                            /* for(let i = 0; i< plotDataArray; i++){
                                 for (let k = 0; k < centerArray.length; k++) {

                                     if (arrayResponseCode === responseCenterCode) {
                                         var data=[
                                             k, smsString[2]
                                         ];
                                         plotDataArray.push(data);
                                         //console.log(smsString);
                                         //console.log(responseCenterCode + " - " + centerArray[k]);
                                     } else {
                                         // console.log(arrayResponseCode+' - '+responseCenterCode);
                                     }
                                 }
                             }*/
                            //getCharts(plotDataArray, selectedQuestionVal)
                        })
                    });
                })

            }).fail(function () {
                console.log("Fail");
            });
        }).fail(function () {
                console.log("Fail");
            });
    }).fail(function () {
                console.log("Fail");
            });

    /**
     * Method to processs the selected question, collect the center responses and plot them on a graph
     * @param selectedQuestionVal
     * @param questionType
     * @param questionResponses
     */
    function processSelectedQuestion(selectedQuestionVal, questionType, questionResponses) {
        //select the centers under the location selected from the drop down lists
        centerArray = [];
        centerArray = getSelectedRegCenters(districtArray, constituencyArray, wardArray, selectedregionId, selectedDistrictId, selectedConstituencyId, selectedWardId);
        //console.log("center Array=>"+centerArray);
        plotDataArray = [];
        for (let i = 0; i < questionData.length; i++) {
            if (selectedQuestionVal === questionData[i].id) {
                questionResponses = questionData[i].predefined_answers;
                questionType = questionData[i].type_id;
                //loop through the sms received to get the responses for the selected question
                for (let j = 0; j < smsData.length; j++) {

                    try {
                        let smsString = smsData[j].text.split(";");
                        let smsQuestionNumber = smsString[1].split("q");
                        let selectedQuestionNumber = "" + questionData[i].id;
                        if (smsQuestionNumber[1] === selectedQuestionNumber) {
                            console.log(smsQuestionNumber[1]);
                            let responseCenterCode = parseInt(smsString[0]);
                            for (let k = 0; k < centerArray.length; k++) {
                                let arrayResponseCode = parseInt(centerArray[k][1]);

                                if (arrayResponseCode === responseCenterCode) {
                                    var data = [
                                        k, smsString[2]
                                    ];
                                    plotDataArray.push(data);
                                    // console.log(smsString);
                                    // console.log(responseCenterCode + " - " + centerArray[k]);
                                } else {
                                    // console.log(arrayResponseCode+' - '+responseCenterCode);
                                }
                            }
                        }
                    } catch (e) {
                        //console.log("error=>"+smsData[j].text);
                    }
                }
                break;
            }
        }
        console.log(plotDataArray);
        getCharts(plotDataArray, selectedQuestionVal, questionType, questionResponses, wardArray);

    }

});


/**
 * Method to plot the charts after collecting the question data
 * @param plotDataArray
 * @param selectedQuestionVal
 * @param questionType
 * @param questionResponses
 */
function getCharts(plotDataArray, selectedQuestionVal, questionType, questionResponses, wardArray) {

    let male = false;
    let femaleCount = 0;
    let maleCount = 0;
    let figures = [];
    let labels = [];
    let predefinedAnswerIndex = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "y", "Z"];

    //console.log("");
    // Initialize charts
    // ------------------------------

    var chart = echarts.init(document.getElementById('chart'));

    //console.log(wardArray);
    //console.log(questionResponses);
    //console.log(questionType);
    switch (questionType) {
        case "1":
            //predefinedAnswerIndex
            if (questionResponses !== "" && questionResponses !== null) {
                let predifinedAnswersArray = questionResponses.split("*");
                let predifinedTabulation = [];
                for (let i = 0; i < plotDataArray.length; i++) {
                    let responseSet = plotDataArray[i][1].split(" ");
                    try {
                        for (let j = 0; j < responseSet.length; j++) {
                            let found = false;
                            for (let k = 0; k < predefinedAnswerIndex.length; k++) {
                                if (predefinedAnswerIndex[k] === responseSet[j]) {
                                    for (let l = 0; l < predifinedTabulation.length; l++) {
                                        console.log("predefined tabulation" + predifinedTabulation[l][0] + " -- " + predifinedAnswersArray[k]);
                                        if (predifinedTabulation[l][0] === predifinedAnswersArray[k]) {
                                            predifinedTabulation[l][1]++;
                                            found = true;
                                            break;
                                        }
                                    }

                                    if (!found) {
                                        // console.log("Responses: " + predefinedActual[l][1]);
                                        var newRecord = [
                                            predifinedAnswersArray[k], 1
                                        ];
                                        predifinedTabulation.push(newRecord);
                                        //console.log("-" + predefinedResponses50);
                                    }

                                    break;
                                }
                            }
                        }
                    } catch (e) {
                        console.log("Error=>" + e);
                    }
                }
                //labels and figures for the chart
                for (let i = 0; i < predifinedTabulation.length; i++) {
                    if (predifinedTabulation[i][0] === null) {
                        console.log(predifinedTabulation[i][0]);
                    } else {
                        labels.push(predifinedTabulation[i][0]);
                        figures.push(predifinedTabulation[i][1]);
                    }
                }

                console.log(figures + "Figures");
                console.log("predefined tabulation" + predifinedTabulation);
                console.log("predefined answer index" + predefinedAnswerIndex);
                console.log("predefined answers array" + predifinedAnswersArray);

            } else {
                //for the yes and no responses only
                let resultSet = [];
                for (let i = 0; i < plotDataArray.length; i++) {
                    let responseSet = plotDataArray[i][1].split("E");
                    for (let l = 0; l < resultSet.length; l++) {
                        var found = false;
                        console.log("resultSet" + resultSet[l][0] + " -- " + responseSet[0]);
                        if (resultSet[l][0] === responseSet[0].substring(0, 1)) {
                            resultSet[l][1]++;
                            found = true;
                            break;
                        }
                    }

                    if (!found) {
                        // console.log("Responses: " + predefinedActual[l][1]);
                        let newRecord = [
                            responseSet[0], 1
                        ];
                        resultSet.push(newRecord);
                        //console.log("-" + predefinedResponses50);
                    }
                }
                //labels and figures for the chart
                for (let i = 0; i < resultSet.length; i++) {
                    if (resultSet[i][0] === null) {
                        console.log(predifinedTabulation[i][0]);
                    } else {
                        if (resultSet[i][0] === 1) {
                            //yes
                            labels.push("Yes");
                        } else {
                            //no
                            labels.push("No");
                        }
                        figures.push(resultSet[i][1]);
                    }
                }

            }

            break;
        case "2":
            //
            break;
        case "4":
            //predefinedAnswerIndex
            if (questionResponses !== "" && questionResponses !== null) {
                let predifinedAnswersArray = questionResponses.split("*");
                let predifinedTabulation = [];
                for (let i = 0; i < plotDataArray.length; i++) {
                    let responseSet = plotDataArray[i][1].split(" ");
                    try {
                        for (let j = 0; j < responseSet.length; j++) {
                            let found = false;
                            for (let k = 0; k < predefinedAnswerIndex.length; k++) {
                                if (predefinedAnswerIndex[k] === responseSet[j]) {
                                    for (let l = 0; l < predifinedTabulation.length; l++) {
                                        console.log("predefined tabulation" + predifinedTabulation[l][0] + " -- " + predifinedAnswersArray[k]);
                                        if (predifinedTabulation[l][0] === predifinedAnswersArray[k]) {
                                            predifinedTabulation[l][1]++;
                                            found = true;
                                            break;
                                        }
                                    }

                                    if (!found) {
                                        // console.log("Responses: " + predefinedActual[l][1]);
                                        var newRecord = [
                                            predifinedAnswersArray[k], 1
                                        ];
                                        predifinedTabulation.push(newRecord);
                                        //console.log("-" + predefinedResponses50);
                                    }

                                    break;
                                }
                            }
                        }
                    } catch (e) {
                        console.log("Error=>" + e);
                    }
                }
                //labels and figures for the chart
                for (let i = 0; i < predifinedTabulation.length; i++) {
                    if (predifinedTabulation[i][0] === null) {
                        console.log(predifinedTabulation[i][0]);
                    } else {
                        labels.push(predifinedTabulation[i][0]);
                        figures.push(predifinedTabulation[i][1]);
                    }
                }

                console.log(figures + "Figures");
                console.log("predefined tabulation" + predifinedTabulation);
                console.log("predefined answer index" + predefinedAnswerIndex);
                console.log("predefined answers array" + predifinedAnswersArray);

            } else {

            }
            break;
        case "5":
            //gender
            for (let i = 0; i < plotDataArray.length; i++) {
                let male = false;
                try {
                    //console.log(plotDataArray[i][1]);
                    if (plotDataArray[i][1].substring(0, 1) === "M") {
                        let smsTextSplitGender = plotDataArray[i][1].substring(0).split(" ");
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

                            } catch (e) {
                                //console.log("Get Number Error=>" + e.toString() + "--" + text);
                            }
                        }
                    }
                } catch (e) {
                    //console.log("Error=>" + e.toString() + " -- " + i);
                }

            }

            //Add the labels for the graph
            labels.push("Male");
            labels.push("Female");
            //add the figures for the labels for the graph
            figures.push(maleCount);
            figures.push(femaleCount);
            
            console.log("figures="+ figures+" labels"+labels);

            break;
        case "6":
            //political party
            break;
        case "7":
            break;
        case "9":
            //
            break;
        case "10":
            //female count
            break;
        default:
            console.log("Default - "+questionType);
            break;
    }

    chart_options = {

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

    // Apply options
    // ------------------------------

    chart.setOption(chart_options);
}

/**
 *Metho to select the registration centers
 * @param districtArray
 * @param constituencyArray
 * @param wardArray
 * @param selectedregionId
 * @param selectedDistrictId
 * @param selectedConstituencyId
 * @param selectedWardId
 * @return Array
 */
function getSelectedRegCenters(districtArray, constituencyArray, wardArray, selectedregionId, selectedDistrictId, selectedConstituencyId, selectedWardId) {
    let centerArray = [];
    //use the slider to get registration centers.
    // If the slider value is on a selection where is drop down hasn't been selected then automatically select the nearest value wit the correct drop down data
    console.log("Slider Value: " + $("#noui-slider-pips-filter").slider("value"));
    console.log("Region Value: " + $(".regions").find("select").val());
    console.log("District Value: " + $(".districts").find("select").val());
    console.log("Consti Value: " + $(".constituencies").find("select").val());
    console.log("Ward Value: " + $(".wards").find("select").val());
    var newRegCenterRecord;
    switch ($("#noui-slider-pips-filter").slider("value")) {
        case 0:
            //collect registration centers from all regions
            for (let i = 0; i < RegistrationCenterData.length; i++) {
                newRegCenterRecord = [
                    RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                ];
                centerArray.push(newRegCenterRecord);
            }
            break;
        case 1:
            //collect registration centers from the selected region
            if ($(".regions").find("select").val() !== 0) {
                if (districtArray.length === 0 || districtArray === []) {
                    console.log("district = null");
                    for (let i = 0; i < RegistrationCenterData.length; i++) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }

                } else {
                    for (let j = 0; j < districtArray.length; j++) {
                        for (let i = 0; i < adminDivisions.length; i++) {
                            if (districtArray[j][0] === adminDivisions[i].parent_id) {
                                selectedConstituencyId = adminDivisions[i].id;
                                //ward
                                for (let k = 0; k < adminDivisions[i].lower_admin.length; k++) {
                                    for (let l = 0; l < RegistrationCenterData.length; l++) {
                                        if (RegistrationCenterData[l].parent_id === adminDivisions[i].lower_admin[k].id) {
                                            newRegCenterRecord = [
                                                RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                            ];
                                            centerArray.push(newRegCenterRecord);
                                        }
                                    }
                                }
                                break;
                            }
                        }
                    }
                }
            } else {
                newRegCenterRecord = [
                    RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                ];
                centerArray.push(newRegCenterRecord);
            }
            break;
        case 2:
            //collect registration centers from the selected district
            if ($(".regions").find("select").val() === 0 || $("select.districts").val() === 0) {
                if (districtArray.length === 0 || districtArray === []) {
                    console.log("district = null");
                    for (let i = 0; i < RegistrationCenterData.length; i++) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }

                } else {
                    if (constituencyArray.length === 0 || constituencyArray === []) {
                        //collect registration centers from the district selected
                        //console.log("constituency = null");
                        for (let j = 0; j < districtArray.length; j++) {
                            for (let i = 0; i < adminDivisions.length; i++) {
                                if (districtArray[j][0] === adminDivisions[i].parent_id) {
                                    selectedConstituencyId = adminDivisions[i].id;
                                    //ward
                                    for (let k = 0; k < adminDivisions[i].lower_admin.length; k++) {
                                        for (let l = 0; l < RegistrationCenterData.length; l++) {
                                            if (RegistrationCenterData[l].parent_id === adminDivisions[i].lower_admin[k].id) {
                                                newRegCenterRecord = [
                                                    RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                                ];
                                                centerArray.push(newRegCenterRecord);
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    } else {
                        console.log("ward = null");
                        for (let j = 0; j < constituencyArray.length; j++) {
                            for (let i = 0; i < adminDivisions.length; i++) {
                                if (constituencyArray[j][0] === adminDivisions[i].parent_id) {
                                    selectedWardId = adminDivisions[i].id;
                                    //ward
                                    for (let l = 0; l < RegistrationCenterData.length; l++) {
                                        if (RegistrationCenterData[l].parent_id === selectedWardId) {
                                            newRegCenterRecord = [
                                                RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                            ];
                                            centerArray.push(newRegCenterRecord);
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    }
                }
            } else {
                //collect registration centers from the district selected
                console.log("constituency = null");
                for (let j = 0; j < constituencyArray.length; j++) {
                    for (let i = 0; i < adminDivisions.length; i++) {
                        if (constituencyArray[j][0] === adminDivisions[i].parent_id) {
                            selectedWardId = adminDivisions[i].id;
                            //ward
                            for (let l = 0; l < RegistrationCenterData.length; l++) {
                                if (RegistrationCenterData[l].parent_id === selectedWardId) {
                                    newRegCenterRecord = [
                                        RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                    ];
                                    centerArray.push(newRegCenterRecord);
                                }
                            }
                            break;
                        }
                    }
                }
            }
            break;
        case 3:
            //collect registration centers from the constituency selected
            if ($(".regions").find("select").val() === 0 || $(".districts").find("select").val() === 0 || $(".constituencies").find("select").val() === 0) {
                if (districtArray.length === 0 || districtArray === []) {
                    console.log("district = null");
                    for (let i = 0; i < RegistrationCenterData.length; i++) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }

                } else {
                    if (constituencyArray.length === 0 || constituencyArray === []) {
                        //collect registration centers from the district selected
                        //console.log("constituency = null");
                        for (let j = 0; j < districtArray.length; j++) {
                            for (let i = 0; i < adminDivisions.length; i++) {
                                if (districtArray[j][0] === adminDivisions[i].parent_id) {
                                    selectedConstituencyId = adminDivisions[i].id;
                                    //ward
                                    for (let k = 0; k < adminDivisions[i].lower_admin.length; k++) {
                                        for (let l = 0; l < RegistrationCenterData.length; l++) {
                                            if (RegistrationCenterData[l].parent_id === adminDivisions[i].lower_admin[k].id) {
                                                newRegCenterRecord = [
                                                    RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                                ];
                                                centerArray.push(newRegCenterRecord);
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    } else {
                        if (wardArray.length === 0 || wardArray === []) {
                            console.log("ward = null");
                            for (let j = 0; j < constituencyArray.length; j++) {
                                for (let i = 0; i < adminDivisions.length; i++) {
                                    if (constituencyArray[j][0] === adminDivisions[i].parent_id) {
                                        selectedWardId = adminDivisions[i].id;
                                        //ward
                                        for (let l = 0; l < RegistrationCenterData.length; l++) {
                                            if (RegistrationCenterData[l].parent_id === selectedWardId) {
                                                newRegCenterRecord = [
                                                    RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                                ];
                                                centerArray.push(newRegCenterRecord);
                                            }
                                        }
                                        break;
                                    }
                                }

                            }
                        } else {
                            console.log("last one=>" + RegistrationCenterData.length);
                            //collect the registration centers under the selected ward
                            for (let i = 0; i < RegistrationCenterData.length; i++) {
                                console.log("c");
                                if (RegistrationCenterData[i].parent_id === selectedWardId) {
                                    newRegCenterRecord = [
                                        RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                                    ];
                                    centerArray.push(newRegCenterRecord);
                                }
                            }
                        }
                    }
                }
            } else {
                for (let i = 0; i < RegistrationCenterData.length; i++) {
                    console.log("c");
                    if (RegistrationCenterData[i].parent_id === selectedWardId) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }
                }
            }
            break;
        case 4:
            //collect registration centers from the ward selected
            if ($(".regions").find("select").val() === 0 || $(".districts").find("select").val() === 0 || $(".constituencies").find("select").val() === 0 || $(".wards").find("select").val() === 0) {
                if (districtArray.length === 0 || districtArray === []) {
                    console.log("district = null");
                    for (let i = 0; i < RegistrationCenterData.length; i++) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }

                }
                else {
                    if (constituencyArray.length === 0 || constituencyArray === []) {
                        //collect registration centers from the district selected
                        console.log("constituency = null");
                        for (let j = 0; j < districtArray.length; j++) {
                            for (let i = 0; i < adminDivisions.length; i++) {
                                if (districtArray[j][0] === adminDivisions[i].parent_id) {
                                    selectedConstituencyId = adminDivisions[i].id;
                                    //ward
                                    for (let k = 0; k < adminDivisions[i].lower_admin.length; k++) {
                                        for (let l = 0; l < RegistrationCenterData.length; l++) {
                                            if (RegistrationCenterData[l].parent_id === adminDivisions[i].lower_admin[k].id) {
                                                newRegCenterRecord = [
                                                    RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                                ];
                                                centerArray.push(newRegCenterRecord);
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    } else {
                        if (wardArray.length === 0 || wardArray === []) {
                            console.log("ward = null");
                            for (let j = 0; j < constituencyArray.length; j++) {
                                for (let i = 0; i < adminDivisions.length; i++) {
                                    if (constituencyArray[j][0] === adminDivisions[i].parent_id) {
                                        selectedWardId = adminDivisions[i].id;
                                        //ward
                                        for (let l = 0; l < RegistrationCenterData.length; l++) {
                                            if (RegistrationCenterData[l].parent_id === selectedWardId) {
                                                newRegCenterRecord = [
                                                    RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                                ];
                                                centerArray.push(newRegCenterRecord);
                                            }
                                        }
                                        break;
                                    }
                                }

                            }
                        } else {
                            console.log("last one=>" + RegistrationCenterData.length);
                            //collect the registration centers under the selected ward
                            for (let i = 0; i < RegistrationCenterData.length; i++) {
                                console.log("c");
                                if (RegistrationCenterData[i].parent_id === selectedWardId) {
                                    newRegCenterRecord = [
                                        RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                                    ];
                                    centerArray.push(newRegCenterRecord);
                                }
                            }
                        }
                    }
                }
            } else {
                //collect the registration centers under the selected ward
                for (let i = 0; i < RegistrationCenterData.length; i++) {
                    console.log("c");
                    if (RegistrationCenterData[i].parent_id === selectedWardId) {
                        newRegCenterRecord = [
                            RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                        ];
                        centerArray.push(newRegCenterRecord);
                    }
                }
            }

    }


    /* if (districtArray.length === 0 || districtArray === []) {
         console.log("district = null");
         for (let i = 0; i < RegistrationCenterData.length; i++) {
             newRegCenterRecord = [
                 RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
             ];
             centerArray.push(newRegCenterRecord);
         }

     } else {
         if (constituencyArray.length === 0 || constituencyArray === []) {
             //collect registration centers from the district selected
             console.log("constituency = null");
             for (let j = 0; j < districtArray.length; j++) {
                 for (let i = 0; i < adminDivisions.length; i++) {
                     if (districtArray[j][0] === adminDivisions[i].parent_id) {
                         selectedConstituencyId = adminDivisions[i].id;
                         //ward
                         for (let k = 0; k < adminDivisions[i].lower_admin.length; k++) {
                             for (let l = 0; l < RegistrationCenterData.length; l++) {
                                 if (RegistrationCenterData[l].parent_id === adminDivisions[i].lower_admin[k].id) {
                                     newRegCenterRecord = [
                                         RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                     ];
                                     centerArray.push(newRegCenterRecord);
                                 }
                             }
                         }
                         break;
                     }
                 }
             }
         } else {
             if (wardArray.length === 0 || wardArray === []) {
                 console.log("ward = null");
                 for (let j = 0; j < constituencyArray.length; j++) {
                     for (let i = 0; i < adminDivisions.length; i++) {
                         if (constituencyArray[j][0] === adminDivisions[i].parent_id) {
                             selectedWardId = adminDivisions[i].id;
                             //ward
                             for (let l = 0; l < RegistrationCenterData.length; l++) {
                                 if (RegistrationCenterData[l].parent_id === selectedWardId) {
                                     newRegCenterRecord = [
                                         RegistrationCenterData[l].name, RegistrationCenterData[l].code, RegistrationCenterData[l].x_coordinate, RegistrationCenterData[l].y_coordinate
                                     ];
                                     centerArray.push(newRegCenterRecord);
                                 }
                             }
                             break;
                         }
                     }

                 }
             } else {
                 console.log("last one=>" + RegistrationCenterData.length);
                 //collect the registration centers under the selected ward
                 for (let i = 0; i < RegistrationCenterData.length; i++) {
                     console.log("c");
                     if (RegistrationCenterData[i].parent_id === selectedWardId) {
                         newRegCenterRecord = [
                             RegistrationCenterData[i].name, RegistrationCenterData[i].code, RegistrationCenterData[i].x_coordinate, RegistrationCenterData[i].y_coordinate
                         ];
                         centerArray.push(newRegCenterRecord);
                     }
                 }
             }
         }
     }*/
    console.log("Costituencies-->" + constituencyArray);
    console.log("Centers-->" + centerArray);
    return centerArray;
}

/*function initMorrisBar() {
    // Morris bar chart
    morrisBar = Morris.Bar({
        element: 'poll_bar_stacked',
        xkey: 'y',
        stacked: true,
        hideHover: 'auto',
        gridLineColor: '#eee',
        resize: true,
        gridTextColor: '#2f2c2c',
        gridTextFamily: "Varela Round"
    });
}

function setMorrisBar(data) {
    morrisBar.setData(data)
}

function getMorrisBarData() {

    //set poll y value keys and labels
    morrisBar.options.ykeys = ['a', 'b', 'c'],
        morrisBar.options.labels = ['A', 'B', 'C'],
        morrisBar.options.barColors = ['#fcb03b', '#ea65a2', '#566FC9'],
        //set poll data
        barData = [{
            y: '2018',
            a: Math.floor((Math.random() * 40) + 1),
            b: Math.floor((Math.random() * 40) + 1),
            c: Math.floor((Math.random() * 40) + 1)

        }];
    //load daat to morris graph
    setMorrisBar(barData)
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
        smooth: false,
        hideHover: 'auto',
        lineColors: ['#fcb03b'],
        resize: true,
        axes: true,
        grid: true,
        gridTextFamily: "Varela Round"
    });
}

function chart_js() {
    ctx2 = document.getElementById("chart_2").getContext("2d");
    var data2 = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [{
            label: "Male",
            backgroundColor: "rgba(60,184,120,.8)",
            borderColor: "rgba(60,184,120,.8)",
            data: [randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator()]
        },
            {
                label: "Female",
                backgroundColor: "rgba(252,176,59,.8)",
                borderColor: "rgba(252,176,59,.8)",
                data: [randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator()]
            }]
    };
    var currentTitle = $(".poll-category").find(":selected").text();
    hBar = new Chart(ctx2, {
        type: "horizontalBar",
        data: data2,

        options: {
            tooltips: {
                mode: "label"
            },
            scales: {
                yAxes: [{
                    stacked: true,
                    gridLines: {
                        color: "#eee",
                    },
                    ticks: {
                        fontFamily: "Varela Round",
                        fontColor: "#2f2c2c"
                    }
                }],
                xAxes: [{
                    stacked: true,
                    gridLines: {
                        color: "#eee",
                    },
                    ticks: {
                        fontFamily: "Varela Round",
                        fontColor: "#2f2c2c"
                    }
                }],

            },
            elements: {
                point: {
                    hitRadius: 40
                }
            },
            animation: {
                duration: 3000
            },
            responsive: true,
            legend: {
                display: true,
            },
            tooltips: {
                backgroundColor: 'rgba(47,44,44,.9)',
                cornerRadius: 0,
                footerFontFamily: "'Varela Round'"
            },
            title: {
                display: true,
                text: currentTitle
            }

        }
    });
}

function addData(chart, label, data) {
    label.forEach((lab) => {
        chart.data.labels.push(lab)
    });
    //chart.data.labels.push(label);
    data.forEach((dataset) => {
        chart.data.datasets.push(dataset);
    });
    chart.options.title.text = $(".poll-category").find(":selected").text();
    chart.update();
}

function removeData(chart, labels) {
    chart.data.labels = [];
    chart.data.datasets.splice(0, 1);
    chart.data.datasets.splice(0, 1);
    chart.update();
}

//random number generator
function randomNumberGenerator() {
    var numberGenerated = Math.floor((Math.random() * 40) + 1);
    console.log("random>>" + numberGenerated)
    return numberGenerated;
}

//generate Data
function generateData() {
    var dataset = [
        {
            label: "Yes",
            backgroundColor: "rgba(60,184,120,.8)",
            borderColor: "rgba(60,184,120,.8)",
            data: [randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator()]
        },
        {
            label: "No",
            backgroundColor: "rgba(252,176,59,.8)",
            borderColor: "rgba(252,176,59,.8)",
            data: [randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator(), randomNumberGenerator()]
        }
    ];
    return dataset;
}

function getQuestionResponses(smsData, currentQuestionData) {
    console.log("code length = " + (currentQuestionData.code));
    let categoryCode;
    switch (currentQuestionData.category_id) {
        case 1:
            categoryCode = "A";
            break;
        case 2:
            categoryCode = "B";
            break;
        case 3:
            categoryCode = "C";
            break;
    }
    console.log("categoryCode" + categoryCode);
    let where = "none";
    for (let i = 0; i < smsData.length; i++) {
        let splitSms = smsData[i].text.split(";");
        let tempCode = parseInt(splitSms[1].substring(1, 2));
        let tempCode2 = parseInt(splitSms[1].substring(1, 3));
        if (currentQuestionData.code < 10) {
            if ((splitSms[1].substring(0, 1) === categoryCode)) {
                if (tempCode === currentQuestionData.code) {
                    console.log("Response: " + splitSms[1].substring(2));
                } else {
                    //console.log("Greater than 9 -- "+tempCode+"--"+currentQuestionData.code.toString());
                }
            }
        } else {
            //where="more than 9 -- "+splitSms[1].substring(1, 3)+" -- "+currentQuestionData.code;
            if ((splitSms[1].substring(0, 1) === categoryCode)) {
                if (tempCode2 === currentQuestionData.code) {
                    console.log("Response: " + splitSms[1].substring(3));
                } else {
                    console.log("more than 9 -- " + tempCode2 + "--" + currentQuestionData.code.toString());
                }
            }
        }
    }
    console.log(where);
}
*/
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

