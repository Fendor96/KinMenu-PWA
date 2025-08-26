<?php

require_once 'connexion.php';


class DataManager {
    private $pdo;
    public function __construct(PDO $pdo){
        $this->pdo = $pdo;
    }

    public function getUserData($id){
        try{
            $sql = "SELECT id,nom, prenom, pseudo, email, telephone, date_inscription as date_dbt, statut_gourmet as statut FROM users WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':id'=>$id]);
            return ['success' =>true, 'message'=> 'recuperer avec success', 'data'=> $stmt->fetch(PDO::FETCH_ASSOC)];

        }catch(PDOException $e){
            ErrorLogs("Erreur lors de la recuperation des données utilisateurs: " .$e->getMessage(), $e->getFile(), $e->getMessage());
            return ['success'=> false, 'message'=> "Erreur. Veuillez essayer plus tard."];
        }catch(Exception $e){
            ErrorLogs("Erreur innatendue dans la recuperation des données utilisateurs" .$e->getMessage(), $e->getFile(), $e->getMessage());
            return ['success'=> false, 'message'=> "Erreur innatendue !. Veuillez essayer plus tard ou vérifier votre connexion internet"];
        }
    }



}
?>
