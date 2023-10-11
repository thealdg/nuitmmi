<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Mail\TicketsMail;
use App\Mail\Validation;


class Tickets extends Controller
{
    function ticketingT(){
        if(!isset($_POST["name"]) || !isset($_POST["surname"]) || !isset($_POST["email"])){
            session(["error"=>"Veuillez rentrer tous les champs nécessaires."]);
            return back();
        } else {
            if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                session(["error"=>"Email incorrect, veuillez recommencer."]);
                return back();
            } else {
                if(count($_POST["name"]) != count($_POST["surname"]) || count($_POST["name"]) > 5 || count($_POST["name"]) < 1){
                    session(["error"=>"Erreur dans l'insertion des noms, veuillez recommencer."]);
                    return back();
                } else {
                    $names = [];
                    $surnames = [];
                    for($i=0;$i<count($_POST["name"]);$i++){
                        for($j=0;$j<count($names);$j++){
                            if($_POST["name"][$i] == $names[$j] && $_POST["surname"][$i] == $surnames[$j]){
                                session(["error"=>"Certains tickets possèdent le même nom, veuillez recommencer."]);
                                return back();
                            }
                        }
                        $names[] = $_POST["name"][$i];
                        $surnames[] = $_POST["surname"][$i];
                        $query = DB::select("SELECT * FROM tickets WHERE name LIKE ? AND surname LIKE ?;",[$_POST["name"][$i],$_POST["surname"][$i]]);
                        if(!empty($query)){
                            session(["error"=>"Un billet est déjà attribué au nom suivant: ".$_POST["name"][$i]." ".$_POST["surname"][$i]]);
                            return back();
                        }
                    }
                    session(["tickets"=>$_POST]);
                    $code = strtoupper(bin2hex(random_bytes(3)));
                    Cookie::queue("verify",$code,15);
                    Mail::to($_POST["email"])->send(new Validation($_POST["name"][0]." ".$_POST["surname"][0],$code));
                    return back();
                }
            }
        }
    }
    function validation(){
        if(!session()->has("tickets") or !isset($_POST["code"]) or !Cookie::has("verify")){
            return back();
        } else {
            if($_POST["code"] != Cookie::get("verify")){
                session(["error"=>"Le code rentré n'est pas le bon, veuillez recommencer."]);
                return back();
            } else {
                $tickets = [];
                for($i=0;$i<count(session("tickets")["name"]);$i++){
                    $token = bin2hex(random_bytes(10));
                    $path = "images/tickets/".$token.".svg";
                    $qrCode = QrCode::size(300)->generate(route("activate",$token),public_path($path));
                    DB::insert("INSERT INTO tickets(name,surname,email,token,qrCode) VALUES (?,?,?,?,?);",[session("tickets")["name"][$i],session("tickets")["surname"][$i],session("tickets")["email"],$token,$path]);
                    $tickets[] = DB::SELECT("SELECT * FROM tickets WHERE id = (SELECT LAST_INSERT_ID())")[0];
                }
                Cookie::queue(Cookie::forget("verify"));
                Mail::to(session("tickets")["email"])->send(new TicketsMail(session("tickets")["name"][0].session("tickets")["surname"][0],$tickets));
                return redirect(route("validateTickets"));
            }
        }

    }
    function activate($token){
        if(!session()->has("admin")){
            abort("404");
        } else {
            $query = DB::select("SELECT * FROM tickets WHERE token = ?",[$token]);
            if(empty($query) || $query[0]->activated == 1){
                abort("404");
            } else {
                DB::update("UPDATE tickets SET activated = 1 WHERE token = ?",[$token]);
                $ticket = $query[0];
                return view("tickets/ticket",compact("ticket"));
            }
        }
    }
}

/*

*/
