/**
 * Theme: Taildash - Tailwind CSS 3 Admin Layout & UI Kit Template
 * Author: MyraStudio
 * Module/App: App js
 */

// import _ from 'lodash/lodash';

import "dropzone/dist/dropzone-min";

import "preline";
import "jquery";
import "simplebar";
import Waves from "node-waves";

import Swal from "sweetalert2";
window.Swal = Swal;
class App {
    constructor() {
        this.html = document.getElementsByTagName("html")[0];
        this.config = {};
        this.defaultConfig = window.config;
    }

    initComponents() {
        // Wave Effect
        Waves.init();
    }

    initSidenav() {
        var self = this;
        var pageUrl = window.location.href.split(/[?#]/)[0];
        document
            .querySelectorAll("ul.admin-menu .menu-item a")
            .forEach((element) => {
                if (element.href === pageUrl) {
                    element.classList.add("active");

                    let parentMenuItem = element.closest(".menu-item");
                    parentMenuItem.classList.add("active");

                    let parentMenu =
                        element.parentElement.parentElement.parentElement
                            .parentElement;
                    if (
                        parentMenu &&
                        parentMenu.classList.contains("menu-item")
                    ) {
                        const collapseElement = parentMenu.querySelector(
                            ".hs-accordion-toggle"
                        );

                        if (collapseElement) {
                            // collapseElement.classList.add("active");
                            collapseElement.classList.add("open");
                            parentMenu.classList.add("active");
                            const nextE = collapseElement.nextElementSibling;
                            if (nextE) {
                                nextE.classList.remove("hidden");
                            }
                        }
                    }
                }
            });

        setTimeout(function () {
            var activatedItem = document.querySelector(
                "ul.admin-menu .menu-item.active a.active"
            );
            if (activatedItem != null) {
                var simplebarContent = document.querySelector(
                    "#app-menu .simplebar-content-wrapper"
                );

                var offset = activatedItem.offsetTop - 300;
                if (simplebarContent && offset > 100) {
                    scrollTo(simplebarContent, offset, 600);
                }
            }
        }, 200);

        // scrollTo (Sidenav Active Menu)
        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return (c / 2) * t * t + b;
            t--;
            return (-c / 2) * (t * (t - 2) - 1) + b;
        }

        function scrollTo(element, to, duration) {
            var start = element.scrollTop,
                change = to - start,
                currentTime = 0,
                increment = 20;
            var animateScroll = function () {
                currentTime += increment;
                var val = easeInOutQuad(currentTime, start, change, duration);
                element.scrollTop = val;
                if (currentTime < duration) {
                    setTimeout(animateScroll, increment);
                }
            };
            animateScroll();
        }
    }

    reverseQuery(element, query) {
        while (element) {
            if (element.parentElement) {
                if (element.parentElement.querySelector(query) === element)
                    return element;
            }
            element = element.parentElement;
        }
        return null;
    }

    // Topbar Fullscreen Button
    initfullScreenListener() {
        var self = this;
        var fullScreenBtn = document.querySelector(
            '[data-toggle="fullscreen"]'
        );

        if (fullScreenBtn) {
            fullScreenBtn.addEventListener("click", function (e) {
                e.preventDefault();
                document.body.classList.toggle("group-fullscreen");
                if (
                    !document.fullscreenElement &&
                    !document.mozFullScreenElement &&
                    !document.webkitFullscreenElement
                ) {
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (
                        document.documentElement.webkitRequestFullscreen
                    ) {
                        document.documentElement.webkitRequestFullscreen(
                            Element.ALLOW_KEYBOARD_INPUT
                        );
                    }
                } else {
                    if (document.cancelFullScreen) {
                        document.cancelFullScreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitCancelFullScreen) {
                        document.webkitCancelFullScreen();
                    }
                }
            });
        }
    }

    init() {
        this.initComponents();
        this.initSidenav();
        this.initfullScreenListener();
    }
}

new App().init();

window.addEventListener("alert", (event) => {
    let data = event.detail;
    Swal.fire({
        position: data.position,
        icon: data.icon,
        title: data.title,
        showConfirmButton: false,
        timer: data.timer,
        customClass: {
            title: 'font-anuphan',  // เพิ่มคลาสสำหรับ title
        }
    });
});

window.addEventListener("alertConfirmDelete", (event) => {
    let data = event.detail;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            cancelButton: "bg-danger me-2 p-3 rounded text-white font-anuphan",
            confirmButton: "bg-success me-2 p-3 rounded text-white font-anuphan",
            title: "font-prompt text-2xl",
            htmlContainer: "font-prompt text-lg",
        },
        buttonsStyling: false,
    });

    swalWithBootstrapButtons
        .fire({
            title: "คุณต้องการลบใช่หรือไม่ ?",
            text: "เพราะไม่สามารถกู้คืนได้ !",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, ต้องการลบ !",
            // reverseButtons: true,
        })
        .then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch("deleteConfirmed");
            } else {
                //
            }
        });
});
