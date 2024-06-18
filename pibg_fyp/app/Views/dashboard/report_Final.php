<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

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

    th,
    td {
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

<div class="report-card">
    <h1>Student Report Card</h1>
    <?php foreach ($studentInfo as $student): ?>
        <?php foreach ($resultInfo as $result): ?>
            <?php if ($student['fld_id'] === $result['fld_id'] && $result['fld_type'] === 'Final Year'): ?>
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
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>
<a href="UserController/generateReportCardPDF_Final" class="btn btn-primary">Generate PDF</a>

<?= $this->endSection(); ?>
