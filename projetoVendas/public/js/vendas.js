function listaVendas(user){
    // CHAMA API PARA CADASTRO DE VENDEDOR           
    $.ajax({
        url:'api/vendas/'+user,
        type: 'json',
        method: 'get',
        statusCode:{
            200: function(data){
                console.log(data.count+' ola')
                // CONSTROI A TABELA PARA LISTAR OS VENDEDORES
                html = '<div class="col-md-8">'
                html += '<table class="table table-dark">'
                html +='<thead>'
                html +='<tr>'
                html +='<th scope="col">#</th>'
                html +='<th scope="col">Data</th>'
                html +='<th scope="col">Nome</th>'
                html +='<th scope="col">Email</th>'
                html +='<th scope="col">Valor venda</th>'
                html +='<th scope="col">Comissão</th>'
                html +='</tr>'
                html +='</thead>'
                html +='<tbody>'
                y = 1
                for(i=0;i<data.count;i++){
                    html +='<tr>'
                    html +='<th scope="row">'+y+'</th>'
                    html +='<td>'+data.data[i]+'</td>'
                    html +='<td>'+data.nome[i]+'</td>'
                    html +='<td>'+data.email[i]+'</td>'
                    html +='<td>'+data.valor_venda[i]+'</td>'
                    html +='<td>R$ '+data.comissao[i]+'</td>'
                    html +='</tr>'
                    y++
                }               
                html +='</tbody>'
                html +='</table>'
                html +='</div>'

                $('#box-conteudo').empty()
                $('#box-conteudo').html(html)
            }
        },
        error(data, textStatus, jqXHR){
            
        }
    })
}

function getVendedores(){
    // CARREGA OS VENDEDORES NO SELECT          
    $.ajax({
        url:'api/vendas',
        type: 'json',
        method: 'get',
        statusCode:{
            200: function(data){
                // MONTA O HTML
                console.log(data.id[0])                                              
                html =''
                for(i=0;i<data.count;i++){
                    html +='<option value="'+data.id[i]+'" >'+data.nome[i]+'</option>'                      
                }  

                $('#box-conteudo').empty()
                $('#select-vendas').html(html)
                      
            }
        },
        error(data, textStatus, jqXHR){
            
        }
    })

    $(document).on('click','#btn-buscar-lista',function(){
        user = $('#select-vendas').val()
        console.log(user)

        listaVendas(user)
    })
}

// CARREGA NOVAMENTE OS VENDEDORES (RELOAD)
$('#btn-reload').click(function(){
    console.log('ok')
    getVendedores();
})

getVendedores();