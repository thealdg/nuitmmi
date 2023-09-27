<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Allow;
use App\Mail\Deny;
use Illuminate\Support\Facades\Mail;
class Works extends Controller
{
    function participate(){
        if(!session()->has("id")){
            return redirect(route("login"));
        }else if(!isset($_POST["title"])){
                session(["error"=>"Erreur lors de l'insertion du titre, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["context"]) or !in_array($_POST["context"],["SAE","Projet personnel","Projet scolaire"])){
                session(["error"=>"Erreur dans l'insertion du contexte de réalisation, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["description"])) {
                session(["error"=>"Erreur lors de l'insertion de la description, veuillez recommencer."]);
                return back();
            } else if(!isset($_FILES["thumbnail"])){
                session(["error"=>"Erreur lors de l'insertion de la miniature, veuillez recommencer."]);
                return back();
            } else if(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION)!="png" and pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION)!="jpg"){
                session(["error"=>"La miniature n'est pas au format png ou jpg, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["category"]) or !in_array($_POST["category"],["1","2","3","4","5","6"])){
                session(["error"=>"Erreur lors de l'insertion de la catégorie, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["date"]) or strlen($_POST["date"])!=10 or $_POST["date"] > date("Y-m-d")){
                session(["error"=>"Erreur lors de l'insertion de la date, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["authors"])){
                session(["error"=>"Erreur lors de l'insertion du/des auteur(s), veuillez recommencer."]);
                return back();
            } else if(!empty($_POST["video"]) and (!filter_var($_POST["video"],FILTER_VALIDATE_URL) or (!str_contains($_POST["video"],"https://www.youtube.com/watch?v=") and !str_contains($_POST["video"],"https://youtu.be/")))){
                    session(["error"=>"Erreur lors de l'insertion du lien YouTube, veuillez recommencer."]);
                    return back();
            
            } else if(!empty($_POST["link"]) and !filter_var($_POST["link"],FILTER_VALIDATE_URL)){
                    session(["error"=>"Erreur lors de l'insertion du lien externe, veuillez recommencer."]);
                    return back();
            
            } else if(!isset($_POST["conditions"])){
                session(["error"=>"Veuillez accepter les conditions générales de publication"]);
                    return back();
            }
            else if(!isset($_POST["tools"])){
                session(["error"=>"Erreur lors de l'insertion des outils et logiciels, veuillez recommencer."]);
                return back();
            } else {
                $line = DB::select("SELECT * FROM validation WHERE validation.idUser = ? AND validation.idCategory = ? AND (validation.result is NULL or validation.result = 1);",[session("id"),$_POST["category"]]);
                if(!empty($line)){
                    session(["error"=>"Une oeuvre dans cette catégorie est déjà validée ou est en cours de validation."]);
                    return back();
                } else {
                    $path = "images/upload/".time()."_".session("id").".".pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES["thumbnail"]["tmp_name"],public_path($path));
                    DB::insert("INSERT INTO works (authors,date,description,name,thumbnail,tools, context) VALUES (?,?,?,?,?,?,?);",[$_POST["authors"],$_POST["date"],$_POST["description"],$_POST["title"],$path,$_POST["tools"],$_POST["context"]]);
                    $id = DB::select("SELECT LAST_INSERT_ID() as id;")[0]->id;
                    DB::insert("INSERT INTO validation (idUser,idCategory,idWork) VALUES (?,?,?);",[session("id"),$_POST["category"],$id]);
                    if(!empty($_POST["video"])){
                        $video_url = substr($_POST["video"],-11);
                        DB::update("UPDATE works SET video = ? WHERE id = ?",[$video_url,$id]);
                    }
                    if(!empty($_POST["link"])){
                        DB::update("UPDATE works SET link = ? WHERE id = ?",[$_POST["link"],$id]);
                    }
                    if(isset($_POST["competition"])){
                        DB::update("UPDATE works SET competition = 1 WHERE id = ?",[$id]);
                    }
                    return redirect("/");
                }
            }
    }
    function allow($id){
        if(!session()->has("admin")){
            return redirect("/");
        } else {
            DB::update("UPDATE validation SET result = 1 WHERE idWork = ?",[$id]);
            $infos = DB::select("SELECT users.name AS userName, users.email, users.surname AS userSurname, categories.name AS category, works.name AS workName, works.competition FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idWork = ?",[$id])[0];
            Mail::to($infos->email)->send(new Allow($infos));
            return back();
        }
    }
    function deny(){
        if(!session()->has("admin")){
            return redirect("/");
        } else {
            if(!isset($_POST["reasons"]) and !isset($_POST["more_reasons"])){
                session(["error"=>"Aucune raison n'a été entrée, veuillez recommencer."]);
                return back();
            } else {
                $reasons = "";
                if(isset($_POST["reasons"])){
                    foreach($_POST["reasons"] as $reason){
                        if(in_array($reason, ["Atteinte aux droits d'auteurs","Non respect des conditions de participation","Oeuvre non neutre"])){
                            $reasons = $reasons.$reason."<br>";
                        }
                    }
                } else {
                    $reasons = $reasons."Autre's) raison(s)";
                }
                DB::update("UPDATE validation SET result = 0, commentary = ? WHERE validation.idWork = ?",[$reasons,$_POST["id"]]);
                $infos = DB::select("SELECT users.name AS userName, users.email, users.surname AS userSurname, categories.name AS category, works.name AS workName, works.competition FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idWork = ?",[$_POST["id"]])[0];
                if(isset($_POST["more_reasons"])){
                    $reasons = ["reasons" => $reasons, "more_reasons"=>$_POST["more_reasons"]];
                } else {
                    $reasons = ["reasons"=>$reasons];
                }
                Mail::to($infos->email)->send(new Deny($infos,$reasons));
                return back();

            }
        }
    }
}
