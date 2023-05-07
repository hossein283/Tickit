<?php require_once './common/header.php' ?>
<?php
if (isset($_SESSION['ACC'])) {
} else {
    header('location:index.php');
}
?>
<div class="container-fluid">
    <div class="col-sm-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h4 class="text-center">لیست تیکت های موجود - ارسال تیکت</h4>
            </div>
            <div class="panel-body">
                <div class="table-bordered">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ایمیل</th>
                            <th>عنوان تیکت</th>
                            <th>وضعیت تیکت</th>
                            <th>اولویت</th>
                            <th>دسته بندی</th>
                            <th>وضعیت پاسخ دهی</th>
                            <th>مشاهده تیکیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $do_select = new classes\do_select('hefzonno_ticket', 'hefzonno_hosein', '2101383');
                        if ($_SESSION['email'] == 'hosseinkinghosseini@gmail.com') {
                            $sql1 = "SELECT * FROM `tik`";
                            $data = $do_select->select($sql1);
                        } else {
                            $sql2 = "SELECT * FROM `tik` WHERE idUser=?";
                            $data = $do_select->select($sql2, [$_SESSION['idUser']], 'fetchAll');
                        }
                        ?>
                        <?php
                        if (!empty($data)){
                         foreach ($data as $val) { ?>
                            <tr>
                                <td><?php echo $val->emailUser ?></td>
                                <td><?php echo $val->title ?></td>
                                <td><?php if ($val->statusT == 1){
                                    echo '<span style="color: green">تیکت فعال است</span>';
                                    }elseif ($val->statusT==0){
                                        echo '<span style="color: red">تیکت غیرفعال است</span>';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($val->olaviat == 1) {
                                        echo 'زیاد';
                                    } elseif ($val->olaviat == 2) {
                                        echo 'متوسط';
                                    } elseif ($val->olaviat == 3) {
                                        echo 'کم';
                                    }
                                    ?></td>
                                <td><?php if ($val->cate == 1) {
                                        echo 'هاست';
                                    } elseif ($val->cate == 2) {
                                        echo 'فنی';
                                    } elseif ($val->cate == 3) {
                                        echo 'نصب';
                                    } elseif ($val->cate == 4) {
                                        echo 'پنل';
                                    } elseif ($val->cate == 5) {
                                        echo 'دامنه';
                                    }
                                    ?></td>
                                <td><?php
                                    if ($val->status == 0) {
                                        echo '<span style="color: red"> پاسخ داده نشده است</span>';
                                    } elseif ($val->status == 1) {
                                        echo '<span style="color: green"> پاسخ داده شده است</span>';
                                    }
                                    ?></td>
                                <td><a href="listTik.php?id=<?php echo $val->id ?>"
                                       class="btn btn-primary">مشاهده</a></td>
                            </tr>
                        <?php }}else{
                            echo "<div class='alert alert-warning' style='padding: 10px'>هیچ تیکتی برای نمایش وجود ندارد</div>";
                        } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <a class="btn btn-block btn-success" href="newTiket.php">ارسال تیکت</a>
            </div>
        </div>
    </div>
</div>
<?php require_once './common/footer.php' ?>
