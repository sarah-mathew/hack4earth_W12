<?php
session_start();

// Fetching user information from session (if available), else using default placeholders.
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : '[Your Name]';
$courseName = isset($_SESSION['courseName']) ? $_SESSION['courseName'] : '[Sustainable Development]';
$completionDate = date('F j, Y');  // Current date or you can set a specific date.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Completion Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f6f5;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .certificate-container {
            width: 80%;
            max-width: 900px;
            background: white;
            padding: 40px;
            border: 10px solid #faff00;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            margin: auto;
        }
        .certificate-header {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }
        .certificate-header img {
            width: 50px;
        }
        h1 {
            font-family: 'Times New Roman';
            font-size: 36px;
            color: #2c3e50;
            margin: 20px 0;
        }
        .certificate-body {
            font-size: 20px;
            margin: 30px 0;
        }
        .certificate-footer {
            margin-top: 30px;
            font-size: 18px;
            font-weight: bold;
        }
        .stars {
            color: gold;
            font-size: 24px;
            margin: 10px 0;
        }
        .download-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="certificate-container" id="certificate">
        <h1>Techlio</h1>
        <div class="certificate-header">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Certificate Icon">
            <h1>Certificate of Completion</h1>
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Certificate Icon">
        </div>
        <div class="certificate-body">
            <p>This is to certify that</p>
            <h2><span id="userName"><?php echo htmlspecialchars($userName); ?></span></h2>
            <p>has successfully completed the course</p>
            <h3><span id="courseName"><?php echo htmlspecialchars($courseName); ?></span></h3>
            <div class="stars">⭐ ⭐ ⭐ ⭐ ⭐</div>
            <p>on <span id="completionDate"><?php echo $completionDate; ?></span></p>
        </div>
        <div class="certificate-footer">
            <p>Congratulations on your achievement!</p>
        </div>
    </div>
    <a class="download-btn" onclick="downloadCertificate()">Download Certificate</a>
    <script>
        function downloadCertificate() {
            var certificate = document.getElementById("certificate");
            html2canvas(certificate).then(canvas => {
                let link = document.createElement("a");
                link.download = "certificate.png";
                link.href = canvas.toDataURL();
                link.click();
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
</body>
</html>
