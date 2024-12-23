// JavaScript for validating login and register forms
document.addEventListener("DOMContentLoaded", function () {
  // Function to validate login form
  const loginForm = document.querySelector('.auth-form[action$="/auth/login"]');

  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();

      let isValid = true;
      let errorMessage = "";

      if (username === "") {
        isValid = false;
        errorMessage = "Username cannot be empty.";
      } else if (password === "") {
        isValid = false;
        errorMessage = "Password cannot be empty.";
      }

      if (!isValid) {
        event.preventDefault();
        alert(errorMessage);
      }
    });
  }

  // Function to validate register form
  const registerForm = document.querySelector(
    '.auth-form[action$="/auth/register"]'
  );

  if (registerForm) {
    registerForm.addEventListener("submit", function (event) {
      const name = document.getElementById("name").value.trim();
      const email = document.getElementById("email").value.trim();
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();

      let isValid = true;
      let errorMessage = "";

      if (name === "") {
        isValid = false;
        errorMessage = "Name cannot be empty.";
      } else if (email === "") {
        isValid = false;
        errorMessage = "Email cannot be empty.";
      } else if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        isValid = false;
        errorMessage = "Please enter a valid email address.";
      } else if (username === "") {
        isValid = false;
        errorMessage = "Username cannot be empty.";
      } else if (password === "") {
        isValid = false;
        errorMessage = "Password cannot be empty.";
      } else if (
        !password.match(
          /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
        )
      ) {
        isValid = false;
        errorMessage =
          "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
      }

      if (!isValid) {
        event.preventDefault();
        alert(errorMessage);
      }
    });
  }

  // Additional event: Highlight input fields on focus
  const inputFields = document.querySelectorAll("input");

  inputFields.forEach((input) => {
    input.addEventListener("focus", function () {
      this.style.borderColor = "#007bff";
      this.style.boxShadow = "0 0 5px rgba(0, 123, 255, 0.5)";
    });

    input.addEventListener("blur", function () {
      this.style.borderColor = "";
      this.style.boxShadow = "";
    });
  });

  // Additional event: Real-time email validation feedback
  const emailField = document.getElementById("email");

  if (emailField) {
    const emailFeedback = document.createElement("p");
    emailFeedback.id = "email-feedback";
    emailFeedback.style.marginTop = "5px";
    emailField.parentNode.insertBefore(emailFeedback, emailField.nextSibling);

    emailField.addEventListener("input", function () {
      if (!this.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
        emailFeedback.textContent = "Invalid email format";
        emailFeedback.style.color = "red";
      } else {
        emailFeedback.textContent = "";
      }
    });
  }
});
    