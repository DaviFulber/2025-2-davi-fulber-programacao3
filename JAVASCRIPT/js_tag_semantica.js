function atualizaData(){
            const dataAgora = new Date();
            
            const act = dataAgora.toLocaleDateString("pt-BR");
            document.getElementById("data").innerHTML = "       " + act;


        }
        setInterval(atualizaData,1000);