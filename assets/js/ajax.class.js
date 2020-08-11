class Ajax {
	static form(action, form, callback) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        var result = JSON.parse(this.responseText);
        callback(result);
      }
    };
    
    xhr.open('POST', action, true);
    form ? xhr.send(new FormData(form)) : xhr.send();
  }

  static basic(action, callback) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        var result = JSON.parse(this.responseText);
        callback(result);
      }
    };
    
    xhr.open('POST', action, true);
    xhr.send();
  }
}