'use strict';

{
  const open = document.getElementById("open");
  const close = document.getElementById("close");
  const overlay = document.querySelector(".overlay");
  open.addEventListener("click",()=>{
    overlay.classList.toggle("active");
    open.classList.toggle("inactive");
  });

  close.addEventListener("click",()=>{
    overlay.classList.toggle("active");
    open.classList.toggle("inactive");
  });
}