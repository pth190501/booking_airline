<?php require_once 'head.php'; ?>
<?php
    if (isset($_GET['del'])) {
        $iddel = mget('del');
        $db->exec("DELETE FROM `hang` WHERE `id` = '$iddel'");
        echo '<script>alert("Đã xoá ' . $iddel . '"); window.location = "/admin/hang.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách hãng</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sân hãng</li>
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
          <h3 class="card-title">Sân bay | <a href="/admin/themhang.php">Thêm</a></h3>

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
                          ID
                      </th>
                      <th "width: 20%">
                          Tên
                      </th>
                      <th style="width:30%">
                          Ảnh
                      </th>
                      <th style="width:20%">
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $hangs = $db->query("SELECT * FROM `hang` ORDER BY `hang` ASC");
                  foreach ($hangs as $hang) {
                  ?>
                      <tr>
                          <td>
                                <?= $hang['id']; ?>
                          </td>
                          <td>
                                <?= $hang['hang']; ?>
                          </td>
                          <td >
                              <img src="/assets/img/<?php echo $hang['logo']?>" style="max-width:100%">
                          </td>
                          <td class="project-actions text-right">
                              <a class="btn btn-danger btn-sm" href="?del=<?= $hang['id']; ?>">
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