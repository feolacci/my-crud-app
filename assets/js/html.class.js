class Html {
  static alert(type, msg, target = false, prepend = false) {
    if(!target) {target = document.querySelector('div.container');}
    
    var div = document.createElement('div');
    div.classList.add('alert', 'alert-' + type, 'alert-dismissible', 'show');
    div.setAttribute('role', 'alert');
    div.textContent = msg;

    var button = document.createElement('button');
    button.classList.add('close');
    button.setAttribute('type', 'button');
    button.setAttribute('data-dismiss', 'alert');

    var span = document.createElement('span');
    span.innerHTML = "&times;";

    button.append(span);
    div.append(button);

    prepend ? target.append(div) : target.prepend(div);
    return div;
  }
}