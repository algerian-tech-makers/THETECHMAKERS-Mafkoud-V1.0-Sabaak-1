const currentYear = document.querySelector("footer > div:nth-child(2) > p > span");
const year = new Date().getFullYear();
currentYear.innerHTML = year;