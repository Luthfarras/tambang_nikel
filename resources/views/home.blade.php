@extends('layouts.app')
@section('title',  'Beranda')

@section('content')
<script>
    window.onload = function() {
    
    var dataPoints = [];
    
    var chart = new CanvasJS.Chart("chartku", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Riwayat Peminjaman"
        },
        axisY: {
            title: "Status",
            titleFontSize: 22,
            includeZero: true
        },
        data: [{
            type: "column",
            yValueFormatString: "#,### Terpakai",
            dataPoints: dataPoints
        }]
    });
    
    function addData(data) {
        for (var i = 0; i < data.length; i++) {
            dataPoints.push({
                x: new Date(data[i].tanggal_pakai),
                y: data[i].status
            });
        }
        chart.render();
    
    }
    
    $.getJSON("chart", addData);
    
    }
</script>    

<div id="chartku" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

@endsection
