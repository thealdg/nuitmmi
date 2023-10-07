if(document.getElementById("code") != null){
    document.getElementById("code").addEventListener("input",()=>{
        if(document.getElementById("code").value.length == 6){
            document.getElementById("verify").submit();
        }        
    });
}
if(document.querySelector("#confirm > div") != null){
    document.querySelector("#confirm > div").addEventListener("mouseleave",()=>{
        window.addEventListener("click",removePopup)
    });
    document.querySelector("#confirm > div").addEventListener("mouseenter",()=>{
        window.removeEventListener("click",removePopup);
    })
}

function removePopup(){
    document.querySelector("#confirm").classList.add("hidden");
}