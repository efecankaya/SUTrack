<?php if(isset($mediaid)) : ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Person ID</th>
            <th scope="col">Actor Name</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include "config.php";
        $med_id = $_GET['id'];
        $sql_statement = "SELECT per_id, per_name FROM Person NATURAL JOIN Stars_in NATURAL JOIN Media WHERE per_role = 'Actor' AND med_id = $mediaid";
        $result = mysqli_query($db, $sql_statement);
        
        while($row = mysqli_fetch_assoc($result)) {
            $per_id = $row['per_id']; 
            $per_name = $row['per_name']; 
            echo "<tr>
                    <th scope='row'>$per_id</th>
                    <td><a href='person.php?id=$per_id'>$per_name</a></td>";
        }
        
        ?>
    </tbody>
</table>

<?php else : ?>

    Bad request.

<?php endif ; ?>