document
  .getElementById("guestbook-form")
  .addEventListener("submit", function (event) {
    const username = document.getElementById("username").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;

    const usernamePattern = /^[a-zA-Z0-9]+$/;
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

    if (!usernamePattern.test(username)) {
      alert("Invalid username. Only letters and numbers are allowed.");
      event.preventDefault();
    }

    if (!emailPattern.test(email)) {
      alert("Invalid email format.");
      event.preventDefault();
    }

    if (message.trim() === "") {
      alert("Message cannot be empty.");
      event.preventDefault();
    }
  });
