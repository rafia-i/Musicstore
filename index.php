<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicStore</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        nav .menu {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 1rem 0;
        }

        nav .menu li {
            margin: 0 1rem;
        }

        nav .menu a {
            text-decoration: none;
            color: white;
            font-size: 1.2rem;
            transition: color 0.3s;
        }

        nav .menu a:hover {
            color: #ffcc00;
        }

        .login-section {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 2rem auto;
        }

        .login-section button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 1rem 2rem;
            font-size: 1rem;
            margin: 1rem 0;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .login-section button:hover {
            background-color: #45a049;
        }

        .login-form {
            display: none;
            margin: 2rem auto;
            width: 400px;
            padding: 2rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .login-form h2 {
            margin: 0 0 1rem;
            text-align: center;
        }

        .login-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .login-form input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-form button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.7rem;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
        }

        .login-form button:hover {
            background-color: #45a049;
        }

        .form-container {
            display: none;
            margin: 2rem auto;
            width: 400px;
            padding: 2rem;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-container label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        .form-container input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-container button {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.7rem;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        footer {
            text-align: center;
            padding: 1rem 0;
            background-color: #333;
            color: white;
            margin-top: auto;
            
        }
    </style>
</head>
<body>
    <header>
        <h1>MusicStore</h1>
    
        <nav>
            <ul class="menu">
                <li><a href="about.php" target=_blank title="About">About us</a></li>
                <li><a href="mailto:Shraya.sarker@g.bracu.ac.bd" title="You can mail to us">Contact</a></li>
            </ul>
        </nav> 
    
    </header>

    <main>
        <div class="login-section">
            <button onclick="showForm('admin')">Log in as Admin</button>
            <button onclick="showForm('user')">Log in as User</button>
            <button onclick="showForm('register')">Register</button>
        </div>

        <div id="admin-form" class="login-form">
            <h2>Admin Login</h2>
            <form action="submit-admin-login.php" method="POST">
                <label for="admin-id">Admin ID</label>
                <input type="text" id="admin-id" name="adminID" placeholder="Enter admin ID" required>

                <label for="admin-password">Password</label>
                <input type="password" id="admin-password" name="password" placeholder="Enter admin password" required>

                <button type="submit">Log in</button>
            </form>
        </div>

        <div id="user-form" class="login-form">
            <h2>User Login</h2>
            <form action="submit-user-login.php" method="POST">
                <label for="user-username">Username</label>
                <input type="text" id="user-username" name="username" placeholder="Enter your username" required>

                <label for="user-password">Password</label>
                <input type="password" id="user-password" name="password" placeholder="Enter your password" required>

                <button type="submit">Log in</button>
            </form>
        </div>

        <div id="registration-form" class="form-container">
            <h2>Register</h2>
            <form action="registernow.php" method="POST">
                <label for="new-username">Username</label>
                <input type="text" id="new-username" name="username" placeholder="Enter your username" required>

                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="password" placeholder="Enter your password" required>

                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>

                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone_number" placeholder="Enter your phone number" required>

                <label for="area">Area</label>
                <input type="text" id="area" name="area" placeholder="Enter your area" required>

                <label for="district">District</label>
                <input type="text" id="district" name="district" placeholder="Enter your district" required>

                <label for="country">Country</label>
                <input type="text" id="country" name="country" placeholder="Enter your country" required>

                <label for="birthdate">Birthdate</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <button type="submit">Register</button>
            </form>
        </div>
    </main>
    <br><br><br><br><br><br><br><br><br><br>

    <footer>
        <p>&copy; 2024 MusicStore. All rights reserved.</p>
    </footer>

    <script>
        function showForm(type) {
            document.getElementById('admin-form').style.display = 'none';
            document.getElementById('user-form').style.display = 'none';
            document.getElementById('registration-form').style.display = 'none';

            if (type === 'admin') {
                document.getElementById('admin-form').style.display = 'block';
            } else if (type === 'user') {
                document.getElementById('user-form').style.display = 'block';
            }else {
                document.getElementById('registration-form').style.display = 'block';
            }
        }
    </script>
</body>
</html>