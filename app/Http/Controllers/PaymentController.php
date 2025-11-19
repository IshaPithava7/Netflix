<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
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
        return view('subscription.subscription', compact('plans'));
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
        $user = Auth::user();

        // Skip payment for admins
        if ($user->is_admin) {
            return response()->json([
                'success' => true,
                'message' => 'Admin users do not need a subscription.',
                'redirect' => route('admin.dashboard'), // Admin dashboard route
            ]);
        }

        $request->validate([
            'payment_method' => 'required|string',
            'plan' => 'required|string',
        ]);


        try {
            $plan = Plan::where('stripe_price_id', $request->plan)->firstOrFail();

            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($request->payment_method);

            $user->newSubscription('default', $plan->stripe_price_id)
                ->create($request->payment_method, [
                    'email' => $user->email,
                ]);

            return response()->json([
                'success' => true,
                'message' => 'Subscription successful!',
                'redirect' => route('home')
            ]);

        } catch (IncompletePayment $exception) {
            return response()->json([
                'requires_action' => true,
                'payment_intent_client_secret' => $exception->payment->client_secret
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }


    /**
     * Confirm successful subscription/payment.
     */
    public function confirmPayment(Request $request)
    {
        $user = Auth::user();

        if ($user->subscribed('default')) {
            return redirect()->route('home')->with('success', 'Payment successful! Your subscription is active.');
        }

        return redirect()->route('subscription')->with('error', 'Payment confirmation failed. Please try again.');
    }


    /**
     * Cancel the user's subscription.
     */
    public function cancelSubscription()
    {
        $user = auth()->user();

        $subscription = $user->subscription('default');

        if (!$subscription || !$subscription->active()) {
            return redirect()->back()->with('error', 'No active subscription to cancel.');
        }

        try {
            // Cancel immediately at Stripe and in DB
            $subscription->cancel();

            return redirect()->back()->with('success', 'Your subscription has been canceled successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel subscription: ' . $e->getMessage());
        }
    }


}
