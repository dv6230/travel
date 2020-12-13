<?php

require_once 'mydatabase.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location:login_page.php");
}

if (
    isset($_POST['username']) && isset($_POST['usercity']) && isset($_POST['useremail'])
    && isset($_POST['userbirth']) && isset($_POST['usergender']) && isset($_POST['userphone'])
) {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("");
}


?>

<h2 class='mb-3'>個人資料</h2>

<form action="profile_person.php" method="POST" class="mt-2 p-3 border rounded">
    <div class="form-group row">
        <label for="inputname" class="col-md-2 col-form-label text-set">姓名:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputname" name="username" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputaddress" class="col-md-2 col-form-label text-set">居住城市:</label>
        <div class="col-md-4">
            <select class="form-control" id="city_select" name="usercity" required>
                <option>請選擇</option>
            </select>
        </div>
    </div>
    <div class="form-group row ">
        <label for="inputemail" class="col-md-2 col-form-label text-set">電子郵件:</label>
        <div class="col-md-4">
            <input type="email" class="form-control" id="inputemail" name="useremail" required>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputbirth" class="col-md-2 col-form-label text-set">生日:</label>
        <div class="col-md-4">
            <input type="date" class="form-control" id="birth" name="birth" value="" name="userbirth">
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-md-2 col-form-label text-set">性別:</label>
        <div class="col-md-6 d-flex align-items-center">
            <div class="custom-control custom-radio custom-control-inline">
                <input required name="usergender" type="radio" id="gender-male" name="gender" class="custom-control-input" value="0">
                <label class="custom-control-label" for="gender-male">男性</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input name="usergender" type="radio" id="gender-female" name="gender" class="custom-control-input" value="1">
                <label class="custom-control-label" for="gender-female">女性</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-2 col-form-label text-set">電話:</label>
        <div class="col-md-4">
            <input type="number" class="form-control" id="inputPassword3" name="userphone" required>
        </div>
    </div>
    <div class="form-group row m-5">
        <div class="text-center w-100">
            <button type="submit" class="btn btn-primary col-md-2">儲存</button>
        </div>
    </div>
</form>

<script>
    var today = new Date().toISOString().split('T')[0];
    $('#birth').val(today);

    var city_array = ["臺北市", "基隆市", "新北市",
        "宜蘭縣", "新竹市", "新竹縣", "桃園市",
        "苗栗縣", "臺中市", "彰化縣", "南投縣",
        "嘉義市", "嘉義縣", "雲林縣", "臺南市",
        "高雄市", "屏東縣", "臺東縣", "花蓮縣"
    ];
    $(function() {
        city_array.forEach(function(value) {
            $('#city_select').append($("<option></option>").text(value));
        });
    });
</script>