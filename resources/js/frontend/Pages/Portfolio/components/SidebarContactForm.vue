<template>
  <div class="widget sidebar-contact-form">
    <h3 class="widget_title">Contact Us</h3>
    <div class="contact-form-widget">
      <form action="#" class="newsletter-form">
        <div class="form-group">
          <input
            class="form-control"
            type="text"
            placeholder="Your Name"
            required=""
          />
        </div>
        <div class="form-group">
          <input
            class="form-control"
            type="email"
            placeholder="Your Email"
            required=""
          />
        </div>
        <div class="form-group">
          <input
            class="form-control"
            type="text"
            placeholder="Your Phone"
            required=""
          />
        </div>
        <div class="form-group mb-4">
          <textarea
            name="Your message"
            id="message"
            cols="30"
            rows="3"
            class="form-control"
            placeholder="Your Message"
          ></textarea>
        </div>
        <div class="form-btn pt-2">
          <button type="submit" class="th-btn radius">Send Us</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped></style>
