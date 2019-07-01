var base_url = '';
var estados = [];

// <-- Initialize -->
function setBaseUrl(url){
    base_url = url;
}

$('[data-toggle="tooltip"]').tooltip();

// <-- Search Doctors -->
function load_data(query){
    $.ajax({
        url:base_url+"dashboard/search",
        method:"POST",
        data:{query:query},
        success:function(data){
            $("#table").html(data);
        }
    });
}

$("#search_text").keyup(function(){
    var search = $(this).val();
    if(search != ''){
        load_data(search);
    }else{
        load_data();
    }
});

// <-- Populating city and state selects -->
function loadEstados(element) {
  if (estados.length > 0) {
    putEstados(element);
    $(element).removeAttr('disabled');
  } else {
    $.ajax({
      url: 'https://api.myjson.com/bins/enzld',
      method: 'get',
      dataType: 'json',
      beforeSend: function() {
        $(element).html('<option>Carregando...</option>');
      }
    }).done(function(response) {
      estados = response.estados;
      putEstados(element);
      $(element).removeAttr('disabled');
    });
  }
}

function putEstados(element) {
  var label = $(element).data('label');
  label = label ? label : 'Estado';

  var options = '<option value="">' + label + '</option>';
  for (var i in estados) {
    var estado = estados[i];
    
    var selec = '';
    if($(element).attr('meta-uf') == estado.sigla){ 
        selec = 'selected'; 
        loadCidades($('#cidade'), estado.sigla);
    }

    options += '<option value="' + estado.sigla + '" '+selec+'>' + estado.nome + '</option>';
  }

  $(element).html(options);
}

function loadCidades(element, estado_sigla) {
    putCidades(element, estado_sigla);
    $(element).removeAttr('disabled');
}

function putCidades(element, estado_sigla) {
  var label = $(element).data('label');
  label = label ? label : 'Cidade';

  var options = '<option value="">' + label + '</option>';
  for (var i in estados) {
    var estado = estados[i];
    if (estado.sigla != estado_sigla)
      continue;
    for (var j in estado.cidades) {
      var cidade = estado.cidades[j];

      var selec = '';
      if($(element).attr('meta-city') == cidade){ selec = 'selected'; }

      options += '<option value="' + cidade + '" '+selec+'>' + cidade + '</option>';
    }
  }
  $(element).html(options);
}

function loadStatesCity(){
    loadEstados('#uf');
    $(document).on('change', '#uf', function(e) {
      var target = $(this).data('target');
      if (target) {
        loadCidades(target, $(this).val());
      }
    });
}

// <-- Checkbox Validation -->
function contCheckbox(selecionados){
  var inputs, x, selecionados=0;
  inputs = document.getElementsByTagName('input');
  for(x=0;x<inputs.length;x++){
    if(inputs[x].type=='checkbox'){
      if(inputs[x].checked==true){
        selecionados++;
      }
    }
  }
  return selecionados;
}