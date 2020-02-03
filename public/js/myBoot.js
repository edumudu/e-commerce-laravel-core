window.addEventListener('load', function() {
    init_forms();
})

function init_forms() {
    /**
     * Floating Labels
     */
    let fields = document.querySelectorAll('.form-field')

    Array.from(fields, x => x.addEventListener('focusout', function () {
        if (this.value.trim().length > 0) 
            this.classList.add('active')
        else
            this.classList.remove('active')
    }))

    /**
     * range inputs
     */
    let ranges = document.querySelectorAll('input[type=range].popable')

    Array.from(ranges, x => x.addEventListener('mousemove', function(){
        let pop = this.nextElementSibling
        pop.innerHTML = this.value;
    }))
}