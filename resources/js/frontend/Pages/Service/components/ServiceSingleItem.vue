<template>
  <div class="col-xl-4 col-md-12 fadeinup wow">
    <div class="service-card">
      <div class="box-thumb">
        <a href="javascript:void(0)"
          ><img
            :src="'/' + service?.primary_image"
            alt="thumb"
        /></a>
      </div>
      <div class="box-content">
        <div class="icon-wrap">
          <div class="icon">
            <img :src="'/' + service?.image" alt="img" />
          </div>
            <div class="number"><h3>{{ (index + 1).toString().padStart(2, '0') }}</h3></div>
        </div>
        <h3 class="box-title">
          <a href="javascript:void(0)">{{ service?.title }}</a>
        </h3>
        <p class="box-text">
          {{ service?.description }}
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ServiceSingleItem",
  props: {
    service: {
      type: Object,
      required: true
    },
    index: {
      type: Number,
      required: true
    }
  }
};
</script>

<style scoped>
.service-card .box-content .icon-wrap .icon{
  background: none;
}
.service-card .box-content .icon-wrap .icon img{
  object-fit: cover;
}
</style>
