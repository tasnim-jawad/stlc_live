<template>
  <div class="swiper-slide">
    <div class="team-card">
      <div
        class="team-img"
        :style="{
          backgroundImage: `url(/assets/frontend/img/shape/team-bg-pattern.png)`,
        }"
      >
        <img :src="member?.image" alt="Team" />
      </div>
      <div class="team-content">
        <h3 class="box-title">
          <a href="javascript:void(0)">{{ member?.name }}</a>
        </h3>
        <span class="team-desig">{{ member?.designation }}</span>
        <div class="team-social">
          <div class="th-social">
            <a
              v-for="(link, index) in member?.social_link"
              :key="index"
              target="_blank"
              :href="link?.title"
              ><i :class="link?.icon"></i
            ></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    member: {
      type: Object,
      required: true,
    },
  },
};
</script>

<style scoped></style>
