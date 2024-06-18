<?= $this->extend('layout/dashboard-admin'); ?>
<?= $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .chart-container {
        width: 100%;
        display: flex;
        justify-content: space-between;
    }

    .chart {
        width: 45%;
        height: 300px;
        margin-bottom: 20px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>RM <?php echo $totalSum; ?></h3>
                <p>Funds Received</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $totalActivity; ?></h3>
                <p>Activities Ongoing</p>
            </div>
            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>
        </div>
    </div>
</div>

<table>
    <tr>
        <th>Name</th>
        <th>Activity</th>
        <th>Amount (RM)</th>
        <th>Date</th>
    </tr>
    <?php foreach ($crowdfundingInfo as $crowdfunding): ?>
        <?php foreach ($activityInfo as $activity): ?>
            <?php foreach ($parentInfo as $parent): ?>
                <?php if ($crowdfunding['fld_aid'] === $activity['fld_id'] && $crowdfunding['fld_pid'] === $parent['fld_id']): ?>
                    <tr>
                        <td><?php echo $parent['fld_name']; ?></td>
                        <td><?php echo $activity['fld_name']; ?></td>
                        <td><?php echo $crowdfunding['fld_money']; ?></td>
                        <td><?php echo $crowdfunding['fld_date']; ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</table>

<br></br>

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

<br></br>

<div class="chart-container">
    <div class="chart">
        <canvas id="activityChart" width="400" height="300"></canvas>
    </div>
    <div class="chart">
        <canvas id="moneyChart" width="400" height="300"></canvas>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

        <?php
        // Initialize an array to hold the total fld_money for each activity
        $activityTotals = [];

        foreach ($activityInfo as $activity) {
            $totalMoney = 0;

            foreach ($crowdfundingInfo as $crowdfunding) {
                if ($crowdfunding['fld_aid'] === $activity['fld_id']) {
                    $totalMoney += $crowdfunding['fld_money'];
                }
            }

            $activityTotals[] = $totalMoney;
        }
        ?>

        // Retrieve the activity totals from PHP
        var activityTotals = <?php echo json_encode($activityTotals); ?>;

        // Create the pie chart
        var ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode(array_column($activityInfo, 'fld_name')); ?>,
                datasets: [{
                    data: activityTotals,
                    backgroundColor: [
                        '#ff6384',
                        '#36a2eb',
                        '#cc65fe',
                        '#ffce56',
                        '#e18012',
                        '#2e8b57',
                        '#8b5843',
                        // Add more colors if needed
                    ],
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            },
        });

        // Prepare data for the line chart
        var lineData = {
            labels: [],
            datasets: []
        };

        <?php foreach ($activityInfo as $activity): ?>
            var activityDataset = {
                label: '<?php echo $activity['fld_name']; ?>',
                data: [],
                fill: false,
                borderColor: getRandomColor(),
                tension: 0.1
            };

            <?php foreach ($crowdfundingInfo as $crowdfunding): ?>
                <?php if ($crowdfunding['fld_aid'] === $activity['fld_id']): ?>
                    lineData.labels.push('<?php echo $crowdfunding['fld_date']; ?>');
                    activityDataset.data.push(<?php echo $crowdfunding['fld_money']; ?>);
                <?php endif; ?>
            <?php endforeach; ?>

            lineData.datasets.push(activityDataset);
        <?php endforeach; ?>

        // Create the line chart
        var lineCtx = document.getElementById('moneyChart').getContext('2d');
        new Chart(lineCtx, {
            type: 'line',
            data: lineData,
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Generate a random color for each activity
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    });
</script>

<?= $this->endSection(); ?>
