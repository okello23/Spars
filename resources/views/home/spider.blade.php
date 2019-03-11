<!-- @extends('layouts.dashboard')

@section('content')
<div class="page_content">
                <div class="container-fluid">


                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">SPIDER GRAPH</h3>
                      </div>
                   </div>


                    <div class="row">
                        <div class="col-md-12">

                                    <div class="panel panel-default">

                                        <canvas id="myChart" width="400" height="400"></canvas>

                                    </div>

                        </div>
                    </div>
                </div>
</div>
@endsection


@section('page-js-script')
<script type="text/javascript">


var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

</script> -->

<!-- @stop -->

<?php
$servername = "10.200.254.66";
$username = "root";
$password = "68965";
$conn = new mysqli($servername, $username, $password);


?>
