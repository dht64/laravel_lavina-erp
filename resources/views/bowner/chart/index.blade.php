@extends('layouts.bowner')

@section('styles')
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
@endsection

@section('content')
<div class="row">
	<div class="col-md-2">
		<label for="">Select Chart Type:</label>
		<select class="form-control" onchange="setData(this.options[this.selectedIndex].value);">
			<option value="daily" selected="selected">Daily chart</option>
			<option value="monthly">Monthly chart</option>
		</select>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h1 class="text-center serial">Daily Revenue</h1>
		<div id="chartdiv" style="width:auto; height:400px; margin:10px auto;"></div>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<h1 class="text-center">Yearly Revenue (Pie chart)</h1>
		<div id="chartdiv-pie" style="width:auto; height:400px; margin:10px auto;"></div>
	</div>
</div>

@stop

@section('scripts')
<script src="//www.amcharts.com/lib/3/amcharts.js"></script>
<script src="//www.amcharts.com/lib/3/serial.js"></script>
<script src="//www.amcharts.com/lib/3/pie.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/animate/animate.min.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<script src="//www.amcharts.com/lib/3/themes/light.js"></script>
<script src="//www.amcharts.com/lib/3/plugins/dataloader/dataloader.min.js"></script>
<script>

// --- Income by All Products ---
var chartData = {!! $orderDaily !!};

/*
function getYearlyData( monthly ) {
  var yearly = [];
  for ( var i = 0; i < monthly.length; i++ ) {
    var dp = monthly[ i ],
      next = monthly[ i + 1 ];
    if ( next === undefined || dp.month.split('-')[0] != next.month.split('-')[0] )
      yearly.push( dp );
  }
  return yearly;
}
*/

/**
 * Sets proper data set
 */
function setData( type ) {
  if (type == "daily") {
  	chart.dataProvider = chartData;
  	$('h1.serial').text('Daily Revenue');
  }

  else if ( type == "monthly" ) {
    chart.dataProvider = {!! $allMonthly !!};
    chart.categoryAxis.minPeriod = "MM";
    chart.chartCursor.categoryBalloonDateFormat = "YYYY-MM";
    $('h1.serial').text('Monthly Income')
  }

  chart.validateData();
}

var chart = AmCharts.makeChart("chartdiv", {
	"type": "serial",
	"dataDateFormat": "YYYY-MM-DD",
  	"dataProvider": chartData,
  	/*
  	// For ajax function
  	"dataLoader": {
	  	"url": "data/dailyByProduct.php",
	    //"format": "json",
	    "showErrors": true,
	    "noStyles": true,
	    "async": true,
	    "load": function( options, chart ) {
        // Here the data is already loaded and set to the chart.
        // We can iterate through it and add proper graphs
        for ( var key in chart.dataProvider[0] ) {
        	if ( chart.dataProvider[0].hasOwnProperty( key ) && key != chart.categoryField ) {
        		var graph = new AmCharts.AmGraph();
        		graph.valueField = key;
        		graph.type = "column";
        		graph.fillAlphas = 0.8;
        		graph.title = key,
            	//graph.lineThickness = 2;
            	chart.addGraph(graph);
	        }
	    }
		}
	},
	*/
	"rotate": false,
	"marginTop": 10,
	"marginRight": 20,
    "marginLeft": 20,
    "marginBottom": 10,
	"categoryField": "date",
	"categoryAxis": {
		//"parseDates": true,
		"gridAlpha": 0.07,
		"axisColor": "#DADADA",
		"axisAlpha": 0.5,
		"labelRotation": 45,
		"startOnAxis": false,
		"title": "Date",
		//"inside": true,
		"gridPosition": "start",
		//"autoGridCount": true,
		//"tickLength": 0,
		/*
		"guides": [{
			"category": "2016-06-05",
			"lineColor": "#CC0000",
			"lineAlpha": 1,
			"dashLength": 2,
			"inside": true,
			"labelRotation": 90,
			"label": "holiday"
		}, {
			"category": "2016-07-05",
			"lineColor": "#CC0000",
			"lineAlpha": 1,
			"dashLength": 2,
			"inside": true,
			"labelRotation": 90,
			"label": "holiday"
		}]
		*/
	},
	"valueAxes": [{
		"stackType": "regular",
		//"stackType": "100%",
		//"axisColor": "#DADADA",
		"axisAlpha": 0.5,
		"gridAlpha": 0.07,
		//"axisAlpha": 0,
		"title": "($)",
        //"labelsEnabled": false,
        //"position": "left"
	}],
	"startDuration": 0.5,
	"graphs": [{
		"valueField": "350ml Bottle",
		"type": "column",
		"fillAlphas": 0.8,
		//"lineAlpha": 0.2,
		//"fontSize": 11,
		//"bulletSize": 14,
		//"customBullet": "https://www.amcharts.com/lib/3/images/star.png?x",
        //"customBulletField": "customBullet",
		"title": "350ml Bottle",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	},{
		"valueField": "550ml Bottle",
		"type": "column",
		"fillAlphas": 0.8,
		"title": "550ml Bottle",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	}, {
		"valueField": "20l Hod",
		"type": "column",
		"fillAlphas": 0.8,
		"title": "20l Hod",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	}, {
		"valueField": "salary",
		"type": "column",
		"newStack": true,
		"fillAlphas": 0.8,
		"title": "salary",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	}, {
		"valueField": "purchase",
		"type": "column",
		"newStack": true,
		"fillAlphas": 0.8,
		"title": "purchase",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	},{
		"valueField": "profit",
		"type": "column",
		"newStack": true,
		"fillAlphas": 0.8,
		"title": "profit",
		"balloonText": "[[title]]: $<span style='font-size:12px'><b>[[value]]</b></span>",
	}],
	"legend": {
		"position": "bottom",
		"valueText": "$[[value]]",
		"valueWidth": 150,
		"valueAlign": "left",
		"equalWidths": true,
		"periodValueText": ", total: $[[value.sum]]",
		//"autoMargins": false,
        "borderAlpha": 0.2,
        "horizontalGap": 10,
        //"markerSize": 10,
        //"useGraphSettings": true,
	},
	"chartCursor": {
		"cursorAlpha": 0,
		//"graphBulletSize": 1.5,
     	//"zoomable":false,
      	//"valueZoomable":true,
        //"valueLineEnabled":true,
        //"valueLineBalloonEnabled":true,
        //"valueLineAlpha":0.2
	},
	"chartScrollbar": {
		"color": "FFFFFF"
	},
	/*
	"valueScrollbar":{
      "offset":30
    },
    */
	"export": {
    	"enabled": false,
     }
});

