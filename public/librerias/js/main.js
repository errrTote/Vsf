 $(document).ready(function(){ 
  // deshabilitar clic secundario document.oncontextmenu = function(){return false;} 

  // --CHOSEN (SELECT)
  $(".chosen-select").chosen({
    placeholder_text_multiple: 'Puede seleccionar varias opciones'
  });  

  $(".chosen").chosen({
  });  
  // --/CHOSEN


  // --VALIDACION PASSWORD
  var pswd;   
  var repswd;   

  $('.pswd').keyup(function() {
    // set password variable
    pswd = $(this).val();
    //validate the length
    if ( pswd.length < 8 ) {
      $('.length').removeClass('valid').addClass('invalid');
    } else {
      $('.length').removeClass('invalid').addClass('valid');
    }

    //validate letter
    if ( pswd.match(/[A-z]/) ) {
      $('.letter').removeClass('invalid').addClass('valid');
    } else {
      $('.letter').removeClass('valid').addClass('invalid');
    }

    //validate capital letter
    if ( pswd.match(/[A-Z]/) ) {
      $('.capital').removeClass('invalid').addClass('valid');
    } else {
      $('.capital').removeClass('valid').addClass('invalid');
    }

    //validate number
    if ( pswd.match(/\d/) ) {
      $('.number').removeClass('invalid').addClass('valid');
    } else {
      $('.number').removeClass('valid').addClass('invalid');
    }
  });

  $('.repswd').keyup(function(){
    repswd = $(this).val();
    //validate the length
    if ( repswd == pswd ) {
      $('.equality').removeClass('invalid').addClass('valid');
    } else {
      $('.equality').removeClass('valid').addClass('invalid');
    }                  
  });

  $('.pswd').on('focus',function(){
    $('.pswd_info').removeAttr('hidden','hidden');
  });

  $('.pswd').on('blur',function(){
    $('.pswd_info').attr('hidden','hidden');
   });

  $('.repswd').on('focus',function(){
    $('.pswd_info_b').removeAttr('hidden','hidden');
  });

  $('.repswd').on('blur',function(){
    $('.pswd_info_b').attr('hidden','hidden');
  });
  // --/VALIDACION PASSWORD  

  //Datapicker  
  $('.datepicker').datepicker({
    format: "yyyy/mm/dd",
    language: "es",
    autoclose: true
  });
  //End Datapicker

  
  //Checkbox residence_address
  $('.residence_checkbox').click(function() {
    var $this = $(this);
    // $this will contain a reference to the checkbox   
    if ($this.is(':checked')) {
      $('.residence_div').attr('hidden' , 'hidden');
    } 
    else {
      $('.residence_div').removeAttr('hidden');
    }
  });

  //Dropdown-pernanent
  $('.country_permanent').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.states_list_permanent').empty();
      $.each(response, function(i, state) {               
       $('.states_list_permanent').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });

  //Dropdown-residence
  $('.country_residence').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.states_list_residence').empty();
      $.each(response, function(i, state) {               
       $('.states_list_residence').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });

  //Dropdown-birth
  $('.country_birth').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.states_list_birth').empty();
      $.each(response, function(i, state) {               
       $('.states_list_birth').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });

  //Dropdown-education
  $('.education_country').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.education_states_list').empty();
      $.each(response, function(i, state) {               
       $('.education_states_list').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  

  //Dropdown-familiar
  $('.familiar_country').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.familiar_states_list').empty();
      $.each(response, function(i, state) {               
       $('.familiar_states_list').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });

  //Dropdown-familiar-b
  $('.familiar_b_country').on('change',function(){
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);
      $('.familiar_b_states_list').empty();
      $.each(response, function(i, state) {               
       $('.familiar_b_states_list').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });

  //Intrucciones

  $('form').on("focus", 'input, select, textarea', function(){
    var info = $(this).attr('title'); 
    var name = $(this).attr('id');
    $('.div_informacion').empty();  
    $('.div_informacion').append("<b>"+name+":</b><br>");
    $('.div_informacion').append(info);
  });

  $('form').on("blur", 'input, select',function(){
    $('.div_informacion').empty();
    var pInfo = $(".pInfo").html();
    
    $('.div_informacion').append(pInfo);
  });

  // /dropdown familiar

  //University
  var new_university = $(".copy").html();

  var cont=0;
  $(".add_university").on('click', function(event){   
    event.preventDefault();
   
    cont++;
    $(".new_university").append(new_university);   
    $(".new_university .new:last").append("Retirar formulario <button class='btn btn-primary remove_university'><span class='glyphicon glyphicon-minus'></span></button>");


  });

  $(".new_university").on('click', '.remove_university', function(e){
    e.preventDefault();
    cont--;

    $(this).closest('.new').remove();
  })

  //Dropdown-education-university
  $('form').on('change','.education_country_university',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university').eq(cont).empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university').eq(cont).append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Dropdown-education-university-edit1
  $('form').on('change','.education_country_university_edit1',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university_edit1').empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university_edit1').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Dropdown-education-university-edit2
  $('form').on('change','.education_country_university_edit2',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university_edit2').empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university_edit2').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Dropdown-education-university-edit
  $('form').on('change','.education_country_university_edit3',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university_edit3').empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university_edit3').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Dropdown-education-university-edit
  $('form').on('change','.education_country_university_edit4',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university_edit4').empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university_edit4').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Dropdown-education-university-edit
  $('form').on('change','.education_country_university_edit5',function(){    
    var id = $(this).val();
    var form = $('.form-states');
    var url = form.attr('action').replace(':USER_ID',id);
    
    $.get(url, id, function(response){
      console.log(response);

      $('.education_states_list_university_edit5').empty();     
      $.each(response, function(i, state) {               
       $('.education_states_list_university_edit5').append("<option value='"+state.id+"'>"+state.name+"</option>");
      });      
    });
  });  

  //Award
  var new_award = $(".copy").html();

  var count=1;
  $(".add_award").on('click', function(event){   
    event.preventDefault();
    count++;
    
    $('.target').before(new_award);
    
    //Datapicker  
    $('.datepicker').datepicker({
      format: "yyyy/mm/dd",
      language: "es",
      autoclose: true
    });
    //End Datapicker
    
    $("form .separador:last").append(" "+count);
    $(".remove_form:last").remove();
    $("form .new:last").append("<h5 class='remove_form'> Retirar formulario <button class='btn btn-primary remove_award'><span class='glyphicon glyphicon-minus'></span></button></h5>");
    
  });

  $("form").on('click', '.remove_award', function(e){
    e.preventDefault();
    count--;
    $(this).closest('.new').remove();
    $("form .new:last").append("<h5 class='remove_form'> Retirar formulario <button class='btn btn-primary remove_award'><span class='glyphicon glyphicon-minus'></span></button></h5>");

  }) 

  $(function() {
     var url = window.location.href;
     var urlSplit = url.split('/');

     if(urlSplit[urlSplit.length-1] == '')
      $('#home').addClass("selected");

     $(".menu a").each(function(){
        var href = $(this).attr("href");
        var hrefSplit = href.split('/');
          if(hrefSplit[5] == urlSplit[5])
          $(this).addClass("selected");
     })

     $(".menuAdmin a").each(function(){
        var href = $(this).attr("href");
        var hrefSplit = href.split('/');
          if(hrefSplit[6] == urlSplit[6])
          $(this).addClass("selected");
     })
  });

  $("#panelPrincipal").DataTable( {
    language: {
        processing:     "Cargando...",
      search:         "Filtro:",
        lengthMenu:    "Mostrar _MENU_ Registros",
        info:           "Hay de _START_ a _END_   resgistros mostrados de _TOTAL_ en total",
        infoEmpty:      "No hay registros disponibles",
        infoFiltered:   "(Hay  _MAX_ Registros en total )",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Ningun registro coincide",
        emptyTable:     "No hay registros disponibles",
        paginate: {
            first:      "Primera",
            previous:   "< Anterior",
            next:       "Siguiente >",
            last:       "Ultima"
        },
        aria: {
          sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
          sortDescending: ": habilitado para ordenar la columna en orden descendente"
      }
    },
  
    lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "todos"]]
  });

  $("#panelSecundario").DataTable( {
    language: {
        processing:     "Cargando...",
      search:         "Filtro:",
        lengthMenu:    "Mostrar _MENU_ Registros",
        info:           "Hay de _START_ a _END_   resgistros mostrados de _TOTAL_ en total",
        infoEmpty:      "No hay registros disponibles",
        infoFiltered:   "(Hay  _MAX_ Registros en total )",
        infoPostFix:    "",
        loadingRecords: "Cargando...",
        zeroRecords:    "Ningun registro coincide",
        emptyTable:     "No hay registros disponibles",
        paginate: {
            first:      "Primera",
            previous:   "< Anterior",
            next:       "Siguiente >",
            last:       "Ultima"
        },
        aria: {
          sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
          sortDescending: ": habilitado para ordenar la columna en orden descendente"
      }
    },
  
    lengthMenu: [[5, 10, 15, 25, 50, -1], [5, 10, 15, 25, 50, "todos"]]
  });

  $('#selectTypeEducation').on('change', function(){
      if( $('#selectTypeEducation').val() == 'h'){
          $('#divCareer').removeAttr('hidden');
      }
      else{
      
          $('#divCareer').attr('hidden', 'hidden');
      }

  });
      
});


 
    