<?php if(isset($personid)) : ?>

<table class="table">
    <thead>
        <tr>
            <th scope="col">Media ID</th>
            <th scope="col">Media Name</th>
        </tr>
    </thead>
    <tbody>
        <?php

        include "config.php";
        $user_data = check_login($db);
        $sql_statement = "SELECT med_id, med_name FROM Person NATURAL JOIN Stars_in NATURAL JOIN Media WHERE per_id = $personid";
        $result = mysqli_query($db, $sql_statement);

        while($row = mysqli_fetch_assoc($result)) {
            $med_id = $row['med_id']; 
            $med_name = $row['med_name']; 

            echo "<tr>
                    <th scope='row'>$med_id</td>
                    <td><a href='media.php?id=$med_id'>$med_name</a></td>";
        }
        
        ?>
    </tbody>
</table>

<?php else : ?>

Bad request.

<?php endif ; ?>