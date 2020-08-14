document.addEventListener('DOMContentLoaded', () => {
  new Page();
});

class Page {
  constructor() {
    this.updateNavbar();
  }

  updateNavbar() {
    var url = window.location.href;
    var param = Page.getParameterByName('r', url);
    var pathname = url.substring(
      url.lastIndexOf('/') + 1,
      url.indexOf('?')
    );

    var navItems = document.querySelectorAll('ul.navbar-nav .nav-item > a');
    navItems.forEach(navItem => {
      var navItemParam = Page.getParameterByName('r', navItem.href);
      var navItemPathname = navItem.href.substring(
        navItem.href.lastIndexOf('/') + 1,
        navItem.href.indexOf('?')
      );

      if(param == navItemParam && pathname == navItemPathname) {
        navItem.parentElement.classList.add('active');
      }
    });
  }

  static getParameterByName(name, url) {
    // https://stackoverflow.com/a/901144
    
    if(!url) {url = window.location.href;}
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if(!results) {return null;}
    if(!results[2]) {return '';}
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
  }
}