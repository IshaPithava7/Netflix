<?php

namespace App\Services;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class PaymentService
{
    public function createSubscription(Request $request, User $user)
    {
        if ($user->is_admin) {
            return [
                'success' => true,
                'message' => 'Admin users do not need a subscription.',
                'redirect' => route('admin.dashboard'),
            ];
        }

        $plan = Plan::where('stripe_price_id', $request->plan)->firstOrFail();

        try {
            if (!$user->hasStripeId()) {
                $user->createAsStripeCustomer();
            }

            $user->updateDefaultPaymentMethod($request->payment_method);

            if ($user->subscribed('default')) {
                $user->subscription('default')->swap($plan->stripe_price_id);
                return [
                    'success' => true,
                    'message' => 'Plan updated successfully!',
                    'redirect' => route('home')
                ];
            }

            $user->newSubscription('default', $plan->stripe_price_id)
                ->create($request->payment_method, [
                    'email' => $user->email,
                ]);

            return [
                'success' => true,
                'message' => 'Subscription successful!',
                'redirect' => route('home')
            ];
        } catch (IncompletePayment $exception) {
            return [
                'requires_action' => true,
                'payment_intent_client_secret' => $exception->payment->client_secret
            ];
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage()
            ];
        }
    }
}
