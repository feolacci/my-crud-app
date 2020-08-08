class Ajax {
	constructor(){
    
	}

	static form(form, action, callback) {
    var xhr = new XMLHttpRequest();

    var result;
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        result = JSON.parse(this.responseText);
        callback(result);
      }
    };
    
    xhr.open("POST", action, true);
    xhr.send(new FormData(form));

	}
}