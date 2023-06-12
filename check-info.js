document.addEventListener('DOMContentLoaded', function() {
            checkUserInformation();
        });
    
        function checkUserInformation() {
            // Make an AJAX request to the server-side PHP script
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'check_user_info.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Display the message returned by the PHP script
                    document.getElementById('message').innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
