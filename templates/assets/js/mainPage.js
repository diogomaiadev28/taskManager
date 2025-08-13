const shadow = document.querySelector('.shadow')
const form = document.querySelector('.shadow form')
const taskName = document.querySelector('#taskName')
const description = document.querySelector('#description')
const day = document.querySelector('#day')
const month = document.querySelector('#month')
const year = document.querySelector('#year')
const button = document.querySelector('.rightNav button')
const h1 = document.querySelector('form h1')
const pencils = document.querySelectorAll('.pencil img')
const h3 = document.querySelectorAll('.title h3')
const h5 = document.querySelectorAll('.cardData h5')
const h4 = document.querySelectorAll('.button h4')
const inputs = document.querySelectorAll('input')
const formButton = document.querySelector('.firstForm button')
const otherButtons = document.querySelectorAll('.button form button')
const buttonForms = document.querySelectorAll('.button form')
const hidden = document.querySelector('#upOrCreate')

shadow.addEventListener('click',()=>{
    shadow.style.visibility = 'hidden'
})
pencils.forEach((pencil, index)=>{
    pencil.addEventListener('click',()=>{
        shadow.style.visibility = 'visible'
        h1.innerHTML = 'Edit task'
        hidden.nextElementSibling.innerHTML = 'Edit'
        taskName.value = h3[index].innerHTML
        description.value = h5[index].innerHTML
        month.value = h4[index].innerHTML.slice(0,2)
        day.value = h4[index].innerHTML.slice(3,5)
        year.value = h4[index].innerHTML.slice(6,10)
        hidden.value = pencil.parentElement.parentElement.parentElement.parentElement.id
    })
})
button.addEventListener('click',()=>{
    shadow.style.visibility = 'visible'
    h1.innerHTML = 'Create task'
    hidden.nextElementSibling.innerHTML = 'Create'
    taskName.value = ''
    description.value = ''
    day.value = ''
    month.value = ''
    year.value = ''
    hidden.value = -1
})
form.addEventListener('click',(event)=>{
    event.stopPropagation()
})
form.addEventListener('submit',(e)=>{
    e.preventDefault()
    if(checkInputs()){
        form.submit()
    }
})
const checkInputs =()=>{
    let correct = true
    inputs.forEach((input)=>{
        if(input.value === ''){
            input.style.borderColor = 'red'
            correct = false
        } else {
            input.style.borderColor = 'var(--Text_Gray)'
        }
    })
    return correct
}
formButton.addEventListener('click',()=>{
    if(checkInputs()){
        formButton.style.visibility = 'hidden'
    }
})
otherButtons.forEach((button)=>{
    button.addEventListener('click',()=>{
        if(checkInputs()){
            formButton.style.visibility = 'hidden'
        }
    })
})
