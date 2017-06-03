function checkPass(ele) {
  var container = document.getElementById('passMsg');
  var msg = "";
  if (!/\d/.test(ele.value)) {
    msg += "Password must contain a number<br>";
  } else {
    msg += "";
  }
  if (ele.value.length < 8) {
    msg += "Password must be at least 8 characters long";
  } else {
    msg += "";
  }
  var submit = document.getElementById('submit')
  if (msg == "") {
    submit.disabled = false;
    document.getElementById('passMsg').setAttribute('style', 'display:none')
  } else {
    submit.disabled = true;
    document.getElementById('passMsg').setAttribute('style', 'display:inline-block')
  }
  container.innerHTML = msg;
}

function checkMatch() {
  var msg = "";
  var submit = document.getElementById('submit')
  var pass = document.getElementById('password').value;
  var confPass = document.getElementById('confPass').value;
  if (!(pass == confPass)) {
    console.log('failed');
    submit.disabled = true;
    document.getElementById('passMsg').innerHTML = "Passwords do not match";
    document.getElementById('passMsg').setAttribute('style', 'display:inline-block')
  } else {
    console.log('passed');
    submit.disabled = false;
    document.getElementById('passMsg').innerHTML = "";
    document.getElementById('passMsg').setAttribute('style', 'display:none')
  }
}

function saveLocation(locationId) {
  var locxhr = new XMLHttpRequest;
  locxhr.open('GET', 'index.php?action=saveLocation&locationId=' + locationId);
  locxhr.onload = function (e) {
    if (locxhr.status == 200) {
      var message = document.querySelector('.popup')
      message.innerText = "Saved Location!";
      message.style = "opacity: 1;";
      setTimeout(function () {
        message.style = "opacity: 0;";
      }, 5000);
    } else {
      var message = document.querySelector('.popup')
      message.innerText = "Error Saving Location";
      message.style = "opacity: 1;";
      setTimeout(function () {
        message.style = "opacity: 0;";
      }, 5000);
    }
  }
  locxhr.send();
}

function removeLocation(locationId) {
  var locxhr = new XMLHttpRequest;
  locxhr.open('GET', 'index.php?action=removeLocation&locationId=' + locationId);
  locxhr.onload = function (e) {
    if (locxhr.status == 200) {
      var message = document.querySelector('.popup')
      message.innerText = "Removed Location";
      message.style = "opacity: 1;";
      setTimeout(function () {
        message.style = "opacity: 0;";
      }, 5000);
    } else {
      var message = document.querySelector('.popup')
      message.innerText = "Error Removing Location";
      message.style = "opacity: 1;";
      setTimeout(function () {
        message.style = "opacity: 0;";
      }, 5000);
    }
  }
  locxhr.send();
}

function filterByCategory(catId) {
  console.log("function called")
  document.querySelectorAll('.filterContent li').forEach(function (ele) {
    console.log("forEach")
    if (!(ele.getAttribute('data-categoryId') == catId)) {
      console.log("not a match")
      ele.classList.add('hidden');
      console.log("match")
    } else {
      ele.classList.remove('hidden');
    }
  })
}

window.onload=function(){
  if(document.querySelector('main').id == 'view' && document.querySelector('.popup').innerText != ""){
    console.log("called")
    var message = document.querySelector('.popup');
    message.style = "opacity: 1;";
    setTimeout(function () {
    message.style = "opacity: 0;";
    }, 5000);
  }
}