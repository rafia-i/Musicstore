<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MusicStore - Homepage</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            
        }
        

        /* Header */
        header {
            background-color: #333;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }

        header h1 {
            margin: 0;
        }
         /* User Dashboard Button */
         .dashboard-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: transparent;
            color: #4CAF50;
            border: 3px solid #4CAF50;
            border-radius: 50%; /* Makes the button circular */
            font-size: 0.1 rem;
            text-align: center;
            line-height: 50px; /* Centers the text vertically */
            cursor: pointer;
        }

        .dashboard-btn:hover {
            background-color: #4CAF50;
            color: white;
        }

        /* Menu Bar */
        nav {
            display: flex;
            justify-content: space-around;
            background-color: #4CAF50;
            padding: 0.8rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-size: 1rem;
        }

        nav a:hover {
            background-color: #45a049;
        }

        /* Main Content */
        .container {
            display: flex;
            flex-wrap: wrap;
            margin: 20px;
            gap: 20px;
            justify-content: center;
        }
       
        
        .section {
            background-color: #dff5e8;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }

        .section h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .account-details p {
            margin: 0.5rem 0;
        }
            

        .search-bar input[type="text"] {
            width: calc(100% - 50px);
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-bar button {
            padding: 0.5rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            
        }

        .search-bar button:hover {
            background-color: #45a049;
        }
       /*
        .playlist ul {
            list-style-type: none;
            padding: 0;
        }

        .playlist ul li {
            padding: 0.8rem;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
       */ 
    </style>
</head>


<body>

<!-- Header -->
<header>
    <h1>MusicStore</h1>
    <!-- User Dashboard Button -->
    <a href="dashboard.php">
        <button class="dashboard-btn">Dashboard</button>
    </a>
</header>

<!-- Menu Bar -->
<nav>
    <a href="#">Home</a>
    <a href="account.php">My Account</a>
    <a href="#">Playlist</a>
    <a href="bought.php">My Purchased Tracks</a>
</nav>





<!-- Main Content -->
<div class="container">
    <div class="section search-bar">
        <h2>Looking for a track?</h2>
        <form action="search.php" method="POST">
            <input type="text" name="search_term" placeholder="Enter track name..." required>
            <br><br>
            <button type="submit">Search</button>
        </form>
    </div>

    
</div>

<div class="container">
    <div class="section search-bar">
        <h2>Dive into the world of Genre</h2>
        
        <form action="searchgenre.php" method="POST">

            <label>Pop</label>
            <input type="radio" name="search_term" value="pop">
        
            <label>Rock</label>
            <input type="radio" name="search_term" value="rock">
        
            <label>R&B</label>
            <input type="radio" name="search_term" value="r&b">
           <br>

            <label>Country</label>
            <input type="radio" name="search_term" value="country">
        
            <label>Jazz</label>
            <input type="radio" name="search_term" value="jazz">
        
            <label>Classical</label>
            <input type="radio" name="search_term" value="classical">

            <br><br>
            <button type="submit">Go</button>
        </form>
    </div>

    
</div>

</body>
</html>