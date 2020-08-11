class Html {
  static alert(type, msg, target = false, append = false) {
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

    append ? target.append(div) : target.prepend(div);
    return div;
  }

  static modal(id, title, body, btn = false) {
    if(!btn) {btn = ['btn-primary', 'Conferma'];}
    var modal;

    var div = document.createElement('div');
    div.setAttribute('id', id);
    div.classList.add('modal', 'fade');
    div.setAttribute('tabindex', '-1');
    div.setAttribute('role', 'dialog');
    modal = div;

    div = document.createElement('div');
    div.classList.add('modal-dialog', 'modal-dialog-centered');
    modal.appendChild(div);

    div = document.createElement('div');
    div.classList.add('modal-content');
    modal.querySelector('.modal-dialog').appendChild(div);

    div = document.createElement('div');
    div.classList.add('modal-header');

    var h5 = document.createElement('h5');
    h5.classList.add('modal-title');
    h5.textContent = title;
    div.appendChild(h5);

    var button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.classList.add('close');
    button.setAttribute('data-dismiss', 'modal');

    var span = document.createElement('span');
    span.innerHTML = "&times;";
    button.appendChild(span);

    div.appendChild(button);
    modal.querySelector('.modal-content').appendChild(div);

    div = document.createElement('div');
    div.classList.add('modal-body');
    div.append(body);
    modal.querySelector('.modal-content').appendChild(div);

    div = document.createElement('div');
    div.classList.add('modal-footer');

    button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.classList.add('btn', 'btn-secondary');
    button.setAttribute('data-dismiss', 'modal');
    button.textContent = "Annulla";
    div.appendChild(button);

    button = document.createElement('button');
    button.setAttribute('type', 'button');
    button.classList.add('btn', btn[0], 'submit');
    button.textContent = btn[1];
    div.appendChild(button);

    modal.querySelector('.modal-content').appendChild(div);

    document.querySelector('body').appendChild(modal);
  }
}

class Table extends Html {
  constructor(object) {
    var table;
    table = document.createElement('table');
    table.classList.add('table', 'table-hover', 'table-bordered');
    
    var thead = table.createTHead();
    var tr = thead.insertRow();

    object.columns.forEach(element => {
      var th = document.createElement('th');
      th.textContent = element;
      tr.appendChild(th);
    });

    thead.appendChild(tr);
    table.appendChild(thead);

    var tbody = table.createTBody();
    
    object.data.forEach(element => {
      tr = tbody.insertRow();

      for(let i = 0; i < element.length; i++) {
        var td = document.createElement('td');
        typeof element[i] === 'string' ? td.textContent = element[i] : td.appendChild(element[i]);
        tr.appendChild(td);
      }

      tbody.appendChild(tr);
    });

    table.appendChild(tbody);

    super();
    this.table = table;
  }

  render(wrapper) {
    wrapper.textContent = '';
    wrapper.appendChild(this.table);
  }

  static controls(idProvincia) {
    var controls = document.createElement('div');

    var a = document.createElement('a');
    a.classList.add('btn', 'btn-primary', 'btn-sm', 'disabled');
    a.setAttribute('href', '#');
    a.setAttribute('data-toggle', 'tooltip');
    a.setAttribute('title', 'Modifica provincia');
    $(a).tooltip();

    var i = document.createElement('i');
    i.classList.add('fa', 'fa-pencil');
    a.appendChild(i);
    controls.appendChild(a);

    var a = document.createElement('a');
    a.classList.add('deleteProvinciaTrigger', 'btn', 'btn-danger', 'btn-sm');
    a.setAttribute('href', 'provincia.controller.php?r=deleteProvincia&id=' + idProvincia);
    a.setAttribute('data-toggle', 'tooltip');
    a.setAttribute('title', 'Rimuovi provincia');
    $(a).tooltip();

    var i = document.createElement('i');
    i.classList.add('fa', 'fa-times');
    a.appendChild(i);
    controls.appendChild(a);

    return controls;
  }
}