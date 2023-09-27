<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Mail\Validation;
use Illuminate\Support\Facades\Mail;
class Users extends Controller
{
    function login(){
        if(!isset($_POST["email"]) or !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
            session(["error"=>"Erreur lors de l'insertion de l'email, veuillez recommencer."]);
            return redirect(route("login"));
        } else if(!isset($_POST["password"])){
            session(["error"=>"Erreur lors de l'insertion du mot de passe, veuillez recommencer."]);
            return redirect(route("login"));
        } else{
            $line = DB::select("SELECT * FROM users WHERE email=? AND password=SHA1(?)",[$_POST["email"],$_POST["password"]]);
            if(empty($line)){
                return redirect(route("login"));
            } else {
                $line = $line[0];
                if(isset($_POST["remember"])){
                    Cookie::queue("email",$_POST["email"],60*24*30);
                    Cookie::queue("password",$_POST["password"],60*24*30);
                }
                session(["id"=>$line->id]);
                if(isset($line->profilePicture)){
                    session(["profilePicture"=> $line->profilePicture]);
                }
                if($line->admin == 1){
                    session(["admin"=>true]);
                }
                return redirect("/");
            }
           
        }
    }
    function logout(){
        if(!session()->has("id")){
            return redirect(route("login"));
        } else {
            session()->flush();
            return redirect(route("login"));
        }
    }
    function register(){
            if(!isset($_POST['name'])){
                session(["error" => "Erreur lors de l'insertion du prénom, veuillez recommencer."]);
                return redirect(route("register"));
            } else if(!isset($_POST['surname'])){
                session(["error" => "Erreur lors de l'insertion du nom, veuillez recommencer."]);
                return redirect(route("register"));
            } else if(!isset($_POST['year'])){
                session(["error" => "Erreur lors de l'insertion du niveau d'étude, veuillez recommencer."]);
                return redirect(route("register"));
            } else if(!isset($_POST['email']) or !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                session(["error" => "Erreur lors de l'insertion de l'email, veuillez recommencer."]);
                return redirect(route("register"));
            } else if(!isset($_POST['password']) or !isset($_POST['password2'])){
                session(["error" => "Erreur lors de l'insertion du mot de passe, veuillez recommencer."]);
                return redirect(route("register"));
            } else if($_POST['password'] != $_POST['password2']){
                session(["error" => 'Les mots de passe ne correspondent pas, veuillez recommencer.']);
                return redirect(route("register"));
            } else if($_POST['conditions']!='true'){
                session(["error" => "Veuillez accepter les conditions générales d'utilisation."]);
                return redirect(route("register"));
            } else {
                $query = DB::select("SELECT * FROM users WHERE email=?",[$_POST["email"]]);
                if(!empty($query)){
                    session(["error"=>"'Adresse email déjà existante, veuillez recommencer.'"]);
                    return redirect(route("register"));
                } else {
                    session(["register"=>$_POST]);
                    $code = strtoupper(bin2hex(random_bytes(3)));
                    Cookie::queue("verify",$code,15);
                    Mail::to($_POST["email"])->send(new Validation($_POST["name"]." ".$_POST["surname"],$code));
                    return redirect(route("register"));
                }
            }
        }
        function validation(){
            if(!session()->has("register") or !isset($_POST["code"]) or Cookie::get("verify")==null){
                return redirect(route("register"));
            } else {
                if($_POST["code"] != Cookie::get("verify")){
                    session(["error"=>"Le code rentré n'est pas le bon, veuillez recommencer."]);
                    return redirect(route("register"));
                } else {
                    Cookie::queue(Cookie::forget("verify"));
                    DB::insert("INSERT INTO users(name,surname,email,password,year) VALUES (?,?,?,SHA1(?),?)",[session("register")["name"],session("register")["surname"],session("register")["email"],session("register")["password"],session("register")["year"]]);
                    $id = DB::select("SELECT LAST_INSERT_ID() AS id;")[0];
                    if(isset(session("register")["phone"])){
                        DB::update("UPDATE users SET phone = ? WHERE id = ?",[session("register")["phone"],$id->id]);
                    }
                    if(isset(session("register")["linkedin"]) and filter_var(session("register")["linkedin"],FILTER_VALIDATE_URL) and str_contains(session("register")["linkedin"],"https://www.linkedin.com/in")){
                        DB::update("UPDATE users SET linkedin = ? WHERE id = ?",[session("register")["linkedin"],$id->id]);
                    }
                    session()->flush();
                    session(["id"=>$id->id]);
                    return redirect("/");
                }
            }
        }
        function edit(){
            if(!session()->has("id")){
                return redirect(route("login"));
            } else {
                if(!isset($_POST["email"])){
                    session(["error"=>"Erreur lors de la modification de l'email."]);
                    return back();
                } else {
                    $query = DB::select("SELECT * FROM users WHERE email=? AND id!=?",[$_POST["email"],session("id")]);
                    if(!empty($query)){
                        session(["error"=>"Adresse email déjà existante."]);
                        return back();
                    } else {
                        DB::update("UPDATE users SET email = ? WHERE users.id = ?;",[$_POST["email"],session("id")]);
                    }
                    if(isset($_POST["phone"])){
                        DB::update("UPDATE users SET phone = ? WHERE users.id = ?;",[$_POST["phone"],session("id")]);
                    }
                    if(isset($_FILES["profilePic"])){
                        $path = "images/upload/profilePictures/".session("id").".".pathinfo($_FILES["profilePic"]["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES["profilePic"]["tmp_name"],public_path($path));
                        DB::update("UPDATE users SET profilePicture = ? WHERE users.id = ?",[$path,session("id")]);
                    }
                    if(isset($_POST["linkedin"]) and filter_var($_POST["linkedin"],FILTER_VALIDATE_URL) and str_contains($_POST["linkedin"],"https://www.linkedin.com/in")){
                        DB::update("UPDATE users SET linkedin = ? WHERE id = ?",[$_POST["linkedin"],session("id")]);
                    }
                    return back();
                }
                
            }
        }

    }
