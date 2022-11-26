<?php

    class FonctionSQL{

//@SQL Fonction sql qui lister les donnees des tables stock
static function  Max_lister_Stock($table, $qnt){
    require './data/connect.php';
        $reqSQL = "SELECT * FROM $table WHERE qnt_restant > 0 LIMIT $qnt ORDER BY id DESC";
        $revenuStatement = $bd->prepare($reqSQL);
        $revenuStatement->execute();
        $rowReq = $revenuStatement->fetchAll();
        
        foreach($rowReq as $line){
            echo '<tr>';
            echo '<th scope="col">'.$line['pouces'].'</th>',"\n";
            echo '<th scope="col">'.$line['categorie'].'</th>',"\n";
            echo '<th scope="col">'.$line['texture'].'</th>',"\n";
            echo '<th scope="col">'.$line['qnt_restant'].'</th>',"\n";
            echo '<th scope="col">'.$line['date__'].'</th>',"\n";
            echo '</tr>';
        }

    }



    static function  Max_lister_Stock_rapport_print($table, $nbr){
        require './data/connect.php';
            $reqSQL = "SELECT * FROM dressup_stock ORDER BY id DESC";
            $revenuStatement = $bd->prepare($reqSQL);
            $revenuStatement->execute();
            $rowReq = $revenuStatement->fetchAll();
             
            foreach($rowReq as $line){
                $lien_desc = "desc_produit.php?barcode= ".$line['code_barre'];
                echo '<tr>';
                echo '<th scope="col"><a href="'. $lien_desc .'">'.$line['code_barre'].'</a></th>',"\n";
                echo '<th scope="col">'.$line['pouces'].'</th>',"\n";
                echo '<th scope="col">'.$line['categorie'].'</th>',"\n";
                echo '<th scope="col">'.$line['texture'].'</th>',"\n";
                echo '<th scope="col">'.$line['qnt_initial'].'</th>',"\n";
                echo '<th scope="col">'.$line['qnt_restant'].'</th>',"\n";
                echo '<th scope="col">'.$line['date__'].'</th>',"\n";
                echo '</tr>';
            }
    
        }
    


// @Fonction SQL qui lister les ventes
    static function  Max_lister_Vente($table, $qnt){
        require './data/connect.php';
        $dateVente = date('Y-m-d');
            $reqSQL = "SELECT * FROM $table WHERE date_vente = :dateVente LIMIT $qnt AND ORDER BY id DESC";
            $revenuStatement = $bd->prepare($reqSQL);
            $revenuStatement->execute([
                'dateVente'=>$dateVente
            ]);
            $rowReq = $revenuStatement->fetchAll();
            
            foreach($rowReq as $line){
                echo '<tr>';
                echo '<th scope="col">'.$line['pouces'].'</th>',"\n";
                echo '<th scope="col">'.$line['categorie'].'</th>',"\n";
                echo '<th scope="col">'.$line['texture'].'</th>',"\n";
                echo '<th scope="col">'.$line['date__'].'</th>',"\n";
                echo '</tr>';
            }

        }
    
// @Function SQl qui permet de rechercher dans les tables 
     static function Rechercher($varR){
        require './data/connect.php';
            $sqlSugestion = $bd->prepare("SELECT * FROM dressup_stock WHERE code_barre LIKE ?");
            $sqlSugestion->execute(array(
                "%$varR%"
            ));
            $rsltRecheche = $sqlSugestion->fetchAll();     
    
            foreach($rsltRecheche as $line){
                $lien_desc = "desc_produit.php?barcode= ".$line['code_barre'];
                echo '<tr>';
                echo '<th scope="col"><a href="'. $lien_desc .'">'.$line['code_barre'].'</a></th>',"\n";
                echo '<th scope="col">'.$line['pouces'].'</th>',"\n";
                echo '<th scope="col">'.$line['categorie'].'</th>',"\n";
                echo '<th scope="col">'.$line['texture'].'</th>',"\n";
                echo '<th scope="col">'.$line['qnt_initial'].'</th>',"\n";
                echo '</tr>';
            }
        }

}

?>