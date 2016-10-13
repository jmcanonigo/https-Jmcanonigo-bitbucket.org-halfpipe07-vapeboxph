<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct() {
		parent::__construct();
		$this->load->model('testers_model');
		$this->load->model('participants_model');
		$this->load->model('settings_model');
		$this->load->database();
	}

	public function send_mail($email, $subject, $msg_body)
	{

		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		" . $msg_body . "
		</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: VapeBox PH <vapeboxph@gmail.com>' . "\r\n";

		if( mail($email,$subject,$message,$headers)) {
			echo "success!";
		}

	}

	private function reformat_number($number) {
		$trimmedWhite = str_replace(" ", "", trim($number));
		$trimmed = str_replace("-", "", $trimmedWhite);
		
		$pattern = "/\d{10}(?!.*\d)/";
		preg_match($pattern, $trimmed, $match);
		
		if(strlen($match[0]) == 10) {
			return "63" . $match[0];
		} else {
			return "639175378250";
		}
	}

	private function send_semaphore($number, $msg) {
		$ApiKey = "JM4SzrdEnoMp6VsyiF1x";
		$BaseUrl = "http://api.semaphore.co/api/sms";
		
		$params = "api=" . $ApiKey . "&number=" . $number ."&message=" . $msg;
		
		$ch = curl_init($BaseUrl);

		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);
		curl_close($ch);

		echo "sent sms to " . $number . "\n";
	}

	private function concatMsgSemaphoreLong($number, $msg) {
		if(mb_strlen($msg) > 400) {
			$msgArray = $this->tokenTruncate($msg, 380);
			
			$msgArrayCount = count($msgArray);

			for($k=0; $k < $msgArrayCount; $k++) {
				$this->send_semaphore($number, $msgArray[$k]);
			}

		} else {
			$this->send_semaphore($number, $msg);
		}
	}

	public function return_not_claimed() {
		//foreach database
		$data = $this->participants_model->get_participants_by_status('return');
		$count = 0;

		foreach($data as $participant) {
			$count++;
			$part_id = $participant["id"];

			$data = $this->participants_model->update_participants_tf($part_id, '', '', '', '', 0);
			$data = $this->participants_model->update_participants($part_id, 0);
			$this->testers_model->inventory($part_id, 'add');
		}

		echo "Successfully returned " . $count . " to the inventory.";
	}

	public function get_typeform()
	{
		$last_tf_update = $this->settings_model->get_value_by_key('last_tf_update');

		$typeform_UID = "hcWggZ";
		$typeform_API = "703cbdbe6e09b7b01230245f0e21e84c912a8b56";
		$typeform_URL = "https://api.typeform.com/v1/form/" . $typeform_UID . "?key=" . $typeform_API . "&completed=true&since=" . $last_tf_update;

		$context = stream_context_create(array('http' => array('header'=>'Connection: close\r\n')));
		$dataFromTF = file_get_contents($typeform_URL, true, $context);
		$decode = json_decode($dataFromTF, true);

		print_r($decode['responses']);

		$msg_sms = '';
		$msg_payments = '';
		$msg_email = '';

		foreach($decode['responses'] as $response) {
			$part_id = $response['hidden']['part'];
			$address = $response['answers']['textfield_33553317'];
			$claim = $response['answers']['listimage_32586349_choice'];
			$plan = isset($response['answers']['list_32587968_choice']) ? $response['answers']['list_32587968_choice'] : "";
			$payment = isset($response['answers']['listimage_32583009_choice']) ? $response['answers']['listimage_32583009_choice'] : "";
			$cost = isset($response['answers']['score']) ? $response['answers']['score'] : 0;

			$data = $this->participants_model->update_participants_tf($part_id, $address, $claim, $plan, $payment, $cost);

			switch($payment) {
				case 'BPI Bank Deposit':
					$msg_payments = "our BPI acct:" . "\n" . "Rachelle Ivane Tan Uy" . "\n" . "Savings" . "\n" . "0019-3258-06";
					break;
				case 'LBC':
					$msg_payments = "LBC:" . "\n" . "Name: Ruben Damiar" . "\n" . "Area: Tondo Manila";
					break;
				case 'PayPal':
					$msg_payments = "our Paypal acct:" . "\n" . "vapeboxph@gmail.com";
					break;
				case 'GCash':
					$msg_payments = "our GCash acct:" . "\n" . "Rachelle Uy" . "\n" . "09175378250" . "\n" . "Pasig City";
					break;
				default:
					$msg_payments = "our BDO acct:" . "\n" . "Rachelle Ivane Tan Uy" . "\n" . "Savings" . "\n" . "006960048981";
					break;
			}

			if(!!$data == TRUE) {
				switch ($claim) {
					case 'Just Pay For Shipping (Php 50 - 100)':
						$msg_sms = 'VapeBoxPH: Hi ' . $data['fname'] . '! Congrats on your free juice! Just pay P' . $cost . ' to ' . $msg_payments;
						$msg_sms .= "\n\n" . "Cutoff for shipping out is 1pm. ETA will depend on the speed of the courier. Pls text 09260363575 with your ID #" . $part_id . ", sender's name, amt, ref. no. after payment.";

						$msg_email = '<p>Hi ' . $data['fname'] . '!</p>';
						$msg_email .= "<br><br>";
						$msg_email = "<p>Congrats on your free juice! Thank you for joining our VapeBox PH Giveaway. There's one more step to the process, which is shipping your juice to you!</p>";
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Please settle a total amount of " . $cost . ' to ' . $msg_payments . '</p>';
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Cutoff for shipping out is 1pm. ETA will depend on the speed of the courier. Pls text 09260363575 with your ID #" . $part_id . ", sender's name, amt, ref. no. after payment.</p>";
						break;
					case 'Pick Up from Our Office in Greenhills':
						$msg_sms = 'VapeBoxPH: Hi ' . $data['fname'] . '! Congrats on your free juice! Here\'s the pick up address:';
						$msg_sms .= "\n\n" . "Unit 311, Sunrise Condo, 226 Ortigas Ave., San Juan City";
						$msg_sms .= "\n\n" . "We're open from 10AM - 7PM";

						$msg_email = '<p>Hi ' . $data['fname'] . '!</p><br><br>';
						$msg_email = "<p>Thank you for joining our VapeBox PH Giveaway. There's one more step to the process, which is claiming your juice!</p>";
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Here's our address:</p>";
						$msg_email .= "<br><br><p>Unit 311, Sunrise Condo, 226 Ortigas Ave., San Juan City</p>";
						$msg_email .= "<br><br><p>We're open from 10AM - 7PM. Don't forget your ID# " . $part_id . "</p>";
						break;
					default:
						$msg_sms = 'VapeBoxPH: Hi ' . $data['fname'] . '! Congrats on your free juice! Just pay P' . $cost . ' to ' . $msg_payments;
						$msg_sms .= "\n" . "And we'll ship it together with your box!";
						$msg_sms .= "\n\n" . "Cutoff for shipping out is 1pm. ETA will depend on the speed of the courier. Pls text 09260363575 with your ID #" . $part_id . ", sender's name, amt, ref. no. after payment.";

						$msg_email = '<p>Hi ' . $data['fname'] . '!</p>';
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Congrats on your free juice! Thank you for joining our VapeBox PH Giveaway and availing a VapeBox Subscription!</p>";
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Please settle a total amount of " . $cost . ' to ' . $msg_payments . "</p>";
						$msg_email .= "<br><br>";
						$msg_email .= "<p>Cutoff for shipping out is 1pm. ETA will depend on the speed of the courier. Pls text 09260363575 with your ID #" . $part_id . ", sender's name, amt, ref. no. after payment.</p>";
						break;
				}

				//send SMS
				$this->concatMsgSemaphoreLong($this->reformat_number($data['mobile']), $msg_sms);

				//send Email
				$msg_email .= "\n\n";
				$msg_email .= "Also don't forget, if you want to win more premium juices, just keep on referring! For ever 5 friends, you get an extra tester. By the end of the promo, we'll let you know how many you have collected, then we'll ship these testers to you for free!";
				$msg_email .= "\n\n";
				$msg_email .= "\n" . "Just copy and paste your link below:";
				$msg_email .= "\n" . "http://www.vapebox.ph/wheel-of-juices-giveaway?ref_id=" . $part_id;
				$msg_email .= "\n\n" . "Spread the word about VapeBox!";
				
				$this->send_mail($data['email'], 'VapeBox PH Giveaway: Your Final Step!', $msg_email);
			}
		}

		//update timestamp now
		$last_tf_update = $this->settings_model->update_settings_by_key('last_tf_update', time());

	}
}
