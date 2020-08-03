document.addEventListener('DOMContentLoaded', () => {
  new Page();
});

class Page {
  constructor() {
    this.updateTitle();
    this.updateNavbar();
  }

  updateTitle() {
    var titleElem = document.getElementsByTagName('title');

    switch(Page.getParameterByName('r')) {
      case 'regioni':
        titleElem[0].textContent += " - Lista delle regioni";
        break;
      case 'regione':
        var regione = Page.getParameterByName('id');
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

  static getParameterByName(name, url) {
    if(!url) {url = window.location.href;}
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if(!results) {return null;}
    if(!results[2]) {return '';}
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
}