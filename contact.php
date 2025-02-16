<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Techlio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color:rgb(116, 149, 119);
            color: #333;
            line-height: 1.6;
        }
        header {
            background-color:rgb(44, 80, 45);
            color: #ecf0f1;
            padding: 20px;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .contact-info, .contact-form {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 15px;
            width: 45%;
            min-width: 300px;
        }
        .contact-info h2, .contact-form h2 {
            color:rgb(44, 80, 45);
            margin-top: 0;
        }
        .contact-info p {
            margin: 10px 0;
        }
        .contact-info i {
            margin-right: 10px;
            color:rgb(52, 219, 69);
        }
        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .contact-form button {
            background-color:rgb(52, 219, 69);
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color:rgb(51, 185, 41);
        }
        footer {
            background-color:rgb(44, 80, 46);
            color: #ecf0f1;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>
        <h1>Contact Techlio</h1>
    </header>

    <div class="container">
        <div class="contact-info">
            <h2>Contact Information</h2>
            <p><i class="fas fa-phone"></i> <strong>Mobile:</strong> +91 9876543210</p>
            <p><i class="fas fa-envelope"></i> <strong>Email:</strong> techlio@gmail.com</p>
            <p><i class="fas fa-map-marker-alt"></i> <strong>Address:</strong> No: 5487, 1st floor, Techlio building, Water Tank Circle, Mysore</p>
            <p><i class="fas fa-clock"></i> <strong>Working Hours:</strong> Mon - Sat, 9:00 AM - 5:00 PM</p>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="#" method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="subject" placeholder="Subject" required>
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Techlio. All rights reserved.</p>
    </footer>

</body>
</html>