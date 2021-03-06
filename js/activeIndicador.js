const secciones = document.querySelectorAll(".seccion");
const menuItems = document.querySelectorAll(".menu_itemNoticia");

const funcionObserver = (entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      const itemActual = Array.from(menuItems).find(
        (item) => item.dataset.url === entry.target.id
      );
      itemActual.classList.add("activeNoticias");
      for (const item of menuItems) {
        if (item != itemActual) {
          item.classList.remove("activeNoticias");
        }
      }
    }
  });
};

const observer = new IntersectionObserver(funcionObserver, {
  root: null,
  rootMargin: "-100px",
  threshold: 1,
});

secciones.forEach((seccion) => observer.observe(seccion));