//--- Yearly Income by Product (Pie) ---------------------------
var chartYearly = {!! $orderYearly !!}
var today = new Date();
var thisYear = today.getFullYear();
var currentYear = 2016;

var chart2 = AmCharts.makeChart( "chartdiv-pie", {
  "type": "pie",
  "theme": "light",
  /*
  "dataLoader": {
	"url": "parsers/dataMonthlyProduct.php",
	"complete": function(chart){
		chartData = chart.dataProvider;
		
		function getCurrentData() {		  
          var data = chartData[currentMonth];
          currentMonth++;
          if (currentMonth > 7)
            currentMonth = 6;
          return data;
        }
      
        function loop() {
          chart.allLabels[0].text = currentMonth;
          var data = getCurrentData();
          chart.animateData( data, {
          duration: 1000,
          complete: function() {
            timer = setTimeout( loop, 3000 );
          }
        } );
      }
      loop();
	  
	  // Control running button
	  $('#clock').on('click', function(){
		$but = $(this).find('.btn');
		if ($but.is('.btn-warning')){
		  $but.toggleClass('btn-warning btn-info');	
		  $but.text('start running');
		  clearTimeout(timer);
		} else {
			$but.toggleClass('btn-warning btn-info');	
		  $but.text('stop running');
			timer = setTimeout( loop, 3000 );
		}
	  });
	}
  },
  */
  "dataProvider": [],
  "valueField": "revenue",
  "titleField": "product",
  "balloonText": "[[title]]<br>$<span style='font-size:12px'><b>[[value]]</b></span>",
  "startDuration": 0,
  "innerRadius": 80,
  "pullOutRadius": 20,
  "marginTop": 30,
  "legend":{
   	"position":"right",
    "marginRight":50,
    "autoMargins":false,
    "valueText": "$[[value]]",
  },
  /*"titles": [{
    "text": "Monthly Income by Product"
  }],*/
  "allLabels": [{
    "y": "54%",
    "align": "center",
    "size": 25,
    "bold": true,
    "text": "2016",
    "color": "#555"
  }, {
    "y": "49%",
    "align": "center",
    "size": 15,
    "text": "Year",
    "color": "#555"
  }],
  "listeners": [ {
    "event": "init",
    "method": function( e ) {
      var chart2 = e.chart;
      function getCurrentData() {
        var data = chartYearly[currentYear];
        currentYear++;
        if (currentYear > thisYear)
          currentYear = 2016;
        return data;
      }

      function loop() {
        chart2.allLabels[0].text = currentYear;
        var data = getCurrentData();
        chart2.animateData( data, {
          duration: 1000,
          complete: function() {
            setTimeout( loop, 3000 );
          }
        } );
      } // /loop()

      loop();
      
    } // /"method"
  } ], // /"listeners"
   "export": {
     "enabled": false,
  }
}); 

</script>
@stop