

let initialRows = [];
let caroussel = false;
function carousselStaff(rowClass, cardClass){
    if(caroussel == false){
        let cardsRow = document.querySelectorAll(rowClass);
        for(let cardRow of cardsRow){
            if(!initialRows.includes(cardRow)){
                initialRows.push(cardRow.cloneNode(true));
            }

            let cards = cardRow.querySelectorAll(cardClass);
            console.log(cards);
            if(cards.length < 3){
                i = 0;
                while(cards.length < 4){
                    cardRow.append(cards[i].cloneNode(true));
                    i ++;
                    cards = cardRow.querySelectorAll(cardClass);
                }
            }
            cards[1].classList.add("active");
            
            if(cardRow.parentElement.querySelector(".leftArrow") != null && cardRow.parentElement.querySelector(".rightArrow") != null){
                let triggerLeft = ()=>{
                    cardRow.parentElement.querySelector(".leftArrow").onclick = false;
                    slideLeft(cardRow);
                    setTimeout(()=>{
                        cardRow.parentElement.querySelector(".leftArrow").onclick = triggerLeft;
                    },1000);
                }
                let triggerRight = ()=>{
                    cardRow.parentElement.querySelector(".rightArrow").onclick = false;
                    slideRight(cardRow);
                    setTimeout(()=>{
                        cardRow.parentElement.querySelector(".rightArrow").onclick = triggerRight;
                    }, 1000);
                }
                cardRow.parentElement.querySelector(".leftArrow").onclick = triggerLeft;
                cardRow.parentElement.querySelector(".rightArrow").onclick = triggerRight;
            }
            caroussel = true;
        }
    }
}

function removeCaroussel(rowClass){
    if(caroussel == true){
        let cardRows = document.querySelectorAll(rowClass);
        for(let i = 0;i<cardRows.length;i++){
            cardRows[i].innerHTML = initialRows[i].innerHTML;
        }
        caroussel = false;
    }
}

function slideLeft(cardRow){
    let clone = cardRow.lastElementChild.cloneNode(true);
    cardRow.firstElementChild.before(clone);
    cardRow.children[2].classList.remove("active");
    cardRow.style.animation = "slideLeft 0.5s";
    setTimeout(()=>{
        cardRow.lastElementChild.remove();
        cardRow.children[1].classList.add("active");
        cardRow.style.removeProperty("animation");
    },500);
}

function slideRight(cardRow){
    let clone = cardRow.firstElementChild.cloneNode(true)
    cardRow.lastElementChild.after(clone);
    cardRow.children[1].classList.remove("active");
    cardRow.style.animation = "slideRight 0.5s";
    setTimeout(()=>{
        cardRow.firstElementChild.remove();
        cardRow.children[1].classList.add("active");
        cardRow.style.removeProperty("animation"); 
    },500);

}


