<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascara extends Model
{
    protected function mascaraCNPJ_CPF($cnpjcpf){
		$cnpj_cpf = preg_replace("/\D/", '', $cnpjcpf);
		  
		if (strlen($cnpj_cpf) === 11) {
		    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
		} 
		  
		return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    protected function mascaraTelefone_Celular($tel_cel){
    	if (isset($tel_cel)) {
	        if(strlen($tel_cel) == 11){
	            $novo = substr_replace($tel_cel, '(', 0, 0);
	            $novo = substr_replace($novo, ')', 3, 0);
	            $novo = substr_replace($novo, ' ', 4, 0);
	            $novo = substr_replace($novo, '-', 10, 0);

	        }else{
	            $novo = substr_replace($tel_cel, '(', 0, 0);
	            $novo = substr_replace($novo, ')', 3, 0);
	            $novo = substr_replace($novo, ' ', 4, 0);
	            $novo = substr_replace($novo, '-', 9, 0);
	        }
	        return $novo;
    	}
    }

    protected function mascaraCEP($cep){
    	if (isset($cep)) {
	    	$cep_ = preg_replace("/\D/", '', $cep);
	
            $novo = substr_replace($cep_, '.', 2, 0);
            $novo = substr_replace($novo, '-', 6, 0);
	        return $novo;
    	}
    }
}
