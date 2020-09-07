<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendMailRelatorio extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(\stdClass $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $query = DB::table('vendedores as v1')
                    ->join('vendas as v2','v1.id','=','v2.id_vendedor')
                    ->select(DB::raw("SUM(v2.valor_venda) as total"))
                    ->get();

                    foreach($query as $value){
                        $total = $value;
                    }
                    
        $this->subject('Relatório de vendas');
        $this->from('marciosunico18@gmail.com','Relatorio vendas');
        $this->to($this->user->email,$this->user->name);
        return $this->view('mail.envio_email',[
            'user'=>$this->user,
            'total'=>$total
        ]);
    }
}
