
let steps = ["reservation","informations","validation"];
let currentStep = 0;
let error = document.querySelector("#error");
function showStep(){
    let titles = document.querySelectorAll("#tickets .steps h2");
    for(let title of titles){
        title.classList.remove("current");
        if(title.dataset.step == steps[currentStep]){
            title.classList.add("current");
            title.classList.add("checked");
        } 
    }
    for(let step of steps){
        document.getElementById(step).style.display = "none";
    }
    if(currentStep == 1){
        setPeople(parseInt(document.querySelector("#reservation select").value));
    }
    document.getElementById(steps[currentStep]).style.display = "block";
}
function changeStep(){
    let allow = true;
    let currentStepElement = document.getElementById(steps[currentStep]);
    if(steps[currentStep] == "reservation"){
        let input = currentStepElement.querySelector("select");
        if(input.value <=0){
            allow = false;
            error.innerText = "Veuillez sélectionner au moins un billet pour continuer.";
        }
    }
    if(steps[currentStep] == "informations"){
        let peoples = currentStepElement.querySelectorAll(".people");
        let names = [];
        let surnames = [];
        for(let people of peoples){
            let inputs = people.querySelectorAll("input");
            if(inputs[0].value == "" || inputs[1].value == ""){
                allow = false;
                error.innerText = "Veuillez rentrer chaque noms et prénoms demandés.";
            } else {
                for(i=0;i<names.length;i++){
                    if(inputs[0].value == surnames[i] && inputs[1].value == names[i]){
                        allow = false;
                        error.innerText = "Il n'est pas possible de rentrer deux fois le même nom.";
                    }
                }
                surnames.push(inputs[0].value);
                names.push(inputs[1].value);
            }
        }
        inputs = currentStepElement.querySelectorAll(".form_section:last-child input");
        console.log(inputs);
        if(inputs[0].value == ""){
            allow = false;
            error.innerText = "Veuillez rentrer une adresse email.";
        }
    }
    if(allow == true){
        error.innerText = "";
        currentStep += 1;
        if(currentStep == 2){
            document.querySelector("#next").style.visibility = "hidden";
        } else {
            document.querySelector("#next").style.visibility = "visible";
        }
        window.scrollTo(0,0);
        showStep();
    }  
}

function selectStep(stepName){
    let allow = true;
    let currentStepElement = document.getElementById(steps[currentStep]);
    if(steps[currentStep] == "reservation"){
        let input = currentStepElement.querySelector("select");
        if(input.value <=0){
            allow = false;
            error.innerText = "Veuillez sélectionner au moins un billet pour continuer.";
        }
    }
    if(steps[currentStep] == "informations"){
        let peoples = currentStepElement.querySelectorAll(".people");
        let names = [];
        let surnames = [];
        for(let people of peoples){
            let inputs = people.querySelectorAll("input");
            if(inputs[0].value == "" || inputs[1].value == ""){
                allow = false;
                error.innerText = "Veuillez rentrer chaque noms et prénoms demandés.";
            } else {
                for(i=0;i<names.length;i++){
                    if(inputs[0].value == names[i] && inputs[1].value == surnames[i]){
                        allow = false;
                        error.innerText = "Il n'est pas possible de rentrer deux fois le même nom.";
                    }
                }
                names.push(inputs[0].value);
                surnames.push(inputs[1].value);
            }
        }
        inputs = currentStepElement.querySelectorAll(".form_section:last-child input");
        if(inputs[0].value == ""){
            allow = false;
            error.innerText = "Veuillez rentrer une adresse email.";
        }
    }
    if(steps.indexOf(stepName) > currentStep && !allow){
        return ;
    } else {
        error.innerText = "";
        currentStep = steps.indexOf(stepName);
        if(currentStep == 2){
            document.querySelector("#next").style.visibility = "hidden";
        } else {
            document.querySelector("#next").style.visibility = "visible";
        }
        showStep();
    }
}
function setPeople(n){
    let peopleContainer = document.querySelector("#informations .form_section:first-child");
    let peoples = peopleContainer.querySelectorAll(".people");
    if(peoples.length < n){
        peoples[0].querySelector("h3").innerText = "Personne 1";
        for(i = peoples.length;i < n;i++){
            let newPeople = peoples[0].cloneNode(true);
            for(input of newPeople.querySelectorAll("input")){
                input.value = "";
            }
            if(i==4){
                newPeople.querySelector("h3").innerText = newPeople.querySelector("h3").innerText.replace("1",6);
            } else {
                newPeople.querySelector("h3").innerText = newPeople.querySelector("h3").innerText.replace("1",i+1);
            }
            
            peopleContainer.appendChild(newPeople);
        }
    } else if(peoples.length > n){
        for(i = peoples.length; i > n; i--){
            peopleContainer.lastChild.remove();
            peopleContainer = document.querySelector("#informations .form_section:first-child");
        }
    }
    peoples = peopleContainer.querySelectorAll(".people");
    if(peoples.length <= 1){
        peoples[0].querySelector("h3").innerText = "";
    }

}

showStep();
document.querySelector("#next").onclick = (e)=>{
    e.preventDefault();
    changeStep();
};
let sections = document.querySelectorAll("#tickets .steps h2");
for(let section of sections){
    section.onclick = ()=>{
        if(section.classList.contains("checked")){
            selectStep(section.dataset.step);
        }
    }
}

