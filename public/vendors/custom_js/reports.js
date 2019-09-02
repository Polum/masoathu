$(function(){
    $(".loader-overlay").height($(".loader-overlay-parent").height());
    $(".loader-overlay").width($(".loader-overlay-parent").width());
    $(".loader-overlay").hide();
    var allData = [];
    var questions = [];
    var reported_incidents = [];
    var resolving_reports = [];
    var resolved = [];
    var centres = [];

    $.get(observer_responses, function(data){
        allData = data;
        reported_incidents = getIncidents(allData);

        if(page == 'clerk'){
            $.each(reported_incidents, function(index, value){
                let incidentIndex = allData.findIndex(x => x.id == value.id);
                allData.splice(incidentIndex, 1);
            });
        }

        $(".sms-text-list").html(listResponses(allData)).hide().fadeIn("slow");
        $(".incidentsList").html(listResponses(reported_incidents)).hide().fadeIn("slow");

        $.getScript(fancyDropDownScript, function () {});
        $.getScript(dtscript1, function () {});
        $.getScript(dtscript2, function () {});
        $.getScript(dtscript3, function () {});
        $.getScript(dtscript4, function () {});
        $.getScript(dtscript5, function () {});
        $.getScript(dtscript6, function () {});
        $.getScript(dtscript7, function () {});
        $.getScript(dtscript8, function () {});
    })
    .done(function(data){
        let responses = data;
        $.get(questionSetUrl, function(data){
            questions = data.data;
            $(".flagged").html(flagged(getIncidents(responses), questions)).hide().fadeIn("slow");
        });
        $.get('resolving', function(data){
            resolving_reports = data;
            $(".resolving").html(flagged(resolving_reports, questions, 'resolved')).hide().fadeIn("slow");
        });
        $.get('completed', function(data){
            resolved = data;
            $(".completed").html(flagged(resolved, questions, 'completed')).hide().fadeIn("slow");
        });
        $.get('centres-all', function(data){
            centres = data;
        });

    })
    .fail((err)=>{
        console.log(err);
    });

    setInterval(function(){ 
        loadData();
    }, 60000);

    $(".incidentsList, .sms-text-list").on("click", "button.flag-message", function(){
        let index;
        let spliceData = '';
        let flagged;
        let allDataIndex = allData.findIndex(x => x.id == $(this).attr("id"));
        let incidentIndex = reported_incidents.findIndex(x => x.id == $(this).attr("id"));
        if(allDataIndex > -1){
            index = allDataIndex;
            spliceData = 'allData';
            flagged = allData[index];
        }
        if(incidentIndex > -1){
            index = incidentIndex
            spliceData = 'reported_incidents';
            flagged = reported_incidents[index];
        }

        if(flagged.isEmptyObject){}
        else{
            $.post(flag_message, {flagged: flagged, "_token": token}, function(data){
                switch (spliceData) {
                    case 'allData':
                        allData.splice(index, 1);
                        break;
                    case 'reported_incidents':
                        reported_incidents.splice(index, 1);
                        break;
                }

                $(".sms-text-list").html(listResponses(allData)).hide().fadeIn("slow");
                $(".incidentsList").html(listResponses(reported_incidents)).hide().fadeIn("slow");

            }).fail((err)=>{
                console.log(err);
            });
        }
    });

    $(".incidentsList, .sms-text-list").on("click", "button.seen-message", function(){
        let index = allData.findIndex(x => x.id == $(this).attr("id"));
        let seen = allData[index];

        $.post(baseUrl+'/api/seen-message', {seen: seen, "_token": token}, function(data){
            allData.splice(index, 1);

            $(".sms-text-list").html(listResponses(allData)).hide().fadeIn("slow");

        }).fail((err)=>{
            console.log(err);
        });
    });
    
    // Clerk response info
    $(".sms-text-list").on("click", "button.info-message", function(){
        let index = allData.findIndex(x => x.id == $(this).attr("id"));
        let message = allData[index];
        $.get(baseUrl+"/centre/"+message.centre_id, function(data){
            let centre = data;
            messageInfo(centre, message, questions);
            console.log(centre);
        }).fail((err)=>{console.log(err);});
    });
    // Clerk incident response info
    $(".incidentsList").on("click", "button.info-message", function(){
        let index = reported_incidents.findIndex(x => x.id == $(this).attr("id"));
        let message = reported_incidents[index];
        $.get(baseUrl+"/centre/"+message.centre_id, function(data){
            let centre = data;
            messageInfo(centre, message, questions);
            console.log(centre);
        }).fail((err)=>{console.log(err);});
    });

    $(".incidentsList, .sms-text-list").on("click", "button.edit-message", function(){
        let index = allData.findIndex(x => x.id == $(this).attr("id"));
        let message = allData[index];

        for(l=0; l<questions.length; l++){
            if(questions[l].id === message.question_id){
                q = questions[l].body;
                questionNo = questions[l].question_no;
                break;
            }else{q="Question undefined";}
        }

        $('.clerk-modal').html(
            "<form action=\""+ udate_message+"\" method=\"post\">"+
                "<div class=\"modal-header\">"+
                    "<p>question : "+questionNo+" "+q+"</p>"+
                    "<p>Answer format : "+questionNo+"1 = Yes "+questionNo+"2 = No "+questionNo+"1;some explanation = With explanation</p>"+
                "</div>"+
                "<div class=\"form-group\">"+
                    "<label for=\"message-text\" class=\"control-label mb-10\">Message:</label>"+
                    "<textarea class=\"form-control\" id=\"text\" name=\"text\">"+message.text+"</textarea>"+
                "</div>"+
            "</form>"+
            "<div class=\"modal-footer\">"+
                "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>"+
                "<button type=\"submit\" data-dismiss=\"modal\" class=\"btn btn-primary model-submit\" id=\""+message.id+"\">Save</button>"+
            "</div>"
        );
    });

    $('.modal-dialog').on('click', 'button.model-submit', function(){
        let index = allData.findIndex(x => x.id == $(this).attr("id"));
        let message = allData[index];
        message.text = $('textarea').val();

        $.post(udate_message, {"_token":token, message:message}, function(data){
            loadData();
        }).fail((err)=>{});
    })

    $(".flagged").on("click", "button.info", function(){  
        if(!$.isEmptyObject(allData)){
            let index = allData.findIndex(x => x.id == $(this).attr("id"));
            let message = allData[index];
            let centre_index = centres.findIndex(x => x.centre_id == message.centre_id);
            let centre = centres[centre_index];
            messageInfo(centre, message, questions);
        }
    });

    $(".resolving").on("click", "button.info", function(){        
        if(!$.isEmptyObject(resolving_reports)){
            let index = resolving_reports.findIndex(x => x.id == $(this).attr("id"));
            let message = resolving_reports[index];
            let centre_index = centres.findIndex(x => x.centre_id == message.centre_id);
            let centre = centres[centre_index];
            messageInfo(centre, message, questions);
        }
    });

    $(".completed").on("click", "button.info", function(){      
        if(!$.isEmptyObject(resolved)){
            let index = resolved.findIndex(x => x.id == $(this).attr("id"));
            let message = resolved[index];
            let centre_index = centres.findIndex(x => x.centre_id == message.centre_id);
            let centre = centres[centre_index];
            messageInfo(centre, message, questions);
        }
    });

    $('.flagged').on('click', 'button.resolve', function(){
        let index = reported_incidents.findIndex(x => x.id == $(this).attr("id"));
        let resolving = reported_incidents[index];

        if(index > -1){
            $.post('resolve', {resolving: resolving, "_token": token}, function(data){
                reported_incidents.splice(index, 1);
                resolving_reports.push(resolving);
    
                $(".flagged").html(flagged(reported_incidents, questions)).hide().fadeIn("slow");
                $(".resolving").html(flagged(resolving_reports, questions, 'resolved')).hide().fadeIn("slow");
    
            }).fail((err)=>{
                console.log(err);
            });
        }
    });

    $('.resolving').on('click', 'button.resolved', function(){
        let index = resolving_reports.findIndex(x => x.id == $(this).attr("id"));
        let completed = resolving_reports[index];

        if(index > -1){
            $.post('resolved', {resolved: completed, "_token": token}, function(data){
                resolving_reports.splice(index, 1);
                resolved.push(completed);
    
                $(".resolving").html(flagged(resolving_reports, questions, 'resolved')).hide().fadeIn("slow");
                $(".completed").html(flagged(resolved, questions, 'completed')).hide().fadeIn("slow");
    
            }).fail((err)=>{
                console.log(err);
            });
        }        
    });

});

