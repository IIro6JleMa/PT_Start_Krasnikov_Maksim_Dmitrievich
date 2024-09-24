
const img = document.getElementById('profile-photo');


const button = document.getElementById('toggle-btn');


const alternateImg = document.createElement('img');
alternateImg.src = '123.jpg';  
alternateImg.className = 'rounded img-fluid shadow-lg mt-4';
alternateImg.style.display = 'none';  


button.parentNode.insertBefore(alternateImg, button.nextSibling);


button.addEventListener('click', () => {

    if (alternateImg.style.display === 'none') {
        alternateImg.style.display = 'block';  
        img.style.display = 'none';            
    } else {
        alternateImg.style.display = 'none';   
        img.style.display = 'block';           
    }
});
