<?= $this->extend('layout/dashboard-admin'); ?>
<?= $this->section('content'); ?>

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

    .delete-button {
        padding: 8px 16px;
        background-color: red;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .delete-button:hover {
        background-color: darkred;
    }

    .add-button {
        padding: 8px 16px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    .add-button:hover {
        background-color: #45a049;
    }

    .last-column {
        width: 20%;
    }

    .custom-btn {
        border: none;
    background-color: orange;
    color: white;
</style>



<form action="<?= base_url('activitycontroller/createAdmin') ?>" method="post">
    <?= csrf_field(); ?>

    <?php if (!empty(session()->getFlashdata('fail'))) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <div class="form-group">
        <label for="name">Activity Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
        <?php if(isset($errors['name'])): ?>
            <div class="text-danger"><?= $errors['name'] ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required><?= old('description') ?></textarea>
        <?php if(isset($errors['description'])): ?>
            <div class="text-danger"><?= $errors['description'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="date">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="<?= old('date') ?>" required>
        <?php if(isset($errors['date'])): ?>
            <div class="text-danger"><?= $errors['date'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="budget">Budget(RM)</label>
        <input type="number" class="form-control" id="budget" name="budget" value="<?= old('budget') ?>" required>
        <?php if(isset($errors['budget'])): ?>
            <div class="text-danger"><?= $errors['budget'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="participant">Required Participants</label>
        <input type="number" class="form-control" id="participant" name="participant" value="<?= old('participant') ?>" required>
        <?php if(isset($errors['participant'])): ?>
            <div class="text-danger"><?= $errors['participant'] ?></div>
        <?php endif; ?>
    </div>
    <div class="form-group">
    <label for="help">Requires</label>
    <select class="form-control" id="help" name="help" required>
        <option value="">Select Requirement</option>
        <option value="Volunteer">Volunteer</option>
        <option value="Fund">Fund</option>
        <option value="Materials">Materials</option>
    </select>
    <?php if(isset($errors['help'])): ?>
        <div class="text-danger"><?= $errors['help'] ?></div>
    <?php endif; ?>
</div>

    <button class="btn btn-primary" style="margin-bottom: 15px" type="submit">Add Activity</button>
    <button class="btn btn-secondary" style="margin-bottom: 15px" type="reset">Reset</button>
</form>

<table>
<tr>
        <th>Activity Name</th>
        <th>Description</th>
        <th>Date</th>
        <th>Budget(RM)</th>
        <th>Required Participants</th>
        <th>Requires</th>
        <th class="last-column"></th>
    </tr>

    <?php foreach ($activities as $activity): ?>
        <tr>
            <td><?= $activity['fld_name']; ?></td>
            <td><?= $activity['fld_description']; ?></td>
            <td><?= $activity['fld_date']; ?></td>
            <td><?= $activity['fld_budget']; ?></td>
            <td><?= $activity['fld_participants']; ?></td>
            <td><?= $activity['fld_help']; ?></td>
            <td>

                <button type="button" class="btn btn-sm btn-success"data-toggle="modal" data-target="#example<?= $activity['fld_id'] ?>">View Participants</button>

                <!-- Modal -->
                <div class="modal fade" id="example<?= $activity['fld_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Participants</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <table id="participantTable_<?= $activity['fld_id'] ?>">
                        <tr>
                            <th>No.</th>
                            <th>Participants</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                        </tr>
                        <?php $count = 1; ?>
                        <?php foreach ($participants as $participant): ?>
                            <?php if ($participant['fld_aid'] === $activity['fld_id']): ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $participant['fld_name'] ?></td>
                                <td><?= $participant['fld_phone'] ?></td>
                                <td><?= $participant['fld_email'] ?></td>
                            </tr>
                            <?php $count++; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        </table>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" style="margin-right: 0px" onclick="downloadTable(<?= $activity['fld_id'] ?>, '<?= $activity['fld_name'] ?>')">Print</button>
                            <button type="button" class="btn btn-tertiary btn-warning" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                    </div>
                </div>
                </div>


                <button type="button" class="btn btn-sm btn-warning"data-toggle="modal" data-target="#exampleModal<?= $activity['fld_id'] ?>">Edit</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal<?= $activity['fld_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Activity</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="<?= base_url('activitycontroller/updateAdmin/'.$activity['fld_id']) ?>" method="post">

                            <?=csrf_field(); ?>

                            <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                                <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                            <?php endif ?>

                            <?php if (session()->getFlashdata('success')): ?>
                                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="name">Activity Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= $activity['fld_name'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <input class="form-control" id="description" name="description" value="<?= $activity['fld_description'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date" name="date" value="<?= $activity['fld_date'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="budget">Budget(RM)</label>
                                <input type="number" class="form-control" id="budget" name="budget" value="<?= $activity['fld_budget'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="participant">Required Participants</label>
                                <input type="number" class="form-control" id="participant" name="participant" value="<?= $activity['fld_participants'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="help">Requires</label>
                                <select class="form-control" id="help" name="help" required>
                                    <option value="">Select Requirement</option>
                                    <option value="Volunteer" <?= $activity['fld_help'] == 'Volunteer' ? 'selected' : '' ?>>Volunteer</option>
                                    <option value="Fund" <?= $activity['fld_help'] == 'Fund' ? 'selected' : '' ?>>Fund</option>
                                    <option value="Materials" <?= $activity['fld_help'] == 'Materials' ? 'selected' : '' ?>>Materials</option>
                                </select>
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

                <a href="<?= base_url('activitycontroller/deleteAdmin/'.$activity['fld_id']) ?>" class="btn btn-danger btn-sm">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<script>
  function downloadTable(activityId, activityName) {
    // Get the table element specific to the activity ID
    const table = document.getElementById(`participantTable_${activityId}`);

    // Clone the table
    const clonedTable = table.cloneNode(true);

    // Create a new window or tab with the table content
    const newWindow = window.open('', '_blank');
    newWindow.document.write('<html><head><title>Print</title>');
    newWindow.document.write('<style>table { border-collapse: collapse; }');
    newWindow.document.write('table, th, td { border: 1px solid black; }');
    newWindow.document.write('th, td { padding: 8px; }</style></head><body>');
    newWindow.document.write('<h2>Participant List</h2>');
    newWindow.document.write(`<h2>Activity: ${activityName}</h2>`);
    newWindow.document.write(clonedTable.outerHTML);
    newWindow.document.write('</body></html>');
    newWindow.document.close();

    // Invoke the print dialog
    newWindow.print('ParticipantList_' + activityName);
  }
</script>




<?= $this->endSection(); ?>