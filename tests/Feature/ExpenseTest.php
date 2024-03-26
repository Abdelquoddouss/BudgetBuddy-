<?php

namespace Tests\Feature;

use App\Models\Depense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseTest extends TestCase
{
    // use RefreshDatabase; // Ce trait réinitialise la base de données après chaque méthode de test

    /**
     * Un exemple de test de fonctionnalité de base.
     */
    public function test_create_expense()
{
    $user = User::factory()->create();

    $response = $this->actingAs($user)
                     ->json('POST', '/api/Depense', [
                         'prix' => 1000,
                         'description' => 'Test Expense',
                         'date' => now()->format('Y-m-d'),
                     ]);

    $response->assertStatus(201)
             ->assertJson([
                 'message' => 'expenses created successfully', // Modifier le message à tester après la création de la dépense
             ]);
}

    

    
    
    public function test_get_expenses()
    {
        $user = User::factory()->create();
        Depense::factory(3)->create(['user_id' => $user->id]);
    
        $response = $this->actingAs($user)
                         ->json('GET', '/api/Depense');
    
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'message',
                     'expenses' => [], // Remplacer 'Depense' par 'expenses'
                 ]);
    }
    

 
}
