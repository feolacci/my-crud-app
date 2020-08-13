document.addEventListener('DOMContentLoaded', () => {
  new ProvinciaController();
});

class ProvinciaController {
  constructor() {
    this.createTable();
    this.addProvincia();
  }

  createTable() {
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

          this.table = new Table({
            columns: ["Sigla", "Provincia", null],
            data: data
          }).render(document.getElementById('wrapper'));

          var deleteTriggers = document.querySelectorAll('.deleteProvinciaTrigger');
          this.deleteProvincia(deleteTriggers);
        } else {
          this.table = null;
          
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

    var addTrigger = document.querySelector('.addProvinciaTrigger');
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

    function success(result) {
      $('#addProvincia').modal('hide');
      form.reset();
      
      if(self.table) {
        var div = document.createElement('div');
        div.textContent = result.nameProvincia;

        var span = document.createElement('span');
        span.classList.add('badge', 'badge-success', 'ml-2');
        span.textContent = "NUOVA";
        div.appendChild(span);

        const row = self.table.insertRow([
          result.siglaProvincia,
          div,
          Table.controls(result.idProvincia)
        ], true);

        row.style.backgroundColor = "#f9fbe7";
        setTimeout(() => {
          span.parentNode.removeChild(span);
          row.style.removeProperty('background-color');
        }, 3000);

        var deleteTriggers = row.querySelectorAll('.deleteProvinciaTrigger');
        self.deleteProvincia(deleteTriggers);
      } else {
        self.createTable();
      }

      var badge = document.querySelector('h5.titolo span');
      badge.textContent = Number(badge.textContent) + 1;
    }

    function error() {
      var alert = document.querySelector('#addProvincia .modal-body .alert-danger');
      
      if(!alert) {
        var target = document.querySelector('#addProvincia .modal-body');
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

  deleteProvincia(deleteTriggers) {
    var self = this;

    deleteTriggers.forEach(deleteTrigger => {
      deleteTrigger.addEventListener('click', (event) => {
        event.preventDefault();
        this.currentTarget = event.currentTarget.parentNode.parentNode.parentNode;
        this.action = event.currentTarget.getAttribute('href');

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
            Ajax.basic(this.action, (result) => {
              if(!result.error) {success();}
            });
          });
        }

        $('#deleteProvincia').modal('show');
      });
    });

    function success() {
      $('#deleteProvincia').modal('hide');
      self.currentTarget.parentNode.removeChild(self.currentTarget);
      
      var numRows = document.querySelectorAll('tbody > tr').length;
      if(!numRows) {self.createTable();}

      var badge = document.querySelector('h5.titolo span');
      badge.textContent = Number(badge.textContent) - 1;
    }
  }
}