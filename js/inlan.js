
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
            document.getElementById('10').innerText = 'Customer No.';
            document.getElementById('17').innerText = 'Customer';
            document.getElementById('11').innerText = 'Name';
            document.getElementById('12').innerText = 'Address';
            document.getElementById('13').innerText = 'Mobile No';
            document.getElementById('14').innerText = ' Milk Type ';
            document.getElementById('15').innerText = 'Buffalo';
            document.getElementById('16').innerText = 'Cow';
            // Add more cases for other elements if needed
            break;
        case 'mr':
            document.getElementById('10').innerText = 'ग्राहक क्रमांक';
            document.getElementById('17').innerText = 'ग्राहक';
            document.getElementById('11').innerText = 'नाव ';
            document.getElementById('12').innerText = 'पत्ता';
            document.getElementById('13').innerText = 'मोबाईल';
            document.getElementById('14').innerText = 'दुधाचे प्रकार ';
            document.getElementById('15').innerText = ' म्हैस';
            document.getElementById('16').innerText = 'गाय ';
            break;
        case 'kn':
            document.getElementById('10').innerText = 'ಗ್ರಾಹಕ ಸಂಖ್ಯೆ';
            document.getElementById('17').innerText = 'ಗ್ರಾಹಕ';
            document.getElementById('11').innerText = 'ಗ್ರಾಹಕ ಸಂ ';
            document.getElementById('12').innerText = 'ಗವಿಳಾಸ ';
            document.getElementById('13').innerText = 'ಗಮೊಬೈಲ್ ';
            document.getElementById('14').innerText = 'ಹಾಲಿನ ವಿಧ';
            document.getElementById('15').innerText = ' ಎಮ್ಮೆ';
            document.getElementById('16').innerText = 'ಹಸು ';
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