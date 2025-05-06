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
            document.getElementById('26').innerText = 'Collection Time';
            document.getElementById('27').innerText = 'Select Date:';
            document.getElementById('28').innerText = 'Select Session:';
            document.getElementById('29').innerText = 'Morning';
            document.getElementById('30').innerText = 'Evening'; 
            
            break;
        case 'mr':
            document.getElementById('26').innerText = 'संकलन वेळ';
            document.getElementById('27').innerText = 'तारीख निवडा';
            document.getElementById('28').innerText = 'सत्र';
            document.getElementById('29').innerText = 'सकाळ';
            document.getElementById('30').innerText = 'संध्याकाळ'; 
            break;
        case 'kn':
            document.getElementById('26').innerText = 'ಸಂಕಲನ ವೇಳ';
            document.getElementById('27').innerText = 'ದಿನಾಂಕವನ್ನು ಆಯ್ಕೆಮಾಡಿ';
            document.getElementById('28').innerText = 'ಅಧಿವೇಶನ';
            document.getElementById('29').innerText = 'ಬೆಳಿಗ್ಗೆ';
            document.getElementById('30').innerText = 'ಸಂಜೆ'; 
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