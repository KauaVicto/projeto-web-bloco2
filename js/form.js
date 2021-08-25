const labellogin = document.getElementsByClassName("labelInput")
const inputs = document.getElementsByClassName("inputs")
const inputText = document.getElementsByClassName('Text')
const labelText = document.getElementsByClassName('labelText')

for(let i = 0;i < 2;i++){
    inputs[i].addEventListener('focus', () => {
        if(inputs[i].value == ''){
            $(labellogin[i]).css({
                bottom: '40px',
                left: '1px',
                'font-size': '1rem',
                opacity: '1'
            })
        }
    })

    inputs[i].addEventListener('blur', () => {
        if(inputs[i].value == ''){
            $(labellogin[i]).css({
                bottom: '4px',
                left: '3px',
                'font-size': '1.1rem',
                opacity: '.56'
            })
        }
    })

    inputText[i].addEventListener('focus', () => {
        if($(inputText[i]).val() == ''){
            $(labelText[i]).css({
                'top': '-30px',
                left: '1px',
                'font-size': '1rem',
                opacity: '1'
            })
        }
    })
    
    inputText[i].addEventListener('blur', () => {
        if($(inputText[i]).val() == ''){
            $(labelText[i]).css({
                'top': '4px',
                left: '3px',
                'font-size': '1.1rem',
                opacity: '.56'
            })
        }
    })
}

function carregar(){
    for(let i = 0;i < inputs.length;i++){
        if(inputs[i].value == ''){
            labellogin[i].style.bottom = '4px'
            labellogin[i].style.left = '3px'
            labellogin[i].style.fontSize = '1.1rem'
            labellogin[i].style.opacity = '.56'
        }
        if(inputs[i].value != ''){
            labellogin[i].style.bottom = '40px'
            labellogin[i].style.left = '1px'
            labellogin[i].style.fontSize = '1rem'
            labellogin[i].style.opacity = '1'
        }

        if($(inputText[i]).val() != ''){
            $(labelText[i]).css({
                'top': '-30px',
                left: '1px',
                'font-size': '1rem',
                opacity: '1'
            })
        }
        if($(inputText[i]).val() == ''){
            $(labelText[i]).css({
                'top': '4px',
                left: '3px',
                'font-size': '1.1rem',
                opacity: '.56'
            })
        }
    }
}
