<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Mail\Validation;
use App\Mail\ResetPassword;
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
                session(["error"=>"Email ou mot de passe incorrect, veuillez recommencer."]);
                return redirect(route("login"));
            } else {
                $line = $line[0];
                if(isset($_POST["remember"])){
                    Cookie::queue("email",$_POST["email"],60*24*30);
                    Cookie::queue("password",$_POST["password"],60*24*30);
                }
                session(["id"=>$line->id]);
                if(property_exists($line,"profilePicture")){
                    session(["profilePicture"=> $line->profilePicture]);
                }
                if($line->admin == 1){
                    session(["admin"=>true]);
                }
                return redirect(route("profil"));
            }
           
        }
    }
    function logout(){
        if(!session()->has("id")){
            return redirect(route("login"));
        } else {
            session()->forget("id");
            session()->forget("profilePicture");
            Cookie::queue(Cookie::forget("email"));
            Cookie::queue(Cookie::forget("password"));
            return redirect(route("login"));
        }
    }
    function register(){
            $register = [];
            $allow = true;
            if(!isset($_POST['name'])){
                session(["error" => "Erreur lors de l'insertion du prénom, veuillez recommencer."]);
                $allow = false;
            } else{
                $register["name"] = $_POST["name"];
            }
            if(!isset($_POST['surname'])){
                session(["error" => "Erreur lors de l'insertion du nom, veuillez recommencer."]);
                $allow = false;
            } else{
                $register["surname"] = $_POST["surname"];
            }
            if(!isset($_POST['year'])){
                session(["error" => "Erreur lors de l'insertion du niveau d'étude, veuillez recommencer."]);
                $allow = false;
            } else{
                $register["year"] = $_POST["year"];
            }
            if(!isset($_POST['email']) or !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                session(["error" => "Erreur lors de l'insertion de l'email, veuillez recommencer."]);
                $allow = false;
            } else{
                $register["email"] = $_POST["email"];
            }
            if(!isset($_POST['password']) or !isset($_POST['password2'])){
                session(["error" => "Erreur lors de l'insertion du mot de passe, veuillez recommencer."]);
                $allow = false;
            } else{
                $register["password"] = $_POST["password"];
            }
            if($_POST['password'] != $_POST['password2']){
                session(["error" => 'Les mots de passe ne correspondent pas, veuillez recommencer.']);
                $allow = false;
            } else{
                $register["password2"] = $_POST["password2"];
            }
            if($_POST['conditions']!='true'){
                session(["error" => "Veuillez accepter les conditions générales d'utilisation."]);
                $allow = false;
            } else {
                $register["conditions"] = $_POST["conditions"];
                if(!$allow){
                    session(["register"=>$register]);
                    return back();
                }
                $query = DB::select("SELECT * FROM users WHERE email=?",[$_POST["email"]]);
                if(!empty($query)){
                    session(["error"=>"Adresse email déjà existante, veuillez recommencer."]);
                    session(["register"=>$register]);
                    return back();
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
            if(!session()->has("register") or !isset($_POST["code"]) or !Cookie::has("verify")){
                return redirect(route("register"));
            } else {
                if($_POST["code"] != Cookie::get("verify")){
                    session(["error"=>"Le code rentré n'est pas le bon, veuillez recommencer."]);
                    return redirect(route("register"));
                } else {
                    DB::insert("INSERT INTO users(name,surname,email,password,year) VALUES (?,?,?,SHA1(?),?)",[session("register")["name"],session("register")["surname"],session("register")["email"],session("register")["password"],session("register")["year"]]);
                    $id = DB::select("SELECT LAST_INSERT_ID() AS id;")[0];
                    if(isset(session("register")["phone"])){
                        DB::update("UPDATE users SET phone = ? WHERE id = ?",[session("register")["phone"],$id->id]);
                    }
                    if(isset(session("register")["linkedin"]) and filter_var(session("register")["linkedin"],FILTER_VALIDATE_URL) and str_contains(session("register")["linkedin"],"https://www.linkedin.com/in")){
                        DB::update("UPDATE users SET linkedin = ? WHERE id = ?",[session("register")["linkedin"],$id->id]);
                    }
                    if(isset(session("register")["newsletter"])){
                        DB::update("UPDATE users SET newsletter = 1 where id = ?",[$id->id]);
                    }
                    session()->forget("register");
                    Cookie::queue(Cookie::forget("verify"));
                    session(["id"=>$id->id]);
                    return redirect(route("profil"));
                }
            }
        }
        function edit(){
            if(!session()->has("id")){
                return redirect(route("login"));
            } else { 
                    if(isset($_POST["email"])){       
                        $query = DB::select("SELECT * FROM users WHERE email=? AND id!=?",[$_POST["email"],session("id")]);
                        if(!empty($query)){
                            session(["error"=>"Adresse email déjà existante."]);
                            return back();
                        } else {
                            DB::update("UPDATE users SET email = ? WHERE users.id = ?;",[$_POST["email"],session("id")]);
                        }
                    }
                    if(isset($_POST["phone"])){
                        DB::update("UPDATE users SET phone = ? WHERE users.id = ?;",[$_POST["phone"],session("id")]);
                    }
                    if(isset($_FILES["profilePic"])){
                        $path = "images/upload/profilePictures/".session("id").".".pathinfo($_FILES["profilePic"]["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES["profilePic"]["tmp_name"],public_path($path));
                        DB::update("UPDATE users SET profilePicture = ? WHERE users.id = ?",[$path,session("id")]);
                        session(["profilePicture"=> $path]);
                    }
                    if(isset($_POST["linkedin"]) and filter_var($_POST["linkedin"],FILTER_VALIDATE_URL) and str_contains($_POST["linkedin"],"https://www.linkedin.com/in")){
                        DB::update("UPDATE users SET linkedin = ? WHERE id = ?",[$_POST["linkedin"],session("id")]);
                    }
                    if(isset($_POST["oldPassword"]) and isset($_POST["password1"]) and isset($_POST["password2"])){
                        if($_POST["password1"]!=$_POST["password2"]){
                            session(["error"=>"Les mots de passe ne correspondent pas."]);
                            return back();
                        } else {
                            $query = DB::select("SELECT * FROM users WHERE id = ? AND password LIKE SHA1(?);",[session("id"),$_POST["oldPassword"]]);
                            if(empty($query)){
                                session(["error"=>"Le mot de passe actuel n'est pas le bon."]);
                                return back();
                            } else {
                                DB::UPDATE("UPDATE users SET password = SHA1(?) WHERE id = ?;",[$_POST["password1"],session("id")]);
                                return back();
                            }
                        }
                    }

                    return back();
                }
                
            }
            function resetPassword(){
                if(!isset($_POST["email"]) or !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
                    session(["error"=>"Erreur lors de l'insertion du mail, veuillez recommencer."]);
                    return back();
                } else {
                    $query = DB::SELECT("SELECT * FROM users WHERE email LIKE ?",[$_POST["email"]]);
                    if(empty($query)){
                        session(["error"=>"Adresse email non reconnue, veuillez recommencer."]);
                        return back();
                    } else {
                        if(session()->has("email_timeout")){
                            if(session("email_timeout") > time()){
                                session(["error"=>"La prochaine requête sera disponible dans ".session("email_timeout")-time()." secondes"]);
                                return back();
                            }
                        }
                        session(["email_timeout"=>time()+180]);
                        $query = $query[0];
                        session(["token"=>["email"=>$_POST["email"],"code"=>bin2hex(random_bytes(10))]]);
                        Mail::to($_POST["email"])->send(new ResetPassword($query->name." ".$query->surname,$query->email,session("token")["code"]));
                        return back();
                    }    
                }

            }
            function changePasswordT(){
                if(!isset($_POST["password1"]) or !isset($_POST["password2"]) or !session()->has("token")){
                    session(["error"=>"Erreur lors de l'insertion des mots de passe, veuillez recommencer."]);
                    return back();
                } else {
                    if($_POST["password1"]!=$_POST["password2"]){
                        session(["error"=>"Les mots de passe ne correspondent pas."]);
                        return back();
                    } else {
                        DB::update("UPDATE users SET password = SHA1(?) WHERE email LIKE ?",[$_POST["password1"],session("token")["email"]]);
                        return redirect(route("login"));
                    }
                }
            }
            function resetCode(){
                if(!Cookie::has("verify") or (!session()->has("register") and !session()->has("preorder"))){
                    return redirect(url()->previous());
                } else {
                    if(session()->has("email_timeout")){
                        if(session("email_timeout") > time()){
                            session(["error"=>"La prochaine requête sera disponible dans ".session("email_timeout")-time()." secondes"]);
                            return redirect(url()->previous());
                        }
                    }
                    session(["email_timeout"=>time()+180]);
                    $code = strtoupper(bin2hex(random_bytes(3)));
                    Cookie::queue("verify",$code,15);
                    if(session()->has("register")){
                        $email = session("register")["email"];
                        $name = session("register")["name"];
                        $surname = session("register")["surname"];
                    } else if(session()->has("preorder")){
                        $email = session("preorder")["email"];
                        $name = session("preorder")["name"];
                        $surname = session("preorder")["surname"];
                    }
                    Mail::to($email)->send(new Validation($name." ".$surname,$code));
                    return redirect(url()->previous());
                }
            }
        }

    
