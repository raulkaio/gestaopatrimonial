
        function confirmaExclusao(nota_pk, nome){
            var answer = confirm ("Deseja mesmo excluir o item #"+nota_pk+"\""+nome+"\" ?");
            if (!answer){}
            else{window.location="controle/exclui.php?nota_pk="+nota_pk}
        }
        
        function confirmaLogout(){
            var answer = confirm ("Tem certeza que deseja logout?");
            if (!answer){}
            else{window.location="controle/logout.php"}
        }