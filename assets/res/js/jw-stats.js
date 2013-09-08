/*
 Jugend wählt
 Statistiken
*/

var temp = null;
var timer;

function writeTemp(x) {
	this.temp = x;
}

function get(table, count, where1='', where2='') {
	this.temp = null;
	var url = 'http://jw.schaub.it/get.php?table='+table;

	// Count
	if (count == true) {
		url += "&action=count";
		if (where1 && where2) {
			url += '&'+where1+'='+where2;
		}

		$.get(url, function(response) {
			writeTemp(response);
			clearTimeout(this.timer);
		});

	// FetchAll
	} else {
		url += "&callback=?";
		if (where1 && where2) {
			url += '&'+where1+'='+where2;
		}
		$.getJSON(url, function(json) {
			writeTemp(json);
			clearTimeout(this.timer);
		});
	}
}

function draw_Parteien_Wahlen() {
	var self = this;

	this.data = new google.visualization.DataTable();
	get('Partei', false);


		this.timer = setTimeout(function () {

			self.data.addColumn('string', 'Partei');
			self.data.addColumn('number', 'Wahlen');

			var temp = this.temp;

			for (var i = 0; i < temp.length; i++) {
			    var object = temp[i];
			    var where1 = 'Partei_ID';
			    var where2 = object['ID'];
			    setTimeout(function() {}, 3000);
			    data.addRows([
			    	[unescape(object['Name']), 5]
			    	]);
			}

		    var options = {
		      title: '',
		      is3D: true,
		    };

		    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
		    chart.draw(data, options);

		}, 3000);
		
}