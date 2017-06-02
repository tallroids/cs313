function saveLocation(locationId){
    var locxhr = new XMLHttpRequest;
    locxhr.open('GET', 'index.php?action=saveLocation&locationId=' + locationId);
    locxhr.onload = function(e){
        if (locxhr.status == 200){
            var message = document.querySelector('.popup')
            message.innerText = "Saved Location!";
            message.style = "opacity: 1;";
            setTimeout(function(){
               message.style = "opacity: 0;";
            }, 5000);
        } else {
            var message = document.querySelector('.popup')
            message.innerText = "Error Saving Location";
            message.style = "opacity: 1;";
            setTimeout(function(){
               message.style = "opacity: 0;";
            }, 5000);
        }
    }
    locxhr.send();
}

function removeLocation(locationId){
    var locxhr = new XMLHttpRequest;
    locxhr.open('GET', 'index.php?action=removeLocation&locationId=' + locationId);
    locxhr.onload = function(e){
        if (locxhr.status == 200){
            var message = document.querySelector('.popup')
            message.innerText = "Removed Location";
            message.style = "opacity: 1;";
            setTimeout(function(){
               message.style = "opacity: 0;";
            }, 5000);
        } else {
            var message = document.querySelector('.popup')
            message.innerText = "Error Removing Location";
            message.style = "opacity: 1;";
            setTimeout(function(){
               message.style = "opacity: 0;";
            }, 5000);
        }
    }
    locxhr.send();
}