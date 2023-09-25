function exposition(){
    document.getElementById('participation').classList.add("hidden");
    document.getElementById('exposition').classList.remove("hidden");
    document.getElementById("select_exposition").classList.add("current");
    document.getElementById("select_competition").classList.remove("current");
    document.getElementById('count_exposition').classList.remove("hidden");
    document.getElementById('count_participation').classList.add("hidden");
}
function participation(){
    document.getElementById('participation').classList.remove("hidden");
    document.getElementById('exposition').classList.add("hidden");
    document.getElementById("select_competition").classList.add("current");
    document.getElementById("select_exposition").classList.remove("current");
    document.getElementById('count_exposition').classList.add("hidden");
    document.getElementById('count_participation').classList.remove("hidden");

}