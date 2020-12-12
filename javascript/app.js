
const shoppingItems = [];

document.addEventListener('click', (e) => {
    if (e.target.classList.contains('add-item')) {
        buttonChange('add-item', e.target);
        addItem(e.target);
    } else if (e.target.classList.contains('remove-item')) {
        buttonChange('remove-item', e.target);
        removeItem(e.target);
    }

    shoppingCartCount();

    if (e.target.classList.contains('save-shopping-cart') || e.target.classList.contains('save-shopping-cart-text')) {
        saveShoppingCart();
    }
});


function buttonChange(event, element)
{
    switch(event) {

        case 'add-item':
            element.classList.remove('add-item');
            element.classList.remove('btn-primary');
            element.classList.add('remove-item');
            element.classList.add('btn-danger');
            element.textContent = 'Remove Item';
            break;

        case 'remove-item':
            element.classList.remove('remove-item');
            element.classList.remove('btn-danger');
            element.classList.add('add-item');
            element.classList.add('btn-primary');
            element.textContent = 'Select Item';
            break;

        default:
            break;
    }
}

function addItem(element)
{
    let collection = collectItem(element);

    let itemObject = buildObject(collection);

    //add the item to the shopping list
    if (inItemArray(itemObject)) {
        shoppingItems.push(itemObject);
    }

}

function removeItem(removeItem)
{
    let collection = collectItem(removeItem);
    let itemObject = buildObject(collection);

    let found = findItem(itemObject);

    if (found) {
        let itemIndex = shoppingItems.indexOf(found);
        shoppingItems.splice(itemIndex, 1 );
    }
}

function inItemArray(item)
{
    if (shoppingItems.length > 0) {
        if (findItem(item)) {
            return false;
        }
    }

    return true;
}

function buildObject(collection)
{
    const itemObject = {};

    //builds the object up
    collection.forEach((item) => {
        let split = item.replace(' ', '').split(':');
        itemObject[`${split[0].toLowerCase()}`] = split[1];
    });

    return itemObject;
}

function findItem(collection)
{
    return shoppingItems.find((item) => {
        return collection.type === item.type;
    });
}


function collectItem(element)
{
    const parent = element.parentElement;

    const classList = ['item-type', 'item-price', 'item-colour', 'item-material'];

    let itemElements = [];

    //collect the item elements
    for (let i = 0; i < 4; i++) {
        itemElements.push(parent.querySelector(`.${classList[i]}`));
    }

    //return an array of each inner text
    return itemElements.map((item) => {
        return item.textContent;
    });
}

function shoppingCartCount()
{
    let shoppingCartCount = shoppingItems.length;
    const countElement = document.querySelector('.shopping-cart-count');

    countElement.textContent = shoppingCartCount;
}

function saveShoppingCart()
{
    const options = {
        method: 'POST',
        header: {
            'Content-Type': 'application/json',
        },
        body: prepareShoppingCart(),
    };
    //look at setting a cookie
    //TODO console.log(myHeaders.has('Set-Cookie')); /
    if (shoppingItems.length > 0) {

        //will enable the spinner and change the text of the button
        enableSpinner('svg-circle');
        changeText('save-shopping-cart-text', 'class', 'Saving');

        fetch('register-cookie', options)
        //deal with the response coming from the server
        .then((response) => {

            setTimeout(() => {
                enableSpinner('svg-circle', 'id', true);
                changeText('save-shopping-cart-text', 'class', 'Save Shopping');
                addContentToElement('save-shopping-cart', {
                    "data-toggle": 'modal',
                    "data-target": '#myModal',
                });
            },700);

            if (response.status === 200) {
                return response.json();
            } else {
                return response.error();
            }
        })
        //allows us to deal with the promise and its data
        .then((data) => {
            displaySuccessMessage(data.message);
        });

    }

}


function prepareShoppingCart()
{
    const form = new FormData();
    const data = JSON.stringify(shoppingItems);

    form.set('shopping_items', data);

    return form;
}

function enableSpinner(element, selectorType = 'id', show = false)
{
    const spinner = document.querySelector(`${getSelectorType(selectorType)}${element}`);
    if (show) {
        spinner.setAttribute('hidden', 'true');
    } else {
        spinner.removeAttribute('hidden');
    }
}



function changeText(element, selectorType = 'id', text = '')
{
    const chosen = document.querySelector(`${getSelectorType(selectorType)}${element}`);
    chosen.textContent = `${text}`;
}

function addContentToElement(element, attributes)
{
    let selected = document.querySelector(`.${element}`);

    for (let x in attributes) {
        selected.setAttribute(x, attributes[x]);
    }
}

function getSelectorType(type)
{
    switch (type) {
        case 'id':
            type = '#';
            break;
        case 'class':
            type = '.';
            break;
    }

    return type;
}

function displaySuccessMessage(message)
{
    changeText('success-message', 'class', message);
    document.querySelector('.success-message').removeAttribute('hidden');
}


function getCookie()
{
    const cookie = document.cookie;

    const shoppingItems = JSON.parse(cleanCookie(cookie));

    return build(shoppingItems);

}

//will translate url encoding to string representations
function cleanCookie(cookie)
{
    const cookieString = cookie.split('=').pop();

    return decodeURIComponent(cookieString);

}

function setCartTotal(total)
{
    document.querySelector('.cart-total').textContent = parseFloat(total).toFixed(2);

}

function build(shoppingItems)
{
    const cartItems = shoppingItems.cart_items;
    const shoppingCartView = document.querySelector('.saved-shopping-cart');

    cartItems.forEach((item) => {
        shoppingCartView.insertAdjacentHTML('beforebegin', shoppingItemHTML(item));
    });

    setCartTotal(parseFloat(shoppingItems.cart_total).toFixed(2));
}


function shoppingItemHTML(item)
{
    return `<li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
            <h6 class="my-0">${item.type}</h6>
            <small class="text-muted">${item.colour}</small>
        </div>
        <span class="text-muted">${item.price}</span>
         <a class="close remove-button" aria-label="remove">
            <span aria-hidden="true">×</span>
         </a>
    </li>`;
}