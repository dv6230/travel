<?php

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location:login_page.php");
}
include 'mydatabase.php';
$name ='';
$address = '';
$email = '';
$gender = '';
$phone = '';
$birthday = '';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $conn->prepare("SELECT * FROM user_detail WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($stmt as $value) {
        $name = $value['name'];
        $address = $value['address'];
        $email = $value['email'];
        $gender = $value['gender'];
        $phone = $value['phone'];
        $birthday = $value['birthday'];
    }
}


?>

<h2 class='mb-3'>個人資料</h2>

<form action="update_user_data.php" method="POST" class="mt-2 p-3 border rounded">
    <div class="form-group row">
        <label for="inputname" class="col-md-2 col-form-label text-set">姓名:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputname" name="username" value="<?php echo $name ?>" required>
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
            <input type="email" class="form-control" id="inputemail" name="useremail" required value="<?php echo $email ?>">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputbirth" class="col-md-2 col-form-label text-set">生日:</label>
        <div class="col-md-4">
            <input type="date" class="form-control" id="birth" value="" name="userbirth" value="<?php echo $birthday ?>">
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-md-2 col-form-label text-set">性別:</label>
        <div class="col-md-6 d-flex align-items-center">
            <div class="custom-control custom-radio custom-control-inline">
                <input required name="usergender" type="radio" id="gender-male" name="usergender" class="custom-control-input" <?php if($gender == 1) echo 'checked';  ?> value="1">
                <label class="custom-control-label" for="gender-male">男性</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input name="usergender" type="radio" id="gender-female" name="usergender" class="custom-control-input" <?php if($gender == 0) echo 'checked';  ?> value="0">
                <label class="custom-control-label" for="gender-female">女性</label>
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label for="inputPassword3" class="col-2 col-form-label text-set">電話:</label>
        <div class="col-md-4">
            <input type="number" class="form-control" id="inputPassword3" name="userphone" required value="<?php echo $phone ?>">
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

    var city_array = ["","臺北市", "基隆市", "新北市",
        "宜蘭縣", "新竹市", "新竹縣", "桃園市",
        "苗栗縣", "臺中市", "彰化縣", "南投縣",
        "嘉義市", "嘉義縣", "雲林縣", "臺南市",
        "高雄市", "屏東縣", "臺東縣", "花蓮縣"
    ];
    var select_html = '';
    $(function() {        
        city_array.forEach(function(value) {
            select_html = select_html + '<option value="'+value+'">'+ value +'</option>';
            //$('#city_select').append($("<option></option>").text(value));
        });
        $('#city_select').html(select_html);
        document.getElementById('city_select').value = '<?php echo $address ;?>';        
    });
</script>