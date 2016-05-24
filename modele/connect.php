

<?php

if(!isset($_GET['login']) && !isset($_GET['motdepasse']))
{
    header('Location: ../view/auth_view.php');
}
else
{

        require('config.php'); // On réclame le fichier

        $login = $_GET['login'];
        $motdepassetest = $_GET['motdepasse'];
        $motdepasse=$motdepassetest;

        $sql = "SELECT * FROM utilisateur WHERE user='".mysqli_escape_string($con, $login)."'";

        // On vérifie si ce login existe
        $requete_1 = mysqli_query($con, $sql) or die ( mysqli_error($con) );

        if(mysqli_num_rows($requete_1)==0)
        {
            echo 'Ce login n existe pas ! <br/>';
            echo '<a href="../view/auth_view.php" temp_href="../view/auth_view.php">Réessayer</a>';
            exit();
        }
        else
        {
            // On vérifie si le login et le mot de passe correspondent au compte utilisateur
            $requete_2 = mysqli_query($con, $sql." AND pass='". $motdepasse."'")
or die ( mysqli_error($con) );

            if(mysqli_num_rows($requete_2)==0)
            {




                    echo 'Le mot de passe et/ou le login sont incorrectes <br/>';
                    echo '<a href="../view/auth_view.php" href="../view/auth_view.php">Réessayer</a>';
                    exit();

            }
        else
        {
            // On va récupérer les résultats
            $result = mysqli_fetch_array($requete_2, MYSQLI_ASSOC);


            // On redirige vers la partie membre
            header('Location: ../view/index_admin.html');
        }
    }

}
?>