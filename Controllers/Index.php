<?php

namespace Controllers;

use Core\BaseController;
use Models\Bkash;
use Models\Nagad;

class Index extends BaseController
{
    protected string $Model = "Index";

    // home page controller
    public function home()
    {
        if (isset($_POST['bkash_paynow'])) {
            $bkash = new Bkash();
            $amount = 3;
            $invoice = "INV-" . time();
            $phone = "01929918378";
            $Payment = $bkash->createPayment($amount, $invoice, $phone);
            if ($Payment['success'] === false) {
                showResponse($Payment);
            }

            // echo '<br><br><a href="' . $Payment['data']['bkashURL'] . '">Go Payment</a>';
            header("Location: " . $Payment['data']['bkashURL']);
            exit;
        }

        if (isset($_POST['nagad_paynow'])) {
            $nagad = new Nagad();
            $amount = 3;
            $invoice = "INV" . time();
            $Payment = $nagad->createPayment($amount, $invoice);
            if ($Payment['success'] === false) {
                showResponse($Payment);
            }

            // echo '<br><br><a href="' . $Payment['data']['callBackUrl'] . '">Go Payment</a>';
            header("Location: " . $Payment['data']['callBackUrl']);
            exit;
        }

        view('home/index');
    }

    // bkash page controller
    public function bkash()
    {
        if (!isset($_GET['paymentID']) && (!isset($_GET['status']) || $_GET['status'] !== 'success')) {
            redirect("/bkash/failed");
        }

        $bkash = new Bkash();
        $Payment = $bkash->executePayment($_GET['paymentID']);
        showResponse($Payment);

        view('bkash/index');
    }

    // nagad page controller
    public function nagad()
    {
        if (!isset($_GET['payment_ref_id']) && (!isset($_GET['status']) || $_GET['status'] !== 'Success')) {
            redirect("/nagad/failed");
        }

        $nagad = new Nagad();
        $Payment = $nagad->verifyPayment($_GET['payment_ref_id']);
        showResponse($Payment);

        view('nagad/index');
    }
}
