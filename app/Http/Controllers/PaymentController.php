<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    
    /**
     * Show available subscription plans.
     */
    public function show()
    {
        $plans = Plan::select(
            'name',
            'description',
            'stripe_product_id',
            'stripe_price_id',
            'price',
            'currency',
            'billing_interval',
            'streams',
            'downloads',
            'quality',
            'resolution',
            'devices'
        )->get();

        // Define gradient colors
        $colors = [
            'linear-gradient(135deg, #3b82f6 0%, #6366f1 100%)',
            'linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%)',
            'linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%)',
            'linear-gradient(135deg, #ec4899 0%, #dc2626 100%)',
        ];

        return view('subscription.subscription', compact('plans', 'colors'));
    }

    /**
     * Handle plan selection and redirect to payment page.
     */
    public function selectPlan(Request $request)
    {

        $user = Auth::user();

        // Redirect admin immediately
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $request->validate([
            'price_id' => 'required|string',
        ]);

        $plan = Plan::where('stripe_price_id', $request->price_id)->firstOrFail();

        return view('payment', [
            'price_id' => $plan->stripe_price_id,
            'amount' => $plan->price,
            'interval' => $plan->billing_interval,
            'plan_name' => $plan->name,
        ]);
    }

    /**
     * Show payment page for a specific plan.
     */
    public function showPayment($priceId)
    {
        $user = Auth::user();
        // Redirect admin immediately
        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        $plan = Plan::where('stripe_price_id', $priceId)->firstOrFail();

        return view('subscription.payment', [
            'price_id' => $plan->stripe_price_id,
            'amount' => $plan->price,
            'interval' => $plan->billing_interval,
            'plan_name' => $plan->name,
        ]);
    }

    /**
     * Process subscription payment and create Stripe subscription.
     */
    public function subscribe(Request $request)
    {
        $result = $this->paymentService->createSubscription($request, Auth::user());
        
        if (isset($result['error'])) {
            return response()->json(['error' => $result['error']], 422);
        }

        return response()->json($result);
    }
}
