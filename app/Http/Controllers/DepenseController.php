<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepenseRequest;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
/**
 * @OA\Get(
 *     path="/api/Depense",
 *     summary="Get all expenses",
 *     description="Get all expenses",
 *     tags={"Expenses"},
 *     @OA\Response(response="200", description="All expenses"),
 *     @OA\Response(response="404", description="No expenses found"),
 *     security={{"sanctumAuth": {}}},
 * )
 */
public function index()
{
    try {
        $Depense = Depense::all();
        return response()->json([
            "message" => "Expenses retrieved successfully",
            "expenses" => $Depense
        ]);
    } catch(\Exception $e) {
        return response()->json(["message" => "Failed to retrieve all expenses", $e->getMessage()], 500);
    }
}




   /**
 * @OA\Post(
 *   path="/api/Depense",
 *   summary="Create a new expense",
 *   description="Create a new expense",
 *   tags={"Expenses"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *       @OA\Schema(
 *         required={"description", "prix", "date"},
 *         @OA\Property(property="description", type="string", example="Electricity Bill"),
 *         @OA\Property(property="prix", type="integer", format="int32", example=5000),
 *         @OA\Property(property="date", type="string", format="date", example="2024-03-28"),
 *         @OA\Property(property="user_id", type="integer", format="int32", example=1),
 *       ),
 *     ),
 *   ),
 *   @OA\Response(response="201", description="Expense created successfully"),
 *   @OA\Response(response="422", description="Validation errors"),
 *   @OA\Response(response="500", description="Expense not created"),
 *   security={{"sanctumAuth": {}}},
 * )
 */
    public function store(Request $request)
    {
          // return $request->user();
        try{
            $data = $request->all();
            $expense = Depense::create([
                'description'=> $request->description,
                'prix' => $request->prix,
                'date' => $request->date,
                'user_id' => $request->user()->id,

            ]);

            return response()->json([
                "message" => "expenses retrieved successfully",
                "expenses" => $expense
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "store  expense wrong", $e->getMessage()],500);
        }
    }




   /**
     * @OA\Get(
     *    path="/api/Depense/{id}",
     *    summary="Get a single expense",
     *    description="Get a single expense",
     *    tags={"Expenses"},
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="ID of the expense",
     *     required=true,
     *     @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response="200", description="Expense found"),
     *   @OA\Response(response="404", description="Expense not found"),
     *   security={{"sanctumAuth": {}}},
     * )
     */ 
    public function show($id)
    {
        try{
            $Depense = Depense::findOrFail($id);
            return response()->json([
                "message" => "expense retrieved successfully",
                "expenses" => $Depense
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "expense retrieved by id wrong", $e->getMessage()],500);
        }
    }



 /**
 * @OA\Put(
 *   path="/api/Depense/{id}",
 *   summary="Update an expense",
 *   description="Update an expense",
 *   tags={"Expenses"},
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     description="ID of the expense",
 *     required=true,
 *     @OA\Schema(type="integer")
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="application/json",
 *       @OA\Schema(
 *         required={"description", "prix", "date"},
 *         @OA\Property(property="description", type="string", example="Electricity Bill"),
 *         @OA\Property(property="prix", type="integer", format="int32", example=5000),
 *         @OA\Property(property="date", type="string", format="date", example="2024-03-28"),
 *       ),
 *     ),
 *   ),
 *   @OA\Response(response="200", description="Expense updated successfully"),
 *   @OA\Response(response="422", description="Validation errors"),
 *   @OA\Response(response="403", description="Expense not found"),
 *   security={{"sanctumAuth": {}}},
 * )
 */
    public function update(DepenseRequest $request,$id)
    {
        
        try{
          $depense = Depense::findOrFail($id);
         $this->authorize("update", $depense);
          
            $depense->update($request->all());
            return response()->json([
                "message" => "expense retrieved successfully",
                "expenses" => $depense
            ] , 200);
        }catch(\Exception $e){
            return response()->json(["message" => "expense retrieved by id wrong", $e->getMessage()],500);
        }
    }



 /**
     * @OA\Delete(
     *  path="/api/Depense/{id}",
     *  summary="Delete an expense",
     *  description="Delete an expense",
     *  tags={"Expenses"},
     *  @OA\Parameter(
     *   name="id",
     *   in="path",
     *   description="ID of the expense",
     *   required=true,
     *   @OA\Schema(type="integer")
     *  ),
     *  @OA\Response(response="200", description="Expense deleted successfully"),
     *  @OA\Response(response="404", description="Expense not found"),
     *  security={{"sanctumAuth": {}}},
     * )
     */
    public function destroy($id)
    {
       
        try{
            $depense = Depense::findOrFail($id);

    $this->authorize('delete', $depense);

            $depense->delete();
            return response()->json([
                "message" => "expense deleted successfully",
            ]);
        }catch(\Exception $e){
            return response()->json(["message" => "update  expense wrong", $e->getMessage()],500);
        }
    }
}
