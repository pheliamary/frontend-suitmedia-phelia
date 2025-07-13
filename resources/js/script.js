
let lastScrollTop = 0;
const navbar = document.getElementById('mainNavbar');
let isScrollingUp = false;

// Navbar Behavior
document.addEventListener('DOMContentLoaded', function() {
    if (window.pageYOffset === 0) {
        navbar.style.backgroundColor = 'rgba(255, 92, 0, 1)';
    }
});

window.addEventListener('scroll', function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > 50) {
        navbar.classList.add('navbar-scrolled');
        navbar.style.backgroundColor = 'rgba(255, 92, 0, 0.85)';
        navbar.style.backdropFilter = 'blur(10px)';
        navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.15)';
    } else {
        navbar.classList.remove('navbar-scrolled');
        navbar.style.backgroundColor = 'rgba(255, 92, 0, 1)';
        navbar.style.backdropFilter = 'none';
        navbar.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
    }

    if (scrollTop > lastScrollTop && scrollTop > 100) {
        navbar.classList.add('navbar-hidden');
        isScrollingUp = false;
    } else if (scrollTop < lastScrollTop) {
        navbar.classList.remove('navbar-hidden');
        isScrollingUp = true;
    }

    lastScrollTop = scrollTop;
});

// Parallax
let ticking = false;
function updateParallax() {
    const scrolled = window.pageYOffset;
    const parallaxBg = document.querySelector('.parallax-bg');
    const heroContent = document.querySelector('.ideas-hero-content');

    if (parallaxBg && heroContent && scrolled < window.innerHeight) {
        parallaxBg.style.transform = `translateY(${scrolled * 0.5}px)`;
        heroContent.style.transform = `translateY(${scrolled * 0.3}px)`;
    }
    ticking = false;
}
function requestTick() {
    if (!ticking) {
        requestAnimationFrame(updateParallax);
        ticking = true;
    }
}
window.addEventListener('scroll', requestTick);

// Active Menu
function setActiveMenu() {
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPath || 
            (currentPath === '/' && linkPath === '/') || 
            (currentPath.includes('ideas') && linkPath.includes('ideas'))) {
            link.classList.add('active');
        }
    });
}
document.addEventListener('DOMContentLoaded', setActiveMenu);

// Scroll Smooth
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});

// Ideas API Fetch
let ideas = [];
const container = document.getElementById("ideasContainer");
const perPageSelect = document.getElementById("perPageSelect");
const sortSelect = document.getElementById("sortSelect");
const showingText = document.getElementById("showingText");
const paginationContainer = document.getElementById("paginationContainer");
let currentPage = 1;

async function fetchIdeas() {
    try {
        const page = currentPage;
        const size = parseInt(perPageSelect.value);
        const sort = sortSelect.value === 'newest' ? '-published_at' : 'published_at';

        const res = await fetch(`/api/proxy/ideas?page=${page}&size=${size}&sort=${sort}`);
        const data = await res.json();

        ideas = data.data || [];
        renderCards();
    } catch (error) {
        console.error("Gagal mengambil data dari API:", error);
    }
}

function renderCards() {
    const perPage = parseInt(perPageSelect.value);
    const totalItems = ideas.length;
    const totalPages = Math.ceil(totalItems / perPage);
    const start = (currentPage - 1) * perPage;
    const end = start + perPage;
    const visibleIdeas = ideas.slice(start, end);

    showingText.textContent = `Showing ${start + 1} - ${Math.min(end, totalItems)} of ${totalItems}`;
    container.innerHTML = "";

    visibleIdeas.forEach(idea => {
        const imageUrl = idea.medium_image || idea.small_image || '';
        const card = `
            <div class="col">
                <div class="card idea-card h-100">
                    <img src="${imageUrl}" class="card-img-top square-img" alt="${idea.title}">
                    <div class="card-body">
                        <p class="card-text text-muted mb-1"><small>${new Date(idea.published_at).toLocaleDateString()}</small></p>
                        <h5 class="card-title">${idea.title}</h5>
                    </div>
                </div>
            </div>
        `;
        container.insertAdjacentHTML("beforeend", card);
    });

    renderPagination(totalPages);
}

function renderPagination(totalPages) {
    paginationContainer.innerHTML = "";
    const prevClass = currentPage === 1 ? "disabled" : "";
    const nextClass = currentPage === totalPages ? "disabled" : "";

    paginationContainer.innerHTML += `
        <li class="page-item ${prevClass}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage - 1})">Previous</a>
        </li>
    `;

    for (let i = 1; i <= totalPages; i++) {
        paginationContainer.innerHTML += `
            <li class="page-item ${i === currentPage ? "active" : ""}">
                <a class="page-link" href="#" onclick="goToPage(${i})">${i}</a>
            </li>
        `;
    }

    paginationContainer.innerHTML += `
        <li class="page-item ${nextClass}">
            <a class="page-link" href="#" onclick="goToPage(${currentPage + 1})">Next</a>
        </li>
    `;
}

function goToPage(page) {
    const totalPages = Math.ceil(ideas.length / parseInt(perPageSelect.value));
    if (page >= 1 && page <= totalPages) {
        currentPage = page;
        renderCards();
    }
}

perPageSelect.addEventListener("change", () => {
    currentPage = 1;
    fetchIdeas();
});
sortSelect.addEventListener("change", () => {
    currentPage = 1;
    fetchIdeas();
});

fetchIdeas();
