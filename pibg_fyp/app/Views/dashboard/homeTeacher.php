<?= $this->extend('layout/dashboard-teacher'); ?>
<?= $this->section('content'); ?>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $totalStudent; ?></h3>
                <p>Total Student</p>
            </div>
            <div class="icon">
            <i class="fas fa-child"></i>
            </div>
            <a href="/teacher/viewStudent" class="small-box-footer">
                More Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>RM <?php echo $totalSum; ?></h3>
                <p>Funds Received</p>
            </div>
            <div class="icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
                <a href="/teacher/crowdfunding" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?php echo $count; ?></h3>
                <p>Total Class</p>
            </div>
            <div class="icon">
                <i class="fas fa-school"></i>
            </div>
                <a href="/teacher/viewStudent" class="small-box-footer">
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
                <a href="/teacher/activity" class="small-box-footer">
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

  </div>



<?= $this->endSection();?>