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
        </table>
    </div>
</div>

