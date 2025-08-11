<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Task Manager | Register</title>
        <link rel="icon" href="../templates/assets/img/logo.ico" type="image/x-icon">
        <link rel="stylesheet" href="../templates/assets/css/register.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div id="carouselAuto" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000" data-bs-pause="false" data-bs-touch="false" data-bs-keyboard="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselAuto" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselAuto" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselAuto" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <figure class="carouselFigure"><img src="../templates/assets/img/backgroundImg1.png" class="d-block" alt="Slide 1"></figure>
                    </div>
                    <div class="carousel-item">
                        <figure class="carouselFigure"><img src="../templates/assets/img/backgroundImg2.png" class="d-block" alt="Slide 2"></figure>
                    </div>
                    <div class="carousel-item">
                        <figure class="carouselFigure"><img src="../templates/assets/img/backgroundImg3.png" class="d-block" alt="Slide 3"></figure>
                    </div>
                </div>
                <figure class="flogo">
                    <img src="../templates/assets/img/logo.png" alt="Stylized gradient logo with flowing ribbon shapes in blue and pink tones, set against a transparent background, conveying a modern and energetic mood" class="logo">
                </figure>
            </div>
            <div class="containerRight">
                <h1>Create an account</h1>
                <form>
                    <div class="names">
                        <div class="firstName">
                            <input class="name" type="text" name="firstName" id="firstName" placeholder="First Name">
                            <p class="warning">Can't be blank</p>
                        </div>
                        <div class="lastName">
                            <input class="name" type="text" name="lastName" id="lastName" placeholder="Last Name">
                            <p class="warning">Can't be blank</p>
                        </div>
                    </div>
                    <div class="email">
                        <input class="input" type="email" name="email" id="email" placeholder="Email">
                        <p class="warning">Can't be blank</p>
                    </div>
                    <div class="passwordAndTerms">
                        <div class="password">
                            <input class="input" type="password" name="password" id="password" placeholder="Password">
                            <p class="warning">Can't be blank</p>
                        </div>
                        <div class="terms">
                            <input type="checkbox" name="terms" id="terms">
                            <p>I agree with the <a href="https://www.fia.com/regulation/category/110">terms and conditions</a></p>
                        </div>
                    </div>
                    <div class="buttonAndSignUp">
                        <button class="submitBtn" type="submit">Create account</button>
                        <h5>Don't have an account? <a href="../index.php">Sign Up</a></h5>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        <script src="../templates/assets/js/register.js"></script>
    </body>
</html>