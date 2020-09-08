$(document).on('click','#btn-nova-venda',function(){
    //FUNCAO CADASTRAR VENDAS 
    function cadastrar(valor_venda,id_vendedor){
        $.ajax({
            url:'api/vendas?cod=2&id_vendedor='+id_vendedor+'&valor_venda='+valor_venda,
            type: 'json',
            method: 'post',
            statusCode:{
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
                        setTimeout(function(){ 
                            location.reload();
                        }, 2000);
                        
                },
                500: function(data){
                    console.log('pagina nao encontrada')
                }
            },
         })
    }
     // CHAMA API PARA CADASTRO DE VENDEDOR           
        $.ajax({
            url:'api/vendas',
            type: 'json',
            method: 'get',
            statusCode:{
                200: function(data){
                    // MONTA O HTML
                    html ='<div class="col-md-5 bg-dark text-light" style="padding:20px">'
                    html +='<h5>Cadastrar venda</h5><br>'
                    html += '<form action="javascript:void(0)">'
                    html += '<div class="row">'
                    html += '<div class="col">'
                    html +='<select class="form-control" id="select-vendedor">'                      

                    for(i=0;i<data.count;i++){
                        if(i==0){
                            selected = 'selected'
                        }else{
                            selected = ''
                        }
                        html +='<option value="'+data.id[i]+'" '+selected+'>'+data.nome[i]+'</option>'                      
                    }  

                    html +='</select>'
                    html +='<small id="info-vendedor" class="text-danger"></small>'
                    html +='</div>'
                    html += '<div class="col">'
                    //  html +='<label for="valor-venda">Valor da venda</label>'
                    html +='<input type="text" placeholder="Insira o valor da compra" id="valor-venda"  class="form-control">'
                    html +='<small id="info-valor" class="text-danger"></small>'
                    html +='</div>'
                    html +='</div>'
                    html +='<button id="btn-enviar-venda" class="btn btn-success float-right" style="margin-top:10px">Enviar</button>'
                    html +='</form>'
                    html +='</div>'
     
                    $('#box-conteudo-aux').empty()
                    $('#box-conteudo').empty()
                    $('#box-conteudo').html(html)

                    // MASCARA PARA MOEDA
                    $('#valor-venda').mask('#.##0,00', {reverse: true});
                }
            },
            error(data, textStatus, jqXHR){
                 
            }
         })

        
        $(document).one('click','#btn-enviar-venda',function(){
            // EVITA CLIQUE DUPLO
            $(this).prop("disabled", true )

            id_vendedor = $('#select-vendedor').val()
            valor_venda = $('#valor-venda').val()
            valor_venda = valor_venda.replace(".","") 
            valor_venda = valor_venda.replace(",",".") 

            console.log(valor_venda)
            console.log(valor_venda+' '+id_vendedor)
            
            // VALIDAÇÕES
            if(valor_venda == '' ){
                $('#info-valor').empty()
                $('#info-valor').html('Digite um valor<br>') 
            }else{
                $('#info-valor').empty()
            }

            if(id_vendedor == 0){
                $('#info-vendedor').empty()
                $('#info-vendedor').html('Escolha um usuário') 
            }else{
                $('#info-vendedor').empty()
            }

            if(id_vendedor != 0 && valor_venda != ''){
                cadastrar(valor_venda,id_vendedor)
                $(this).prop("disabled", false )

            }
        })   
})   