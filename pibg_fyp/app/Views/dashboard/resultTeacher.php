<?= $this->extend('layout/dashboard-teacher'); ?>
<?= $this->section('content'); ?>
<!-- app/Views/results/form.php -->
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

    <form action="TeacherController/saveResult" method="post">

    <?=csrf_field(); ?>

                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

    <div class="form-group" id="class">
        <label for="class">Choose Class:</label>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <?php
            $uniqueClasses = array_unique(array_column($studentInfo, 'fld_class'));
            foreach ($uniqueClasses as $class): ?>
                <label class="btn bg-olive ">
                    <input type="radio" name="class" autocomplete="off" value="<?php echo $class; ?>"><?php echo $class; ?>
                </label>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <label for="student_id">Select Student:</label>
        <select class="form-control" name="student_id" id="student_id" required>
            <option value="" disabled selected>Please select a Student</option>
            <?php foreach ($studentInfo as $student): ?>
                <option data-class="<?php echo $student['fld_class']; ?>" value="<?php echo $student['fld_id']; ?>"><?php echo $student['fld_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="result_type">Result Type:</label>
        <select class="form-control" name="result_type" id="result_type">
            <option value="Mid Year">Mid Year</option>
            <option value="Final Year">Final Year</option>
            <option value="Outdoor Assessment">Outdoor Assessment</option>
            <option value="Indoor Assessment">Indoor Assessment</option>
            <option value="Quiz">Quiz</option>
            <option value="Assignment">Assignment</option>
        </select>
    </div>

    <script>
        $(document).ready(function() {
            $('input[name="class"]').on('change', function() {
                var selectedClass = $(this).val();
                $('#student_id option').each(function() {
                    var studentClass = $(this).data('class');
                    if (selectedClass === studentClass || selectedClass === '') {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>

   
    <div class="form-group">
        <label for="malay">Malay:</label>
        <input type="number" class="form-control" name="malay" id="malay" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="science">Science:</label>
        <input type="number" class="form-control" name="science" id="science" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="maths">Maths:</label>
        <input type="number" class="form-control" name="maths" id="maths" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="history">History:</label>
        <input type="number" class="form-control" name="history" id="history" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="english">English:</label>
        <input type="number" class="form-control" name="english" id="english" min="0" max="100" required>
    </div>

    <div class="form-group">
        <label for="description">Description: </label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Save Result</button>
    <button class="btn btn-secondary" style="margin-left: 15px" type="reset">Reset</button>
</form>

    <br>
</br>
<table class="table">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Class</th>
            <th>Type</th>
            <th>Science</th>
            <th>Maths</th>
            <th>History</th>
            <th>English</th>
            <th>Malay</th>
            <th>Total Marks</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($resultInfo as $result): ?>
            <tr>
            <?php foreach ($studentInfo as $student): ?>
                    <?php if ($result['fld_id'] === $student['fld_id']): ?>
                <td><?php echo $result['fld_id']; ?></td>
                <td><?php echo $student['fld_name'] ?></td>
                <td><?php echo $student['fld_class'] ?></td>
                <td><?php echo $result['fld_type']; ?></td>
                <td><?php echo $result['fld_science']; ?></td>
                <td><?php echo $result['fld_maths']; ?></td>
                <td><?php echo $result['fld_history']; ?></td>
                <td><?php echo $result['fld_bi']; ?></td>
                <td><?php echo $result['fld_bm']; ?></td>
                <td><?php echo $result['fld_marks']; ?></td>
                <td><?php echo $result['fld_description']; ?></td>
                <td><button type="button" class="btn btn-sm btn-warning"data-toggle="modal" data-target="#exampleModal<?= $result['result_id'] ?>">Edit</button>
                    <a href="<?= base_url('TeacherController/delete/'.$result['result_id']) ?>" class="btn btn-danger btn-sm">Delete</a>

<!-- Modal -->
<div class="modal fade" id="exampleModal<?= $result['result_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Result</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

        <form action="<?= base_url('Teachercontroller/updateResult/'.$result['result_id']) ?>" method="post">

        <?=csrf_field(); ?>

                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

        <div class="form-group">
        <label for="name">Student ID</label>
        <input type="text" class="form-control" id="id" name="id" value="<?= $result['fld_id']; ?>" readonly >
        </div>

        <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $student['fld_name']; ?>" readonly>
        </div>

        <div class="form-group">
        <label for="name">Class</label>
        <input type="text" class="form-control" id="class" name="class" value="<?= $student['fld_class']; ?>" readonly>
        </div>

        <div class="form-group">
        <label for="name">Result Type</label>
        <input type="text" class="form-control" id="type" name="type" value="<?= $result['fld_type']; ?>" readonly>
        </div>

        <div class="form-group">
        <label for="malay">Malay:</label>
        <input type="number" class="form-control" name="malay" id="malay" min="0" max="100" value="<?= $result['fld_bm']; ?>" required>
        </div>

        <div class="form-group">
            <label for="science">Science:</label>
            <input type="number" class="form-control" name="science" id="science" min="0" max="100" value="<?= $result['fld_science']; ?>" required>
        </div>

        <div class="form-group">
            <label for="maths">Maths:</label>
            <input type="number" class="form-control" name="maths" id="maths" min="0" max="100" value="<?= $result['fld_maths']; ?>" required>
        </div>

        <div class="form-group">
            <label for="history">History:</label>
            <input type="number" class="form-control" name="history" id="history" min="0" max="100" value="<?= $result['fld_history']; ?>" required>
        </div>

        <div class="form-group">
            <label for="english">English:</label>
            <input type="number" class="form-control" name="english" id="english" min="0" max="100" value="<?= $result['fld_bi']; ?>" required>
        </div>

        <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" required ><?= $result['fld_description']; ?> </textarea>
        </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="margin-right: 0px">Save changes</button>
            <button class="btn btn-secondary" type="reset"  style="margin-right: 185px">Reset</button>
            <button type="button" class="btn btn-tertiary btn-warning" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>

    </div>
</div>
</div>
</td> 


                <?php endif; ?>
            <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>