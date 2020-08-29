document.addEventListener('DOMContentLoaded', () => {
  new RegioneController();
});

class RegioneController {
  constructor() {
    $('[data-toggle="tooltip"]').tooltip();
    this.alertHandler();
    this.deleteRegione();
  }

  alertHandler() {
    var msg = Page.getParameterByName('msg');
    var targetImgRegione = document.querySelector('form .form-group:last-of-type');
    var targetDescRegione = document.querySelector('form .form-group:nth-child(2)');

    if(msg) {
      switch(msg) {
        case '10':
          Html.alert('danger', "Non è stato possibile caricare il file.", targetImgRegione, true);
          break;
        case '9':
          Html.alert('danger', "Estensioni consentite: JPG, JPEG, PNG, GIF.", targetImgRegione, true);
          break;
        case '8':
          Html.alert('danger', "L'immagine è troppo grande.", targetImgRegione, true);
          break;
        case '7':
          Html.alert('danger', "L'immagine già esiste.", targetImgRegione, true);
          break;
        case '6':
          Html.alert('danger', "Il file non è un'immagine.", targetImgRegione, true);
          break;
        case '5':
          Html.alert('danger', "La regione è già presente.");
          break;
        case '4':
          var alert = Html.alert('danger', "Il valore inserito non sembra essere valido.", targetDescRegione, true);
          
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

  deleteRegione() {
    var deleteTriggers = document.querySelectorAll('.deleteRegioneTrigger');
    deleteTriggers.forEach(deleteTrigger => {
      deleteTrigger.addEventListener('click', (event) => {
        event.preventDefault();
        var deleteTriggerHref = event.currentTarget.getAttribute('href');

        var modal = document.getElementById('deleteRegione');
        if(!modal) {
          Html.modal(
            'deleteRegione',
            'Rimuovi regione',
            'Sei sicuro di voler rimuovere la regione selezionata?',
            ['btn-danger', 'Rimuovi']
          );

          var button = document.querySelector('#deleteRegione .submit');
          button.addEventListener('click', () => {
            $('#deleteRegione').modal('hide');
            window.location.href = deleteTriggerHref;
          });
        }

        $('#deleteRegione').modal('show');
      });
    });
  }
}