function loadData(){
    $.get(observer_responses, function(data){
        allData = data;
        reported_incidents = getIncidents(allData);

        if(page = "clerk"){
            $.each(reported_incidents, function(index, value){
                let incidentIndex = allData.findIndex(x => x.id == value.id);
                allData.splice(incidentIndex, 1);
            });
        }

        $(".sms-text-list").html(listResponses(allData)).hide().fadeIn("slow");
        $(".incidentsList").html(listResponses(getIncidents(reported_incidents))).hide().fadeIn("slow");
    })
    .done(function(data){
        let responses = data;
        $.get(questionSetUrl, function(data){
            questions = data;
            $(".flagged").html(flagged(getIncidents(responses), questions)).hide().fadeIn("slow");
        });
        $.get('resolving', function(data){
            resolving_reports = data;
            $(".resolving").html(flagged(resolving_reports, questions, 'resolved')).hide().fadeIn("slow");
        });
        $.get('completed', function(data){
            resolved = data;
            $(".completed").html(flagged(resolved, questions, 'completed')).hide().fadeIn("slow");
        });

    })
    .fail((err)=>{
        console.log(err);
    });
}

function listResponses(data){
    let output = "";
    let responses = data;
    for(i = 0; i < responses.length; i++){
        if(responses[i].text !== null){
            // output += "<tr>"+
            //             "<td>"+responses[i].text+"</td>"+
            //             "<td>"+responses[i].created_at+"</td>"+
            //             "<td>correct</td>"+
            //             "<td>"+
            //             "<button class=\"btn btn-primary btn-icon-anim btn-square edit-message\" data-toggle=\"modal\" data-target=\"#exampleModal\" id=\""+responses[i].id+"\"><i class=\"fa fa-pencil\"></i></button>" +
            //             "<button class=\"btn btn-default btn-icon-anim btn-square flag-message\" id=\""+responses[i].id+"\"><i class=\"fa fa-flag-o\"></i></button>" +
            //             "<button class=\"btn btn-warning btn-icon-anim btn-square seen-message\" id=\""+responses[i].id+"\"><i class=\"fa fa-eye\"></i></button>" +
            //             "<button class=\"btn btn-primary btn-icon-anim btn-square info-message\" data-toggle=\"modal\" data-target=\"#messageInfoModel\" id=\""+responses[i].id+"\"><i class=\"fa fa-info\"></i></button>" +
            //             "</td></tr>";
                        
        output += "<tr>"+
                    "<td>"+
                    '<div class="sl-content">'+
                        '<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 mr-5">Time: </a>'+
                        '<span class="inline-block font-12  mb-5">'+moment(responses[i].created_at).format("ddd, hA")+'</span>'+
                        '<div class="per-rating inline-block pull-right">'+
                            "<button class=\"btn btn-primary btn-icon-anim btn-square edit-message\" data-toggle=\"modal\" data-target=\"#exampleModal\" id=\""+responses[i].id+"\"><i class=\"fa fa-pencil\"></i></button>" +
                            "<button class=\"btn btn-default btn-icon-anim btn-square flag-message\" id=\""+responses[i].id+"\"><i class=\"fa fa-flag-o\"></i></button>" +
                            "<button class=\"btn btn-warning btn-icon-anim btn-square seen-message\" id=\""+responses[i].id+"\"><i class=\"fa fa-eye\"></i></button>" +
                            "<button class=\"btn btn-primary btn-icon-anim btn-square info-message\" data-toggle=\"modal\" data-target=\"#messageInfoModel\" id=\""+responses[i].id+"\"><i class=\"fa fa-info\"></i></button>" +
                        '</div>';
        output += '<div class="clearfix"></div>'+
                        '<p>'+responses[i].text+'</p>'+
                   '</div>'+
                    "</td></tr>";
        }
    }
    return output;
}

