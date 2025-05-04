INSERT INTO users (username, email, password, is_admin) 
VALUES (
    'admin',
    'admin@example.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- mot de passe: password
    TRUE
) ON DUPLICATE KEY UPDATE 
    username = VALUES(username),
    password = VALUES(password),
    is_admin = VALUES(is_admin); 