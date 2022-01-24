<?php

declare(strict_types=1);

namespace Tests\Feature\Department;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class DepartmentControllerTest extends TestCase
{
    use WithFaker;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::admin()->first();
    }

    /**
     * @test
     * @group main
     */
    public function updateUser(): void
    {
        $user = User::factory()->create();
        $userArray = ['name' => Str::random(rand(3, 10)), 'email' => $this->faker->email];
        $response = $this->actingAs($this->user)
            ->put(route('users.update', array_merge([$user->id], $userArray)));

        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas(User::class, [
            'id' => $user->id,
            'name' => $userArray['name'],
            'email' => $userArray['email']
        ]);
    }

    /**
     * @test
     * @group main
     */
    public function updateUserWhenUserRole(): void
    {
        $user = User::factory()->create();
        $userArray = ['name' => Str::random(rand(3, 10)), 'email' => $this->faker->email];
        $response = $this->actingAs($user)
            ->put(route('users.update', array_merge([$user->id], $userArray)));

        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /**
     * @test
     * @group main
     */
    public function deleteUser(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($this->user)->delete(
            route(
                'users.destroy',
                [$user->id]
            )
        );
        $response->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseMissing(User::class, ['id' => $user->id]);
    }

    /**
     * @test
     * @group main
     */
    public function deleteUserWithUserRole(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->delete(
            route(
                'users.destroy',
                [$user->id]
            )
        );
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

}
