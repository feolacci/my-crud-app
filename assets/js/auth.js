document.addEventListener('DOMContentLoaded', () => {
  new AuthController();
});

class AuthController {
  constructor() {
    this.alertHandler();
  }

  alertHandler() {
		var target = document.querySelector('form div:last-of-type');
		var msg = Page.getParameterByName('msg');

    if(msg) {
      switch(msg) {
        case '0':
					var alert = Html.alert('danger', "I valori inseriti non sembrano essere validi.", target, true);
					
					var inputs = document.querySelectorAll('form input');
					inputs.forEach(input => {
						input.addEventListener('input', () => {
							if(alert.parentNode) {alert.parentNode.removeChild(alert)};
						});
					});
					break;
				case '1':
					Html.alert('danger', "Le credenziali inserite non risultano corrette.", target, true);
					break;
				case '2':
					Html.alert('success', "Ci siamo quasi, per completare la registrazione clicca sul link nella email che ti abbiamo appena inviato.");
					break;
				case '3':
					Html.alert('danger', "Email già in uso. Fai login per accedere o usa una mail diversa per registrarti.");
					break;
				case '4':
					Html.alert('danger', "Account non attivo, verifica il tuo indirizzo email per attivare l'account.");
					break;
				case '5':
				Html.alert('success', "Il tuo account è stato attivato, ora puoi utilizzare le tue credenziali per effettuare l'accesso.");
				break;
        default:
          Html.alert('danger', "Si è verificato un errore.");
          break;
      }
    }
  }
}