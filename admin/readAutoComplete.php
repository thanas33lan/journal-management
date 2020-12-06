<?php
session_start();
error_reporting(0);
include('includes/config.php');

 
    if(!empty($_POST["keyword"])) {
        
        $keyword =  $_POST['keyword'];
        $sql = ('SELECT author_details.author_id,author_details.first_author,author_details.title,author_details.journal_name,author_details.year_published,author_details.status, author_details.created_by, users.id,users.name, users.email, users.gender from author_details LEFT JOIN users ON author_details.created_by = users.id WHERE author_details.journal_name LIKE :keyword OR users.name LIKE :keyword');
        $query   = $dbh -> prepare($sql);
        $keyword = "%".$keyword."%";
        $query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);

        if(!empty($results)) {
        ?>
        <ul id="autocomplete-list">
            <?php
            foreach($results as $search) {

                if(isset($search->journal_name) && $search->journal_name != ""){
                    $show = htmlentities($search->journal_name);
                } else{
                    $show = htmlentities($search->name);
                }
            ?>
                <li onClick="selectAutoSearch('<?php echo $show; ?>');">
                    <?php echo $show; ?>
                </li>
            <?php
            }
            ?>
        </ul>
        <?php }
        } ?>
