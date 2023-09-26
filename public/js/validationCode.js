
document.getElementById("code").addEventListener("input",()=>{
    if(document.getElementById("code").value.length == 6){
        document.getElementById("verify").submit();
    }        
})