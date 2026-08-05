console.log("oi");

const faqsRegisterForm = document.querySelector("#faqs-register-form");

faqsRegisterForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const myHeaders = new Headers();
    myHeaders.append("Authorization", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE3ODU5NTM5NTgsImp0aSI6Im5XaUFaNzhjcVdoK3pUN2Z6eURFTmc9PSIsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3QvYWNtZS0zYXQiLCJuYmYiOjE3ODU5NTM5NTgsImV4cCI6MTc4NTk1OTM1OCwiZGF0YSI6eyJpZCI6MywibmFtZSI6IkZcdTAwZTFiaW8gU2FudG9zIiwiZW1haWwiOiJmYWJpb19hZG1pbkBpZnN1bC5lZHUuYnIifX0.RiQtJvIQ60d8i_Y8_Jqv5TON1gNJFkIyj3_Te0prFpPITkmrCrVMxZgbdYya22vaW2BZdK2bNpqNP4ZV7t4ArA");
    const response = await fetch("http://localhost:8080/acme-3at/api/faqs", {
        method: "POST",
        headers: myHeaders,
        body: new FormData(faqsRegisterForm)
    });
    const data = await response.json();
    console.log(data);
});