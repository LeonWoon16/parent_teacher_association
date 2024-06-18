<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Parent Login Page</title>
    <!-- <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    
    <style>
      .gradient-custom-2 {
    /* fallback for old browsers */
    background: #007bff;
    
    /* Chrome 10-25, Safari 5.1-6 */
    /* background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593); */
    
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    /* background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593); */
    }
    
    @media (min-width: 768px) {
    .gradient-form {
    height: 100vh !important;
    }
    }
    @media (min-width: 769px) {
    .gradient-custom-2 {
    border-top-right-radius: .3rem;
    border-bottom-right-radius: .3rem;
    }
    }
      </style>
  </head>
  <body>

  <section class="h-100 gradient-form" style="background-color: #eee;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3 text-black">
          <div class="row g-0">
            <div class="col-lg-6">
              <div class="card-body p-md-5 mx-md-4">

                <div class="text-center">
                  <h4 class="mt-1 mb-5 pb-1">Welcome, Parent Login</h4>
                </div>

                <form action="<?= base_url('auth/checkParent') ?>" method="post">
                <?=csrf_field(); ?>

                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
                 <?php endif ?>

                  <p>Please login to your account</p>

                  <div class="form-outline mb-4">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'email'):''?></span>
                  </div>

                  <div class="form-outline mb-4"> 
                  <input type="password" class="form-control" name="password" placeholder="Password"/>
                  <span class="text-danger"><?= isset($validation) ? display_error($validation,'password'):''?></span>
                  </div>

                <!-- <div class="form-outline mb-4">
                  <select class="form-select" name="role">
                   <option value="" disabled selected>Select your role</option>
                   <option value="option1">Admin</option>
                   <option value="option2">Teacher</option>
                   <option value="option3">Parents</option>
                  </select>
                </div> -->

                <div class="text-center pt-1 mb-5 pb-1"> 
                    <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Login</button>
                    <div style="margin-bottom: 10px;">
                    <a href="/auth/loginTeacher" style="color: #007bff; font-size: 16px; text-decoration: none;">Teacher Login</a>
                    </div>
                    <div>
                    <a href="/auth/loginAdmin" style="color: #007bff; font-size: 16px; text-decoration: none;">Admin Login</a>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-center pb-4">
                    <p class="mb-0 me-2">Don't have an account?</p>
                    <a href="/auth/register">Click here!</a>  
                    <!-- call method in controller    -->
                    <!-- <a href="/auth/register">Click here!</a> -->
                    <!-- <button onclick="location.href='<?= site_url('register') ?>'" type="button">Click here!</button> -->

                    <!-- <button type="button" class="btn btn-outline-danger">Create new</button> -->
                </div>

                </form>

              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
              <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                <h4 class="mb-4">Parents Teacher Association System</h4>
                <p class="small mb-0">It is a system developed to enhance and strengthen the relationship between
                  the parents and the teachers in the school for the student better academic performance and character building</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    <script src="assets/js/jquery-3.6.4.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>


  </body>
</html>


</html>