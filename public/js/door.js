
window.addEventListener("DOMContentLoaded",()=>{
    window.scrollTo(0,0);
    let door = document.getElementById("door");
    let image = door.querySelector("#door > div:not(:empty)");
    let proportion = Math.round((door.clientWidth / door.clientHeight)*10)/10;
    let nextElement = door.nextElementSibling;
    nextElement.style.marginTop = 1000;
    let distance = nextElement.offsetTop - (door.offsetTop + door.offsetHeight);
    let size = (image.clientWidth / door.clientWidth) * 100;
    window.addEventListener("scroll",()=>{
        if(door.getBoundingClientRect().top<=0){
            let current = (1 + size/100) - ((nextElement.getBoundingClientRect().top - door.offsetHeight)/distance);
            image.style.width = current * 100 + "%";
            if(current >= 1){
                image.querySelector("img").style.opacity = 0;
            } else {
                image.querySelector("img").style.opacity = 1;
            }
            if(current > 1.25){
                door.querySelector("h1").style.opacity = 0;
            } else {
                door.querySelector("h1").style.opacity = 1;
            }
        }
        if(document.querySelector("#about .container").getBoundingClientRect().top < window.innerHeight/1.5){
            document.querySelector("#about .container").classList.add("active");
        }

    })

})
