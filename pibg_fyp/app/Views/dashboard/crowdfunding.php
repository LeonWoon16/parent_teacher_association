<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Donation</title>
    <style>
       
        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select,
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
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
        } */

        .edit-button {
            padding: 8px 16px;
            background-color: orange;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <th>Activity</th>
        <th>Budget</th>
        <th>Total Amount (RM)</th>
        <th>Amount Required</th>
        <th>Target</th>
    </tr>
    <?php foreach ($activityInfo as $activity): ?>
        <?php
        // Calculate the total amount for the current activity
        $totalAmount = 0;
        foreach ($crowdfundingInfo as $crowdfunding) {
            if ($crowdfunding['fld_aid'] === $activity['fld_id']) {
                $totalAmount += $crowdfunding['fld_money'];
            }
        }
        $amountRequired = $activity['fld_budget'] - $totalAmount;
        ?>
        
        <tr>
            <td><?php echo $activity['fld_name']; ?></td>
            <td><?php echo $activity['fld_budget']; ?></td>
            <td><?php echo $totalAmount; ?></td>
            <td><?php echo $amountRequired; ?></td>
            <td>
                <?php if ($amountRequired <= 0): ?>
                    Achieved
                <?php else: ?>
                    Not achieved yet
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<br>
    </br>

    <form action="<?php echo base_url('crowdfundingcontroller/donate'); ?>" method="GET">

    <?=csrf_field(); ?>

                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

        <label for="username">Name:</label>
        <input type="text" name="username" id="username" value="<?= $userInfo['fld_name']; ?>" readonly>

        <label for="activity">Activity available for funding:</label>
        <select name="activity" id="activity">
            <?php foreach ($activityInfo as $activity): ?>
                <option value="<?php echo $activity['fld_id']; ?>"><?php echo $activity['fld_name']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="amount">Enter the funding amount (RM):</label>
        <input type="text" name="amount" id="amount" pattern="[0-9]+" placeholder="Please enter the amount (RM)" required>
        <input type="submit" value="Donate">
    </form>


    <br>
            </br>

            <h3>Activities Funded</h3>
    <table>
        <tr>
            <th>Activity</th>
            <th>Amount(RM)</th>
            <th>Date</th>
        </tr>
        <?php foreach ($crowdfundingInfo as $crowdfunding): ?>
                <?php if ($crowdfunding['fld_pid'] === $loggedUserID): ?>
            <tr>
                <td><?php echo $crowdfunding['fld_activity']; ?></td>
                <td><?php echo $crowdfunding['fld_money']; ?></td>
                <td><?php echo $crowdfunding['fld_date']; ?></td>
            </tr>
                <?php endif; ?>
        <?php endforeach; ?>
    </table>

</body>
</html>

<?= $this->endSection(); ?>