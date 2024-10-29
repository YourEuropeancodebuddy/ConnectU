<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Submission Feedback</title>
    <link rel="stylesheet" href="ConnectU.css"> <!-- Link to your CSS for consistent styling -->
    <style>
        /* Feedback message styles */
        .success-message {
            color: green;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 18px;
            margin-bottom: 20px;
        }

        /* Center the content */
        .container {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }

        /* Style for the return link */
        .styled-link {
            display: inline-block;
            background-color: #FF5722; /* Bright button-like color */
            color: white; /* White text */
            padding: 15px 30px; /* Padding inside the button */
            border-radius: 25px; /* Rounded corners */
            text-decoration: none; /* Remove underline from the link */
            font-size: 18px; /* Larger font size */
            font-weight: bold; /* Make the text bold */
            text-align: center; /* Center the text */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition effects */
        }

        .styled-link:hover {
            background-color: #b43610; /* Darker color on hover */
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        .styled-link:active {
            background-color: #8c2c0b; /* Even darker when pressed */
            transform: scale(1.02); /* Slight shrink on click */
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Activity Submission</h1>

        <?php
        // Check the status passed in the URL and display the appropriate message
        if (isset($_GET['status']) && $_GET['status'] == 'success') {
            echo "<p class='success-message'>The activity was added successfully!</p>";
        } elseif (isset($_GET['status']) && $_GET['status'] == 'error') {
            echo "<p class='error-message'>There was an error adding the activity. Please try again.</p>";
        }
        ?>

        <!-- Link back to the maintenance page -->
        <a href="maintenance.html" class="styled-link">Return to Maintenance Page</a>
    </div>

</body>
</html>
