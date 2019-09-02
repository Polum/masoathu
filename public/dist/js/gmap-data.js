/*Gmap Init*/
$(function () {
	"use strict";
	
	/* Map initialization js*/
	if( $('#map_canvas').length > 0 ){	
		var settings = {
			zoom: 7,
			center: new google.maps.LatLng(-13.76667,35.01679),
			mapTypeControl: false,
			scrollwheel: false,
			draggable: true,
			panControl:false,
			scaleControl: false,
			zoomControl: true,
			streetViewControl:false,
			navigationControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
		    styles: [ { "elementType": "geometry", "stylers": [ { "color": "#ebe3cd" } ] }, { "elementType": "labels.text.fill", "stylers": [ { "color": "#523735" } ] }, { "elementType": "labels.text.stroke", "stylers": [ { "color": "#f5f1e6" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#c9b2a6" } ] }, { "featureType": "administrative.land_parcel", "elementType": "geometry.stroke", "stylers": [ { "color": "#dcd2be" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [ { "color": "#ae9e90" } ] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "poi", "elementType": "labels.text", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [ { "color": "#93817c" } ] }, { "featureType": "poi.business", "stylers": [ { "visibility": "off" } ] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#a5b076" } ] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "color": "#447530" } ] }, { "featureType": "road", "elementType": "geometry", "stylers": [ { "color": "#f5f1e6" } ] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#fdfcf8" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#f8c967" } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#e9bc62" } ] }, { "featureType": "road.highway", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [ { "color": "#e98d58" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry.stroke", "stylers": [ { "color": "#db8555" } ] }, { "featureType": "road.local", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#806b63" } ] }, { "featureType": "transit", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "transit.line", "elementType": "labels.text.fill", "stylers": [ { "color": "#8f7d77" } ] }, { "featureType": "transit.line", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ebe3cd" } ] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#b9d3c2" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#92998d" } ] } ]
		};	

			

			var map = new google.maps.Map(document.getElementById("map_canvas"), settings);	
			google.maps.event.addDomListener(window, "resize", function() {
				var center = map.getCenter();
				google.maps.event.trigger(map, "resize");
				map.setCenter(center);
			});	

			var mIcon = {
			    path: google.maps.SymbolPath.CIRCLE,
			    fillOpacity: 1,
			    fillColor: '#ee9446',
			    strokeOpacity: 1,
			    strokeWeight: 3,
			    strokeColor: '#efb960',
			    scale: 17
			  };

	
			var markers = [
				    {
				        "title": 'Mzimba',
				        "lat": '-11.9',
				        "lng": '33.6',
				        "description": '104'
				    },
				    {
				        "title": 'Machinga',
				        "lat": '-14.9666667',
				        "lng": '35.5166667',
				        "description": '90'
				    },
				    {
				        "title": 'Dedza',
				        "lat": '-14.3666667',
				        "lng": '34.3333333',
				        "description": '34'
				    },
				    {
				        "title": 'Mchinji',
				        "lat": '-13.8',
				        "lng": '32.9',
				        "description": '10'
				    },
				     {
				        "title": 'Ntcheu',
				        "lat": '-14.8166667',
				        "lng": '34.6333333',
				        "description": '19'
				    },
				    {
				        "title": 'Chiradzulu',
				        "lat": '-15.7',
				        "lng": '35.1833333',
				        "description": '136'
				    },
				    {
				        "title": 'Nsanje',
				        "lat": '-16.9166667',
				        "lng": '35.2666667',
				        "description": '7'
				    },
				    {
				        "title": 'Mwanza',
				        "lat": '-15.6166667',
				        "lng": '34.5166667',
				        "description": '11'
				    },

				    {
				        "title": 'Mulanje',
				        "lat": '-16.0333333',
				        "lng": '35.5',
				        "description": '208'
				    },
				    {
				        "title": 'Karonga',
				        "lat": '-9.932896302',
				        "lng": '33.93331864',
				        "description": '27'
				    },
				    {
				        "title": 'Chitipa',
				        "lat": '-9.716217022',
				        "lng": '33.26664099',
				        "description": '58'
				    },
				    {
				        "title": 'Nkhata Bay',
				        "lat": '-11.59961627',
				        "lng": '34.30001461',
				        "description": '34'
				    },
				     {
				        "title": 'Nkhotakota',
				        "lat": '-12.91628009',
				        "lng": '34.30001461',
				        "description": '3'
				    },
				    {
				        "title": 'Mangochi',
				        "lat": '-14.45959674',
				        "lng": '35.26998124',
				        "description": '76'
				    },
				    {
				        "title": 'Salima',
				        "lat": '-13.78294554',
				        "lng": '34.43328813',
				        "description": '10'
				    },
				    {
				        "title": 'Chiromo',
				        "lat": '-16.55001178',
				        "lng": '35.1332454',
				        "description": '8'
				    },


				    {
				        "title": 'Zomba',
				        "lat": '-15.39003091',
				        "lng": '35.31003048',
				        "description": '109'
				    },
				    {
				        "title": 'Mzuzu',
				        "lat": '-11.45998655',
				        "lng": '34.01998002',
				        "description": '195'
				    },

				    {
				        "title": 'Blantyre',
				        "lat": '-15.79000649',
				        "lng": '34.98994665',
				        "description": '356'
				    },
				    {
				        "title": 'Lilongwe',
				        "lat": '-13.98329507',
				        "lng": '33.78330196',
				        "description": '150'
				    },

			];



			var infowindow = new google.maps.InfoWindow();

    		var marker, i;

			for (var i = 1; i <= markers.length; i++) {
				
				    var data = markers[i-1];
				    var myLatlng = new google.maps.LatLng(data.lat, data.lng);

				    marker = new  google.maps.Marker({
				    	map: map,
				        position: myLatlng,
				        title: ""+markers[i-1].title,
					    icon: mIcon,
					    label: {color: '#000', fontSize: '12px', fontWeight: '600',
					    text: ""+markers[i-1].description}
				     });


			        google.maps.event.addListener(marker, 'click', (function(marker, i) {
				        return function() {

					        
					        // infowindow.setContent(markers[i-1].title);
					        // infowindow.open(map, marker);
					        //  alert(marker.title);			
					        map.setZoom(10);
				           	map.setCenter(marker.getPosition());
				        }
				    })(marker, i));

			}

			// Sets the map on all markers in the array.
		    function setMapOnAll(markers) {
		        
		        
		    }

		    // Removes the markers from the map, but keeps them in the array.
		    function clearMarkers() {
		        setMapOnAll(null);
		    }

		      // Shows any markers currently in the array.
		    function showMarkers() {
		        setMapOnAll(map);
		    }

		      // Deletes all markers in the array by removing references to them.
		    function deleteMarkers() {
		        clearMarkers();
		        markers = [];
		    }



			

	}
	if( $('#map_canvas_1').length > 0 ){	
	var settings = {
		zoom: 16,
		center: new google.maps.LatLng(43.270441,6.640888),
		mapTypeControl: false,
		scrollwheel: false,
		draggable: true,
		panControl:false,
		scaleControl: false,
		zoomControl: false,
		streetViewControl:false,
		navigationControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [
		{
			"featureType": "water",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#e9e9e9"
				},
				{
					"lightness": 17
				}
			]
		},
		{
			"featureType": "landscape",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#f5f5f5"
				},
				{
					"lightness": 20
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "geometry.fill",
			"stylers": [
				{
					"color": "#ffffff"
				},
				{
					"lightness": 17
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "geometry.stroke",
			"stylers": [
				{
					"color": "#ffffff"
				},
				{
					"lightness": 29
				},
				{
					"weight": 0.2
				}
			]
		},
		{
			"featureType": "road.arterial",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#ffffff"
				},
				{
					"lightness": 18
				}
			]
		},
		{
			"featureType": "road.local",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#ffffff"
				},
				{
					"lightness": 16
				}
			]
		},
		{
			"featureType": "poi",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#f5f5f5"
				},
				{
					"lightness": 21
				}
			]
		},
		{
			"featureType": "poi.park",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#dedede"
				},
				{
					"lightness": 21
				}
			]
		},
		{
			"elementType": "labels.text.stroke",
			"stylers": [
				{
					"visibility": "on"
				},
				{
					"color": "#ffffff"
				},
				{
					"lightness": 16
				}
			]
		},
		{
			"elementType": "labels.text.fill",
			"stylers": [
				{
					"saturation": 36
				},
				{
					"color": "#333333"
				},
				{
					"lightness": 40
				}
			]
		},
		{
			"elementType": "labels.icon",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "transit",
			"elementType": "geometry",
			"stylers": [
				{
					"color": "#f2f2f2"
				},
				{
					"lightness": 19
				}
			]
		},
		{
			"featureType": "administrative",
			"elementType": "geometry.fill",
			"stylers": [
				{
					"color": "#fefefe"
				},
				{
					"lightness": 20
				}
			]
		},
		{
			"featureType": "administrative",
			"elementType": "geometry.stroke",
			"stylers": [
				{
					"color": "#fefefe"
				},
				{
					"lightness": 17
				},
				{
					"weight": 1.2
				}
			]
		}
	]};		
	var map = new google.maps.Map(document.getElementById("map_canvas_1"), settings);	
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	});	
	
	var infowindow = new google.maps.InfoWindow();	
	var companyImage = new google.maps.MarkerImage('dist/img/pin-dark.png',
		new google.maps.Size(58,63),
		new google.maps.Point(0,0),
		new google.maps.Point(35,20)
	);
	var companyPos = new google.maps.LatLng(43.270441,6.640888);	
	var companyMarker = new google.maps.Marker({
		position: companyPos,
		map: map,
		icon: companyImage,               
		title:"Our Office",
		zIndex: 3});	
	google.maps.event.addListener(companyMarker, 'click', function() {
		infowindow.open(map,companyMarker);
	});
}
	if( $('#map_canvas_2').length > 0 ){	
	var settings = {
		zoom: 16,
		center: new google.maps.LatLng(43.270441,6.640888),
		mapTypeControl: false,
		scrollwheel: false,
		draggable: true,
		panControl:false,
		scaleControl: false,
		zoomControl: false,
		streetViewControl:false,
		navigationControl: false,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		 styles: [
		{
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [
				{
					"color": "#444444"
				}
			]
		},
		{
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [
				{
					"color": "#f2f2f2"
				},
				{
					"visibility": "on"
				}
			]
		},
		{
			"featureType": "landscape.natural",
			"elementType": "all",
			"stylers": [
				{
					"visibility": "on"
				}
			]
		},
		{
			"featureType": "poi",
			"elementType": "all",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "road",
			"elementType": "all",
			"stylers": [
				{
					"saturation": -100
				},
				{
					"lightness": 45
				}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [
				{
					"visibility": "simplified"
				}
			]
		},
		{
			"featureType": "road.arterial",
			"elementType": "labels.icon",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "transit",
			"elementType": "all",
			"stylers": [
				{
					"visibility": "off"
				}
			]
		},
		{
			"featureType": "water",
			"elementType": "all",
			"stylers": [
				{
					"color": "#68ebb5"
				},
				{
					"visibility": "on"
				}
			]
		}
	]};		
	var map = new google.maps.Map(document.getElementById("map_canvas_2"), settings);	
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center);
	});	
	var contentString = '<div id="content-map-marker" style="text-align:left; padding-top:10px; padding-left:10px">'+
		'<div id="siteNotice">'+
		'</div>'+
		'<h6 id="firstHeading" class="firstHeading" style=" margin-bottom:0px;"><strong>Hello Friend!</strong></h4>'+
		'<div id="bodyContent">'+
		'<p style="font-family: Varela Round; color:#adadad; font-size:13px; margin-bottom:10px">Here we are. Come to drink a coffee!</p>'+
		'</div>'+
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});	
	var companyImage = new google.maps.MarkerImage('dist/img/pin-dark.png',
		new google.maps.Size(58,63),
		new google.maps.Point(0,0),
		new google.maps.Point(35,20)
	);
	var companyPos = new google.maps.LatLng(43.270441,6.640888);	
	var companyMarker = new google.maps.Marker({
		position: companyPos,
		map: map,
		icon: companyImage,               
		title:"Our Office",
		zIndex: 3});	
	google.maps.event.addListener(companyMarker, 'click', function() {
		infowindow.open(map,companyMarker);
	});
}
});