$(function () {
    
      /**area**/
    Morris.Area({
        element: 'area-example',
        data: [{period: '2015 Q1', iphone: 28000, ipad: null, itouch: 8900},
            {period: '2015 Q2', iphone: 8778, ipad:10000, itouch: 14000},
            {period: '2015 Q3', iphone: 10000, ipad: 7000, itouch: 6000},
            {period: '2015 Q4', iphone: 3767, ipad: 3597, itouch: 5689},
            {period: '2016 Q1', iphone: 6810, ipad: 11914, itouch: 2293},
            {period: '2016 Q2', iphone: 15670, ipad: 4293, itouch: 11881},
            {period: '2016 Q3', iphone: 14820, ipad: 13795, itouch: 11588},
            {period: '2016 Q4', iphone: 15073, ipad: 5967, itouch: 5175},
            {period: '2017 Q1', iphone: 10687, ipad: 4460, itouch: 2028},
            {period: '2017 Q2', iphone: 11500, ipad: 13000, itouch: 9000}],
        xkey: 'period',
        ykeys: ['iphone', 'ipad', 'itouch'],
        labels: ['iPhone', 'iPad', 'iPod Touch'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true,
        lineColors: ['#ddd', '#5bc0de', '#0073ff'],
        lineWidth: 2
    });  
    
    
    /***bar chart **/
    
    var barData = {
        labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "Page Visiters",
                backgroundColor: '#5bc0de',
                pointBorderColor: "#fff",
                data: [165, 159, 180, 181, 156, 155, 140]
            },
            {
                label: "New Sign Ups",
                backgroundColor: 'rgba(21,158,238,1)',
                borderColor: "rgba(21,158,238,1)",
                pointBackgroundColor: "rgba(21,158,238,1)",
                pointBorderColor: "#fff",
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    };

    var barOptions = {
        responsive: true
    };


    var ctx2 = document.getElementById("barChart").getContext("2d");
    new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
    
    /**world map**/
    

jQuery('#world-map-markers').vectorMap(
{
    map: 'world_mill_en',
    backgroundColor: '#fff',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    color: '#f4f3f0',
    regionStyle : {
        initial : {
          fill : '#ddd'
        }
      },
    markerStyle: {
      initial: {
                    r: 9,
                    'fill': '#fff',
                    'fill-opacity':1,
                    'stroke': '#000',
                    'stroke-width' : 5,
                    'stroke-opacity': 0.4
                }
                },
    enableZoom: true,
    hoverColor: '#c9dfaf',
    markers : [{
        latLng : [21.00, 78.00],
        name : 'Marker title'
      
      }],
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
    onRegionClick: function(element, code, region)
    {
        var message = 'You clicked "'
            + region
            + '" which has the code: '
            + code.toUpperCase();

        alert(message);
    }
});

/**toastr**/
 toastr.info("Please Renew your web hosting", "Welcome Adam!", {
            positionClass: "toast-top-right"
        });
});

/**data table**/
$(document).ready(function() {
    var table = $('#data-table').DataTable( {
        responsive: true
    } );
 
    new $.fn.dataTable.FixedHeader( table );
});