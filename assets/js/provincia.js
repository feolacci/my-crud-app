document.addEventListener('DOMContentLoaded', () => {
  new ProvinciaController();
});

class ProvinciaController {
  constructor() {
    this.table();
    this.addProvincia();
    
  }

  table() {
    Ajax.basic(
      "provincia.controller.php?r=province&id=" + Page.getParameterByName('id'),
      (results) => {
        if(!results.message) {
          var data = [];
          results.forEach(result => {
            data.push([
              result.provincia_sigla,
              result.provincia,
              Table.controls(result.id_province)
            ]);
          });

          new Table({
            columns: ["Sigla", "Provincia", null],
            data: data
          }).render(document.getElementById('wrapper'));

          this.deleteProvincia();
        } else {
          var wrapper = document.getElementById('wrapper');
          wrapper.textContent = "";
          var p = document.createElement('p');
          p.textContent = results.message;
          wrapper.appendChild(p);
        }
      }
    );
  }

  form() {
    var form = document.createElement('form');
    form.setAttribute('method', 'POST');

    var div = document.createElement('div');
    div.classList.add('form-group');

    var label = document.createElement('label');
    label.setAttribute('for', 'nameProvincia');
    label.textContent = "Nome provincia";
    div.appendChild(label);

    var input = document.createElement('input');
    input.setAttribute('id', 'nameProvincia');
    input.setAttribute('name', 'nameProvincia');
    input.classList.add('form-control');
    input.setAttribute('placeholder', 'Inserisci nome provincia');
    input.setAttribute('type', 'text');
    input.setAttribute('required', 'required');
    div.appendChild(input);

    form.appendChild(div);

    div = document.createElement('div');
    div.classList.add('form-group');

    label = document.createElement('label');
    label.setAttribute('for', 'siglaProvincia');
    label.textContent = "Sigla provincia";
    div.appendChild(label);

    input = document.createElement('input');
    input.setAttribute('id', 'siglaProvincia');
    input.setAttribute('name', 'siglaProvincia');
    input.classList.add('form-control');
    input.setAttribute('placeholder', 'Inserisci sigla provincia');
    input.setAttribute('type', 'text');
    input.setAttribute('required', 'required');
    div.appendChild(input);

    form.appendChild(div);

    return form;
  }

  addProvincia() {
    var self = this, form;
    var action = "provincia.controller.php?r=addProvincia&id=" + Page.getParameterByName('id');

    var addTriggers = document.querySelectorAll('.addProvinciaTrigger');
    addTriggers.forEach(addTrigger => {
      addTrigger.addEventListener('click', (event) => {
        event.preventDefault();

        var modal = document.getElementById('addProvincia');
        if(!modal) {
          Html.modal(
            'addProvincia',
            'Aggiungi provincia',
            this.form(),
            ['btn-success', 'Aggiungi']
          );

          form = document.querySelector('#addProvincia form');
          var button = document.querySelector('#addProvincia .submit');
          button.addEventListener('click', () => {
            Ajax.form(action, form, (result) => {
              !result.error ? success(result) : error();
            });
          });
        }

        $('#addProvincia').modal('show');
      });
    });

    function success(result) {
      $('#addProvincia').modal('hide');
      form.reset();
      self.table();
    }

    function error() {
      var alert = document.querySelector("#addProvincia .modal-body .alert-danger");
      
      if(!alert) {
        var target = document.querySelector("#addProvincia .modal-body");
        alert = Html.alert('danger', 'I valori inseriti non sembrano essere validi.', target, true);

        var inputs = document.querySelectorAll('#addProvincia .form-control');
        inputs.forEach(input => {
          input.addEventListener('input', () => {
            if(alert.parentNode) {alert.parentNode.removeChild(alert)};
          });
        });
      }
    }
  }

  deleteProvincia() {
    var self = this, currentTarget;

    var deleteTriggers = document.querySelectorAll('.deleteProvinciaTrigger');
    deleteTriggers.forEach(deleteTrigger => {
      deleteTrigger.addEventListener('click', (event) => {
        event.preventDefault();
        currentTarget = event.currentTarget;
        var action = event.currentTarget.getAttribute('href');

        var modal = document.getElementById('deleteProvincia');
        if(!modal) {
          Html.modal(
            'deleteProvincia',
            'Rimuovi provincia',
            'Sei sicuro di voler rimuovere la provincia selezionata?',
            ['btn-danger', 'Rimuovi']
          );

          var button = document.querySelector('#deleteProvincia .submit');
          button.addEventListener('click', () => {
            Ajax.basic(action, (result) => {
              !result.error ? success(result) : error(result);
            });
          });
        }

        $('#deleteProvincia').modal('show');
      });
    });

    function success(result) {
      $('#deleteProvincia').modal('hide');
      self.table();
    }

    function error(result) {
      console.log(result);
    }
  }
}