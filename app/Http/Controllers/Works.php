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
        } else {
            $allow = true;
            $participate = [];
        }
        if(!isset($_POST["title"])){
            session(["error"=>"Erreur lors de l'insertion du titre, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["title"] = $_POST["title"];
        }
        if(!isset($_POST["context"]) or !in_array($_POST["context"],["SAE","Projet personnel","Projet scolaire"])){
            session(["error"=>"Erreur dans l'insertion du contexte de réalisation, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["context"] = $_POST["context"];
        }
        if(!isset($_POST["description"])) {
            session(["error"=>"Erreur lors de l'insertion de la description, veuillez recommencer."]);
            $allow = false;
        } else {
            $participate["description"] = $_POST["description"];
        }
        if(strlen($_POST["description"]) > 600){
            session(["error"=>"La description dépasse les 600 caractères, veuillez recommencer."]);
            $allow = false;
        } 
        if(!isset($_FILES["thumbnail"])){
            session(["error"=>"Erreur lors de l'insertion de la miniature, veuillez recommencer."]);
            $allow = false;
        } 
        if(pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION)!="png" and pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION)!="jpg" and pathinfo($_FILES['thumbnail']['name'], PATHINFO_EXTENSION)!="jpeg"){
            session(["error"=>"La miniature n'est pas au format png ou jpg, veuillez recommencer."]);
            $allow = false;
        } 
        $uploadedImage = getimagesize($_FILES["thumbnail"]["tmp_name"]);
        if($uploadedImage[0]!=1920 || $uploadedImage[1]!=1080){
            session(["error"=>"La miniature doit être au dimension 1920x1080, veuillez recommencer."]);
            $allow = false;
        }
        if(!isset($_POST["category"]) or !in_array($_POST["category"],["1","2","3","4"])){
            session(["error"=>"Erreur lors de l'insertion de la catégorie, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["category"] = $_POST["category"];
        }
        if($_POST["category"]=="1" && !isset($_POST["video"])){
            session(["error"=>"Un lien vidéo est obligatoire afin de participer dans la catégorie Audiovisuel, veuillez recommencer."]);
            $allow = false;
        } 
        if($_POST["category"]=="2" && (!isset($_FILES["proof"]) or !isset($_POST["video"]))){
            session(["error"=>"Une archive prouvant l'authenticité de votre réalisation, ainsi qu'une vidéo explicative, sont obligatoires afin de participer dans la catégorie Campagne de Communcation, veuillez recommencer."]);
            $allow = false;
        } 
        if($_POST["category"]=="3" && !isset($_FILES["proof"])){
            session(["error"=>"Une archive prouvant l'authenticité de votre réalisation est obligatoire afin de participer dans la catégorie Production Graphique, veuillez recommencer."]);
            $allow = false;
        } 
        if($_POST["category"]=="4" && (!isset($_FILES["proof"]) or !isset($_POST["link"]))){
            session(["error"=>"Une archive prouvant l'authenticité de votre réalisation, ainsi qu'un lien d'accès, sont obligatoires afin de participer dans la catégorie Campagne de Communcation, veuillez recommencer."]);
        } 
        if(isset($_FILES["proof"]) && pathinfo($_FILES['proof']['name'], PATHINFO_EXTENSION) !="zip" && pathinfo($_FILES['proof']['name'], PATHINFO_EXTENSION)!="rar"){
            session(["error"=>"L'archive doit être au format rar ou zip, veuillez recommencer."]);
            $allow = false;
        } 
        if(!isset($_POST["date"]) or strlen($_POST["date"])!=10 or $_POST["date"] > date("Y-m-d")){
            session(["error"=>"Erreur lors de l'insertion de la date, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["date"] = $_POST["date"];
        }
        if(!isset($_POST["authors"])){
            session(["error"=>"Erreur lors de l'insertion du/des auteur(s), veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["authors"] = $_POST["authors"];
        }
        if(!empty($_POST["video"]) and (!filter_var($_POST["video"],FILTER_VALIDATE_URL) or (!str_contains($_POST["video"],"https://www.youtube.com/watch?v=") and !str_contains($_POST["video"],"https://youtu.be/")))){
            session(["error"=>"Erreur lors de l'insertion du lien YouTube, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["video"] = $_POST["video"];
        }
        if(!empty($_POST["link"]) and !filter_var($_POST["link"],FILTER_VALIDATE_URL)){
            session(["error"=>"Erreur lors de l'insertion du lien externe, veuillez recommencer."]);
            $allow = false;
        } else{
            $participate["link"] = $_POST["link"];
        }
        if(!isset($_POST["conditions"])){
            session(["error"=>"Veuillez accepter les conditions générales de publication"]);
            $allow = false;
        } else{
            $participate["conditions"] = $_POST["conditions"];
        }
        if(!isset($_POST["tools"])){
            session(["error"=>"Erreur lors de l'insertion des outils et logiciels, veuillez recommencer."]);
            $allow = false;
        } else {
            $participate["tools"] = $_POST["tools"];
            if(!$allow){
                session(["participate"=>$participate]);
                return back();
            } else {
                $line = DB::select("SELECT * FROM validation WHERE validation.idUser = ? AND validation.idCategory = ? AND (validation.result is NULL or validation.result = 1);",[session("id"),$_POST["category"]]);
                if(!empty($line)){
                    session(["error"=>"Une oeuvre dans cette catégorie est déjà validée ou est en cours de validation."]);
                    return back();
                } else {
                    $thumbnailPath = "images/upload/thumbnails/".time()."_".session("id").".".pathinfo($_FILES["thumbnail"]["name"], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES["thumbnail"]["tmp_name"],public_path($thumbnailPath));
                    DB::insert("INSERT INTO works (authors,date,description,name,thumbnail,tools, context) VALUES (?,?,?,?,?,?,?);",[$_POST["authors"],$_POST["date"],$_POST["description"],$_POST["title"],$thumbnailPath,$_POST["tools"],$_POST["context"]]);
                    $id = DB::select("SELECT LAST_INSERT_ID() as id;")[0]->id;
                    DB::insert("INSERT INTO validation (idUser,idCategory,idWork) VALUES (?,?,?);",[session("id"),$_POST["category"],$id]);
                    if(!empty($_POST["video"])){
                        DB::update("UPDATE works SET video = ? WHERE id = ?",[$_POST["video"],$id]);
                    }
                    if(!empty($_POST["link"])){
                        DB::update("UPDATE works SET link = ? WHERE id = ?",[$_POST["link"],$id]);
                    }
                    if(isset($_POST["competition"])){
                        DB::update("UPDATE works SET competition = 1 WHERE id = ?",[$id]);
                    }
                    if(isset($_FILES["proof"])){
                        $proofPath = "proofs/upload/".time()."_".session("id").".".pathinfo($_FILES["proof"]["name"], PATHINFO_EXTENSION);
                        move_uploaded_file($_FILES["proof"]["tmp_name"],public_path($proofPath));
                        DB::update("UPDATE validation SET proof = ? WHERE idWork = ?",[$proofPath,$id]);
                    }
                    session()->forget("participate");
                    return redirect(route("profil")."?oeuvres");
                }
            }
        }
    }
    function allow($id){
        if(!session()->has("admin")){
            abort("404");
        } else {
            $query = DB::select("SELECT * FROM works WHERE id = ?",[$id]);
            if(empty($query)){
                abort("404");
            } 
            DB::update("UPDATE validation SET result = 1 WHERE idWork = ?",[$id]);
            $infos = DB::select("SELECT users.name AS userName, users.email, users.surname AS userSurname, categories.name AS category, works.name AS workName, works.competition FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idWork = ?",[$id])[0];
            Mail::to($infos->email)->send(new Allow($infos));
            return redirect(route("moderation"));
        }
    }
    function deny(){
        if(!session()->has("admin")){
            abort("404");
        } else {
            if(!isset($_POST["more_reasons"])){
                session(["error"=>"Aucune raison n'a été entrée, veuillez recommencer."]);
                return back();
            } else if(!isset($_POST["id"])){
                return back();
            } else {
                DB::update("UPDATE validation SET result = 0, commentary = ? WHERE validation.idWork = ?",[$_POST["more_reasons"],$_POST["id"]]);
                $infos = DB::select("SELECT users.name AS userName, users.email, users.surname AS userSurname, categories.name AS category, works.name AS workName, works.competition FROM users JOIN validation ON users.id = validation.idUser JOIN works ON validation.idWork = works.id JOIN categories ON validation.idCategory = categories.id WHERE validation.idWork = ?",[$_POST["id"]])[0];
                Mail::to($infos->email)->send(new Deny($infos,$_POST["more_reasons"]));
                return redirect(route("moderation"));
            }

        }
    }
}



