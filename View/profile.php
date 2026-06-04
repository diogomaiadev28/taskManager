<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | Task Manager</title>

    <link rel="stylesheet" href="../templates/assets/css/profile.css">
</head>
<body>

    <div class="background"></div>

    <header>

        <div class="logo">
            <img src="../templates/assets/img/logo.png" alt="">
        </div>

        <a href="mainPage.php" class="backButton">
            Dashboard
        </a>

    </header>

    <main>

        <section class="profileCard">

            <div class="profileHeader">

                <div class="imageContainer">

                    <img
                        src="../templates/assets/img/cat.png"
                        alt=""
                        class="profileImage">

                    <button class="changePhoto">
                        Change Photo
                    </button>

                </div>

                <div class="profileInfo">

                    <h1>Diogo Maia</h1>

                    <p>
                        diogo@email.com
                    </p>

                    <div class="badges">

                        <span>
                            Productivity Master
                        </span>

                        <span>
                            250 Tasks Done
                        </span>

                    </div>

                </div>

            </div>

        </section>

        <section class="stats">

            <div class="statCard">

                <h2>158</h2>

                <p>Total Tasks</p>

            </div>

            <div class="statCard">

                <h2>27</h2>

                <p>Today</p>

            </div>

            <div class="statCard">

                <h2>119</h2>

                <p>Done</p>

            </div>

            <div class="statCard">

                <h2>12</h2>

                <p>Late</p>

            </div>

        </section>

        <section class="contentGrid">

            <div class="card">

                <h3>Personal Information</h3>

                <div class="field">

                    <label>Full Name</label>

                    <input
                        type="text"
                        value="Diogo Maia"
                        readonly>

                </div>

                <div class="field">

                    <label>Email</label>

                    <input
                        type="email"
                        value="diogo@email.com"
                        readonly>

                </div>

                <button class="primaryButton">
                    Edit Profile
                </button>

            </div>

            <div class="card">

                <h3>Security</h3>

                <p class="securityText">
                    Manage your password and
                    account security settings.
                </p>

                <button class="primaryButton">
                    Change Password
                </button>

                <button class="secondaryButton">
                    Logout
                </button>

            </div>

        </section>

    </main>

    <script src="../templates/assets/js/profile.js"></script>

</body>
</html>