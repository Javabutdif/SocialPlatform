
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        
    </head>
    <style>
        body{
            background-image: url(img/admin_bg.jpg);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 35vh;
    flex-direction: column;
    background-repeat: no-repeat;
            background-size: cover;
    }
    h1{
            text-align: center;
            color: white;
            
        }
    h2{
    color:white;
    text-align: center;
    margin-bottom: 12px;
    font-size: 300%;
    margin-top: 3%;

    }
    a{
    color:white;
    border: none;
    text-decoration: none;

    }
    a:hover{
        opacity: .7;
    color: white;
    transition: .4s;
    }
    p{
    margin: 0px;
    color: white;
    }
    .btn-logout {
            position: absolute;
            top: 40px;
            right: 20px;      
        }
        .btn-back{
            position: absolute;
            top: 40px;
            right: 20px;
            color:white;
        }
        .sidebar {
            position: fixed;
            left: 0;
            bottom: -90px;
            height: 100%;
            width: 250px;
            background-color: transparent;
            padding-top: 50px;
            align-items: center;
        }
        .sidebar a {
            display: block;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            margin-top: 20px;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .admin-panel {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

    }


    #admin-login-form {
        max-width: 400px; /* Set a maximum width for the form */
        margin: 0 auto; /* Center the form horizontally */
        padding: 20px; /* Add some padding around the form */
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background */
        border-radius: 10px;
        margin-left: 350px;
        margin-top: 350px;
        width: 350px;
    }

    #admin-login-form label {
        margin-bottom: 5px; /* Add some space below the labels */
    }

    #admin-login-form input {
        margin-bottom: 10px; /* Add some space below the input fields */
    }

    #admin-login-form button {
        margin-top: 10px; /* Add some space above the button */
    }
        

        </style>
    </head>
    </style>
    <body>
    <div id="topbar" class="d-flex justify-content-between align-items-center">
            <div class="topbar-heading"></div>
        </div>
        
        <div class="sidebar">
        <a href="#" onclick="showAdminPanel()">Admin</a>
            <a href="#" onclick="showRegularUserPanel()">Regular User</a>
            <a href="#" onclick="showModeratorPanel()">Moderator</a>
            
        </div>


        <div class="container">
        
            <center><h1 class="mb-4">Social Networking Platform</h1></center> 
            <center><p class="clock" id="clock"></p></center>
            
            <a href="#" class="btn btn-danger btn-logout" onclick="confirmLogout()">Logout</a>
        </div>
    
        <script>
            function confirmLogout() {
                if (confirm("Are you sure you want to logout?")) {
                    window.location.href = 'logout.php';
                }
            }

        
            function updateClock() {
                const clockElement = document.getElementById('clock');
                const currentTime = new Date();
                const hours = currentTime.getHours();
                const minutes = currentTime.getMinutes();
                const period = hours >= 12 ? 'pm' : 'am';

            
                const formattedHours = hours % 12 || 12;

                const formattedTime = `${formattedHours}:${minutes < 10 ? '0' : ''}${minutes} ${period}`;
                clockElement.innerText = formattedTime;
            }

        
            setInterval(updateClock, 1000);

            
            updateClock();

            function showAdminPanel() {
                const body = document.querySelector('body');
                body.style.backgroundImage = 'url(img/DB.jpg)';
                

                const adminContent = document.getElementById('admin-content');
    adminContent.innerHTML = `
        <a href="#" onclick="showHome()">Home</a>
        <a href="#" onclick="showProfile()">Profile</a>
        <a href="#" onclick="showMessages()">Messages</a>
    `;
            }
            function showHome() {
    const container = document.querySelector('.container');
    container.innerHTML = `
        <h2>Home</h2>
        <p>Welcome to the Home page.</p>
    `;
}

function showProfile() {
    const container = document.querySelector('.container');
    container.innerHTML = `
        <h2>Profile</h2>
        <p>Here is your profile information.</p>
    `;
}

function showMessages() {
    const container = document.querySelector('.container');
    container.innerHTML = `
        <h2>Messages</h2>
        <p>Your messages will appear here.</p>
    `;
}


            function showRegularUserPanel() {
    const body = document.querySelector('body');
    body.style.backgroundImage = 'url(img/Ru.webp)';


}


            function showModeratorPanel() {
                const body = document.querySelector('body');
                body.style.backgroundImage = 'url(img/SW.jpg)';

                const container = document.querySelector('.container');
                container.innerHTML = `
                <div class="content">

                    <h2>Moderator Panel</h2>
                    <a href="#" class="btn btn-back" onclick="showMainContent()">Back</a>
                </div>
                `;
            }
        
            function showMainContent() {
                document.body.style.backgroundImage = 'url(img/admin_bg.jpg)';

                const container = document.querySelector('.container');
                container.innerHTML = `
                <center><h1 class="mb-4">Social Networking Platform</h1></center> 
                <center><p class="clock" id="clock"></p></center>
                <a href="#" class="btn btn-danger btn-logout" onclick="confirmLogout()">Logout</a>
                `;
            }
            
        </script>
    </body>
    </html>
