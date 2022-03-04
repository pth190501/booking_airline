<?php require_once 'head.php'; ?>

<?php
    if (isset($_GET['del'])) {
        $iddel = mget('del');
        $db->exec("UPDATE `book` SET `status` = '0' WHERE `id` = '$iddel'");
        echo '<script>alert("Đã huỷ ' . $iddel . '"); window.location = "/admin/book.php";</script>';
    }
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh sách khách đã book</h1>
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
          <h3 class="card-title">khách đã book</h3>

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
                          Mã đặt
                      </th>
                      <th>
                          Tên
                      </th>
                      <th>
                          Số điện thoại
                      </th>
                      <th>
                          ID Chuyến
                      </th>
                      <th>
                          Thời gian
                      </th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $books = $db->query("SELECT * FROM `book` ORDER BY `id` DESC");
                  foreach ($books as $book) {
                  ?>
                      <tr>
                          <td>
                                <?= $book['id']; ?>
                          </td>
                          <td>
                                <?= $book['madat']; ?>
                          </td>
                          <td>
                              <?= $book['name']; ?>
                          </td>
                          <td>
                              <?= $book['sdt']; ?>
                          </td>
                          <td>
                              <?= $book['chuyen']; ?>
                          </td>
                          <td>
                              <?= date("H:i:s d-m-Y", $book['time']); ?>
                          </td>
                          <td class="project-actions text-right">
                              <?php if ($book['status'] == '1') { ?>
                              <a class="btn btn-danger btn-sm" href="?del=<?= $book['id']; ?>">
                                  <i class="fas fa-trash">
                                  </i>
                                  Cancel
                              </a>
                              <?php } else echo "Đã huỷ"; ?>
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