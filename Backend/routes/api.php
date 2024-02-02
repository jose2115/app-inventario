<?php

use App\Http\Controllers\dataController\DataController;
use App\Http\Controllers\ingredientsController\IngredientsController;
use App\Http\Controllers\kindOfFoodController\KindOfFoodController;
use App\Http\Controllers\searhRecipeController\SearhRecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/data/ingredients', [DataController::class, 'dataIngredinets']);
Route::post('/data/recipe', [DataController::class, 'dataRecipe']);


//rutas para buscar receptas

Route::post('/search/recipe/explore', [SearhRecipeController::class, 'exploreRecipe']);

Route::post('/search/recipe/exploredetail', [SearhRecipeController::class, 'exploreRecipeDetail']);

Route::post('/search/recipe/explorefast', [SearhRecipeController::class, 'exploreRecipeFast']);

Route::post('/search/recipe/ingredients', [SearhRecipeController::class, 'SearchByIngredientRecipe']);

Route::post('/search/recipe/type', [SearhRecipeController::class, 'MenuWeekRecipe']);

Route::post('/search/recipe/premiun', [SearhRecipeController::class, 'RecipePremiun']);







//Route::post('/search/recipe/carga', [SearhRecipeController::class, 'cargaAutomatica']);
