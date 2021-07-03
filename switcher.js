let dvd = document.getElementById('dvdDetails');

let furniture = document.getElementById('furnitureDetails');
furniture.style.display = 'none';

let book = document.getElementById('bookDetails');
book.style.display = 'none';

let selectElement = document.getElementById('productType');
selectElement.addEventListener('change', () => {
    hideAll();
    const actions = {
        "book": "showBook",
        "dvd": "showDvd",
        "furniture": "showFurniture"
    }
    const fn = window[actions[selectElement.value]];
    fn();
   
})

const hideAll = () => {

    dvd.style.display = 'none';
    furniture.style.display = 'none';
    book.style.display = 'none';

    list = document.getElementsByClassName("product-details");
    for (let i = 0; i < list.length; i++) {
        list[i].required = false;
    }
}

const showDvd = () => {
    dvd.style.display = 'inline';
    document.getElementById('size').required = true;
}

const showFurniture = () => {
    furniture.style.display = 'inline';
    document.getElementById('height').required = true;
    document.getElementById('width').required = true;
    document.getElementById('length').required = true;
}

const showBook = () => {
    book.style.display = 'inline';
    document.getElementById('weight').required = true;
}


const check = input => {
    if (input.value <= 0) {
        input.setCustomValidity('The number must be greater than 0');
    } else {
        input.setCustomValidity('');
    }
}