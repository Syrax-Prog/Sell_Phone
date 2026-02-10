let itemsPerLoad = 12;
let currentIndex = 0;

function load_more() {
    const cards = document.querySelectorAll(".card.h-100.border-0.shadow-sm.hover-lift");
    const totalItems = cards.length;

    for (let i = currentIndex; i < currentIndex + itemsPerLoad && i < totalItems; i++) {
        cards[i].parentElement.style.display = "block";
    }

    currentIndex += itemsPerLoad;

    if (currentIndex >= totalItems) {
        document.getElementById("load-more").style.display = "none";
    }
}

window.onload = function () {
    const cards = document.querySelectorAll(".card.h-100.border-0.shadow-sm.hover-lift");
    cards.forEach((card, index) => {
        if (index < itemsPerLoad) {
            card.parentElement.style.display = "block";
        } else {
            card.parentElement.style.display = "none";
        }
    });

    if (cards.length <= itemsPerLoad) {
        document.getElementById("load-more").style.display = "none";
    }
};