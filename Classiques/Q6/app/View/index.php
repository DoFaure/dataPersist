<?php

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

  	$rows = $liste->rowCount();
	for ($j = 0 ; $j < $rows ; ++$j){
		$row = $liste->fetch();

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
