window.onload = function () {
    var lookupBtn = document.querySelector('#lookup');
    var cityBtn = document.querySelector('#city');

    lookupBtn.addEventListener('click', searchCountry);
    cityBtn.addEventListener('click', searchCountry);

    function searchCountry () {
        //console.log('button clicked');
        var lookupVal = document.querySelector('#country').value;
        fetch('http://localhost/info2180-lab5/world.php?country='+lookupVal+'&lookup=cities')
            .then(response => response.text())
            .then(data => {
                let result = document.querySelector('#result');
                result.innerHTML = data;
            })
            .catch(error => console.log(error));
    }

}