/**
 * Global variables
 */
"use strict";

let userAgent = navigator.userAgent.toLowerCase();
let initialDate = new Date();
let $html = document.querySelector("html");

let isDesktop = $html.classList.contains("desktop");
let isIE = userAgent.indexOf("msie") != -1 ? parseInt(userAgent.split("msie")[1]) : userAgent.indexOf("trident") != -1 ? 11 : userAgent.indexOf("edge") != -1 ? 12 : false;
let isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
let isTouch = "ontouchstart" in window;
let onloadCaptchaCallback;

var PIXEL = /^\d+(px)?$/i;

let plugins = {
  pointerEvents: isIE < 11 ? "js/pointer-events.min.js" : false,
  bootstrapTabs: document.getElementsByClassName("tabs"),
  rdNavbar: document.querySelector(".rd-navbar"),
  rdParallax: document.getElementsByClassName("rd-parallax"),
  rdInputLabel: document.getElementsByClassName("form-label"),
  owl: document.getElementsByClassName("owl-carousel"),
  swiper: document.getElementsByClassName("swiper-slider"),
  search: document.getElementsByClassName("rd-search"),
  searchResults: document.getElementsByClassName('rd-search-results'),
  statefulButton: document.getElementsByClassName('btn-stateful'),
  isotope: document.getElementsByClassName("isotope"),
  popover: document.querySelectorAll('[data-toggle="popover"]'),
  viewAnimate: document.getElementsByClassName('view-animate'),
  counter: document.getElementsByClassName("counter"),
  selectFilter: document.getElementsByTagName("select"),
  pageLoader: document.querySelectorAll(".page-loader"),
  slick: document.getElementsByClassName('slick-slider'),
  customSelect: document.getElementsByClassName("custom-select"),
  selectBreedsProfile: document.getElementById("profile-select-breeds"),
  selectBreedsHome: document.getElementById("home-select-breeds")
};
 

/**
 * Helper Methods
 */
const getScript = (scriptUrl, callback) => {
  const script = document.createElement("script");
  script.src = scriptUrl;
  script.onload = callback;

  document.body.appendChild(script);
}

const getPixelValue = (element, value) => {
    if (PIXEL.test(value)){
      return parseInt(value);
    }

    let style = element.style.left;
    let runtimeStyle = element.runtimeStyle.left;

    element.runtimeStyle.left = element.currentStyle.left;
    element.style.left = value || 0;

    value = element.style.pixelLeft;

    element.style.left = style;
    element.runtimeStyle.left = runtimeStyle;
    
    return value;
}


/**
 * Initialize All Scripts
 */
