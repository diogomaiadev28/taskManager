const shadow = document.querySelector('.shadow')
const form = document.querySelector('form')
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

shadow.addEventListener('click',()=>{
    shadow.style.visibility = 'hidden'
})
pencils.forEach((pencil, index)=>{
    pencil.addEventListener('click',()=>{
        shadow.style.visibility = 'visible'
        h1.innerHTML = 'Edit task'
        taskName.value = h3[index].innerHTML
        description.value = h5[index].innerHTML
        month.value = h4[index].innerHTML.slice(0,2)
        day.value = h4[index].innerHTML.slice(3,5)
        year.value = h4[index].innerHTML.slice(6,10)
    })
})
button.addEventListener('click',()=>{
    shadow.style.visibility = 'visible'
    h1.innerHTML = 'Create task'
    taskName.value = ''
    description.value = ''
    day.value = ''
    month.value = ''
    year.value = ''
})
form.addEventListener('click',(event)=>{
    event.stopPropagation()
})