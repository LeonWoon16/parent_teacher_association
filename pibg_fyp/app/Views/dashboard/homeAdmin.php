<?= $this->extend('layout/dashboard-admin'); ?>
<?= $this->section('content'); ?>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?php echo $totalStudent; ?></h3>
                <p>Total Students</p>
            </div>
            <div class="icon">
            <i class="fas fa-child"></i>
            </div>
            <a href="/admin/profile" class="small-box-footer">
                More Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?php echo $totalParent; ?></h3>
                <p>Total Parents</p>
            </div>
            <div class="icon">
            <i class="fas fa-users"></i>
            </div>
            <a href="/admin/profile" class="small-box-footer">
                More Info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-olive">
            <div class="inner">
                <h3><?php echo $totalTeacher; ?></h3>
                <p>Total Teachers</p>
            </div>
            <div class="icon">
            <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <a href="/admin/profile" class="small-box-footer">
                More Info <i class="fas fa-arrow-circle-right"></i>
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
                <a href="/admin/profile" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
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
                <a href="/admin/crowdfunding" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-pink">
            <div class="inner">
                <h3><?php echo $totalActivity; ?></h3>
                <p>Activities Ongoing</p>
            </div>
            <div class="icon">
                <i class="fas fa-dumbbell"></i>
            </div>
                <a href="/admin/activity" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-purple">
            <div class="inner">
                <h3><?php echo $assign; ?></h3>
                <p>Assigned Students</p>
            </div>
            <div class="icon">
            <i class="fas fa-check-circle"></i>
            </div>
                <a href="/admin/assign" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

    <div class="col-lg-3 col-6">

        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?php echo $unassign; ?></h3>
                <p>Unassigned Students</p>
            </div>
            <div class="icon">
            <i class="fas fa-minus-circle"></i>
            </div>
                <a href="/admin/assign" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
        </div>
    </div>

</div>

<?= $this->endSection();?>