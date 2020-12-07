<?php

require_once 'mydatabase.php';
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    header("Location:login_page.php");
}

?>

<h2 class='mb-3'>個人資料</h2>

<form action="" method="POST" class="mt-2 p-3 border rounded">
    <div class="form-group row ml-5">
        <label for="inputname" class="col-md-1 col-form-label text-right">姓名:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputname">
        </div>
    </div>
    <div class="form-group row ml-5">
        <label for="inputnickname" class="col-md-1 col-form-label text-right">暱稱:</label>
        <div class="col-md-4">
            <input type="password" class="form-control" id="inputnickname">
        </div>
    </div>
    <div class="form-group row ml-5">
        <label class="col-md-1 col-form-label text-right">性別:</label>
        <div class="col-md-6 d-flex align-items-center">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="gender-male" name="gender-male" class="custom-control-input" value="male">
                <label class="custom-control-label" for="gender-male">男性</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="gender-female" name="gender-female" class="custom-control-input" value="female">
                <label class="custom-control-label" for="gender-female">女性</label>
            </div>
        </div>
    </div>
    <div class="form-group row ml-5">
        <label for="inputPassword3" class="col-md-1 col-form-label text-right">電話:</label>
        <div class="col-md-4">
            <input type="number" class="form-control" id="inputPassword3">
        </div>
    </div>
    <div class="form-group row ml-5">
        <label for="inputbirth" class="col-md-1 col-form-label text-right">生日:</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputbirth">
        </div>
    </div>
    <div class="form-group row">
        <div class="text-center w-100">
            <button type="submit" class="btn btn-primary col-md-2">儲存</button>
        </div>
    </div>
</form>