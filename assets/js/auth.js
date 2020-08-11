document.addEventListener('DOMContentLoaded', () => {
  new AuthController();
});

class AuthController {
  constructor() {
    this.alertHandler();
  }

  alertHandler() {
		var target = document.querySelector("form");
		var msg = Page.getParameterByName('msg');		

    if(msg) {
      switch(msg) {
        case '0':					
					var alert = Html.alert('danger', "I dati inseriti non sembrano essere validi", target, true);
					
					var inputs = document.querySelectorAll('form input');
					inputs.forEach(input => {
						input.addEventListener('input', () => {
							if(alert.parentNode) {alert.parentNode.removeChild(alert)};
						});
					});
					break;

				case '1':
					Html.alert('danger', "Credenziali non valide", target, true);
					break;

				case '2':
					Html.alert('success', "Registrazione effettuata con successo");
					break;

				case '3':
					Html.alert('danger', "Utente già esistente");
					break;

        default:
          Html.alert('danger', "Si è verificato un errore.");
          break;
      }
    }
  }
  
}