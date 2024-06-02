<div class="container mt-5">
<?php $this->_t="User Details"?>
    <div class="border shadow-sm p-3 mb-5 bg-white rounded">
        <h2 class="text-dark" ><?= $user->getPseudo() ?></h2>
        <p class="text-dark" ><?= $user->getEmail() ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Tries</th>
                    <th>Solution</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userHistories as $userHistory):?>
                <tr>
                    <td><?= htmlspecialchars($userHistory->getDailyMovie()->getDate()) ?></td>
                    <td><?= htmlspecialchars($userHistory->getTryNumber()) ?></td>
                    <td>
                    <?php if ($userHistory->getSuccess()) {?>
                        <?= htmlspecialchars($userHistory->getDailyMovie()->getMovie()->getTitle()) ?>
                    <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
