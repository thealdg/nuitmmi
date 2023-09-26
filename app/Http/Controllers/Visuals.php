<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
class Visuals extends Controller
{
    function index(){
        $categories = DB::select("SELECT * FROM categories");
        return view("index",compact("categories"));
    }
    function works(){
        $works = DB::select("SELECT categories.name as categoryName, works.*, validation.idCategory, users.year FROM works JOIN validation ON works.id = validation.idWork JOIN categories ON validation.idCategory = categories.id JOIN users ON validation.idUser = users.id WHERE validation.result = 1");
        $categories = [];
        $competitions = [];
        foreach($works as $work){
            $categories[$work->categoryName][] = $work;
            if($work->competition == "1"){
                $competitions[$work->categoryName][] = $work;
            }
        }
        return view("works/categories",compact("categories","competitions"));
    }
    function category($categoryName){
        $category = DB::select("SELECT works.id, works.thumbnail, works.name AS workName, works.authors, users.year, categories.name AS categoryName FROM works JOIN validation ON validation.idWork = works.id JOIN categories ON categories.id = validation.idCategory JOIN users ON users.id = validation.idUser WHERE validation.result = 1 AND categories.name = ?;",[$categoryName]);
        $participation = DB::select("SELECT works.id, works.thumbnail, works.name AS workName, works.authors, users.year, categories.name AS categoryName FROM works JOIN validation ON validation.idWork = works.id JOIN categories ON categories.id = validation.idCategory JOIN users ON users.id = validation.idUser WHERE validation.result = 1 AND categories.name = ? AND works.competition = 1;",[$categoryName]);
        return view("works/category",compact("category","participation")); 
    }
    function work($categoryName,$id){
        $work = DB::select("SELECT works.*, categories.name AS category, categories.id AS idCategory, users.year, users.id AS idUser FROM works JOIN validation ON works.id = validation.idWork JOIN categories ON validation.idCategory = categories.id JOIN users ON validation.idUser = users.id WHERE works.id = ? AND categories.name LIKE ?",[$id,$categoryName]);
        $work = $work[0];
        $userWorks = DB::select("SELECT users.name AS userName, users.surname as userSurname, users.year, users.linkedin, works.*, categories.name as categoryName FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE users.id = ? AND validation.result=1 ORDER BY RAND()",[$work->idUser]);
        $categoryWorks = DB::select("SELECT works.*, users.year, categories.name AS categoryName FROM works JOIN validation ON works.id = validation.idWork JOIN users ON validation.idUser = users.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idCategory = ? AND validation.result=1 ORDER BY RAND() LIMIT 6",[$work->idCategory]);
        return view("works/work",compact("work","userWorks","categoryWorks"));

    }
    function shop(){
        $merch = DB::select("SELECT * FROM merch JOIN products ON merch.id = products.idMerch;");
        return view("shop/shop",compact("merch"));
    }
    function article($id){
        $products = DB::select("SELECT * FROM products WHERE idMerch = ?",[$id]);
        $merch = ["colors" => [], "sizes" => [], "images" => []];
        $merch["infos"] = DB::select("SELECT * FROM merch WHERE id = ?",[$id])[0];
        foreach($products as $product){
            if(!in_array($product->color,$merch["colors"])){
                $merch["colors"][] = $product->color;
                $merch["images"][$product->color] = glob($product->images.'/*.{jpg,jpeg,png,gif,webp}', GLOB_BRACE);
            }
            if(!in_array($product->size,$merch["sizes"])){
                $merch["sizes"][] = $product->size;
            }
        }
        return view("shop/article",compact("merch","id"));
    }
    function about(){
        return view("about");
    }
    function contact(){
        return view("contact");
    }
    function loginPage(){
        return view("users/login");
    }
    function registerPage(){
        return view("users/register");
    }
    function profil(){
        if(!session()->has("id")){
            return redirect("/profil/connexion");
        } else {
            $works = DB::select("SELECT works.*, validation.result, validation.commentary, categories.name AS category FROM validation JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idUser = ?;",[session("id")]);
            $data = DB::select("SELECT * FROM users WHERE users.id = ?;",[session("id")]);
            $data = $data[0];
            return view("users/profilPage",compact("works","data"));
        }

    }
    function cart(){
        
        if(!session()->has("cart") or empty(session("cart"))){
            return redirect(route("shop"));
        } else {
            return view("shop/cart");
        }
    }
    function preorder(){
        if(!session()->has("cart") or empty(session("cart"))){
            return redirect(route("shop"));
        } else {
            if(session()->has("id")){
                $infos = DB::select("SELECT * FROM users WHERE id=?",[session("id")])[0];
                return view("shop/preorder",compact("infos"));
            } else {
                return view("shop/preorder");
            }
            
        }
    }
    function participate(){
        if(!Cookie::has("participate") or isset($_GET["modalite"])){
            return view("works/participation");
        } else {
            return view("works/participate");
        }
    }
    function participateRead(){
        if(isset($_POST["read"])){
            Cookie::queue("participate",true,60*24*30);
            return redirect(route("participate"));
        } else {
            return back();
        }
    }

}
