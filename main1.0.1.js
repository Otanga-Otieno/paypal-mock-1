function qinc(qid) {
    const count = document.getElementById("qcount" + qid);
    var countQ = count.value;
    count.value = ++countQ;

    cartCount();
}

function qdec(qid) {
    var count = document.getElementById("qcount" + qid);
    var countQ = count.value;
    if(countQ > 1) {count.value = --countQ} else hideQuantityCounter(qid);

    cartCount();
}

function forceDec(qid) {
    var count = document.getElementById("qcount" + qid);
    var countQ = count.value;
    if (count.value > 0) count.value = --countQ

    cartCount();
}

function showQuantityCounter(qid) {
    var priceBtn = document.getElementById("pricebutton" + qid);
    priceBtn.setAttribute("hidden", true);

    var qCount = document.getElementById("qcounter" + qid);
    qCount.removeAttribute("hidden");

    qinc(qid);
    cartCount();
}

function hideQuantityCounter(qid) {
    var qCount = document.getElementById("qcounter" + qid);
    qCount.setAttribute("hidden", true);

    var priceBtn = document.getElementById("pricebutton" + qid);
    priceBtn.removeAttribute("hidden");

    forceDec(qid);
}

function cartCount() {
    var items = 0;
    var totalAmount = 0.0;

    for(let i=1; i<=4; i++) {
        var qCounter = document.getElementById("qcounter" + i);
        var price = document.getElementById("price" + i).value;
        
        if(window.getComputedStyle(qCounter).display !== "none") {
            var qcount = document.getElementById("qcount" + i);
            var amount = Number(price) * Number(qcount.value);
            items = items + Number(qcount.value);
            totalAmount = totalAmount + amount;
        }
    }

    var amountDisplay = document.getElementById("totalamt");
    amountDisplay.innerText = totalAmount.toFixed(2);

    var itemDisplay = document.getElementById("totalitm");
    itemDisplay.innerText = items;

    if(parseFloat(totalAmount) != 0) {
        if(!isCheckout()) showCheckoutButton(true);
    } else {
        showCheckoutButton(false);
    }
}

function isCheckout() {
    const checkoutButton = document.getElementById("checkoutBtn");

    if(window.getComputedStyle(checkoutButton).display != "none") {
        return true;
    } else {
        return false;
    }
}

function showCheckoutButton(bool) {
    const checkoutButton = document.getElementById("checkoutBtn");

    if(bool === true) {
        checkoutButton.removeAttribute("hidden");
    } else {
        checkoutButton.setAttribute("hidden", true);
    }
}

function validateQuantity(qid) {
    var qcount = document.getElementById("qcount" + qid);
    var quantity = qcount.value;

    if(isNaN(quantity)) {
        qcount.value = 1;
    } else {
        if(quantity < 0) qcount.value = 1;
    }
    cartCount();
}