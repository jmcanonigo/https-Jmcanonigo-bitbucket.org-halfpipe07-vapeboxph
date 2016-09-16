<section class="contact p-b-lg">
	<div id="map"></div>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center">
				<img src="<?php echo base_url('assets/images/redlist-icon-100.png'); ?>" alt="Redlist Property Investments">
			</div>
			<div class="col-xs-12">
				<h2>Contact Us</h2>
			</div>
			<div class="col-xs-12 col-md-8">
				<h4>Still have questions? Comments or suggestions? Do you have ideas on how to improve our services? Hit us up!</h4>
				<form class="form-horizontal col-xs-12 col-sm-8 m-t-sm" action="<?php echo base_url('index.php/mail/send_mail'); ?>" method="post">
					<div class="form-group">
						<input type="text" class="form-control" name="name" placeholder="Full Name" required />
					</div>
					<div class="form-group">
						<input type="email" class="form-control" name="email" placeholder="Email" required />
					</div>
					<div class="form-group">
						<input type="text" class="form-control" name="mobile" placeholder="Mobile" required />
					</div>
					<div class="form-group">
						<textarea class="form-control" rows="3" name="message" placeholder="What do you want to say?" required></textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Send Message" class="btn btn-red" />
					</div>

					<?php if(isset($message)) { ?>
						<div class="alert alert-<?php echo $type; ?> m-b-0">
							<span><?php echo $message; ?></span>
						</div>
					<?php } ?>
				</form>
			</div>
			<div class="col-xs-12 col-md-4">
				<div class="contact-address">
					<p>
						<strong>Redlist Property Investments</strong><br>
						Unit 311 Sunrise Condominium,<br>
						226 Ortigas Ave. Ext., Greenhills,<br>
						San Juan, Metro Manila
					</p>
				</div>
				<div class="contact-details m-t-sm">
					<table>
						<tr>
							<td><i class="fa fa-phone"></i> Landline</td>
							<td>(632) 899 7130</td>
						</tr>
						<tr>
							<td><i class="fa fa-phone"></i> Mobile</td>
							<td>(63) 917 893 5893</td>
						</tr>
						<tr>
							<td><i class="fa fa-envelope"></i> General Inquiries</td>
							<td><a href="mailto:hello@redlist.ph">hello@redlist.ph</a></td>
						</tr>
						<tr>
							<td><i class="fa fa-envelope"></i> Selling a Property</td>
							<td><a href="mailto:sellers@redlist.ph">sellers@redlist.ph</a></td>
						</tr>
						<tr>
							<td><i class="fa fa-envelope"></i> Brokers</td>
							<td><a href="mailto:brokers@redlist.ph">brokers@redlist.ph</a></td>
						</tr>
						<tr>
							<td><i class="fa fa-envelope"></i> Partnerships</td>
							<td><a href="mailto:partners@redlist.ph">partners@redlist.ph</a></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

