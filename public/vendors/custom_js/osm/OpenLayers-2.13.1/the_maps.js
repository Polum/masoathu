
var map;
function init(){


    var lat            = -14.094381;
    var lon            = 34.001426;
    var zoom           = 6.5;

   
    var longitude = [33.6, 35.5166667,34.3333333];
    var latitude = [-11.9, -14.9666667, -14.3666667];
    /*for (let i = 0; i<latitude.length; i++){
    	//lat            = lat[i];
        //lon            = lon[i];
        console.log("longitude: "+longitude[i]+", latitude: "+ latitude[i]);
    	markerPositions  = new OpenLayers.LonLat(longitude[i], latitude[i]).transform( fromProjection, toProjection);
    	markers.addMarker(new OpenLayers.Marker(markerPositions));
    }


    map.setCenter(position, zoom);

*/

/*    var feature = new OpenLayers.Feature(markers, markerPositions);
    feature.closeBox = true;
    feature.popupClass = OpenLayers.Class(OpenLayers.Popup.AnchoredBubble,  new OpenLayers.Size(300, 180) );
    feature.data.popupContentHTML = 'Hello World';
    feature.data.overflow = "hidden";*/


    map = new OpenLayers.Map("map",{projection:"EPSG:3857"});

    var osm = new OpenLayers.Layer.OSM();
    var toMercator = OpenLayers.Projection.transforms['EPSG:4326']['EPSG:3857'];
    var center = toMercator({x:34.001426,y:-14.094381});
    
    /**
     * Create 5 random vector features.  Your features would typically be fetched
     * from the server. The features are given an attribute named "foo".
     * The value of this attribute is an integer that ranges from 0 to 100.
     */   
    var features = [];    
    for(var i = 0; i < longitude.length; i++) {
        features[i] = new OpenLayers.Feature.Vector(
                toMercator(new OpenLayers.Geometry.Point(
                    longitude[i],
                    latitude[i])), 
                {
                    foo : 100 * Math.random() | 0
                }, {
                    fillColor : '#008040',
                    fillOpacity : 0.8,                    
                    strokeColor : "#ee9900",
                    strokeOpacity : 1,
                    strokeWidth : 1,
                    pointRadius : 8
                });
    }
        
    // create the layer with listeners to create and destroy popups
    var vector = new OpenLayers.Layer.Vector("Points",{
        eventListeners:{
            'featureselected':function(evt){
                var feature = evt.feature;
                var popup = new OpenLayers.Popup.FramedCloud("popup",
                    OpenLayers.LonLat.fromString(feature.geometry.toShortString()),
                    null,
                    "<div style='font-size:.8em'>Feature: " + feature.id +"<br>Foo: " + feature.attributes.foo+"</div>",
                    null,
                    true
                );
                feature.popup = popup;
                map.addPopup(popup);
            },
            'featureunselected':function(evt){
                var feature = evt.feature;
                map.removePopup(feature.popup);
                feature.popup.destroy();
                feature.popup = null;
            }
        }
    });
    vector.addFeatures(features);

    // create the select feature control
    var selector = new OpenLayers.Control.SelectFeature(vector,{
        hover:false,
        click: true,
        autoActivate:true
    }); 
    
    map.addLayers([osm, vector]);
    map.addControl(selector);
    map.setCenter(new OpenLayers.LonLat(center.x,center.y), 6.5);
}
