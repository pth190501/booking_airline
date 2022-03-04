<?php require_once 'sys/head.php'; ?>
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Search</h3>
                <hr class="divider my-4" />
                <div class="col-md-12 mb-2 text-left">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <label for="code" class="control-label">Flight Number</label>
                                        <input class="form-control" type="text" name="code" minlength="6" maxlength="6" placeholder="Flight Number" value="<?= strtoupper(mpost('code')); ?>" required>
                                    </div>
                                    </div>
                                    <div class="row form-group">
                                    <div class="col-sm-12">
                                        <button class="btn btn-block btn-sm btn-primary" name="search" type="submit"><i class="fa fa-plane-departure"></i> Search</button>
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
<?php
    if (isset($_POST['search'])) {
        $code = strtoupper(mpost('code'));
        $check = $db->query("SELECT * FROM `book` WHERE `madat` = '$code'")->fetch();
        if ($check == null) {
            error('Mã đặt không tồn tại');
        } else { ?>
    <section class="page-section" id="flight" >
        <div class="container">
        	<div class="card">
        		<div class="card-body">
        			<div class="col-lg-12">
						<div class="row">
							<div class="col-md-12 text-center">
								<h2><b>Flight Detail</b></h2>
							</div>
						</div>
						<hr class="divider">
				<?php
				$cb = $db->query("SELECT * FROM `chuyenbay` WHERE `id` = '" . $check['chuyen'] . "'")->fetch();
				if ($cb == null) {
				    echo '<div class="row align-items-center"><h5 class="text-center"><b>500</b></h5></div>';
				} else {
				    $sanbaydi = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $cb['di'] . "'")->fetch();
				    $sanbayden = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $cb['den'] . "'")->fetch();
				    $hang = $db->query("SELECT * FROM `hang` WHERE `id` = '" . $cb['hang'] . "'")->fetch();
				?>
				<div class="row align-items-center">
					<div class="col-md-3">
						<img src="/assets/img/<?= $hang['logo']; ?>" alt="">
					</div>
					<div class="col-md-6">
						 <p><b><?= $sanbaydi['dd'] . ' - ' . $sanbayden['dd']; ?><?php if ($check['status'] != '1') echo ' (Canceled by admin)'; ?></b></p>
						 <p><small>Name: <b><?= $check['name']; ?></b></small></p>
						 <p><small>Phone: <b><?= $check['sdt']; ?></b></small></p>
						 <p><small>Plane: <b><?= $cb['maybay']; ?></b></small></p>
						 <p><small>Airline: <b><?= $hang['hang']; ?></b></small></p>
						 <p><small>Departure: <b><?php echo date('M d,Y',strtotime($cb['timedi'])) ?></b></small></p>
						 <p><small>Arrival: <b><?php echo date('M d,Y',strtotime($cb['timeden'])) ?></b></small></p>
						 <?php if ($cb['loai'] == 2) {
						        echo '<p><small>Round trip: <b>' . date('M d,Y',strtotime($cb['khuhoi'])) . '</b></small></p>';
						 } ?>
				</div>
				<hr class="divider" style="max-width: 60vw">
				<?php } ?>
				</div>
				</div>
        	</div>
        </div>
    </section>
    <style>
    	#flight img{
    		max-height: 300px;
    		max-width: 200px; 
    	}
    	#flight p{
    		margin: unset
      	}
    </style>
    
    <?php  }
    }
?>
<?php require_once 'sys/end.php'; ?>