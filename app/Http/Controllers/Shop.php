<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Mail\Validation;
use App\Mail\Preorder;
use Illuminate\Support\Facades\Mail;
class Shop extends Controller
{
    function addCart(){
        if(!isset($_POST["color"]) or !isset($_POST["quantity"]) or !isset($_POST["id"])){
            return back();
        } else {
            if(isset($_POST["size"])){
                $line = DB::select("SELECT products.* , merch.name, merch.price FROM products JOIN merch ON products.idMerch = merch.id WHERE idMerch = ? AND size = ? AND color = ?",[$_POST["id"],$_POST["size"],$_POST["color"]]);
            } else {
                $line = DB::select("SELECT products.* , merch.name, merch.price FROM products JOIN merch ON products.idMerch = merch.id WHERE idMerch = ? AND color = ?",[$_POST["id"],$_POST["color"]]);
            }
            if(empty($line)){
                return back();
            } else {
                $line = $line[0];
                $line->quantity = intval($_POST["quantity"]);
                if(!session()->has("cart") or empty(session("cart"))){
                    $firstArticle = true;
                    session(["cart"=>[$line->id=>$line]]);
                } else {
                    $firstArticle = false;
                    if(isset(session("cart")[$line->id])){
                        session("cart")[$line->id]->quantity += $line->quantity;
                    } else {
                        $cart = session("cart");
                        $cart[$line->id] = $line;
                        session(["cart"=>$cart]);
                    }
                }
                
                return redirect(route("shop"));
            }
        }
        
    }
    function preorder(){
        if(!isset($_POST['name'])){
            session(["error"=> "Erreur lors de l'insertion du prénom, veuillez recommencer."]);
            return back();
        } else if(!isset($_POST['surname'])){
            session(["error"=> "Erreur lors de l'insertion du nom, veuillez recommencer."]);
            return back();
        } else if(!isset($_POST['email']) or !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            session(["error"=> "Erreur lors de l'insertion de l'email, veuillez recommencer."]);
            return back();
        } else {
            session(["preorder"=>$_POST]);
            $code = strtoupper(bin2hex(random_bytes(3)));
            Cookie::queue("verify",$code,15);
            Mail::to($_POST["email"])->send(new Validation($_POST["name"]." ".$_POST["surname"],$code));
            return back();
    }

    }
    function validation(){
        if(!session()->has("preorder") or !isset($_POST["code"]) or Cookie::get("verify")==null){
            return back();
        } else {
            if($_POST["code"] != Cookie::get("verify")){
                session(["error"=>"Le code rentré n'est pas le bon, veuillez recommencer."]);
                return back();
            } else {
                Cookie::queue(Cookie::forget("verify"));
                $cart = [];
                foreach(session("cart") as $product){
                    $orderNumber = "";
                        for($i=0;$i<6;$i++){
                            $orderNumber = $orderNumber.rand(0,9);
                        }
                        DB::insert("INSERT INTO preorders(orderNumber, name, surname, email, idProduct, quantity) VALUES (?,?,?,?,?,?); ",[$orderNumber,session("preorder")["name"],session("preorder")["surname"],session("preorder")["email"],$product->id,$product->quantity]);
                        DB::update("UPDATE products SET sold = (sold + ?) WHERE id = ?",[$product->quantity,$product->id]);
                        $article = [];
                        foreach($product as $k=>$v){
                            $article[$k] = $v;

                        }
                        $cart[] = $article;
                    }
                    Mail::to(session("preorder")["email"])->send(new Preorder($cart,session("preorder")));
                    session()->forget("cart");
                    session()->forget("preorder");
                    return redirect(route("shop"));

            }
        }
    }
}

