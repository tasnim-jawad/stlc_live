<template>
  <div class="logo-icon-wrap__text">
    <span class="logo-animation">
      <span
        v-for="(char, index) in letters"
        :key="index"
        :class="`char${index + 1}`"
      >
        {{ char }}
      </span>
    </span>
  </div>
</template>

<script>
export default {
  props: {
    text: {
      type: String,
      default: "PILLAR REAL ESTATE HOME * REAL ESTATE",
    },
  },
  computed: {
    letters() {
      return [...this.text]; // split string into array of letters
    },
  },
};
</script>
