let dvd = document.getElementById('dvdDetails');

let furniture = document.getElementById('furnitureDetails');
furniture.style.display = 'none';
let book = document.getElementById('bookDetails');
book.style.display = 'none';

let selectElement = document.getElementById('productType');
selectElement.addEventListener('change', () => {
    
    dvd.style.display = 'none';
    furniture.style.display = 'none';
    book.style.display = 'none';

    list = document.getElementsByClassName("product-details");
    for(let i = 0; i < list.length; i++){
        list[i].required = false;
    }

    switch(selectElement.value) {
        case 'dvd':
            dvd.style.display = 'inline';
            document.getElementById('size').required = true;
            break;
        case 'furniture':
            furniture.style.display = 'inline';
            document.getElementById('height').required = true;
            document.getElementById('width').required = true;
            document.getElementById('length').required = true;
            break;
        case 'book':
            book.style.display = 'inline';
            document.getElementById('weight').required = true;
            break;
    }
})


// const validateForm = () => {
    
//     let form = document.forms['product_form'];
//     if(!form['sku'].value.length) {
//         console.log('nu exista');
//     }
//     return false;

// }


const check = input => {
    if (input.value <= 0) {
      input.setCustomValidity('The number must be greater than 0');
    } else {
      input.setCustomValidity('');
    }
  }