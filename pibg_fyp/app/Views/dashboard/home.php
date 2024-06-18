<?= $this->extend('layout/dashboard-layout'); ?>
<?= $this->section('content'); ?>

<!-- <style>
    .profile-table {
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
    }

    table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
    }

    th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    }

    th {
    background-color: #f2f2f2;
    }

    tr:hover {
    background-color: #f9f9f9;
    }

    td:first-child {
    width: 150px;
    font-weight: bold;
    }

    td:last-child {
    font-weight: 500;
    }
</style> -->

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $totalChildren; ?></h3>
                <p>Total Children</p>
            </div>
            <div class="icon">
            <i class="fas fa-child"></i>
            </div>
            <a href="/user/result" class="small-box-footer">
                View Results <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>RM <?php echo $totalMoney; ?></h3>
                <p>Funds Donated</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
                <a href="/user/crowdfunding" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $totalTeacher; ?></h3>
                <p>Total Teacher</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
                <a href="/user/viewTeacher" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
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
                <a href="/user/activity" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>


</div>

<div class="row">
  <div class="col-md-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">About Me</h3>
      </div>
      <div class="card-body">
        <strong><i class="fas fa-user mr-1"></i> Name</strong>
        <p class="text-muted"><?php echo $userInfo['fld_name']; ?></p>
        <hr>
        <strong><i class="fas fa-envelope mr-1"></i> Email</strong>
        <p class="text-muted"><?php echo $userInfo['fld_email']; ?></p>
        <hr>
        <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
        <p class="text-muted"><?php echo $userInfo['fld_phone']; ?></p>
        <hr>
        <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
        <p class="text-muted"><?php echo $userInfo['fld_address']; ?></p>
        <hr>
        <strong><i class="far fa-calendar-alt mr-1"></i> Date of Birth</strong>
        <p class="text-muted"><?php echo $userInfo['fld_dob']; ?></p>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
  <div class="card-deck">
    <?php foreach ($studentInfo as $student): ?>
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Children</h3>
        </div>
        <div class="card-body">
          <strong><i class="fas fa-user mr-1"></i> Name</strong>
          <p class="text-muted"><?php echo $student['fld_name']; ?></p>
          <hr>
          <strong><i class="fas fa-chalkboard-teacher mr-1"></i> Class</strong>
          <p class="text-muted"><?php echo $student['fld_class']; ?></p>
          <hr>
          <strong><i class="far fa-id-card mr-1"></i> IC. Number</strong>
          <p class="text-muted"><?php echo $student['fld_ic']; ?></p>
          <hr>
          <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
          <p class="text-muted"><?php echo $student['fld_gender']; ?></p>
          <hr>
          <strong><i class="far fa-calendar-alt mr-1"></i> Year Enrolled</strong>
          <p class="text-muted"><?php echo $student['fld_year']; ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

</div>









<?= $this->endSection();?>