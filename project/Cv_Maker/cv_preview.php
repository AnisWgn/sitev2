<?php
// Start session to access form data
session_start();

// Redirect if no CV data is available
if (!isset($_SESSION['cv_data'])) {
    header("Location: index.php");
    exit;
}

// Access the CV data
$cv_data = $_SESSION['cv_data'];

// Function to check if a value exists and is not empty
function has_value($key) {
    global $cv_data;
    return isset($cv_data[$key]) && !empty(trim($cv_data[$key]));
}

// Generate PDF when download is requested
if (isset($_GET['download'])) {
    // You would need a PDF library like FPDF or TCPDF in a real implementation
    // This is a simple example using HTML and CSS for browser printing
    header("Content-Type: text/html");
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>CV - ' . htmlspecialchars($cv_data['name']) . '</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap");
            
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }
            
            body {
                font-family: "Open Sans", sans-serif;
                font-size: 14px;
                line-height: 1.6;
                color: #333;
                background: #fff;
                max-width: 21cm;
                margin: 0 auto;
                padding: 0;
            }
            
            .cv-container {
                display: flex;
                min-height: 29.7cm;
            }
            
            .sidebar {
                width: 35%;
                padding: 40px 25px;
                background: #2563eb;
                color: white;
            }
            
            .main-content {
                width: 65%;
                padding: 40px 30px;
            }
            
            .profile-img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                background: white;
                color: #2563eb;
                font-size: 72px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0 auto 20px;
                overflow: hidden;
                border: 5px solid rgba(255, 255, 255, 0.3);
            }
            
            .profile-name {
                font-family: "Raleway", sans-serif;
                font-size: 24px;
                font-weight: 700;
                text-align: center;
                margin-bottom: 5px;
                text-transform: uppercase;
            }
            
            .profile-title {
                font-family: "Raleway", sans-serif;
                font-size: 16px;
                text-align: center;
                margin-bottom: 30px;
                color: rgba(255, 255, 255, 0.9);
            }
            
            .contact-info {
                margin-bottom: 30px;
            }
            
            .contact-info h3 {
                font-family: "Raleway", sans-serif;
                font-size: 18px;
                text-transform: uppercase;
                margin-bottom: 15px;
                position: relative;
                padding-bottom: 10px;
            }
            
            .contact-info h3::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                width: 50px;
                height: 3px;
                background: rgba(255, 255, 255, 0.5);
            }
            
            .contact-item {
                display: flex;
                margin-bottom: 12px;
                align-items: flex-start;
            }
            
            .contact-icon {
                width: 25px;
                margin-right: 10px;
                text-align: center;
            }
            
            .contact-text {
                flex: 1;
                word-break: break-word;
            }
            
            .skills-section h3 {
                font-family: "Raleway", sans-serif;
                font-size: 18px;
                text-transform: uppercase;
                margin-bottom: 15px;
                position: relative;
                padding-bottom: 10px;
            }
            
            .skills-section h3::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                width: 50px;
                height: 3px;
                background: rgba(255, 255, 255, 0.5);
            }
            
            .skills-list {
                display: flex;
                flex-wrap: wrap;
                gap: 8px;
            }
            
            .skill-item {
                background: rgba(255, 255, 255, 0.2);
                padding: 5px 10px;
                border-radius: 15px;
                font-size: 13px;
            }
            
            .section {
                margin-bottom: 25px;
            }
            
            .section:last-child {
                margin-bottom: 0;
            }
            
            .section-title {
                font-family: "Raleway", sans-serif;
                font-size: 22px;
                font-weight: 700;
                color: #2563eb;
                text-transform: uppercase;
                margin-bottom: 15px;
                position: relative;
                padding-bottom: 10px;
            }
            
            .section-title::after {
                content: "";
                position: absolute;
                left: 0;
                bottom: 0;
                width: 70px;
                height: 3px;
                background: #2563eb;
            }
            
            .profile-text {
                margin-bottom: 20px;
                text-align: justify;
            }
            
            .education-item, .experience-item {
                margin-bottom: 20px;
                position: relative;
            }
            
            .education-title, .experience-title {
                font-weight: 600;
                margin-bottom: 5px;
                color: #1e40af;
            }
            
            .education-meta, .experience-meta {
                font-size: 14px;
                color: #6b7280;
                margin-bottom: 8px;
            }
            
            .experience-description {
                padding-left: 20px;
            }
            
            .experience-description ul {
                list-style-type: none;
            }
            
            .experience-description li {
                position: relative;
                padding-left: 15px;
                margin-bottom: 5px;
            }
            
            .experience-description li::before {
                content: "•";
                position: absolute;
                left: 0;
                color: #2563eb;
            }
            
            @media print {
                body {
                    margin: 0;
                    padding: 0;
                    box-shadow: none;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                
                .cv-container {
                    box-shadow: none;
                }
                
                @page {
                    size: A4;
                    margin: 0;
                }
            }
        </style>
    </head>
    <body>
        <div class="cv-container">
            <div class="sidebar">
                <div class="profile-img">
                    <i class="fas fa-user"></i>
                </div>
                <h1 class="profile-name">' . htmlspecialchars($cv_data['name']) . '</h1>';
                
                if (has_value('job_title')) {
                    echo '<h2 class="profile-title">' . htmlspecialchars($cv_data['job_title']) . '</h2>';
                }
                
                echo '<div class="contact-info">
                    <h3>Contact</h3>';
                    
                    if (has_value('email')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text">' . htmlspecialchars($cv_data['email']) . '</div>
                        </div>';
                    }
                    
                    if (has_value('phone')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-text">' . htmlspecialchars($cv_data['phone']) . '</div>
                        </div>';
                    }
                    
                    if (has_value('address')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text">' . htmlspecialchars($cv_data['address']) . '</div>
                        </div>';
                    }
                    
                    if (has_value('linkedin')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fab fa-linkedin-in"></i></div>
                            <div class="contact-text">' . htmlspecialchars($cv_data['linkedin']) . '</div>
                        </div>';
                    }
                    
                    if (has_value('website')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-globe"></i></div>
                            <div class="contact-text">' . htmlspecialchars($cv_data['website']) . '</div>
                        </div>';
                    }
                    
                    if (has_value('age')) {
                        echo '<div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-birthday-cake"></i></div>
                            <div class="contact-text">Age: ' . htmlspecialchars($cv_data['age']) . '</div>
                        </div>';
                    }
                    
                echo '</div>';
                
                if (has_value('skills')) {
                    echo '<div class="skills-section">
                        <h3>Skills</h3>
                        <div class="skills-list">';
                        
                        $skills = explode(',', $cv_data['skills']);
                        foreach($skills as $skill) {
                            $skill = trim($skill);
                            if(!empty($skill)) {
                                echo '<span class="skill-item">' . htmlspecialchars($skill) . '</span>';
                            }
                        }
                        
                    echo '</div>
                    </div>';
                }
                
            echo '</div>
            
            <div class="main-content">';
                if (has_value('profile')) {
                    echo '<div class="section">
                        <h2 class="section-title">Profile</h2>
                        <div class="profile-text">' . nl2br(htmlspecialchars($cv_data['profile'])) . '</div>
                    </div>';
                }
                
                if (has_value('experience')) {
                    echo '<div class="section">
                        <h2 class="section-title">Work Experience</h2>';
                        
                        $experiences = explode("\n\n", trim($cv_data['experience']));
                        foreach ($experiences as $experience) {
                            if (empty(trim($experience))) continue;
                            
                            $lines = explode("\n", $experience);
                            if (count($lines) > 0) {
                                $header = array_shift($lines);
                                $parts = explode('|', $header);
                                
                                echo '<div class="experience-item">';
                                
                                if (count($parts) >= 1) {
                                    echo '<div class="experience-title">' . htmlspecialchars(trim($parts[0])) . '</div>';
                                }
                                
                                echo '<div class="experience-meta">';
                                
                                if (count($parts) >= 2) {
                                    echo htmlspecialchars(trim($parts[1]));
                                }
                                
                                if (count($parts) >= 3) {
                                    echo ' | ' . htmlspecialchars(trim($parts[2]));
                                }
                                
                                echo '</div>';
                                
                                if (count($lines) > 0) {
                                    echo '<div class="experience-description"><ul>';
                                    
                                    foreach ($lines as $line) {
                                        $line = trim($line);
                                        if (empty($line)) continue;
                                        
                                        // Remove bullet points if they exist
                                        $line = ltrim($line, '•-* ');
                                        echo '<li>' . htmlspecialchars($line) . '</li>';
                                    }
                                    
                                    echo '</ul></div>';
                                }
                                
                                echo '</div>';
                            }
                        }
                        
                    echo '</div>';
                }
                
                if (has_value('education')) {
                    echo '<div class="section">
                        <h2 class="section-title">Education</h2>';
                        
                        $educations = explode("\n\n", $cv_data['education']);
                        foreach ($educations as $education) {
                            if (empty(trim($education))) continue;
                            
                            $lines = explode("\n", $education);
                            echo '<div class="education-item">';
                            
                            if (isset($lines[0]) && !empty($lines[0])) {
                                echo '<div class="education-title">' . htmlspecialchars(trim($lines[0])) . '</div>';
                            }
                            
                            if (isset($lines[1]) && !empty($lines[1])) {
                                echo '<div class="education-meta">' . htmlspecialchars(trim($lines[1])) . '</div>';
                            }
                            
                            echo '</div>';
                        }
                        
                    echo '</div>';
                }
                
            echo '</div>
        </div>
        
        <script>
            // Auto print when page loads
            window.onload = function() {
                window.print();
            };
        </script>
    </body>
    </html>';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Preview</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap");
        
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --light-bg: #f3f4f6;
            --border-color: #e5e7eb;
            --text-color: #1f2937;
            --light-text: #6b7280;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
            padding: 30px 20px;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h1 {
            font-family: 'Raleway', sans-serif;
            color: var(--primary-color);
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: var(--light-text);
            font-size: 18px;
        }
        
        .preview-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .cv-container {
            display: flex;
            min-height: 800px;
        }
        
        .sidebar {
            width: 35%;
            padding: 40px 25px;
            background: var(--primary-color);
            color: white;
        }
        
        .main-content {
            width: 65%;
            padding: 40px 30px;
        }
        
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: white;
            color: var(--primary-color);
            font-size: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            overflow: hidden;
            border: 5px solid rgba(255, 255, 255, 0.3);
        }
        
        .profile-name {
            font-family: 'Raleway', sans-serif;
            font-size: 24px;
            font-weight: 700;
            text-align: center;
            margin-bottom: 5px;
            text-transform: uppercase;
        }
        
        .profile-title {
            font-family: 'Raleway', sans-serif;
            font-size: 16px;
            text-align: center;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .contact-info {
            margin-bottom: 30px;
        }
        
        .contact-info h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
            text-transform: uppercase;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .contact-info h3::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: rgba(255, 255, 255, 0.5);
        }
        
        .contact-item {
            display: flex;
            margin-bottom: 12px;
            align-items: flex-start;
        }
        
        .contact-icon {
            width: 25px;
            margin-right: 10px;
            text-align: center;
        }
        
        .contact-text {
            flex: 1;
            word-break: break-word;
        }
        
        .skills-section h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 18px;
            text-transform: uppercase;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .skills-section h3::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: rgba(255, 255, 255, 0.5);
        }
        
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .skill-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 13px;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section:last-child {
            margin-bottom: 0;
        }
        
        .section-title {
            font-family: 'Raleway', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .section-title::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 70px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .profile-text {
            margin-bottom: 20px;
            text-align: justify;
        }
        
        .education-item, .experience-item {
            margin-bottom: 20px;
            position: relative;
        }
        
        .education-title, .experience-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--secondary-color);
        }
        
        .education-meta, .experience-meta {
            font-size: 14px;
            color: var(--light-text);
            margin-bottom: 8px;
        }
        
        .experience-description {
            padding-left: 20px;
        }
        
        .experience-description ul {
            list-style-type: none;
        }
        
        .experience-description li {
            position: relative;
            padding-left: 15px;
            margin-bottom: 5px;
        }
        
        .experience-description li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: var(--primary-color);
        }
        
        .buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            background: var(--primary-color);
            color: white;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .btn i {
            margin-right: 8px;
        }
        
        .btn-secondary {
            background: #ef4444;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        @media (max-width: 768px) {
            .cv-container {
                flex-direction: column;
            }
            
            .sidebar, .main-content {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>CV Preview</h1>
            <p class="subtitle">Review your professional CV before downloading</p>
        </div>
        
        <div class="preview-container">
            <div class="cv-container">
                <div class="sidebar">
                    <div class="profile-img">
                        <i class="fas fa-user"></i>
                    </div>
                    <h1 class="profile-name"><?php echo htmlspecialchars($cv_data['name']); ?></h1>
                    
                    <?php if (has_value('job_title')): ?>
                    <h2 class="profile-title"><?php echo htmlspecialchars($cv_data['job_title']); ?></h2>
                    <?php endif; ?>
                    
                    <div class="contact-info">
                        <h3>Contact</h3>
                        
                        <?php if (has_value('email')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div class="contact-text"><?php echo htmlspecialchars($cv_data['email']); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_value('phone')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div class="contact-text"><?php echo htmlspecialchars($cv_data['phone']); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_value('address')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text"><?php echo htmlspecialchars($cv_data['address']); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_value('linkedin')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fab fa-linkedin-in"></i></div>
                            <div class="contact-text"><?php echo htmlspecialchars($cv_data['linkedin']); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_value('website')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-globe"></i></div>
                            <div class="contact-text"><?php echo htmlspecialchars($cv_data['website']); ?></div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if (has_value('age')): ?>
                        <div class="contact-item">
                            <div class="contact-icon"><i class="fas fa-birthday-cake"></i></div>
                            <div class="contact-text">Age: <?php echo htmlspecialchars($cv_data['age']); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if (has_value('skills')): ?>
                    <div class="skills-section">
                        <h3>Skills</h3>
                        <div class="skills-list">
                            <?php
                            $skills = explode(',', $cv_data['skills']);
                            foreach($skills as $skill) {
                                $skill = trim($skill);
                                if(!empty($skill)) {
                                    echo '<span class="skill-item">' . htmlspecialchars($skill) . '</span>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="main-content">
                    <?php if (has_value('profile')): ?>
                    <div class="section">
                        <h2 class="section-title">Profile</h2>
                        <div class="profile-text"><?php echo nl2br(htmlspecialchars($cv_data['profile'])); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (has_value('experience')): ?>
                    <div class="section">
                        <h2 class="section-title">Work Experience</h2>
                        
                        <?php
                        $experiences = explode("\n\n", trim($cv_data['experience']));
                        foreach ($experiences as $experience) {
                            if (empty(trim($experience))) continue;
                            
                            $lines = explode("\n", $experience);
                            if (count($lines) > 0) {
                                $header = array_shift($lines);
                                $parts = explode('|', $header);
                                
                                echo '<div class="experience-item">';
                                
                                if (count($parts) >= 1) {
                                    echo '<div class="experience-title">' . htmlspecialchars(trim($parts[0])) . '</div>';
                                }
                                
                                echo '<div class="experience-meta">';
                                
                                if (count($parts) >= 2) {
                                    echo htmlspecialchars(trim($parts[1]));
                                }
                                
                                if (count($parts) >= 3) {
                                    echo ' | ' . htmlspecialchars(trim($parts[2]));
                                }
                                
                                echo '</div>';
                                
                                if (count($lines) > 0) {
                                    echo '<div class="experience-description"><ul>';
                                    
                                    foreach ($lines as $line) {
                                        $line = trim($line);
                                        if (empty($line)) continue;
                                        
                                        // Remove bullet points if they exist
                                        $line = ltrim($line, '•-* ');
                                        echo '<li>' . htmlspecialchars($line) . '</li>';
                                    }
                                    
                                    echo '</ul></div>';
                                }
                                
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (has_value('education')): ?>
                    <div class="section">
                        <h2 class="section-title">Education</h2>
                        
                        <?php
                        $educations = explode("\n\n", $cv_data['education']);
                        foreach ($educations as $education) {
                            if (empty(trim($education))) continue;
                            
                            $lines = explode("\n", $education);
                            echo '<div class="education-item">';
                            
                            if (isset($lines[0]) && !empty($lines[0])) {
                                echo '<div class="education-title">' . htmlspecialchars(trim($lines[0])) . '</div>';
                            }
                            
                            if (isset($lines[1]) && !empty($lines[1])) {
                                echo '<div class="education-meta">' . htmlspecialchars(trim($lines[1])) . '</div>';
                            }
                            
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="buttons">
            <a href="index.php" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit CV</a>
            <a href="?download=true" target="_blank" class="btn"><i class="fas fa-download"></i> Download CV</a>
        </div>
    </div>
</body>
</html>