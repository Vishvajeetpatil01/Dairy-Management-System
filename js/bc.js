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
            document.getElementById('18').innerText = 'Add Buffalo Rate Chart';
            document.getElementById('19').innerText = 'FAT';
            document.getElementById('20').innerText = 'SNF';
            document.getElementById('21').innerText = 'RATE';
            break;

        case 'mr':
            document.getElementById('18').innerText = 'म्हैस रेट चार्ट';
            document.getElementById('19').innerText = 'फॅट';
            document.getElementById('20').innerText = 'एस. एन. एफ';
            document.getElementById('21').innerText = 'दर';
            
            break;

        case 'kn':
            document.getElementById('18').innerText = 'ಎಮ್ಮೆ ದರ ಚಾರ್ಟ್ ಸೇರಿಸಿ';
            document.getElementById('19').innerText = 'ಕೊಬ್ಬು';
            document.getElementById('20').innerText = 'ಎಸ್ ಎನ್ ಎಫ್';
            document.getElementById('21').innerText = 'ದರ';
            
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