<?php
session_start();
if (isset($_SESSION['ID'])) {
    $userID = $_SESSION['ID'];
}
require_once('DBconnect.php');
?>

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
            /*background-color: #dff5e8;*/
            background: linear-gradient(135deg, #dff5e8,rgb(195, 242, 215));
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 350px;
            
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .section:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
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
        

        .upcoming-releases {
        background: linear-gradient(135deg, #a8e063, #56ab2f); /* Soft green gradient */
        color: white;
        padding: 20px;
        border-radius: 20px; /* Softer, rounder corners */
        position: absolute;
        top: 150px; /* Adjust as needed */
        left: 20px; /* Distance from the right edge */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 220px;
        /*font-family: 'Comic Sans MS', cursive, sans-serif; /* Playful font */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: 30px;
        
    }

    .upcoming-releases:hover {
        transform: scale(1.05); /* Slightly enlarge on hover */
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
    }

    .upcoming-releases a {
        text-decoration: none;
        color: white;
        font-size: 1.4rem;
        font-weight: bold;
    }

    

    .upcoming-releases h2 {
        margin: 0;
        font-size: 1.5rem;
        line-height: 1.5;
    }

    .popular-list button {
            padding: 0.5rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .popular-list button:hover {
            background-color: #45a049;
        }

        .popular-list ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .popular-list ul li {
            padding: 0.8rem;
            background-color: #f9f9f9;
            margin-bottom: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

.report-btn {
            position: fixed;
            bottom: 20px;   
            right: 20px;
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            font-size: 18px;
            cursor: pointer;
            z-index: 1000;
        }

        .report-btn:hover {
            background-color: #e68900;
        }
        /* New Releases Button */
    /* Recently Released Button */
/* Recently Released Button */
/* Recently Released Button */
.new-releases {
    background: linear-gradient(135deg, #f9a825, #ff6f00); /* Vibrant orange gradient */
    color: white;
    padding: 20px;
    border-radius: 20px; /* Softer, rounder corners */
    position: absolute;
    top: 300px; /* Increased to move the button lower */
    left: 20px; /* Same left alignment as 'Upcoming Releases' */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 220px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-top: 20px;
}

.new-releases:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
}

.new-releases a {
    text-decoration: none;
    color: white;
    font-size: 1.4rem;
    font-weight: bold;
}

.new-releases h2 {
    margin: 0;
    font-size: 1.5rem;
    line-height: 1.5;
}



    /* Buy with Points Button */
.buy.with.points {
    background: linear-gradient(135deg, #76c7c0, #34a0a4); /* Cool teal gradient */
    color: white;
    padding: 20px;
    border-radius: 20px; /* Softer, rounder corners */
    text-align: center;
    width: 300px;
    margin: 20px auto; /* Center the button in the container */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Subtle shadow for depth */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer; /* Pointer cursor for interactivity */
}

.buy.with.points:hover {
    transform: scale(1.1); /* Slightly enlarge on hover */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3); /* Stronger shadow on hover */
}

.buy.with.points a {
    text-decoration: none;
    color: white;
    font-size: 1.4rem;
    font-weight: bold;
}

.buy.with.points h2 {
    margin: 0;
    font-size: 1.5rem;
    line-height: 1.5;
}

/* Modal Box */
.modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            z-index: 1001;
        }

        .modal h2 {
            margin: 0 0 10px;
            font-size: 1.2rem;
        }

        .modal button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .modal button:hover {
            background-color: #45a049;
        }

        .modal-close {
            background-color: #f44336;
            float: right;
            border: none;
            color: white;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        .modal-close:hover {
            background-color: #d32f2f;
        }

        .modal form {
            margin-top: 10px;
        }


        
    
    </style>
</head>


<body>

<!-- Header -->
<header>

<!--
    <h1>MusicStore</h1>
    User Dashboard Button 
    <a href="dashboard.php">
        <button class="dashboard-btn">Dashboard</button>
    </a>-->
    

    <div class="greeting">
        <?php
        
        //session_start();
        //require_once('DBconnect.php');
        //$userID = $_SESSION['ID'];
        $sql = "SELECT name FROM customer WHERE ID = '$userID'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $customerName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            echo "Hi! $customerName";
        }
        ?>
    </div>
</header>

<!-- Menu Bar -->
<nav>
    
    
    <a href="favourite-artists.php">My Favorite Artists </a>
    <a href="viewwishlist.php">My Wishlist </a>
    <a href="viewcart.php">View my cart </a>    
    <a href="bought.php">My Purchased Tracks </a>
    <a href="#">My Playlist </a>
    <a href="past-invoices.php">My Orders </a>  
    <a href="updateCustomer.php">Change Info </a>   
    <a href="logout.php" class="logout">Logout<span class="emoji">⛔</span></a>
</nav>





<!-- Main Content -->

<div class="container">
    <!-- Upcoming Releases Section -->
    <div class="section upcoming-releases">
        <a href="upcoming.php">
            <h2> Upcoming Releases 🎶</h2>
        </a>
    </div>
</div>

<div class="container">
    <!-- New Releases Section -->
    <div class="section new-releases">
        <a href="newRelease.php">
            <h2>🔥 Recently Released 😲</h2>
        </a>
    </div>
</div>


<div class="container">
    <div class="section search-bar">
        <h2>Looking for a track? 𝄞၊၊||၊</h2>
        <form action="search.php" method="POST">
            <input type="text" name="search_term" placeholder="Enter track name..." required>
            <br><br>
            <button type="submit">Search</button>
        </form>
    </div>

    
</div>

<div class="container">
    <div class="section search-bar">
        <h2>Dive into the world of Genre 📼</h2>
        
        <form action="searchgenre.php" method="POST">

            <label>Pop</label>
            <input type="radio" name="search_term" value="pop" required>
        
            <label>Rock</label>
            <input type="radio" name="search_term" value="rock" >
        
            <label>R&B</label>
            <input type="radio" name="search_term" value="r&b">
           <br>

            <label>Country</label>
            <input type="radio" name="search_term" value="country">
        
            <label>Jazz</label>
            <input type="radio" name="search_term" value="jazz">
        
            <label>Classical</label>
            <input type="radio" name="search_term" value="classical">

            <br><br><br>
            <button type="submit">Go</button>
        </form>
    </div>

<div class="container">
        <div class="section search-bar">
            <h2>One click away from discoveing your favourite artists & songs! 🎶</h2>
            <form action="add-favourite-artist.php" method="POST">
                <label for="artistID">Select an Artist:</label>
                <select name="artistID" id="artistID" required>
                    <?php
                    require_once('DBconnect.php');
                    $sql = "SELECT artistID, name FROM artist";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $artistID = htmlspecialchars($row['artistID'], ENT_QUOTES, 'UTF-8');
                            $artistName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
                            echo "<option value='$artistID'>$artistName</option>";
                        }
                    } else {
                        echo "<option value=''>No artists available</option>";
                    }
                    ?>
                </select>
                <br><br>
                <button type="submit">Add to Favorites</button>
            </form>
        </div>
    </div>   

</div>
<!--YAKUB-->
<div class="container">
    <div class="section popular-list">
        <h2>🔥 Don't miss out on the trending artists and their chart-topping tracks. Click below to explore now!</h2>
        <form action="popular-artists.php" method="GET">
            <button type="submit">Discover Popular Artists</button>
        </form>
    </div>
</div>

<div class="container">
    <div class="section popular-list">
        <h2>Top Hits You Can't Ignore – Check Them Out Now! 🎧</h2>
        <form action="popular-tracks.php" method="GET">
            <button type="submit">View Most Popular Tracks</button>
        </form>
    </div>
</div>

<div class="container">
    <!-- Points -->
    <div class="buy with points">
        <a href="points.php">
            <h2>Save Money with Points</h2>
        </a>
    </div>
</div>

<!--SHREYA-->

<!-- Floating Report Button -->
<button class="report-btn" onclick="showModal()">Report</button>


<!-- Modal Box -->
<div class="modal" id="reportModal">
    <button class="modal-close" onclick="hideModal()">X</button>
    <h2>Report Issue</h2>
    <form action="submit_report.php" method="POST">
        <label><input type="radio" name="report_type" value="Bug"> Bug</label><br>
        <label><input type="radio" name="report_type" value="Violation"> Violation</label><br>
        <textarea name="report_description" rows="4" cols="30" placeholder="Describe the issue..." required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    function showModal() {
        document.getElementById('reportModal').style.display = 'block';
    }

    function hideModal() {
        document.getElementById('reportModal').style.display = 'none';
    }
</script>



<!--SHREYA-->

<!-- Floating Report Button -->
<button class="report-btn" onclick="showModal()">Report</button>


<!-- Modal Box -->
<div class="modal" id="reportModal">
    <button class="modal-close" onclick="hideModal()">X</button>
    <h2>Report Issue</h2>
    <form action="submit_report.php" method="POST">
        <label><input type="radio" name="report_type" value="Bug"> Bug</label><br>
        <label><input type="radio" name="report_type" value="Violation"> Violation</label><br>
        <textarea name="report_description" rows="4" cols="30" placeholder="Describe the issue..." required></textarea><br>
        <button type="submit">Submit</button>
    </form>
</div>
<script>
    function showModal() {
        document.getElementById('reportModal').style.display = 'block';
    }

    function hideModal() {
        document.getElementById('reportModal').style.display = 'none';
    }
</script>

</body>
</html>


