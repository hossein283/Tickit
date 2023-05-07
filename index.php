<?php require_once './common/header.php'; ?>
<?php
if (isset($_SESSION['ACC'])) {
    header('location:panel.php');
}
$do_select = new classes\do_select('hefzonno_ticket', 'hefzonno_hosein', '2101383');
if (isset($_POST['btnSign'])) {
    $sql1 = "SELECT email FROM `users` WHERE email=?";
    $cond = $do_select->select($sql1, [$_POST['email']]);
    if ($cond == true) {
        $msg2 = "این ایمیل قبلا در سایت ثبت نام شده است";
    } else {
        $sql = 'INSERT INTO users SET name=?,lastname=?,username=?,email=?,password=?';
        $arr = [$_POST['name'], $_POST['lastname'], $_POST['username'], $_POST['email'], $_POST['password']];
        $do_select->do($sql, $arr);
        $msg = "ثبت نام با موفقیت انجام شد برای وردو به سایت از پنل ورود استفاده نمایید";
    }
}
if (isset($_POST['btnLogin'])) {
    $sql = "SELECT * FROM `users` WHERE email=? AND password=?";
    $conn = $do_select->select($sql, [$_POST['emailLogin'], $_POST['passwordLogin']], 'fetch');
    if ($conn == true) {
        if (isset($_POST['checkbox'])) {
            setcookie('email', $_POST['emailLogin'], time() + (24 * 60 * 60));
            setcookie('pass', $_POST['passwordLogin'], time() + (24 * 60 * 60));
        }
        if (!isset($_POST['checkbox'])) {
            setcookie('email', $_POST['emailLogin'], time() - (24 * 60 * 60));
            setcookie('pass', $_POST['passwordLogin'], time() - (24 * 60 * 60));
        }
        $_SESSION['ACC'] = 'ok';
        $_SESSION['name'] = $conn->name;
        $_SESSION['idUser'] = $conn->id;
        $_SESSION['email'] = $conn->email;
        $_SESSION['username'] = $conn->username;
        $_SESSION['password'] = $conn->password;
        header('location:panel.php');
    } else
        $msg1 = "ایمیل یا پسورد اشتباه است";
}
?>
    <div class="container-fluid m10top">
        <div class="col-sm-6">
            <div class="panel panel-info">
                <div class="panel-heading">
                    ورود
                </div>
                <div class="panel-body">
                    <?php if (!empty($msg1)) { ?>
                        <div class="alert alert-danger">
                            <?php echo $msg1; ?>
                        </div>
                    <?php } ?>
                    <form method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="ایمیل خود را وارد نمایید"
                                   value="<?php if (isset($_COOKIE['email'])) {
                                       echo $_COOKIE['email'];
                                   } ?>"
                                   name="emailLogin" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="رمز خود را وارد نمایید"
                                   value="<?php if (isset($_COOKIE['pass'])) {
                                       echo $_COOKIE['pass'];
                                   } ?>"
                                   name="passwordLogin" required>
                        </div>
                        <label class="containerCheck">
                            <input type="checkbox" name="checkbox" <?php if (isset($_COOKIE['pass'])){echo "checked";}?>>
                            <span class="checkmarket"></span>
                            <span>مرا به خاطر بسپار</span>
                        </label>
                        <button type="submit" class="btn btn-block btn-info" name="btnLogin">ورود به سایت</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-success">
                <div class="panel-heading">
                    ثبت نام
                </div>
                <div class="panel-body">
                    <?php if (!empty($msg)) { ?>
                        <div class="alert alert-success" style='margin: 14px'>
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                    <?php if (!empty($msg2)) { ?>
                        <div class="alert alert-danger" style='margin: 14px'>
                            <?php echo $msg2; ?>
                        </div>
                    <?php } ?>
                    <form method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="نام خود را وارد نمایید" name="name"
                                   required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="نام خانوادگی خود را وارد نمایید"
                                   name="lastname" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="نام کاربری خود را وارد نمایید"
                                   name="username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="ایمیل خود را وارد نمایید"
                                   name="email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="رمز خود را وارد نمایید"
                                   name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="btnSign">ثبت نام در سایت</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php require_once './common/footer.php'; ?>