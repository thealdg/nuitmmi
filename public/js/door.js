
window.addEventListener("DOMContentLoaded",()=>{
    window.scrollTo(0,0);
    let door = document.getElementById("door");
    let image = door.querySelector("#door .scalable > div:not(:empty)");    
    if(window.innerWidth >= window.innerHeight){
        image.style.width = "25vw";
    } else {
        image.style.height = "25vh";
    }
    let nextElement = door.nextElementSibling;
    nextElement.style.marginTop = window.innerHeight*1.5;
    let distance = nextElement.offsetTop - (door.offsetTop + door.offsetHeight);

    window.addEventListener("scroll",()=>{
        if(door.getBoundingClientRect().top<=0){
            let current = 1.25 - ((nextElement.getBoundingClientRect().top - door.offsetHeight)/distance);
            if(window.innerWidth >= window.innerHeight){
                image.style.width = current * 100 + "vw";
            } else {
                image.style.height = current * 100 + "vh";
            }
            door.querySelector("h1").style.top = 100 - current*100 + "%";
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
    window.addEventListener("resize",()=>{
        if(window.innerWidth >= window.innerHeight){
            image.style.width = image.style.height;
            image.style.height = "auto";
        } else {
            image.style.height = image.style.width
            image.style.width = "auto";
        }
    })
})
