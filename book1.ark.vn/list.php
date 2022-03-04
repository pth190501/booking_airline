<?php require_once 'sys/head.php'; ?>

<style>
#portfolio .img-fluid{
    width: calc(100%);
    height: 30vh;
    z-index: -1;
    position: relative;
    padding: 1em;
}
</style>
	<section class="page-section" id="flight" >
        <div class="container">
        	<div class="card">
        		<div class="card-body">
        			<div class="col-lg-12">
						<div class="row">
							<div class="col-md-12 text-center">
								<h2><b>Available</b></h2>
							</div>
						</div>
						<hr class="divider">
				<?php
				$hi = date("d-m-Y",strtotime("today"));
				$chuyenbay = $db->query("SELECT * FROM `chuyenbay` WHERE `timedi` LIKE '%$hi%' AND `ghe` - `dadat` > 0");
				if ($chuyenbay->rowcount() == 0) {
				    echo '<div class="row align-items-center"><h5 class="text-center"><b>No result.</b></h5></div>';
				} else foreach ($chuyenbay as $cb) {
				    $sanbaydi = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $cb['di'] . "'")->fetch();
				    $sanbayden = $db->query("SELECT * FROM `sanbay` WHERE `id` = '" . $cb['den'] . "'")->fetch();
				    $hang = $db->query("SELECT * FROM `hang` WHERE `id` = '" . $cb['hang'] . "'")->fetch();
				?>
				<div class="row align-items-center">
					<div class="col-md-3">
						<img src="/assets/img/<?= $hang['logo']; ?>" alt="<?= $hang['hang']; ?>">
					</div>
					<div class="col-md-6">
						 <p><b><?= $sanbaydi['dd'] . ' - ' . $sanbayden['dd']; ?></b></p>
						 <p><small>Plane: <b><?= $cb['maybay']; ?></b></small></p>
						 <p><small>Airline: <b><?= $hang['hang']; ?></b></small></p>
						 <p><small>Departure: <b><?php echo date('M d,Y',strtotime($cb['timedi'])) ?></b></small></p>
						 <p><small>Arrival: <b><?php echo date('M d,Y',strtotime($cb['timeden'])) ?></b></small></p>
						 <?php if ($trip == 2) {
						        echo '<p><small>Round trip: <b>' . date('M d,Y',strtotime($cb['khuhoi'])) . '</b></small></p>';
						 } ?>
						 <p>Available Seats: <b><h4><?= $cb['ghe'] - $cb['dadat']; ?></h4></b></p>
					</div>
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

<section class="page-section" id="menu">
<div id="portfolio" class="container">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-lg-12 text-center">
                    <h2 class="mb-4">Partner Airlines</h2>
                    <hr class="divider">

                    </div>
                </div>
                <div class="row no-gutters">
                    <?php
                    $cats = $db->query("SELECT * FROM `hang` order by `hang` asc");
                        foreach ($cats as $row){
                    ?>
                    <div class="col-lg-4 col-sm-6">
                        <div class="portfolio-box" href="#">
                            <img class="img-fluid" src="/assets/img/<?= $row['logo']; ?>" alt="<?= $row['hang']; ?>" />
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
	
    </section>
<?php require_once 'sys/end.php'; ?>