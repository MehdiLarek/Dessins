
    let ok = false;
    //let temps = {{ duree }}
    const timer = document.getElementById("timer")
    timer.innerText = temps


    function diminuer(){
    let minutes = parseInt(temps / 60, 10)
    let secondes = parseInt(temps % 60, 10)

    minutes = minutes < 10 ? "0" + minutes : minutes
    secondes = secondes < 10 ? "0" + secondes : secondes

    timer.innerText = `${minutes}:${secondes}`
    temps = temps <= 0 ? 0 : temps - 1
    if(temps === 0){
    window.parent.location.reload();
}
}

    function pause(){
    ok = true;
    tempsPause = temps;
    clearInterval(t);
    t=0;
    let btnP = document.getElementById("btnPause");
    btnP.setAttribute("style", "visibility: hidden");

    let btnR = document.getElementById("btnReprendre");
    btnR.setAttribute("style", "visibility: visible");
}

    function reprise(){
    if (ok){
    tempsReprise = temps;
    t = setInterval(diminuer, 1000);
    let btnR = document.getElementById("btnReprendre");
    btnR.setAttribute("style", "visibility: hidden");

    let btnP = document.getElementById("btnPause");
    btnP.setAttribute("style", "visibility: visible");
}
}


    let t = setInterval(diminuer, 1000)
