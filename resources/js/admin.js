const sidebar = document.getElementById("sidebar");
const toggleBtn = document.getElementById("toggle");
const closeBtn = document.getElementById("close");
const backdrop = document.getElementById("backdrop");
const pageTitle = document.getElementById("page-title");
const profile = document.getElementById("profile");
const profileBtn = document.getElementById("profile-btn");
const profileMenu = document.getElementById("profile-menu");

const isMobile = window.matchMedia("(max-width: 768px)");

/* Desktop: collapse to icon rail */
function setCollapsed(isCollapsed) {
  sidebar.classList.toggle("collapsed", isCollapsed);
  toggleBtn.setAttribute("aria-expanded", String(!isCollapsed));
  try {
    localStorage.setItem("sb-collapsed", isCollapsed);
  } catch (e) {}
}

/* Remember the user's choice between page loads */
try {
  setCollapsed(localStorage.getItem("sb-collapsed") === "true");
} catch (e) {}

/* Mobile: slide-in drawer */
function openDrawer() {
  sidebar.classList.add("open");
  backdrop.classList.add("show");
  toggleBtn.setAttribute("aria-expanded", "true");
  closeBtn.focus();
}

function closeDrawer() {
  sidebar.classList.remove("open");
  backdrop.classList.remove("show");
  toggleBtn.setAttribute("aria-expanded", "false");
}

/* One toggle button for both */
toggleBtn.addEventListener("click", () => {
  if (isMobile.matches) {
    sidebar.classList.contains("open") ? closeDrawer() : openDrawer();
  } else {
    setCollapsed(!sidebar.classList.contains("collapsed"));
  }
});

closeBtn.addEventListener("click", () => {
  closeDrawer();
  toggleBtn.focus();
});

backdrop.addEventListener("click", closeDrawer);

/* Profile dropdown */
const menuItems = () => [...profileMenu.querySelectorAll('[role="menuitem"]')];

function setMenu(open) {
  profileMenu.hidden = !open;
  profileBtn.setAttribute("aria-expanded", String(open));
  if (open) menuItems()[0].focus();
}

profile.addEventListener("click", () => setMenu(profileMenu.hidden));

document.addEventListener("click", (e) => {
  if (!profile.contains(e.target)) setMenu(false);
});

/* Escape closes whatever is open */
document.addEventListener("keydown", (e) => {
  if (e.key !== "Escape") return;
  if (!profileMenu.hidden) {
    setMenu(false);
  } else if (sidebar.classList.contains("open")) {
    closeDrawer();
    toggleBtn.focus();
  }
});
