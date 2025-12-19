const firstName = document.getElementById('firstName')
const lastName = document.getElementById('lastName')
const email = document.getElementById('email')
const password = document.getElementById('password')
const terms = document.getElementById('terms')
const submitButton = document.querySelector('.submitBtn')
const form = document.querySelector('form')
const inputs = document.querySelectorAll('input')

form.addEventListener('submit',(e)=>{
    e.preventDefault()
    let correct = true
    correct = checkInputs()
    if(correct){
        form.submit()
    }
})

const checkInputs=()=>{
    let correct = true
    inputs.forEach((input)=>{
        if(input.value===""){
            input.style.borderColor = "red"
            input.nextElementSibling.style.visibility = "visible"
            correct = false
        }else{
            input.style.borderColor = "var(--Text_Gray)"
            input.nextElementSibling.style.visibility = "hidden"
        }
    })
    return correct
}