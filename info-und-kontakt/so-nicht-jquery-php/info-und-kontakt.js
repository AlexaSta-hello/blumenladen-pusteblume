/* So könnte man mit jQuery Daten schnappen, mit php  verarbeiten und als JSON speichern.
Aber das macht man so nicht! Security!! Wir arbeiten nur mit php (MVC-Modell) und mySQL.

$(function() {

    $('#js-formular').on('submit', function (e) { 
        e.preventDefault();

        let nachricht = {
            betreff: $('#betreff').val(),
            name: $('#name').val(),
            nachricht: $('#nachricht').val(),
            email: $('#email').val()
        };

        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'nachrichten.php', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                $('#js-formular').hide();
                $('#confirmation').show();
            }
        };
        xhr.send(JSON.stringify(nachricht));
    });

})

*/

