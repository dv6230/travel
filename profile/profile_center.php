<?php
if (!isset($_SESSION['user_id'])) header("Location:../login_page.php");
$user_id = $_SESSION['user_id'];
?>
<!-- Card -->
<h3 class='mb-3'>會員中心</h3>

<div class="card weather-card">

    <!-- Card content -->
    <div class="card-body pb-3">

        <!-- Title -->
        <h4 class="card-title font-weight-bold">目前森林天氣</h4>
        <!-- Text -->
        <p class="card-text" id="t-time">Mon, 12:30 PM, Mostly Sunny</p>
        <div class="d-flex justify-content-between">
            <p class="display-1 degree" id="degree"></p>

            <i class="fas fa-sun-o fa-5x pt-3 amber-text"></i>
        </div>
        <div class="d-flex justify-content-between mb-4">
            <p class="weet"><i class="fas fa-tint fa-lg text-info pr-2 weet"></i>3</p>
            <p class="wind"><i class="fas fa-leaf fa-lg grey-text pr-2 wind"></i>21</p>
        </div>
        
        <p class="t_load">行徑時間</p>
        <div class="progress md-progress">

            <div id="progress_weather" class="progress-bar black" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <ul class="list-unstyled d-flex justify-content-between font-small text-muted mb-4">
            <li class="pl-4 time_show">1:00AM</li>
            <li class="abc time_show">6:00AM</li>
            <li class="time_show">12:00AM</li>
            <li class="abc time_show">5:00PM</li>
            <li class="pr-4 time_show">11:00PM</li>
        </ul>


        <h2 id="output" class="output"></h2>

    </div>

</div>
<!-- Card -->
<script>
    var d = new Date();
    var n = (d.getHours() * 60) + (d.getMinutes());
    n = (n / (24 * 60)) * 100;
    var str_time = n.toString() + "%";
    document.getElementById("t-time").innerHTML = d.toLocaleDateString() + '  ,' + d.getHours() + ':' + d.getMinutes();
    document.getElementById("progress_weather").style.width = str_time;
    document.getElementById("degree").innerHTML = Math.floor((Math.random() * 300) + 1) / 10 + '<small> ℃</small>';
    document.querySelector(".weet").innerHTML = '<i class="fas fa-tint fa-lg text-info pr-2 weet"></i>' + Math.floor((Math.random() * 100) + 1).toString() + '% Precipitation';
    document.querySelector(".wind").innerHTML = '<i class="fas fa-leaf fa-lg grey-text pr-2 wind"></i>' + Math.floor((Math.random() * 10) + 5).toString() + 'km/h Winds';
</script>