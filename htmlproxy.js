document.getElementById('proxy-form').addEventListener('submit', function(event) {
  event.preventDefault();

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      document.getElementById('proxy-container').innerHTML = xhr.responseText;
    }
  }

  xhr.open('GET', '/proxy.php?url=' + document.getElementById('url').value, true);
  xhr.send();
});
