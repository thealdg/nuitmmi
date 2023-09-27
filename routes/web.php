<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Visuals;
use App\Http\Controllers\Users;
use App\Http\Controllers\Shop;
use App\Http\Controllers\Works;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/",[Visuals::class,"index"]) -> name("index");
Route::get("/oeuvres",[Visuals::class,"works"]) -> name("works");
Route::get("/oeuvres/{categoryName}",[Visuals::class,"category"]) -> name("category");
Route::get("/oeuvres/{categoryName}/{id}",[Visuals::class,"work"]) -> name("work");
Route::get("/boutique",[Visuals::class,"shop"]) -> name("shop");
Route::get("/boutique/{id}",[Visuals::class,"article"]) -> where('id','[0-9]+') -> name("article");
Route::get("/a-propos",[Visuals::class,"about"]) -> name("about");
Route::get("/contact",[Visuals::class,"contact"]) -> name("contact");
Route::get("/profil",[Visuals::class,"profil"]) -> name("profil");
Route::get("/profil/connexion",[Visuals::class,"loginPage"])->name("login");
Route::get("/profil/inscription",[Visuals::class,"registerPage"])->name("register");
Route::get("/participer",[Visuals::class,"participate"])->name("participate");
Route::get("/boutique/panier",[Visuals::class,"cart"])->name("cart");
Route::get("/boutique/panier/precommander",[Visuals::class,"preorder"])->name("preorder");

Route::get("/admin",[Visuals::class,"admin"])->name("admin");
Route::get("/admin/moderation",[Visuals::class,"moderation"])->name("moderation");
Route::get("/admin/moderation/allow/{id}",[Works::class,"allow"])->name("allow");
Route::post("/admin/moderation/deny",[Works::class,"deny"])->name("deny");
Route::get("/admin/precommandes",[Visuals::class,"preorders"])->name("preorders");
Route::get("/admin/stocks",[Visuals::class,"stocks"])->name("stocks");

Route::post("/profil/connexionT",[Users::class,"login"])->name("loginT");
Route::get("/profil/deconnexion",[Users::class,"logout"])->name("logout");
Route::post("/profil/registerT",[Users::class,"register"])->name("registerT");
Route::post("/profil/edit",[Users::class,"edit"])->name("edit");

Route::post("/profil/register/validation",[Users::class,"validation"])->name("registerValidation");
Route::post("/partipateR",[Visuals::class,"participateRead"])->name("participateRead");
Route::post("/participer/participateT",[Works::class,"participate"])->name("participateT");
Route::post("/boutique/panier/precommander/preorderT",[Shop::class,"preorder"])->name("preorderT");
Route::post("/boutique/panier/precommander/validation",[Shop::class,"validation"])->name("preorderValidation");

Route::post("/boutique/panier/ajouter",[Shop::class,"addCart"])->name("addCart");

