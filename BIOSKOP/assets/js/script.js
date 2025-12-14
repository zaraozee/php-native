// Konfirmasi sebelum logout
function confirmLogout() {
    return confirm("Yakin ingin logout?");
}

// Highlight kursi saat dipilih
document.addEventListener("DOMContentLoaded", function() {
    const kursiCheckbox = document.querySelectorAll("input[name='kursi[]']");
    kursiCheckbox.forEach(kursi => {
        kursi.addEventListener("change", function() {
            if (this.checked) {
                this.parentElement.style.background = "#2ecc71";
                this.parentElement.style.color = "white";
                this.parentElement.style.padding = "5px";
                this.parentElement.style.borderRadius = "4px";
            } else {
                this.parentElement.style.background = "transparent";
                this.parentElement.style.color = "black";
            }
        });
    });
});
