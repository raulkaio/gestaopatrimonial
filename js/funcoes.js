
        function confirmaExclusao(item_pk, nome){
            var answer = confirm ("Deseja mesmo excluir o item #"+item_pk+"\""+nome+"\" ?");
            if (!answer){}
            else{window.location="controle/exclui.php?item_pk="+item_pk}
        }
        
        function confirmaLogout(){
            var answer = confirm ("Tem certeza que deseja logout?");
            if (!answer){}
            else{window.location="controle/logout.php"}
        }