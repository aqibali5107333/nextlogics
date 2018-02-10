<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        // stripe ID is already stored in users table
        $charge = $user->charge(9000);
        dd($charge);
        return view("stripe");
    }

    public function store(Request $request) {
        $stripeToken = $request->get('stripe_token');
        $plan = 'plan_CIbXJuY7x1yJfN';
        $user = User::find(1);
        $user->newSubscription('main', $plan)->create($stripeToken);
    }
}
