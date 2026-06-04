const form = document.querySelector('form')
const inputs = document.querySelectorAll('input')

form.addEventListener('submit',(event)=>{
    event.preventDefault()
    if(checkInputs()){
        form.submit()
    }
})

const checkInputs=()=>{
    let correct=true
    inputs.forEach((input)=>{
        if(input.value===''){
            input.nextElementSibling.style.visibility='visible'
            input.style.borderColor='red'
            correct=false
        }else{
            input.nextElementSibling.style.visibility='hidden'
            input.style.borderColor='var(--Text_Gray)'
        }
    })
    return correct
}