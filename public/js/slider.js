/**
 * Da init nos sliders da pagina
 */
window.onload = function() {
    const sliders = document.querySelectorAll('.slider')
    let wrappers = [],
        dots = [],
        arrows_left = [],
        arrows_right = [],
        sliders_times = {},
        total = document.querySelectorAll('.slider .sliders-wrapper img').length,
        imgs,
        actual = 0,
        delay = 7

    if (sliders.length === 0) return
    
    for (slide of sliders) {
        wrappers.push(slide.querySelectorAll('.sliders-wrapper'))
        dots = slide.querySelectorAll('.dots-wrapper .dot')
        arrows_left.push(slide.querySelectorAll('.arrow-left'))
        arrows_right.push(slide.querySelectorAll('.arrow-right'))

        // Seta o timer para trocar automaticamente
        sliders_times[slide] = setInterval(function() {
            change_slide(1, slide)
        }, delay * 1000)
    }
    
    if (wrappers.length === 0 || dots.length === 0) return

    for (wrapper of wrappers) {
        Object.values(wrapper)
            .map( w => {
                imgs = w.querySelectorAll('img')
                w.style.width = `${100 * imgs.length}%`
        
                for (img of imgs) {
                    img.style.width = `${100 / imgs.length}%`
                }
            }
        )
    }

    for (dot of dots) {
        dot.addEventListener('click', function() {
            change_dots(
                    Array.from(this.parentNode.children).indexOf(this),
                    this
                )
        })
    }

    for (arrow of arrows_left) {
        Array.from(arrow).map(a => a.addEventListener('click', function() {
            change_arrow(-1, this)
        }))
    }

    for (arrow of arrows_right) {
        Array.from(arrow).map(a => a.addEventListener('click', function() {
            change_arrow(1, this)
        }))
    }

    function change_arrow(add, that) {
        let dot,
            event = new Event('click')

        actual = add + actual >= total ? 0 : add + actual
        actual = actual < 0 ? total - 1 : actual

        dot = that.parentNode.parentNode.querySelectorAll('.dots-wrapper .dot')[actual]
        dot.dispatchEvent(event)
    }

    function change_slide(add, slider) {
        let slide, wrapper

        actual = actual + add >= total ? 0 : actual + add
        actual = actual < 0 ? total - 1 : actual

        slide = slider.querySelectorAll('.sliders-wrapper img')[actual]
        wrapper = slide.parentNode

        wrapper.style.right = `${slide.offsetLeft}px`

        // Muda as dots tambem
        Array.from(
                slider.querySelectorAll('.dots-wrapper .dot'),
                x => {
                    x.classList.remove('active')
                    return x
                }
             )[actual]
             .classList.add('active')
    }

    function change_dots(index, that) {
        let slider,
            img,
            slider_wrapper
        
        actual = index
        slider = that.parentNode.parentNode

        clearInterval(sliders_times[slide])
        sliders_times[slide] = setInterval(function() {
            change_slide(1, slide)
        }, delay * 1000)

        img = slider.querySelectorAll('.sliders-wrapper img')[actual]
        slider_wrapper = slider.querySelector('.sliders-wrapper')
        slider_wrapper.style.right = `${img.offsetLeft}px`

        Array.from(that.parentNode.children).map(x => x.classList.remove('active'))
        that.classList.add('active')
    }
}