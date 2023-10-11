<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
class Visuals extends Controller
{
    function index(){
        return view("index");
    }
    function works(){
        $works = DB::select("SELECT categories.name as categoryName, works.*, validation.idCategory, users.year FROM works JOIN validation ON works.id = validation.idWork JOIN categories ON validation.idCategory = categories.id JOIN users ON validation.idUser = users.id WHERE validation.result = 1 ORDER BY categoryName");
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
        $query = DB::select("SELECT * FROM categories WHERE name = ?",[$categoryName]);
        if(empty($query)){
            abort("404");
        }
        $category = DB::select("SELECT works.id, works.thumbnail, works.name AS workName, works.authors, users.year, categories.name AS categoryName FROM works JOIN validation ON validation.idWork = works.id JOIN categories ON categories.id = validation.idCategory JOIN users ON users.id = validation.idUser WHERE validation.result = 1 AND categories.name = ?;",[$categoryName]);
        $participation = DB::select("SELECT works.id, works.thumbnail, works.name AS workName, works.authors, users.year, categories.name AS categoryName FROM works JOIN validation ON validation.idWork = works.id JOIN categories ON categories.id = validation.idCategory JOIN users ON users.id = validation.idUser WHERE validation.result = 1 AND categories.name = ? AND works.competition = 1;",[$categoryName]);
        return view("works/category",compact("category","participation")); 
    }
    function work($categoryName,$id){
        $work = DB::select("SELECT works.*, categories.name AS category, categories.id AS idCategory, users.year, users.id AS idUser FROM works JOIN validation ON works.id = validation.idWork JOIN categories ON validation.idCategory = categories.id JOIN users ON validation.idUser = users.id WHERE works.id = ? AND categories.name LIKE ?",[$id,$categoryName]);
        if(empty($work)){
            abort("404");
        } else {
            $work = $work[0];
            $validation = DB::select("SELECT result FROM validation WHERE idWork = ?",[$work->id])[0];
            if($validation->result == null || $validation->result == 0){
                if(!session()->has("admin")){
                    abort("404");
                }
            }
            $userWorks = DB::select("SELECT users.name AS userName, users.surname as userSurname, users.year, users.linkedin, works.*, categories.name as categoryName FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE users.id = ? AND validation.result=1 ORDER BY RAND()",[$work->idUser]);
            $categoryWorks = DB::select("SELECT works.*, users.year, categories.name AS categoryName FROM works JOIN validation ON works.id = validation.idWork JOIN users ON validation.idUser = users.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idCategory = ? AND validation.result=1 ORDER BY RAND() LIMIT 6",[$work->idCategory]);
            return view("works/work",compact("work","userWorks","categoryWorks","validation"));
        }

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
        if((session()->has("preorder") || session()->has("tickest")) && Cookie::has("verify")){
            Cookie::queue(Cookie::forget("verify"));
        }
        return view("users/register");
    }
    function profil(){
        if(!session()->has("id")){
            if(Cookie::has("email") and Cookie::has("password")){
                $line = DB::select("SELECT * FROM users WHERE email = ? AND password = SHA1(?);",[Cookie::get("email"),Cookie::get("password")]);
                if(!empty($line)){
                    $line = $line[0];
                    session(["id"=>$line->id]);
                    if(property_exists($line,"profilePicture")){
                        session(["profilePicture"=>$line->profilePicture]);
                    }
                    return redirect(route("profil"));
                } else {
                    return redirect("/profil/connexion");
                }
            } else {
                return redirect("/profil/connexion");
            }
            
        } else {
            $works = DB::select("SELECT works.*, validation.result, validation.commentary, categories.name AS category FROM validation JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idUser = ?;",[session("id")]);
            $data = DB::select("SELECT * FROM users WHERE users.id = ?;",[session("id")]);
            
            $data = $data[0];
            $tickets = DB::select("SELECT * FROM tickets WHERE email = ?",[$data->email]);
            $competitionWorks = [];
            foreach($works as $work){
                if($work->competition==1){
                    $competitionWorks[] = $work;
                }
            }
            return view("users/profilPage",compact("works","data","tickets","competitionWorks"));
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
            if((session()->has("register") || session()->has("tickets")) && Cookie::has("verify")){
                Cookie::queue(Cookie::forget("verify"));
            }
            if(session()->has("id")){
                $infos = DB::select("SELECT * FROM users WHERE id=?",[session("id")])[0];
                return view("shop/preorder",compact("infos"));
            } else {
                return view("shop/preorder");
            }
            
        }
    }
    function participate(){
        if(!session()->has("id")){
            return redirect(route("login"));
        } else {
            if(!Cookie::has("participate")){
                return view("works/participation");
            } else {
                return view("works/participate");
            }
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
    function admin(){
        if(!session()->has("admin")){
            abort("404");
        } else {
            return view("admin/admin");
        }
    }
    function moderation(){
        if(!session()->has("admin")){
            abort("404");
        } else {
            $validations = DB::select("SELECT works.id AS workId, works.name AS workName, works.competition, validation.proof, validation.result, users.*, categories.name AS categoryName FROM works JOIN validation ON works.id = validation.idWork JOIN users ON validation.idUser = users.id JOIN categories ON validation.idCategory = categories.id;");
            return view("admin/moderation",compact("validations"));
        }
    }
    function preorders(){
        if(!session()->has("admin")){
            abort("404");
        } else {
            if(isset($_GET["sort"])){
                if($_GET["sort"] == "increasing"){
                    $sort = "ORDER BY amount ASC";
                } else if($_GET["sort"] == "decreasing"){
                    $sort = "ORDER BY amount DESC";
                } else if($_GET["sort"] == "alphabetical"){
                    $sort = "ORDER BY preorders.name, preorders.surname ASC";
                } 
             
            } else {
                $sort = "ORDER BY preorders.name, preorders.surname ASC";
            }
            if(isset($_GET["search"]) and !empty($_GET["search"])){
                $preorders = DB::select("SELECT preorders.*, merch.name AS productName, products.color, products.size, preorders.quantity * merch.price AS amount FROM preorders JOIN products ON preorders.idProduct = products.id JOIN merch ON products.idMerch = merch.id WHERE preorders.name LIKE ? OR preorders.surname LIKE ? ".$sort.";",[$_POST["search"]]);
            } else {
                $preorders = DB::select("SELECT preorders.*, merch.name AS productName, products.color, products.size, preorders.quantity * merch.price AS amount FROM preorders JOIN products ON preorders.idProduct = products.id JOIN merch ON products.idMerch = merch.id ".$sort.";");
            }
            return view("admin/preorders",compact("preorders"));

        }
    }
    function stocks(){
        if(!session()->has("admin")){
            abort("404");
        } else {
            if(isset($_GET["sort"])){
                if($_GET["sort"] == "increasing"){
                    $sort = "ORDER BY sold ASC";
                } else if($_GET["sort"] == "decreasing"){
                    $sort = "ORDER BY sold DESC";
                } else if($_GET["sort"] == "alphabetical"){
                    $sort = "ORDER BY name ASC";
                }
        } else {
            $sort = "ORDER BY name ASC";
        }
        $stocks = DB::select("SELECT * FROM products JOIN merch ON products.idMerch = merch.id ".$sort.";");
        return view("admin/stocks",compact("stocks"));
    }
} 
function tickets(){
    if(!session()->has("admin")){
        abort("404");
    } else {
        if(isset($_GET["sort"])){
            if($_GET["sort"] == "inactive"){
                $sort = "ORDER BY activated ASC";
            } else if($_GET["sort"] == "active"){
                $sort = "ORDER BY activated DESC";
            } else if($_GET["sort"] == "alphabetical"){
                $sort = "ORDER BY name, surname ASC";
            } 
         
        } else {
            $sort = "ORDER BY name, surname ASC";
        }
        if(isset($_GET["search"]) and !empty($_GET["search"])){
            $tickets = DB::select("SELECT * FROM tickets WHERE name LIKE ? OR surname LIKE ? ".$sort.";",[$_POST["search"]]);
        } else {
            $tickets = DB::select("SELECT * FROM tickets ".$sort.";");
        }
        $active = DB::select("SELECT COUNT(id) AS total FROM tickets WHERE activated = 1")[0];
        return view("admin/tickets",compact("tickets","active"));
    }
}
    function password(){
        return view("users/resetPassword");
    }
    function changePassword($email,$token){
        if(session("token")["email"]!=$email or session("token")["code"]!=$token){
            return(route("password"));
        } else {
            return view("users/changePassword");

        }
    }
    function legal(){
        return view("legal");
    }
    function press(){
        return view("press");
    }
    function conditions(){
        return view("conditions");
    }
    function competition(){
        return view("works/competition");
    }
    function ticketing(){
        if((session()->has("register") || session()->has("preorder")) && Cookie::has("verify")){
            Cookie::queue(Cookie::forget("verify"));
        }
        return view("tickets/ticketing");
    }
    function validateTickets(){
        if(!session()->has("tickets")){
            return redirect("/");
        } else {
            $query = DB::select("SELECT * FROM tickets WHERE email = ?",[session("tickets")["email"]]);
            if(empty($query)){
                return redirect("/");
            } else {
                session()->forget("tickets");
                return view("tickets/validate");
            }
        }

    }
    function modalites(){
        return view("works/participation");
    }
}  
