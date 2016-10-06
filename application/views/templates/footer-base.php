 		<footer id="contact">
			<div class="row text-center footer-copyright">
				<p>© Copyright <?php echo date('Y') ?> VapeBox PH. All Rights Reserved. </p>
			</div>
		</footer>

	</main>

	<div class="remodal" data-remodal-id="wheelModal">
	  <button data-remodal-action="close" class="remodal-close"></button>
	  <div class="wheel-mask">
	  	<div class="wheel-container">
	  		<div class="wheel-step" id="wheel-one">
	  			<h2 class="col-xs-12 m-b-sm">Enter your name and contact details below to spin the wheel now!</h2>
	  			<form id="wheelContact" name="wheel-contact" class="form-horizontal">
	  				<div class="form-group col-xs-12">
	  					<input type="text" class="input-lg form-control" id="fname" name="fname" placeholder="First Name*">
	  					<p class="error fname-error"></p>
	  				</div>
	  				<div class="form-group col-xs-12">
	  					<input type="text" name="lname" class="input-lg form-control" id="lname" placeholder="Last Name*">
	  					<p class="error lname-error"></p>
	  				</div>
	  				<div class="form-group col-xs-12"> 
	  					<input type="email" name="email" class="input-lg form-control" id="email" placeholder="Email Address*">
	  					<p class="error email-error"></p> 
	  				</div> 
	  				<div class="form-group col-xs-12"> 
	  					<input type="text" name="mobile" class="input-lg form-control" id="mobile" placeholder="Mobile Number*">
	  					<p class="error mobile-error"></p> 
	  				</div> 
	  				<div class="form-group col-xs-12"> 
	  					<input type="hidden" class="input-lg form-control" id="ref_id" name="ref_id" >
	  				</div>
	  				<div class="form-group col-xs-12 text-center">
	  					<button type="submit" class="btn btn-lg btn-cornered ladda-button btn-contact-submit" data-style="zoom-in">
	  						<span class="ladda-label">Let's Play <span class="fa fa-chevron-right"></span>
	  					</button>
	  				</div>
	  			</form>
	  		</div>
	  		<div class="wheel-step" id="wheel-two">
	  			<div id="wrapper"> 
	  				<h2>Spin to Win!</h2>
	  				<h4>You can only spin once.</h4>
	  				<div id="wheel">
	  					<div id="inner-wheel">
	  						<div class="sec">
	  							<p>King David</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/king-david-60.png"); ?>" alt="King David Fineries">
	  							</span>
	  						</div>
	  						<div class="sec">
	  							<p>Holy Smokes</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/holy-smokes-60.png"); ?>" alt="Holy Smokes">
	  							</span>
	  						</div>
	  						<div class="sec">
	  							<p>Bullet Vape</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/bullet-vape-60.png"); ?>" alt="Bullet Vape">
	  							</span>
	  						</div> 
	  						<div class="sec">
	  							<p>Malibu</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/malibu-60.png"); ?>" alt="Malibu">
	  							</span>
	  						</div>
	  						<div class="sec">
	  							<p>Daily Drip</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/daily-drip-60.png"); ?>" alt="Daily Drip">
	  							</span>
	  						</div>
	  						<div class="sec">
	  							<p>Golden Drops</p>
	  							<span class="fa">
	  								<img src="<?php echo base_url("/assets/images/suppliers/golden-drops-60.png"); ?>" alt="Golden Drops">
	  							</span>
	  						</div>
	  					</div> 
	  					<div id="spin">
	  						<div id="inner-spin"></div>
	  					</div>
	  					<div id="shine"></div>
	  				</div>
	  				<div class="prize-container">
	  					<div id="prizeTxt"></div>
	  					<button class="btn btn-cornered btn-lg" id="claimPrizeBtn" disabled>Claim My Prize</button>
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	  </div>
	</div>

	<!-- Fonts -->
	<script src="https://use.typekit.net/jpt8btq.js"></script>
	<script>try{Typekit.load({ async: true });}catch(e){}</script>
	<link href='http://fonts.googleapis.com/css?family=Exo+2:900' rel='stylesheet' type='text/css'>

	<!-- Scripts -->
	<script type="text/javascript" src="<?php echo base_url('src/spin.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/js/main.min.js'); ?>"></script>
	<script type="text/javascript" src="<?php echo base_url('src/custom.js'); ?>"></script>
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) { 
		  vapebox.initWheel();
		});
	</script>
</body>
</html>