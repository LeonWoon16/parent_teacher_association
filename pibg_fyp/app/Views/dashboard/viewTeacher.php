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
            cursor: pointer;
        
    }

</style>

<body>
<table id="teacherTable">
        <tr>
            <th data-sort="name">Name</th>
            <th data-sort="email">Email Address</th>
            <th data-sort="phone">Phone Number</th>
        </tr>
        <?php foreach ($teacherInfo as $teacher): ?>
        <tr>
            <td><?= $teacher['fld_name']; ?></td>
            <td><a href="mailto:<?= $teacher['fld_email']; ?>"><?= $teacher['fld_email']; ?></a></td>
            <td><?= $teacher['fld_phone']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        $(document).ready(function() {
            $('th').click(function() {
                var table = $(this).closest('table');
                var index = $(this).index();
                var rows = table.find('tr:gt(0)').toArray().sort(comparator(index));
                this.asc = !this.asc;
                if (!this.asc) {
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
</body>

<?= $this->endSection();?>  