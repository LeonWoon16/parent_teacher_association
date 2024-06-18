<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                <?php endif ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                <?php endif; ?>



        <caption>My Activities</caption>
        <table>

        <tr>
        <th>Activity Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Participants</th>
        <th></th>
        </tr>

        <?php foreach ($participants as $participant): ?>
            <?php if ($participant['fld_pid'] === $userInfo['fld_id']): ?>
                <?php foreach ($activities as $activity): ?>
                    <?php if ($participant['fld_aid'] === $activity['fld_id']): ?>
                        <tr>
                            <td><?= $activity['fld_name']; ?></td>
                            <td><?= $activity['fld_description']; ?></td>
                            <td><?= $activity['fld_date']; ?></td>
                            <td><?= $userInfo['fld_name']; ?></td>
                            <td>
                                <a href="<?= site_url('activitycontroller/unjoin/' . $participant['participantID']) ?>">
                                    <button class="btn-warning">Unjoin</button>
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endforeach; ?>

        </table>


    <br>
                </br>

    <caption>List of Activities Available</caption>
    <table>
    <tr>
        <th>Activity Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Budget</th>
        <th>Requires</th>
        <th>Required Participants</th>
        <th>Current Participants</th>
        <th></th>
    </tr>

    <?php foreach ($activities as $activity): ?>
    <?php
        $activityId = $activity['fld_id'];
        $currentParticipants = 0;
        foreach ($participants as $participant) {
            if ($participant['fld_aid'] === $activityId) {
                $currentParticipants++;
            }
        }

        $remainingVacancy = $activity['fld_participants'] - $currentParticipants;
    ?>

    <tr>
        <td><?= $activity['fld_name']; ?></td>
        <td><?= $activity['fld_description']; ?></td>
        <td><?= $activity['fld_date']; ?></td>
        <td><?= $activity['fld_budget']; ?></td>
        <td><?= $activity['fld_help']; ?></td>
        <td><?= $activity['fld_participants']; ?></td>
        <td><?= $currentParticipants; ?></td>
        <td>
            <?php if ($remainingVacancy > 0): ?>
                <a href="<?= site_url('activitycontroller/join/' . $activityId) ?>">
                    <button>Join</button>
                </a>
            <?php else: ?>
                <?php
                    $message = "No more vacancy for activity: " . $activity['fld_name'];
                    $session->setFlashdata('error', $message);
                ?>
                <span style="color: red;">No more vacancy</span>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>

</table>

</body>

<?= $this->endSection(); ?>
