<?php 
session_start();
$bdd=new PDO('mysql:host=localhost;dbname=espaces_membre;charset=utf8;','root','');
if(isset($_POST['envoi'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $mdp=sha1($_POST['mdp']);
        $insertUser=$bdd->prepare('INSERT INTO users(pseudo,mdp) VALUES (?,?)');
        $insertUser->execute(array($pseudo,$mdp));

        $recupUser=$bdd->prepare('SELECT * From users where pseudo=? and mdp=? order by idU' );
        $recupUser->execute(array($pseudo,$mdp));
        if($recupUser->rowCount() >0){
            $_SESSION['pseudo']=$pseudo;
            $_SESSION['mdp']=$mdp;
            $_SESSION['idU']=$recupUser->fetch()['idU'];

        }

        
    }
    else{
        echo "Veuillez Completer tous les champs...";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <label for="pseudo">PSEUDO</label>
    <input type="text" name="pseudo" autocomplete="off">
</br>
<label for="mdp">MOT DE PASSE</label>
    <input type="password" name="mdp" autocomplete="off">
</br></br>
    <input type="submit" name="envoi">
    </form>
</body>
</html>