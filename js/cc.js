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
            document.getElementById('22').innerText = 'Add Cow Rate Chart';
            document.getElementById('23').innerText = 'FAT';
            document.getElementById('24').innerText = 'SNF';
            document.getElementById('25').innerText = 'RATE';
            
            break;
        case 'mr':
            document.getElementById('22').innerText = 'गाय दर चार्ट ';
            document.getElementById('23').innerText = 'फॅट';
            document.getElementById('24').innerText = 'एस. एन. एफ';
            document.getElementById('25').innerText = 'दर';
            break;
        case 'kn':
            document.getElementById('22').innerText = 'ಹಸು ದರ ಚಾರ್ಟ್';
            document.getElementById('23').innerText = 'ಕೊಬ್ಬು';
            document.getElementById('24').innerText = 'ಎಸ್ ಎನ್ ಎಫ್';
            document.getElementById('25').innerText = 'ದರ';
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