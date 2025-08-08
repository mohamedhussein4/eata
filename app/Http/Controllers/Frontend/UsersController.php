<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('frontend.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // حذف الصورة القديمة
            if ($user->avatar) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
            }
            
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = 'storage/' . $avatarPath;
        }

        $user->update($validated);

        return redirect()->route('users.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }

    public function changePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->update([
            'password' => Hash::make($validated['new_password'])
        ]);

        return redirect()->route('users.profile')->with('success', 'تم تغيير كلمة المرور بنجاح');
    }

    public function deleteAccount(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->withErrors(['password' => 'كلمة المرور غير صحيحة']);
        }

        // حذف الملف الشخصي
        if ($user->avatar) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $user->avatar));
        }

        $user->delete();

        Auth::logout();

        return redirect()->route('home')->with('success', 'تم حذف الحساب بنجاح');
    }

    public function getDonationHistory()
    {
        $user = Auth::user();
        
        $donations = $user->donations()->with('project')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('frontend.users.donation-history', compact('donations'));
    }

    public function getVolunteerHistory()
    {
        $user = Auth::user();
        
        $volunteerActivities = $user->volunteerActivities()->orderBy('created_at', 'desc')->paginate(10);
        
        return view('frontend.users.volunteer-history', compact('volunteerActivities'));
    }
} 