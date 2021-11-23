function qinc(qid) {
    const count = document.getElementById("qcount" + qid);
    var countQ = count.value;
    count.value = ++countQ;
}

function qdec(qid) {
    var count = document.getElementById("qcount" + qid);
    var countQ = count.value;
    if(countQ > 1) {count.value = --countQ} else hideQuantityCounter(qid);
    
}

function showQuantityCounter(qid) {
    var priceBtn = document.getElementById("pricebutton" + qid);
    priceBtn.setAttribute("hidden", true);

    var qCount = document.getElementById("qcounter" + qid);
    qCount.removeAttribute("hidden");
}

function hideQuantityCounter(qid) {
    var qCount = document.getElementById("qcounter" + qid);
    qCount.setAttribute("hidden", true);

    var priceBtn = document.getElementById("pricebutton" + qid);
    priceBtn.removeAttribute("hidden");
}