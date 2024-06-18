<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>
  .btn-lg {
    font-size: 2rem;
  }

  .box {
            width: 90%;
            max-width: 600px;
            height: 50%;
            max-height: 600px;
            border: 2px solid #ccc;
            border-radius: 25px;
            padding: 20px;
            margin: 20px;
            box-shadow: 0 0 50px rgba(0,0,0,0.2);
        }
</style>
<body>

    <div class="container-fluid d-flex flex-column align-items-center justify-content-center vh-100">
        <div class="box">
        <h2 class="mb-3" style="color: black; font-family: Verdana, sans-serif; font-size: 30px; text-align: center; padding-bottom:30px;">Please choose your user type</h2>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary btn-block btn-lg mb-3" type="submit">Teacher</button>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary btn-block btn-lg mb-3" type="submit">Parent</button>
            </div>
        </div>
    </div>

   
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>

   body {
    background-color: #ADD8E6;
  }

  .btn-lg {
    font-size: 2rem;
  }

  .box {
    background-color: #f5f5f5;
    width: 90%;
    max-width: 600px;
    height: 50%;
    max-height: 600px;
    border: 2px solid #ccc;
    border-radius: 25px;
    padding: 20px;
    margin: 20px;
    box-shadow: 0 0 50px rgba(0,0,0,0.2);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  .box h2 {
    color: #444;
    font-family: "Helvetica Neue", sans-serif;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    text-shadow: 1px 1px #ddd;
  }

  .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    font-weight: bold;
    transition: all 0.2s;
  }

  .btn-primary:hover {
    background-color: #0062cc;
    border-color: #0062cc;
    transform: scale(1.1);
  }
</style>
<body>

    <div class="container-fluid d-flex flex-column align-items-center justify-content-center vh-100">
        <div class="box">
          <h2 style="padding-top:50px">Please choose your user type</h2>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary btn-block btn-lg mb-3" type="submit" onclick="location.href='<?= site_url('auth/registerTeacher') ?>'">Teacher</button>
            </div>

            <div class="text-center pt-1 mb-5 pb-1">
                <button class="btn btn-primary btn-block btn-lg mb-3" type="submit" onclick="location.href='<?= site_url('auth/registerParent') ?>'">Parent</button>
            </div>
        </div>
    </div>

   
</body>
</html>