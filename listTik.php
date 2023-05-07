<?php require_once './common/header.php' ?>
<?php $data = new \classes\do_select('hefzonno_ticket', 'hefzonno_hosein', '2101383');
if (!isset($_GET['title']) && !empty($_GET['title'])) {
    header('location:panel.php');
} ?>
<?php
$sql_table_tik = "SELECT * FROM `tik` WHERE id=?";
$statusT1 = $data->select($sql_table_tik, array($_GET['id']), 'fetch');
$statusT1 = $statusT1->statusT;
if ($statusT1 == 0 && $_SESSION['email'] != 'hosseinkinghosseini@gmail.com') {
    header('location:panel.php?تیکت غیر فعال است');
}
$sql = "SELECT * FROM tik WHERE  id=?";
if ($_SESSION['email'] == 'hosseinkinghosseini@gmai.com') {
    $conn = $data->select($sql, array($_GET['id']), 'fetchAll');
} else {
    $conn = $data->select($sql, array($_GET['id']), 'fetch');
}
if (isset($_POST['btnSend'])) {
    $sql = "INSERT INTO `anst` SET idT=?,title=?,content=?,name=?";
    $do = $data->do($sql, array($_GET['id'], $conn->title, $_POST['ans'], $_SESSION['name']));
    $msg = "پیام با موفقیت ارسال شد";
    if ($_SESSION['email'] == 'hosseinkinghosseini@gmail.com') {
        $sql = "UPDATE `tik` SET status=? WHERE id=?";
        $data->do($sql, array(1, $_GET['id']));
    } else {
        $sql = "UPDATE `tik` SET status=? WHERE id=?";
        $data->do($sql, array(0, $_GET['id']));
    }
}
if (isset($_POST['btnCloseT'])) {
    $sql = "UPDATE `tik` SET statusT=? WHERE id=?";
    $data->do($sql, array(0, $_GET['id']));
    $msg3 = "تیکت غیرفعال شد";
}
if (isset($_POST['btnOpenT'])) {
    $sql = "UPDATE `tik` SET statusT=? WHERE id=?";
    $data->do($sql, array(1, $_GET['id']));
    $msg2 = "تیکت فعال شد";
}
?>
    <div class="container2">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">جواب سوالات</div>
                <div class="panel-body">
                    <?php if (!empty($msg)) {
                        echo "<div class='alert alert-success'>{$msg}</div>";
                    } ?>
                    <form method="post">
                        <div class="form-group">
                            <label>پیام خود را بنویسید:</label>
                            <textarea name="ans" class="form-control" rows="5" id="comment"></textarea>
                        </div>
                        <button type="submit" name="btnSend" class="btn btn-danger btn-block" style="margin-top: 10px">
                            ارسال پیام
                        </button>
                        <?php
                        if ($_SESSION['email'] == 'hosseinkinghosseini@gmail.com') {
                            ?>
                            <button type="submit" name="btnCloseT" class="btn btn-warning" style="margin-top: 10px">
                                غیرفعال کردن تیکت
                            </button>
                            <button type="submit" name="btnOpenT" class="btn btn-success left" style="margin-top: 10px">
                                فعال کردن تیکت
                            </button>
                            <?php if (!empty($msg2)) { ?>
                                <br>
                                <div class="text-success text text-center">
                                    <?php echo $msg2 ?>
                                </div>
                            <?php } ?>
                            <?php if (!empty($msg3)) { ?>
                                <br>
                                <div class="text-danger text text-center">
                                    <?php echo $msg3 ?>
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <br><br>
                    </form>
                    <ul class="list-group">
                        <li class="list-group-item"><i
                                class="badge left">1</i><?php echo $_SESSION['name'] . ' ' . 'گفته:'; ?>
                        </li>
                        <li class="list-group-item"><p class="text-justify"><?php echo $conn->content ?></p>
                        </li>
                    </ul>

                    <?php
                    $sql = "SELECT * FROM `anst` WHERE idT=?";
                    $show = $data->select($sql, array($_GET['id']), 'fetchAll');
                    if (!empty($show)) {
                        $number = 2;
                        foreach ($show as $item1) {
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item"><i
                                        class="badge left"><?php echo $number++ ?></i><?php echo $item1->name . ' ' . 'گفته:' ?>
                                </li>
                                <li class="list-group-item"><p class="text-justify"><?php echo $item1->content ?></p>
                                </li>
                                <li class="list-group-item"><p class="text-justify"><?php $time = $item1->time;
                                        $convert = new classes\convertDate();
                                        $times = $convert->convert($time);
                                        echo $times ?></p>
                                </li>
                            </ul>
                        <?php }
                    } ?>
                </div>
                <div class="panel-footer"><a href="panel.php" class="btn btn-danger">بازگشت</a>
                </div>
            </div>
        </div>
    </div>
<?php require_once './common/footer.php' ?>