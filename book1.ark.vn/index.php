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

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4 page-title">
                <h3 class="text-white">Flights</h3>
                <hr class="divider my-4" />
                <div class="col-md-12 mb-2 text-left">
                    <div class="card">
                        <div class="card-body">
                            <form id="manage-filter" method="POST">
                                <div class="row form-group">
                                    <div class="col-sm-3">
                                        <label for="di" class="control-label">From</label>
                                        <select name="di" id="departure_location" class="custom-select browser-default select2">
                                            <?php
                                            $airport = $db->query("SELECT * FROM `sanbay` order by `dd` asc");
                                            $di = mpost('di');
                                            foreach ($airport as $row) {
                                            ?>
                                            <option value="<?php echo $row['id'] ?>" 
                                                <?php
                                                    if ($di == $row['id']) {
                                                        echo "selected";
                                                    }
                                                ?>
                                            >
                                            <?= $row['dd'] . ", " . $row['sanbay']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="den" class="control-label">To</label>
                                        <select name="den" id="departure_location" class="custom-select browser-default select2">
                                            <?php
                                            $airport = $db->query("SELECT * FROM `sanbay` order by `dd` asc");
                                            $den = mpost('den');
                                            foreach ($airport as $row){
                                            ?>
                                            <option value="<?php echo $row['id'] ?>"
                                                <?php
                                                    if ($den == $row['id']) {
                                                        echo "selected";
                                                    }
                                                ?>
                                            >
                                            <?= $row['dd'] . ", " . $row['sanbay']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <?php 
                                        $timedi = mpost('timedi'); 
                                        if ($timedi == "" && !isset($_POST['find'])) {
                                            $timedi = "today"; 
                                        }
                                    ?>
                                    <div class="col-sm-3">
                                        <label for="timedi" class="control-label">Departure Date</label>
                                        <input type="date" class="form-control input-sm datetimepicker2" name="timedi"
                                            autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>" value="<?php
                                                        if ($timedi != "") {
                                                            echo date("Y-m-d",strtotime($timedi));
                                                        }
                                                    ?>">
                                    </div>
                                    <?php $khuhoi = mpost('khuhoi'); ?>
                                    <div class="col-sm-3" id="rdate" 
                                        <?php 
                                            if ((int) mpost('trip') != 2) {
                                                echo ' style="display: none"';
                                            }
                                        ?>
                                    >
                                        <label for=khuhoi"" class="control-label">Return Date</label>
                                        <input type="date" class="form-control input-sm datetimepicker2"
                                            name="khuhoi" autocomplete="off" min="<?= date("Y-m-d",strtotime("today")); ?>"
                                            value="<?php
                                                        if ($khuhoi != "") {
                                                            echo date("Y-m-d",strtotime($khuhoi));
                                                        }
                                                    ?>">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-2 text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="onewway"
                                                value="1"
                                                <?php 
                                                    if ((int) mpost('trip') != 2) {
                                                        echo ' checked';
                                                    } 
                                                ?>
                                            >
                                            <label class="form-check-label" for="onewway">
                                                One-way
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="trip" id="rtrip"
                                                value="2" 
                                                <?php 
                                                    if ((int) mpost('trip') == 2) {
                                                        echo ' checked';
                                                    } 
                                                ?>
                                            >
                                            <label class="form-check-label" for="rtrip">
                                                Round Trip
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 offset-sm-5">
                                        <button class="btn btn-block btn-sm btn-primary" name="find" type="submit"><i
                                                class="fa fa-plane-departure"></i> Find Flights</button>
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
    if (isset($_POST['find'])) {
?>

	<section class="page-section" id="flight" >
        <div class="container">
        	<div class="card">
        		<div class="card-body">
        			<div class="col-lg-12">
						<div class="row">
							<div class="col-md-12 text-center">
								<h2><b>Results</b></h2>
							</div>
						</div>
						<hr class="divider">
				<?php
                $di = (int) mpost('di');
                $den = (int) mpost('den');
                $timedi = date("d-m-Y", strtotime(mpost('timedi')));
                $khuhoi = date("d-m-Y", strtotime(mpost('khuhoi')));
                $trip = (int) mpost('trip');
                if ($trip == 2) {
                    $qrkhuhoi = " AND `khuhoi` LIKE '%$khuhoi%' ";
                } else {
                    $qrkhuhoi = " AND `loai` = '1' ";
                }
				$chuyenbay = $db->query("SELECT * FROM `chuyenbay` WHERE `di` = '$di' AND `den` = '$den' 
				    AND `timedi` LIKE '%$timedi%' $qrkhuhoi AND `ghe` - `dadat` > 0 AND `timeout` > '" . time() . "'");
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
					<div class="col-md-3 text-center align-self-end-sm">
						<h4 class="text-right"><b>$<?= number_format($cb['gia'],2) ?></b></h4>
						<a href="/booknow.php?chuyen=<?= $cb['id']; ?>"><button class="btn-outline-primary  btn  mb-4 book_flight">Book Now</button></a>
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
<?php } ?>
<script>
    $('[name="trip"]').on("keypress change keyup",function(){
            if($(this).val() == 1){
                $('#rdate').hide();
                document.querySelector("#rdate > input").removeAttribute("required");
            }else{
                $('#rdate').show();
                document.querySelector("#rdate > input").setAttribute("required", "");
            }
        })
</script>

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