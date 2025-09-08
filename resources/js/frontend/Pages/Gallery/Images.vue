<template>
  <div
    v-for="(item, index) in galleryImages"
    :key="item.src"
    :class="`col-lg-4 col-xl-4 col-md-6 col-xxl-auto filter-item cat${
      index % 5
    } cat${(index + 1) % 5} cat${(index + 2) % 5}`"
  >
    <div class="gallery-card2">
      <div class="gallery-img">
        <img :src="item.src" alt="gallery image" />
        <a class="popular-popup-image" :href="item.src"
          ><i class="fa-solid fa-eye"></i
        ></a>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  props: {
    galleryImages: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style lang="scss" scoped></style>
