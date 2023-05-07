<?php require_once './common/header.php' ?>
<?php
$do_select = new classes\do_select('hefzonno_ticket', 'hefzonno_hosein', '2101383');
if (isset($_POST['btnSendT'])) {
    $filename = $_FILES['file']['name'];
    $tmpname = $_FILES['file']['tmp_name'];
    $exp = explode('.', $filename);
    $passvand = end($exp);
    if (in_array($passvand, array('png', 'jpg', 'jpeg', ''))) {
        if ($passvand == '') {
            $name = "تصویری وجود ندارد";
        } else {
            $name = rand(0, 10000) . '_' . rand(1, 1000) . '.' . $passvand;
            move_uploaded_file($tmpname, 'img/' . $name);
        }
    } else {
        $msg2 = "پسوند فایل مجاز نمیباشد";
    }
    $sql = "INSERT INTO `tik` SET title=?,content=?,file=?,cate=?,olaviat=?,idUser=?,emailUser=?";
    $arr = [$_POST['title'], $_POST['editor'], $name, $_POST['cate'], $_POST['olaviat'], $_SESSION['idUser'], $_SESSION['email']];
    $conn = $do_select->do($sql, $arr);
    $msg = "تیکت شما با موفقیت ثبت شد و پس از بررسی به آن پاسخ داده خواهد شد";
}
?>
    <div class="container2">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h5 class="text-center">ارسال تیکت</h5>
                </div>
                <div class="panel-body">
                    <?php if (!empty($msg)) {
                        echo "<div class='alert alert-success' style='margin: 14px'>$msg</div>";
                    } ?>
                    <?php if (!empty($msg2)) {
                        echo "<div class='alert alert-danger' style='margin: 14px'>$msg2</div>";
                    } ?>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="عنوان تیکت را وارد نمایید"
                                   name="title" required>
                        </div>
                        <div class="form-group">
                            <p>انتخاب دسته بندی</p>
                            <select class="form-control" name="cate" required>
                                <option value="1">هاست</option>
                                <option value="2">فنی</option>
                                <option value="3">نصب</option>
                                <option value="4">پنل</option>
                                <option value="5">دامنه</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <p>انتخاب اولویت</p>
                            <select class="form-control" name="olaviat" required>
                                <option value="1">زیاد</option>
                                <option value="2">متوسط</option>
                                <option value="3">کم</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>پیام خود را بنویسید:</label>
                            <textarea name="editor" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        <p>ضمیمه ها</p>
                        <span class="btn btn-primary btn-file">
                        انتخاب فایل<input type="file" name="file">
                    </span>
                        <br>
                        <button type="submit" name="btnSendT" class="btn btn-success btn-block"
                                style="margin-top: 10px">
                            ارسال تیکت
                        </button>
                        <br>
                        <a href="panel.php" class="btn btn-danger">بازگشت</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once './common/footer.php' ?>