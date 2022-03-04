<?php require_once 'sys/head.php'; ?>
<?php 
    $sochuyen = (int) mget('chuyen');
    
    if ($sochuyen == 0) {
        header("Location: /");
        exit;
    } else {
        $chuyen = $db->query("SELECT * FROM `chuyenbay` WHERE `id` = '$sochuyen'")->fetch();
        if ($chuyen == null) {
            header("Location: /");
            exit;
        } else {
            if ($chuyen['ghe'] - $chuyen['dadat'] <= 0) {
                error("Chuyến bay hết ghế");
                require_once 'sys/end/php';
                exit;
            } else if ($chuyen['timeout'] < time()) {
                error("Chuyến bay dừng nhận book");
                require_once 'sys/end/php';
                exit;
            }
        }
    }
    if (isset($_POST['book'])) {
        $name = mpost('fullname');
        $phone = mpost('phone');
        $check = $db->query("SELECT `id` FROM `book` WHERE `chuyen` = '$sochuyen' AND `name` = '$name' AND `sdt` = '$phone'")->rowcount();
        if ($check != 0) {
            error('User đã tồn tại');
        } else {
            do {
                $madat = strtoupper(substr(md5(time() . rand(0,999999)), 0, 6));
            } while ($db->query("SELECT `id` FROM `book` WHERE `madat` = '$madat'")->rowcount() != 0);
            $db->exec("INSERT INTO `book` (`id`, `chuyen`, `madat`, `name`, `sdt`, `time`) VALUES (NULL, '$sochuyen', '$madat', '$name', '$phone', '" . time() . "');");
            $db->exec("UPDATE `chuyenbay` SET `dadat` = `dadat` + 1 WHERE `id` = '$sochuyen'");
            success('Thành công, mã đặt chuyến của bạn là ' . $madat . '\r\n Liên hệ chúng tôi để huỷ chuyến bay.');
        }
    }
?>
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Booking</h3>
                <hr class="divider my-4" />
                <div class="col-md-12 mb-2 text-left">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <label for="fullname" class="control-label">Full Name</label>
                                        <input class="form-control" type="text" name="fullname" minlength="2" placeholder="Full Name" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="phone" class="control-label">Phone Number</label>
                                        <input class="form-control" type="text" minlength="9" name="phone" placeholder="Phone Number" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="price" class="control-label">Price</label>
                                        <input class="form-control" type="text" name="price" value="$<?= number_format($chuyen['gia'],2) ?>" disabled>
                                    </div>
                                    </div>
                                    <div class="row form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-block btn-sm btn-primary" name="book" type="submit"><i class="fa fa-plane-departure"></i> Book Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php require_once 'sys/end.php'; ?>