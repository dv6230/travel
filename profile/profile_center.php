<?php
if (!isset($_SESSION['user_id'])) header('Location: http://' . $_SERVER['SERVER_NAME']  . '/travel/login_page.php');
$user_id = $_SESSION['user_id'];
?>
<!-- Card -->
<h2 class='mb-3'>會員中心</h2>

<div class="card weather-card">

    <!-- Card content -->
    <div class="card-body pb-3">

    </div>

</div>
<!-- Card 
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
