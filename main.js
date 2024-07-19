const btnData = document.getElementById('btnGetData');

btnData.addEventListener('click', function() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState === XMLHttpRequest.DONE) {
            if(xhr.status === 200) {
                try {
                    var response = JSON.parse(xhr.responseText);
                    // console.log('test');

                    if(response.error) {
                        document.getElementById('dataContainer').innerHTML = "Erreur : " + response.error;
                    } else if(response.length > 0) {
                        var html = "<ul>";
                        response.forEach(function(data) {
                            html += "<li>"+data.name +"-" + data.email + "</li>";
                        });
                        html += "</ul>";
                        document.getElementById('dataContainer').innerHTML = html;
                    } else {
                        document.getElementById('dataContainer').innerHTML = "Aucunes données trouvées";
                    }
                } catch(error) {
                    // console.log('coucou', error);
                    document.getElementById('dataContainer').innerHTML = "Erreur de parsing JSON : " + error.message;
                }
            } else {
                document.getElementById('dataContainer').innerHTML = "Une erreur s'est produite lors de la récupération des données";
            }
        }
    };
    xhr.open("GET", "get_data.php", true);
    xhr.send();
});