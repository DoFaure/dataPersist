<?php // index.php
  require_once 'get_db_parameters.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  $query  = "SET NAMES utf8"; // Force l'affichage en utf-8
  $result = $conn->query($query);
  if (!$result) die($conn->error);

  if (isset($_POST['supprimer']) && isset($_POST['isbn']))
  {
    $isbn   = get_post($conn, 'isbn');
    $query  = "DELETE FROM classiques WHERE isbn='$isbn'";
    $result = $conn->query($query);
  	if (!$result) echo "Échec de la suppression : $query<br>" .
      $conn->error . "<br><br>";
  }

  if (isset($_POST['auteur'])    &&
      isset($_POST['titre'])     &&
      isset($_POST['categorie']) &&
      isset($_POST['annee'])     &&
      isset($_POST['isbn']))
  {
    $auteur    = get_post($conn, 'auteur');
    $titre     = get_post($conn, 'titre');
    $categorie = get_post($conn, 'categorie');
    $annee     = get_post($conn, 'annee');
    $isbn      = get_post($conn, 'isbn');
    $query     = "INSERT INTO classiques VALUES" .
      "('$auteur', '$titre', '$categorie', '$annee', '$isbn')";
    $result   = $conn->query($query);

  	if (!$result) echo "Échec de l'insertion : $query<br>" .
      $conn->error . "<br><br>";
  }

  echo <<<_END
  <form action="" method="post"><pre>
    Auteur <input type="text" name="auteur">
     Titre <input type="text" name="titre">
 Catégorie <input type="text" name="categorie">
     Année <input type="text" name="annee">
      ISBN <input type="text" name="isbn">
           <input type="submit" value="AJOUTER FICHE">
  </pre></form>
_END;

  $query  = "SELECT * FROM classiques";
  $result = $conn->query($query);
  if (!$result) die ("Échec de l'accès à la base de données : " . $conn->error);

  $rows = $result->num_rows;
  
  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_NUM);

    echo <<<_END
  <pre>
    Auteur $row[0]
     Titre $row[1]
 Catégorie $row[2]
     Année $row[3]
      ISBN $row[4]
  </pre>
  <form action="" method="post">
  <input type="hidden" name="supprimer" value="yes">
  <input type="hidden" name="isbn" value="$row[4]">
  <input type="submit" value="SUPPRIMER FICHE"></form>
_END;
  }
  
  $result->close();
  $conn->close();
  
  function get_post($conn, $var)
  {
    return $conn->real_escape_string($_POST[$var]);
  }
?>
