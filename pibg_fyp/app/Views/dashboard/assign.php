<?= $this->extend('layout/dashboard-admin'); ?>
<?= $this->section('content'); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        select, label {
            margin-bottom: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
        .checkbox-group {
            margin-bottom: 5px;
        }
        .checkbox-table {
            width: 100%;
        }
        .checkbox-table th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .checkbox-table td {
            padding: 5px;
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 3px;
        }
        .form-container {
        margin: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .checkbox-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .checkbox-table th,
        .checkbox-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .checkbox-group label {
            display: block;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        } 
    </style>
</head>
<body>

    <div class="form-container">
    <form action="<?php echo site_url('adminController/assignChildren'); ?>" method="post" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="parent_id">Select Parent:</label>
            <select name="parent_id" id="parent_id">
                <option value="" disabled selected>Please select a Parent</option>
                <?php foreach ($parentInfo as $parent): ?>
                    <option value="<?php echo $parent['fld_id']; ?>"><?php echo $parent['fld_name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <table class="checkbox-table">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>IC Number</th>
                    <th>Class</th>
                    <th>Assign</th>
                    <th>Status</th>
                    <th>Parent</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($studentInfo as $student): ?>
                    <tr>
                        <td><?php echo $student['fld_id']; ?></td>
                        <td><?php echo $student['fld_name']; ?></td>
                        <td><?php echo $student['fld_ic']; ?></td>
                        <td><?php echo $student['fld_class']; ?></td>
                        <td>
                            <div class="checkbox-group">
                                <?php
                                // Check if the student is pre-assigned to the selected parent
                                $isPreAssigned = isset($preAssignedChildren[$parent['fld_id']]) && in_array($student['fld_id'], $preAssignedChildren[$parent['fld_id']]);
                                ?>
                                <input type="checkbox" name="children[]" value="<?php echo $student['fld_id']; ?>" id="child<?php echo $student['fld_id']; ?>" <?php if ($isPreAssigned) echo 'checked'; ?>>
                                <label for="child<?php echo $student['fld_id']; ?>"></label>
                            </div>
                        </td>
                        <td><?php echo $student['fld_status']; ?></td>
                        <td><?php echo $student['fld_parent']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <button type="submit">Assign Students</button>
    </form>
</div>

<script>
    function validateForm() {
        var parentSelect = document.getElementById("parent_id");
        if (parentSelect.value === "") {
            alert("Please select a Parent");
            return false;
        }
        var checkboxes = document.getElementsByName("children[]");
        var checked = false;
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                checked = true;
                break;
            }
        }
        if (!checked) {
            alert("Please select at least one Student");
            return false;
        }
        
        return true;
    }
</script>

</body>
</html>

<?= $this->endSection();?>