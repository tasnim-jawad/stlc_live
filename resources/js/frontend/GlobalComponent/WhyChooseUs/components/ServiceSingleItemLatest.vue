<template>
  <div id="service-slider">
    <section>
      <div class="head">
        <h2></h2>

        <div class="controls">
          <button
            ref="prevBtn"
            class="nav-btn"
            aria-label="Prev"
            @click="go(-1)"
            :disabled="currentIndex === 0"
          >
            ‹
          </button>
          <button
            ref="nextBtn"
            class="nav-btn"
            aria-label="Next"
            @click="go(1)"
            :disabled="currentIndex === cards.length - 1"
          >
            ›
          </button>
        </div>
      </div>

      <div class="slider">
        <div
          ref="track"
          class="track"
          @touchstart="handleTouchStart"
          @touchend="handleTouchEnd"
        >
          <article
            v-for="(card, index) in cards"
            :key="index"
            class="project-card"
            :class="{ active: index === currentIndex }"
            @mouseenter="handleMouseEnter(index)"
            @click="activate(index, true)"
          >
            <img class="project-card__bg" :src="card.image" :alt="card.title" />
            <div class="project-card__content">
              <div class="frosted-box">
                <div>
                  <h3 class="project-card__title">{{ card.title }}</h3>
                  <p class="project-card__desc">{{ card.description }}</p>
                </div>
              </div>
            </div>
          </article>
        </div>
      </div>

      <div class="dots" v-show="!isMobile">
        <span
          v-for="(card, index) in cards"
          :key="`dot-${index}`"
          class="dot"
          :class="{ active: index === currentIndex }"
          @click="activate(index, true)"
        ></span>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  data() {
    return {
      currentIndex: 0,
      touchStartX: 0,
      touchStartY: 0,
      cards: [
        {
          title: "Compliance",
          description:
            "Security and compliance tailored for the world's most regulated industries.",
          image:
            "https://anff-qld.org.au/wp-content/uploads/2017/01/APP_HyVolution_Synaptonemal_x-63-photoncounting_rgb.jpg",
        },
        {
          title: "Reimbursement",
          description:
            "Medicare Medicaid reimbursement rates to calculate the cost.",
          image:
            "https://www.nikonsmallworld.com/images/photos/2022/Neuronal-Cells-2.jpg",
        },
        {
          title: "Validation",
          description:
            "Measurement of completed requirements mandatory for clinical implementation.",
          image:
            "https://www.nikonsmallworld.com/images/photos/2013/Entry_24503_Entry_21710_K-Boyle-1.jpg",
        },
        {
          title: "Traction",
          description: "Timeline and steps of validation.",
          image:
            "https://www.nikonsmallworld.com/images/photos/2020/Series004.tif-RGB_2_300dpi.jpg",
        },
        {
          title: "Predictive Analytics",
          description: "De-risk an innovation's funding and investment.",
          image:
            "https://www.elements-of-innovation.com/wp-content/uploads/2025/07/A-neuron-densely-covered-in-dendritic-spines-from-the-striatum-of-an-adult-rat-brain.jpg",
        },
      ],
    };
  },
  computed: {
    isMobile() {
      return (
        typeof window !== "undefined" &&
        window.matchMedia("(max-width:767px)").matches
      );
    },
  },
  methods: {
    activate(index, scroll = false) {
      if (index === this.currentIndex) return;
      this.currentIndex = index;
      if (scroll) {
        this.$nextTick(() => {
          this.centerCard(index);
        });
      }
    },
    centerCard(index) {
      const track = this.$refs.track;
      const cards = track.querySelectorAll(".project-card");
      if (!cards[index]) return;

      const card = cards[index];
      const wrap = track.parentElement;
      const axis = this.isMobile ? "top" : "left";
      const size = this.isMobile ? "clientHeight" : "clientWidth";
      const start = this.isMobile ? card.offsetTop : card.offsetLeft;

      wrap.scrollTo({
        [axis]: start - (wrap[size] / 2 - card[size] / 2),
        behavior: "smooth",
      });
    },
    go(step) {
      const newIndex = Math.min(
        Math.max(this.currentIndex + step, 0),
        this.cards.length - 1
      );
      this.activate(newIndex, true);
    },
    handleMouseEnter(index) {
      if (
        typeof window !== "undefined" &&
        window.matchMedia("(hover:hover)").matches
      ) {
        this.activate(index, true);
      }
    },
    handleTouchStart(e) {
      this.touchStartX = e.touches[0].clientX;
      this.touchStartY = e.touches[0].clientY;
    },
    handleTouchEnd(e) {
      const dx = e.changedTouches[0].clientX - this.touchStartX;
      const dy = e.changedTouches[0].clientY - this.touchStartY;

      if (this.isMobile ? Math.abs(dy) > 60 : Math.abs(dx) > 60) {
        this.go((this.isMobile ? dy : dx) > 0 ? -1 : 1);
      }
    },
    handleKeydown(e) {
      if (["ArrowRight", "ArrowDown"].includes(e.key)) {
        this.go(1);
      }
      if (["ArrowLeft", "ArrowUp"].includes(e.key)) {
        this.go(-1);
      }
    },
    handleResize() {
      this.centerCard(this.currentIndex);
    },
  },
  mounted() {
    // Add keyboard event listeners
    window.addEventListener("keydown", this.handleKeydown, { passive: true });
    window.addEventListener("resize", this.handleResize);

    // Initialize first card
    this.$nextTick(() => {
      this.centerCard(0);
    });
  },
  beforeUnmount() {
    // Clean up event listeners
    window.removeEventListener("keydown", this.handleKeydown);
    window.removeEventListener("resize", this.handleResize);
  },
};
</script>

