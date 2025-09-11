<template>
  <div
    class="col-xl-3 col-lg-4 col-md-6 fadeinup wow"
    style="visibility: visible; animation-name: fadeinup"
  >
    <div
      class="team-card style-2 background-image"
      style="
        background-image: url('assets/frontend/img/shape/team-2-bg-shape.png');
      "
    >
      <div class="team-img">
        <img :src="member?.image ? '/' + member?.image : '/uploads/default_man.jpeg'" alt="Team" />
      </div>
      <div class="team-content">
        <div class="left-contet">
          <h3 class="box-title">
            <a href="team-details.html">{{ member?.name }}</a>
          </h3>
          <span class="team-desig">{{ member?.designation }}</span>
        </div>
        <div class="team-social">
          <div class="th-social">
            <a target="_blank" v-for="(social, i) in member?.social_link" :key="i" :href="social?.title">
              <i :class="social?.icon"></i>
            </a>
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