function flagged(data, questions, status = "resolve"){
    let output = "";
    let responses = data;
    let btn_type = (status === "resolved")? "btn-warning": "btn-primary";
    for(i = 0; i < responses.length; i++){
        let q = "";
        for(l=0; l<questions.length; l++){
            if(questions[l].id === responses[i].question_id){ q = questions[l].body; break;}else{q="Question undefined";}
        }
        output += "<tr>"+
                    "<td>"+
                    '<div class="sl-content">'+
                        '<a href="javascript:void(0)" class="inline-block capitalize-font  mb-5 mr-5">'+responses[i].text+'</a>'+
                        '<span class="inline-block font-12  mb-5">'+responses[i].created_at+'</span>';
        output += (status != "completed")?
                        '<div class="per-rating inline-block pull-right">'+
                            '<button class="btn btn-default btn-sm btn-icon-anim info" data-toggle=\"modal\" data-target=\"#messageInfoModel\" id='+responses[i].id+'>Info</button>'+
                            '<button class="btn '+btn_type+' btn-sm btn-icon-anim '+status+'" id='+responses[i].id+'>'+status+'</button>'+
                        '</div>':
                        '<div class="per-rating inline-block pull-right">'+
                            '<button class="btn btn-default btn-sm btn-icon-anim info" data-toggle=\"modal\" data-target=\"#messageInfoModel\" id='+responses[i].id+'>Info</button>'+
                        '</div>';
        output +=       '<div class="clearfix"></div>'+
                        '<p>'+q+'</p>'+
                   '</div>'+
                    "</td></tr>";
    }
    return output;
}