<style scoped>
#service-slider {
  --gap: 1.25rem;
  --speed: 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
  --closed: 10rem;
  --open: 40rem;
  --accent: #ff6b35;
}

#service-slider * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

#service-slider {
  font-family: Inter, sans-serif;
  background: #000000;
  color: #c5c7ce;
}

#service-slider .head {
  max-width: 1400px;
  margin: auto;
  padding: 70px 20px 40px;
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  gap: 2rem;
}

#service-slider .head h2 {
  font: 400 1.5rem/1.2 Inter, sans-serif;
  color: #fff;
}

@media (min-width: 1024px) {
  #service-slider .head h2 {
    font-size: 2.25rem;
  }
}

#service-slider .nav-btn {
  width: 2.5rem;
  height: 2.5rem;
  border: none;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.12);
  color: #fff;
  font-size: 1.5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: 0.3s;
}

#service-slider .nav-btn:hover {
  background: var(--accent);
}

#service-slider .nav-btn:disabled {
  opacity: 0.3;
  cursor: default;
}

#service-slider .slider {
  max-width: 1400px;
  margin: auto;
  overflow: visible;
}

#service-slider .controls {
  display: flex;
  flex-direction: row;
  gap: 0.5rem;
}

#service-slider .track {
  display: flex;
  gap: var(--gap);
  align-items: flex-start;
  justify-content: center;
  scroll-behavior: smooth;
  scroll-snap-type: x mandatory;
  padding-bottom: 40px;
}

#service-slider .track::-webkit-scrollbar {
  display: none;
}

#service-slider .project-card {
  position: relative;
  flex: 0 0 var(--closed);
  height: 26rem;
  border-radius: 1rem;
  overflow: visible;
  cursor: pointer;
  transition: flex-basis var(--speed), transform var(--speed);
  border: 2px solid #1e90ff;
}

#service-slider .project-card.active {
  flex-basis: var(--open);
  transform: translateY(-4px);
  box-shadow: 5px 18px 55px rgba(30, 144, 255, 1);
  border: 2px solid #1e90ff;
}

#service-slider .project-card__bg {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.75) saturate(75%);
  transition: filter 0.3s, transform var(--speed);
}

#service-slider .project-card:hover .project-card__bg {
  filter: brightness(0.9) saturate(100%);
  transform: scale(1.06);
}

#service-slider .project-card__content {
  position: absolute;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2;
  padding: 0;
}

#service-slider .frosted-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.7rem;
  padding: 2rem 2.5rem;
  background: rgba(255, 255, 255, 0.05);
  border-radius: 1.25rem;
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  border: 1px solid rgba(255, 255, 255, 0.4);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2),
    inset 0 0 8px rgba(255, 255, 255, 0.15);
  position: relative;
  overflow: hidden;
  color: #fff;
  text-align: center;
}

#service-slider .frosted-box::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: radial-gradient(
    ellipse at top left,
    rgba(255, 255, 255, 0.25),
    transparent 60%
  );
  pointer-events: none;
  z-index: 1;
}

#service-slider .frosted-box > div {
  display: inline-flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

#service-slider .project-card__title {
  color: #fff;
  font-weight: 700;
  font-size: 1.35rem;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
}

#service-slider .project-card__thumb,
#service-slider .project-card__desc,
#service-slider .project-card__btn {
  display: none;
}

