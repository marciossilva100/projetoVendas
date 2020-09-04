$(document).on('click','#btn-listar-vendedores',function(){
     
    // CHAMA API PARA CADASTRO DE VENDEDOR           
        $.ajax({
            url:'api/vendas',
            type: 'json',
            method: 'get',
            statusCode:{
                200: function(data){
                    console.log(data.count)
                    // CONSTROI A TABELA PARA LISTAR OS VENDEDORES
                    html = '<div class="col-md-8">'
                    html += '<table class="table table-dark">'
                    html +='<thead>'
                    html +='<tr>'
                    html +='<th scope="col">#</th>'
                    html +='<th scope="col">Nome</th>'
                    html +='<th scope="col">Email</th>'
                    html +='<th scope="col">Comissão total</th>'
                    html +='</tr>'
                    html +='</thead>'
                    html +='<tbody>'
                    y = 1;
                    for(i=0;i<data.count;i++){
                        html +='<tr>'
                        html +='<th scope="row">'+y+'</th>'
                        html +='<td>'+data.nome[i]+'</td>'
                        html +='<td>'+data.email[i]+'</td>'
                        html +='<td>R$ '+data.soma[i]+'</td>'
                        html +='</tr>'
                        y++
                    }               
                    html +='</tbody>'
                    html +='</table>'
                    html +='</div>'
    
                    $('#box-conteudo-aux').empty()
                    $('#box-conteudo').empty()
                    $('#box-conteudo').html(html)
                }
            },
            error(data, textStatus, jqXHR){
                
            }
        })
    })   