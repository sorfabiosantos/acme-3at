console.log("oi..");

async function fetchFAQs() {
   const response = await fetch("http://localhost:8080/acme-3at/api/faqs/category/1");
   console.log(response);
   const faqs = await response.json();
   console.log(faqs.data);
   const listFaqs = document.querySelector("#list-faqs");
   faqs.data.forEach(faq => {
      const faqItem = document.createElement("faq-item");
      console.log(faq.question, faq.answer);
      faqItem.innerHTML = `
      <dt>
          <button class="faq-question" aria-expanded="false">
              <span>${faq.question}</span>
              <i data-lucide="plus" class="w-5 h-5 faq-icon text-surface-gray" aria-hidden="true"></i>
          </button>
      </dt>
      <dd class="faq-answer">
         <p>${faq.answer}</p>
     </dd>
      `;
      listFaqs.append(faqItem);
   });
}

fetchFAQs();
