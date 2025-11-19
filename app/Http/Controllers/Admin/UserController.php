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
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
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
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
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

            return redirect()
                ->route('admin.users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {

            return back()->with('error', 'Failed to delete user: ' . $e->getMessage());
        }
    }


    public function restore($id)
    {
        User::onlyTrashed()->where('id', $id)->restore();

        return back()->with('success', 'User restored successfully.');
    }


}
