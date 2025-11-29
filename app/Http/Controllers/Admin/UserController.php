<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $userRequest)
    {
        $validateData = $userRequest->validated();

        $user = User::create($validateData);

        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user
        ], 201);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UserRequest $userRequest, User $user)
    {
        $validateData = $userRequest->validated();

        $user->update($validateData);

        if ($user->hasStripeId()) {
            $user->updateStripeCustomer([
                'name' => $user->name,
                'email' => $user->email,
            ]);
        }
        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user
        ]);
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return response()->json(['message' => 'You cannot delete your own account.'], 403);
        }

        try {
            if ($user->stripe_id) {
                foreach ($user->subscriptions as $subscription) {
                    if ($subscription->active()) {
                        $subscription->cancel();
                    }
                }
                $stripeCustomer = $user->asStripeCustomer();
                if ($stripeCustomer) {
                    $stripeCustomer->delete();  
                }
            }

            $user->delete();

            return response()->json(['message' => 'User deleted successfully.']);

        } catch (\Exception $e) {

            return response()->json(['message' => 'Failed to delete user: ' . $e->getMessage()], 500);
        }
    }


    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();

        return back()->with('success', 'User restored successfully.');
    }


}
