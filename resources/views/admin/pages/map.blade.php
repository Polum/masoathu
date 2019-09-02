@extends('admin.app')

@section('extra_css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.3/dist/leaflet.css"
          integrity="sha512-07I2e+7D8p6he1SIM+1twR5TIrhUQn9+I6yjqD53JQjFiMf8EtC93ty0/5vJTZGF8aAocvHYNEDJajGdNx1IsQ=="
          crossorigin=""/>
    <link rel="stylesheet" href="vendors/custom_js/leaflet.markercluster/dist/MarkerCluster.css"/>
    <link rel="stylesheet" href="vendors/custom_js/leaflet.markercluster/dist/MarkerCluster.Default.css"/>
@stop

@section('content')

    <div class="row">
        <div class="col-md-8" style="padding: 0;">

            <!-- map -->
            <div id="map_canvas" style="height:850px;"></div>
            <!-- /map -->
        </div>
        <div class="col-md-4" style="padding: 0; height: 800px; overflow: scroll;">
            <div class="row" style="background-color: #fff;">
                <div class="col-md-12" style="padding:30px;">

                    <h5>Key</h5><br/>
                    @php $count = 0; @endphp
                    @foreach($incidentCategories as $incidentCateory)
                        <div class="row" style="margin-left: 20px;">
                            <div class="col-md-1"
                                 style="background-color: {!! $incidentColoursBackground[$count] !!}; height: 20px;"></div>
                            <div class="col-md-11" style="padding: 5px;">
                                {!! substr($incidentCateory->name, 0, 30) !!}
                                @php
                                    echo "...";
                                @endphp
                            </div>
                        </div>
                        @php $count++; @endphp
                    @endforeach
                </div>
            </div>
            <div id="row">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Incidents</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        {{--<div class="col-md-12">
                            Filter<br/>
                        </div>--}}

                        <div class="panel-body" style=" background-color:transparent;  ">
                            <div class="streamline review-box report-content">
                                <h3 style="text-align: center;">No Incidents Reported</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@stop

@section('scripts')

    <!-- Google Map JavaScript -->
    {{--<script src="vendors/custom_js/osm/OpenLayers-2.13.1/OpenLayers.js"></script>--}}

    <script src="https://unpkg.com/leaflet@1.0.3/dist/leaflet-src.js"
            integrity="sha512-WXoSHqw/t26DszhdMhOXOkI7qCiv5QWXhH9R7CgvgZMHz1ImlkVQ3uNsiQKu5wwbbxtPzFXd1hK4tzno2VqhpA=="
            crossorigin=""></script>


    <script src="vendors/custom_js/leaflet.markercluster/dist/leaflet.markercluster-src.js"></script>

    {{-- <script src="http://www.openlayers.org/api/OpenLayers.js"></script>--}}
    <script>
        var smsUrl = "{{ url('sms-resources') }}";
        var correctSmsUrl = "{{ url('correct-sms-resources') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var incidentUrl = "{{ url('sms-by-incident') }}";
        var regCentersData;
        var smsData = {!! json_encode($smsData->toArray(), JSON_HEX_TAG) !!};
        var incidentCategories = {!! json_encode($incidentCategories->toArray(), JSON_HEX_TAG) !!};
        var questionData = {!! json_encode($questionData->toArray(), JSON_HEX_TAG) !!};
        ;
        var incidentIconMarker = "{{ asset('dist/img/marker-icon-red.png') }}";
        var greenIcon = new L.Icon({
            iconUrl: 'https://cdn.rawgit.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });
        var redIcon = new L.Icon({
            iconUrl: incidentIconMarker,
            shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        });

        ///init the map
        var lat = -14.094381;
        var lon = 34.001426;
        var zoom = 6.5;
        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            latlng = new L.LatLng(lat, lon);

        var map = new L.Map('map_canvas', {center: latlng, zoom: zoom, layers: [tiles]});

        //get the map variables and marker points

        var markers = new L.MarkerClusterGroup();
        var markersList = [];
        var coordinates = [];
        var centerList = [];
        var questionsCollected = [];
        var quesitonResponses = [];
        var centerFound;
        var outputText = "";
        var reportsData;
        var incidentMessagesArray = [];

        function populate() {
            var incidentColoursBackground = ['#C1232B1a', '#bfc31c1a', '#27727B1a', '#60C0DD1a', '#fcb5001a', '#e800a61a', '#5d85fe1a', '#0eca211a', '#b0a3fa1a', '#F3A43B1a', '#D7504B1a', '#C6E5791a', '#F4E0011a', '#F0805A1a', '#26C0C01a'];
            for (var i = 0; i < smsData.length; i++) {
                centerFound = false;
                //console.log("value of i = "+i);
                //populate the incident list on the left
                // let theType = parseInt(smsData[i].type);
                for (let j = 0; j < centerList.length; j++) {
                    if (centerList[j] === smsData[i].center_id) {
                        centerFound = true;
                        break;
                    }
                }
                if (!centerFound) {
                    if (smsData[i].type === 2) {
                        //console.log("center_id=>"+smsData[i].center_id);
                        //console.log(smsData[i].text);
                        incidentMessagesArray.push(smsData[i].id);

                        if (smsData[i].registration_center.x_coordinate > 180 || smsData[i].registration_center.x_coordinate < -180 || smsData[i].registration_center.y_coordinate > 90 || smsData[i].registration_center.y_coordinate < -90) {

                        } else {

                            //var m = new L.Marker(new L.LatLng(Math.round(regCentersData[j].y_coordinate * 100) / 100, Math.round(regCentersData[j].x_coordinate * 100) / 100));
                            var m = new L.Marker(new L.LatLng(Math.round(smsData[i].registration_center.y_coordinate * 100) / 100, Math.round(smsData[i].registration_center.x_coordinate * 100) / 100), {icon: redIcon});
                            m.bindPopup("<div  class=\"panel-body\" ><img src=\"dist/img/loading_balls.gif\" height=\"150px\"></div>");
                            //m.bindPopup("<div  class=\"panel-body\"><p>" + type[2] + "</p></div>");
                            markersList.push(m);
                            markers.addLayer(m);
                        }

                    } else {

                        if (smsData[i].registration_center.x_coordinate > 180 || smsData[i].registration_center.x_coordinate < -180 || smsData[i].registration_center.y_coordinate > 90 || smsData[i].registration_center.y_coordinate < -90) {

                        } else {
                            //console.log(smsData[i].y_coordinate+" -- "+smsData[i].x_coordinate);
                            var m = new L.Marker(new L.LatLng(Math.round(smsData[i].registration_center.y_coordinate * 100) / 100, Math.round(smsData[i].registration_center.x_coordinate * 100) / 100));
                            //if()
                            m.bindPopup("<div id=\"" + smsData[i].center_id + "\" class=\"panel-body something-some\"><img src=\"dist/img/loading_balls.gif\" height=\"150px\"></div>");
                            //m.bindPopup("<div  class=\"panel-body\"><p>" + type[2] + "</p></div>");
                            markersList.push(m);
                            markers.addLayer(m);
                        }
                    }
                    centerList.push(smsData[i].center_id);
                }


            }
            //console.log(outputText);
            if (incidentMessagesArray.length > 0) {
                $('.report-content').html("<img src=\"dist/img/loading_balls.gif\" height=\"150px\">");
            }

            for (let i = 0; i < incidentMessagesArray.length; i++) {
                let retrievedData;
                let singleReportUrl = "{{ url('sms-with-original/') }}" +"/"+incidentMessagesArray[i];
                console.log(singleReportUrl);
                $.get(singleReportUrl, function (data) {
                    retrievedData = data;
                    console.log(data);
                }).done(function () {
                    outputText += "<div class=\"sl-item \" style=\"background-color: " + incidentColoursBackground[retrievedData.question_id - 1] + " ; padding: 16px; \">\n" +
                        "                                <div class=\"sl-content \" >\n" +
                        "                                    <a href=\"javascript:void(0)\" class=\"inline-block capitalize-font  mb-5 mr-5\">" + retrievedData.original_sms.number + "()</a>\n" +
                        "                                    <span class=\"inline-block font-12  mb-5\" style=\"color: #565656;\">" + retrievedData.original_sms.created_at + "</span>\n" +
                        "                                    <div class=\"per-rating inline-block pull-right\">\n" +
                        "                                       <span class=\"label label-danger\">Not Resolved</span> \n" +
                        "                                    </div>\n" +
                        "                                    <div class=\"clearfix\"></div>\n" +
                        "                                    <p style='color: #565656'>" + retrievedData.content + "</p><br /><span class=\"label label-primary\">"+ retrievedData.registration_center.name +"</span>\n" +
                        "                                </div>\n" +
                        "                            </div>\n" +
                        "                            <hr/>";
                    $('.report-content').html(outputText).hide().fadeIn("slow");
                }).fail(function () {
                    console.log("SingleReportUrl Failed To Load")

                });
            }
            return false;
        }


        /* markers.on('clusterclick', function (a) {
             //alert('cluster ' + a.layer.getAllChildMarkers().length);
         });*/
        markers.on('click', function (a) {
            //this.bindPopup("<div  class=\\\"panel-body\\\"><p>From: \" + smsData[i].original_sms.number + \"</p><p>Hi</p></div>");

            var loadingDialog = "";
            $("body").find(".something-some").parent().css('width', 240);


            var reportsUrl = "{{ url('sms-by-center/') }}";
            reportsUrl += "/" + $("body").find(".something-some").attr("id");
            console.log($("body").find(".something-some").attr("id"));
            console.log(reportsUrl);
            $.get(reportsUrl, function (data) {
                reportsData = data;
                console.log(reportsData);
            }).done(function () {
                for (let k = 0; k < reportsData.length; k++) {
                    //TODO loop through the results in the data variable and map them to the questionData variable
                    //This means you should also loop through the questionsData and find the related question to the response from the data variable
                    for (let l = 0; l < questionData.length; l++) {
                        if (questionData[l].id === reportsData[k].question_id) {
                            questionsCollected.push(questionData[l].body);

                            var splitResponse = reportsData[k].content.split(" ");
                            //console.log("Question Type=>"+questionData);
                            switch (questionData[l].type_id) {
                                case 1:

                                    console.log(splitResponse);

                                    if (parseInt(splitResponse[0]) === 1) {
                                        quesitonResponses.push("Yes");
                                    } else if (parseInt(splitResponse[0]) === 1) {
                                        quesitonResponses.push("No");
                                    }

                                    break;
                                case 2:
                                    console.log(splitResponse);
                                    //questionResponse.push();

                                    break;
                                case 3:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 4:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 5:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 6:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 7:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 8:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 9:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                case 10:
                                    console.log(splitResponse);
                                    //questionResponse.push();
                                    break;
                                default:
                                    console.log("Default=>" + splitResponse);
                            }
                            break;
                        }
                    }
                }

                var text = "<div class=\"panel panel-default card-view\">\n" +
                    "\t\t\t\t\t\t\t\t<div class=\"panel-heading\">\n" +
                    "\t\t\t\t\t\t\t\t\t<div class=\"pull-left\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t<h6 class=\"panel-title txt-dark\">Questions Answered</h6>\n" +
                    "\t\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t\t\t\n" +
                    "\t\t\t\t\t\t\t\t\t<div class=\"clearfix\"></div>\n" +
                    "\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t\t<div class=\"panel-wrapper collapse in\">\n" +
                    "\t\t\t\t\t\t\t\t\t<table class=\"table table-hover\">\n" +
                    "\t\t\t\t\t\t\t\t\t\t<thead>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<th class=\"text-center\">#</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<th>Number</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t\t<th>Question</th>\n" +
                    "\t\t\t\t\t\t\t\t\t\t\t</tr>\n" +
                    "\t\t\t\t\t\t\t\t\t\t</thead>\n" +
                    "\t\t\t\t\t\t\t\t\t\t<tbody>\n";

                for (let l = 0; l < questionsCollected.length; l++) {
                    text += "\t\t\t\t\t\t\t\t\t\t\t<tr>\n" +
                        "\t\t\t\t\t\t\t\t\t\t\t\t<td>" + (l + 1) + "</td>\n" +
                        "\t\t\t\t\t\t\t\t\t\t\t\t<td>0884776533</td>\n" +
                        "\t\t\t\t\t\t\t\t\t\t\t\t<td>" + questionsCollected[l] + "</td>\n" +
                        "\t\t\t\t\t\t\t\t\t\t\t</tr>\n";
                }
                text += "\t\t\t\t\t\t\t\t\t\t</tbody>\n" +
                    "\t\t\t\t\t\t\t\t\t</table>\n" +
                    "\t\t\t\t\t\t\t\t</div>\n" +
                    "\t\t\t\t\t\t\t</div>";

                $("body").find(".something-some").parent().css({'width': 500, 'height': 400, 'overflow': 'scroll'});
                $("body").find(".something-some").parent().html(text);
            }).fail(function () {

            });


            this.openPopup();
        });

        populate();
        map.addLayer(markers);


        /**
         *
         * @param center_id
         * @param type
         * @return {*}
         * @constructor
         */
        function CorrectSmsReader(center_id, type) {
            /*if (center_id === undefined){
                console.log("j = ");
                return false;
            }*/
            var output;

            try {
                //check if message is correct or not correct
                /* if (smsTextSplit[0].substring(0, 3) === "ICD") {
                     output = "<span class=\"label label-success\">Correct - Incident</span>";
                     return output;
                 } else {*/

                for (let j = 0; j < regCentersData.length; j++) {
                    //let regCenterid = regCentersData[j].id;

                    //console.log(regCentersData[j].code+" -- "+regCenterCode);
                    if (center_id === regCentersData[j].id && type === 2) {
                        return output = regCentersData[j];
                        break;
                    } else {
                        output = false;
                        console.log("false -- ".center_id);
                    }
                }
                //}
            } catch (e) {
                console.log("An error=>" + e.toString() + " happened on sms: " + center_id);
                output = false;
                //return output;
            }
            return output;
        }

        function incidentCategoryMapping(type) {
            let output = "";
            for (let i = 0; i < incidentCategories.length; i++) {
                if (type === incidentCategories[i].id) {
                    output = incidentCategories[i].name;
                    console.log(incidentCategories[i].name);
                    break;
                } else {

                }
            }
            //console.log("current incident: " + output + " -- " + type);
            return output;

        }
    </script>

@stop