
$('#btn-cadastrar').click(function(){

    // MONTA O FORMULARIO DE CADASTRO
    html ='<div style="width:300px;margin:0 auto">'
    html += '<form action="javascript:void(0)" id="form-validation">'
    html +='<label>Nome</label>'
    html +='<input type="text" name="nome" class="form-control" required id="nome">'
    html +='<small id="info-nome" class="text-danger"></small>'
    html +='<label>Email</label>'
    html +='<input type="email" name="email" class="form-control" required id="email">'
    html +='<small id="info-email" class="text-danger"></small>'
    html +='<button class="btn-success btn float-right" id="btn-enviar" style="margin-top:10px">Enviar</button>'
    html +='</form>'
    html +='</div>'
    
    $('#box-conteudo-aux').empty()
    $('#box-conteudo').empty()
    $('#box-conteudo').html(html)
})


$(document).on('click','#btn-enviar',function(){

    nome  = $('#nome').val()
    email = $('#email').val()

    // VALIDAÇÕES
    if(nome == ''){
        $('#info-nome').empty()
        $('#info-nome').html('Campo Nome não pode estar vazio<br>') 
    }else{
        $('#info-nome').empty()
    }

    if(email == ''){
        $('#info-email').empty()
        $('#info-email').html('Campo Email não pode estar vazio<br>') 
    }else{
        $('#info-email').empty()
    }

    if(nome != '' && email != ''){               
    // CHAMA API PARA CADASTRO DE VENDEDOR           
        $.ajax({
            url:'api/vendas?cod=1&nome='+nome+'&email='+email,
            type: 'json',
            method: 'post',
            statusCode: {
                200: function(data){
                    console.log(data)               
                        if(data.success == true) textColor = 'text-success'
                        if(data.success == false) textColor = 'text-danger'
                        $('input').val("")
                        // AVISO DE MODAL
                        $('.modal-title').html('<strong>Aviso!</strong>')
                        $('.modal-body p').html('<h5 class="'+textColor+'">'+data.message+'</h5>')
                        $('.modal').show()
                        $('#close').click(function(){
                            $('.modal').hide()
                        })                   
                },
                500: function() {
                  console.log('Pagina não encontrada')
                }
            },
            success(data, textStatus, jqXHR){
                console.log(jqXHR.status)
            },
            error(data, textStatus, jqXHR){
                console.log(jqXHR.status)
            }
        })
    }
})   