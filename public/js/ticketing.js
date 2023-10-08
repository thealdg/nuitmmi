
let steps = ["reservation","informations","validation"];
let currentStep = 0;
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
    document.getElementById(steps[currentStep]).style.display = "block";
}
function changeStep(){
    let allow = true;
    let currentStepElement = document.getElementById(steps[currentStep]);
    if(steps[currentStep] == "reservation"){
        let inputs = currentStepElement.querySelectorAll("select");
        if(inputs[0].value <= 0 && inputs[1].value <= 0){
            allow = false;
        }
    }
    if(steps[currentStep] == "informations"){
        let inputs = currentStepElement.querySelectorAll("input");
        if(inputs[0].value == "" || inputs[1].value == "" || inputs[2].value == ""){
            allow = false;
        }
    }
    if(allow == true){

        currentStep += 1;
        console.log(currentStep);
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
    currentStep = steps.indexOf(stepName);
    showStep();
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

