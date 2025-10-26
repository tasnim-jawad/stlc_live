/**
 * TypeScript interfaces for PropertySlider component
 */

export interface Author {
  name: string;
  avatar: string;
  profile: string;
}

export interface Category {
  name: string;
  link: string;
}

export interface Slide {
  id: number | string;
  title: string;
  link: string;
  image: string;
  author: Author;
  commentsCount: number;
  category: Category;
  date: string; // ISO date format (YYYY-MM-DD)
}

export interface PropertySliderProps {
  slides: Slide[];
  showNavigation?: boolean;
  autoplay?: boolean;
  autoplayDelay?: number;
}

export interface ImageConfig {
  main: {
    width: number;
    height: number;
  };
  thumb: {
    width: number;
    height: number;
  };
}

export interface NavigationLabels {
  next: string;
  prev: string;
}

export interface SwiperBreakpoints {
  [width: number]: {
    slidesPerView: number;
  };
}

export interface SwiperConfig {
  direction: "horizontal" | "vertical";
  speed: number;
  touchRatio: number;
  slideToClickedSlide: boolean;
  loop: boolean;
  loopedSlides: number;
  navigation?: {
    nextEl: string;
    prevEl: string;
  };
  breakpoints: SwiperBreakpoints;
  watchSlidesProgress?: boolean;
}

export interface MainSwiperConfig {
  parallax: boolean;
  effect: "fade" | "slide" | "cube" | "coverflow" | "flip";
  speed: number;
  loop: boolean;
  loopedSlides: number;
  autoplay?: {
    delay: number;
    disableOnInteraction: boolean;
  };
  pagination: {
    el: string;
    clickable: boolean;
    renderBullet?: (index: number, className: string) => string;
  };
  thumbs?: {
    swiper: any;
  };
}
