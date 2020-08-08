document.addEventListener('DOMContentLoaded', () => {
  if(Page.getParameterByName('r') === 'regione') {
    new ProvinciaController();
  };
});
  
class ProvinciaController {
  constructor() {
    this.ProvinciaModal();
  }
  
  ProvinciaModal() {
    var triggers = document.querySelectorAll('.addProvincia, .update');
    
    triggers.forEach(trigger => {
      trigger.addEventListener('click', (event) => {
        event.preventDefault();

        if(trigger.classList.contains("addProvincia")){
          var action = "provincia.controller.php?r=addProvincia&id=" + Page.getParameterByName('id');          
        }
                
        $('#addProvinciaModal').modal('show');
        
        var form = document.querySelector("#addProvinciaModal form");
        form.addEventListener("submit", (event) => {
          event.preventDefault();
          
          Ajax.form(form, action, (result) => {
            if(!result.error){

              var row = document.querySelector("#regione table tbody").insertRow(0);
              row.insertCell(0).textContent = result.siglaProvincia;
              row.insertCell(1).innerHTML = result.nameProvincia + "<span class='badge badge-success ml-2'>NUOVA</span>";
              row.insertCell(2).innerHTML = "<a class='btn btn-primary btn-sm update' href='#' data-toggle='tooltip' title='Modifica regione'><i class='fa fa-pencil'></i></a>";

              $('#addProvinciaModal').modal('hide');

              form.reset();

            } else {
              var target = document.querySelector("form > .modal-body");
              if(!document.querySelector("form .modal-body .alert-danger")) {
                var alert = Html.alert('danger', 'I valori inseriti non sembrano essere validi.', target, true);

                var input = document.querySelectorAll('form .form-control');
                input.forEach( (el) => {                  
                  el.addEventListener('input', function handler() {
                    if(alert.parentNode) alert.parentNode.removeChild(alert);
                  });
                });                
              };
            };
          });
        });
      });
    });
  }
}