document.addEventListener("DOMContentLoaded", (event) => { 
  
  /**
   * Page loader
   * @description Enables Page loader
   */
  if (plugins.pageLoader.length > 0) {
    console.log("page loading");

    window.addEventListener("load", (e) => {
      let loader = setTimeout(() => {
        plugins.pageLoader[0].classList.add("loaded");
        window.dispatchEvent(new Event("resize"));
        console.log("page loaded");
      }, 100);
    });
  }  


  /**
   * Copyright Year
   * @description  Evaluates correct copyright year
   */
  let yearFooter = document.getElementById("copyright-year");
  if (yearFooter) {
    yearFooter.textContent = initialDate.getFullYear();
  }


  /**
   * UI To Top
   * @description Enables ToTop Button
   */
  if (isDesktop) {
    $().UItoTop({
      easingType: 'easeOutQuart',
      containerClass: 'ui-to-top fa fa-angle-up'
    });
  }


  /**
   * isScrolledIntoView
   * @description  Check if the element whas been scrolled into the view
   */
  const isScrolledIntoView = (elem) => {
    const rect = elem.getBoundingClientRect();
    const elemTop = rect.top;
    const elemBottom = rect.bottom;

    // Only completely visible elements return true:
    // let isVisible = (elemTop >= 0) && (elemBottom <= window.innerHeight);
    
    // Partially visible elements return true:
    let isVisible = elemTop < window.innerHeight && elemBottom >= 0;
    
    return isVisible;
  }


  /**
   * ViewPort Universal
   * @description Add class in viewport
   */
  if (plugins.viewAnimate.length) {
    for (let i = 0; i < plugins.viewAnimate.length; i++) {
      let $view;
      if (!plugins.viewAnimate[i].contains(".active")){
        $view = plugins.viewAnimate[i];
      }

      $document.addEventListener("scroll", function(){
        if (isScrolledIntoView(this)){
          this.classList.add("active");
        }
      }.bind($view)).dispatchEvent(new Event ("scroll"));
    }
  }


  /**
   * Custom Select
   * @description Add custom stylings for select tags
   */
  if (plugins.customSelect) {

    for (let elem of plugins.customSelect) {
      let selElem = elem.getElementsByTagName("select")[0];

      // For each element, create a new DIV that will act as the selected item
      let selectedItem = document.createElement("DIV");
      selectedItem.setAttribute("class", "select-selected");
      selectedItem.innerHTML = selElem.options[selElem.selectedIndex].innerHTML;
      elem.appendChild(selectedItem);

      // For each element, create a new DIV that will contain the option list
      let optionList = document.createElement("DIV");
      optionList.setAttribute("class", "select-items select-hide");
      
      // For each option in the original select element,
      // create a new DIV that will act as an option item
      for (let i = 1; i < selElem.length; i++) {
        let optionItem = document.createElement("DIV");
        optionItem.innerHTML = selElem.options[i].innerHTML;
        
        optionItem.addEventListener("click", function(e) {
          // When an item is clicked, update the original select box,
          // and the selected item
          let y, k, s, h, sl, yl;

          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          sl = s.length;
          h = this.parentNode.previousSibling;

          for (j = 0; j < sl; j++) {
            if (s.options[j].innerHTML == this.innerHTML) {
              s.selectedIndex = j;
              h.innerHTML = this.innerHTML;
              y = this.parentNode.getElementsByClassName("same-as-selected");
              yl = y.length;

              for (k = 0; k < yl; k++) {
                y[k].removeAttribute("class");
              }

              this.setAttribute("class", "same-as-selected");

              // If the element is the select type render the
              // apropriate select breeds
              if (plugins.selectBreedsProfile) {
                const allSelectProfile = document.getElementById("profile-select-all-breeds");
                const dogSelectProfile = document.getElementById("profile-select-dog-breeds");
                const catSelectProfile = document.getElementById("profile-select-cat-breeds");
                const smallAnimalSelectProfile = document.getElementById("profile-select-small-animal-breeds");

                switch (s.options[s.selectedIndex].value) {
                  case "cao":
                    allSelectProfile.style.display = "none";
                    catSelectProfile.style.display = "none";
                    smallAnimalSelectProfile.style.display = "none";

                    dogSelectProfile.style.display = "block";
                    break;
                  case "gato":
                    allSelectProfile.style.display = "none";
                    dogSelectProfile.style.display = "none";
                    smallAnimalSelectProfile.style.display = "none";

                    catSelectProfile.style.display = "block";
                    break;
                  case "pequeno":
                    allSelectProfile.style.display = "none";
                    dogSelectProfile.style.display = "none";
                    catSelectProfile.style.display = "none";

                    smallAnimalSelectProfile.style.display = "block";
                    break;
                }
              } 

              if (plugins.selectBreedsHome) {
                const allSelectIndex = document.getElementById("home-select-all-breeds");
                const dogSelectIndex = document.getElementById("home-select-dog-breeds");
                const catSelectIndex = document.getElementById("home-select-cat-breeds");
                const smallAnimalSelectIndex = document.getElementById("home-select-small-animal-breeds");

                switch (s.options[s.selectedIndex].value) {
                  case "cao":
                    allSelectIndex.style.display = "none";
                    catSelectIndex.style.display = "none";
                    smallAnimalSelectIndex.style.display = "none";

                    dogSelectIndex.style.display = "block";
                    break;
                  case "gato":
                    allSelectIndex.style.display = "none";
                    dogSelectIndex.style.display = "none";
                    smallAnimalSelectIndex.style.display = "none";

                    catSelectIndex.style.display = "block";
                    break;
                  case "pequeno":
                    allSelectIndex.style.display = "none";
                    dogSelectIndex.style.display = "none";
                    catSelectIndex.style.display = "none";

                    smallAnimalSelectIndex.style.display = "block";
                    break;
                }
              }

              break;
            }
          }
          h.click();
        });

        optionList.appendChild(optionItem);
      }

      elem.appendChild(optionList);

      selectedItem.addEventListener("click", function(e) {
        // When the select box is clicked, close any other select boxes,
        // and open/close the current select box
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }


    const closeAllSelect = (elmnt) => {
      // A function that will close all select boxes in the document,
      // except the current select box
      let x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }

    // If the user clicks anywhere outside the select box,
    // then close all select boxes
    document.addEventListener("click", closeAllSelect);
  }


  // RD

  /**
   * RD Navbar
   * @description Enables RD Navbar plugin
   */
  if (plugins.rdNavbar) {
    console.log("navabar loaded");
    $(plugins.rdNavbar).RDNavbar({
      stickUpClone: (plugins.rdNavbar.getAttribute("data-stick-up-clone")) ? plugins.rdNavbar.getAttribute("data-stick-up-clone") === 'true' : false
    });
    if (plugins.rdNavbar.getAttribute("data-body-class")) {
      document.body.className += ' ' + plugins.rdNavbar.attr("data-body-class");
    }
  }


  /**
   * RD Input Label
   * @description Enables RD Input Label Plugin
   */
  if (plugins.rdInputLabel.length) {
    $(plugins.rdInputLabel).RDInputLabel();
  }


  /**
   * RD Parallax
   * @description Enables RD Parallax plugin
   */
  if (plugins.rdParallax.length && !isMobile) {
    $.RDParallax();

    if (!isIE && !isMobile) {
      window.addEventListener("scroll", () => {
        for (let i = 0; i < plugins.rdParallax.length; i++) {
          let parallax = plugins.rdParallax[i];

          if (isScrolledIntoView(parallax)) {
            let inner = parallax.querySelectorAll("rd.parallax-inner");
            for (let elem of inner){
              elem.style.position = "fixed";
            }
          } else {
            let inner = parallax.querySelectorAll("rd.parallax-inner");
            for (let elem of inner){
              elem.style.position = "absolute";
            }            
          }
        }
      });
    }

    let elems = document.querySelectorAll("a[href='#'], a[href^='#']");
    for (let elem of elems){
      elem.addEventListener("click", (e) => {
        setTimeout(() => {
          window.dispatchEvent(new Event("resize"));
        }, 300);
      });
    }
  }

  
  // Bootstrap

  /**
   * Bootstrap Buttons
   * @description  Enable Bootstrap Buttons plugin
   */
  if (plugins.statefulButton.length) {

    plugins.statefulButton.addEventListener("click", () => {
      let statefulButtonLoading = $(this).button("loading");

      setTimeout(() => {
        statefulButtonLoading.button("reset");
      }, 2000);
    });
  }


  /**
   * Bootstrap tabs
   * @description Activate Bootstrap Tabs
   */
  if (plugins.bootstrapTabs.length) {
    
    for (let i = 0; i < plugins.bootstrapTabs.length; i++) {
      let bootstrapTabsItem = plugins.bootstrapTabs[i];
      let isURLTabs = bootstrapTabsItem.getAttribute('data-url-tabs') === 'true';
      let currentHash = window.location.hash;

      if (isURLTabs) {
        let elems = document.querySelectorAll('[data-content-to]:first-of-type');
        for (let elem of elems){
          elem.classList.add('show');
        }
      }

      let tabLinks = bootstrapTabsItem.querySelectorAll(".nav-tabs a");
      for (let link of tabLinks){
        link.addEventListener("click", (function(isURLTabs, currentHash) {
          return function(e){
            e.preventDefault();

            let currentLink = this.getAttribute("href");
            $(this).tab("show");

            if (isURLTabs){
              currentHash = currentLink;
              window.location.hash = currentHash;
            }

            let currentItems = document.querySelectorAll("[data-content-to].show");
            for (let item of currentItems){
              item.classList.remove("show");
            }

            let newItems = document.querySelectorAll(`[data-content-to="${currentHash}"]`);
            for (let item of newItems){
              item.classList.add("show");
            }
          };
        })(isURLTabs, currentHash));

        if (isURLTabs && currentHash){          
          setTimeout(() => {
            window.scrollTo(0, 0);
          }, 200);
        }

        link.addEventListener("click", (bootstrapTabsItem) => {
          return function(e){
            if (this.getAttribute("href").indexOf("#") === -1){
              return;
            }

            e.preventDefault();
            e.stopPropagation();
          };
        });
      } 
    }
  }


  /**
   * WOW 
   * @description Enables Wow animation plugin
   */
  if (isDesktop && $html.classList.contains("wow-animation") && document.querySelectorAll(".wow").length) {
    new WOW().init();
  }


  // Swiper

  /**
   * getSwiperHeight
   * @description  calculate the height of swiper slider basing on data attr
   */
  const getSwiperHeight = (object, attr) => {
    let val = object.getAttribute(`data-${attr}`);
    let dim;

    if (!val){
      return undefined;
    }

    dim = val.match(/(px)|(%)|(vh)$/i);

    if (dim.length){
      switch (dim[0]){
        case "px":
          return parseFloat(val);
        case "vh":
          return getComputedStyle(window, null).height * (parseFloat(val) / 100);
        case "%": 
          return getComputedStyle(object, null).width * (parseFloat(val) / 100);
      } 
    } else {
        return undefined;
    }
  }
  

  /**
   * Swiper 3.1.7
   * @description  Enable Swiper Slider
   */
  if (plugins.swiper.length) {
    
    for (let i = 0; i < plugins.swiper.length; i++){
      let s = plugins.swiper[i];
      let swiperSlides = s.getElementsByClassName("swiper-slide");

      let swiperSlider = new Swiper(".swiper-container", {
        autoplay: s.getAttribute('data-autoplay') ? s.getAttribute('data-autoplay') === "false" ? undefined : s.getAttribute('data-autoplay') : 5000,
        direction: s.getAttribute('data-direction') ? s.getAttribute('data-direction') : "horizontal",
        effect: s.getAttribute('data-slide-effect') ? s.getAttribute('data-slide-effect') : "slide",
        speed: s.getAttribute('data-slide-speed') ? s.getAttribute('data-slide-speed') : 600,
        pagination: {
          el: ".swiper-pagination", 
          type: "bullets",
          clickable: true
        },
        renderBullet: (index, className) => {
          return `<span class="${className}">${index + 1}</span>`;
        },
        loop: s.getAttribute('data-loop') !== "false",
        simulateTouch: s.getAttribute('data-simulate-touch') ? s.getAttribute('data-simulate-touch') === "true" : false,
      });

      for (let slide of swiperSlides){

        let url;
        if (url = slide.getAttribute("data-slide-bg")){
          slide.style.backgroundImage = `url("${url}")`;
          slide.style.backgroundSize = "cover";
        }
      }

      window.addEventListener("resize", () => {
        let minHeight = getSwiperHeight(s, "min-height");
        let height = getSwiperHeight(s, "height");

        if (height){
          s.style.height = minHeight ? minHeight > height ? minHeight : height : height;
        }
      });

      window.dispatchEvent(new Event("resize"));
    }
    console.log("slider loaded");
  }

 
  /**
   * Owl carousel 
   * @description Enables Owl carousel plugin
   */
  if (plugins.owl.length) {

    for (let i = 0; i < plugins.owl.length; i++) {
      let carousel = plugins.owl[i];
      let responsive = {};

      let aliaces = ["-", "-xs-", "-sm-", "-md-", "-lg-", "-xl-"];
      let values = [0, 480, 768, 992, 1200, 1600];
      
      for (let j = 0; j < values.length; j++) {
        responsive[values[j]] = {};

        for (let k = j; k >= -1; k--) {
          if (!responsive[values[j]]["items"] && carousel.getAttribute(`data${aliaces[k]}items`)) {
            responsive[values[j]]["items"] = k < 0 ? 1 : parseInt(carousel.getAttribute(`data${aliaces[k]}items`));
          }
          if (!responsive[values[j]]["stagePadding"] && responsive[values[j]]["stagePadding"] !== 0 && carousel.getAttribute(`data${aliaces[k]}stage-padding`)) {
            responsive[values[j]]["stagePadding"] = k < 0 ? 0 : parseInt(carousel.getAttribute(`data${aliaces[k]}stage-padding`));
          }
          if (!responsive[values[j]]["margin"] && responsive[values[j]]["margin"] !== 0 && carousel.getAttribute(`data${aliaces[k]}margin`)) {
            responsive[values[j]]["margin"] = k < 0 ? 30 : parseInt(carousel.getAttribute(`data${aliaces[k]}margin`));
          }
        }
      }

      // Create custom Numbering
      if (typeof(carousel.getAttribute("data-numbering")) !== 'undefined') {
        let numberingObject = carousel.getAttribute("data-numbering");

        carousel.addEventListener("initialized.owl.carousel changed.owl.carousel", function(numberingObject){
          return function(e){
            if (!e.namespace)
              return;

            numberingObject.querySelector(".numbering-current").textContent = (e.item.index + 1) % e.item.count + 1;
            numberingObject.querySelector(".numbering-count").textContent = e.item.count;
          };
        }(numberingObject));
      }

      $(carousel).owlCarousel({
        autoplay: carousel.getAttribute("data-autoplay") === "true",
        loop: carousel.getAttribute("data-loop") !== "false",
        items: 1,
        dotsContainer: carousel.getAttribute("data-pagination-class") || false,
        navContainer: carousel.getAttribute("data-navigation-class") || false,
        mouseDrag: carousel.getAttribute("data-mouse-drag") !== "false",
        nav: carousel.getAttribute("data-nav") === "true",
        center: carousel.getAttribute("data-center") === "true",
        dots: carousel.getAttribute("data-dots") === "true",
        dotsEach: carousel.getAttribute("data-dots-each") ? parseInt(carousel.getAttribute("data-dots-each")) : false,
        animateIn: carousel.getAttribute('data-animation-in') ? carousel.getAttribute('data-animation-in') : 'slide',
        animateOut: carousel.getAttribute('data-animation-out') ? carousel.getAttribute('data-animation-out') : false,
        responsive: responsive,
        navText: []
      });
    }
  }


  /**
   * Popovers
   * @description Enables Popovers plugin
   */
  if (plugins.popover.length) {
    if (window.innerWidth < 767) {
      plugins.popover.setAttribute('data-placement', 'bottom');
      plugins.popover.popover();
    }
    else {
      plugins.popover.popover();
    }
  }
  

  /**
   * Isotope
   * @description Enables Isotope plugin
   */
  if (plugins.isotope.length) {
    console.log("gallery")

    var i, j, isogroup = [];
    for (i = 0; i < plugins.isotope.length; i++) {
      var isotopeItem = plugins.isotope[i],
        filterItems = $(isotopeItem).closest('.isotope-wrap').find('[data-isotope-filter]'),
        iso;

      iso = new Isotope(isotopeItem, {
        itemSelector: '.isotope-item',
        layoutMode: isotopeItem.getAttribute('data-isotope-layout') ? isotopeItem.getAttribute('data-isotope-layout') : 'masonry',
        filter: '*',
        masonry: {
          columnWidth: 0.42
        }
      });

      isogroup.push(iso);

      filterItems.on("click", function (e) {
        e.preventDefault();
        var filter = $(this),
          iso = $('.isotope[data-isotope-group="' + this.getAttribute("data-isotope-group") + '"]'),
          filtersContainer = filter.closest(".isotope-filters");

        filtersContainer
          .find('.active')
          .removeClass("active");
        filter.addClass("active");

        iso.isotope({
          itemSelector: '.isotope-item',
          layoutMode: iso.attr('data-isotope-layout') ? iso.attr('data-isotope-layout') : 'masonry',
          filter: this.getAttribute("data-isotope-filter") == '*' ? '*' : '[data-filter*="' + this.getAttribute("data-isotope-filter") + '"]',
          masonry: {
            columnWidth: 0.42
          }
        });

        $(window).trigger('resize');

      }).eq(0).trigger("click");
    }

    $(window).on('load', function () {
      setTimeout(function () {
        var i;
        for (i = 0; i < isogroup.length; i++) {
          isogroup[i].element.className += " isotope--loaded";
          isogroup[i].layout();
        }
      }, 600);

      setTimeout(function () {
        $(window).trigger('resize');
      }, 800);
    });
  }

  
  /**
   * IE Polyfills
   * @description  Adds some loosing functionality to IE browsers
   */
  if (isIE) {
    if (isIE < 10) {
      $html.classList.add("lt-ie-10");
    }

    if (isIE < 11) {
      if (plugins.pointerEvents) {
        getScript(plugins.pointerEvents, () => {
          $html.classList.add("ie-10");
          PointerEventsPolyfill.initialize({});
        });
      }
    }

    if (isIE === 11) {
      $html.classList.add("ie-11");
    }

    if (isIE === 12) {
      $html.classList.add("ie-edge");
    }
  }


  /**
   * Is Mac os
   * @description  add additional class on html if mac os.
   */
  if (navigator.platform.match(/(Mac)/i)) $html.classList.add("mac-os");
});