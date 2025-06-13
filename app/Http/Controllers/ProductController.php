<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="API Loja Online",
 *     version="1.0",
 *     description="Documentação da API para gerenciamento de produtos.",
 *     @OA\Contact(
 *         email="seu@email.com"
 *     )
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/produtos",
     *     summary="Lista todos os produtos",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="categoria",
     *         in="query",
     *         description="Filtrar por categoria",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de produtos"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        return $query->paginate(10);
    }

    /**
     * @OA\Post(
     *     path="/api/produtos",
     *     summary="Cria um novo produto",
     *     tags={"Produtos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","descricao","preco","quantidade","categoria"},
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="preco", type="number", format="float"),
     *             @OA\Property(property="quantidade", type="integer"),
     *             @OA\Property(property="categoria", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto criado"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'categoria' => 'required|string|max:255',
        ]);

        $produto = Product::create($validated);

        return response()->json($produto, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/produtos/{id}",
     *     summary="Exibe um produto específico",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dados do produto"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function show($id)
    {
        $produto = Product::findOrFail($id);
        return response()->json($produto);
    }

    /**
     * @OA\Put(
     *     path="/api/produtos/{id}",
     *     summary="Atualiza um produto",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nome", type="string"),
     *             @OA\Property(property="descricao", type="string"),
     *             @OA\Property(property="preco", type="number", format="float"),
     *             @OA\Property(property="quantidade", type="integer"),
     *             @OA\Property(property="categoria", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $produto = Product::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'string|max:255',
            'descricao' => 'string',
            'preco' => 'numeric',
            'quantidade' => 'integer',
            'categoria' => 'string|max:255',
        ]);

        $produto->update($validated);

        return response()->json($produto);
    }

    /**
     * @OA\Delete(
     *     path="/api/produtos/{id}",
     *     summary="Exclui um produto",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto excluído"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $produto = Product::findOrFail($id);
        $produto->delete();

        return response()->json(['mensagem' => 'Produto excluído com sucesso.']);
    }
}
