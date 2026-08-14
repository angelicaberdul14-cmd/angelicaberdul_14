const pwd = document.getElementById("pwd");
const toggle = document.getElementById("togglePwd");

if (pwd && toggle) {
    toggle.addEventListener("click", function () {

        if (pwd.type === "password") {
            pwd.type = "text";
            toggle.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
        } else {
            pwd.type = "password";
            toggle.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
        }

    });
}