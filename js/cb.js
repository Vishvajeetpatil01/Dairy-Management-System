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
            document.getElementById('89').innerText = 'Select Customer ID';
            document.getElementById('90').innerText = 'From Date';
            document.getElementById('91').innerText = 'To Date';
            document.getElementById('92').innerText = 'NOTE : Date should be in DD-MM-YYYY format';
            document.getElementById('93').innerText = 'SL No';
            document.getElementById('94').innerText = 'CUSTOMER ID';
            document.getElementById('95').innerText = 'CUSTOMER NAME';
            document.getElementById('96').innerText = 'MILK TYP';
            document.getElementById('97').innerText = 'TOTAL MILK in LTR';
            document.getElementById('98').innerText = 'TOTAL RUPEES';
            document.getElementById('99').innerText = 'Grand Total Rupees';
            break;
        case 'mr':
            document.getElementById('89').innerText = 'ग्राहक क्र निवडा';
            document.getElementById('90').innerText = 'या तारखेपासून';
            document.getElementById('91').innerText = 'आजपर्यंत';
            document.getElementById('92').innerText = 'टीप:तारीख फॉरमॅटमध्ये असावी';
            document.getElementById('93').innerText = 'अनुक्रमांक';
            document.getElementById('94').innerText = 'ग्राहक क्र';
            document.getElementById('95').innerText = 'ग्राहकाचे नाव';
            document.getElementById('96').innerText = 'दुधाचा प्रकार ';
            document.getElementById('97').innerText = 'एकूण दूध लिटरमध्ये';
            document.getElementById('98').innerText = 'एकूण किंमत';
            document.getElementById('99').innerText = 'भव्य एकूण किंमत';
            break;
        case 'kn':
            document.getElementById('89').innerText = 'ಗ್ರಾಹಕ ಸಂಖ್ಯೆ ಆಯ್ಕೆಮಾಡಿ';
            document.getElementById('90').innerText = 'ಈ ದಿನಾಂಕದಿಂದ';
            document.getElementById('91').innerText = 'ಇವತ್ತಿನವರೆಗೆ';
            document.getElementById('92').innerText = 'ಗಮನಿಸಿ: ದಿನಾಂಕವು ಸ್ವರೂಪದಲ್ಲಿರಬೇಕು';
            document.getElementById('93').innerText = 'ಸ್ವರೂಪದಲ್ಲಿರಬೇಕು';
            document.getElementById('93').innerText = 'ಕ್ರಮ ಸಂಖ್ಯೆ';
            document.getElementById('94').innerText = 'ಗ್ರಾಹಕ ನಂ';
            document.getElementById('95').innerText = 'ಗ್ರಾಹಕ ಹೆಸರು';
            document.getElementById('96').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('97').innerText = 'ಲೀಟರ್ನಲ್ಲಿ ಒಟ್ಟು ಹಾಲು';
            document.getElementById('98').innerText = 'ಒಟ್ಟು ವೆಚ್ಚ';
            document.getElementById('99').innerText = 'ಒಟ್ಟು ದೊಡ್ಡ ಬೆಲೆ';
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