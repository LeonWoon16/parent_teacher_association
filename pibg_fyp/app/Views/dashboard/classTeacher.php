<?= $this->extend('layout/dashboard-teacher'); ?>
<?= $this->section('content'); ?>

<style>
.table {
  width: 100%;
  border-collapse: collapse;
}

.table th, .table td {
  padding: 8px;
  border: 1px solid #ccc;
}

.table thead {
  background-color: #f2f2f2;
  cursor: pointer;
}

.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #eaeaea;
}

.asc:after {
  content: ' ▲';
}

.desc:after {
  content: ' ▼';
}
</style>

<form method="get" action="<?= base_url('teachercontroller/class') ?>">
<div class="form-group">
    <label for="class">Select Class:</label>
    <select class="form-control" id="class" name="class">
        <option value="">All Classes</option>
        <option value="1A">1A</option>
        <option value="1B">1B</option>
        <option value="1C">1C</option>
    </select>
</div>

<button type="submit" class="btn btn-primary">Filter</button>
</form>

<br></br>

<table class="table">
<thead>
    <tr>
        <th data-sort="name">Name</th>
        <th data-sort="class">Class</th>
        <th data-sort="ic">IC. Number</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($studentInfo as $student): ?>
        <tr>
            <td><?php echo $student['fld_name']; ?></td>
            <td><?php echo $student['fld_class']; ?></td>
            <td><?php echo $student['fld_ic']; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('th').click(function() {
        var table = $(this).closest('table');
        var index = $(this).index();
        var rows = table.find('tr:gt(0)').toArray().sort(comparator(index));
        var sortDirection = $(this).hasClass('asc') ? 'desc' : 'asc';
        table.find('th').removeClass('asc desc');
        $(this).addClass(sortDirection);
        if (sortDirection === 'desc') {
            rows = rows.reverse();
        }
        for (var i = 0; i < rows.length; i++) {
            table.append(rows[i]);
        }
    });

    function comparator(index) {
        return function(a, b) {
            var valA = $(a).find('td').eq(index).text().toUpperCase();
            var valB = $(b).find('td').eq(index).text().toUpperCase();
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.localeCompare(valB);
        };
    }
});
</script>

<?= $this->endSection(); ?>
