<?php
if (!($auth > 0)) {
    header("Location:profile_center.php");
}
?>

<div class="card m-2">
    <div class="card-body">
        <div class="row d-flex">
            <h5 class="d-inline d-flex align-items-center m-0 ml-3">新增消息</h5>
            <a class="btn btn-primary ml-auto mr-3" href="profile/profile_addnews.php" role="button">前往</a>
        </div>

    </div>
</div>
<div class="card m-2">
    <div class="card-body">
        <div class="row d-flex">
            <h5 class="d-inline d-flex align-items-center m-0 ml-3">消息管理</h5>
            <a class="btn btn-primary ml-auto mr-3" href="profile/profile_news_manage.php" role="button">前往</a>
        </div>
    </div>
</div>