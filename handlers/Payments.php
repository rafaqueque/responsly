<?php 

  class Payments
  {

    function __construct()
    {
			/* paypal init */
			require_once(ROOT."/system/third-party/Paypal/PaypalExpressCheckout.php");
    }


    function post($action=null, $id=null)
    {
    	$db = new DatabaseUtils();
    	$helper = new Helpers();
    	$session = new Sessions();

    	if ($action == "init")
    	{
    		$user = $db->getRecord("SELECT * FROM users WHERE id = ".$session->get("id_user"));
    		$plan = $db->getRecord("SELECT * FROM plans WHERE id = ".$_POST['id_plan']);
				$config = $db->getRecord("SELECT * FROM payments_config");

        if ($user['id_plan'] == $_POST['id_plan'])
        {
          $helper->redirect($helper->getLink("change_plan",array("error"=>1,"alreadychanged"=>1)));
          die();
        }

				/* create payment record */
				$data = array();
				$data['reference'] = $_POST['reference'];
				$data['id_plan'] = $_POST['id_plan'];
				$data['id_user'] = $user['id'];
				$data['price'] = $_POST['price'];
				$data['paid'] = 0;
				$id_payment = $db->insert("payments", $data);

				$session->set("id_payment", $id_payment);

				/* settings */
				$account_data = array();
				$account_data['username'] = $config['paypal_username']; 
				$account_data['password'] = $config['paypal_password'];
				$account_data['signature'] = $config['paypal_signature'];
				$account_data['test_mode'] = $config['paypal_test_mode'];
				$account_data['success_page'] = $helper->getDir()."/payment/final";
				$account_data['cancel_page'] = $helper->getDir()."/payment/result";


				$gateway = new PaypalGateway();
				$gateway->apiUsername = $account_data['username'];
				$gateway->apiPassword = $account_data['password'];
				$gateway->apiSignature = $account_data['signature'];
				$gateway->testMode = (($account_data['test_mode']) ? true : false);

				$gateway->returnUrl = $account_data['success_page'];
				$gateway->cancelUrl = $account_data['cancel_page'];

				$paypal = new PaypalExpressCheckout($gateway);
				$expresscheckout = $paypal->doExpressCheckout($data['price'], 'Responsly Plan: '.$plan['designation'].' / ID: '.$id_payment.' / Reference: '.$data['reference'], '', 'USD');

				if (!$expresscheckout)
				{
					$helper->redirect($account_data['cancel_page'],array("system_error"=>1));
				}
    	}
    }


    function get($action=null, $id=null)
    {

    	if ($action == "final")
    	{
	     	$db = new DatabaseUtils();
	    	$helper = new Helpers();
	    	$session = new Sessions();

	    	$user = $db->getRecord("SELECT * FROM users WHERE id = ".$session->get("id_user"));
    		$config = $db->getRecord("SELECT * FROM payments_config");
				$payment_record = $db->getRecord("SELECT * FROM payments WHERE id = ".$session->get("id_payment"));

				/* settings */
				$account_data = array();
				$account_data['username'] = $config['paypal_username']; 
				$account_data['password'] = $config['paypal_password'];
				$account_data['signature'] = $config['paypal_signature'];
				$account_data['test_mode'] = $config['paypal_test_mode'];
				$account_data['success_page'] = $helper->getDir()."/payment/final";
				$account_data['cancel_page'] = $helper->getDir()."/payment/result";

				$gateway = new PaypalGateway();
				$gateway->apiUsername = $account_data['username'];
				$gateway->apiPassword = $account_data['password'];
				$gateway->apiSignature = $account_data['signature'];
				$gateway->testMode = (($account_data['test_mode']) ? true : false);

				$gateway->returnUrl = $account_data['success_page'];
				$gateway->cancelUrl = $account_data['cancel_page'];

				$paypal = new PaypalExpressCheckout($gateway);
				$payment = $paypal->doPayment($_GET['token'], $_GET['PayerID'], $paypal_response);

				$db->update("payments", "id", $payment_record['id'], array("paypal_response" => json_encode($paypal_response),
																																		"paid" => (($paypal_response['ACK'] == "SUCCESS") ? 1 : 0),
																																		"date" => date("Y-m-d H:i:s")));

				if ($paypal_response['ACK'] == "SUCCESS")
				{
	        $new_date = new DateTime($user['plan_valid_until']);
	        $new_date->modify("+1 year");

	        $result = $db->update("users", "id", $user['id'], array("id_plan" => $payment_record['id_plan'],
	        																												"plan_valid_until" => $new_date->format("Y-m-d")));
	        if ($result)
	        {
	          $helper->redirect($helper->getLink("change_plan",array("success"=>1,"changed"=>1)));
	        }
	        else
	        {
	          $helper->redirect($helper->getLink("change_plan",array("error"=>1)));
	        }
				}
				else
				{
					$helper->redirect($helper->getLink("payment/result",array("error"=>1)));
				}
    	}


    	if ($action == "result")
    	{
    		require_once(ROOT."/public/payment_process.php");
    	}
    }
  }

?>