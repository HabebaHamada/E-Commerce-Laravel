<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('Profile', compact('user'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();

        if(isset($data['profile_picture'])) {
            if ($user->profile_picture) {
                Storage::disk('public')->delete($user->profile_picture);
            }
            $photoPath = $data['profile_picture']->store('profile_pictures', 'public');
            $data['profile_picture'] = $photoPath;
        }

        $user->update($data);

        unset($data['profile_picture']);

    return back()->with('success', 'Profile updated successfully!');
    }
}