#service-slider .project-card.active .project-card__content {
  flex-direction: row;
  align-items: center;
  padding: 1.2rem 2rem;
  gap: 1.1rem;
}

#service-slider .project-card.active .project-card__title {
  writing-mode: horizontal-tb;
  transform: none;
  font-size: 2.4rem;
}

#service-slider .project-card.active .project-card__thumb,
#service-slider .project-card.active .project-card__desc,
#service-slider .project-card.active .project-card__btn {
  display: block;
}

#service-slider .project-card__thumb {
  width: 133px;
  height: 269px;
  border-radius: 0.45rem;
  object-fit: cover;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4);
}

#service-slider .project-card__desc {
  color: #ddd;
  font-size: 1rem;
  line-height: 1.4;
  max-width: 16rem;
  margin: 0 auto;
  text-align: center;
}

#service-slider .project-card__btn {
  padding: 0.55rem 1.3rem;
  border: none;
  border-radius: 9999px;
  background: var(--accent);
  color: #fff;
  font-size: 0.9rem;
  font-weight: 600;
  cursor: pointer;
}

#service-slider .project-card__btn:hover {
  background: #ff824f;
}

#service-slider .dots {
  display: flex;
  gap: 0.5rem;
  justify-content: center;
  padding: 20px 0;
}

#service-slider .dot {
  width: 13px;
  height: 13px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.35);
  cursor: pointer;
  transition: 0.3s;
}

#service-slider .dot.active {
  background: var(--accent);
  transform: scale(1.2);
}

/* Mobile Styles */
@media (max-width: 767px) {
  #service-slider {
    --closed: 4rem;
    --open: 22rem;
  }

  #service-slider .head {
    padding: 50px 20px 30px;
  }

  #service-slider .track {
    flex-direction: column;
    scroll-snap-type: y mandatory;
    align-items: center;
    justify-content: flex-start;
    padding-bottom: 0;
  }

  #service-slider .project-card {
    height: 20rem;
  }

  #service-slider .project-card__title {
    font-size: 1.1rem;
    writing-mode: horizontal-tb;
    transform: none;
    text-align: center;
    padding-inline: 0.3rem;
  }

  #service-slider .nav-btn {
    width: 2rem;
    height: 2rem;
    font-size: 1.2rem;
  }
}

@media (max-width: 767px) {
  #service-slider {
    --closed: 100%;
    --open: 100%;
    --gap: 0.8rem;
  }

  #service-slider .head {
    padding: 30px 15px 20px;
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  #service-slider .slider {
    padding-top: 6px;
    overflow: hidden;
  }

  #service-slider .track {
    flex-direction: column;
    scroll-snap-type: y mandatory;
    gap: 0.8rem;
    padding-bottom: 20px;
  }

  #service-slider .project-card {
    height: auto;
    min-height: 80px;
    flex: 0 0 auto;
    width: 100%;
    scroll-snap-align: start;
  }

  #service-slider .project-card.active {
    min-height: 300px;
    transform: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
  }

  #service-slider .project-card__content {
    flex-direction: row;
    justify-content: flex-start;
    padding: 1rem;
    align-items: center;
    gap: 1rem;
  }

  #service-slider .project-card__title {
    writing-mode: horizontal-tb;
    transform: none;
    font-size: 1.2rem;
    margin-right: auto;
  }

  #service-slider .project-card__thumb,
  #service-slider .project-card__desc,
  #service-slider .project-card__btn {
    display: none;
  }

  #service-slider .project-card.active .project-card__content {
    align-items: flex-start;
    padding: 1.5rem;
  }

  #service-slider .project-card.active .project-card__title {
    font-size: 1.8rem;
    margin-bottom: 2rem;
    margin-top: 2rem;
  }

  #service-slider .project-card.active .project-card__thumb {
    width: 200px;
    height: 267px;
    border-radius: 0.35rem;
    margin-bottom: 1rem;
  }

  #service-slider .project-card.active .project-card__desc {
    font-size: 0.95rem;
    max-width: 100%;
    margin-top: 5rem;
    margin-bottom: 1rem;
  }

  #service-slider .project-card.active .project-card__btn {
    align-self: center;
    width: 100%;
    text-align: center;
    padding: 0.7rem;
  }

  #service-slider .dots {
    display: none;
  }

  #service-slider .controls {
    width: 100%;
    justify-content: space-between;
    padding: 0 15px 20px;
  }

  #service-slider .nav-btn {
    position: static;
    transform: none;
  }
}
</style>
