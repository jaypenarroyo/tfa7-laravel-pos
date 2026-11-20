<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::query()->orderBy('id')->get();

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:100'],
        ]);

        User::create($validated);

        return to_route('users.index')->with('success', 'User account created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'username' => ['required', 'string', 'max:50', Rule::unique('users', 'username')->ignore($user)],
            'full_name' => ['required', 'string', 'max:100'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->storeAvatar($request, $user);
        } else {
            unset($validated['avatar']);
        }

        $user->update($validated);

        return to_route('users.index')->with('success', 'User account updated successfully.');
    }

    private function storeAvatar(Request $request, User $user): string
    {
        $upload = $request->file('avatar');
        $path = 'avatars/'.Str::uuid().'.jpg';
        $avatar = Image::read($upload)->cover(240, 240)->toJpeg(quality: 85);

        Storage::disk('public')->put($path, (string) $avatar);

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        return $path;
    }
}
