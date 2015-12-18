
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart(title,tip,mesto,podaci){
        var a = [[tip, "Ukupno"]];
        for(var i=0;i<podaci.length;i++){
            a.push(podaci[i]);
        }
        
        var data = google.visualization.arrayToDataTable(a);

      var view = new google.visualization.DataView(data);
      view.setColumns([0,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       1]);

      var options = {
        title: title,
        width: '500',
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById(mesto));
      chart.draw(view, options);
    }
