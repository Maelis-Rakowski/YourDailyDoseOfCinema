<div class="profile">
<?php $this->_t="User Details"?>

    <div class="content">
        <h2 ><?= $user->getPseudo() ?></h2>
        <p><?= $user->getEmail() ?></p>
        <table class="dataList">
            <tr>
                <th>Date</th>
                <th>Try Number</th>
                <th>Solution</th>
            </tr>
            <tr>
                <td><?= date("Y-m-d"); ?></td>
                <td><?= $_SESSION['nbTries']; ?></td>
                <td></td> <!-- La colonne solution est laissée vide ou vous pouvez y ajouter des données pertinentes -->
            </tr>
            
        </table>
    </div>
</div>

