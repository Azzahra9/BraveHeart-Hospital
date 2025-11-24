<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();
        
        // 2. Handle File Upload (Fitur Tambahan Foto)
        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['image', 'max:2048', 'mimes:jpeg,png,jpg,gif'], // Validasi file
            ]);

            // Hapus foto lama jika ada
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru ke storage/app/public/profile-photos
            $path = $request->file('photo')->store('profile-photos', 'public');
            
            // Simpan path ke database
            // PENTING: Kita simpan ke kolom 'profile_photo_path' yang baru kita buat di migrasi
            $validatedData['profile_photo_path'] = $path;
            
            // HAPUS baris ini karena kolom profile_photo_url tidak ada di database
            // $user->profile_photo_url = Storage::url($path); 
        }
        
        // 3. Update data Name & Email
        $user->fill($validatedData);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}