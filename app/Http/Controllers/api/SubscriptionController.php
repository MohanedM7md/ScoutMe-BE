<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Laravel\Cashier\Cashier;

class SubscriptionController extends Controller
{
    public function getPlans()
    {
        return response()->json(SubscriptionPlan::active()->get());
    }

    public function subscribe(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:subscription_plans,id',
            'payment_method' => 'required|string',
            'period' => 'required|in:monthly,annual'
        ]);

        $user = $request->user();
        $plan = SubscriptionPlan::find($validated['plan_id']);

        // Create subscription
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($validated['payment_method']);

        $priceId = $validated['period'] === 'monthly'
            ? $plan->stripe_monthly_price_id
            : $plan->stripe_annual_price_id;

        $subscription = $user->newSubscription('default', $priceId)->create();

        return response()->json([
            'status' => 'subscribed',
            'subscription' => $subscription
        ]);
    }

    public function getStatus(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'subscription' => $user->subscription('default'),
            'payment_methods' => $user->paymentMethods()
        ]);
    }

    public function cancel(Request $request)
    {
        $request->user()->subscription('default')->cancel();
        return response()->json(['message' => 'Subscription cancelled']);
    }
}
