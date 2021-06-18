let dvd = document.getElementById('dvdDetails');

let furniture = document.getElementById('furnitureDetails');
furniture.style.display = 'none';
let book = document.getElementById('bookDetails');
book.style.display = 'none';

let selectElement = document.getElementById('productType');
selectElement.addEventListener('change', () => {
    console.log("intra");
    console.log(selectElement);
    dvd.style.display = 'none';
    furniture.style.display = 'none';
    book.style.display = 'none';
    switch(selectElement.value) {
        case 'dvd':
            dvd.style.display = 'inline';
            break;
        case 'furniture':
            furniture.style.display = 'inline';
            break;
        case 'book':
            book.style.display = 'inline';
            break;
    }
})


const validateForm = () => {
    
    let form = document.forms['product_form'];
    if(!form['sku'].value.length) {
        console.log('nu exista');
    }
    return false;

}
