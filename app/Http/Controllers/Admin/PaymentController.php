<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Services\Payment\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function view(PaymentService $paymentService)
    {
        $data['title'] = "Payment";
        $data['payments'] = $paymentService->getPaymentData();
        return view("admin.payment.index", $data);
    }

    public function store(PaymentStoreRequest $request,PaymentService $paymentService)
    {
        $data['user_id'] = getUserInfo()->id;
        $data['payment_channel'] = $request->payment_channel;
        $data['amount'] = $request->amount;
        $data['trans_id'] = $request->trans_id;
        $data['image_path'] = $request->payment_image ?? null;
        $data['ip'] = $request->ip();
        [$status, $message] = $paymentService->storePaymentInfo($data);
        Session::put(($status == Response::HTTP_OK) ? "success" : "error", $message);
        return redirect()->route('admin.payment');
    }

    public function update($userId, PaymentStoreRequest $request,PaymentService $paymentService)
    {
        $data['payment_channel'] = $request->payment_channel;
        $data['amount'] = $request->amount;
        $data['trans_id'] = $request->trans_id;
        $data['image_path'] = $request->payment_image ?? null;
        $data['ip'] = $request->ip();
        [$status, $message] = $paymentService->updatePaymentInfo($data, $userId);
        Session::put(($status == Response::HTTP_OK) ? "success" : "error", $message);
        return redirect()->route('admin.payment');
    }

    public function updateStatus($id, $status, PaymentService $paymentService)
    {
        $data['status'] = $status;
        [$status, $message] = $paymentService->updatePaymentStatus($data, $id);
        Session::put(($status == Response::HTTP_OK) ? "success" : "error", $message);
        return redirect()->route('admin.payment');
    }
}
