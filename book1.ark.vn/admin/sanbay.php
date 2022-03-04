<?php require_once 'head.php'; ?>
<?php
    if (isset($_GET['del'])) {
        $iddel = mget('del');
        $db->exec("DELETE FROM `sanbay` WHERE `id` = '$iddel'");
        echo '<script>alert("Đã xoá ' . $iddel . '"); window.location = "/admin/sanbay.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách sân bay</h1>
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
          <h3 class="card-title">Sân bay | <a href="/admin/themsanbay.php">Thêm</a></h3>

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
                      <th style="width: 49%">
                          Tên
                      </th>
                      <th style="width: 50%">
                          Địa điểm
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $sanbays = $db->query("SELECT * FROM `sanbay` ORDER BY `id` DESC");
                  foreach ($sanbays as $sanbay) {
                  ?>
                      <tr>
                          <td>
                                <?= $sanbay['id']; ?>
                          </td>
                          <td>
                                <?= $sanbay['sanbay']; ?>
                          </td>
                          <td>
                              <?= $sanbay['dd']; ?>
                          </td>
                          <td class="project-actions text-right">
                              <a class="btn btn-danger btn-sm" href="?del=<?= $sanbay['id']; ?>">
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