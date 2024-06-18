<?php namespace App\Controllers;


use CodeIgniter\API\ResponseTrait;
// use PayPalCheckoutSdk\Core\PayPalHttpClient;
// use PayPalCheckoutSdk\Core\SandboxEnvironment;
// use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;


class CrowdfundingController extends BaseController
{
    use ResponseTrait;

    function __construct() {
        require_once APPPATH . "/ThirdParty/paypal/vendor/autoload.php";
    }
    public function apiContext(){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
            'AU40khucwCrh9e3r4q8bCX_ebPd84QJgOdpQMhTWgMVqpMlZhrj67dxdmP4expi6olTf8CBV7UPNisbI',     // ClientID
            'EAswVbiOpWpqf-p9afjVSWh0QSWpaO0NB-TDNj5bBe3ShC_sxg6DBGu0diJ2j61hcEs8MPsKsorVibAQ'      // ClientSecret
        )
        );
        return $apiContext;
    }
    public function donate()
    {       
        // Prepare the donation details
        $donationAmount = $this->request->getVar('amount'); // Assuming 'amount' is the name of the input field
        $activityId = $this->request->getVar('activity');
        $userName = $this->request->getVar('username');
        
        // Get the activity name based on the activity ID
        
        $activityModel = new \App\Models\ActivityModel();
        $activity = $activityModel->find($activityId);
        $activityName = $activity['fld_name'];
        $activityID = $activity['fld_id'];

        $parentModel = new \App\Models\ParentModel();
        $loggedUserID = session()->get('loggedUser');
        $userInfo = $parentModel->find($loggedUserID);

        
        $crowdfundingModel = new \App\Models\CrowdfundingModel();

        // $data = [
        //     'fld_activity' => $activityName,
        //     'fld_aid' => $activityID,
        //     'fld_money' => $donationAmount,
        //     'fld_name' => $userName,
        //     'fld_pid' => $loggedUserID
        // ];

        // $crowdfundingModel->insert($data);  

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $amount = new Amount();
        $amount->setCurrency("MYR")->setTotal($donationAmount);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
        ->setDescription("Payment description")
        ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $success_url = site_url('donation/success?amount='.$donationAmount.'&activity='.$activityId.'&username='.$userName);
        $cancel_url = site_url('donation/cancel');
        $redirectUrls->setReturnUrl($success_url)
        ->setCancelUrl($cancel_url);

        $payment = new Payment();
        $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->apiContext());
            $approvalUrl = $payment->getApprovalLink();
            // echo '<pre>';print_r($approvalUrl);die;
            return redirect()->to($approvalUrl);
        } catch (\Exception $e) {
            // Handle any errors
            echo '<pre>';print_r($e);die;
            return $this->fail($e->getMessage());
        }
    }

    public function donationSuccess()
    {
        // Process the successful donation
        // You can add your own logic here to save the transaction details, send notifications, etc.
        if (isset($_GET['amount']) && isset($_GET['activity']) && isset($_GET['username'])) {
            $total_amount = $_GET['amount'];
            $activityId = $_GET['activity'];
            $userName = $_GET['username'];
            $paymentId = $_GET['paymentId'];
            $payment = Payment::get($paymentId, $this->apiContext());

            $execution = new PaymentExecution();
            $execution->setPayerId($_GET['PayerID']);

            $transaction = new Transaction();
            $amount = new Amount();
            $details = new Details();

        // $details->setShipping(2.2)
     //    ->setTax(1.3)
     //    ->setSubtotal(17.50);

            $amount->setCurrency('MYR');
            $amount->setTotal($total_amount);
        // $amount->setDetails($details);
            $transaction->setAmount($amount);

            $execution->addTransaction($transaction);
            try {
                $result = $payment->execute($execution, $this->apiContext());
                if($result->state == 'approved'){
                    

                 $total_amount = $_GET['amount'];
                $activityId = $_GET['activity'];
                $userName = $_GET['username'];

                $activityModel = new \App\Models\ActivityModel();
                $activity = $activityModel->find($activityId);
                $activityName = $activity['fld_name'];
                $activityID = $activity['fld_id'];

                $parentModel = new \App\Models\ParentModel();
                $loggedUserID = session()->get('loggedUser');
                $userInfo = $parentModel->find($loggedUserID);

                $crowdfundingModel = new \App\Models\CrowdfundingModel();

                $data = [
                    'fld_activity' => $activityName,
                    'fld_aid' => $activityID,
                    'fld_money' => $total_amount,
                    'fld_name' => $userName,
                    'fld_pid' => $loggedUserID
                ];

                $crowdfundingModel->insert($data);
                
                    return redirect()->to('user/crowdfunding')->with('success', 'Fund has been transacted successfully. Thank you.');
                    }else{
                    return redirect()->to('user/crowdfunding')->with('fail', 'There is something wrong with the transaction. Please try again. Thank you. ');
                    }
                
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
            // print_r("Payment", $payment->getId());die();

            // return $payment;
        } else {
           return "User Cancelled the Approval";
            exit;
        }
        // Return a success message to the user
        return "Thank you for your donation!";
    }

    public function donationCancel()
    {
        // Handle the case when the user cancels the donation process
        // You can add your own logic here to handle the cancellation

        // Return a cancellation message to the user
        //return "Donation cancelled!";
        return redirect()->to('user/crowdfunding')->with('fail', 'There is something wrong with the transaction. Please try again. Thank you. ');
    }

    public function donationCallback()
    {
    // Process the transaction callback from PayPal
        $paypal = service('paypalSandbox');

    // Get the order ID from the query parameters
        $orderId = $this->request->getGet('order_id');

        try {
        // Fetch the order details from PayPal
            $response = $paypal->execute(new OrdersGetRequest($orderId));

        // Extract the transaction details and update the donation status in your application
        // Placeholder code to retrieve transaction details and update donation status
            $transactionStatus = $response->result->status;

        // Redirect the user to the appropriate page based on the transaction status
            if ($transactionStatus === 'COMPLETED') {
                return redirect()->to('user/crowdfunding')->with('success', 'Fund has been transact successfully.');
            } else {
                return redirect()->to(route_to('donation.cancel'));
            }
        } catch (\Exception $e) {
        // Log the error message
            log_message('error', $e->getMessage());

        // Handle the error
            return redirect()->to(route_to('donation.error'));
        }
    }


}



