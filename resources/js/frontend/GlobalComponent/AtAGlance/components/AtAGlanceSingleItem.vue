<template>
  <div class="counter-card fadeinup wow">
    <div class="box-icon fixed_size">
      <img :src="item.icon" alt="Icon" />
    </div>
    <div class="media-body">
      <h4 class="box-number">
        <span class="counter-number">{{ item?.number }}</span
        ><span class="plus-simple">+</span>
      </h4>
      <p class="box-text">{{ item?.title }}</p>
    </div>
  </div>
</template>

<script>
export default {
    name: "AtAGlanceSingleItem",
    props: {
        item: {
        type: Object,
        required: true,
        },
    },
};
</script>

<style lang="scss" scoped>
.box-icon.fixed_size {
  width: 70px;
  height: 70px;
  img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}
</style>
