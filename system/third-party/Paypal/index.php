<?php 
	
	include("../../init.php");
	
	$_POST = $db->getSession('_post_payment_process');
	
	extract($_POST);
	
	$payment_method = $db->getRow("SELECT * FROM ec_configuration_payment_methods WHERE cd_ec_configuration_payment_method = '".$cd_ec_configuration_payment_method."'");
	
	if ($payment_method['designation'] == "paypal")
	{

		/* settings */
		$account_data = array();
		$account_data['username'] = $config['paypal_username']; 
		$account_data['password'] = $config['paypal_password'];
		$account_data['signature'] = $config['paypal_signature'];
		$account_data['test_mode'] = $config['paypal_test_mode'];
		$account_data['success_page'] = $helper->getDir()."/payments/success";
		$account_data['cancel_page'] = $helper->getDir()."/payments/error";

		$config = $db->getRecord("SELECT * FROM payments_config");

		include("PaypalExpressCheckout.php");

		$gateway = new PaypalGateway();
		$gateway->apiUsername = $account_data['username'];
		$gateway->apiPassword = $account_data['password'];
		$gateway->apiSignature = $account_data['signature'];
		$gateway->testMode = (($account_data['test_mode']) ? true : false);

		$gateway->returnUrl = $account_data['success_page'];
		$gateway->cancelUrl = $account_data['cancel_page'];

		$paypal = new PaypalExpressCheckout($gateway);
		$payment = $paypal->doPayment($_GET['token'], $_GET['PayerID'], $final);

		
		if ($payment && $final['ACK'] == 'SUCCESS')
		{
	
			foreach ($final as $key => $value)
			{
				if (reset(explode("_", $key)) == "PAYMENTINFO")
				{
					unset($final[$key]);
				}
			}

		}


		
		/* Se houver uma mensagem de sucesso por parte do PayPal */
		if ($final['ACK'] == "SUCCESS")
		{			
			/* Guardar todos os dados do PayPal numa variável de sessão para utilização posterior */
			$db->setSession('_post_payment_process_paypal', $final);
			
			/* Redireccionamento final para a página de sucesso */
			echo "<script>window.location = '../final.php'</script>";
		}
		
		/* Se houver erro */
		else
		{
			/* Redireccionamento final para a página de erro */
			echo "<script>window.location = '../error.php'</script>";
		}
		
	}

?>