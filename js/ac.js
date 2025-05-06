function changeLanguage() {
    var languageSelect = document.getElementById('languageSelect');
    var selectedLanguage = languageSelect.value;

    // Store the selected language in local storage
    localStorage.setItem('selectedLanguage', selectedLanguage);

    switchLanguage(selectedLanguage);
}
        function switchLanguage(selectedLanguage) {
    switch (selectedLanguage) {
        case 'en':
            document.getElementById('73').innerText = 'DAIRY-CUSTOMER-DETAILS';
            document.getElementById('74').innerText = 'CUSTOMER ID';
            document.getElementById('75').innerText = 'CUSTOMER NAME';
            document.getElementById('76').innerText = 'ADDRESS';
            document.getElementById('77').innerText = 'MOBILE';
            document.getElementById('78').innerText = 'MILK TYPE';
            break;
        case 'mr':
            document.getElementById('73').innerText = 'डेअरी ग्राहक तपशील';
            document.getElementById('74').innerText = 'ग्राहक क्र ';
            document.getElementById('75').innerText = 'ग्राहकाचे नाव';
            document.getElementById('76').innerText = 'पत्ता';
            document.getElementById('77').innerText = 'मोबाईल';
            document.getElementById('78').innerText = 'दुधाचा प्रकार';
            break;
        case 'kn':
            document.getElementById('73').innerText = 'ಡೈರಿ ಗ್ರಾಹಕರ ವಿವರಗಳು';
            document.getElementById('74').innerText = 'ಗ್ರಾಹಕ ನಂ';
            document.getElementById('75').innerText = 'ಗ್ರಾಹಕ ಹೆಸರು';
            document.getElementById('76').innerText = 'ವಿಳಾಸ';
            document.getElementById('77').innerText = 'ಮೊಬೈಲ್';
            document.getElementById('78').innerText = 'ಹಾಲಿನ ವಿಧ';
            // Add more cases for other elements if needed
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