<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Authentication</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body class="bg-secondary text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 col-md-offset-4 bg-dark shadow-none p-3 mb-5 bg-mediumprsinggreen rounded"style="margin-top:70px">
                <h4>Login</h4>
                <form action="{{route('login-user')}}" method="post">
                    @csrf
                    <div class="form-group ">
                    <label for="emal">Email</label>
                    <input type="email" class="form-control" placeholder="Enter your email" name="email" value="">
                    </div>
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" placeholder="Enter your password" name="password" value="">
                    </div>
                    <div class="form-group">
                    <button class="btn btn-block btn-primary mt-3" type="submit" >Login</button>
                    </div>
                    <br>
                    <a href="registration">New User !! Register Here.</a>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>