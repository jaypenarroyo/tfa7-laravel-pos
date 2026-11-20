<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FormWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected bool $seed = true;

    public function test_a_customer_can_be_created_and_updated(): void
    {
        $this->post(route('customers.store'), [
            'full_name' => 'Leah Bautista',
            'email' => 'leah.bautista@example.com',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.index'));

        $customer = Customer::where('email', 'leah.bautista@example.com')->firstOrFail();
        $this->assertSame('Leah Bautista', $customer->full_name);

        $this->put(route('customers.update', $customer), [
            'full_name' => 'Leah B. Bautista',
            'email' => 'leah.bautista@example.com',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.index'));

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'full_name' => 'Leah B. Bautista',
        ]);
    }

    public function test_customer_validation_preserves_old_input(): void
    {
        $this->from(route('customers.create'))->post(route('customers.store'), [
            'full_name' => 'Leah Bautista',
            'email' => 'not-an-email',
            'phone' => '0999-111-2233',
        ])->assertRedirect(route('customers.create'))
            ->assertSessionHasErrors('email')
            ->assertSessionHasInput('full_name', 'Leah Bautista')
            ->assertSessionHasInput('email', 'not-an-email');
    }

    public function test_a_user_can_be_created_and_duplicate_usernames_are_rejected(): void
    {
        $this->post(route('users.store'), [
            'username' => 'supervisor01',
            'full_name' => 'Rina Castillo',
        ])->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'username' => 'supervisor01',
            'full_name' => 'Rina Castillo',
        ]);

        $this->from(route('users.create'))->post(route('users.store'), [
            'username' => 'supervisor01',
            'full_name' => 'Another Supervisor',
        ])->assertRedirect(route('users.create'))
            ->assertSessionHasErrors('username')
            ->assertSessionHasInput('full_name', 'Another Supervisor');
    }

    public function test_a_user_can_be_updated_with_a_prepared_avatar(): void
    {
        Storage::fake('public');
        $user = User::where('username', 'admin')->firstOrFail();

        $this->put(route('users.update', $user), [
            'username' => 'admin',
            'full_name' => 'Andrea Lim Updated',
            'avatar' => UploadedFile::fake()->image('profile.png', 600, 400)->size(500),
        ])->assertRedirect(route('users.index'));

        $user->refresh();
        $this->assertSame('Andrea Lim Updated', $user->full_name);
        $this->assertNotNull($user->avatar);
        $this->assertStringEndsWith('.jpg', $user->avatar);
        Storage::disk('public')->assertExists($user->avatar);

        [$width, $height] = getimagesize(Storage::disk('public')->path($user->avatar));
        $this->assertSame(240, $width);
        $this->assertSame(240, $height);
    }

    public function test_avatar_validation_rejects_files_larger_than_two_megabytes(): void
    {
        Storage::fake('public');
        $user = User::where('username', 'admin')->firstOrFail();

        $this->from(route('users.edit', $user))->put(route('users.update', $user), [
            'username' => $user->username,
            'full_name' => $user->full_name,
            'avatar' => UploadedFile::fake()->image('large.png')->size(2049),
        ])->assertRedirect(route('users.edit', $user))
            ->assertSessionHasErrors('avatar');

        $this->assertNull($user->fresh()->avatar);
    }
}
