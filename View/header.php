<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
    echo htmlspecialchars($pageTitle); ?>
    </title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/clientStyles.css">
    <!-- Favicon would go here -->
</head>
<body>
    <header id="header">
        <div id="mainLogoSection">
            <img src="../logo/main2.png" alt="Company Logo" id="mainLogo">
        </div>
    </header>

    <script>
    // Form Validation Helper (example)
    function validateForm(formId) {
        const form = document.getElementById(formId);
        if (!form) return false;
        
        let isValid = true;
        const inputs = form.querySelectorAll('input[required]');
        
        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('error');
                isValid = false;
            } else {
                input.classList.remove('error');
            }
        });
        
        return isValid;
    }
    </script>