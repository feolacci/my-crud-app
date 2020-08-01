document.addEventListener('DOMContentLoaded', (event) => {
  new Page();
  new Controller();
});

class Page {
  constructor() {
    this.updateTitle();
    this.updateNavbar();
    this.showAlert();
  }

  updateTitle() {
    var titleElem = document.getElementsByTagName('title');

    switch(this.getParameterByName('r')) {
      case 'regioni':
        titleElem[0].textContent += " - Lista delle regioni";
        break;
      case 'regione':
        var regione = this.getParameterByName('regione');
        titleElem[0].textContent += " - Dettaglio della regione: " + regione;
        break;
    }
  }

  updateNavbar() {
    var url = window.location.href;
    var pathname = url.substring(
      url.lastIndexOf('/') + 1,
      url.indexOf('?')
    );

    var navItems = document.querySelectorAll('ul.navbar-nav .nav-item > a');
    navItems.forEach(navItem => {
      var navItemPathname = navItem.href.substring(
        navItem.href.lastIndexOf('/') + 1,
        navItem.href.indexOf('?')
      );
      
      if(pathname == navItemPathname) {
        navItem.parentElement.classList.add('active');
      }
    });
  }

  showAlert() {
    var html = new Html();
    var container = document.querySelector('div.container');

    var msg = this.getParameterByName('msg');
    if(msg) {
      switch(msg) {
        case '3':
          container.prepend(html.createAlert('success', "La regione è stata cancellata con successo."));
          break;
        case '2':
          container.prepend(html.createAlert('success', "La regione è stata aggiornata con successo."));
          break;
        case '1':
          container.prepend(html.createAlert('success', "La regione è stata aggiunta con successo."));
          break;
        case '0':
          container.prepend(html.createAlert('danger', "Non è stato possibile eseguire l'operazione richiesta."));
          break;
        default:
          container.prepend(html.createAlert('danger', "Si è verificato un errore."));
          break;
      }
    }
  }

  getParameterByName(name, url) {
    if(!url) {url = window.location.href;}
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if(!results) {return null;}
    if(!results[2]) {return '';}
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
}

class Controller {
  constructor() {
    var elems = document.querySelectorAll(".delete");

    elems.forEach(el => {
      el.addEventListener("click", (e) => {
        e.preventDefault();
        let x = e.currentTarget.getAttribute("href");

        $('#exampleModal').modal('show');
        var btnSave = document.querySelector('.modal-footer button:last-of-type');
        btnSave.addEventListener('click', () => {
          $('#myModal').modal('hide');
          window.location.href = x;
        });
      });
    });
  }
}

class Html {
  div() {}

  createAlert(type, msg) {
    let div = document.createElement('div');
    div.classList.add('alert', 'alert-' + type);
    div.setAttribute('role', 'alert');
    div.textContent = msg;
    return div;
  }
}