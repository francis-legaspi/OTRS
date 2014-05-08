<?php
	// File name Constant
	define("FILENAME", "Performance_");
	define("CUSTOMER", "Customer");
	
	// Global variables
	$length;
	$customer_number;
	$transact_number = NULL;
	
	function open_file($year, $month) {
		$lines = array();
		$path = '/var/www/html/report/' .  $year . '/' . FILENAME . $month . '.log';
	
		// Test file and Open file before injecting to array
		if ( ($fh = fopen($path, "r")) ) {
			//Read file into array
                  	while (!feof($fh)) {
                          	$lines[] = fgets($fh);
                  	}
		} else {
			echo 'Error Reading file';
		}		
		
		// Closing a file
		fclose($fh);
		return $lines;
	}

	function parse_customer($lines) {
		$customers = array();
		foreach ($lines as $line) {
			$data = explode("::", $line);
                        if (count($data) < 4) {
				continue;
			}
			if ($data[1] == CUSTOMER) {
				$username = $data[3];
				$customers[$username] = isset($customers[$username]) ? $customers[$username] : array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
				$customers[$username][0]++;
			}		
		}
		return $customers;	
	}

	function calculate_transact_number() {
		global $content;
		global $customer_username;
		global $length;
		global $customer_number;
		global $transact_number;	
		
		$customer_number = count($customer_username);
		for ($i = 0; $i < $customer_number; $i++) {
			for ($x = 0; $x < $length; $x++) {
				$username = explode("::", $content[$x])['3'];
				if ($customer_username[i] == $username) {
					$transact_number += 1;
				}
			}	
		}

		echo $transact_number;
		
	}
	
	$year = '2013';# empty($_POST['ddl_year']) ? null : $_POST['ddl_year'];
	$month = '04';# empty($_POST['ddl_month']) ? null : $_POST['ddl_month'];
	
	$lines = open_file($year, $month);
	$customers = parse_customer($lines);

	print_r($customers);
?>
