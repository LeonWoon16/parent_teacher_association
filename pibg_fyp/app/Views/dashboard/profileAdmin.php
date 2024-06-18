<?= $this->extend('layout/dashboard-admin'); ?>
<?= $this->section('content'); ?>

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
        cursor: pointer;
    }

    th {
        background-color: #f2f2f2;
    }
</style>

<body>
    <h3>List of Teachers</h3>
    <table>
        <thead>
            <tr>
                <th data-sort="name">Name</th>
                <th data-sort="email">Email Address</th>
                <th data-sort="phone">Phone Number</th>
                <th data-sort="address">Address</th>
                <th data-sort="dob">Date of Birth</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teacherInfo as $teacher): ?>
                <tr>
                    <td><?= $teacher['fld_name']; ?></td>
                    <td><?= $teacher['fld_email']; ?></td>
                    <td><?= $teacher['fld_phone']; ?></td>
                    <td><?= $teacher['fld_address']; ?></td>
                    <td><?= $teacher['fld_dob']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>

    <h3>List of Students and Parents</h3>
    <table>
        <thead>
            <tr>
                <th data-sort="id">ID</th>
                <th data-sort="name">Name</th>
                <th data-sort="class">Class</th>
                <th data-sort="year">Year Enrolled</th>
                <th data-sort="ic">IC Number</th>
                <th data-sort="parent">Parent</th>
                <th>Profile</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($studentInfo as $student): ?>
                <tr>
                    <td><?= $student['fld_id']; ?></td>
                    <td><?= $student['fld_name']; ?></td>
                    <td><?= $student['fld_class']; ?></td>
                    <td><?= $student['fld_year']; ?></td>
                    <td><?= $student['fld_ic']; ?></td>
                    <td><?= $student['fld_parent']; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal"
                            data-target="#example<?= $student['fld_id'] ?>">Details</button>
                        <!-- Modal -->
                        <div class="modal fade" id="example<?= $student['fld_id'] ?>" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Student's Profile</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php $studentId = $student['fld_id']; ?>
                                        <?php foreach ($studentInfo as $student): ?>
                                        <?php if ($student['fld_id'] === $studentId): ?>
                                        <ul>
                                            <li><strong>ID:</strong> <?= $student['fld_id'] ?></li>
                                            <li><strong>Name:</strong> <?= $student['fld_name'] ?></li>
                                            <li><strong>Class:</strong> <?= $student['fld_class'] ?></li>
                                            <li><strong>Year Enrolled:</strong> <?= $student['fld_year'] ?></li>
                                            <li><strong>IC Number:</strong> <?= $student['fld_ic'] ?></li>
                                            <li><strong>Gender:</strong> <?= $student['fld_gender'] ?></li>
                                            <li><strong>Parent:</strong> <?= $student['fld_parent'] ?></li>
                                            <?php foreach ($parentInfo as $parent): ?>
                                            <?php if ($parent['fld_name'] === $student['fld_parent']): ?>
                                            <li><strong>Phone:</strong> <?= $parent['fld_phone'] ?></li>
                                            <li><strong>Email:</strong> <?= $parent['fld_email'] ?></li>
                                            <li><strong>Address:</strong> <?= $parent['fld_address'] ?></li>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                            <li><strong>Date of Birth:</strong> <?= $student['fld_dob'] ?></li>
                                        </ul>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-tertiary btn-warning"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('th').click(function () {
            var table = $(this).closest('table');
            var index = $(this).index();
            var rows = table.find('tbody tr').toArray().sort(comparator(index));
            this.asc = !this.asc;
            if (!this.asc) {
                rows = rows.reverse();
            }
            for (var i = 0; i < rows.length; i++) {
                table.find('tbody').append(rows[i]);
            }
        });

        function comparator(index) {
            return function (a, b) {
                var valA = $(a).find('td').eq(index).text().toUpperCase();
                var valB = $(b).find('td').eq(index).text().toUpperCase();
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
            };
        }
    });
</script>

<?= $this->endSection(); ?>
