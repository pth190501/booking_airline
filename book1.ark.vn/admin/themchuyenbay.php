<?php require_once 'head.php'; ?>
<?php
    if (isset($_POST['save'])) {
        $di = mpost('di');
        $den = mpost('den');
        $hang = mpost('hang');
        $sohieu = mpost('sohieu');
        $ghe = mpost('ghe');
        $gia = mpost('gia');
        $timedi = date("d-m-Y", strtotime(mpost('timedi')));
        $timeden = date("d-m-Y", strtotime(mpost('timeden')));
        $timekhuhoi = date("d-m-Y", strtotime(mpost('timekhuhoi')));
        $timeout = strtotime(mpost('timeout'));
        $loai = mpost('loai');
        if ($loai != 2) {
            $timekhuhoi = "";
        }
        $db->exec("INSERT INTO `chuyenbay` (`id`, `hang`, `maybay`, `di`, `den`, `timedi`, `timeden`, `khuhoi`, `loai`, `timeout`, `ghe`, `dadat`, `gia`, `timetao`) VALUES (NULL, '$hang', '$sohieu', '$di', '$den', '$timedi', '$timeden', '$timekhuhoi', '$loai', '$timeout', '$ghe', '0', '$gia', '" . time() . "');");
        echo '<script>alert("Đã thêm ' . $sohieu . '"); window.location = "/admin/chuyenbay.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm chuyến bay</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm chuyến bay</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="tab-pane" id="settings">
            <form class="form-horizontal" method="post">
              <div class="form-group row">
                <label for="ten" class="col-sm-2 col-form-label">Đi từ</label>
                <div class="col-sm-10">
                  <select name="di" id="departure_location" class="custom-select browser-default select2" required>
                    <?php
                    $airport = $db->query("SELECT * FROM `sanbay` order by `dd` asc");
                    foreach ($airport as $row) {
                    ?>
                    <option value="<?php echo $row['id'] ?>">
                    <?= $row['dd'] . ", " . $row['sanbay']; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="den" class="col-sm-2 col-form-label">Đến</label>
                <div class="col-sm-10">
                  <select name="den" id="departure_location" class="custom-select browser-default select2" required>
                    <?php
                    $airport = $db->query("SELECT * FROM `sanbay` order by `dd` asc");
                    foreach ($airport as $row) {
                    ?>
                    <option value="<?php echo $row['id'] ?>">
                    <?= $row['dd'] . ", " . $row['sanbay']; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="hang" class="col-sm-2 col-form-label">Hãng</label>
                <div class="col-sm-10">
                  <select name="hang" id="departure_location" class="custom-select browser-default select2" required>
                    <?php
                    $hangs = $db->query("SELECT * FROM `hang` order by `hang` asc");
                    foreach ($hangs as $hang) {
                    ?>
                    <option value="<?php echo $hang['id'] ?>">
                    <?= $hang['hang']; ?>
                    </option>
                    <?php } ?>
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="sohieu" class="col-sm-2 col-form-label">Số hiệu</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="sohieu" name="sohieu" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="ghe" class="col-sm-2 col-form-label">Số lượng ghế</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="ghe" name="ghe" min="1" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="gia" class="col-sm-2 col-form-label">Giá</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="gia" name="gia" autocomplete="off" required>
                </div>
              </div>
                <div class="row form-group">
                    <label for="loai" class="col-sm-2 col-form-label">Loại</label>
                                    <div class="col-sm-2 text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="loai"
                                                value="1" onclick='document.querySelector("#khuhoidiv").style = "display: none";' checked>
                                            <label class="form-check-label">
                                                1 chiều
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="loai"
                                                value="2" onclick='document.querySelector("#khuhoidiv").style = "";'>
                                            <label class="form-check-label">
                                                Khứ hồi
                                            </label>
                                        </div>
                                    </div>
                                </div>
                
              <div class="form-group row">
                  <label for="timedi" class="col-sm-2 col-form-label">Ngày đi</label>
                                        <input type="date" class="form-control" style="max-width: 50%" name="timedi"
                                            autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>" value="<?= date("Y-m-d",strtotime("today +1 day")); ?>" required="">
                </div>
                <div class="form-group row">
                  <label for="timeden" class="col-sm-2 col-form-label">Ngày đến</label>
                                        <input type="date" class="form-control" style="max-width: 50%" name="timeden"
                                            autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>" value="<?= date("Y-m-d",strtotime("today +2 day")); ?>" required>
                </div>
                <div class="form-group row" id="khuhoidiv" style="display: none;">
                  <label for="timekhuhoi" class="col-sm-2 col-form-label">Ngày khứ hồi</label>
                                        <input type="date" class="form-control" style="max-width: 50%;" name="timekhuhoi"
                                            autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>" value="<?= date("Y-m-d",strtotime("today +3 day")); ?>">
                </div>
                <div class="form-group row">
                  <label for="timeout" class="col-sm-2 col-form-label">Dừng nhận book</label>
                                        <input type="date" class="form-control" style="max-width: 50%" name="timeout"
                                            autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>" value="<?= date("Y-m-d",strtotime("today +1 day")); ?>" required>
                </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-danger">Thêm</button>
                </div>
            </div>
            </form>
                  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>