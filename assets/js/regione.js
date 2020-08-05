document.addEventListener('DOMContentLoaded', () => {
  new RegioneController();
});

class RegioneController {
  constructor() {
    $('[data-toggle="tooltip"]').tooltip();
    this.alertHandler();
    this.deleteModal();
  }

  alertHandler() {
    var msg = Page.getParameterByName('msg');

    if(msg) {
      switch(msg) {
        case '4':
          var target = document.querySelector('form .form-group');
          var alert = Html.alert('danger', "Il valore inserito non sembra essere valido.", target, true);
          
          var input = document.querySelector('form .form-control');
          input.addEventListener('input', function handler() {
            alert.parentNode.removeChild(alert);
            input.removeEventListener('input', handler);
          });
          break;
        case '3':
          Html.alert('success', "La regione è stata eliminata con successo.");
          break;
        case '2':
          Html.alert('success', "La regione è stata aggiornata con successo.");
          break;
        case '1':
          Html.alert('success', "La regione è stata aggiunta con successo.");
          break;
        case '0':
          Html.alert('danger', "Non è stato possibile eseguire l'operazione richiesta.");
          break;
        default:
          Html.alert('danger', "Si è verificato un errore.");
          break;
      }
    }
  }

  deleteModal() {
    var deleteTriggers = document.querySelectorAll('.delete');

    deleteTriggers.forEach(deleteTrigger => {
      deleteTrigger.addEventListener('click', (event) => {
        event.preventDefault();
        var deleteTriggerHref = event.currentTarget.getAttribute('href');

        $('#deleteModal').modal('show');
        
        var button = document.querySelector('.modal-footer button:last-of-type');
        button.addEventListener('click', () => {
          $('#deleteModal').modal('hide');
          window.location.href = deleteTriggerHref;
        });
      });
    });
  }
}