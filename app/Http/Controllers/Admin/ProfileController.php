<?php
 
 namespace App\Http\Controllers\Admin;
 
 use App\Http\Controllers\Controller;
 use App\Models\User;
 use App\Models\ActivityLog;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Hash;
 use Illuminate\Support\Facades\Storage;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Validation\Rule;
 
 class ProfileController extends Controller
 {
     /**
      * Show the user profile (usually handled via modal in layout).
      */
     public function index()
     {
         return response()->json(Auth::user());
     }
 
     /**
      * Update the authenticated user's profile.
      */
     public function update(Request $request)
     {
         $user = Auth::user();
 
         $validator = Validator::make($request->all(), [
             'full_name' => 'required|string|max:255',
             'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
             'phone' => 'nullable|string|max:20',
             'address' => 'nullable|string|max:500',
             'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors()
             ], 422);
         }
 
         $data = $request->only(['full_name', 'email', 'phone', 'address']);
 
         if ($request->hasFile('avatar')) {
             // Delete old avatar if exists
             if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                 Storage::disk('public')->delete($user->avatar);
             }
 
             $path = $request->file('avatar')->store('avatars', 'public');
             $data['avatar'] = $path;
         }
 
         $user->update($data);
 
         ActivityLog::create([
             'user_id' => $user->id,
             'action' => 'update_profile',
             'description' => 'Updated personal profile information',
             'ip_address' => $request->ip()
         ]);
 
         return response()->json([
             'success' => true,
             'message' => 'Profile updated successfully!',
             'user' => [
                 'full_name' => $user->full_name,
                 'email' => $user->email,
                 'avatar_url' => $user->avatar_url,
                 'role' => $user->role_label
             ]
         ]);
     }
 
     /**
      * Update the authenticated user's password.
      */
     public function updatePassword(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'current_password' => 'required|current_password',
             'new_password' => 'required|string|min:8|confirmed',
         ]);
 
         if ($validator->fails()) {
             return response()->json([
                 'success' => false,
                 'errors' => $validator->errors()
             ], 422);
         }
 
         $user = Auth::user();
         $user->update([
             'password' => Hash::make($request->new_password)
         ]);
 
         ActivityLog::create([
             'user_id' => $user->id,
             'action' => 'update_password',
             'description' => 'Changed account password',
             'ip_address' => $request->ip()
         ]);
 
         return response()->json([
             'success' => true,
             'message' => 'Password changed successfully!'
         ]);
     }
 }
