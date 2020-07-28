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
      case 'ListaRegioni':
        titleElem[0].textContent += " - Lista delle regioni";
        break;
      case 'RegioneDetail':
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
    var alerts = [ 
      document.querySelector(".alert-success"), //[0]
      document.querySelector(".alert-danger")   //[1]
    ];
    var msg = this.getParameterByName("msg");
    //msg ? alerts[0].classList.remove("d-none") : alerts[1].classList.remove("d-none");
    switch(msg) {
      case '1':
        alerts[0].classList.remove("d-none");
        break;

      case '0':
        alerts[1].classList.remove("d-none");
        break;
    
      default:
        break;
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
        var r = confirm("Sei sicuro?");
        if (r == true) {
          window.location.href = e.currentTarget.getAttribute("href");
        } else {
          
        }
      });
    });
  }
}