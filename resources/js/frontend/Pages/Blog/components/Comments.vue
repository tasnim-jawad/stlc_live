<template>
  <li class="th-comment-item">
    <div class="th-post-comment">
      <div class="comment-avater">
        <img
          src="/uploads/default_man.jpeg"
          alt="Comment Author"
        />
      </div>
      <div class="comment-content">
        <h3 class="name">{{ comment.name }}</h3>
        <span class="commented-on">{{ formatDate(comment.created_at) }}</span>
        <p class="text">{{ comment.comment }}</p>
        <div class="reply_and_edit">
          <a href="javascript:void(0)" class="reply-btn"
            ><i class="fa-solid fa-comment"></i> Reply</a
          >
        </div>
      </div>
    </div>
  </li>
</template>

<script>
export default {
  props: {
    comment: {
      type: Object,
      required: true,
    },
  },
  methods: {
    formatDate(dateString) {
      if (!dateString) return "N/A";
      const date = new Date(dateString);
      const options = {
        year: "numeric",
        month: "short",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        hour12: true,
      };
      return date.toLocaleDateString("en-US", options);
    },
  },
};
</script>

<style lang="scss" scoped></style>
