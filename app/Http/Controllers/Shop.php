<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                } else {
                    $firstArticle = false;
                }
                if(isset(session("cart")[$line->id])){
                    session("cart")[$line->id]->quantity += $line->quantity;
                } else {
                    session(["cart"=>[$line->id => $line]]);
                }
                return redirect(route("shop"));
            }
        }
        
    }

}