function getIncidents(data){

    let responses = data;
    let question_no = "";
    let incidentsList = ["12a", "12b", "12c", "12d", "12e", "12f", "12g", "12h", "12i", "12j", "12k", "12l", "12m", "12n", "12o", "12p", "12q", "12r", "12s", "12t", "12u", "12v", "12w", "12x", "12y", "12z"];
    let incidentsObject = [];

    for(i = 0; i < responses.length; i++){
        if(responses[i].text !== null){
            if(responses[i].text.length == 3){
                question_no = responses[i].text.substring(2, 0);
            }
            else if(responses[i].text.length >= 4){
                question_no = responses[i].text.substring(3, 0);
            }

            for(var e=0; e<incidentsList.length; e++){
                var name = incidentsList[e];
                if(name == question_no || responses[i].status === 'flagged'){
                    incidentsObject.push(responses[i]);
                    break;
                }
              }
        }
    }

    return incidentsObject;
}

function messageInfo(centre, message, questions){
    for(l=0; l<questions.length; l++){
        if(questions[l].id === message.question_id){
            q = questions[l].body;
            questionNo = questions[l].question_no;
            break;
        }else{q="Question undefined";}
    }

    $('.rco-modal').html(
        "<div class=\"modal-header\">"+
            "<p>RESPONSE INFORMATION</p>"+
        "</div>"+
        "</div class = \"row\">"+
            "<div class = \"col-sm-12\">"+
                "<p>Question : "+q+"</p>"+ 
            "</div>"+
            "<div class = \"col-sm-6\">"+
                "<p>District : "+centre.district+"</p>"+
                "<p>Constituency : "+centre.constituency+"</p>"+
                "<p>Ward : "+centre.ward+"</p>"+
                "<p>Centre : "+centre.centre_name+"</p>"+
                "<p>Phone : "+message.number+"</p>"+
            "</div>"+
            "<div class = \"col-sm-6\">"+
                "<p>Response : "+message.text+"</p>"+ 
            "</div>"+
        "<div>"+
        "<div class=\"modal-footer\">"+
            "<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Close</button>"+
        "</div>"
    );
}