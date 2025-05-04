<?php
// Start session to store form data
session_start();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $_SESSION['cv_data'] = [
        'name' => $_POST['name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'phone' => $_POST['phone'] ?? '',
        'address' => $_POST['address'] ?? '',
        'age' => $_POST['age'] ?? '',
        'education' => $_POST['education'] ?? '',
        'skills' => $_POST['skills'] ?? '',
        'experience' => $_POST['experience'] ?? '',
        'profile' => $_POST['profile'] ?? '',
        'job_title' => $_POST['job_title'] ?? '',
        'linkedin' => $_POST['linkedin'] ?? '',
        'website' => $_POST['website'] ?? ''
    ];
    
    // Redirect to CV preview page
    header("Location: cv_preview.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Maker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-bg);
            padding: 30px 20px;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        h1 {
            color: var(--primary-color);
            font-size: 32px;
            margin-bottom: 10px;
        }
        
        .subtitle {
            color: var(--light-text);
            font-size: 18px;
        }
        
        .form-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .form-container form {
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }
        
        .section-title {
            display: flex;
            align-items: center;
            font-size: 22px;
            color: var(--primary-color);
            margin-bottom: 20px;
        }
        
        .section-title i {
            margin-right: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-col {
            flex: 1;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text-color);
        }
        
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
        }
        
        textarea {
            height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 14px 30px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            display: block;
            margin: 30px auto 0;
            transition: all 0.3s ease;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .submit-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        .hint {
            font-size: 14px;
            color: var(--light-text);
            margin-top: 5px;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Professional CV Maker</h1>
            <p class="subtitle">Create a stunning CV in minutes</p>
        </div>
        
        <div class="form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-user"></i> Personal Information</h2>
                    
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="job_title">Job Title/Position:</label>
                        <input type="text" id="job_title" name="job_title" placeholder="e.g. Senior Web Developer">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-col">
                            <label for="phone">Phone:</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address" placeholder="City, Country">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <label for="age">Age:</label>
                            <input type="number" id="age" name="age" min="16" max="100">
                        </div>
                        
                        <div class="form-col">
                            <label for="linkedin">LinkedIn:</label>
                            <input type="url" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/yourprofile">
                        </div>
                        
                        <div class="form-col">
                            <label for="website">Website/Portfolio:</label>
                            <input type="url" id="website" name="website" placeholder="https://yourwebsite.com">
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-bookmark"></i> Profile Summary</h2>
                    <div class="form-group">
                        <label for="profile">Professional Profile:</label>
                        <textarea id="profile" name="profile" placeholder="Write a compelling summary of your professional background, skills, and career objectives (2-4 sentences recommended)"></textarea>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-graduation-cap"></i> Education</h2>
                    <div class="form-group">
                        <label for="education">Education Details:</label>
                        <textarea id="education" name="education" placeholder="Degree, Institution, Year - One per line&#10;&#10;Example:&#10;Bachelor of Science in Computer Science&#10;University of Technology, 2015-2019&#10;&#10;High School Diploma&#10;Central High School, 2011-2015"></textarea>
                        <p class="hint">List your education in reverse chronological order (most recent first)</p>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-briefcase"></i> Work Experience</h2>
                    <div class="form-group">
                        <label for="experience">Work Experience:</label>
                        <textarea id="experience" name="experience" placeholder="Job Title | Company Name | Duration&#10;• Responsibility/Achievement&#10;• Responsibility/Achievement&#10;&#10;Example:&#10;Senior Web Developer | Tech Solutions Inc. | 2019-Present&#10;• Developed and maintained client websites using HTML, CSS, JavaScript, and PHP&#10;• Led a team of 5 junior developers and improved project delivery time by 20%"></textarea>
                        <p class="hint">List your work experience in reverse chronological order (most recent first)</p>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-tools"></i> Skills</h2>
                    <div class="form-group">
                        <label for="skills">Skills:</label>
                        <textarea id="skills" name="skills" placeholder="List your skills, separated by commas&#10;&#10;Example: HTML, CSS, JavaScript, PHP, MySQL, Photoshop, Team Leadership, Project Management"></textarea>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">Create My CV</button>
            </form>
        </div>
    </div>
    
    <script>
        // Simple form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const requiredFields = document.querySelectorAll('[required]');
            let valid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.style.borderColor = '#ef4444';
                } else {
                    field.style.borderColor = '#e5e7eb';
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Please fill in all required fields');
            }
        });
    </script>
</body>
</html>