document.addEventListener('DOMContentLoaded', (event) => {
  new Page();
});

class Page {
  constructor() {
    this.updateTitle();
    this.updateNavbar();
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