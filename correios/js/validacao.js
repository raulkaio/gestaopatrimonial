
	 function formato_data(v){
        v.value=v.value.replace(/\D/g,"");
        v.value=v.value.replace(/(\d{2})(\d)/,"$1/$2");     
        v.value=v.value.replace(/(\d{2})(\d)/,"$1/$2");
        v.value=v.value.replace(/(\d{2})(\d{2})$/,"$1$2");
	 }

	function formato_int(v){
        v.value=v.value.replace(/\D/g,"");
    }
    
    function formato_valor(v){
        v.value=v.value.replace(/\D/g,"");
        v.value=v.value.replace(/(\d)(\d{2})$/,"$1,$2");
    }

	function formato_letras_numeros(v){
        v.value=v.value.replace(/\^|~|\?|,|\*|\.|\-|\'|\!|\@|\#|\$|\%|\%|\¨|\&|\(|\)|\_|\=|\+|\§|\[|\]|\{|\}|\ª|\º|\:|\;|\<|\>|\"|\\|\||\¹|\²|\³|\£|\¢|\¬/g,"");
    }