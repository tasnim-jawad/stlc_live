<template>
  <div class="contact-form-area">
    <div class="container">
      <div class="row gx-0">
        <div class="col-xl-12">
          <div class="contact-all-wrapper">
            <div class="contact-form-wrap">
              <form
                action="https://html.themeholy.com/piller/demo/mail.php"
                method="POST"
                class="contact-form ajax-contact"
              >
                <h3 class="form-title">Do you have questions? Contact Us</h3>
                <div class="row">
                  <div class="form-group col-md-6">
                    <input
                      type="text"
                      class="form-control"
                      name="name"
                      id="name"
                      placeholder="Name *"
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <input
                      type="tel"
                      class="form-control"
                      name="number"
                      id="number"
                      placeholder="Phone *"
                    />
                  </div>
                  <div class="form-group col-md-12">
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      placeholder="Email Address *"
                    />
                  </div>
                  <div class="form-group col-md-12">
                    <select name="subject" id="subject" class="orderby">
                      <option value="" disabled="" selected="" hidden="">
                        Select Subject
                      </option>
                      <option value="Apartment">Apartment</option>
                      <option value="House">House</option>
                      <option value="Villa">Villa</option>
                      <option value="Land">Land</option>
                    </select>
                  </div>
                  <div class="form-group col-12">
                    <textarea
                      name="Your Messsage*"
                      id="message"
                      cols="30"
                      rows="3"
                      class="form-control"
                      placeholder="Your Message *"
                    ></textarea>
                  </div>
                  <div class="form-btn text-start col-12">
                    <button class="th-btn radius">Send message</button>
                  </div>
                </div>
                <p class="form-messages mb-0 mt-3"></p>
              </form>
            </div>
            <div class="contact-form-thumb overflow-hidden">
              <img
                src="assets/frontend/img/contact/contact-page-thumb.jpg"
                alt="img"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped></style>
