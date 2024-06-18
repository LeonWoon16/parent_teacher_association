<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <style>
        .report-card {
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
            /* text-align: center; */
        }

        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }

        .table-container {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        p {
            margin-top: 0;
        }
    </style>
    <meta charset="UTF-8">
    <title>Student Report Card</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Year Enrolled</th>
            <th>IC Number</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentInfo as $student): ?>
            <tr>
                <td><?php echo $student['fld_id']; ?></td>
                <td><?php echo $student['fld_name']; ?></td>
                <td><?php echo $student['fld_class']; ?></td>
                <td><?php echo $student['fld_year']; ?></td>
                <td><?php echo $student['fld_ic']; ?></td>
            </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<br></br>

<h3>Result</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Type</th>
            <th>View</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($studentInfo as $student): ?>
        <?php foreach ($resultInfo as $result): ?>
            <?php if ($result['fld_id'] === $student['fld_id']): ?>
            <tr>
                <td><?php echo $student['fld_id']; ?></td>
                <td><?php echo $student['fld_name']; ?></td>
                <td><?php echo $result['fld_type']; ?></td>


                <td><button type="button" class="btn btn-sm btn-success"data-toggle="modal" data-target="#exampleModal<?= $result['result_id'] ?>">View</button>

                <div class="modal fade" id="exampleModal<?= $result['result_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Report Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="section">
                    <h2>Student Information</h2>
                    <p><strong>Name: </strong><?php echo $student['fld_name']; ?></p>
                    <p><strong>Class: </strong><?php echo $student['fld_class']; ?></p>
                    <p><strong>Result: </strong><?php echo $result['fld_type']; ?></p>
                </div>

                <div class="section">
                    <h2>Grades</h2>
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>Subject</th>
                                <th>Marks</th>
                                <th>Grade</th>
                            </tr>
                            <tr>
                                <td>Malay</td>
                                <td><?php echo $result['fld_bm']; ?></td>
                                <td><?php echo ($result['fld_bm'] >= 80) ? 'A' : (($result['fld_bm'] >= 60) ? 'B' : (($result['fld_bm'] >= 40) ? 'D' : 'E')); ?></td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td><?php echo $result['fld_bi']; ?></td>
                                <td><?php echo ($result['fld_bi'] >= 80) ? 'A' : (($result['fld_bi'] >= 60) ? 'B' : (($result['fld_bi'] >= 40) ? 'D' : 'E')); ?></td>
                            </tr>
                            <tr>
                                <td>History</td>
                                <td><?php echo $result['fld_history']; ?></td>
                                <td><?php echo ($result['fld_history'] >= 80) ? 'A' : (($result['fld_history'] >= 60) ? 'B' : (($result['fld_history'] >= 40) ? 'D' : 'E')); ?></td>
                            </tr>
                            <tr>
                                <td>Mathematics</td>
                                <td><?php echo $result['fld_maths']; ?></td>
                                <td><?php echo ($result['fld_maths'] >= 80) ? 'A' : (($result['fld_maths'] >= 60) ? 'B' : (($result['fld_maths'] >= 40) ? 'D' : 'E')); ?></td>
                            </tr>
                            <tr>
                                <td>Science</td>
                                <td><?php echo $result['fld_science']; ?></td>
                                <td><?php echo ($result['fld_science'] >= 80) ? 'A' : (($result['fld_science'] >= 60) ? 'B' : (($result['fld_science'] >= 40) ? 'D' : 'E')); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="section">
                    <h2>Comments</h2>
                    <p><?php echo $result['fld_description']; ?></p>
                </div>

                    <div class="modal-footer">

                    <button type="button" class="btn btn-tertiary btn-warning" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>




                </td>
            </tr>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</tbody>

</table>


</body>

</html>

<?= $this->endSection();?>
