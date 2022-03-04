<?php require_once 'head.php'; ?>
<?php
    if (isset($_GET['del'])) {
        $iddel = mget('del');
        $db->exec("DELETE FROM `chuyenbay` WHERE `id` = '$iddel'");
        echo '<script>alert("Đã xoá ' . $iddel . '"); window.location = "/admin/chuyenbay.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách chuyến bay</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sân bay</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Chuyến bay | <a href="/admin/themchuyenbay.php">Thêm</a></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th>
                          Đi
                      </th>
                      <th>
                          Đến
                      </th>
                      <th>
                          Hãng
                      </th>
                      <th>
                          Loại
                      </th>
                      <th>
                          Số hiệu
                      </th>
                      <th>
                          Ghế
                      </th>
                      <th>
                          Đã đặt
                      </th>
                      <th>
                          Giá vé
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $chuyenbays = $db->query("SELECT * FROM `chuyenbay` ORDER BY `id` DESC");
                  foreach ($chuyenbays as $chuyenbay) {
                      $sanbaydi = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $chuyenbay['di'] . "'")->fetch();
                      $sanbayden = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $chuyenbay['den'] . "'")->fetch();
                      $hang = $db->query("SELECT * FROM `hang` WHERE `id` = '" . $chuyenbay['hang'] . "'")->fetch();
                  ?>
                      <tr>
                          <td>
                                <?= $chuyenbay['id']; ?>
                          </td>
                          <td>
                                <?= $sanbaydi['sanbay'] . " - " . $sanbaydi['dd']; ?>
                                <div></div>
                                <?= $chuyenbay['timedi']; ?>
                          </td>
                          <td>
                              <?= $sanbayden['sanbay'] . " - " . $sanbayden['dd']; ?>
                              <div></div>
                              <?= $chuyenbay['timeden']; ?>
                          </td>
                          <td>
                              <?= $hang['hang']; ?>
                          </td>
                          <td>
                              <?php
                              if ($chuyenbay['loai'] == 1) echo "1 chiều";
                              else {
                                  echo "Khứ hồi " . date("d-m-Y", strtotime($chuyenbay['khuhoi']));
                              } ?>
                          </td>
                          <td>
                              <?= $chuyenbay['maybay']; ?>
                          </td>
                          <td>
                              <?= $chuyenbay['ghe']; ?>
                          </td>
                          <td>
                              <?= $chuyenbay['dadat']; ?>
                          </td>
                          <td>
                                <?= $chuyenbay['gia']; ?>
                          </td>
                          <td class="project-actions text-right">
                              <a class="btn btn-primary btn-sm" href="edit.php?id=<?= $chuyenbay['id']; ?>">
                                  <i class="fas fa-trash">
                                  </i>
                                  Edit
                              </a>
                              <a class="btn btn-danger btn-sm" href="?del=<?= $chuyenbay['id']; ?>">
                                  <i class="fas fa-trash">
                                  </i>
                                  Delete
                              </a>
                          </td>
                      </tr>
                <?php } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php require_once 'end.php'; ?>