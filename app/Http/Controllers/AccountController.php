<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class AccountController extends Controller
{
    
    public function membership()
    {
        $data = $this->getSubscriptionData(auth()->user());

        return view('account.pages.membership', $data);
    }

    public function overview()
    {
        $data = $this->getSubscriptionData(auth()->user());

        return view('account.pages.overview', $data);
    }

    protected function getSubscriptionData($user)
    {
        $subscription = $user->subscription('default');

        $planName = 'No Plan';
        $startsAt = null;
        $endsAt = null;

        if ($subscription) {
            $plan = Plan::where('stripe_price_id', $subscription->stripe_price)->first();

            $planName = $plan->name ?? 'Unknown Plan';
            $startsAt = $subscription->created_at;
            $endsAt = $subscription->ends_at;
        }

        return compact('subscription', 'planName', 'startsAt', 'endsAt');
    }
}
