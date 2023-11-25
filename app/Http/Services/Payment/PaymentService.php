<?php

namespace App\Http\Services\Payment;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class PaymentService {

    private $valueListForTop = ["first_name", "nid"];

    public function __construct(private Payment $payment)
    {

    }

    public function getPaymentData()
    {
        $payment = $this->payment;
        $userId = getUserInfo()->hasRole("superadmin") ? null : getUserInfo()->id;
        return $payment->getPayments($userId) ?? [];
    }

    /**
     * @param mixed $data
     *
     * @return [type]
     */
    public function storePaymentInfo($data)
    {
        try {
            $payment = $this->payment;
            $userId = getUserInfo()->id;
            if($data['image_path']){
                $dirName = storeOrUpdateImage("storage/img/payment/$userId/", $data['image_path'], "payment", false);
                $data['image_path'] = $dirName;
            } else {
                unset($data['image_path']);
            }
            if($payment->createNewPaymentRequest($data)) {
                return [Response::HTTP_OK, "Payment Request Updated Successfully. Admin will review and confirm your payment record soon."];
            }
        } catch (\Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage()];
        }

    }
    /**
     * @param mixed $data
     *
     * @return [type]
     */
    public function updatePaymentInfo($data, $userId)
    {
        try {
            $payment = $this->payment;
            if($data['image_path']){
                $dirName = storeOrUpdateImage("storage/img/payment/$userId/", $data['image_path'], "payment", false);
                $data['image_path'] = $dirName;
            } else {
                unset($data['image_path']);
            }
            if(in_array($payment->getSinglePaymentByParam('user_id', $userId)->status, ["approved", "declined"])) {
                return [Response::HTTP_BAD_REQUEST, "Payment is already ".$payment->getSinglePaymentByParam('user_id', $userId)->status."! You can't update it"];
            }
            if($payment->updatePaymentRequest($data ,"user_id", $userId)) {
                return [Response::HTTP_OK, "Payment Request Placed Successfully. Admin will review and confirm your payment status soon."];
            }
        } catch (\Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage()];
        }

    }
    /**
     * @param mixed $data
     *
     * @return [type]
     */
    public function updatePaymentStatus($data, $id)
    {
        try {
            $payment = $this->payment;
            if($payment->updatePaymentRequest($data ,"id", $id)) {
                return [Response::HTTP_OK, "Payment status updated successfully"];
            }
        } catch (\Exception $e) {
            return [Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage()];
        }

    }

}
