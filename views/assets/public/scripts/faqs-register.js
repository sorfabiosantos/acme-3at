console.log("oi");

const faqsRegisterForm = document.querySelector("#faqs-register-form");

faqsRegisterForm.addEventListener("submit", async (event) => {
    event.preventDefault();
    const myHeaders = new Headers();
    myHeaders.append("Authorization", "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE3ODU5MzA3NzYsImp0aSI6IlVIQU1nUTIyWlhnTVdJaktKVDFLSHc9PSIsImlzcyI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC9hY21lLTNhbSIsIm5iZiI6MTc4NTkzMDc3NiwiZXhwIjoxNzg1OTM2MTc2LCJkYXRhIjp7ImlkIjo4LCJuYW1lIjoiQWRtaW4gLSAwMSIsImVtYWlsIjoiYWRtaW5fMDFAZ21haWwuY29tIn19.grxcF3NSjJtF1BN8zDMaZ5FhyxNTD1MoH7u5EpPOWWsETYuoxcyDhhplYkFRvPuhm0c0i0bq2GyqSjtNgEL2MQ");
    const response = await fetch("http://localhost:8080/acme-3am/api/faqs", {
        method: "POST",
        headers: myHeaders,
        body: new FormData(faqsRegisterForm)
    });
    const data = await response.json();
    console.log(data);
});