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

    public function profiles()
    {
        $profiles = auth()->user()->profiles;
        return view('account.pages.profiles', compact('profiles'));
    }

    protected function getSubscriptionData($user)
    {
        $subscription = $user->subscriptions()
            ->where('stripe_status', 'active')  // or 'status'
            ->latest()
            ->first();

        $planName = 'No Plan';
        $startsAt = null;
        $endsAt = null;

        if ($subscription) {
            $plan = Plan::find($subscription->plan_id);
            $planName = $plan->name ?? 'Unknown Plan';
            $startsAt = $subscription->created_at;
            $endsAt = $subscription->expires_at ?? null;
        }

        return compact('subscription', 'planName', 'startsAt', 'endsAt');
    }
}
