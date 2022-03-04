<?php require_once 'head.php'; ?>
<?php
    if (isset($_POST['save'])) {
        $ten = mpost('ten');
        $dd = mpost('dd');
        $db->exec("INSERT INTO `sanbay` (`id`, `sanbay`, `dd`) VALUES (NULL, '$ten', '$dd');");
        echo '<script>alert("Đã thêm ' . $ten . '"); window.location = "/admin/sanbay.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Thêm sân bay</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Thêm sân bay</li>
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
                <label for="ten" class="col-sm-2 col-form-label">Tên sân bay</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="ten" name="ten" autocomplete="off" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="dd" class="col-sm-2 col-form-label">Địa điểm</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="dd" name="dd" autocomplete="off" required>
                </div>
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