function changeLanguage() {
    var languageSelect = document.getElementById('languageSelect');
    var selectedLanguage = languageSelect.value;

    // Store the selected language in local storage
    localStorage.setItem('selectedLanguage', selectedLanguage);

    switchLanguage(selectedLanguage);
}

// Function to switch language based on the stored preference
function switchLanguage(selectedLanguage) {
    switch (selectedLanguage) {
        case 'en':
            document.getElementById('heading').innerText = 'DOODHSINDHU MILKS';
            document.getElementById('welcomeText').innerText = 'Welcome to Doodhsindhu Milks';
            document.getElementById('1').innerHTML = '<a href="newcustomer.php" style="color: white;">Add New Customer</a>';
            document.getElementById('2').innerHTML = '<a href="bchart.php"  style="color: white;">Buffalo Rate Chart</a>';
            document.getElementById('3').innerHTML = '<a href="cchart.php" style="color: white;">Cow Rate Chart</a>';
           
            document.getElementById('5').innerHTML = '<a href="remainingcustomer.php" style="color: white;">Remaining Customer </a>';
            document.getElementById('6').innerHTML = '<a href="allcustomer.php" style="color: white;">Get All Customer Information </a>';
            document.getElementById('7').innerHTML = '<a href="daily_report.php" style="color: white;">Daily Report </a>';
            document.getElementById('8').innerHTML = '<a href="customerbill.php" style="color: white;">Customer Bill</a>';
            document.getElementById('9').innerHTML = '<a href="login.php" style="color: white;">Logout</a>';
            document.getElementById('200').innerHTML = '<a href="collectiontime.php" style="color: white;">Daily Milk Collection</a>';
            document.getElementById('201').innerHTML = '<a href="login.php" style="color: white;">Get All Customer Information</a>';
            document.getElementById('202').innerHTML = '<a href="login.php" style="color: white;">Report</a>';
            document.getElementById('203').innerHTML = '<a href="login.php" style="color: white;">Billing</a>';
            document.getElementById('204').innerHTML = '<a href="login.php" style="color: white;">Loan</a>';
            document.getElementById('205').innerHTML = '<a href="login.php" style="color: white;">Logout</a>';
            break;
        case 'mr':
            document.getElementById('heading').innerText = 'दूधसिंधु मिल्क्स';
            document.getElementById('welcomeText').innerText = 'दुधसिंधु मिल्क्स मध्ये आपले स्वागत आहे';
            document.getElementById('1').innerHTML = '<a href="newcustomer.php" style="color: white;">नवीन ग्राहक जोडा</a>';
            document.getElementById('2').innerHTML = '<a href="bchart.php" style="color: white;">म्हैस दूध चार्ट</a>';
            document.getElementById('3').innerHTML = '<a href="cchart.php" style="color: white;">गाय दुध चार्ट</a>';
            
            document.getElementById('5').innerHTML = '<a href="remainingcustomer.php" style="color: white;">उर्वरित ग्राहक </a>';
            document.getElementById('6').innerHTML = '<a href="allcustomer.php" style="color: white;">ग्राहक माहिती </a>';
            document.getElementById('7').innerHTML = '<a href="daily_report.php" style="color: white;">एकूण दुध संकलन</a>';
            document.getElementById('8').innerHTML = '<a href="customerbill.php" style="color: white;">ग्राहकाचे बिल </a>';
            document.getElementById('9').innerHTML = '<a href="login.php" style="color: white;">बाहेर पडा </a>';
            document.getElementById('200').innerHTML = '<a href="collectiontime.php" style="color: white;">दुध संकलन</a>';
            document.getElementById('201').innerHTML = '<a href="login.php" style="color: white;">ग्राहक माहिती</a>';
            document.getElementById('202').innerHTML = '<a href="login.php" style="color: white;">अहवाल</a>';
            document.getElementById('203').innerHTML = '<a href="login.php" style="color: white;">ग्राहकाचे बिल</a>';
            document.getElementById('204').innerHTML = '<a href="login.php" style="color: white;">कर्ज</a>';
            document.getElementById('205').innerHTML = '<a href="login.php" style="color: white;">बाहेर पडा </a>';
            
        
            break;
        case 'kn':
            document.getElementById('heading').innerText = 'ಡೂಡ್ಸಿಂಧು ಮಿಲ್ಕ್ಸ್';
            document.getElementById('welcomeText').innerText = 'ದುಧಸಿಂಧು ಹಾಲುಗಳಿಗೆ ಸುಸ್ವಾಗತ';
            document.getElementById('1').innerHTML = '<a href="newcustomer.php" style="color: white;">ಹೊಸ ಗ್ರಾಹಕರನ್ನು ಸೇರಿಸಿ </a>';
            document.getElementById('2').innerHTML = '<a href="bchart.php" style="color: white;">ಎಮ್ಮೆ ಹಾಲಿನ ಚಾರ್ಟ್ </a>';
            document.getElementById('3').innerHTML = '<a href="cchart.php" style="color: white;">ಹಸುವಿನ ಹಾಲಿನ ಚಾರ್ಟ್ </a>';
            
            document.getElementById('5').innerHTML = '<a href="remainingcustomer.php" style="color: white;">ಉಳಿದ ಗ್ರಾಹಕರು </a>';
            document.getElementById('6').innerHTML = '<a href="allcustomer.php" style="color: white;">ಗ್ರಾಹಕರ ಮಾಹಿತಿ </a>';
            document.getElementById('7').innerHTML = '<a href="daily_report.php" style="color: white;">ಒಟ್ಟು ಹಾಲು ಸಂಗ್ರಹಣೆ </a>';
            document.getElementById('8').innerHTML = '<a href="customerbill.php" style="color: white;">ಗ್ರಾಹಕರ ಬಿಲ್ </a>';
            document.getElementById('9').innerHTML = '<a href="login.php" style="color: white;">ತೊಲಗು </a>';
            document.getElementById('200').innerHTML = '<a href="collectiontime.php" style="color: white;">ಹಾಲು ಸಂಗ್ರಹಣೆ</a>';
            document.getElementById('201').innerHTML = '<a href="login.php" style="color: white;">ಗ್ರಾಹಕರ ಮಾಹಿತಿ </a>';
            document.getElementById('202').innerHTML = '<a href="login.php" style="color: white;">ವರದಿ</a>';
            document.getElementById('203').innerHTML = '<a href="login.php" style="color: white;">ಗ್ರಾಹಕ ಬಿಲ್ಲಿಂಗ್</a>';
            document.getElementById('204').innerHTML = '<a href="login.php" style="color: white;">ಸಾಲ</a>';
            document.getElementById('205').innerHTML = '<a href="login.php" style="color: white;">ತೊಲಗು</a>';
            
            break;
        default:
            break;
    }
}
// On page load, check if a language preference is stored in local storage
document.addEventListener('DOMContentLoaded', function () {
    var storedLanguage = localStorage.getItem('selectedLanguage');
    if (storedLanguage) {
        // If a language preference is found, switch to that language
        switchLanguage(storedLanguage);
        // Update the language select dropdown to reflect the stored preference
        document.getElementById('languageSelect').value = storedLanguage;
    }
});