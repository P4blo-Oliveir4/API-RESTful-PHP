public function test_criar_produto()
{
    $user = \App\Models\User::factory()->create();
    $data = [
        'nome' => 'Produto Teste',
        'descricao' => 'Descrição teste',
        'preco' => 99.99,
        'quantidade' => 10,
        'categoria' => 'Eletrônicos'
    ];

    $response = $this->actingAs($user, 'sanctum')
                     ->postJson('/api/produtos', $data);

    $response->assertStatus(201)
             ->assertJsonFragment(['nome' => 'Produto Teste']);
}