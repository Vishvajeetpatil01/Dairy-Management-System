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
            document.getElementById('79').innerText = 'From Date';
            document.getElementById('80').innerText = 'To Date';
            document.getElementById('81').innerText = 'NOTE : Date should be in YYYY-MM-DD format';
            document.getElementById('82').innerText = 'SL No';
            document.getElementById('83').innerText = 'CUSTOMER ID';
            document.getElementById('84').innerText = 'CUSTOMER NAME';
            document.getElementById('85').innerText = 'MILK TYPE';
            document.getElementById('86').innerText = 'TOTAL MILK in LTR';
            document.getElementById('87').innerText = 'TOTAL RUPEES';
            document.getElementById('88').innerText = ' Grand Total Rupees';
            break;
        case 'mr':
            document.getElementById('79').innerText = 'या तारखेपासून';
            document.getElementById('80').innerText = 'आजपर्यंत';
            document.getElementById('81').innerText = 'टीप:तारीख फॉरमॅटमध्ये असावी';
            document.getElementById('82').innerText = 'अनुक्रमांक';
            document.getElementById('83').innerText = 'ग्राहक क्र';
            document.getElementById('84').innerText = 'ग्राहकाचे नाव';
            document.getElementById('85').innerText = 'दुधाचा प्रकार';
            document.getElementById('86').innerText = 'एकूण दूध लिटरमध्ये';
            document.getElementById('87').innerText = 'एकूण किंमत';
            document.getElementById('88').innerText = 'भव्य एकूण किंमत';
            break;
        case 'kn':
            document.getElementById('79').innerText = 'ಈ ದಿನಾಂಕದಿಂದ';
            document.getElementById('80').innerText = 'ಇವತ್ತಿನವರೆಗೆ';
            document.getElementById('81').innerText = 'ಗಮನಿಸಿ: ದಿನಾಂಕವು ಸ್ವರೂಪದಲ್ಲಿರಬೇಕು';
            document.getElementById('82').innerText = 'ಕ್ರಮ ಸಂಖ್ಯೆ';
            document.getElementById('83').innerText = 'ಗ್ರಾಹಕ ನಂ';
            document.getElementById('84').innerText = 'ಗ್ರಾಹಕ ಹೆಸರು';
            document.getElementById('85').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('86').innerText = 'ಲೀಟರ್ನಲ್ಲಿ ಒಟ್ಟು ಹಾಲು';
            document.getElementById('87').innerText = 'ಒಟ್ಟು ವೆಚ್ಚ';
            document.getElementById('88').innerText = 'ಒಟ್ಟು ದೊಡ್ಡ ಬೆಲೆ';
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